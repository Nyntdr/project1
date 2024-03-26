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
            <label for="role">Role:</label>
            <select id="role" name="role" required>
                <option value="student">Student</option>
                <option value="admin">Admin</option>
            </select>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            <label for="confirm_password">Confirm Password:</label>
            <input type="password" id="confirm_password" name="confirm_password" required>
            <input type="submit" value="Register">
        </form>
    </div>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST['username'];
        $role=$_POST['role'];
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];
         
        if ($password !== $confirm_password) {
            echo "<p style='text-align:center; color:red;'>Passwords do not match!</p>";
        } else {
            $hashed_password = md5($password);
            
            // $db_host = 'localhost'; 
            // $db_username = 'root'; 
            // $db_password = ''; 
            // $db_name = 'project1'; 

            // $conn = new mysqli($db_host, $db_username, $db_password, $db_name);
            // if ($conn->connect_error) {
            //     die("Connection failed: " . $conn->connect_error);
            // }
            include('connection.php');
            $sql = "INSERT INTO users(name,password,role) VALUES ('$username', '$hashed_password','$role')";

            if ($conn->query($sql) == TRUE) {
                echo "<p style='text-align:center; color:green;'>Registration successful!</p>";
            } else {
                echo "<p style='text-align:center; color:red;'>Error registering.</p>";
            }
            $conn->close();
        }
    }

    ?>
    <footer>
        &copy; <?php echo date("Y"); ?> Student Information Management System By Nayan & Sabina 
    </footer>
</body>
</html>
