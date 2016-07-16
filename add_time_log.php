<?php

//date_default_timezone_set("Asia/Manila");
$con = mysqli_connect('localhost', 'root', '1234', 'advanse_mc01');

if (mysqli_connect_errno()) {
    echo "Failed" . mysqli_connect_error();
}
else
{
    $nRows = sizeof($_POST["date"]); 

    //echo $_POST["date"][0] . "<br>";

    for($i = 0; $i < $nRows; $i++) {
        $delta_time = ((strtotime($_POST["stop"][$i]) - strtotime($_POST["start"][$i])) / 60) - $_POST["interrupt"][$i];

        //echo $delta_time;

        mysqli_query($con, "INSERT time_recording_log (date, phase, start, stop, interruption_time, delta_time, comments) values ('".$_POST["date"][$i]."', '".$_POST["phase"][$i]."', '".$_POST["start"][$i]."', '".$_POST["stop"][$i]."', '".$_POST["interruption_time"][$i]."', '".$delta_time."', '".$_POST["comments"][$i]."')") or die (mysqli_error());
    }

    header("Location: time_recording_log.php?msg=success");
}
?>