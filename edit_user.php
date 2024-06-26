<!DOCTYPE html>
<html>
<head>
    <title>Edit User</title>
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
            <h1>Edit User</h1>
        </div>
        <?php
        include('connection.php');
        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            $user_id = $_GET['id'];
            $sql = "SELECT * FROM users WHERE uid=$user_id";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
        ?>
        <form method="post" action="">
            <input type="hidden" name="uid" value="<?php echo $row['uid']; ?>">
            <label for="name">Username:</label>
            <input type="text" id="name" name="name" value="<?php echo $row['name']; ?>" required>
            <label for="email">Email:</label>
            <input type="text" id="email" name="email" value="<?php echo $row['email']; ?>" required>
            <label for="role">Role:</label>
            <input type="text" id="role" name="role" value="<?php echo $row['role']; ?>" required>
            <label for="password">Password:</label>
            <input type="text" id="password" name="password" value="<?php echo $row['password']; ?>" required>
            <input type="submit" value="Update">
        </form>
        <?php
            } else {
                echo "User not found.";
            }
        } elseif ($_SERVER["REQUEST_METHOD"] == "POST") {
            $uid = $_POST['uid'];
            $name = $_POST['name'];
            $email = $_POST['email'];
            $role = $_POST['role'];
            $password = $_POST['password'];

            $sql = "UPDATE users SET name='$name', email='$email', role='$role', password='$password' WHERE uid=$uid";
            if ($conn->query($sql) === TRUE) {
                echo "<script>alert('Record updated successfully');</script>";
                echo "<script>window.location.href='ed_users.php';</script>";
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
