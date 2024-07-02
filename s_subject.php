
<!DOCTYPE html>
<html>
<head>
    <title>My Subjects:</title>
    <link rel="stylesheet" href="a_details.css">
</head>
<body>
    <div class="sidebar">
    <a href="studentdashboard.php">Student Dashboard</a>
        <a href="s_subject.php">My Subjects</a>
        <a href="attendance_graph.php">Attendance</a>
        <a href="notice.php">Notices</a>
        <a href="s_profile.php">My Profile</a>
        <a href="login.php">Logout</a> 
    </div>

    <div class="content">
        <div class="header">
            <h1>My Subjects Detail:</h1>
        </div>
        <table>
            <tr>
                <th>Subject ID</th>
                <th>Subject Name</th>
                <th>Subject Code</th>
                <th>Theory(%)</th>
                <th>Practical(%)</th>
            </tr>
            <?php
             include('connection.php');
             session_start();
             $username = $_SESSION['username'];
             $sql1 = "SELECT uid FROM users WHERE name = '$username'";
             $result = $conn->query($sql1);
             if ($result->num_rows > 0) {
             $row = $result->fetch_assoc();
             $uid = $row['uid'];
             } 
             $sql = "SELECT s.subjectid, s.subject_name, s.scode, s.theory, s.practical FROM subjects as s JOIN learns as l ON s.subjectid = l.subjectid 
                    JOIN students as st ON l.sid = st.sid WHERE st.uid=$uid;";
             $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>".$row["subjectid"]."</td>";
                    echo "<td>".$row["subject_name"]."</td>";
                    echo "<td>".$row["scode"]."</td>";
                    echo "<td>".$row["theory"]."</td>";
                    echo "<td>".$row["practical"]."</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='6'>No subjects found</td></tr>";
            }
            $conn->close();
            ?>
        </table>
    </div>
    <footer>
        &copy; <?php echo date("Y"); ?> Student Information Management System  
    </footer>
</body>
</html>
