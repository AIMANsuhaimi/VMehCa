<?php
session_start();
include('C:/xampp/htdocs/fyp/database/connectiondb.php');

if (isset($_POST['edit'])) {  // Check if the form was submitted
    
    // Receive input from HTML FORM
    $id = $_POST['stdid'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Step 2: Declare session variables
    $_SESSION['name'] = $name;
    $_SESSION['email'] = $email;
    $_SESSION['password'] = $password;

    // Check if any required fields are empty
    if (empty($name) || empty($email) || empty($password)) {
        ?>
        <script>
            alert("Please enter all required info!");
            window.location.href = 'editrec.php?empty=yes&stdid=<?= $id ?>';
        </script>
        <?php
    } else {
        // Update data in the nurse2 table
        $cmdedit = "UPDATE nurse2 SET  
                    username = '$name',
                    email = '$email',
                    password = '$password'
                    WHERE id = '$id'";

        $result = $conn->query($cmdedit);

        if ($result) {
            ?>
            <script>
                alert("Successfully updated in the database!");
                window.location.href = 'nurserec.php'; // Redirect to a success page or any other page
            </script>
            <?php
        } else {
            echo "ERROR: Can't update data in the database!";
        }
    }
} else {
    header('location:myhome.php');
}
?>
