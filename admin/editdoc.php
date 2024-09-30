<?php
include('C:/xampp/htdocs/fyp/database/connectiondb.php');
$sid = $_GET['stdid'];

// Fetch doctor details
$sqldisplay = "SELECT * FROM doctor WHERE id ='$sid'";
$resultdisplay = $conn->query($sqldisplay);

$row = $resultdisplay->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/fyp/css/style2.css">
    <link rel="icon" href="/fyp/img/tabicon.png">

    <title>Edit Doctor Info</title>
</head>

<body>
    <div class="container">
        <main class="form-wrapper">
            <h1 class="form-title">Edit Doctor Info</h1>
            <form name="editdoctor" method="post" action="editdocprocess.php" enctype="multipart/form-data">
                <div class="form-group">
                    <input type="hidden" class="input-field" name="stdid" value="<?= $row['id']; ?>">

                    <input type="text" class="input-field" name="name" placeholder="Name" value="<?= $row['name']; ?>" required>
                    <input type="email" class="input-field" name="email" placeholder="Email" value="<?= $row['email']; ?>" required>
                    <input type="password" class="input-field" name="password" placeholder="Password" value="<?= $row['password']; ?>" required>
                    
                    <button type="submit" class="submit-button" name="edit" value="Edit">Edit</button>
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
    </div>
</body>

</html>
