<!DOCTYPE html>
<html>
<head>
    <title>Delete Information</title>
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
            <h1>Delete Information</h1>
        </div>
        
        <p>Choose which table to delete data from.</p>
        <div class="button-container">
            <button class="button" onclick="location.href='del_user.php';">Users</button>
            <button class="button" onclick="location.href='del_subject.php';">Subjects</button>
            <button class="button" onclick="location.href='del_student.php';">Students</button>
            <button class="button" onclick="location.href='del_learn.php';">Student Subjects</button>
            <button class="button" onclick="location.href='del_attendance.php';">Attendance</button>

        </div>
    </div>
    <footer>
        &copy; <?php echo date("Y"); ?> Student Information Management System By Nayan & Sabina 
    </footer>
</body>
</html>