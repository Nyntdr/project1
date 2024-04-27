<!DOCTYPE html>
<html>
<head>
    <title>Delete Student Subject Details</title>
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
            <h1>Delete Student Subject Details:</h1>
        </div>
        <table>
            <tr>
                <th>ID</th>
                <th>SID</th>
                <th>Subject ID</th>
                <th>Action</th>
            </tr>
            <?php
             include('connection.php');
             $sql = "SELECT * FROM learns";
             $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["id"] . "</td>";
                    echo "<td>" . $row["sid"] . "</td>";
                    echo "<td>" . $row["subjectid"] . "</td>";
                    echo "<td><a href='delete_learn.php?id=" . $row["id"] . "'>Delete</a></td>"; 
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='4'>No records found</td></tr>";
            }
            $conn->close();
            ?>
        </table>
    </div>
    <footer>
        &copy; <?php echo date("Y"); ?> Student Information Management System By Nayan & Sabina 
    </footer>
</body>
</html>
