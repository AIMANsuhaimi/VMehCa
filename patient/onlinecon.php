<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/fyp/css/style.css">
    <link rel="icon" href="/fyp/img/tabicon.png">

    <title>WebRTC Guest</title>
</head>

<body>
    <header>
        <nav>
            <ul>
                <img class="headic" src="/fyp/img/ic.png" alt="">
                <li><a href="home.php">Home</a></li>
                <li><a href="about.php">About</a></li>
                <li><a href="contact.html">Contact</a></li>
                <button class="logoutbtn" onclick="window.location.href='/fyp/logoutprocess.php';">Logout</button>
            </ul>
        </nav>
    </header>

    <main class="main2">
        <div class="cont">
            <div id="videos">
                <video id="localVideo" autoplay playsinline muted></video>
                <video id="remoteVideo" autoplay playsinline></video>
                <!-- Control buttons for the video container -->
                
            </div>
            <div id="controls">
                <button id="startButton">Start</button>
                <button id="answerButton" disabled>Answer</button>
                <button id="hangupButton" disabled>Hang Up</button>
            </div>
        </div>
    </main>


    <footer class="footer">
        <div class="footer-content">
            <p>&copy; 2024 Qualitas Health Malaysia. All Rights Reserved.</p>
            <ul class="social-links">
            <li>
                <a href="https://example.com" class="footerlogo">
                    <img src="/fyp/img/facebook.png" width="40">
                </a>
            </li>
            <li>
                <a href="https://example.com" class="footerlogo">
                    <img src="/fyp/img/insta.png" width="40">
                </a>
            </li>
            <li>
                <a href="https://example.com" class="footerlogo">
                    <img src="/fyp/img/x.png" width="40">
                </a>
            </li>
            </ul>
        </div>
    </footer>

    <script>
        let localStream;
        let peerConnection;
        const servers = { iceServers: [{ urls: 'stun:stun.l.google.com:19302' }] };

        const localVideo = document.getElementById('localVideo');
        const remoteVideo = document.getElementById('remoteVideo');
        const startButton = document.getElementById('startButton');
        const answerButton = document.getElementById('answerButton');
        const hangupButton = document.getElementById('hangupButton');

        async function startStream() {
            try {
                localStream = await navigator.mediaDevices.getUserMedia({ video: true, audio: true });
                localVideo.srcObject = localStream;
                answerButton.disabled = false;
                hangupButton.disabled = false;
            } catch (error) {
                console.error('Error accessing media devices.', error);
            }
        }

        function cleanup() {
            if (peerConnection) {
                peerConnection.close();
                peerConnection = null;
            }
            if (localStream) {
                localStream.getTracks().forEach(track => track.stop());
                localStream = null;
            }
            remoteVideo.srcObject = null;
            answerButton.disabled = false;
            hangupButton.disabled = true;
        }

        startButton.onclick = async () => {
            cleanup();
            await startStream();
        };

        answerButton.onclick = async () => {
            try {
                if (!peerConnection) {
                    peerConnection = new RTCPeerConnection(servers);

                    localStream.getTracks().forEach(track => peerConnection.addTrack(track, localStream));

                    peerConnection.ontrack = event => {
                        remoteVideo.srcObject = event.streams[0];
                    };

                    peerConnection.onicecandidate = event => {
                        if (event.candidate) {
                            sendSignal('candidate', event.candidate);
                        }
                    };

                    const response = await fetch('/vidcon/signaling.php');
                    const data = await response.json();

                    for (const item of data) {
                        if (item.type === 'offer') {
                            await peerConnection.setRemoteDescription(new RTCSessionDescription(JSON.parse(item.message)));
                            const answer = await peerConnection.createAnswer();
                            await peerConnection.setLocalDescription(answer);
                            sendSignal('answer', answer);
                            break;
                        }
                    }
                }

                answerButton.disabled = true;
                hangupButton.disabled = false;
            } catch (error) {
                console.error('Error during the answer setup.', error);
            }
        };

        hangupButton.onclick = () => {
            cleanup();
        };

        function sendSignal(type, message) {
            fetch('/vidcon/signaling.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: new URLSearchParams({ type, message: JSON.stringify(message) })
            })
                .then(response => response.text())
                .then(data => console.log('Signaling data sent:', data))
                .catch(error => console.error('Error sending signaling data:', error));
        }

        async function fetchSignalingData() {
            try {
                const response = await fetch('/fyp/vidcon/signaling.php');
                const data = await response.json();

                for (const item of data) {
                    if (item.type === 'offer') {
                        if (peerConnection) return;

                        peerConnection = new RTCPeerConnection(servers);
                        localStream.getTracks().forEach(track => peerConnection.addTrack(track, localStream));

                        peerConnection.ontrack = event => {
                            remoteVideo.srcObject = event.streams[0];
                        };

                        peerConnection.onicecandidate = event => {
                            if (event.candidate) {
                                sendSignal('candidate', event.candidate);
                            }
                        };

                        await peerConnection.setRemoteDescription(new RTCSessionDescription(JSON.parse(item.message)));
                        const answer = await peerConnection.createAnswer();
                        await peerConnection.setLocalDescription(answer);
                        sendSignal('answer', answer);

                    } else if (item.type === 'answer') {
                        await peerConnection.setRemoteDescription(new RTCSessionDescription(JSON.parse(item.message)));
                    } else if (item.type === 'candidate') {
                        await peerConnection.addIceCandidate(new RTCIceCandidate(JSON.parse(item.message)));
                    }
                }
            } catch (error) {
                console.error('Error fetching signaling data:', error);
            }
            // JavaScript to make the local video draggable
            const localVideo = document.getElementById('localVideo');

            localVideo.onmousedown = function (event) {
                let shiftX = event.clientX - localVideo.getBoundingClientRect().left;
                let shiftY = event.clientY - localVideo.getBoundingClientRect().top;

                function moveAt(pageX, pageY) {
                    localVideo.style.left = pageX - shiftX + 'px';
                    localVideo.style.top = pageY - shiftY + 'px';
                }

                function onMouseMove(event) {
                    moveAt(event.pageX, event.pageY);
                }

                document.addEventListener('mousemove', onMouseMove);

                localVideo.onmouseup = function () {
                    document.removeEventListener('mousemove', onMouseMove);
                    localVideo.onmouseup = null;
                };
            };

            localVideo.ondragstart = function () {
                return false;
            };

        }

        setInterval(fetchSignalingData, 2000);
    </script>
</body>

</html>