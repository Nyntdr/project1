<!DOCTYPE html>
<html>
<head>
    <title> Delete Student Details</title>
    <link rel="stylesheet" href="a_details.css">
    <script>
        function searchTable() {
            var input, filter, table, tr, td, i, j, txtValue;
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
            <h1>Delete Student Details:</h1>
        </div>
        <br>
        <b>Search for Student Details:</b> 
         <input type="text" id="searchInput" onkeyup="searchTable()" placeholder="Search for records..">
        <table id="dataTable">
            <tr>
                <th>Student ID</th>
                <th>User ID</th>
                <th>Name</th>
                <th>Age</th>
                <th>Address</th>
                <th>Parent Phone</th>
                <th>Student Phone</th>
                <th>Action</th>
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
                    echo "<td><a href='delete_student.php?sid=".$row["sid"]."'>Delete</a></td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='9'>No students found</td></tr>";
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
