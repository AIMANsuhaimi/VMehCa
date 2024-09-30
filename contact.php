<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/fyp/css/style.css">
    <link rel="icon" href="/fyp/img/tabicon.png">
    <script src="/fyp/js/script.js"></script>

    <title>Contact</title>
</head>

<body>
    <header class="header-nav">
        <nav>
            <ul>
                <img class="headic" src="VMe-removebg-preview.png" alt="">
                <li><a href="home1.php">Home</a></li>
                <li><a href="about.html">About</a></li>
                <li><a href="contact.html">Contact</a></li>
                <button class="loginbtn" onclick="window.location.href='signin.php';">login</button>
            </ul>
        </nav>
    </header>
    <div id="loginModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h1>Sign In</h1>
            <form action="signinprocess.php" method="POST">
                <input type="text" id="username" name="username" placeholder="Username" required>
                <input type="password" id="password" name="password" placeholder="Password" required>
                <button type="submit" name="signin">Sign In</button>
            </form>
        </div>
    </div>
    <div class="contacthome">
    <main class="main-content">
        <h1 class="form-heading">Contact Us</h1>
        <form class="contact-form">
            <input class="form-input" type="text" id="name" name="name" placeholder="name">

            <input class="form-input" type="email" id="email" name="email"  placeholder="email">

            <textarea class="form-textarea" id="message" name="message"  placeholder="message"></textarea>

            <button class="form-button" type="submit">Send</button>
        </form>
    </main>
    </div>

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
</body>
<script src="/fyp/js/script.js"></script>

</html>