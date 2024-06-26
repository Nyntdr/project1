<!DOCTYPE html>
<html>
<head>
    <title>Add Information</title>
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
            <h1>Add Information</h1>
        </div>
        
        <p>Choose which table to add data in.</p>
        <div class="button-container">
            <button class="button" onclick="location.href='add_user.php';">Users</button>
            <button class="button" onclick="location.href='add_subject.php';">Subjects</button>
            <button class="button" onclick="location.href='add_student.php';">Students</button>
            <button class="button" onclick="location.href='add_learn.php';">Student Subject</button>
            <button class="button" onclick="location.href='add_attendance.php';">Attendance</button>
        </div>
    </div>
    <footer>
        &copy; <?php echo date("Y"); ?> Student Information Management System 
    </footer>
</body>
</html>