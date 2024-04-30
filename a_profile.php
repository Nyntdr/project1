<!DOCTYPE html>
<html>
<head>
    <title>Admin Profile</title>
    <link rel="stylesheet" href="profile.css">
</head>
<body>
    <div class="container">
        <div class="sidebar">
            <a href="admindashboard.php">Admin Dashboard</a>
            <a href="users.php">Users</a>
            <a href="a_student.php">Students</a>
            <a href="a_subject.php">Subjects</a>
            <a href="a_profile.php">My Profile</a>
            <a href="a_notice.php">Notice Management</a> 
            <a href="login.php">Logout</a>  
        </div>

        <div class="content">
            <div class="header">
                <h1>My Profile</h1>
            </div>
            
            <div class="profile-info">
                <h2>Profile Information</h2>
                <?php
                session_start();
                include('connection.php');
                $username = $_SESSION['username'];
                $sql = "SELECT * FROM users WHERE name = '$username'";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    $name = $row['name'];
                    $email = $row['email'];
                    $role = $row['role'];
                    echo "<p>Name: $name</p>";
                    echo "<p>Email: $email</p>";
                    echo "<p>Role: $role</p>";
                } 
                $total_students_sql = "SELECT COUNT(*) as total_students FROM students";
                $total_users_sql = "SELECT COUNT(*) as total_users FROM users";
                $total_subjects_sql = "SELECT COUNT(*) as total_subjects FROM subjects";

                $total_students_result = $conn->query($total_students_sql);
                $total_users_result = $conn->query($total_users_sql);
                $total_subjects_result = $conn->query($total_subjects_sql);

                $total_students = 0;
                $total_users = 0;
                $total_subjects = 0;

                if ($total_students_result->num_rows > 0) {
                    $total_students_row = $total_students_result->fetch_assoc();
                    $total_students = $total_students_row['total_students'];
                }

                if ($total_users_result->num_rows > 0) {
                    $total_users_row = $total_users_result->fetch_assoc();
                    $total_users = $total_users_row['total_users'];
                }

                if ($total_subjects_result->num_rows > 0) {
                    $total_subjects_row = $total_subjects_result->fetch_assoc();
                    $total_subjects = $total_subjects_row['total_subjects'];
                }
                $conn->close();
                ?>
            </div>

            <div class="statistics">
                <div class="stat-box">
                    <div class="stat-number"><?php echo $total_students; ?></div>
                    <div class="stat-text">Total Students</div>
                </div>
                <div class="stat-box">
                    <div class="stat-number"><?php echo $total_users; ?></div>
                    <div class="stat-text">Total Users</div>
                </div>
                <div class="stat-box">
                    <div class="stat-number"><?php echo $total_subjects; ?></div>
                    <div class="stat-text">Total Subjects</div>
                </div>
            </div>
        </div>
    </div>

    <footer>
        &copy; <?php echo date("Y"); ?> Student Information Management System By Nayan & Sabina 
    </footer>
</body>
</html>
