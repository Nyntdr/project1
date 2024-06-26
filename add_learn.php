<!DOCTYPE html>
<html>
<head>
    <title>Add Learns Record</title>
    <link rel="stylesheet" href="adding.css">
    <script>
        function fetchStudentDetails() {
            var sid = document.getElementById('sid').value;
            if (sid) {
                var xhr = new XMLHttpRequest();
                xhr.open('GET', 'add_learns_record.php?action=fetch_details&sid=' + sid, true);
                xhr.onreadystatechange = function() {
                    if (xhr.readyState == 4 && xhr.status == 200) {
                        var response = JSON.parse(xhr.responseText);
                        if (response.success) {
                            document.getElementById('studentName').value = response.student_name;
                            var subjectSelect = document.getElementById('subjectName');
                            subjectSelect.innerHTML = ''; // Clear previous options
                            response.subjects.forEach(function(subject) {
                                var option = document.createElement('option');
                                option.value = subject.subject_name;
                                option.textContent = subject.subject_name;
                                subjectSelect.appendChild(option);
                            });
                        } else {
                            document.getElementById('studentName').value = '';
                            document.getElementById('subjectName').innerHTML = '';
                            alert('Student not found');
                        }
                    }
                };
                xhr.send();
            }
        }
    </script>
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
        <form method="post" action="add_learns_record.php">
            <label for="sid">Student ID:</label>
            <input type="text" id="sid" name="sid" required onblur="fetchStudentDetails()">
            <label for="studentName">Student Name:</label>
            <input type="text" id="studentName" name="studentName" readonly>
            <label for="subjectName">Subject:</label>
            <select id="subjectName" name="subjectName" required></select>
            <input type="submit" value="Add">
        </form>
    </div>

<?php
include('connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $sid = $_POST['sid'];
    $subjectName = $_POST['subjectName'];

    // Check if the student-subject combination already exists
    $checkSql = "SELECT * FROM learns INNER JOIN subjects ON learns.subjectid = subjects.subjectid WHERE sid='$sid' AND subjects.subject_name='$subjectName'";
    $checkResult = $conn->query($checkSql);

    if ($checkResult->num_rows > 0) {
        echo "<script>alert('This student is already enrolled in this subject.');</script>";
    } else {
        // Get the subject ID from the subject name
        $subjectSql = "SELECT subjectid FROM subjects WHERE subject_name='$subjectName'";
        $subjectResult = $conn->query($subjectSql);
        if ($subjectResult->num_rows > 0) {
            $subjectRow = $subjectResult->fetch_assoc();
            $subjectid = $subjectRow['subjectid'];

            $sql = "INSERT INTO learns(sid, subjectid) VALUES ('$sid', '$subjectid')";

            if ($conn->query($sql) === TRUE) {
                echo "<script>alert('Add Successful!');</script>";
            } else {
                echo "<script>alert('Add Unsuccessful!');</script>";
            }
        } else {
            echo "<script>alert('Subject not found.');</script>";
        }
    }

    $conn->close();
}

if (isset($_GET['action']) && $_GET['action'] == 'fetch_details') {
    if (isset($_GET['sid'])) {
        $sid = $_GET['sid'];
        
        // Fetch student name
        $studentSql = "SELECT name FROM students WHERE sid='$sid'";
        $studentResult = $conn->query($studentSql);
        
        if ($studentResult->num_rows > 0) {
            $studentRow = $studentResult->fetch_assoc();
            $studentName = $studentRow['name'];
            
            // Fetch available subjects
            $subjectsSql = "SELECT subjectid, subject_name FROM subjects";
            $subjectsResult = $conn->query($subjectsSql);
            $subjects = [];
            
            while ($subjectRow = $subjectsResult->fetch_assoc()) {
                $subjects[] = [
                    'subjectid' => $subjectRow['subjectid'],
                    'subject_name' => $subjectRow['subject_name']
                ];
            }
            
            echo json_encode(['success' => true, 'student_name' => $studentName, 'subjects' => $subjects]);
        } else {
            echo json_encode(['success' => false]);
        }
        
        $conn->close();
    }
    exit;
}
?>

<footer>
    &copy; <?php echo date("Y"); ?> Student Information Management System 
</footer>
</body>
</html>
