<?php
    include('C:/xampp/htdocs/fyp/database/connectiondb.php');
    $sid = $_GET['stdid'];

    $sqldel = "DELETE FROM patient WHERE id = '$sid'";
    $resuldel = $conn->query($sqldel);

    header('Location: /fyp/nurse/appoinrec.php');
?>