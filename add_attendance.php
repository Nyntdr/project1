<!DOCTYPE html>
<html>
<head>
    <title>Add Attendance Record</title>
    <link rel="stylesheet" href="adding.css">     
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
    <div class="container">
        <h2>Add Attendance Record</h2>
        <form method="post" action="">
            <label for="sid">Student ID:</label>
            <input type="text" id="sid" name="sid" required>
            <label for="subject_name">Subject Name:</label>
            <input type="text" id="subject_name" name="subject_name" required>
            <label for="attendance">Attendance:</label>
            <input type="text" id="attendance" name="attendance" required>
            <input type="submit" value="Add">
        </form>
    </div>
<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $sid = $_POST['sid'];
        $subject_name = $_POST['subject_name'];
        $attendance = $_POST['attendance'];
        
        include('connection.php');
        $sql = "INSERT INTO attendance(sid, subject_name, attendance) VALUES ('$sid', '$subject_name', '$attendance')";

        if ($conn->query($sql) == TRUE) {
            echo "<script>alert('Add Successful!');</script>";
        } else {
            echo "<script>alert('Add Unsucessful!');</script>";
        }
        $conn->close();
    }
?>
<footer>
    &copy; <?php echo date("Y"); ?> Student Information Management System 
</body>
</html>
