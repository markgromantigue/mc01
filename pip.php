<?php
$con = mysqli_connect("localhost","root","1234") or die(mysqli_error());
mysqli_select_db($con,"advanse_mc01") or die(mysqli_error($con));

if(isset($_GET['user_id'])){
		$userId = $_GET['user_id'];
        $projectId = $_GET['project_id'];
}

$problem = sizeof($_POST["problem"]); 
$proposal = sizeof($_POST["proposal"]); 
$notes = $_POST["notes"];

for ($i = 0 ; $i < $problem ; $i++) {
	$sql = "INSERT INTO pip_form(user_id,project_id,number,type,description) VALUES('" . $userId . "','" . $projectId . "',1,'problem','" . $_POST["problem"][$i] . "')";
	$result = mysqli_query($con,$sql) or die(mysqli_error($con));
}
for ($i = 0 ; $i < $proposal ; $i++) {
	$sql = "INSERT INTO pip_form(user_id,project_id,number,type,description) VALUES('" . $userId . "','" . $projectId . "',1,'proposal','" . $_POST["proposal"][$i] . "')";
	$result = mysqli_query($con,$sql) or die(mysqli_error($con));
}
$sql = "INSERT INTO pip_notes(user_id,project_id,notes) VALUES ('" . $userId . "','" . $projectId . "','" . $notes . "')";
$result = mysqli_query($con,$sql) or die(mysqli_error($con));
mysqli_query($con, "UPDATE `project` SET `PIP`= 1 WHERE `project_id` = '".$projectId."' AND `user_id` = '".$userId."'") or die (mysqli_error());
mysqli_close($con);
header("Location:view_project.php?msg=done&user_id=$userId&project_id=$projectId");
?>