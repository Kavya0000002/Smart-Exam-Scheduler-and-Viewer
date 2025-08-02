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
    $course_id = $_POST['course_id'];
    $sem = $_POST['sem'];
    $sem_number = $_POST['sem_number'];
    $batch = $_POST['batch'];
    $exam_date = $_POST['exam_date'];
    $iat =$_POST['iat'];


    // Check if exam is already scheduled on the same date
    $sql = "SELECT COUNT(*) AS count
            FROM exam_schedule
            WHERE exam_date = ?";

    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }
    $stmt->bind_param("s", $exam_date);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    if ($row['count'] > 0) {
        // Check for conflicting enrollments
        $sql = "SELECT COUNT(*) AS count
                FROM course_enroll_master ce1
                WHERE ce1.regno IN (
                    SELECT ce2.regno
                    FROM course_enroll_master ce2
                    WHERE ce2.course_id = ?
                )
                AND ce1.course_id IN (
                    SELECT course_id
                    FROM exam_schedule
                    WHERE exam_date = ?
                )";

        $stmt = $conn->prepare($sql);
        if (!$stmt) {
            die("Prepare failed: " . $conn->error);
        }
        $stmt->bind_param("ss", $course_id, $exam_date);

        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        if ($row['count'] > 0) {
            echo "Cannot allot exam due to conflicting enrollments.";
            exit(); // Exit the script to prevent further execution
        }
    }

    // No conflict, schedule the exam
    $sql = "INSERT INTO exam_schedule (course_id, exam_date, sem, no_of_sem, batch, iat) VALUES (?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }
    $stmt->bind_param("ssssss", $course_id, $exam_date, $sem, $sem_number, $batch, $iat);

    if ($stmt->execute()) {
        if ($stmt->affected_rows > 0) {
            echo "<script>alert('Exam successfully scheduled.'); window.location.href = 'allot_exam.html';</script>";
        } else {
            echo "<script>alert('Exam scheduling failed, no rows affected. Please check the course ID and try again.'); window.location.href = 'allot_exam.html';</script>";
        }
    } else {
        echo "<script>alert('Error scheduling exam: " . $stmt->error . "'); window.location.href = 'allot_exam.html';</script>";
    }
    
    $stmt->close();
}

$conn->close();
?>
