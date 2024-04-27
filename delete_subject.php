<?php
include('connection.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    $sql = "DELETE FROM subjects WHERE subjectid='$id'";
    
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Record deleted successfully!');</script>";
        echo "<script>window.location.href = 'del_subject.php';</script>";
    } else {
        echo "<script>alert('Error deleting record: " . $conn->error . "');</script>";
        echo "<script>window.location.href = 'del_subject.php';</script>";
    }
    
    $conn->close();
}
?>
