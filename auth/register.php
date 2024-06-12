<?php
$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];

$conn = mysqli_connect ('localhost', 'root', '', 'uni_users');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$password')";
$result = $conn->query($sql);

if ($result) 
# show alert massage sussess
echo '<script>alert("Register Success");window.location.href="index.html";</script>';




?>