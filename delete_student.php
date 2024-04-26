<?php
include('connection.php');

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $sid = $_GET['sid'];
    
    $sql = "DELETE FROM students WHERE sid='$sid'";
    
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Student record deleted successfully!');</script>";
        echo "<script>window.location.href = 'a_student.php';</script>";
    } else {
        echo "<script>alert('Error deleting record: " . $conn->error . "');</script>";
        echo "<script>window.location.href = 'a_student.php';</script>";
    }
}
$conn->close();
?>
