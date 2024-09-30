<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/fyp/css/style.css"> <!-- Your existing main stylesheet -->
    <link rel="stylesheet" href="/fyp/css/modal.css"> <!-- New modal CSS file -->
    <title>VMeHCA</title>
    <link rel="icon" href="/fyp/img/tabicon.png">
</head>

<body>
    <header>
        <nav>
            <ul>
                <img class="headic" src="/fyp/img/ic.png" alt="">
                <li><a href="home1.php">Home</a></li>
                <li><a href="about.html">About</a></li>
                <li><a href="contact.html">Contact</a></li>
                <button class="loginbtn" id="loginBtn">Login</button>
            </ul>
        </nav>
    </header>

    <!-- Popup Modal for Sign In -->
    <div id="loginModal" class="modal" style="display:none;">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h1>Sign In</h1>
            <form action="signinprocess.php" method="POST">
                <input type="text" id="username" name="username" placeholder="Username" >
                <input type="password" id="password" name="password" placeholder="Password" >
                <button type="submit" name="signin">Sign In</button>
            </form>
        </div>
    </div>

    <div class="imgcon">
        <img class="imgbanner" src="/fyp/img/Medical.png" alt="">
    </div>

    <section class="services">
        <div class="container">
            <div class="service">
                <button onclick="window.location.href='onlinecon.html';">
                    <img src="/fyp/img/chatbo.jpg" alt="Online Consultation">
                    <h3>Chatbot</h3>
                </button>
            </div>
        </div>
    </section>

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

    <!-- JavaScript should be placed here -->
    <script src="/fyp/js/script.js"></script>

</body>

</html>
