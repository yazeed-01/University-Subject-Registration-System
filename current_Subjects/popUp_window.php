<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Available Classrooms</title>
</head>
<body>
<?php
$date = $_GET['date'] ?? '';
$StartTime = $_GET['StartTime'] ?? '';
$EndTime = $_GET['EndTime'] ?? '';
$stu_num = $_GET['stu_num'] ?? '';


$conn = mysqli_connect('localhost', 'root', '', 'uni_users');
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT c.classroom_id, c.capacity, c.classroom_name , c.location
        FROM classrooms c
        WHERE c.capacity >= $stu_num AND c.classroom_id NOT IN (
            SELECT location
            FROM subjects
            WHERE date = '$date' AND StartTime = '$StartTime' AND EndTime = '$EndTime' )";

$result = mysqli_query($conn, $sql);
$availableClassrooms = [];

if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $class = "capacity: ".  $row['capacity'] . " - " . "name: ". $row['classroom_name'] . " - " . "location: " .  $row['location'];
        $availableClassrooms[ $row['classroom_id']] = $class;
    }
}


// Output all available classrooms
if (!empty($availableClassrooms)) {
    echo "<form action='update.php' method='post'>";
    echo "Available classrooms: <br>";
    echo "<select name='classroom' style='width: 500px;  font-size: 16px; color: #333;border: 4px solid  #000000; ' >";
    foreach ($availableClassrooms as $key => $classroom) {
        echo "<option value='$key'>$classroom</option>";
        
    }
    echo "</select>";
    echo "<br>";
    echo "<br>";
    echo "Enter  ID number: <input type='text' name='id_num' id='input1' placeholder='ID number'>";
    echo "<br>";
    echo "<br>";
    echo "enter number of section: <input type='number' name='section' id='input2' placeholder='number of section'>";
    echo "<br>";
    echo "<br>";
    echo "<input type='hidden' name='date' value='$date'>";
    echo "<input type='hidden' name='StartTime' value='$StartTime'>";
    echo "<input type='hidden' name='EndTime' value='$EndTime'>";
    echo "<input type='hidden' name='stu_num' value='$stu_num'>";
    echo "<br>";
    echo "<br>";
    echo "<button type='submit'>Submit</button>";
    echo "</form>";
} 
else {
    echo "No available classrooms.";
}

mysqli_close($conn);
?>
</body>
</html>
