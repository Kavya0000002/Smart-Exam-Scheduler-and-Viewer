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
    $no_of_sem = $_POST['no_of_sem'];
    $iat = $_POST['iat'];

    // Fetch exams based on no_of_sem and iat, along with course_name and course_code
    $sql = "SELECT es.exam_id, es.exam_date, es.course_id, cm.course_name, cm.course_code
            FROM exam_schedule es
            JOIN course_master cm ON es.course_id = cm.course_id
            WHERE es.no_of_sem = ? AND es.iat = ? 
            ORDER BY es.exam_date";

    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }
    $stmt->bind_param("ii", $no_of_sem, $iat);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "<table class='table table-bordered'>";
        echo "<tr>
                <th>Exam ID</th>
                <th>Course ID</th>
                <th>Course Name</th>
                <th>Course Code</th>
                <th>Exam Date</th>
              </tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['exam_id']}</td>
                    <td>{$row['course_id']}</td>
                    <td>{$row['course_name']}</td>
                    <td>{$row['course_code']}</td>
                    <td>{$row['exam_date']}</td>
                  </tr>";
        }
        echo "</table>";
    } else {
        echo "<p>No exams scheduled for the selected criteria.</p>";
    }

    $stmt->close();
}

$conn->close();
?>
