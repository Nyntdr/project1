<!DOCTYPE html>
<html>
<head>
    <title>Student Details</title>
    <link rel="stylesheet" href="a_details.css">
</head>
<body>
    <div class="sidebar">
    <a href="admindashboard.php">Admin Dashboard</a>
        <a href="users.php">Users</a>
        <a href="a_student.php">Students</a>
        <a href="a_subject.php">Subjects</a>
        <a href="a_profile.php">My Profile</a>
        <a href="a_notice.php">Notice Management</a> 
        <a href="login.php">Logout</a>  
    </div>

    <div class="content">
        <div class="header">
            <h1>Student Details:</h1>
        </div>
        <table>
            <tr>
                <th>Student ID</th>
                <th>User ID</th>
                <th>Name</th>
                <th>Age</th>
                <th>Address</th>
                <th>Parent Phone</th>
                <th>Student Phone</th>
            </tr>
            <?php
             include('connection.php');
             $sql = "SELECT * FROM students";
             $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["sid"] . "</td>";
                    echo "<td>" . $row["uid"] . "</td>";
                    echo "<td>" . $row["sname"] . "</td>";
                    echo "<td>" . $row["age"] . "</td>";
                    echo "<td>" . $row["address"] . "</td>";
                    echo "<td>" . $row["p_phoneno"] . "</td>";
                    echo "<td>" . $row["s_phoneno"] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='8'>No students found</td></tr>";
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
