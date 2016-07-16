<?php
$con = mysqli_connect("localhost","root","") or die(mysqli_error());
mysqli_select_db($con,"mco1") or die(mysqli_error($con));
$name = $_POST["name"];
$program = $_POST["program"];
$professor = $_POST["professor"];
$programNo = $_POST["program_no"];
$language = $_POST["language"];
$date = $_POST["datetime"];
$type = $_POST["type"];
$description = $_POST["description"];
$notes = $_POST["notes"];
$nameThere = FALSE;
$programThere = FALSE;
$professorThere = FALSE;
$programNoThere = FALSE;
$languageThere = FALSE;
$dateThere = FALSE;
$result = mysqli_query($con,"SELECT * FROM users") or die(mysqli_error($con));
$rows = mysqli_num_rows($result);
if ($rows == 0) {
	$sql = "INSERT INTO users(name,program) VALUES('" . $name . "','" . $program . "')";
	mysqli_query($con,$sql) or die(mysqli_error($con));
} else {
	while ($row = mysqli_fetch_array($result)) {
		if ($row['name'] == $name) {
			$nameThere = TRUE;
		}
		if ($row['program'] == $program) {
			$programThere = TRUE;
		}
	}
	if (!$nameThere || !$programThere) {
		$sql = "INSERT INTO users(name,program) VALUES('" . $name . "','" . $program . "')";
		mysqli_query($con,$sql) or die(mysqli_error($con));
	}
}
$sql = "SELECT * FROM users WHERE name = '" . $name . "' AND program = '" . $program . "'";
$result = mysqli_query($con,$sql) or die(mysqli_error($con));
$row = mysqli_fetch_array($result);
$userId = $row['user_id'];
$result = mysqli_query($con,"SELECT * FROM project") or die(mysqli_error($con));
$rows = mysqli_num_rows($result);
if ($rows == 0) {
	$sql = "INSERT INTO project(professor,program_no,language,datetime) VALUES('" . $professor . "','" . $programNo . "','" . $language . "','" . $date . "')";
	mysqli_query($con,$sql) or die(mysqli_error($con));
} else {
	while ($row = mysqli_fetch_array($result)) {
		if ($row['professor'] == $professor) {
			$professorThere = TRUE;
		}
		if ($row['program_no'] == $programNo) {
			$programThere = TRUE;
		}
		if ($row['language'] == $language) {
			$languageThere = TRUE;
		}
		if ($row['datetime'] == $date) {
			$dateThere = TRUE;
		}
	}
	if (!$nameThere || !$programThere || !$languageThere || !$dateThere) {
		$sql = "INSERT INTO project(professor,program_no,language,datetime) VALUES('" . $professor . "','" . $programNo . "','" . $language . "','" . $date . "')";
		mysqli_query($con,$sql) or die(mysqli_error($con));
	}
}
$sql = "SELECT * FROM project WHERE professor = '" . $professor . "' AND program_no = '" . $programNo . "' AND language = '" . $language . "' AND datetime = '" . $date . "'";
$result = mysqli_query($con,$sql) or die(mysqli_error($con));
$row = mysqli_fetch_array($result);
$projectId = $row['project_id'];
$sql = "INSERT INTO pip_form(user_id,project_id,type,description) VALUES('" . $userId . "','" . $projectId . "','" . $type . "','" . $description . "')";
$result = mysqli_query($con,$sql) or die(mysqli_error($con));
$sql = "INSERT INTO pip_notes(user_id,project_id,notes) VALUES ('" . $userId . "','" . $projectId . "','" . $notes . "')";
$result = mysqli_query($con,$sql) or die(mysqli_error($con));
mysqli_close($con);
?>