<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/fyp/css/style.css">
    <link rel="icon" href="/fyp/img/tabicon.png">

    <title>Sign Up</title>
</head>
<body>
    <header>
        <nav>
            <ul>
                <img class="headic" src="/fyp/img/ic.png" alt="">
                <li><a href="/fyp/nurse/home.php">Home</a></li>
                <li><a href="about.html">About</a></li>
                <li><a href="contact.html">Contact</a></li>
                <button class="logoutbtn" onclick="window.location.href='/fyp/logoutprocess.php';">logout</button>

            </ul>
        </nav>
    </header>     
    <main>
        <h2 class="title">Register Patient</h2>
        <div class="contsign">
        <div class="signup-container">
            <div class="containersignin">
            <h2>Register Patient</h2>
            <form name="regstd" method="post" action="signuprocess.php" enctype="multipart/form-data"> 
                <input type="text" name="name" placeholder="Name" required>
                <input type="email" name="email" placeholder="Email" required>
                <input type="password" name="password" placeholder="Password" required>
                <input type="password" placeholder="Repeat password"  required>
                <button type="submit" name="register" value="register" >Sign Up</button>
            </form>
        </div>
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