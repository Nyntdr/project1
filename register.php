<!DOCTYPE html>
<html>
<head>
    <title>SIMS-Register</title>
    <link rel="stylesheet" href="reg.css">    
</head>
<body>
    <h1 style="text-align: center;">Student Information Management System</h1>
    <div class="container">
        <h2>Register</h2>
        <form method="post" action="">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" value="<?php echo isset($_POST['username']) ? $_POST['username'] : ''; ?>" required>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?php echo isset($_POST['email']) ? $_POST['email'] : ''; ?>" required>
            <label for="role">Role:</label>
            <select id="role" name="role" required>
                <option value="student" <?php echo isset($_POST['role']) && $_POST['role'] === 'student' ? 'selected' : ''; ?>>Student</option>
                <option value="admin" <?php echo isset($_POST['role']) && $_POST['role'] === 'admin' ? 'selected' : ''; ?>>Admin</option>
            </select>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            <label for="confirm_password">Confirm Password:</label>
            <input type="password" id="confirm_password" name="confirm_password" required>
            <input type="checkbox" id="show_password"> Show Password
            <input type="submit" value="Register">
            <!-- <input type="submit" value="Login Page" class="button" onclick="location.href='login.php';"> -->
           </form>
           <button class="button" onclick="location.href='login.php';">Login Page</button>

    </div>
    <script>
        document.getElementById("show_password").addEventListener("change", function() {
            var passwordField = document.getElementById("password");
            var confirmPasswordField = document.getElementById("confirm_password");

            if (this.checked) {
                passwordField.setAttribute("type", "text");
                confirmPasswordField.setAttribute("type", "text");
            } else {
                passwordField.setAttribute("type", "password");
                confirmPasswordField.setAttribute("type", "password");
            }
        });
    </script>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $role = $_POST['role'];
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];
        include('connection.php');
        if (!preg_match('/[a-zA-Z]/', $username) || preg_match('/^[^a-zA-Z]+$/', $username)) {
            echo "<script>alert('Username must contain text and cannot be only numbers or special characters!');</script>";
        } elseif (strlen($username) < 4) {
            echo "<script>alert('Username must be at least 4 characters long!');</script>";
        } elseif (strlen($username) > 10) {
            echo "<script>alert('Username must be less than 10 characters long!');</script>";
        } elseif (preg_match('/\s/', $username)) {
            echo "<script>alert('Username cannot contain spaces!');</script>";
        } elseif ($username_exists = username_exists($conn, $username)) {
            echo "<script>alert('Username already exists! Please try another username.');</script>";
        }
        $password_length = strlen($password);
        if ($password_length < 8) {
            echo "<script>alert('Password must be at least 8 characters long!');</script>";
        }
        elseif (strlen($password) > 15) {
             echo "<script>alert('Password cannot be longer than 15 characters!');</script>";
        } elseif (!preg_match('/[a-z]/', $password) || !preg_match('/[A-Z]/', $password) || !preg_match('/[^a-zA-Z0-9]/', $password)) {
           echo "<script>alert('Password must contain at least one lowercase letter, one uppercase letter, and one special symbol!');</script>";
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "<script>alert('Invalid email format!');</script>";
        } elseif ($email_exists = email_exists($conn, $email)) {
            echo "<script>alert('Email already exists! Please try another email.');</script>";
        }
        if ($password !== $confirm_password) {
            echo "<script>alert('Passwords do not match!');</script>";
        }
        if (empty($username_exists) && empty($email_exists) && $password_length >= 8 && $password === $confirm_password) {
            // $hashed_password = md5($password); 
            $sql = "INSERT INTO users(name, email, password, role) VALUES ('$username', '$email', '$password','$role')";

            if ($conn->query($sql) === TRUE) {
                echo "<script>alert('Registration successful!');</script>";
            } else {
                echo "<script>alert('Error registering.');</script>";
            }
        }

        $conn->close();
    }

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
    ?>
    <footer>
        &copy; <?php echo date("Y"); ?> Student Information Management System 
    </footer>
</body>
</html>
