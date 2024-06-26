<?php
session_start();
include('connection.php');

// Fetch user information
$username = $_SESSION['username'];
$sql = "SELECT u.name, s.sname, u.email, u.role, s.age, s.class, s.p_phoneno, s.s_phoneno, s.address 
        FROM users u 
        JOIN students s ON u.uid = s.uid 
        WHERE u.name = '$username'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $name = $row['name'];
    $sname = $row['sname'];
    $email = $row['email'];
    $role= $row['role'];
    $age = $row['age'];
    $class = $row['class'];
    $pphone = $row['p_phoneno'];
    $sphone= $row['s_phoneno'];
    $address = $row['address'];
}

// Fetch total number of courses
$total_courses_sql = "SELECT COUNT(*) AS total_courses 
                      FROM subjects 
                      WHERE subjectid IN (SELECT subjectid FROM learns WHERE sid = (SELECT sid FROM students WHERE uid = (SELECT uid FROM users WHERE name = '$username')))";
$total_courses_result = $conn->query($total_courses_sql);
$total_courses = 0;
if ($total_courses_result->num_rows > 0) {
    $total_courses_row = $total_courses_result->fetch_assoc();
    $total_courses = $total_courses_row['total_courses'];
}

// Fetch attendance rate
$attendance_rate_sql = "SELECT AVG(attendance) AS avg_attendance 
                        FROM attendance 
                        WHERE sid = (SELECT sid FROM students WHERE uid = (SELECT uid FROM users WHERE name = '$username'))";
$attendance_rate_result = $conn->query($attendance_rate_sql);
$attendance_rate = 0;
if ($attendance_rate_result->num_rows > 0) {
    $attendance_rate_row = $attendance_rate_result->fetch_assoc();
    $attendance_rate = $attendance_rate_row['avg_attendance'];
}

$conn->close();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Student Profile</title>
    <link rel="stylesheet" href="profile.css">
    <style>
        .container {
    display: flex;
    justify-content: space-between;
}
.content {
    margin-left: 250px; /* Adjusted to accommodate the sidebar width */
    padding: 20px;
}
.box {
    border: 1px solid #ccc;
    border-radius: 5px;
    padding: 10px;
    background-color: #f9f9f9;
    margin-bottom: 20px;
}

.container .box {
    width: 48%;
}

.content .student-info {
    display: flex;
    flex-wrap: wrap;
}

.content .student-info p {
    width: 50%;
    margin-bottom: 10px;
}

.content .additional-info {
    background-color: #3498db;
    color: #fff;
}

        
    </style>
</head>
<body>
    <div class="container">
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
                <h1>My Profile</h1>
            </div>
            <h2>My Info</h2> <br>
            <div class="box student-info">
                
                <p>User Name: <?php echo $name; ?></p>
                <p>Email: <?php echo $email; ?></p>
                <p>Role: <?php echo $role; ?></p>
                <p>Student Name: <?php echo $sname; ?></p>
                <p>Age: <?php echo $age; ?></p>
                <p>Class: <?php echo $class; ?></p>
                <p>Parent Phone No: <?php echo $pphone; ?></p>
                <p>My Phone No: <?php echo $sphone; ?></p>
                <p>Address: <?php echo $address; ?></p>
            </div>
            
            <div class="statistics">
                <div class="stat-box">
                    <div class="stat-number"><?php echo $total_courses; ?></div>
                    <div class="stat-text">Total Courses Taken</div>
                </div>
                <br>
                <div class="stat-box">
                    <div class="stat-number"><?php echo round($attendance_rate, 2); ?></div>
                    <div class="stat-text">Attendance Rate</div>
                </div>
        </div>
    </div>

    <footer>
        &copy; <?php echo date("Y"); ?> Student Information Management System 
    </footer>
</body>
</html>
