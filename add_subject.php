<!DOCTYPE html>
<html>
<head>
    <title>Add Subjects</title>
    <link rel="stylesheet" href="adding.css">     
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
        <h2>Add Subjects</h2>
        <form method="post" action="">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
            <label for="role">Role:</label>
            <select id="role" name="role" required>
                <option value="student">Student</option>
                <option value="admin">Admin</option>
            </select>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            <input type="submit" value="Add">
        </form>
    </div>
<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $role = $_POST['role'];
        $password = $_POST['password'];
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "<script>alert('Invalid email format!');</script>";
        } else {
            $password_length = strlen($password);
            if ($password_length < 8 || !preg_match('/[A-Z]/', $password) || !preg_match('/[a-z]/', $password) || !preg_match('/[0-9]/', $password)) {
                echo "<script>alert('Password must be at least 8 characters long and contain at least one uppercase letter, one lowercase letter, and one numerical value!');</script>";
            } 
            else {
                if (!preg_match('/\d$/', $username)) {
                    echo "<script>alert('Username must end with a number!');</script>";
                } else {
                    $hashed_password = md5($password);
                    include('connection.php');
                    $sql = "INSERT INTO users(name,email, password, role) VALUES ('$username', '$email', '$hashed_password','$role')";

                    if ($conn->query($sql) == TRUE) {
                        echo "<script>alert('Add Successful!');</script>";
                    } else {
                        echo "<script>alert('Add Unsucessful!');</script>";
                    }
                    $conn->close();
                }
            }
        }
    }
    ?>

    <footer>
        &copy; <?php echo date("Y"); ?> Student Information Management System By Nayan & Sabina 
    </footer>
</body>
</html>

