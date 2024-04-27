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
    <title>Admin Profile</title>
   <link rel="stylesheet" href="a_profile.css">
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
            <h1>Admin Profile</h1>
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
