<!--
@Author: John Zachary S. Raduban
email:zachraduban@gmail.com
version 1.0
-->
<?php

if(isset($_GET['user_id'])){
		$userId = $_GET['user_id'];
        $projectId = $_GET['project_id'];
}

//date_default_timezone_set("Asia/Manila");
$con = mysqli_connect('localhost', 'root', '1234', 'advanse_mc01');

if (mysqli_connect_errno()) {
    echo "Failed" . mysqli_connect_error();
}
else
{
    //echo $_POST["date"] . "<br>";
    if(isset($_POST['log_id'])){
        echo $_POST['log_id'];
		$time_log_id = $_POST['log_id'];
		$delta_time = ((strtotime($_POST["stop"]) - strtotime($_POST["start"])) / 60) - $_POST["interrupt"];

        if($delta_time < 0){
            header("Location: view_time_log.php?msg=fail&user_id=$userId&project_id=$projectId");
        }
        else{
            $update = "UPDATE time_recording_log SET date = '".$_POST["date"]."', phase = '".$_POST["phase"]."', start = '".$_POST["start"]."', stop = '".$_POST["stop"]."', interruption_time = '".$_POST["interrupt"]."', delta_time = '".$delta_time."', comments = '".$_POST["comments"]."' WHERE time_log_id = '".$time_log_id."'";
            mysqli_query($con, $update) or die (mysqli_error());

            header("Location: view_time_log.php?msg=edit&user_id=$userId&project_id=$projectId");
        }
	}
}
?>