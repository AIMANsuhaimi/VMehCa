<?php
include('C:/xampp/htdocs/fyp/database/connectiondb.php');
if (isset($_POST['cari'])) {
    $silacari = $_POST['sname'];
    $cmdselect = "select * from patient WHERE name LIKE '%$silacari%'";
} else {
    $cmdselect = "select * from patient";
}
?>

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
                <li><a  class="headnav1" href="home.php">Home</a></li>
                <li><a class="headnav1" href="about.php">About</a></li>
                <li><a class="headnav1" href="contact.html">Contact</a></li>
                <button class="logoutbtn" onclick="window.location.href='/fyp/logoutprocess.php';">logout</button>
            </ul>
        </nav>
    </header>
    <main>
        </form>
        <h2 class="title">Appointment history</h2>
        <form class="search-form" action="" method="post">
            <input class="search-input" type="search" placeholder="Enter Name" name="sname">
            <input class="search-submit" type="submit" name="cari" value="search">
        </form>

        <div class="search-container">
            </form>
        </div>
            <table>
                <thead>
                    <tr>
                        <th>no</th>
                        <th>Patient Name</th>
                        <th>doctor Name</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Actions</th>
                    </tr>
                    <?php
                    $no = 1;
                    //select record from table student
                    
                    $resultselect = $conn->query($cmdselect);

                    if ($resultselect->num_rows > 0) {
                        //display result
                        while ($data = $resultselect->fetch_assoc()) {

                            //call data dalam database
                            //echo $data['name']. "<br>";
                            //echo $data['matno']. "<br>";
                    

                            ?>
                        </thead>
                        <tbody>
                            <tr>
                                <td><?= $no; ?></td>
                                <td data-label="Patient Name"><?= $data['name']; ?></td>
                                <td data-label="Patient Name"><?= $data['doctor']; ?></td>
                                <td data-label="Date"><?= $data['date']; ?></td>
                                <td data-label="Time"><?= $data['time']; ?></td>
                                <td data-label="Actions" class="actions">
                                    <div class="action-buttons">
                                        <a class="loginbtns" href="detail.php?stdid=<?= $data['id'] ?>">View</a>
                                        <a class="loginbtns" href="editrec.php?stdid=<?= $data['id'] ?>">edit</a>
                                        <a class="loginbtns" href="history.php?stdid=<?= $data['id'] ?>">appointment history</a>
                                        <a class="loginbtns" href="newappoint.php?stdid=<?= $data['id'] ?>">setup appointment </a>

                                    </div>
                                </td>
                            </tr>
                            <?php
                            $no++;
                        }
                    } else {
                        echo "ERROR : Empty record";
                    }
                    ?>
                </tbody>
            </table>
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