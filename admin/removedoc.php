<?php
    include('C:/xampp/htdocs/fyp/database/connectiondb.php');
    $sid = $_GET['stdid'];

    $sqldel = "DELETE FROM doctor WHERE id = '$sid'";
    $resuldel = $conn->query($sqldel);

    header('Location:docrec.php');
?>