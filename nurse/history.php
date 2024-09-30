<?php
include('C:/xampp/htdocs/fyp/database/connectiondb.php');
$name = $_GET['stdid']; // Retrieve the patient ID from the URL

// Step 1: Fetch patient name from the patient table using the patient's ID
$sqlpatient = "SELECT name FROM patient WHERE id = '$name'";
$resultpatient = $conn->query($sqlpatient);
$patient = $resultpatient->fetch_assoc();
$patient_name = $patient['name']; // Get the patient name

// Step 2: Fetch appointment details from the appointmentt table using the patient's name
// Sort by date and time from latest to earliest
$sqldisplay = "
    SELECT doctor, date, time 
    FROM appointmentt 
    WHERE name = '$patient_name'
    ORDER BY date DESC, time DESC
";

$resultdisplay = $conn->query($sqldisplay);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointment Details</title>
    <link rel="icon" href="/fyp/img/tabicon.png">

    <link rel="stylesheet" href="/fyp/css/style.css">
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
    <h2 class="title">Appointment Details for <?= htmlspecialchars($patient_name); ?></h2>
    <table border="1" class="table">
        <tr>
            <th>No</th>
            <th>Doctor</th>
            <th>Date</th>
            <th>Time</th>
        </tr>
        <?php
        if ($resultdisplay->num_rows > 0) {
            $no = 1;
            // Loop through the appointment records and display them
            while ($row = $resultdisplay->fetch_assoc()) {
        ?>
        <tr>
            <td><?= $no++; ?></td>
            <td><?= htmlspecialchars($row['doctor']); ?></td>
            <td><?= htmlspecialchars($row['date']); ?></td>
            <td><?= htmlspecialchars($row['time']); ?></td>
        </tr>
        <?php
            }
        } else {
            echo "<tr><td colspan='4'>No appointments found for this patient.</td></tr>";
        }
        ?>
    </table>
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
