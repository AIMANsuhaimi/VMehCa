<?php
session_start();
include('C:/xampp/htdocs/fyp/database/connectiondb.php');

if (isset($_POST['edit'])) {  // When the edit form is submitted

    // Receive input from the HTML form
    $id = $_POST['stdid'];
    $name = $_POST['name'];
    $doctor = $_POST['doctor'];
    $diagnosis = $_POST['diagnosis'];
    $treatment = $_POST['treatment'];
    $medicine = $_POST['medicine'];
    $dosage = $_POST['dosage'];
    $frequency = $_POST['frequency'];
    $duration = $_POST['duration'];
    $instructions = $_POST['instructions'];
    $notes = $_POST['notes'];
    $date = $_POST['date'];
    $time = $_POST['time'];

    // Declare session variables
    $_SESSION['name'] = $name;
    $_SESSION['doctor'] = $doctor;
    $_SESSION['treatment'] = $treatment;
    $_SESSION['medicine'] = $medicine;
    $_SESSION['dosage'] = $dosage;
    $_SESSION['frequency'] = $frequency;
    $_SESSION['duration'] = $duration;
    $_SESSION['instructions'] = $instructions;
    $_SESSION['notes'] = $notes;
    $_SESSION['date'] = $date;
    $_SESSION['time'] = $time;

    // Check if all required fields are filled
    if (empty($name) || empty($date) || empty($time) || empty($diagnosis) || empty($treatment) || empty($medicine) || empty($dosage) || empty($frequency) || empty($notes)) {
        // Redirect to the edit page with an incomplete parameter
        header("Location: editrec.php?incomplete=yes&stdid=$id");
        exit;
    } else {
        // Update the patient table
        $cmdedit = "UPDATE patient SET  
                    name ='$name',
                    doctor ='$doctor',
                    diagnosis ='$diagnosis',
                    treatment ='$treatment',
                    medicine ='$medicine',
                    dosage ='$dosage',
                    frequency ='$frequency',
                    duration ='$duration',
                    instructions ='$instructions',
                    notes ='$notes',
                    date='$date',
                    time='$time'
                    WHERE id='$id'";
        
        // Execute the update query
        $result = $conn->query($cmdedit);

        if ($result) {
            // Insert the appointment into the appointmentt table
            $cmdinsert = "INSERT INTO appointmentt (name, doctor, date, time) VALUES ('$name', '$doctor', '$date', '$time')";
            $resultInsert = $conn->query($cmdinsert);

            if ($resultInsert) {
                // Show success message and redirect
                echo "<script>
                        alert('Successfully updated the database!');
                        window.location.href = 'appoinrec.php';
                      </script>";
                exit;
            } else {
                echo "ERROR: Can't insert appointment data into the database!";
            }
        } else {
            echo "ERROR: Can't update patient data in the database!";
        }
    }
} else {
    header('Location: myhome.php');
    exit;
}
?>
