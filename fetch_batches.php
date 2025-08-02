<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "stud";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT DISTINCT batch FROM student_master";
$result = $conn->query($sql);

$batches = [];
while ($row = $result->fetch_assoc()) {
    $batches[] = $row['batch'];
}

$conn->close();

echo json_encode($batches);
?>
