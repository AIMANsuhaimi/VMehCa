<?php
session_start();
include('C:/xampp/htdocs/fyp/database/connectiondb.php');

if (isset($_POST['edit'])) {  //nama button (submit input)
    
    // receive input from HTML FORM
    // super global variable: $_POST, $_GET

    $id = $_POST['stdid'];
    $name = $_POST['name'];
    $doctor = $_POST['doctor'];
    $date = $_POST['date'];
    $time = $_POST['time'];


    //step 2 declare session variables
    $_SESSION['name'] = $_POST['name'];
    $_SESSION['doctor'] = $_POST['doctor'];
    $_SESSION['date'] = $_POST['date'];
    $_SESSION['time'] = $_POST['time'];


    if (empty($name && $date && $time)) {
        ?>
        <script>
            alert("Please enter all required info!");
            //window.location="stdform.php";
        </script>
        <?php
        header('location:editrec.php?incomplete=yes&stdid='.$id);
        
    } else {
        //add data to table student
        $cmdedit = "UPDATE patient SET  
                    name ='$name',
                    doctor ='$doctor',
                    date='$date',
                    time='$time'";
        $result = $conn->query($cmdedit);

        if ($result) {
            ?>
            <script>
                alert("sucessfully update to database!");
            </script>
            
            <?php
            
        } else {        
            echo "ERROR:cant update data onto data base!";
        }
    }
} else {
    header('location:myhome.php');
}
?>