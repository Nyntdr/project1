<!DOCTYPE html>
<html>
<head>
    <title>Add Subject</title>
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

    <div class="content">
        <div class="header">
            <h1>Add Subject</h1>
        </div>
        
        <div class="container">
        <h2>Add Subject</h2>
            <form method="post" action="">
                <label for="subject_name">Subject Name:</label>
                <input type="text" id="subject_name" name="subject_name" required>
                <label for="scode">Subject Code:</label>
                <input type="text" id="scode" name="scode" required>
                <label for="credit_hour">Credit Hour:</label>
                <input type="text" id="credit_hour" name="credit_hour" required>
                <label for="theory">Theory:</label>
                <input type="text" id="theory" name="theory" required>
                <label for="practical">Practical:</label>
                <input type="text" id="practical" name="practical" required>
                <input type="submit" value="Add Subject">
            </form>
        </div>

        <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $subject_name = $_POST['subject_name'];
                $scode = $_POST['scode'];
                $credit_hour = $_POST['credit_hour'];
                $theory = $_POST['theory'];
                $practical = $_POST['practical'];
                
                include('connection.php');
                $sql = "INSERT INTO subjects (subject_name, scode, credit_hour, theory, practical) 
                        VALUES ('$subject_name', '$scode', '$credit_hour', '$theory', '$practical')";
                
                if ($conn->query($sql) === TRUE) {
                    echo "<script>alert('Subject added successfully!');</script>";
                } else {
                    echo "<script>alert('Error: " . $sql . "<br>" . $conn->error . "');</script>";
                }
                
                $conn->close();
            }
        ?>
    </div>

    <footer>
        &copy; <?php echo date("Y"); ?> Student Information Management System By Nayan & Sabina 
    </footer>
</body>
</html>


