<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
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
        .header {
            background-color: #333;
            color: #fff;
            padding: 20px;
            text-align: center;
        }
        .button-container {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }
        .button {
            flex-grow: 1;
            padding: 15px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-right: 10px;
            box-sizing: border-box;
        }
        .button:hover {
            background-color: #007bff; 
        }
        .delete-button {
            background-color: #dc3545; 
        }
        .delete-button:hover {
            background-color: #c82333; 
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
        <a href="admindashboard.php">Dashboard</a>
        <a href="#">View Students</a>
        <a href="#">Subjects</a>
        <a href="#">Show All Info</a>
        <a href="#">Admin Profile</a>
        <a href="#">Change Password</a>
        <a href="login.php">Logout</a> 
    </div>

    <div class="content">
        <div class="header">
            <h1>Admin Dashboard</h1>
        </div>
        
        <p>Welcome to the admin dashboard. You can navigate through the menu on the left.</p>
        <div class="button-container">
        <button class="button">Add Record</button>
        <button class="button delete-button">Delete Record</button>
        <button class="button">Edit Record</button>
    </div>
    </div>
    <footer>
        &copy; <?php echo date("Y"); ?> Student Information Management System By Nayan & Sabina 
    </footer>
</body>
</html>
