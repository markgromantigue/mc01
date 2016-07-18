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
    
    $strSQL3 = "SELECT * FROM `summary_plan` WHERE `user_id` = '" . $userId . "' AND `project_id` = '" . $projectId . "'";
    $rs3 = mysql_query($strSQL3);
    $row3 = mysql_fetch_array($rs3);
    
    $strSQL4 = "SELECT * FROM `summary_actual` WHERE `user_id` = '" . $userId . "' AND `project_id` = '" . $projectId . "'";
    $rs4 = mysql_query($strSQL4);
    $row4 = mysql_fetch_array($rs4);
    
    $strSQL5 = "SELECT * FROM `program_size_plan` WHERE `user_id` = '" . $userId . "' AND `project_id` = '" . $projectId . "'";
    $rs5 = mysql_query($strSQL5);
    $row5 = mysql_fetch_array($rs5);
    
    $strSQL6 = "SELECT * FROM `program_size_actual` WHERE `user_id` = '" . $userId . "' AND `project_id` = '" . $projectId . "'";
    $rs6 = mysql_query($strSQL6);
    $row6 = mysql_fetch_array($rs6);
    
    $strSQL7 = "SELECT * FROM `time_plan` WHERE `user_id` = '" . $userId . "' AND `project_id` = '" . $projectId . "'";
    $rs7 = mysql_query($strSQL7);
    $row7 = mysql_fetch_array($rs7);
    
    $strSQL8 = "SELECT * FROM `time_actual` WHERE `user_id` = '" . $userId . "' AND `project_id` = '" . $projectId . "'";
    $rs8 = mysql_query($strSQL8);
    $row8 = mysql_fetch_array($rs8);
    
    $strSQL9 = "SELECT * FROM `defects_injected_actual` WHERE `user_id` = '" . $userId . "' AND `project_id` = '" . $projectId . "'";
    $rs9 = mysql_query($strSQL9);
    $row9 = mysql_fetch_array($rs9);
    
    $strSQL10 = "SELECT * FROM `defects_removed_actual` WHERE `user_id` = '" . $userId . "' AND `project_id` = '" . $projectId . "'";
    $rs10 = mysql_query($strSQL10);
    $row10 = mysql_fetch_array($rs10);
?>
<html>
<head>
<title>Project Plan Summary</title>
</head>
<body>

<b>Summary:</b><br>
Planned LOC/hour: <input type="number" name="plochour" value="<?php echo $row3['loc_per_hour'];?>" readonly><br>
Actual LOC/hour: <input type="number" name="alochour" value="<?php echo $row4['loc_per_hour'];?>" readonly><br>
Planned Time: <input type="number" name="ptime" value="<?php echo $row3['planned_time'];?>" readonly><br>
Actual Time: <input type="number" name="atime" value="<?php echo $row4['actual_time'];?>" readonly><br><br>
<b>Program Size (LOC):</b><br>
Planned Base LOC: <input type="number" name="pbloc" value="<?php echo $row5['base'];?>" readonly><br>
Planned Deleted LOC: <input type="number" name="pdloc" value="<?php echo $row5['deleted'];?>" readonly><br>
Planned Modified LOC: <input type="number" name="pmloc" value="<?php echo $row5['modified'];?>" readonly><br>
Planned Added LOC: <input type="number" name="paloc" value="<?php echo $row5['added'];?>" readonly><br>
Planned Reused LOC: <input type="number" name="prloc" value="<?php echo $row5['reused'];?>" readonly><br>
Planned Total New Reused LOC: <input type="number" name="ptloc" value="<?php echo $row5['total_new_reused'];?>" readonly><br>
Actual Base LOC: <input type="number" name="abloc" value="<?php echo $row6['base'];?>" readonly><br>
Actual Deleted LOC: <input type="number" name="adloc" value="<?php echo $row6['deleted'];?>" readonly><br>
Actual Modified LOC: <input type="number" name="amloc" value="<?php echo $row6['modified'];?>" readonly><br>
Actual Added LOC: <input type="number" name="aaloc" value="<?php echo $row6['added'];?>" readonly><br>
Actual Reused LOC: <input type="number" name="arloc" value="<?php echo $row6['reused'];?>" readonly><br>
Actual Total New Reused LOC: <input type="number" name="atloc" value="<?php echo $row6['total_new_reused'];?>" readonly><br><br>
<b>Time In Phase (Minutes):</b><br>
Plan Planning: <input type="number" name="pplanning" value="<?php echo $row7['planning'];?>" readonly><br>
Plan Design: <input type="number" name="pdesign" value="<?php echo $row7['design'];?>" readonly><br>
Plan Code: <input type="number" name="pcode" value="<?php echo $row7['code'];?>" readonly><br>
Plan Compile: <input type="number" name="pcompile" value="<?php echo $row7['compile'];?>" readonly><br>
Plan Test: <input type="number" name="ptest" value="<?php echo $row7['test'];?>" readonly><br>
Plan Postmortem: <input type="number" name="ppostmortem" value="<?php echo $row7['postmortem'];?>" readonly><br>
Actual Planning: <input type="number" name="aplanning" value="<?php echo $row8['planning'];?>" readonly><br>
Actual Design: <input type="number" name="adesign" value="<?php echo $row8['design'];?>" readonly><br>
Actual Code: <input type="number" name="acode" value="<?php echo $row8['code'];?>" readonly><br>
Actual Compile: <input type="number" name="acompile" value="<?php echo $row8['compile'];?>" readonly><br>
Actual Test: <input type="number" name="atest" value="<?php echo $row8['test'];?>" readonly><br>
Actual Postmortem: <input type="number" name="apostmortem" value="<?php echo $row8['postmortem'];?>" readonly><br><br>
<b>Defects Injected:</b><br>
Planning: <input type="number" name="dplanning" value="<?php echo $row9['planning'];?>" readonly><br>
Design: <input type="number" name="ddesign" value="<?php echo $row9['design'];?>" readonly><br>
Code: <input type="number" name="dcode" value="<?php echo $row9['code'];?>" readonly><br>
Compile: <input type="number" name="dcompile" value="<?php echo $row9['compile'];?>" readonly><br>
Test: <input type="number" name="dtest" value="<?php echo $row9['test'];?>" readonly><br><br>
<b>Defects Removed:</b><br>
Planning: <input type="number" name="rplanning" value="<?php echo $row10['planning'];?>" readonly><br>
Design: <input type="number" name="rdesign" value="<?php echo $row10['design'];?>" readonly><br>
Code: <input type="number" name="rcode" value="<?php echo $row10['code'];?>" readonly><br>
Compile: <input type="number" name="rcompile" value="<?php echo $row10['compile'];?>" readonly><br>
Test: <input type="number" name="rtest" value="<?php echo $row10['test'];?>" readonly><br>
After Development: <input type="number" name="adevelopment" value="<?php echo $row10['after_development'];?>" readonly><br>

</body>
</html>