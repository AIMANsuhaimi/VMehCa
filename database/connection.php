<?php
//create connection to MYSQL
$hostname = "localhost";
$username = "root";
$password = "";

$conn = mysqli_connect($hostname, $username, $password);

if ($conn) {
    echo "Successfully connected to the MYSQL!<br>  ";
    //command to creare a database
    $cmddb = "CREATE DATABASE poliperlis";
    $resultdb = $conn->query($cmddb);//cmd to  execute sql statement is function query()
    if ($resultdb) {
        echo "<br>SUCSESSFULLY CREATE THE DATABASE!";
    } else {
        echo "<br>ERROR: cant create database";
    }
} else {
    echo "ERROR:connect to mysql";
}

?>