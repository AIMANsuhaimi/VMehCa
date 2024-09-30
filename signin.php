<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/fyp/css/style.css">
    <link rel="icon" href="/fyp/img/tabicon.png">

    <title>Sign In</title>
</head>
<body>
    <header>
        <nav>
            <ul>
                <img class="headic" src="/fyp/img/ic.png" alt="Logo">
                <li><a href="home1.php">Home</a></li>
                <li><a href="about.html">About</a></li>
                <li><a href="contact.html">Contact</a></li>
                <li><button class="loginbtn" onclick="window.location.href='signin.php';">Login</button></li>
            </ul>
        </nav>
    </header>     
    <main>
        <div class="contsign">
            <div class="containersignin">
                <h1>Sign In</h1>
                <form action="signinprocess.php" method="POST">
                    <input type="text" id="username" name="username" placeholder="Username" required>
                    <input type="password" id="password" name="password" placeholder="Password" required>
                    <button type="submit" name="signin">Sign In</button>
                </form>
            </div>
        </div>
    </main>
</body>
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

</html>
