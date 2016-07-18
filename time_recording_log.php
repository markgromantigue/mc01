<!--
@Author: John Zachary S. Raduban
email:zachraduban@gmail.com
version 1.0
-->
<!DOCTYPE html>
<?php
    error_reporting(0);
	session_start();
	if(!isset($_SESSION['myusername'])){ //if login in session is not set
        header("Location:index.php");
	}
	
	include_once 'db.php';
	
	if(isset($_GET['user_id'])){
		$userId = $_GET['user_id'];
        $projectId = $_GET['project_id'];
	}
    
    $myusername = $_SESSION['myusername'];
    $strSQL = "SELECT * FROM users WHERE name = '" . $myusername . "'";
    $rs = mysql_query($strSQL);
    $row = mysql_fetch_array($rs);

    if(isset($_GET['msg'])){
		$msg = $_GET['msg'];
		if ($msg ==  "success"){
			?> <script> alert("Time log added successfully!"); </script> <?php
		}
		else if ($msg ==  "edit"){
			?> <script> alert("Time log updated successfully!"); </script> <?php
		}
    }
    
    $query="SELECT * from users c, project o WHERE c.user_id = o. user_id AND o. user_id = $userId AND o. project_id = $projectId";
    $result=mysql_query($query);
    $row2 = mysql_fetch_array($result);
    if($row2['TRL'] == 1){
        header("Location:view_time_log.php?user_id=$userId&project_id=$projectId");
    }
?>
<html>
<head>

<script src="js/jquery.js"></script>
<script>
	$(document).ready(function(){
		$("#addRow").on("click", function(){
			$("#inputRows").append(
				'<tr><td><input type="date" name="date[]" required></td><td><input type="time" name="start[]" required></td><td><input type="time" name="stop[]" required></td><td><input type="number" name="interrupt[]" min="0"></td><td><select name="phase[]" required><option value="" disable selected>Select</option><option value="Planning">Planning</option><option value="Design">Design</option><option value="Code">Code</option><option value="Compile">Compile</option><option value="Test">Test</option><option value="Postmortem">Postmortem</option></select></td><td><input type="text" name="comments[]"></td></tr>'
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
<h1>Add Time Log</h1>
<form action="add_time_log.php?user_id=<?php echo $userId?>&project_id=<?php echo $projectId?>" method="POST">
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
	<td><input type="date" name="date[]" required></td>
	<td><input type="time" name="start[]" required></td>
	<td><input type="time" name="stop[]" required></td>
	<td><input type="number" name="interrupt[]" min="0"></td>
	<td><select name="phase[]" required>
		<option value="" disable selected>Select</option>
		<option value="Planning">Planning</option>
  		<option value="Design">Design</option>
  		<option value="Code">Code</option>
  		<option value="Compile">Compile</option>
		<option value="Test">Test</option>
		<option value="Postmortem">Postmortem</option>
	</select></td>
	<td><input type="text" name="comments[]"></td>
</tr>
</tbody>
	
</table>

<button type="button" id="addRow" style="float: right; margin-right: 15px;">Add Row</button>
<br><br>
<input type="submit" value="Submit" style="float: right; margin-right: 15px;">
</form>
</div>

</body>
</html>