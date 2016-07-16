<!DOCTYPE html>
<?php
if(isset($_GET['msg'])){
		$msg = $_GET['msg'];
		if ($msg ==  "success"){
			?> <script> alert("Time log added successfully!"); </script> <?php
		}
		else if ($msg ==  "edit"){
			?> <script> alert("Time log updated successfully!"); </script> <?php
		}
}
?>
<html>
<head>

<script src="js/jquery.js"></script>
<script>
	$(document).ready(function(){
		$("#addRow").on("click", function(){
			$("#inputRows").append(
				'<tr><td><input type="date" name="date[]"></td><td><input type="time" name="start[]"></td><td><input type="time" name="stop[]"></td><td><input type="number" name="interrupt[]" min="0"></td><td><input type="text" name="phase[]"></td><td><input type="text" name="comments[]"></td></tr>'
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
<form action="view_time_log.php" method="POST">
<input type="submit" value="View Existing Time Log"/>
</form>
<h1>Add Time Log</h1>
<form action="add_time_log.php" method="POST">
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
	<td><input type="text" name="phase[]" required></td>
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