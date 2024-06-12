<?php
session_start(); // Start the session at the beginning of the script

$email = $_POST['email'];
$password = $_POST['password'];

$conn = mysqli_connect("localhost", "root", "", "uni_users");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Use prepared statements to prevent SQL injection
$stmt = $conn->prepare("SELECT * FROM users WHERE email = ? AND password = ?");
$stmt->bind_param("ss", $email, $password);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $_SESSION['logged_in'] = true; // Set a session variable to indicate the user is logged in
    header("Location: ../home/index.html");
} else {
    echo '<script>alert("Invalid email or password"); location.href = "index.html";</script>';
}

$stmt->close();
$conn->close();
?>
