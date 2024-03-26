<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $enypt=md5($password);
        
        $db_host = 'localhost'; 
        $db_username = 'root'; 
        $db_password = ''; 
        $db_name = 'project1'; 
        $conn = new mysqli($db_host, $db_username, $db_password, $db_name);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        
$sql = "SELECT role FROM users WHERE name='$username' AND password='$enypt'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $role = $row["role"];
    if ($role == "admin") {
        header("Location: admindashboard.php");
        exit(); 
    } else {
        header("Location: studentdashboard.php");
        exit(); 
    }
} else {
    echo "<p style='text-align:center; color:red;'>Invalid username or password!</p>";
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
            <input type="text" id="username" name="username" required>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            <input type="checkbox" id="remember" name="remember">
            <label for="remember">Remember me</label>
            <input type="submit" value="Login">
        </form>
    </div>

    <footer>
        &copy; <?php echo date("Y"); ?> Student Information Management System By Nayan & Sabina 
    </footer>
</body>
</html>
