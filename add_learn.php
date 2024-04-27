<!DOCTYPE html>
<html>
<head>
    <title>Add Learns Record</title>
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
        <h2>Add Student Subject Record</h2>
        <form method="post" action="">
            <label for="sid">Student ID:</label>
            <input type="text" id="sid" name="sid" required>
            <label for="subjectid">Subject ID:</label>
            <input type="text" id="subjectid" name="subjectid" required>
            <input type="submit" value="Add">
        </form>
    </div>
<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $sid = $_POST['sid'];
        $subjectid = $_POST['subjectid'];
        
        include('connection.php');
        $sql = "INSERT INTO learns(sid, subjectid) VALUES ('$sid', '$subjectid')";

        if ($conn->query($sql) == TRUE) {
            echo "<script>alert('Add Successful!');</script>";
        } else {
            echo "<script>alert('Add Unsucessful!');</script>";
        }
        $conn->close();
    }
?>
<footer>
    &copy; <?php echo date("Y"); ?> Student Information Management System By Nayan & Sabina 
</footer>
</body>
</html>
