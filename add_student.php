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
            <form method="post" action="">
              <label for="name">User Id:</label>
                <input type="text" id="name" name="uid" required>
                <label for="name">Name:</label>
                <input type="text" id="name" name="sname" required>
                
                <label for="age">Age:</label>
                <input type="text" id="age" name="age" required>
                
                <label for="class">Class:</label>
                <input type="text" id="class" name="class" required>
                
                <label for="address">Address:</label>
                <input type="text" id="address" name="address" required>
                
                <label for="p_phoneno">Parent Phone:</label>
                <input type="text" id="p_phoneno" name="p_phoneno" required>
                
                <label for="s_phoneno">Student Phone:</label>
                <input type="text" id="s_phoneno" name="s_phoneno" required>
                
                <input type="submit" value="Add Student">
            </form>
        </div>
    </div>

    <footer>
        &copy; <?php echo date("Y"); ?> Student Information Management System By Nayan & Sabina 
    </footer>
</body>
</html>
<?php
include('connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $uid = $_POST['uid'];
    $name = $_POST['sname'];
    $age = $_POST['age'];
    $class = $_POST['class'];
    $address = $_POST['address'];
    $p_phoneno = $_POST['p_phoneno'];
    $s_phoneno = $_POST['s_phoneno'];
    
    $sql = "INSERT INTO students (uid,sname, age, class, address, p_phoneno, s_phoneno) 
            VALUES ('$uid','$name', '$age', '$class', '$address', '$p_phoneno', '$s_phoneno')";
    
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Student added successfully!');</script>";
        echo "<script>window.location.href = 'a_student.php';</script>";
    } else {
        echo "<script>alert('Error: " . $sql . "<br>" . $conn->error . "');</script>";
    }
}
?>
