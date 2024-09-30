<?php
include('database/connectiondb.php');

if (isset($_POST['signin'])) {
    // Declare variables
    $username = $_POST['username'];
    $pass = $_POST['password'];

    // Check if inputs are empty
    if (empty($username) || empty($pass)) {
        echo "Please enter your username and password";
    } else {
        // Prepare SQL statement
        $sql = "SELECT id, role FROM user WHERE username = ? AND password = ?";
        $stmt = $conn->prepare($sql);

        // Check if the statement was prepared correctly
        if ($stmt === false) {
            die('Prepare failed: ' . htmlspecialchars($conn->error));
        }

        // Bind parameters and execute statement
        $stmt->bind_param('ss', $username, $pass);
        $stmt->execute();
        $result = $stmt->get_result();

        // Check if user exists and fetch role
        if ($result->num_rows > 0) {
            $data = $result->fetch_assoc();

            // Start session and store user details
            session_start();
            $_SESSION['user_id'] = $data['id']; // Store user ID
            $_SESSION['role'] = $data['role'];
            $_SESSION['username'] = $username;  // Store username

            // Redirect based on role, include user_id in URL
            if ($data['role'] == 'patient') {
                header('Location: patient/home.php?user_id=' . urlencode($data['id']));
            } elseif ($data['role'] == 'nurse') {
                header('Location: nurse/home.php?user_id=' . urlencode($data['id']));
            } elseif ($data['role'] == 'doctor') {
                header('Location: doctor/home.php?user_id=' . urlencode($data['id']));
            } elseif ($data['role'] == 'admin') {
                header('Location: admin/home.php?user_id=' . urlencode($data['id']));
            }

            exit();
        } else {
            // Incorrect username or password
            echo '<script type="text/javascript">alert("Incorrect username or password. Please try again.");</script>';
            header('Refresh: 0; URL=home1.php');
            exit();
        }
    }
}
?>
