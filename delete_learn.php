<?php
include('connection.php');

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $id = $_GET['sid'];
    
    $sql = "DELETE FROM learns WHERE sid='$id'";
    
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Student record deleted successfully!');</script>";
        echo "<script>window.location.href = 'del_learn.php';</script>";
    } else {
        echo "<script>alert('Error deleting record: " . $conn->error . "');</script>";
        echo "<script>window.location.href = 'del_learn.php';</script>";
    }
}
$conn->close();
?>
