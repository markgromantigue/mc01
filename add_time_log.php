<!--
@Author: John Zachary S. Raduban
email:zachraduban@gmail.com
version 1.0
-->
<?php
//date_default_timezone_set("Asia/Manila");
if(isset($_GET['user_id'])){
		$userId = $_GET['user_id'];
        $projectId = $_GET['project_id'];
}
$con = mysqli_connect('localhost', 'root', '1234', 'advanse_mc01');
if (mysqli_connect_errno()) {
    echo "Failed" . mysqli_connect_error();
}
else
{
    $nRows = sizeof($_POST["date"]);
    $counter = 0;
    //echo $_POST["date"][0] . "<br>";
    for($i = 0; $i < $nRows; $i++) {
        $delta_time = ((strtotime($_POST["stop"][$i]) - strtotime($_POST["start"][$i])) / 60) - $_POST["interrupt"][$i];
        //echo $delta_time;
        if($delta_time < 0){
            $counter++;
        }
        else{
            mysqli_query($con, "INSERT time_recording_log (user_id, project_id, date, phase, start, stop, interruption_time, delta_time, comments) values ('".$userId."','".$projectId."','".$_POST["date"][$i]."', '".$_POST["phase"][$i]."', '".$_POST["start"][$i]."', '".$_POST["stop"][$i]."', '".$_POST["interrupt"][$i]."', '".$delta_time."', '".$_POST["comments"][$i]."')") or die (mysqli_error());
            mysqli_query($con, "UPDATE `project` SET `TRL`= 1 WHERE `project_id` = '".$projectId."' AND `user_id` = '".$userId."'") or die (mysqli_error());
        }
    }

    if($nRows - $counter < $nRows){
        header("Location: view_time_log.php?msg=inc&user_id=$userId&project_id=$projectId");
    }
    else{
        header("Location: view_project.php?msg=done&user_id=$userId&project_id=$projectId");
    }

    //header("Location: view_project.php?msg=done&user_id=$userId&project_id=$projectId");
}
?>