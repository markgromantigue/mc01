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
	
	$strSQL11 = "SELECT * FROM `summary_to_date` WHERE `user_id` = '" . $userId . "' AND `project_id` = '" . $projectId . "'";
    $rs11 = mysql_query($strSQL11);
    $row11 = mysql_fetch_array($rs11);
	
	$strSQL12 = "SELECT * FROM `program_size_to_date` WHERE `user_id` = '" . $userId . "' AND `project_id` = '" . $projectId . "'";
    $rs12 = mysql_query($strSQL12);
    $row12 = mysql_fetch_array($rs12);
	
	$strSQL13 = "SELECT * FROM `time_to_date` WHERE `user_id` = '" . $userId . "' AND `project_id` = '" . $projectId . "'";
    $rs13 = mysql_query($strSQL13);
    $row13 = mysql_fetch_array($rs13);
	
	$strSQL14 = "SELECT * FROM `time_to_date_percent` WHERE `user_id` = '" . $userId . "' AND `project_id` = '" . $projectId . "'";
    $rs14 = mysql_query($strSQL14);
    $row14 = mysql_fetch_array($rs14);
	
	$strSQL15 = "SELECT * FROM `defects_injected_to_date` WHERE `user_id` = '" . $userId . "' AND `project_id` = '" . $projectId . "'";
    $rs15 = mysql_query($strSQL15);
    $row15 = mysql_fetch_array($rs15);
	
	$strSQL16 = "SELECT * FROM `defects_injected_to_date_percent` WHERE `user_id` = '" . $userId . "' AND `project_id` = '" . $projectId . "'";
    $rs16 = mysql_query($strSQL16);
    $row16 = mysql_fetch_array($rs16);
	
	$strSQL17 = "SELECT * FROM `defects_removed_to_date` WHERE `user_id` = '" . $userId . "' AND `project_id` = '" . $projectId . "'";
    $rs17 = mysql_query($strSQL17);
    $row17 = mysql_fetch_array($rs17);
	
	$strSQL18 = "SELECT * FROM `defects_removed_to_date_percent` WHERE `user_id` = '" . $userId . "' AND `project_id` = '" . $projectId . "'";
    $rs18 = mysql_query($strSQL18);
    $row18 = mysql_fetch_array($rs18);
	
?>
<html>
<head>
<title>Project Plan Summary</title>
</head>
<body>

