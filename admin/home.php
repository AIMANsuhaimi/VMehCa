<?php
include('C:/xampp/htdocs/fyp/database/connectiondb.php');
session_start();

// Retrieve the user ID from the session
$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

// Initialize variables
$username = null;

if ($user_id) {
    // Query to fetch the username
    $queryUsername = "SELECT username FROM user WHERE id = '$user_id'";
    $resultUsername = mysqli_query($conn, $queryUsername);

    if ($resultUsername && mysqli_num_rows($resultUsername) > 0) {
        $row = mysqli_fetch_assoc($resultUsername);
        $username = $row['username']; // Store the username
    } else {
        // Debugging output if no username is found
        echo "<script>console.log('Username query failed or no results found.');</script>";
    }
} else {
    echo "<script>console.log('User ID not found in session.');</script>";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/fyp/css/style.css">
    <link rel="icon" href="/fyp/img/tabicon.png">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <title>Home</title>
</head>

<body>
    <header>
        <nav>
            <ul>
                <img class="headic" src="/fyp/img/ic.png" alt="">
                <li><a href="home.php">Home</a></li>
                <li>
                    <div class="dropdown">
                        <button class="dropbtn">Register
                            <i class="fa fa-caret-down"></i>
                        </button>
                        <div class="dropdown-content">
                            <a href="regdoc.php">Doctor</a>
                            <a href="regnurse.php">Nurse</a>
                        </div>
                </li>
                <li>
                    <div class="dropdown">
                        <button class="dropbtn">Records
                            <i class="fa fa-caret-down"></i>
                        </button>
                        <div class="dropdown-content">
                            <a href="docrec.php">Doctor</a>
                            <a href="nurserec.php">Nurse</a>
                        </div>
                </li>
                <button class="logoutbtn" onclick="window.location.href='/fyp/logoutprocess.php';">logout</button>

            </ul>
        </nav>
    </header>
    <?php if ($username): ?>
        <div id="welcomeNotification" class="notification-container" style="display: block;">
            <button class="close-btn" onclick="this.parentElement.style.display='none';">&times;</button>
            <h4>Welcome, <?= htmlspecialchars($username) ?>!</h4>
            <p>We're glad to have you back.</p>
        </div>
    <?php else: ?>
        <!-- Debugging output if no username is available -->
        <script>console.log('No username available for the welcome notification.');</script>
    <?php endif; ?>
    <div class="imgcon">
        <img class="imgbanner" src="/fyp/img/Medical.png" alt="">
    </div>
    <div>
        <section class="services">
            <div class="container">
                <table class="f">
                    <tr class="f">
                        <td class="f">
                            <div class="service">
                                <button onclick="window.location.href='regnurse.php';">
                                    <img src="/fyp/img/nurse.jpg" alt="Register Nurse">
                                    <h3>Register Nurse</h3>
                                </button>
                            </div>
                        </td>
                        <td class="f">
                            <div class="service">
                                <button onclick="window.location.href='regdoc.php';">
                                    <img src="/fyp/img/doctor.jpg" alt="Register Doctor">
                                    <h3>Register Doctor</h3>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <tr class="f">
                        <td class="f">
                            <div class="service">
                                <button onclick="window.location.href='docrec.php';">
                                    <img src="/fyp/img/doctor.jpg" alt="Doctor Record">
                                    <h3>Doctor Record</h3>
                                </button>
                            </div>
                        </td>
                        <td class="f">
                            <div class="service">
                                <button onclick="window.location.href='nurserec.php';">
                                    <img src="/fyp/img/doctor.jpg" alt="Nurse Record">
                                    <h3>Nurse Record</h3>
                                </button>
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
        </section>
    </div>
    </section>
    </main>
    </div>
    </div>
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