<!DOCTYPE html>
<html>
<head>
    <title>Delete Attendance Details</title>
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
            <h1>Delete Attendance Details:</h1>
        </div>
        <br>
        <b>Search for Attendance Details:</b> 
         <input type="text" id="searchInput" onkeyup="searchTable()" placeholder="Search for records..">
        <table id="dataTable">
            <tr>
                <th>SID</th>
                <th>Student Name</th>
                <th>Subject Name</th>
                <th>Attendance</th>
                <th>Action</th> <!-- New column for Delete button -->
            </tr>
            <?php
             include('connection.php');
             $sql = "SELECT attendance.id, attendance.sid, students.sname, attendance.subject_name, attendance.attendance 
                     FROM attendance 
                     JOIN students ON attendance.sid = students.sid";
             $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["sid"] . "</td>";
                    echo "<td>" . $row["sname"] . "</td>";
                    echo "<td>" . $row["subject_name"] . "</td>";
                    echo "<td>" . $row["attendance"] . "</td>";
                    echo "<td><a href='delete_attendance.php?id=" . $row["id"] . "'>Delete</a></td>"; // Delete button with dynamic URL
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
