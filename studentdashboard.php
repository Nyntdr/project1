<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Student Dashboard</title>
    <link rel="stylesheet" href="student.css">
</head>
<body>
    <div class="sidebar">
        <a href="studentdashboard.php">Student Dashboard</a>
        <a href="s_subject.php">My Subjects</a>
        <a href="notice.php">Notices</a>
        <a href="s_profile.php">My Profile</a>
        <a href="login.php">Logout</a> 
    </div>

    <div class="content">
        <div class="header">
            <h1>Student Dashboard</h1>
        </div>
        <p>Welcome to the Student dashboard,<b><?php echo $_SESSION['username']; ?></b>.</p>
        
    </div>
    <footer>
        &copy; <?php echo date("Y"); ?> Student Information Management System By Nayan & Sabina 
    </footer>
</body>
</html>

