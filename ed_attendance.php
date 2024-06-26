<!DOCTYPE html>
<html>
<head>
    <title>Edit Attendance Details</title>
    <link rel="stylesheet" href="a_details.css">
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
            <h1>Edit Attendance Details:</h1>
        </div>
        <table>
            <tr>
                <th>ID</th>
                <th>SID</th>
                <th>Subject Name</th>
                <th>Attendance</th>
                <th>Action</th> <!-- New column for Edit button -->
            </tr>
            <?php
             include('connection.php');
             $sql = "SELECT * FROM attendance";
             $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["id"] . "</td>";
                    echo "<td>" . $row["sid"] . "</td>";
                    echo "<td>" . $row["subject_name"] . "</td>";
                    echo "<td>" . $row["attendance"] . "</td>";
                    echo "<td><a href='edit_attendance.php?id=" . $row["id"] . "'>Edit</a></td>"; // Edit button with dynamic URL
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5'>No attendance found</td></tr>";
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
