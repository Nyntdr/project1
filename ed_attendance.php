<!DOCTYPE html>
<html>
<head>
    <title>Edit Attendance Details</title>
    <link rel="stylesheet" href="a_details.css">
    <script>
        function searchTable() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("searchInput");
            filter = input.value.toUpperCase();
            table = document.getElementById("dataTable");
            tr = table.getElementsByTagName("tr");

            for (i = 1; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[1]; // index 1 for SID column
                if (td) {
                    txtValue = td.textContent || td.innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
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
            <h1>Edit Attendance Details:</h1>
        </div>
        <br>
        <b>Search for Student Attendance Details:</b> 
        <input type="text" id="searchInput" onkeyup="searchTable()" placeholder="Search for Student ID..">
        <table id="dataTable">
            <tr>
                <th>SID</th>
                <th>Student Name</th>
                <th>Subject Name</th>
                <th>Attendance</th>
                <th>Action</th> <!-- New column for Edit button -->
            </tr>
            <?php
            include('connection.php');
            $sql = "SELECT a.sid, s.sname, a.subject_name, a.attendance 
                    FROM attendance a
                    JOIN students s ON a.sid = s.sid";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["sid"] . "</td>";
                    echo "<td>" . $row["sname"] . "</td>";
                    echo "<td>" . $row["subject_name"] . "</td>";
                    echo "<td>" . $row["attendance"] . "</td>";
                    echo "<td><a href='edit_attendance.php?id=" . $row["sid"] . "&subject=" . urlencode($row["subject_name"]) . "'>Edit</a></td>"; // Edit button with dynamic URL
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
