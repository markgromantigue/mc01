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
    if($row2['PIP'] == 1){
        header("Location:view_project.php?msg=done&user_id=$userId&project_id=$projectId");
    }
?>
<html>
<head>
<title>PIP Form</title>
</head>
<body>
<form action="pip.php?user_id=<?php echo $userId?>&project_id=<?php echo $projectId?>" method="post">

<br>
Problem Description:<br>
<textarea rows="10" cols="70" name="problem" required></textarea><br><br>
Proposal Description:<br>
<textarea rows="10" cols="70" name="proposal" required></textarea><br><br>
Notes:<br>
<textarea rows="10" cols="70" name="notes" required></textarea><br>
<input type="submit" name="Submit">
</form>
</body>
</html>