<?php
session_start();
include('C:/xampp/htdocs/fyp/database/connectiondb.php');

if (isset($_POST['edit'])) {  // When the edit form is submitted
    
    // Receive input from the HTML form
    $id = $_POST['stdid'];
    $name = $_POST['name'];
    $doctor = $_POST['doctor'];
    $date = $_POST['date'];
    $time = $_POST['time'];

    // Declare session variables
    $_SESSION['name'] = $name;
    $_SESSION['doctor'] = $doctor;
    $_SESSION['date'] = $date;
    $_SESSION['time'] = $time;

    // Check if all required fields are filled
    if (empty($name) || empty($date) || empty($time)) {
        ?>
        <script>
            alert("Please enter all required info!");
            window.location = "editrec.php?incomplete=yes&stdid=<?php echo $id; ?>";
        </script>
        <?php
        exit;
    } else {
        // Insert the appointment into the appointmentt table
        $cmdinsert = "INSERT INTO appointmentt (name, doctor, date, time) VALUES ('$name', '$doctor', '$date', '$time')";
        $resultInsert = $conn->query($cmdinsert);

        if ($resultInsert) {
            // Show success message and redirect
            ?>
            <script>
                alert("Successfully created a new appointment record!");
                window.location.href = "appoinrec.php?stdid=<?php echo $id; ?>";
            </script>
            <?php
        } else {
            echo "ERROR: Can't insert appointment data into the database!";
        }
    }
} else {
    header('Location: myhome.php');
    exit;
}
?>
