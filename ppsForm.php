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
			?> <script> alert("Project Plan Summary saved successfully!"); </script> <?php
		}
		else if ($msg ==  "edit"){
			?> <script> alert("Time log updated successfully!"); </script> <?php
		}
    }
    
    $query="SELECT * from users c, project o WHERE c.user_id = o. user_id AND o. user_id = $userId AND o. project_id = $projectId";
    $result=mysql_query($query);
    $row2 = mysql_fetch_array($result);
    if($row2['PPS'] == 1){
        header("Location:ppsView.php?msg=done&user_id=$userId&project_id=$projectId");
    }
?>
<html>
<head>
<title>Project Plan Summary</title>
</head>
<body>
<form action="pps.php?user_id=<?php echo $userId?>&project_id=<?php echo $projectId?>" method="post">
<b>Program Size (LOC):</b><br>
Planned Total New Reused LOC: <input type="number" name="ptloc" required><br>
Actual Deleted LOC: <input type="number" name="adloc" required><br>
Actual Modified LOC: <input type="number" name="amloc" required><br>
Actual Added LOC: <input type="number" name="aaloc" required><br>
Actual Reused LOC: <input type="number" name="arloc" required><br>
Actual Total New Reused LOC: <input type="number" name="atloc" required><br><br>
<b>Time In Phase (Minutes):</b><br>
Plan Planning: <input type="number" name="pplanning" required><br>
Plan Design: <input type="number" name="pdesign" required><br>
Plan Code: <input type="number" name="pcode" required><br>
Plan Compile: <input type="number" name="pcompile" required><br>
Plan Test: <input type="number" name="ptest" required><br>
Plan Postmortem: <input type="number" name="ppostmortem" required><br><br>
<b>Defects Injected:</b><br>
Planning: <input type="number" name="dplanning" required><br>
Design: <input type="number" name="ddesign" required><br>
Code: <input type="number" name="dcode" required><br>
Compile: <input type="number" name="dcompile" required><br>
Test: <input type="number" name="dtest" required><br><br>
<b>Defects Removed:</b><br>
Planning: <input type="number" name="rplanning" required><br>
Design: <input type="number" name="rdesign" required><br>
Code: <input type="number" name="rcode" required><br>
Compile: <input type="number" name="rcompile" required><br>
Test: <input type="number" name="rtest" required><br>
After Development: <input type="number" name="adevelopment" required><br>
<input type="submit" name="Submit">
</form>
</body>
</html>