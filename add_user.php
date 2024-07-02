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
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" value="<?php echo isset($_POST['username']) ? $_POST['username'] : ''; ?>" required>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?php echo isset($_POST['email']) ? $_POST['email'] : ''; ?>" required>
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
    include('connection.php');
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $role = $_POST['role'];
        $password = $_POST['password'];
        
        function username_exists($conn, $username) {
            $check_username_sql = "SELECT * FROM users WHERE name = '$username'";
            $username_result = $conn->query($check_username_sql);
            return $username_result->num_rows > 0;
        }

        function email_exists($conn, $email) {
            $check_email_sql = "SELECT * FROM users WHERE email = '$email'";
            $email_result = $conn->query($check_email_sql);
            return $email_result->num_rows > 0;
        }

        $errors = [];

        if (!preg_match('/[a-zA-Z]/', $username) || preg_match('/^[^a-zA-Z]+$/', $username)) {
            $errors[] = "Username must contain text and cannot be only numbers or special characters!";
        } elseif (strlen($username) < 4 || strlen($username) > 10) {
            $errors[] = "Username must be between 4 and 10 characters long!";
        } elseif (preg_match('/\s/', $username)) {
            $errors[] = "Username cannot contain spaces!";
        } elseif (username_exists($conn, $username)) {
            $errors[] = "Username already exists! Please try another username.";
        }

        if (strlen($password) < 8) {
            $errors[] = "Password must be at least 8 characters long!";
        }
        elseif (strlen($password) > 15) {
            $errors[]= "Password cannot be longer than 15 characters! ";
        } elseif (!preg_match('/[a-z]/', $password) || !preg_match('/[A-Z]/', $password) || !preg_match('/[^a-zA-Z0-9]/', $password)) {
            $errors[]= "Password must contain at least one lowercase letter, one uppercase letter, and one special symbol! ";
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Invalid email format!";
        } elseif (email_exists($conn, $email)) {
            $errors[] = "Email already exists! Please try another email.";
        }

        if (empty($errors)) {
            // $hashed_password = md5($password);

            $sql = "INSERT INTO users (name, email, password, role) VALUES ('$username', '$email', '$password', '$role')";

            if ($conn->query($sql) === TRUE) {
                echo "<script>alert('Registration successful!');</script>";
            } else {
                echo "<script>alert('Error registering.');</script>";
            }
        } else {
            foreach ($errors as $error) {
                echo "<script>alert('$error');</script>";
            }
        }
    }
    $conn->close();
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
