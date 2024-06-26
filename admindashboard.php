<?php
session_start(); 
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="admin.css">
</head>
<body>
    <div class="sidebar">
        <a href="admindashboard.php">Admin Dashboard</a>
        <a href="users.php">Users</a>
        <a href="a_student.php">Students</a>
        <a href="a_subject.php">Subjects</a>
        <a href="a_profile.php">My Profile</a>
        <a href="a_notice.php">Notice Management</a> 
        <a href="login.php">Logout</a>  
    </div>

    <div class="content">
        <div class="header">
            <h1>Admin Dashboard</h1>
        </div>
        
        <p>Welcome to the Admin dashboard, <b><?php echo $_SESSION['username']; ?></b>.</p>
        <div class="button-container">
            <button class="button" onclick="location.href='add.php';">Add Information</button>
            <button class="button delete-button" onclick="location.href='delete.php';">Delete Information</button>
            <button class="button" onclick="location.href='edit.php';">Edit Information</button>
        </div>
    </div>
    <footer>
        &copy; <?php echo date("Y"); ?> Student Information Management System 
</body>
</html>