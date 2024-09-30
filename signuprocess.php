<?php
session_start();
include('C:/xampp/htdocs/fyp/database/connectiondb.php');

if(isset($_POST['register'])){
    // receive input from HTML FORM
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = "patient";

    // Step 2: Declare session variables
    $_SESSION['name'] = $name;
    $_SESSION['email'] = $email;
    $_SESSION['password'] = $password;
    $_SESSION['role'] = $role;

    // Check if any field is empty
    if(empty($name) || empty($email) || empty($password)) {
        echo "<script>alert('Please enter all required info!');</script>";
        header('location:signup.php?incomplete=yes');
    } else {
        // Add data to the 'patient' table
        $cmdadd1 = "INSERT INTO patient (name, email, password) VALUES ('$name', '$email', '$password')";
        $cmdadd2 = "INSERT INTO user (username, password, role) VALUES ('$name', '$password', '$role')";

        // Execute both queries
        $result1 = $conn->query($cmdadd1);
        $result2 = $conn->query($cmdadd2);

        if($result1 && $result2){
            echo "<script>alert('Data has been recorded into the database!');</script>";
            ?>
            <html>
                <button onclick="window.location.href='signup.php'">Sign In</button>
            </html>
            <?php
        } else {
            echo "ERROR: Cannot add data to the database!";
        }
    }
} else {
    header('location:signup.php');
}
?>
