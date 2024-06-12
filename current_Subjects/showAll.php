<!doctype html>
<html lang="en">
<head>
    <title>subjects</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<section class="ftco-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 text-center mb-5">
                <h2 class="heading-section">Subjects</h2>
            </div>
        </div>
        <td><form action='edit_page.php' method='post'>  <input type='submit' value='Edit'/></form></td></tr>

        <div class="row">
            <div class="col-md-12">
                <div class="table-wrap">
                    <?php
                    $conn = mysqli_connect('localhost', 'root', '', 'uni_users');
                    if (!$conn) {
                        die("Connection failed: " . mysqli_connect_error());
                    }
                    $sql = "SELECT * FROM subjects";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        echo "<table class='table table-bordered table-dark table-hover'>";
                        echo "<thead>";
                        echo "<tr><th>ID</th><th>Students number</th><th>Section</th><th>Date</th><th>Start Time</th><th>EndTime</th><th>Location</th></tr>";
                        echo "</thead>";
                        echo "<tbody>";
                        while ($row = $result->fetch_assoc()) {
                            $sql2 = "SELECT * FROM classrooms WHERE classroom_id = '$row[location]'";
                            $result2 = $conn->query($sql2);
                            $row2 = $result2->fetch_assoc();
                            {
                                $classroom_name = $row2["classroom_name"]. " - " . $row2["location"];
                            }

                            echo "<tr><td>" . $row["id_num"] . "</td><td>" . $row["stu_num"] . "</td><td>" . $row["section"] . "</td><td>" . $row["date"] . "</td><td>" . $row["StartTime"] . "</td><td>" . $row["EndTime"]  ."</td><td>" . $classroom_name . "</td>";
                        }
                        echo "</tbody>";
                        echo "</table>";
                    } else {
                        echo "0 results";
                    }
                    $conn->close();
                    ?>
                </div>
            </div>
        </div>
    </div>
</section>
<script src="js/jquery.min.js"></script>
<script src="js/popper.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/main.js"></script>
</body>
</html>