<b>Summary:</b><br>
Planned LOC/hour: <input type="number" name="plochour" value="<?php echo $row3['loc_per_hour'];?>" readonly><br>
Planned Time: <input type="number" name="ptime" value="<?php echo $row3['planned_time'];?>" readonly><br>
Planned % Reused: <input type="number" name="pnreused" value="<?php echo $row3['percent_reused'];?>" readonly><br>
Planned % New Reused: <input type="number" name="pnnreused" value="<?php echo $row3['percent_new_reused'];?>" readonly><br>
Actual LOC/hour: <input type="number" name="alochour" value="<?php echo $row4['loc_per_hour'];?>" readonly><br>
Actual Time: <input type="number" name="atime" value="<?php echo $row4['actual_time'];?>" readonly><br>
Actual % Reused: <input type="number" name="anreused" value="<?php echo $row4['percent_reused'];?>" readonly><br>
Actual % New Reused: <input type="number" name="annreused" value="<?php echo $row4['percent_new_reused'];?>" readonly><br><br>
To-Date LOC/hour: <input type="number" name="tlochour" value="<?php echo $row11['loc_per_hour'];?>" readonly><br>
To-Date Planned Time: <input type="number" name="tptime" value="<?php echo $row11['planned_time'];?>" readonly><br>
To-Date Actual Time: <input type="number" name="tatime" value="<?php echo $row11['actual_time'];?>" readonly><br>
CPI: <input type="number" name="cpi" value="<?php echo $row11['cpi'];?>" readonly><br>
To-Date % Reused: <input type="number" name="tnreused" value="<?php echo $row11['percent_reused'];?>" readonly><br>
To-Date % New Reused: <input type="number" name="tnnreused" value="<?php echo $row11['percent_new_reused'];?>" readonly><br><br>
<b>Program Size (LOC):</b><br>
Planned Base LOC: <input type="number" name="pbloc" value="<?php echo $row5['base'];?>" readonly><br>
Planned Deleted LOC: <input type="number" name="pdloc" value="<?php echo $row5['deleted'];?>" readonly><br>
Planned Modified LOC: <input type="number" name="pmloc" value="<?php echo $row5['modified'];?>" readonly><br>
Planned Added LOC: <input type="number" name="paloc" value="<?php echo $row5['added'];?>" readonly><br>
Planned Reused LOC: <input type="number" name="prloc" value="<?php echo $row5['reused'];?>" readonly><br>
Planned Total New/Changed LOC: <input type="number" name="pnloc" value="<?php echo $row5['total_new_and_changed'];?>" readonly><br>
Planned Total LOC: <input type="number" name="plloc" value="<?php echo $row5['total_loc'];?>" readonly><br>
Planned Total New Reused LOC: <input type="number" name="ptloc" value="<?php echo $row5['total_new_reused'];?>" readonly><br>
Actual Base LOC: <input type="number" name="abloc" value="<?php echo $row6['base'];?>" readonly><br>
Actual Deleted LOC: <input type="number" name="adloc" value="<?php echo $row6['deleted'];?>" readonly><br>
Actual Modified LOC: <input type="number" name="amloc" value="<?php echo $row6['modified'];?>" readonly><br>
Actual Added LOC: <input type="number" name="aaloc" value="<?php echo $row6['added'];?>" readonly><br>
Actual Reused LOC: <input type="number" name="arloc" value="<?php echo $row6['reused'];?>" readonly><br>
Actual Total New/Changed LOC: <input type="number" name="anloc" value="<?php echo $row6['total_new_and_changed'];?>" readonly><br>
Actual Total LOC: <input type="number" name="alloc" value="<?php echo $row6['total_loc'];?>" readonly><br>
Actual Total New Reused LOC: <input type="number" name="atloc" value="<?php echo $row6['total_new_reused'];?>" readonly><br><br>
To-Date Reused LOC: <input type="number" name="trloc" value="<?php echo $row12['reused'];?>" readonly><br>
To-Date Total New/Changed LOC: <input type="number" name="tnloc" value="<?php echo $row12['total_new_and_changed'];?>" readonly><br>
To-Date Total LOC: <input type="number" name="tlloc" value="<?php echo $row12['total_loc'];?>" readonly><br>
To-Date Total New Reused LOC: <input type="number" name="ttloc" value="<?php echo $row12['total_new_reused'];?>" readonly><br><br>
<b>Time In Phase (Minutes):</b><br>
Plan Planning: <input type="number" name="pplanning" value="<?php echo $row7['planning'];?>" readonly><br>
Plan Design: <input type="number" name="pdesign" value="<?php echo $row7['design'];?>" readonly><br>
Plan Code: <input type="number" name="pcode" value="<?php echo $row7['code'];?>" readonly><br>
Plan Compile: <input type="number" name="pcompile" value="<?php echo $row7['compile'];?>" readonly><br>
Plan Test: <input type="number" name="ptest" value="<?php echo $row7['test'];?>" readonly><br>
Plan Postmortem: <input type="number" name="ppostmortem" value="<?php echo $row7['postmortem'];?>" readonly><br>
Plan Total: <input type="number" name="ptotal" value="<?php echo $row7['total'];?>" readonly><br>
Actual Planning: <input type="number" name="aplanning" value="<?php echo $row8['planning'];?>" readonly><br>
Actual Design: <input type="number" name="adesign" value="<?php echo $row8['design'];?>" readonly><br>
Actual Code: <input type="number" name="acode" value="<?php echo $row8['code'];?>" readonly><br>
Actual Compile: <input type="number" name="acompile" value="<?php echo $row8['compile'];?>" readonly><br>
Actual Test: <input type="number" name="atest" value="<?php echo $row8['test'];?>" readonly><br>
Actual Postmortem: <input type="number" name="apostmortem" value="<?php echo $row8['postmortem'];?>" readonly><br><br>
Actual Total: <input type="number" name="atotal" value="<?php echo $row8['total'];?>" readonly><br>
To-Date Planning: <input type="number" name="tplanning" value="<?php echo $row13['planning'];?>" readonly><br>
To-Date Design: <input type="number" name="tdesign" value="<?php echo $row13['design'];?>" readonly><br>
To-Date Code: <input type="number" name="tcode" value="<?php echo $row13['code'];?>" readonly><br>
To-Date Compile: <input type="number" name="tcompile" value="<?php echo $row13['compile'];?>" readonly><br>
To-Date Test: <input type="number" name="ttest" value="<?php echo $row13['test'];?>" readonly><br>
To-Date Postmortem: <input type="number" name="tpostmortem" value="<?php echo $row13['postmortem'];?>" readonly><br>
To-Date Total: <input type="number" name="ttotal" value="<?php echo $row13['total'];?>" readonly><br>
To-Date % Planning: <input type="number" name="tpplanning" value="<?php echo $row14['planning'];?>" readonly><br>
To-Date % Design: <input type="number" name="tpdesign" value="<?php echo $row14['design'];?>" readonly><br>
To-Date % Code: <input type="number" name="tpcode" value="<?php echo $row14['code'];?>" readonly><br>
To-Date % Compile: <input type="number" name="tpcompile" value="<?php echo $row14['compile'];?>" readonly><br>
To-Date % Test: <input type="number" name="tptest" value="<?php echo $row14['test'];?>" readonly><br>
To-Date % Postmortem: <input type="number" name="tppostmortem" value="<?php echo $row14['postmortem'];?>" readonly><br>
To-Date % Total: <input type="number" name="tptotal" value="<?php echo $row14['total'];?>" readonly><br><br>
<b>Defects Injected:</b><br>
Actual Planning: <input type="number" name="dplanning" value="<?php echo $row9['planning'];?>" readonly><br>
Actual Design: <input type="number" name="ddesign" value="<?php echo $row9['design'];?>" readonly><br>
Actual Code: <input type="number" name="dcode" value="<?php echo $row9['code'];?>" readonly><br>
Actual Compile: <input type="number" name="dcompile" value="<?php echo $row9['compile'];?>" readonly><br>
Actual Test: <input type="number" name="dtest" value="<?php echo $row9['test'];?>" readonly><br><br>
Actual Total: <input type="number" name="dtotal" value="<?php echo $row9['total_development'];?>" readonly><br>
To-Date Planning: <input type="number" name="tdplanning" value="<?php echo $row15['planning'];?>" readonly><br>
To-Date Design: <input type="number" name="tddesign" value="<?php echo $row15['design'];?>" readonly><br>
To-Date Code: <input type="number" name="tdcode" value="<?php echo $row15['code'];?>" readonly><br>
To-Date Compile: <input type="number" name="tdcompile" value="<?php echo $row15['compile'];?>" readonly><br>
To-Date Test: <input type="number" name="tdtest" value="<?php echo $row15['test'];?>" readonly><br><br>
To-Date Total: <input type="number" name="tdtotal" value="<?php echo $row15['total_development'];?>" readonly><br>
To-Date % Planning: <input type="number" name="tdpplanning" value="<?php echo $row16['planning'];?>" readonly><br>
To-Date % Design: <input type="number" name="tdpdesign" value="<?php echo $row16['design'];?>" readonly><br>
To-Date % Code: <input type="number" name="tdpcode" value="<?php echo $row16['code'];?>" readonly><br>
To-Date % Compile: <input type="number" name="tdpcompile" value="<?php echo $row16['compile'];?>" readonly><br>
To-Date % Test: <input type="number" name="tdptest" value="<?php echo $row16['test'];?>" readonly><br><br>
To-Date % Total: <input type="number" name="tdptotal" value="<?php echo $row16['total_development'];?>" readonly><br><br>
<b>Defects Removed:</b><br>
Actual Planning: <input type="number" name="rplanning" value="<?php echo $row10['planning'];?>" readonly><br>
Actual Design: <input type="number" name="rdesign" value="<?php echo $row10['design'];?>" readonly><br>
Actual Code: <input type="number" name="rcode" value="<?php echo $row10['code'];?>" readonly><br>
Actual Compile: <input type="number" name="rcompile" value="<?php echo $row10['compile'];?>" readonly><br>
Actual Test: <input type="number" name="rtest" value="<?php echo $row10['test'];?>" readonly><br>
Actual Total: <input type="number" name="rtotal" value="<?php echo $row10['total_development'];?>" readonly><br>
Actual After Development: <input type="number" name="adevelopment" value="<?php echo $row10['after_development'];?>" readonly><br>
To-Date Planning: <input type="number" name="trplanning" value="<?php echo $row17['planning'];?>" readonly><br>
To-Date Design: <input type="number" name="trdesign" value="<?php echo $row17['design'];?>" readonly><br>
To-Date Code: <input type="number" name="trcode" value="<?php echo $row17['code'];?>" readonly><br>
To-Date Compile: <input type="number" name="trcompile" value="<?php echo $row17['compile'];?>" readonly><br>
To-Date Test: <input type="number" name="trtest" value="<?php echo $row17['test'];?>" readonly><br><br>
To-Date Total: <input type="number" name="trtotal" value="<?php echo $row17['total_development'];?>" readonly><br>
To-Date After Development: <input type="number" name="tadevelopment" value="<?php echo $row17['after_development'];?>" readonly><br>
To-Date % Planning: <input type="number" name="trplanning" value="<?php echo $row18['planning'];?>" readonly><br>
To-Date % Design: <input type="number" name="trdesign" value="<?php echo $row18['design'];?>" readonly><br>
To-Date % Code: <input type="number" name="trcode" value="<?php echo $row18['code'];?>" readonly><br>
To-Date % Compile: <input type="number" name="trcompile" value="<?php echo $row18['compile'];?>" readonly><br>
To-Date % Test: <input type="number" name="trtest" value="<?php echo $row18['test'];?>" readonly><br>
To-Date % Total: <input type="number" name="trtotal" value="<?php echo $row18['total_development'];?>" readonly><br>
</body>
</html>