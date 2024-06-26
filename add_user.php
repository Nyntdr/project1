<!DOCTYPE html>
<html>
<head>
    <title>Add Users</title>
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
        <h2>Add Users</h2>
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
            <input type="checkbox" onclick="showPassword()"> Show Password
            <input type="submit" value="Add">
        </form>
    </div>
<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $role = $_POST['role'];
        $password = $_POST['password'];
        include('connection.php');

        $check_username_sql = "SELECT * FROM users WHERE name = '$username'";
        $username_result = $conn->query($check_username_sql);

        if ($username_result->num_rows > 0) {
            echo "<script>alert('Username already exists! Please try another username.');</script>";
        } else {
            $check_email_sql = "SELECT * FROM users WHERE email = '$email'";
            $email_result = $conn->query($check_email_sql);

            if ($email_result->num_rows > 0) {
                echo "<script>alert('Email already exists! Please try another email.');</script>";
            } else {
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    echo "<script>alert('Invalid email format!');</script>";
                } else {
                    $password_length = strlen($password);
                    if ($password_length < 8 || !preg_match('/[A-Z]/', $password) || !preg_match('/[a-z]/', $password) || !preg_match('/[0-9]/', $password)) {
                        echo "<script>alert('Password must be at least 8 characters long and contain at least one uppercase letter, one lowercase letter, and one numerical value!');</script>";
                    } else {
                        if (!preg_match('/[a-zA-Z]/', $username) || preg_match('/^[^a-zA-Z]+$/', $username)) {
                            echo "<script>alert('Username must contain at least one letter and cannot be only numbers or special characters!');</script>";
                        } elseif (!preg_match('/\d$/', $username)) {
                            echo "<script>alert('Username must end with a number!');</script>";
                        } else {
                            $hashed_password = md5($password);
                            $sql = "INSERT INTO users(name, email, password, role) VALUES ('$username', '$email', '$hashed_password','$role')";

                            if ($conn->query($sql) === TRUE) {
                                echo "<script>alert('Add Successful!');</script>";
                            } else {
                                echo "<script>alert('Add Unsuccessful!');</script>";
                            }
                        }
                    }
                }
            }
        }
        $conn->close();
    }
?>

<script>
function showPassword() {
    var passwordField = document.getElementById("password");
    if (passwordField.type === "password") {
        passwordField.type = "text";
    } else {
        passwordField.type = "password";
    }
}
</script>

<footer>
    &copy; <?php echo date("Y"); ?> Student Information Management System
</footer>
</body>
</html>
