// WebRTC and signaling setup
const localVideo = document.getElementById('localVideo');
const remoteVideo = document.getElementById('remoteVideo');
const startButton = document.getElementById('startButton');
const callButton = document.getElementById('callButton');
const answerButton = document.getElementById('answerButton');
const hangupButton = document.getElementById('hangupButton');

let localStream;
let peerConnection;
const servers = {
    iceServers: [{ urls: 'stun:stun.l.google.com:19302' }]
};

startButton.onclick = async () => {
    try {
        localStream = await navigator.mediaDevices.getUserMedia({ video: true, audio: true });
        localVideo.srcObject = localStream;
        callButton.disabled = false;
    } catch (error) {
        console.error('Error accessing media devices:', error);
    }
};

callButton.onclick = async () => {
    try {
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

        const offer = await peerConnection.createOffer();
        await peerConnection.setLocalDescription(offer);
        sendSignal('offer', offer);

        callButton.disabled = true;
        answerButton.disabled = false;
        hangupButton.disabled = false;
    } catch (error) {
        console.error('Error during the call setup:', error);
    }
};

answerButton.onclick = async () => {
    try {
        if (!peerConnection) {
            console.error('No peer connection established.');
            return;
        }

        const answer = await peerConnection.createAnswer();
        await peerConnection.setLocalDescription(answer);
        sendSignal('answer', answer);

        answerButton.disabled = true;
    } catch (error) {
        console.error('Error creating or sending the answer:', error);
    }
};

hangupButton.onclick = () => {
    if (peerConnection) {
        peerConnection.close();
        peerConnection = null;
        callButton.disabled = false;
        answerButton.disabled = true;
        hangupButton.disabled = true;
    }
};

async function fetchSignalingData() {
    try {
        const response = await fetch('signaling.php');
        const data = await response.json();
        console.log('Fetched signaling data:', data);

        for (const item of data) {
            console.log('Processing signaling item:', item);
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
                console.log('Sent answer:', answer);

            } else if (item.type === 'answer') {
                await peerConnection.setRemoteDescription(new RTCSessionDescription(JSON.parse(item.message)));
                console.log('Set remote description with answer.');
            } else if (item.type === 'candidate') {
                await peerConnection.addIceCandidate(new RTCIceCandidate(JSON.parse(item.message)));
                console.log('Added ICE candidate.');
            }
        }
    } catch (error) {
        console.error('Error fetching signaling data:', error);
    }
}

function sendSignal(type, message) {
    fetch('signaling.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: new URLSearchParams({ type, message: JSON.stringify(message) })
    })
    .then(response => response.text())
    .then(data => console.log('Signaling data sent:', data))
    .catch(error => console.error('Error sending signaling data:', error));
}

// Fetch signaling data periodically
setInterval(fetchSignalingData, 1000);
