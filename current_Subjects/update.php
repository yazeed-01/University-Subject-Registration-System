<?php
$id_num = $_POST['id_num'];
$classroom = $_POST['classroom'];
$section = $_POST['section'];
$date = $_POST['date'];
$StartTime = $_POST['StartTime'];
$EndTime = $_POST['EndTime'];
$stu_num = $_POST['stu_num'];


$conn = mysqli_connect('localhost', 'root', '', 'uni_users');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "UPDATE subjects SET stu_num = '$stu_num' , location = '$classroom' , StartTime = '$StartTime' , EndTime = '$EndTime'  , date = '$date'  WHERE id_num = '$id_num' AND section = '$section'";
if ($conn->query($sql) === TRUE) {
    echo "Record updated successfully";
} else {    
    echo "Error updating record: " . $conn->error;
}

$conn->close(); 
?> 