<!DOCTYPE html>
<html>
<head>
    <title>Delete Subject Details</title>
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
            <h1>Delete Subject Details</h1>
        </div>
        
        <table>
            <tr>
                <th>Subject ID</th>
                <th>Subject Name</th>
                <th>Subject Code</th>
                <th>Theory</th>
                <th>Practical</th>
                <th>Action</th>
            </tr>
            <?php
                include('connection.php');
                $sql = "SELECT * FROM subjects";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>".$row["subjectid"]."</td>";
                        echo "<td>".$row["subject_name"]."</td>";
                        echo "<td>".$row["scode"]."</td>";
                        echo "<td>".$row["theory"]."</td>";
                        echo "<td>".$row["practical"]."</td>";
                        echo "<td><a href=\"delete_subject.php?id=" . $row["subjectid"] . "\">Delete</a></td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='7'>No subjects found.</td></tr>";
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
