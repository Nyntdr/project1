<!DOCTYPE html>
<html>
<head>
    <title>Edit Student</title>
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
            <h1>Edit Student</h1>
        </div>
        <?php
        include('connection.php');
        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            $student_id = $_GET['sid'];
            $sql = "SELECT * FROM students WHERE sid=$student_id";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
        ?>
        <form method="post" action="">
            <input type="hidden" name="sid" value="<?php echo $row['sid']; ?>">
            <label for="sname">Name:</label>
            <input type="text" id="sname" name="sname" value="<?php echo $row['sname']; ?>" required>
            <label for="age">Age:</label>
            <input type="text" id="age" name="age" value="<?php echo $row['age']; ?>" required>
            <label for="class">Class:</label>
            <input type="text" id="class" name="class" value="<?php echo $row['class']; ?>" required>
            <label for="address">Address:</label>
            <input type="text" id="address" name="address" value="<?php echo $row['address']; ?>" required>
            <label for="p_phoneno">Parent Phone:</label>
            <input type="text" id="p_phoneno" name="p_phoneno" value="<?php echo $row['p_phoneno']; ?>" required>
            <label for="s_phoneno">Student Phone:</label>
            <input type="text" id="s_phoneno" name="s_phoneno" value="<?php echo $row['s_phoneno']; ?>" required>
            <input type="submit" value="Update">
        </form>
        <?php
            } else {
                echo "Student not found.";
            }
        } elseif ($_SERVER["REQUEST_METHOD"] == "POST") {
            $sid = $_POST['sid'];
            $sname = $_POST['sname'];
            $age = $_POST['age'];
            $class = $_POST['class'];
            $address = $_POST['address'];
            $p_phoneno = $_POST['p_phoneno'];
            $s_phoneno = $_POST['s_phoneno'];

            $sql = "UPDATE students SET sname='$sname', age='$age', class='$class', address='$address', p_phoneno='$p_phoneno', s_phoneno='$s_phoneno' WHERE sid=$sid";
            if ($conn->query($sql) === TRUE) {
                echo "<script>alert('Record updated successfully');</script>";
                echo "<script>window.location.href='ed_student.php';</script>";
            } else {
                echo "Error updating record: " . $conn->error;
            }
        }
        ?>
    </div>
    <footer>
        &copy; <?php echo date("Y"); ?> Student Information Management System  
    </footer>
</body>
</html>
