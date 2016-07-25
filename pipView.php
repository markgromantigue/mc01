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
			?> <script> alert("PIP Form saved successfully!"); </script> <?php
		}
		else if ($msg ==  "edit"){
			?> <script> alert("Time log updated successfully!"); </script> <?php
		}
    }
    
    $query="SELECT * from users c, project o WHERE c.user_id = o. user_id AND o. user_id = $userId AND o. project_id = $projectId";
    $result=mysql_query($query);
    $row2 = mysql_fetch_array($result);
    
    $strSQL3 = "SELECT * FROM `pip_form` WHERE `user_id` = '" . $userId . "' AND `project_id` = '" . $projectId . "' AND `type` = 'problem'";
    $rs3 = mysql_query($strSQL3);
    //$row3 = mysql_fetch_array($rs3);
    
    $strSQL4 = "SELECT * FROM `pip_form` WHERE `user_id` = '" . $userId . "' AND `project_id` = '" . $projectId . "' AND `type` = 'proposal'";
    $rs4 = mysql_query($strSQL4);
    //$row4 = mysql_fetch_array($rs4);
    
    $strSQL5 = "SELECT * FROM `pip_notes` WHERE `user_id` = '" . $userId . "' AND `project_id` = '" . $projectId . "'";
    $rs5 = mysql_query($strSQL5);
    //$row5 = mysql_fetch_array($rs5);
?>
<html>
<head>
<title>PIP Form</title>
</head>
<body>

<br>
Problem Description:<br>
<?php
while ($row3 = mysql_fetch_array($rs3)) {
	echo '<textarea rows="10" cols="70" name="problem" readonly>' . $row3['description'] . '</textarea><br><br>';
}
?>
Proposal Description:<br>
<?php
while ($row4 = mysql_fetch_array($rs4)) {
	echo '<textarea rows="10" cols="70" name="problem" readonly>' . $row4['description'] . '</textarea><br><br>';
}
?>
Notes:<br>
<textarea rows="10" cols="70" name="notes" readonly><?php echo $row5['notes'];?></textarea><br>

</body>
</html>