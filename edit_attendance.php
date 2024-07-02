<!DOCTYPE html>
<html>
<head>
    <title>Edit Attendance Details</title>
    <link rel="stylesheet" href="a_details.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
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
        .content {
            margin-left: 250px;
            padding: 20px;
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
        form {
            width: 400px;
            margin: 0 auto;
            margin-top: 50px;
            border: 1px solid #ccc;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.1);
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
        }
        input[type="text"],
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }
        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
        label {
            display: block;
            margin-bottom: 5px;
        }
        .note {
            margin-top: 20px;
            font-style: italic;
            color: #666;
        }
    </style>
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
            <h1>Edit Attendance Details</h1>
        </div>

        <?php
        include('connection.php');

        if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id']) && isset($_GET['subject'])) {
            $id = $_GET['id'];
            $subject_name = $_GET['subject'];

            $sql = "SELECT a.sid, s.sname, a.subject_name, a.attendance 
                    FROM attendance a
                    JOIN students s ON a.sid = s.sid
                    WHERE a.sid = $id AND a.subject_name = '$subject_name'";
    
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
        ?>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <input type="hidden" name="sid" value="<?php echo $row['sid']; ?>">
            <input type="hidden" name="subject_name" value="<?php echo $row['subject_name']; ?>">
            <label for="sname">Student Name:</label>
            <input type="text" id="sname" name="sname" value="<?php echo $row['sname']; ?>" readonly>
            <label for="subject">Subject Name:</label>
            <input type="text" id="subject" name="subject" value="<?php echo $row['subject_name']; ?>" readonly>
            <label for="attendance">Attendance:</label>
            <input type="text" id="attendance" name="attendance" value="<?php echo $row['attendance']; ?>" required>
            <input type="submit" value="Update">
        </form>
        <?php
            } else {
                echo "Attendance record not found.";
            }
        } elseif ($_SERVER["REQUEST_METHOD"] == "POST") {
            $sid = $_POST['sid'];
            $subject_name = $_POST['subject_name'];
            $attendance = $_POST['attendance'];

            // Validation for attendance value
            if (is_numeric($attendance) && $attendance >= 1 && $attendance <= 100) {
                $sql_update = "UPDATE attendance SET attendance='$attendance' WHERE sid=$sid AND subject_name='$subject_name'";

                if ($conn->query($sql_update) === TRUE) {
                    echo "<script>alert('Record updated successfully');</script>";
                    echo "<script>window.location.href='ed_attendance.php';</script>";
                } else {
                    echo "Error updating record: " . $conn->error;
                }
            } else {
                echo "<script>alert('Attendance must be a number between 1 and 100');</script>";
                echo "<script>window.location.href='edit_attendance.php?id=$sid&subject=$subject_name';</script>";
            }
        }

        $conn->close();
        ?>
        <div class="note">Note: Only attendance can be edited.</div>
    </div>

    <footer>
        &copy; <?php echo date("Y"); ?> Student Information Management System 
    </footer>
</body>
</html>
