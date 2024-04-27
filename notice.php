<!DOCTYPE html>
<html>
<head>
    <title>Notices</title>
    <link rel="stylesheet" href="a_details.css">
    <style>
        body {
    font-family: Arial, sans-serif;
}
.sidebar {
    height: 100%;
    width: 250px;
    position: fixed;
    top: 0;
    left: 0;
    background-color: #111;
    padding-top: 20px;
}
.sidebar a {
    padding: 10px;
    text-decoration: none;
    font-size: 18px;
    color: #ccc;
    display: block;
}
.sidebar a:hover {
    background-color: #444;
}
..content table {
    width: 100%;
    border-collapse: collapse;
}

.content th,
.content td {
    padding: 8px;
    text-align: left;
    border-bottom: 1px solid #ddd;
}

.content th:nth-child(3), /* Selects the third column */
.content td:nth-child(3) {
    width: 40%; /* Adjust the width of the description column */
}

.content tr:hover {
    background-color: #f2f2f2;
}
.header {
    background-color: #333;
    color: #fff;
    padding: 20px;
    text-align: center;
}
footer {
    background-color: #333;
    color: #fff;
    text-align: center;
    padding: 10px 0;
    position: fixed;
    bottom: 0;
    width: 100%;
}

    </style>
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
            <h1>Notices</h1>
        </div>
        <table>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Description</th>
                <th>Date</th>
            </tr>
            <?php
            include('connection.php');
            $sql = "SELECT * FROM notice";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["id"] . "</td>";
                    echo "<td>" . $row["title"] . "</td>";
                    echo "<td>" . $row["description"] . "</td>";
                    echo "<td>" . $row["date"] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='4'>No notices found</td></tr>";
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
