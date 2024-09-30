<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "vmehca";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $type = $_POST['type'];
  $message = $_POST['message'];

  $stmt = $conn->prepare("INSERT INTO signaling (type, message) VALUES (?, ?)");
  $stmt->bind_param("ss", $type, $message);

  if ($stmt->execute()) {
    echo "New record created successfully";
  } else {
    echo "Error: " . $stmt->error;
  }

  $stmt->close();
} else if ($_SERVER['REQUEST_METHOD'] === 'GET') {
  $sql = "SELECT * FROM signaling ORDER BY created_at DESC";
  $result = $conn->query($sql);

  $data = array();
  while ($row = $result->fetch_assoc()) {
    $data[] = $row;
  }
  echo json_encode($data);
}

$conn->close();
?>
