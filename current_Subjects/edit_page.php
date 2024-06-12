<!DOCTYPE html>
<html lang="en">
    <head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Edit Data</h1><form action="popUp_window.php" method="post" onsubmit="return openPopup(this)">
    <div class="form-group">
        <label for="date">StartTime: </label>
        <input type="time" name="StartTime" id="StartTime" required style="width: 250px;">
    </div>
    <div class="form-group">
        <label for="time">EndTime: </label>
        <input type="time" name="EndTime" id="EndTime" required style="width: 250px;">
    </div>
    <div class="form-group">
        <label for="time">Date :</label>
        <input type="text" name="date" id="date" required style="width: 250px;">
    </div>

    <div class="form-group">
      <label for="stu_num">Students number:</label>
      <input type="number" name="stu_num" id="stu_num" required style="width: 250px;">
    <div class="button-group">
        <button type="submit">Show exist classrooms</button>
    </div>
</form>
<script>
function openPopup(form) {
    var date = form.date.value;
    var StartTime = form.StartTime.value;
    var EndTime = form.EndTime.value;
    var stu_num = form.stu_num.value;

    var url = "popUp_window.php?date=" + encodeURIComponent(date) + "&StartTime=" + encodeURIComponent(StartTime) + "&EndTime=" + encodeURIComponent(EndTime) + "&stu_num=" + encodeURIComponent(stu_num);
    window.open(url, 'Popup', 'width=600,height=600');
    return false; 
}
</script>
</body>
</html>
