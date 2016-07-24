<!--
@Author: John Zachary S. Raduban
email:zachraduban@gmail.com
version 1.0
-->
<!DOCTYPE html>
<?php
if(isset($_GET['user_id'])){
		$userId = $_GET['user_id'];
        $projectId = $_GET['project_id'];
}
?>
<html>
<head>
<script src="js/jquery.js"></script>
<script>
	$(document).ready(function(){
		$("#addRow").on("click", function(){
			$("#inputRows").append(
				'<tr><td><input type="date" name="date[]" required></td><td><input type="time" name="start[]" required></td><td><input type="time" name="stop[]" required></td><td><input type="number" name="interrupt[]" min="0"></td><td></td><td><select name="phase[]" required><option value="" disable selected>Select</option><option value="Planning">Planning</option><option value="Design">Design</option><option value="Code">Code</option><option value="Compile">Compile</option><option value="Test">Test</option><option value="Postmortem">Postmortem</option></select></td><td><input type="text" name="comments[]"></td></tr>'
				);
		});
	});
</script>
<style type="text/css">
.center {
    margin: auto;
    width: 70%;
    padding: 10px;
}
</style>
</head>
<body>
<form action="add_time_log.php?user_id=<?php echo $userId?>&project_id=<?php echo $projectId?>" method="POST">
<a href="view_project.php?user_id=<?php echo $userId?>&project_id=<?php echo $projectId?>">Go Back</a>
<div class="center">
<center><h1>Time Log Entries</h1></center>
</div>


<?php

if(isset($_GET['msg'])){
		$msg = $_GET['msg'];
		if ($msg == "edit"){
			?> <script> alert("Time log updated successfully!"); </script> <?php
		}
        else if($msg == "fail"){
            ?> <script> alert("Update failed! Delta time is negative."); </script> <?php
        }
        else if($msg == "inc"){
            ?> <script> alert("Some row/s not added successfully. Delta time is negative."); </script> <?php
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
		echo "<tr>\n<td>" . date('m-d-Y', strtotime(str_replace('-','/', $row["date"]))) . "</td>\n<td>" . date('h:i:s A', strtotime($row["start"])) . "</td>\n<td>" . date('h:i:s A', strtotime($row["stop"])) . "</td>\n<td>" . $row["interruption_time"] . "</td>\n<td>" . $row["delta_time"] . "</td>\n<td>" . $row["phase"] . "</td>\n<td>" . $row["comments"] . "</td>\n<td><a href='edit_time_log.php?time_log_id=".$row['time_log_id']."&user_id=".$userId."&project_id=".$projectId."'><button class='btn' type='button'><strong><center>Edit</center></strong></button></a></td>\n<td><a href='view_time_log.php?time_log_id=".$row['time_log_id']."&user_id=".$userId."&project_id=".$projectId."'" ?> onclick="return confirm('Are you sure you want to delete this message?')";<?php echo "><button class='btn' type='button'><strong><center>Delete</center></strong></button></a></td></tr>\n";
	}?>
    
    <br><br>
    
    <tbody id="inputRows">
    </tbody>
    
    <?php
    echo "</table>";
}//end of else

?>
    <br>
	<button type="button" id="addRow" style="float: right; margin-right: 15px;">Add Row</button>
    <br><br>
    <input type="submit" value="Submit" style="float: right; margin-right: 15px;">
    </form>
    </div>
 </body>
</html>