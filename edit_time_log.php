<!--
@Author: John Zachary S. Raduban
email:zachraduban@gmail.com
version 1.0
-->
<?php
$con = mysqli_connect('localhost', 'root', '1234', 'advanse_mc01');
if (mysqli_connect_errno()) {
    echo "Failed" . mysqli_connect_error();
}
else
{

    if(isset($_GET['user_id'])){
		$userId = $_GET['user_id'];
        $projectId = $_GET['project_id'];
    }
    if(isset($_GET['time_log_id'])){
        $time_log_id = $_GET['time_log_id'];
        $sql = "SELECT time_log_id ,date, phase, start, stop, interruption_time, delta_time, comments FROM time_recording_log WHERE time_log_id = '$time_log_id'";
        $result = mysqli_query($con, $sql);
    }
    while ($row = mysqli_fetch_array($result)) {
		$time_log_id = $row["time_log_id"];
        $date = $row["date"];
        $phase = $row["phase"];
        $start = $row["start"];
        $stop = $row["stop"];
        $interruption_time = $row["interruption_time"];
        $comments = $row["comments"];
	}
}
?>

<!DOCTYPE html>
<html>
<head>

<style type="text/css">
.center {
    margin: auto;
    width: 70%;
    padding: 10px;
}
h1 {
	text-align: center;
}
table {
	width: 100%;
}
</style>
</head>

<body>
<div class="center">
<form action="view_time_log.php?user_id=<?php echo $userId?>&project_id=<?php echo $projectId?>" method="POST">
<input type="submit" value="View Existing Time Log"/>
</form>
<h1>Edit Time Log</h1>
<form action="save_time_log.php?user_id=<?php echo $userId?>&project_id=<?php echo $projectId?>" method="POST">
<table>

<tr>
    <th>Date</th>
    <th>Start</th>
    <th>Stop</th>
	<th>Interruption Time</th>
	<th>Phase</th>
	<th>Comments</th>
	<br> 
</tr>

<tbody id="inputRows">
<tr>
	<td><input type="date" name="date" value ="<?php echo $date;?>" required></td>
	<td><input type="time" name="start" value ="<?php echo $start;?>" required></td>
	<td><input type="time" name="stop" value ="<?php echo $stop;?>" required></td>
	<td><input type="number" name="interrupt" min="0" value ="<?php echo $interruption_time;?>"></td>
	<td><select name="phase" required>
		<option value="<?php echo $phase;?>" disable selected><?php echo $phase;?></option>
		<option value="Planning">Planning</option>
  		<option value="Design">Design</option>
  		<option value="Code">Code</option>
  		<option value="Compile">Compile</option>
		<option value="Test">Test</option>
		<option value="Postmortem">Postmortem</option>
	</select></td>
	<td><input type="text" name="comments" value ="<?php echo $comments;?>"></td>
</tr>
</tbody>
	
</table>
<input type="hidden" name="log_id" value="<?php echo $_GET['time_log_id']; ?>" />
<input type="submit" value="Save Changes" style="float: right; margin-right: 15px;">

</form>
</div>

</body>
</html>