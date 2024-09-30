<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include('C:/xampp/htdocs/fyp/database/connectiondb.php');
session_start(); // Ensure session is started

// Retrieve user_id from the URL (if available)
$user_id = isset($_GET['user_id']) ? $_GET['user_id'] : null;

if ($user_id) {
    // Step 1: Fetch username from the user table using user_id
    $sqlpatient = "SELECT username FROM user WHERE id = ?";
    $stmt = $conn->prepare($sqlpatient);

    if ($stmt === false) {
        die('Prepare failed: ' . htmlspecialchars($conn->error));
    }

    $stmt->bind_param('i', $user_id);
    $stmt->execute();
    $resultpatient = $stmt->get_result();

    if ($resultpatient->num_rows > 0) {
        $patient = $resultpatient->fetch_assoc();
        $patient_name = $patient['username']; // Get the patient name

        // Step 2: Fetch appointment details from the appointmentt table using the patient's username
        $sqldisplay = "SELECT doctor, date, time FROM appointmentt WHERE name = ?";
        $stmt = $conn->prepare($sqldisplay);

        if ($stmt === false) {
            die('Prepare failed: ' . htmlspecialchars($conn->error));
        }

        $stmt->bind_param('s', $patient_name);
        $stmt->execute();
        $resultdisplay = $stmt->get_result();
    } else {
        echo "No such user found.";
        exit();
    }
} else {
    echo "User ID parameter is missing.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/fyp/css/style.css">
    <link rel="icon" href="/fyp/img/tabicon.png">

    <title>Appointment History</title>
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
    <main>
        <h2 class="title">Appointment History for <?= htmlspecialchars($patient_name); ?></h2>
        <div class="tables">
        <table>
    <thead>
        <tr>
            <th>No</th>
            <th>Doctor Name</th>
            <th>Date</th>
            <th>Time</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if ($resultdisplay->num_rows > 0) {
            $no = 1;
            while ($data = $resultdisplay->fetch_assoc()) {
                ?>
                <tr>
                    <td data-label="No"><?= $no++; ?></td>
                    <td data-label="Doctor Name"><?= htmlspecialchars($data['doctor']); ?></td>
                    <td data-label="Date"><?= htmlspecialchars($data['date']); ?></td>
                    <td data-label="Time"><?= htmlspecialchars($data['time']); ?></td>
                </tr>
                <?php
            }
        } else {
            echo "<tr><td colspan='4'>No appointments found for this patient.</td></tr>";
        }
        ?>
    </tbody>
</table>

            </table>
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
</body>
</html>
