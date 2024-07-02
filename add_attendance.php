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
            <select id="sid" name="sid" required>
                <option value="">Select Student</option>
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
                <option value="">Select Subject</option>
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
            
            <label for="attendance">Attendance(%):</label>
            <input type="text" id="attendance" name="attendance" pattern="[0-9]{1,3}" title="Attendance must be a number between 0 and 100" required max="100">
            
            <input type="submit" value="Add">
        </form>
    </div>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $sid = $_POST['sid'];
        $subjectid = $_POST['subjectid'];
        $attendance = $_POST['attendance'];
        
        // Validate attendance input
        if (!preg_match('/^[0-9]{1,3}$/', $attendance) || $attendance > 100) {
            echo "<script>alert('Attendance must be a number between 0 and 100!');</script>";
        } else {
            include_once('connection.php');
            
            // Fetch the subject_name based on subjectid
            $subject_sql = "SELECT subject_name FROM subjects WHERE subjectid = '$subjectid'";
            $subject_result = $conn->query($subject_sql);
            if ($subject_result->num_rows > 0) {
                $subject_row = $subject_result->fetch_assoc();
                $subject_name = $subject_row['subject_name'];
                
                // Fetch the id from the learns table based on sid and subjectid
                $learns_sql = "SELECT id FROM learns WHERE sid = '$sid' AND subjectid = '$subjectid'";
                $learns_result = $conn->query($learns_sql);
                
                if ($learns_result->num_rows > 0) {
                    $learns_row = $learns_result->fetch_assoc();
                    $id = $learns_row['id'];
                    
                    $check_sql = "SELECT * FROM attendance WHERE sid = '$sid' AND subject_name = '$subject_name'";
                    $check_result = $conn->query($check_sql);

                    if ($check_result->num_rows > 0) {
                        echo "<script>alert('This attendance record already exists!');</script>";
                    } else {
                        $sql = "INSERT INTO attendance (id, sid, subject_name, attendance) VALUES ('$id', '$sid', '$subject_name', '$attendance')";
                        if ($conn->query($sql) === TRUE) {
                            echo "<script>alert('Add Successful!');</script>";
                        } else {
                            echo "<script>alert('Add Unsuccessful!');</script>";
                        }
                    }
                } else {
                    echo "<script>alert('Student does not learn this subject to add attendance!');</script>";
                }
            } else {
                echo "<script>alert('Invalid subject selected!');</script>";
            }
            $conn->close();
        }
    }
    ?>

    <footer>
        &copy; <?php echo date("Y"); ?> Student Information Management System 
    </footer>
</body>
</html>
