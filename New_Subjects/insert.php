<?php
$id_num = $_POST['id'];
$stu_num = $_POST['stu_num'];
$date = $_POST['date'];
$StartTime = $_POST['startTime'];
$EndTime =  $_POST['endTime'];
$section = $_POST['section'];
$conn = mysqli_connect('localhost', 'root', '', 'uni_users');
if (!$conn) 
{
    die("Connection failed: " . mysqli_connect_error());
}


$sql3 = "SELECT * FROM classrooms ";
$result3 = $conn->query($sql3);
function isClassroomAvailable($classroom_id, $date, $StartTime, $EndTime) 
{
    $conn = new mysqli('localhost', 'root', '', 'uni_users');
    $sql = "SELECT * FROM subjects WHERE location = ? AND date = ? AND (StartTime < ? AND EndTime > ? OR StartTime < ? AND EndTime >= ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssss", $classroom_id, $date, $EndTime, $StartTime, $StartTime, $EndTime);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) 
    {
        $is_available = false;
    } 
    else
    {
        $is_available = true;
    }

    $stmt->close();
    $conn->close();
    return $is_available;
}


$sql1 = "SELECT * FROM subjects WHERE id_num = '$id_num'";
$result = $conn->query($sql1);
if (mysqli_num_rows($result) > 0)
{  
    while($row = $result->fetch_assoc())
    {
        if ($row["section"] == $section)
        {
            echo '<script>alert("This section is already taken"); location.href = "index.html";</script>';
            exit;
        }
    }
}

$closest_classroom = null;
$min_difference = PHP_INT_MAX;
while ($row3 = $result3->fetch_assoc()) 
        {
            $classroom_id = $row3["classroom_id"];
            $capacity = $row3["capacity"];
            $difference = abs((int)$capacity - (int)$stu_num);
            $is_available = isClassroomAvailable($classroom_id, $date , $StartTime , $EndTime); 
            if ($capacity >= $stu_num && $difference < $min_difference && $is_available) 
            {
                $closest_classroom = $classroom_id;
                $min_difference = $difference;
                $sql2 = "INSERT INTO subjects (id_num, stu_num, date, StartTime, EndTime, section, location) VALUES ('$id_num', '$stu_num', '$date', '$StartTime', '$EndTime' , '$section', '$closest_classroom')";
                $result2 = $conn->query($sql2);
                if ($result2) 
                {
                    echo "<script>alert(\"$id_num inserted at $closest_classroom\"); location.href = \"index.html\";</script>";
                    break;
                } 
                else 
                {
                    echo '<script>alert("Error inserting data"); location.href = "index.html";</script>';
                    break;
                }
            }
        }
if (is_null($closest_classroom)) 
            {
                echo '<script>alert("No classroom found with sufficient capacity and availability"); location.href = "index.html";</script>';
            }

?>