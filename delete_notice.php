<?php
include('connection.php');

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $id = $_GET['id'];
    
    $sql = "DELETE FROM notice WHERE id='$id'";
    
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Notice deleted successfully!');</script>";
        echo "<script>window.location.href = 'a_notice.php';</script>";
    } else {
        echo "<script>alert('Error deleting record: " . $conn->error . "');</script>";
        echo "<script>window.location.href = 'a_notice.php';</script>";
    }
}
$conn->close();
?>
