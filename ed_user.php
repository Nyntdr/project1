<!DOCTYPE html>
<html>
<head>
    <title>Edit User Details</title>
    <link rel="stylesheet" href="a_details.css">
    <script>
        function searchTable() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("searchInput");
            filter = input.value.toUpperCase();
            table = document.getElementById("dataTable");
            tr = table.getElementsByTagName("tr");

            for (i = 1; i < tr.length; i++) {
                tr[i].style.display = "none";
                td = tr[i].getElementsByTagName("td");
                for (j = 0; j < td.length; j++) {
                    if (td[j]) {
                        txtValue = td[j].textContent || td[j].innerText;
                        if (txtValue.toUpperCase().indexOf(filter) > -1) {
                            tr[i].style.display = "";
                            break;
                        }
                    }
                }
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

    <div class="content">
        <div class="header">
            <h1>Edit User Details</h1>
        </div>
        <br>
        <b>Search for User Details:</b> 
        <input type="text" id="searchInput" onkeyup="searchTable()" placeholder="Search for record..">
        <table id="dataTable">
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
