<!DOCTYPE html>
<html>
<head>
    <title>Edit Attendance</title>
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
            <h1>Edit Attendance</h1>
        </div>
        <?php
        include('connection.php');
        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            $id = $_GET['id'];
            $sql = "SELECT * FROM attendance WHERE id=$id";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
        ?>
        <form method="post" action="">
            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
            <label for="subject">Subject Name:</label>
            <input type="text" id="subject" name="subject" value="<?php echo $row['subject_name']; ?>" required>
            <label for="attendance">Attendance:</label>
            <input type="text" id="attendance" name="attendance" value="<?php echo $row['attendance']; ?>" required>
            <input type="submit" value="Update">
        </form>
        <?php
            } else {
                echo "Student not found in attendance.";
            }
        } elseif ($_SERVER["REQUEST_METHOD"] == "POST") {
            $id = $_POST['id'];
            $attendance = $_POST['attendance'];
            $subject = $_POST['subject'];

            $sql = "UPDATE attendance SET  attendance='$attendance', subject_name='$subject' WHERE id=$id";
            if ($conn->query($sql) === TRUE) {
                echo "<script>alert('Record updated successfully');</script>";
                echo "<script>window.location.href='ed_attendance.php';</script>";
            } else {
                echo "Error updating record: " . $conn->error;
            }
        }
        ?>
    </div>
    <footer>
        &copy; <?php echo date("Y"); ?> Student Information Management System By Nayan & Sabina 
    </footer>
</body>
</html>
