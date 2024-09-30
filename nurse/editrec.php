<?php
include('C:/xampp/htdocs/fyp/database/connectiondb.php');
$sid = $_GET['stdid'];

$sqldisplay = "select*from patient where id ='$sid'";
$resultdisplay = $conn->query($sqldisplay);

$row = $resultdisplay->fetch_assoc();
?>

<html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/fyp/css/style2.css">
    <link rel="icon" href="/fyp/img/tabicon.png">

    <title>Home</title>
</head>

<head>
    <title>patient Form</title>
</head>

<body>
    <div class="container">
        <main class="form-wrapper">
            <h1 class="form-title">edit patient info</h1>
            <form name="editstd" method="post" action="editrecprocess.php" enctype="multipart/form-data">
                <div class="form-group">
                        <input type="hidden"class="input-field" name="stdid" value="<?= $row['id']; ?>">

                        <input type="text"class="input-field" name="name" placeholder="Name" value="<?= $row['name']; ?>" required>
                        <input type="text" class="input-field" name="doctor" placeholder="Name" value="<?= $row['doctor']; ?>" required>

                        <input type="date" class="input-field" name="date" placeholder="Email" value="<?= $row['date']; ?>" required>
                        <input type="time" class="input-field" name="time" placeholder="Username" value="<?= $row['time']; ?>" required>
                        <button type="submit" class="submit-button" name="edit" value="Register Student">edit</button>

                    </div>
                </div>

            </form>
        </main>
        <?php
        if (@$_GET['empty'] == 'yes') {
            ?>
            <script>
                alert("Please enter all required info!");
            </script>
            <?php
        }
        ?>
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