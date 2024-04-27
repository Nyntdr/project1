<?php
session_start();
include('connection.php');
$username = $_SESSION['username'];
$sql = "SELECT * FROM users WHERE name = '$username'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $name = $row['name'];
    $email = $row['email'];
    $role= $row['role'];
} 
$conn->close();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Student Profile</title>
   <link rel="stylesheet" href="a_profile.css">
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
            <h1>Student Profile</h1>
        </div>
        
        <div class="profile-info">
            <h2>Personal Information</h2>
            <p>Name: <?php echo $name; ?></p>
            <p>Email: <?php echo $email; ?></p>
            <p>Role: <?php echo $role; ?></p>
        </div>
    </div>
    <footer>
        &copy; <?php echo date("Y"); ?> Student Information Management System By Nayan & Sabina 
    </footer>
</body>
</html>
