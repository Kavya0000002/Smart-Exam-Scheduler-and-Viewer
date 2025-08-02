<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Exam Schedule</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Roboto', sans-serif;
            color: #333;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 700px;
            margin: 50px auto;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
            animation: slidein 1s;
            background-image: linear-gradient(to bottom, #ffffff, #f8f9fa);
        }
        @keyframes slidein {
            from { transform: translateY(100%); }
            to { transform: translateY(0); }
        }
        h1 {
            text-align: center;
            margin-bottom: 10px;
        }
        .form-inline {
            justify-content: center;
        }
        .table-container {
            margin-top: 30px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            background-image: linear-gradient(to bottom, #ffffff, #f8f9fa);
        }
        table {
            width: 100%;
            border-collapse: collapse;
            background-image: linear-gradient(to bottom, #ffffff, #f8f9fa);
        }
        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ff4dff;
        }
        th {
            background-color: #1c1c1c;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #ffcd90;
        }
        tr:hover {
            animation: fadeIn 2s;
        }
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        .navbar {
            margin-bottom: 20px;
        }
        .navbar-nav {
            display: flex;
            justify-content: space-around;
            width: 100%;
        }
        .user-info {
            margin-bottom: 20px;
            padding: 10px;
            background-color: #ffffff;
            border: 1px solid #ccc;
            border-radius: 10px;
            text-align: left;
        }
        .user-info h2 {
            font-size: 1rem;
            margin: 5px 0;
        }
        .submenu {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
            z-index: 1;
        }
        .submenu a {
            float: none;
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
            text-align: left;
        }
        .submenu a:hover {
            background-color: #ddd;
        }
    </style>
</head>
<body>
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

    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        $regno = $_GET['regno'];

        // Fetch user details from student_master
        $sql = "SELECT name, username, regno, rollno, department FROM student_master WHERE regno = ?";
        $stmt = $conn->prepare($sql);
        if (!$stmt) {
            die("Prepare failed: " . $conn->error);
        }
        $stmt->bind_param("s", $regno);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            echo "<div class='user-info'>";
            echo "<h2>Username: {$user['username']}</h2>";
            echo "<h2>Register Number: {$user['regno']}</h2>";
            echo "<h2>Roll Number: {$user['rollno']}</h2>";
            echo "<h2>Department: {$user['department']}</h2>";
            echo "</div>";
        } else {
            echo "<p>User not found.</p>";
            exit();
        }
        $stmt->close();
    }

    $conn->close();
    ?>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="sem1Dropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Sem 1</a>
                    <div class="dropdown-menu" aria-labelledby="sem1Dropdown">
                        <a class="dropdown-item" href="#" onclick="fetchExams(1, 1)">IAT 1</a>
                        <a class="dropdown-item" href="#" onclick="fetchExams(1, 2)">IAT 2</a>
                        <a class="dropdown-item" href="#" onclick="fetchExams(1, 3)">IAT 3</a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="sem2Dropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Sem 2</a>
                    <div class="dropdown-menu" aria-labelledby="sem2Dropdown">
                        <a class="dropdown-item" href="#" onclick="fetchExams(2, 1)">IAT 1</a>
                        <a class="dropdown-item" href="#" onclick="fetchExams(2, 2)">IAT 2</a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="sem3Dropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Sem 3</a>
                    <div class="dropdown-menu" aria-labelledby="sem3Dropdown">
                        <a class="dropdown-item" href="#" onclick="fetchExams(3, 1)">IAT 1</a>
                        <a class="dropdown-item" href="#" onclick="fetchExams(3, 2)">IAT 2</a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="sem4Dropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Sem 4</a>
                    <div class="dropdown-menu" aria-labelledby="sem4Dropdown">
                        <a class="dropdown-item" href="#" onclick="fetchExams(4, 1)">IAT 1</a>
                        <a class="dropdown-item" href="#" onclick="fetchExams(4, 2)">IAT 2</a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="sem5Dropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Sem 5</a>
                    <div class="dropdown-menu" aria-labelledby="sem5Dropdown">
                        <a class="dropdown-item" href="#" onclick="fetchExams(5, 1)">IAT 1</a>
                        <a class="dropdown-item" href="#" onclick="fetchExams(5, 2)">IAT 2</a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="sem6Dropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Sem 6</a>
                    <div class="dropdown-menu" aria-labelledby="sem6Dropdown">
                        <a class="dropdown-item" href="#" onclick="fetchExams(6, 1)">IAT 1</a>
                        <a class="dropdown-item" href="#" onclick="fetchExams(6, 2)">IAT 2</a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="sem7Dropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Sem 7</a>
                    <div class="dropdown-menu" aria-labelledby="sem7Dropdown">
                        <a class="dropdown-item" href="#" onclick="fetchExams(7, 1)">IAT 1</a>
                        <a class="dropdown-item" href="#" onclick="fetchExams(7, 2)">IAT 2</a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="sem8Dropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Sem 8</a>
                    <div class="dropdown-menu" aria-labelledby="sem8Dropdown">
                        <a class="dropdown-item" href="#" onclick="fetchExams(8, 1)">IAT 1</a>
                        <a class="dropdown-item" href="#" onclick="fetchExams(8, 2)">IAT 2</a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container">
        <h1>Exam Schedule</h1>
        <div id="examSchedule" class="table-container"></div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function fetchExams(no_of_sem, iat) {
            $.ajax({
                url: 'fetch_schedule.php',
                type: 'POST',
                data: { no_of_sem: no_of_sem, iat: iat },
                success: function(response) {
                    $('#examSchedule').html(response);
                },
                error: function(error) {
                    console.error("Error fetching data:", error);
                }
            });
        }
    </script>
</body>
</html>
