<?php
include('C:/xampp/htdocs/fyp/database/connectiondb.php');
$sid = $_GET['stdid'];

$sqldisplay = "select*from patient where id ='$sid'";
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

    
    <title>Edit patient Info</title>
</head>

<body>
    <div class="container">
        <main class="form-wrapper">
            <h1 class="form-title">Edit patient Info</h1>
            <form name="editstd" method="post" action="editrecprocess.php" enctype="multipart/form-data">
                <div class="form-group">
                    <input type="hidden" class="input-field" name="stdid" value="<?= $row['id']; ?>">

                    <label for="name" class="input-label">Name</label>
                    <input type="text" class="input-field" id="name" name="name" placeholder="Name" value="<?= $row['name']; ?>" required>

                    <label for="doctor" class="input-label">Doctor</label>
                    <input type="text" class="input-field" id="doctor" name="doctor" placeholder="Doctor" value="<?= $row['doctor']; ?>" required>

                    <label for="diagnosis" class="input-label">Diagnosis</label>
                    <input type="text" class="input-field" id="diagnosis" name="diagnosis" placeholder="Diagnosis" value="<?= $row['diagnosis']; ?>" required>

                    <label for="treatment" class="input-label">Treatment</label>
                    <input type="text" class="input-field" id="treatment" name="treatment" placeholder="Treatment" value="<?= $row['treatment']; ?>" required>

                    <label for="medicine" class="input-label">Medicine</label>
                    <input type="text" class="input-field" id="medicine" name="medicine" placeholder="Medicine" value="<?= $row['medicine']; ?>" required>

                    <label for="dosage" class="input-label">Dosage</label>
                    <input type="text" class="input-field" id="dosage" name="dosage" placeholder="Dosage" value="<?= $row['dosage']; ?>" required>

                    <label for="frequency" class="input-label">Frequency</label>
                    <input type="text" class="input-field" id="frequency" name="frequency" placeholder="Frequency" value="<?= $row['frequency']; ?>" required>

                    <label for="duration" class="input-label">Duration</label>
                    <input type="text" class="input-field" id="duration" name="duration" placeholder="Duration" value="<?= $row['duration']; ?>" required>

                    <label for="instructions" class="input-label">Instructions</label>
                    <input type="text" class="input-field" id="instructions" name="instructions" placeholder="Instructions" value="<?= $row['instructions']; ?>" required>

                    <label for="notes" class="input-label">Notes</label>
                    <input type="text" class="input-field" id="notes" name="notes" placeholder="Notes" value="<?= $row['notes']; ?>" required>

                    <label for="date" class="input-label">Next Appointment Date</label>
                    <input type="date" class="input-field" id="date" name="date" value="<?= $row['date']; ?>" required>

                    <label for="time" class="input-label">Next Appointment Time</label>
                    <input type="time" class="input-field" id="time" name="time" value="<?= $row['time']; ?>" required>

                    <button type="submit" class="submit-button" name="edit">Save Changes</button>
                </div>
            </form>
        </main>
    </div>

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

</html>

</html>