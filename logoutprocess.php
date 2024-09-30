<?php
// Start the session
session_start();

// Destroy all sessions and log out the user
session_destroy();

// Redirect to login page (change this to your login page if different)
header("Location: /fyp/home1.php");
exit();
?>
