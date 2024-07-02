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
            <label for="sid">Student:</label>
            <select id="sid" name="sid" required>
                <option value="">Select Student  (Student ID - Student Name)</option>
                <?php
                include_once('connection.php');
                $sql_students = "SELECT sid, sname FROM students";
                $result_students = $conn->query($sql_students);
                if ($result_students && $result_students->num_rows > 0) {
                    while ($row = $result_students->fetch_assoc()) {
                        echo "<option value='" . $row['sid'] . "'>" . $row['sid'] . " - " . $row['sname'] . "</option>";
                    }
                } else {
                    echo "<option value=''>No students found</option>";
                }
                ?>
            </select>
            
            <label for="subjectid">Subject:</label>
            <select id="subjectid" name="subjectid" required>
                <option value="">Select Subject (Subject ID - Subject Name)</option>
                <?php
              
                $sql_subjects = "SELECT subjectid, subject_name FROM subjects";
                $result_subjects = $conn->query($sql_subjects);
                if ($result_subjects && $result_subjects->num_rows > 0) {
                    while ($row = $result_subjects->fetch_assoc()) {
                        echo "<option value='" . $row['subjectid'] . "'>" . $row['subjectid'] . " - " . $row['subject_name'] . "</option>";
                    }
                } else {
                    echo "<option value=''>No subjects found</option>";
                }
                ?>
            </select>
            
            <input type="submit" value="Add">
        </form>
    </div>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $sid = $_POST['sid'];
        $subjectid = $_POST['subjectid'];
        
        include_once('connection.php');
        $check_sql = "SELECT * FROM learns WHERE sid = '$sid' AND subjectid = '$subjectid'";
        $check_result = $conn->query($check_sql);

        if ($check_result->num_rows > 0) {
            echo "<script>alert('This Student ID and Subject ID combination already exists!');</script>";
        } else {
            $sql = "INSERT INTO learns (sid, subjectid) VALUES ('$sid', '$subjectid')";
            
            if ($conn->query($sql) === TRUE) {
                echo "<script>alert('Add Successful!');</script>";
            } else {
                echo "<script>alert('Add Unsuccessful!');</script>";
            }
        }

        $conn->close();
    }
    ?>

    <footer>
        &copy; <?php echo date("Y"); ?> Student Information Management System 
    </footer>
</body>
</html>
