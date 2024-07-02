<!DOCTYPE html>
<html>
<head>
    <title>Edit User Details</title>
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
            <h1>Edit User Details</h1>
        </div>
        <table>
            <tr>
                <th>User ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Password</th>
                <th>Role</th>
                <th>Action</th>
            </tr>
            <?php
             include('connection.php');
             $sql = "SELECT * FROM users";
             $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["uid"] . "</td>";
                    echo "<td>" . $row["name"] . "</td>";
                    echo "<td>" . $row["email"] . "</td>";
                    echo "<td>Password Hidden</td>";
                    echo "<td>" . $row["role"] . "</td>";
                    echo "<td><a href=\"edit_user.php?id=" . $row["uid"] . "\">Edit</a></td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='6'>No users found</td></tr>";
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
