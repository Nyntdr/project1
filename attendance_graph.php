<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Attendance Graph</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
       .header {
            background-color: #333;
            color: #fff;
            padding: 20px;
            text-align: center;
        }
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .sidebar {
            height: 100%;
            width: 250px;
            position: fixed;
            top: 0;
            left: 0;
            background-color: #111;
            padding-top: 20px;
        }
        .sidebar a {
            padding: 10px;
            text-decoration: none;
            font-size: 18px;
            color: #ccc;
            display: block;
        }
        .sidebar a:hover {
            background-color: #444;
        }
        .content {
            margin-left: 250px;
            padding: 20px;
            padding-bottom: 300px; /* Adjusted padding to accommodate resized chart and description */
            position: relative;
        }
        footer {
            background-color: #333;
            color: #fff;
            text-align: center;
            padding: 10px 0;
            position: fixed;
            bottom: 0;
            width: 100%;
            z-index: 0; /* Ensure footer is below other content */
        }
        canvas {
            max-width: 560px; /* Decreased width by 30% */
            margin: 20px auto;
            display: block;
            height: 280px; /* Decreased height by 30% */
        }
        .caption {
            text-align: center;
            color: #666;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <a href="studentdashboard.php">Student Dashboard</a>
        <a href="s_subject.php">My Subjects</a>
        <a href="attendance_graph.php">Attendance</a>
        <a href="notice.php">Notices</a>
        <a href="s_profile.php">My Profile</a>
        <a href="login.php">Logout</a>  
    </div>

    <div class="content">
        <div class="header">
            <?php
                session_start();
                if(isset($_SESSION['username'])) {
                    echo '<h1>Student Attendance Graph - ' . $_SESSION['username'] . '</h1>';
                } else {
                    echo '<h1>Student Attendance Graph</h1>';
                }
                include('connection.php');
                if(isset($_SESSION['username'])) {
                    $username = $_SESSION['username'];
                    $user_query = "SELECT s.sid FROM students as s join users as u on u.uid=s.uid WHERE u.name= '$username'";
                    $user_result = $conn->query($user_query);
                    if ($user_result->num_rows > 0) {
                        $user_row = $user_result->fetch_assoc();
                        $student_id = $user_row['sid'];
                        $attendance_query = "SELECT subject_name, attendance FROM attendance WHERE sid = $student_id";
                        $attendance_result = $conn->query($attendance_query);

                        $subject_names = [];
                        $attendance_data = [];

                        if ($attendance_result->num_rows > 0) {
                            
                            while($row = $attendance_result->fetch_assoc()) {
                                $subject_names[] = $row["subject_name"];
                                $attendance_data[] = $row["attendance"];
                            }
                        } else {
                            
                            echo "No attendance records found for this user.";
                        }
                    } else {
                        echo "User not found in the database.";
                    }
                } else {
                    echo "Username not set in the session.";
                }

                $conn->close();
            ?>
        </div>

        <div class="caption">
        <?php
        // Calculate the average attendance percentage
        $totalAttendance = array_sum($attendance_data);
        $averageAttendance = $totalAttendance / count($attendance_data);

        // Check attendance level and provide suggestions
        $suggestion = "";
        if ($averageAttendance >= 80) {
            $suggestion = "Congratulations! You have excellent attendance. Keep up the good work!";
            $color = "green";
        } elseif ($averageAttendance >= 50) {
            $suggestion = "Well done! Your attendance is good. Keep attending classes regularly to maintain your performance.";
            $color = "yellow";
        } else {
            $suggestion = "Your attendance is low. Please make sure to attend classes regularly and work hard to improve your attendance.";
            $color = "red";
        }

        echo "<p style='color: $color;'>Average Attendance Rate: " . number_format($averageAttendance, 2) . "%</p>";
        echo "<p style='color: $color;'>$suggestion</p>";
        ?>
    </div>
        
        <canvas id="attendanceChart"></canvas>
    </div>

    <footer>
        &copy; <?php echo date("Y"); ?> Student Information Management System 

    <script>
        var ctx = document.getElementById('attendanceChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: <?php echo json_encode($subject_names); ?>,
                datasets: [{
                    label: 'Attendance (%)',
                    data: <?php echo json_encode($attendance_data); ?>,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</body>
</html>
