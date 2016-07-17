<!DOCTYPE html>
<?php
if(isset($_GET['user_id'])){
		$userId = $_GET['user_id'];
        $projectId = $_GET['project_id'];
}
?>
<html>
<head>
<style type="text/css">
.center {
    margin: auto;
    width: 70%;
    padding: 10px;
}
</style>
</head>
<a href="view_project.php?user_id=<?php echo $userId?>&project_id=<?php echo $projectId?>">Go Back</a>
<div class="center">
<center><h1>Time Log Entries</h1></center>
</div>
</html>

<?php

if(isset($_GET['msg'])){
		$msg = $_GET['msg'];
		if ($msg ==  "edit"){
			?> <script> alert("Time log updated successfully!"); </script> <?php
		}
}

$con = mysqli_connect('localhost', 'root', '1234', 'advanse_mc01');

if (mysqli_connect_errno()) {
    echo "Failed" . mysqli_connect_error();
}
else
{
    if(isset($_GET['time_log_id'])){
		$time_log_id = $_GET['time_log_id'];
		$delete="DELETE FROM time_recording_log WHERE time_log_id = '$time_log_id'";
		$res=mysqli_query($con, $delete);
	}

    $sql = "SELECT * FROM time_recording_log WHERE `project_id` = $projectId AND `user_id` = $userId";
    $result = mysqli_query($con, $sql);

    echo "<div class='center'>";
    echo "<table border=1 style=width:100%>\n<tr>\n<td>Date</td>\n<td>Start</td>\n<td>Stop</td>\n\n<td>Interruption Time</td>\n<td>Delta Time</td>\n<td>Phase</td>\n<td>Comments</td></tr>\n";

    while ($row = mysqli_fetch_array($result)) {
		echo "<tr>\n<td>" . $row["date"] . "</td>\n<td>" . $row["start"] . "</td>\n<td>" . $row["stop"] . "</td>\n<td>" . $row["interruption_time"] . "</td>\n<td>" . $row["delta_time"] . "</td>\n<td>" . $row["phase"] . "</td>\n<td>" . $row["comments"] . "</td>\n<td><a href='edit_time_log.php?time_log_id=".$row['time_log_id']."'><button class='btn' type='button'><strong><center>Edit</center></strong></button></a></td>\n<td><a href='view_time_log.php?time_log_id=".$row['time_log_id']."'" ?> onclick="return confirm('Are you sure you want to delete this message?')";<?php echo "><button class='btn' type='button'><strong><center>Delete</center></strong></button></a></td></tr>\n";
	}

    echo "</table>";
    echo "</div";
}

?>

