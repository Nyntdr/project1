<!DOCTYPE html>
<html>
<head>
    <title>Edit Information</title>
    <link rel="stylesheet" href="admin.css">
</head>
<body>
    <div class="sidebar">
        <a href="admindashboard.php">Admin Dashboard</a>
        <a href="users.php">Users</a>
        <a href="a_student.php">Students</a>
        <a href="a_subject.php">Subjects</a>
        <a href="a_profile.php">My Profile</a>
        <a href="login.php">Logout</a>  
    </div>

    <div class="content">
        <div class="header">
            <h1>Edit Information</h1>
        </div>
        
        <p>Choose which table to edit data in.</p>
        <div class="button-container">
            <button class="button" onclick="location.href='ed_user.php';">Users</button>
            <button class="button" onclick="location.href='ed_subject.php';">Subjects</button>
            <button class="button" onclick="location.href='ed_student.php';">Students</button>
            <!-- <button class="button" onclick="location.href='ed_learn.php';">Student Subjects</button> -->
            <button class="button" onclick="location.href='ed_attendance.php';">Attendance</button>
        </div>
    </div>
    <footer>
        &copy; <?php echo date("Y"); ?> Student Information Management System
    </footer>
</body>
</html>