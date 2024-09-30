<?php
include('C:/xampp/htdocs/fyp/database/connectiondb.php');
$sid = $_GET['stdid'];

$sqldisplay = "select*from patient where id ='$sid'";
$resultdisplay = $conn->query($sqldisplay);

$row = $resultdisplay->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=ytr, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="/fyp/css/style.css">
    <link rel="icon" href="/fyp/img/tabicon.png">

</head>

<body class="div">
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
    
<h2 class="title">Student Form</h2>
<table border="1" class="table  ">

    <tr>
        <td class="main">name</td>
        <td><?= $row['name']; ?></td>
    <tr>
        <td class="main">doctor</td>
        <td><?= $row['doctor']; ?></td>
    </tr>
    <tr>
        <td class="main">diagnosis</td>
        <td><?= $row['diagnosis']; ?></td>
    </tr>
    <tr>
        <td class="main">treatment</td>
        <td><?= $row['treatment']; ?></td>
    </tr>
    <tr>
        <td class="main">medicine</td>
        <td><?= $row['medicine']; ?></td>
    </tr>
    <tr>
        <td class="main">dosage</td>
        <td><?= $row['dosage']; ?></td>
    </tr>
    <tr>
        <td class="main">frequency</td>
        <td><?= $row['frequency']; ?></td>
    </tr>
    <tr>
        <td class="main">duration</td>
        <td><?= $row['duration']; ?></td>
    </tr>
    <tr>
        <td class="main">instructions</td>
        <td><?= $row['instructions']; ?></td>
    </tr>
    <tr>
        <td class="main">notes</td>
        <td><?= $row['notes']; ?></td>
    </tr>
    <tr>
        <td class="main">next appointment</td>
        <td><?= $row['date']; ?></td>
    </tr>
    <tr>
        <td class="main">time</td>
        <td><?= $row['time']; ?></td>
    </tr>

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