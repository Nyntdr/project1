<!DOCTYPE html>
<html>
<head>
    <title>Add Student</title>
    <style>
        .header {
            background-color: #333;
            color: #fff;
            padding: 20px;
            text-align: center;
        }
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
        .container {
            width: 400px;
            margin: 0 auto;
            margin-top: 50px;
            border: 1px solid #ccc;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.1);
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        .content {
            margin-left: 250px;
            padding: 20px;
        }
        input[type="text"],
        input[type="password"],
        input[type="submit"],
        input[type="email"],
        select {
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
        footer {
            background-color: #333;
            color: #fff;
            text-align: center;
            padding: 10px 0;
            position: fixed;
            bottom: 0;
            width: 100%;
        }
        select {
            appearance: none;
            background: #fff url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="%23333" d="M7 10l5 5 5-5z"/></svg>') no-repeat right 10px center;
            background-size: 20px;
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
    <div class="container">
        <h2>Add Student</h2>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <label for="uid">User ID:</label>
            <input type="text" id="uid" name="uid" value="<?php echo isset($_POST['uid']) ? $_POST['uid'] : ''; ?>" required><br><br>

            <label for="sname">Name:</label>
            <input type="text" id="sname" name="sname" value="<?php echo isset($_POST['sname']) ? $_POST['sname'] : ''; ?>" required><br><br>
            
            <label for="age">Age:</label>
            <input type="text" id="age" name="age" value="<?php echo isset($_POST['age']) ? $_POST['age'] : ''; ?>" required><br><br>
            
            <label for="class">Class:</label>
            <input type="text" id="class" name="class" value="<?php echo isset($_POST['class']) ? $_POST['class'] : ''; ?>" required><br><br>
            
            <label for="address">Address:</label>
            <input type="text" id="address" name="address" value="<?php echo isset($_POST['address']) ? $_POST['address'] : ''; ?>" required><br><br>
            
            <label for="p_phoneno">Parent Phone:</label>
            <input type="text" id="p_phoneno" name="p_phoneno" value="<?php echo isset($_POST['p_phoneno']) ? $_POST['p_phoneno'] : ''; ?>" required><br><br>
            
            <label for="s_phoneno">Student Phone:</label>
            <input type="text" id="s_phoneno" name="s_phoneno" value="<?php echo isset($_POST['s_phoneno']) ? $_POST['s_phoneno'] : ''; ?>" required><br><br>
            
            <input type="submit" value="Add Student">
        </form>
    </div>

    <footer>
        &copy; <?php echo date("Y"); ?> Student Information Management System 
    </footer>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $uid = $_POST['uid'];
        $name = $_POST['sname'];
        $age = $_POST['age'];
        $class = $_POST['class'];
        $address = $_POST['address'];
        $p_phoneno = $_POST['p_phoneno'];
        $s_phoneno = $_POST['s_phoneno'];
        
        $errors = [];
        if (!preg_match("/^[a-zA-Z\s]*$/", $name)) {
            $errors[] = "Name must contain only letters and spaces!";
        }
        if (!is_numeric($age) || $age < 1 || $age > 100) {
            $errors[] = "Age must be a number between 1 and 100!";
        }
        if (!preg_match("/^[a-zA-Z\s,']*$/", $address)) {
            $errors[] = "Address must contain only letters, spaces, and commas!";
        }
        if (!is_numeric($p_phoneno) || strlen($p_phoneno) !== 10) {
            $errors[] = "Parent Phone Number must be exactly 10 digits and numeric only!";
        }
        if (!is_numeric($s_phoneno) || strlen($s_phoneno) !== 10) {
            $errors[] = "Student Phone Number must be exactly 10 digits and numeric only!";
        }
        if (empty($errors)) {
            include('connection.php');
            $uid = mysqli_real_escape_string($conn, $uid);
            $name = mysqli_real_escape_string($conn, $name);
            $age = mysqli_real_escape_string($conn, $age);
            $class = mysqli_real_escape_string($conn, $class);
            $address = mysqli_real_escape_string($conn, $address);
            $p_phoneno = mysqli_real_escape_string($conn, $p_phoneno);
            $s_phoneno = mysqli_real_escape_string($conn, $s_phoneno);
            $sql = "INSERT INTO students (uid, sname, age, class, address, p_phoneno, s_phoneno) 
                    VALUES ('$uid', '$name', '$age', '$class', '$address', '$p_phoneno', '$s_phoneno')";
            
            if ($conn->query($sql) === TRUE) {
                echo "<script>alert('Student added successfully!');</script>";
                echo "<script>window.location.href = 'a_student.php';</script>";
            } else {
                echo "<script>alert('Error: " . $sql . "<br>" . $conn->error . "');</script>";
            }

            $conn->close();
        } else {
                  foreach ($errors as $error) {
                echo "<script>alert('$error');</script>";
            }
        }
    }
    ?>
</body>
</html>
