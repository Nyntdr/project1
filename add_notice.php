<!DOCTYPE html>
<html>
<head>
    <title>Add Notice</title>
    <!-- <link rel="stylesheet" href="adding.css">      -->
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
        input[type="text"],
        input[type="date"],
        textarea,
        input[type="submit"] {
            width: calc(100% - 22px); /* Adjusted width to accommodate borders */
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
            font-size: 16px;
        }
        textarea {
            height: 100px;
            resize: none; /* Prevent resizing */
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
    </style>
</head>
<body>
    <div class="sidebar">
        <a href="admindashboard.php">Admin Dashboard</a>
        <a href="users.php">Users</a>
        <a href="a_student.php">Students</a>
        <a href="a_subject.php">Subjects</a>
        <a href="a_profile.php">My Profile</a>
        <a href="a_notice.php">Notice Management</a>
        <a href="login.php">Logout</a>  
    </div>
    <div class="container">
        <h2>Add Notice</h2>
        <form method="post" action="">
            <label for="title">Title:</label>
            <input type="text" id="title" name="title" required>
            <label for="description">Description:</label>
            <textarea id="description" name="description" rows="4" required></textarea>
            <input type="date" id="date" name="date" required>
            <input type="submit" value="Add">
        </form>
    </div>
<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $title = $_POST['title'];
        $description = $_POST['description'];
        $date = $_POST['date'];
        
        include('connection.php');
        $sql = "INSERT INTO notice(title, description, date) VALUES ('$title', '$description', '$date')";

        if ($conn->query($sql) == TRUE) {
            echo "<script>alert('Add Successful!');</script>";
            echo "<script>window.location.href = 'a_notice.php';</script>";
        } else {
            echo "<script>alert('Add Unsucessful!');</script>";
            echo "<script>window.location.href = 'a_notice.php';</script>";
        }
        $conn->close();
    }
?>
<footer>
    &copy; <?php echo date("Y"); ?> Student Information Management System By Nayan & Sabina 
</footer>
</body>
</html>
