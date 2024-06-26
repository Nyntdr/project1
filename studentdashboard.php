<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Student Dashboard</title>
    <link rel="stylesheet" href="student.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        .box {
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-bottom: 20px;
            padding: 10px;
            background-color: #f9f9f9;
            text-align: center;
            color: #333; /* Changed text color */
        }
        .container {
            display: flex;
            justify-content: space-between;
        }
        .container .box {
            width: 48%;
            margin: 0 auto; /* Center the box */
        }
        #attendanceChart {
            width: 200px;
            height: 200px;
        }
        .subject-list {
            list-style-type: none;
            padding: 0;
        }
        .subject-list li {
            margin-bottom: 5px;
        }
        .welcome {
            margin-bottom: 20px;
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
            <h1>Student Dashboard</h1>
        </div>
        
        <div class="welcome">
            <h2>Welcome to the Student dashboard, <b><?php echo $_SESSION['username']; ?></b>.</h2>
        </div>

        <div class="container">
            <div class="box" style="background-color: #dff0d8;">
                <h2>My Subjects</h2>
                <ul class="subject-list">
                    <?php
                    include('connection.php');
                    $username = $_SESSION['username'];
                    $user_query = "SELECT s.sid FROM students as s join users as u on u.uid=s.uid WHERE u.name= '$username'";
                    $user_result = $conn->query($user_query);
                    if ($user_result->num_rows > 0) {
                        $user_row = $user_result->fetch_assoc();
                        $student_id = $user_row['sid'];
                        $subject_query = "SELECT s.subject_name
                                          FROM subjects as s JOIN learns as l ON s.subjectid = l.subjectid 
                                          WHERE l.sid = $student_id";
                        $subject_result = $conn->query($subject_query);
                        if ($subject_result->num_rows > 0) {
                            while($row = $subject_result->fetch_assoc()) {
                                echo "<li>".$row["subject_name"]."</li>";
                            }
                        } else {
                            echo "<li>No subjects found</li>";
                        }
                    } else {
                        echo "<li>User not found</li>";
                    }
                    echo"<a href='s_subject.php'> For more deatils, Visit the Subject tab.</a>";
                    ?>
                </ul>
            </div>

            <div class="box" style="background-color: #d9edf7;">
                <h2>Recent Notice</h2>
                <?php
                $notice_query = "SELECT * FROM notice ORDER BY id DESC LIMIT 1";
                $notice_result = $conn->query($notice_query);
                if ($notice_result->num_rows > 0) {
                    $notice_row = $notice_result->fetch_assoc();
                    echo "<p><b>" ." ". $notice_row["title"]." " . "</b></p>";
                    echo "<p>" . $notice_row["description"] . "</p>";
                    echo "<p>" . $notice_row["date"] . "</p>";
                } else {
                    echo "<p>No notices found</p>";
                }
                echo"<a href='notice.php'> For more deatils, Visit the Notice tab.</a>";
                ?>
            </div>
        </div>

        <div class="box" style="background-color: #fcf8e3;">
            <h2>Attendance Chart(%)</h2>
            <?php
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
            echo"<a href='attendance_graph.php'> For more deatils, Visit the Attendance tab.</a>";

            $conn->close();
            ?>
            <canvas id="attendanceChart" width="400" height="400"></canvas>

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
        </div>

    </div>

    <footer>
        &copy; <?php echo date("Y"); ?> Student Information Management System 
    </footer>
</body>
</html>
