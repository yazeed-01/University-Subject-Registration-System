<?php 
$id_num = $_POST['id_num'];
$section = $_POST['section'];
$conn = new mysqli('localhost', 'root', '', 'uni_users');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "DELETE FROM subjects WHERE id_num = '$id_num' AND section = '$section'";
if ($conn->query($sql) === TRUE) {
    echo "<script>alert('Record deleted successfully'); window.location.href='index.php';</script>";
} else {    
    echo "<script>alert('Error deleting record: " . $conn->error . "'); window.location.href='index.php';</script>";
}

$conn->close();

?>
