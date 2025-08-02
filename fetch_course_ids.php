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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $batch = $_POST['batch'];
    $sem = $_POST['sem'];
    $no_of_sem = $_POST['no_of_sem'];

    echo "Batch: $batch, Sem: $sem, No of Sem: $no_of_sem"; // Debugging line

    $sql = "SELECT course_id 
            FROM course_master 
            WHERE batch = ? AND sem = ? AND no_of_sem = ?";
    

    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $batch, $sem, $no_of_sem);
    $stmt->execute();
    $result = $stmt->get_result();

    echo "<option value=''>Select Course ID</option>";
    while ($row = $result->fetch_assoc()) {
        echo "<option value='" . $row['course_id'] . "'>" . $row['course_id'] . "</option>";
    }

    $stmt->close();
}

$conn->close();
?>
