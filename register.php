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
            <label for="confirm_password">Confirm Password:</label>
            <input type="password" id="confirm_password" name="confirm_password" required>
            <input type="checkbox" id="show_password"> Show Password
            <input type="submit" value="Register">
        </form>
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
                    } elseif ($password !== $confirm_password) {
                        echo "<script>alert('Passwords do not match!');</script>";
                    } else {
                        if (!preg_match('/[a-zA-Z]/', $username) || preg_match('/^[^a-zA-Z]+$/', $username)) {
                            echo "<script>alert('Username must contain at least one letter and cannot be only numbers or special characters!');</script>";
                        } elseif (!preg_match('/\d$/', $username)) {
                            echo "<script>alert('Username must end with a number!');</script>";
                        } else {
                            $hashed_password = md5($password);
                            $sql = "INSERT INTO users(name, email, password, role) VALUES ('$username', '$email', '$hashed_password','$role')";

                            if ($conn->query($sql) === TRUE) {
                                echo "<script>alert('Registration successful!');</script>";
                            } else {
                                echo "<script>alert('Error registering.');</script>";
                            }
                        }
                    }
                }
            }
        }
        $conn->close();
    }
    ?>

    <footer>
        &copy; <?php echo date("Y"); ?> Student Information Management System 
    </footer>
</body>
</html>
