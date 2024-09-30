<?php
include('C:/xampp/htdocs/fyp/database/connectiondb.php');
session_start();

// Get the user ID from session
$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

// Initialize variables
$latestAppointment = null;
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

    // Query to fetch the latest appointment
    $query = "
        SELECT date, time, doctor 
        FROM appointmentt 
        WHERE name = (SELECT username FROM user WHERE id = '$user_id') 
        AND date >= CURDATE() 
        ORDER BY date DESC, time DESC 
        LIMIT 1
    ";

    // Execute the query
    $result = mysqli_query($conn, $query);

    // Check if the query failed
    if (!$result) {
        die("Error executing query: " . mysqli_error($conn)); // Debugging output
    }

    // Check if there are rows returned
    if (mysqli_num_rows($result) > 0) {
        $latestAppointment = mysqli_fetch_assoc($result);
    }
} else {
    // Debugging output if session ID is not found
    echo "<script>console.log('User ID not set in session.');</script>";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/fyp/css/style.css">
    <link rel="icon" href="/fyp/img/tabicon.png">

    <title>Home</title>
</head>

<body>
    <header>
        <div>
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

    <!-- Welcome notification -->
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


    <!-- Display the latest appointment notification if available -->
    <?php if ($latestAppointment): ?>
        <div id="appointmentNotification" class="notification-container">
            <button class="close-btn" onclick="this.parentElement.style.display='none';">&times;</button>
            <h4>Your Next Appointment</h4>
            <p>Date: <?= htmlspecialchars($latestAppointment['date']) ?></p>
            <p>Time: <?= htmlspecialchars($latestAppointment['time']) ?></p>
            <p>Doctor: <?= htmlspecialchars($latestAppointment['doctor']) ?></p>
        </div>
    <?php endif; ?>

    <div>
        <section class="services">
            <div class="container">
                <div class="service">
                    <button onclick="window.location.href='onlinecon.php?user_id=<?= urlencode($user_id) ?>';">
                        <img src="/fyp/img/on9.jpg" alt="Online Consultation">
                        <h3>Online Consultation</h3>
                    </button>
                </div>
                <div class="service">
                    <button onclick="window.location.href='appoinhistory.php?user_id=<?= urlencode($user_id) ?>';">
                        <img src="/fyp/img/rec.jpg" alt="Appointment History">
                        <h3>Appointment History</h3>
                    </button>
                </div>
                <div class="service">
                    <button>
                        <img src="/fyp/img/chatb.jpg" alt="Patient Chatbot">
                        <h3>Patient Chatbot</h3>
                    </button>
                </div>
            </div>
        </section>
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

<script>
    // Auto-hide the appointment and welcome notifications after 5 seconds
    window.onload = function () {
        var appointmentNotification = document.getElementById("appointmentNotification");
        var welcomeNotification = document.getElementById("welcomeNotification");

        if (appointmentNotification) {
            // Function to toggle the visibility of the appointment notification
            function toggleNotification() {
                // Check if the notification is currently displayed
                if (appointmentNotification.style.display === "none" || appointmentNotification.style.display === "") {
                    // Show the notification
                    appointmentNotification.style.display = "block";
                } else {
                    // Hide the notification
                    appointmentNotification.style.display = "none";
                }
            }

            // Hide after 5 seconds, then show again after another 5 seconds in a loop
            setInterval(toggleNotification, 5000); // Every 5 seconds toggle the visibility
        }

        if (welcomeNotification) {
            // Hide the welcome notification after 5 seconds
            setTimeout(function () {
                welcomeNotification.style.display = "none";
            }, 5000); // Hide after 5 seconds
        }
    };
</script>


</html>
