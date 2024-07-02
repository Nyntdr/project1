<!DOCTYPE html>
<html>
<head>
    <title>Add Subject</title>
    <link rel="stylesheet" href="adding.css">
    <style>
        .percentage-input {
            display: flex;
            align-items: center;
        }
        .percentage-input input {
            padding-right: 25px; 
        }
        .percentage-input::after {
            content: '%';
            margin-left: -20px; 
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
            <h1>Add Subject</h1>
        </div>
        
        <div class="container">
            <h2>Add Subject</h2>
            <form method="post" action="">
                <label for="subject_name">Subject Name:</label>
                <input type="text" id="subject_name" name="subject_name" required><br><br>

                <label for="scode">Subject Code:</label>
                <input type="text" id="scode" name="scode" required><br><br>

                <label for="theory">Theory (%):</label>
                <input type="text" id="theory" name="theory" required><br><br>

                <label for="practical">Practical (%):</label>
                <input type="text" id="practical" name="practical" required><br><br>
                
                <input type="submit" value="Add Subject">
            </form>
        </div>

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $subject_name = $_POST['subject_name'];
            $scode = $_POST['scode'];
            $theory = $_POST['theory'];
            $practical = $_POST['practical'];

            if (!preg_match('/^[a-zA-Z0-9]*[a-zA-Z][a-zA-Z0-9 ]*$/', $subject_name)) {
                echo "<script>alert('Subject name must contain letters and spaces and numbers!');</script>";
            }
            elseif (!preg_match('/^[A-Z0-9]+$/', $scode)) {
                echo "<script>alert('Subject code must contain only uppercase letters and numbers.!');</script>";
            }
            elseif (!is_numeric($theory) || !is_numeric($practical)) {
                echo "<script>alert('Theory and Practical must be numeric values!');</script>";
            } elseif ($theory < 0 || $practical < 0) {
                echo "<script>alert('Theory and Practical cannot be negative!');</script>";
            } elseif ($theory + $practical != 100) {
                echo "<script>alert('Theory and Practical must sum up to 100%!');</script>";
            } else {
                include('connection.php');

                $check_subject_name_sql = "SELECT * FROM subjects WHERE subject_name = '$subject_name'";
                $subject_name_result = $conn->query($check_subject_name_sql);

                if ($subject_name_result->num_rows > 0) {
                    echo "<script>alert('Subject name already exists!');</script>";
                } else {
                    $check_scode_sql = "SELECT * FROM subjects WHERE scode = '$scode'";
                    $scode_result = $conn->query($check_scode_sql);

                    if ($scode_result->num_rows > 0) {
                        echo "<script>alert('Subject code already exists!');</script>";
                    } else {
                        $sql = "INSERT INTO subjects (subject_name, scode, theory, practical) 
                                VALUES ('$subject_name', '$scode', '$theory', '$practical')";

                        if ($conn->query($sql) === TRUE) {
                            echo "<script>alert('Subject added successfully!');</script>";
                        } else {
                            echo "<script>alert('Error: " . $sql . "<br>" . $conn->error . "');</script>";
                        }
                    }
                }

                $conn->close();
            }
        }
        ?>
    </div>

    <footer>
        &copy; <?php echo date("Y"); ?> Student Information Management System 
    </footer>
</body>
</html>
