<?php
session_start(); 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    // $encrypt = md5($password);
    include('connection.php');    
    $sql = "SELECT role FROM users WHERE name='$username' AND password='$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $role = $row["role"];
        $_SESSION['username'] = $username; 
        if ($role == "admin") {
            header("Location: admindashboard.php");
            exit(); 
        } else {
            header("Location: studentdashboard.php");
            exit(); 
        }
    } else {
        echo "<script>alert('Invalid username or password!');</script>";
    }
    if (isset($_POST['remember'])) {
        setcookie('username', $username, time() + (86400 * 30), "/");
    } else {
        setcookie('username', '', time() - 3600, "/");
    }
    
    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>SIMS-Login</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>
    <h1 style="text-align: center;">Student Information Management System</h1>
    <div class="container">
        <h2>Login Form</h2>
        <form method="post" action="">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" value="<?php if(isset($_COOKIE["username"])){echo $_COOKIE["username"]; }?>" required>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" value="<?php if(isset($_COOKIE["password"])){echo $_COOKIE["password"]; }?>" required>
            <input type="checkbox" id="show_password"> Show Password <input type="checkbox" id="remember" name="remember"> Remember Me
            <input type="submit" value="Login"><br>
        </form>
    </div>
    <script>
        document.getElementById("show_password").addEventListener("change", function() {
            var passwordField = document.getElementById("password");

            if (this.checked) {
                passwordField.setAttribute("type", "text");
            } else {
                passwordField.setAttribute("type", "password");
            }
        });
    </script>

    <footer>
        &copy; <?php echo date("Y"); ?> Student Information Management System 
    </footer>
</body>
</html>


