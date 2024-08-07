<!DOCTYPE html>
<html>
<head>
    <title>Edit Subject</title>
    <link rel="stylesheet" href="a_details.css">
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
        .content {
            margin-left: 250px;
            padding: 20px;
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
        form {
            width: 400px;
            margin: 0 auto;
            margin-top: 50px;
            border: 1px solid #ccc;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.1);
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
        }
        input[type="text"],
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
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
    </style>
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

    <div class="content">
        <div class="header">
            <h1>Edit Subject</h1>
        </div>
        <?php
        include('connection.php');
        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            $subject_id = $_GET['id'];
            $sql = "SELECT * FROM subjects WHERE subjectid=$subject_id";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
        ?>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <input type="hidden" name="subjectid" value="<?php echo $row['subjectid']; ?>">
            <label for="subject_name">Subject Name:</label>
            <input type="text" id="subject_name" name="subject_name" value="<?php echo $row['subject_name']; ?>" required>
            <label for="scode">Subject Code:</label>
            <input type="text" id="scode" name="scode" value="<?php echo $row['scode']; ?>" required>
            <label for="theory">Theory(%):</label>
            <input type="text" id="theory" name="theory" value="<?php echo $row['theory']; ?>" required>
            <label for="practical">Practical(%):</label>
            <input type="text" id="practical" name="practical" value="<?php echo $row['practical']; ?>" required>
            <input type="submit" value="Update">
        </form>
        <?php
            } else {
                echo "Subject not found.";
            }
        } elseif ($_SERVER["REQUEST_METHOD"] == "POST") {
            $subjectid = $_POST['subjectid'];
            $subject_name = $_POST['subject_name'];
            $scode = $_POST['scode'];
            $theory = $_POST['theory'];
            $practical = $_POST['practical'];

            // Validation
            $valid = true;
            $error_message = '';

            if (!preg_match('/^[a-zA-Z0-9]*[a-zA-Z][a-zA-Z0-9 ]*$/', $subject_name)) {
                $valid = false;
                $error_message .= "Subject name must contain letters and spaces and numbers!";
            }
            if (!preg_match('/^[A-Z0-9]+$/', $scode)) {
                $valid = false;
                $error_message .= "Subject code must contain only uppercase letters and numbers!";
            }
            if (!is_numeric($theory) || !is_numeric($practical)) {
                $valid = false;
                $error_message .= "Theory and Practical must be numeric values!";
            }
            elseif ($theory < 0 || $practical < 0) {
                $valid = false;
                $error_message .= "Theory and Practical cannot be negative!";
            }
            elseif ($theory + $practical != 100) {
                $valid = false;
                $error_message .= "Theory and Practical must sum up to 100%!";
            }

            // Check uniqueness
            $sql_check_name = "SELECT * FROM subjects WHERE subjectid != $subjectid AND subject_name = '$subject_name'";
            $sql_check_code = "SELECT * FROM subjects WHERE subjectid != $subjectid AND scode = '$scode'";
            
            $result_name = $conn->query($sql_check_name);
            $result_code = $conn->query($sql_check_code);

            if ($result_name->num_rows > 0) {
                $valid = false;
                $error_message .= "Subject name already exists!";
            }
            if ($result_code->num_rows > 0) {
                $valid = false;
                $error_message .= "Subject code already exists!";
            }

            if ($valid) {
                $sql = "UPDATE subjects SET subject_name='$subject_name', scode='$scode', theory='$theory', practical='$practical' WHERE subjectid=$subjectid";

                if ($conn->query($sql) === TRUE) {
                    echo "<script>alert('Record updated successfully');</script>";
                    echo "<script>window.location.href='ed_subject.php';</script>";
                } else {
                    echo "Error updating record: " . $conn->error;
                }
            } else {
                echo "<script>alert('$error_message');</script>";
                echo "<script>window.location.href='edit_subject.php?id=$subjectid';</script>";
            }

            $conn->close();
        }
        ?>
    </div>
    <footer>
        &copy; <?php echo date("Y"); ?> Student Information Management System 
    </footer>
</body>
</html>
