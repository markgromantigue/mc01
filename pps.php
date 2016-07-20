<?php
$con = mysqli_connect("localhost","root","1234") or die(mysqli_error());
mysqli_select_db($con,"advanse_mc01") or die(mysqli_error($con));

if(isset($_GET['user_id'])){
		$userId = $_GET['user_id'];
        $projectId = $_GET['project_id'];
}
    
$sql = "SELECT base_size FROM base_program WHERE user_id = '" . $userId . "' AND project_id = '" . $projectId . "'";
$rs = mysqli_fetch_array(mysqli_query($con,$sql));
$pBLOC = $rs['base_size'];
$sql = "SELECT loc_deleted FROM base_program WHERE user_id = '" . $userId . "' AND project_id = '" . $projectId . "'";
$rs = mysqli_fetch_array(mysqli_query($con,$sql));
$pDLOC = $rs['loc_deleted'];
$sql = "SELECT loc_modified FROM base_program WHERE user_id = '" . $userId . "' AND project_id = '" . $projectId . "'";
$rs = mysqli_fetch_array(mysqli_query($con,$sql));
$pMLOC = $rs['loc_modified'];
$sql = "SELECT loc FROM projected_loc WHERE user_id = '" . $userId . "' AND project_id = '" . $projectId . "'";
$rs = mysqli_fetch_array(mysqli_query($con,$sql));
$BA = $rs['loc'];
$sql = "SELECT loc FROM new_objects WHERE user_id = '" . $userId . "' AND project_id = '" . $projectId . "'";
$rs = mysqli_fetch_array(mysqli_query($con,$sql));
$NO = $rs['loc'];
$pALOC = $BA + $NO;
$sql = "SELECT sum(loc) FROM reused_objects WHERE user_id = '" . $userId . "' AND project_id = '" . $projectId . "'";
$rs = mysqli_fetch_array(mysqli_query($con,$sql));
$pRLOC = $rs['sum(loc)'];
$pNLOC = $pMLOC + $pALOC;
$pLLOC = $pALOC + $pBLOC + $pRLOC - $pDLOC;
$pTLOC = $_POST["ptloc"];
$aDLOC = $_POST["adloc"];
$aMLOC = $_POST["amloc"];
$aALOC = $_POST["aaloc"];
$aRLOC = $_POST["arloc"];
$aNLOC = $aMLOC + $aALOC;
$aLLOC = $aALOC + $pBLOC + $aRLOC - $aDLOC;
$aTLOC = $_POST["atloc"];
$pReused = 100 * $pRLOC / $pLLOC;
$pNReused = 100 * $pRLOC / $pNLOC;
$aReused = 100 * $aRLOC / $aLLOC;
$aNReused = 100 * $aRLOC / $aNLOC;
$pPlanning = $_POST["pplanning"];
$pDesign = $_POST["pdesign"];
$pCode = $_POST["pcode"];
$pCompile = $_POST["pcompile"];
$pTest = $_POST["ptest"];
$pPostmortem = $_POST["ppostmortem"];
$pTotal = $pPlanning + $pDesign + $pCode + $pCompile + $pTest + $pPostmortem;
$pLOCHour = $pNLOC / $pTotal;
$sql = "SELECT sum(delta_time) FROM time_recording_log WHERE user_id = '" . $userId . "' AND project_id = '" . $projectId . "' AND phase = 'Planning'";
$rs = mysqli_fetch_array(mysqli_query($con,$sql));
$aPlanning = $rs['sum(delta_time)'];
$sql = "SELECT sum(delta_time) FROM time_recording_log WHERE user_id = '" . $userId . "' AND project_id = '" . $projectId . "' AND phase = 'Design'";
$rs = mysqli_fetch_array(mysqli_query($con,$sql));
$aDesign = $rs['sum(delta_time)'];
$sql = "SELECT sum(delta_time) FROM time_recording_log WHERE user_id = '" . $userId . "' AND project_id = '" . $projectId . "' AND phase = 'Code'";
$rs = mysqli_fetch_array(mysqli_query($con,$sql));
$aCode = $rs['sum(delta_time)'];
$sql = "SELECT sum(delta_time) FROM time_recording_log WHERE user_id = '" . $userId . "' AND project_id = '" . $projectId . "' AND phase = 'Compile'";
$rs = mysqli_fetch_array(mysqli_query($con,$sql));
$aCompile = $rs['sum(delta_time)'];
$sql = "SELECT sum(delta_time) FROM time_recording_log WHERE user_id = '" . $userId . "' AND project_id = '" . $projectId . "' AND phase = 'Test'";
$rs = mysqli_fetch_array(mysqli_query($con,$sql));
$aTest = $rs['sum(delta_time)'];
$sql = "SELECT sum(delta_time) FROM time_recording_log WHERE user_id = '" . $userId . "' AND project_id = '" . $projectId . "' AND phase = 'Postmortem'";
$rs = mysqli_fetch_array(mysqli_query($con,$sql));
$aPostmortem = $rs['sum(delta_time)'];
$aTotal = $aPlanning + $aDesign + $aCode + $aCompile + $aTest + $aPostmortem;
$aLOCHour = $aNLOC / $aTotal;
$dPlanning = $_POST["dplanning"];
$dDesign = $_POST["ddesign"];
$dCode = $_POST["dcode"];
$dCompile = $_POST["dcompile"];
$dTest = $_POST["dtest"];
$dTotal = $dPlanning + $dDesign + $dCode + $dCompile + $dTest;
$rPlanning = $_POST["rplanning"];
$rDesign = $_POST["rdesign"];
$rCode = $_POST["rcode"];
$rCompile = $_POST["rcompile"];
$rTest = $_POST["rtest"];
$rTotal = $rPlanning + $rDesign + $rCode + $rCompile + $rTest;
$aDevelopment = $_POST["adevelopment"];
$nameThere = FALSE;
$programThere = FALSE;
$professorThere = FALSE;
$programNoThere = FALSE;
$languageThere = FALSE;
$dateThere = FALSE;

$sql = "SELECT * FROM summary_to_date WHERE user_id = '" . $userId . "'";
$result = mysqli_query($con,$sql);
$rows = mysqli_num_rows($result);
if ($rows == 0) {
	$tPlanTime = $pTotal;
	$tActualTime = $aTotal;
} else {
	$tPlanTime = 0;
	$tActualTime = 0;
	while ($rs = mysqli_fetch_array($result)) {
		$tPlanTime = max($tPlanTime,$rs['planned_time']);
		$tActualTime = max($tActualTime,$rs['actual_time']);
	}
	$tPlanTime = $tPlanTime + $pTotal;
	$tActualTime = $tActualTime + $aTotal;
}
$cpi = $tPlanTime / $tActualTime;
$sql = "SELECT * FROM program_size_to_date WHERE user_id = '" . $userId . "'";
$result = mysqli_query($con,$sql);
$rows = mysqli_num_rows($result);
if ($rows == 0) {
	$tRLOC = $aRLOC;
	$tNLOC = $aNLOC;
	$tLLOC = $aLLOC;
	$tTLOC = $aTLOC;
} else {
	$tRLOC = 0;
	$tNLOC = 0;
	$tLLOC = 0;
	$tTLOC = 0;
	while ($rs = mysqli_fetch_array($result)) {
		$tRLOC = max($tRLOC,$rs['reused']);
		$tNLOC = max($tNLOC,$rs['total_new_and_changed']);
		$tLLOC = max($tLLOC,$rs['total_loc']);
		$tTLOC = max($tTLOC,$rs['total_new_reused']);
	}
	$tRLOC = $tRLOC + $aRLOC;
	$tNLOC = $tNLOC + $aNLOC;
	$tLLOC = $tLLOC + $aLLOC;
	$tTLOC = $tTLOC + $aTLOC;
}
$tReused = 100 * $tRLOC / $tLLOC;
$tNReused = 100 * $tRLOC / $tNLOC;
$sql = "SELECT * FROM time_to_date WHERE user_id = '" . $userId . "'";
$result = mysqli_query($con,$sql);
$rows = mysqli_num_rows($result);
if ($rows == 0) {
	$tPlanning = $aPlanning;
	$tDesign = $aDesign;
	$tCode = $aCode;
	$tCompile = $aCompile;
	$tTest = $aTest;
	$tPostmortem = $aPostmortem;
	$tTotal = $aTotal;
} else {
	$tPlanning = 0;
	$tDesign = 0;
	$tCode = 0;
	$tCompile = 0;
	$tTest = 0;
	$tPostmortem = 0;
	$tTotal = 0;
	while ($rs = mysqli_fetch_array($result)) {
		$tPlanning = max($tPlanning,$rs['planning']);
		$tDesign = max($tDesign,$rs['design']);
		$tCode = max($tCode,$rs['code']);
		$tCompile = max($tCompile,$rs['compile']);
		$tTest = max($tTest,$rs['test']);
		$tPostmortem = max($tPostmortem,$rs['postmortem']);
		$tTotal = max($tTotal,$rs['total']);
	}
	$tPlanning = $tPlanning + $aPlanning;
	$tDesign = $tDesign + $aDesign;
	$tCode = $tCode + $aCode;
	$tCompile = $tCompile + $aCompile;
	$tTest = $tTest + $aTest;
	$tPostmortem = $tPostmortem + $aPostmortem;
	$tTotal = $tTotal + $aTotal;
}
$tLOCHour = $tNLOC / $tTotal;
$tPPlanning = 100 * $tPlanning / $tTotal;
$tPDesign = 100 * $tDesign / $tTotal;
$tPCode = 100 * $tCode / $tTotal;
$tPCompile = 100 * $tCompile / $tTotal;
$tPTest = 100 * $tTest / $tTotal;
$tPPostmortem = 100 * $tPostmortem / $tTotal;
$tPTotal = 100;
$sql = "SELECT * FROM defects_injected_to_date WHERE user_id = '" . $userId . "'";
$result = mysqli_query($con,$sql);
$rows = mysqli_num_rows($result);
if ($rows == 0) {
	$tDPlanning = $dPlanning;
	$tDDesign = $dDesign;
	$tDCode = $dCode;
	$tDCompile = $dCompile;
	$tDTest = $dTest;
	$tDTotal = $dTotal;
} else {
	$tDPlanning = 0;
	$tDDesign = 0;
	$tDCode = 0;
	$tDCompile = 0;
	$tDTest = 0;
	$tDTotal = 0;
	while ($rs = mysqli_fetch_array($result)) {
		$tDPlanning = max($tDPlanning,$rs['planning']);
		$tDDesign = max($tDDesign,$rs['design']);
		$tDCode = max($tDCode,$rs['code']);
		$tDCompile = max($tDCompile,$rs['compile']);
		$tDTest = max($tDTest,$rs['test']);
		$tDTotal = max($tDTotal,$rs['total_development']);
	}
	$tDPlanning = $tDPlanning + $dPlanning;
	$tDDesign = $tDDesign + $dDesign;
	$tDCode = $tDCode + $dCode;
	$tDCompile = $tDCompile + $dCompile;
	$tDTest = $tDTest + $dTest;
	$tDTotal = $tDTotal + $dTotal;
}
$tDPPlanning = 100 * $tDPlanning / $tDTotal;
$tDPDesign = 100 * $tDDesign / $tDTotal;
$tDPCode = 100 * $tDCode / $tDTotal;
$tDPCompile = 100 * $tDCompile / $tDTotal;
$tDPTest = 100 * $tDTest / $tDTotal;
$tDPTotal = 100;
$sql = "SELECT * FROM defects_removed_to_date WHERE user_id = '" . $userId . "'";
$result = mysqli_query($con,$sql);
$rows = mysqli_num_rows($result);
if ($rows == 0) {
	$tRPlanning = $rPlanning;
	$tRDesign = $rDesign;
	$tRCode = $rCode;
	$tRCompile = $rCompile;
	$tRTest = $rTest;
	$tRTotal = $rTotal;
	$rADevelopment = $aDevelopment;
} else {
	$tRPlanning = 0;
	$tRDesign = 0;
	$tRCode = 0;
	$tRCompile = 0;
	$tRTest = 0;
	$tRTotal = 0;
	$rADevelopment = 0;
	while ($rs = mysqli_fetch_array($result)) {
		$tRPlanning = max($tRPlanning,$rs['planning']);
		$tRDesign = max($tRDesign,$rs['design']);
		$tRCode = max($tRCode,$rs['code']);
		$tRCompile = max($tRCompile,$rs['compile']);
		$tRTest = max($tRTest,$rs['test']);
		$tRTotal = max($tRTotal,$rs['total_development']);
		$rADevelopment = max($rADevelopment,$rs['after_development']);
	}
	$tRPlanning = $tRPlanning + $rPlanning;
	$tRDesign = $tRDesign + $rDesign;
	$tRCode = $tRCode + $rCode;
	$tRCompile = $tRCompile + $rCompile;
	$tRTest = $tRTest + $rTest;
	$tRTotal = $tRTotal + $rTotal;
	$rADevelopment = $rADevelopment + $aDevelopment;
}
$tRPPlanning = 100 * $tRPlanning / $tRTotal;
$tRPDesign = 100 * $tRDesign / $tRTotal;
$tRPCode = 100 * $tRCode / $tRTotal;
$tRPCompile = 100 * $tRCompile / $tRTotal;
$tRPTest = 100 * $tRTest / $tRTotal;
$tRPTotal = 100;

$sql = "INSERT INTO summary_plan(user_id,project_id,loc_per_hour,planned_time,percent_reused,percent_new_reused) VALUES('" . $userId . "','" . $projectId . "','" . $pLOCHour . "','" . $pTotal . "','" . $pReused . "','" . $pNReused . "')";
$result = mysqli_query($con,$sql) or die(mysqli_error($con));
$sql = "INSERT INTO summary_actual(user_id,project_id,loc_per_hour,actual_time,percent_reused,percent_new_reused) VALUES('" . $userId . "','" . $projectId . "','" . $aLOCHour . "','" . $aTotal . "','" . $aReused . "','" . $aNReused . "')";
$result = mysqli_query($con,$sql) or die(mysqli_error($con));
$sql = "INSERT INTO summary_to_date(user_id,project_id,loc_per_hour,planned_time,actual_time,cpi,percent_reused,percent_new_reused) VALUES('" . $userId . "','" . $projectId . "','" . $tLOCHour . "','" . $tPlanTime . "','" . $tActualTime . "','" . $cpi . "','".  $tReused . "','" . $tNReused . "')";
$result = mysqli_query($con,$sql) or die(mysqli_error($con));
$sql = "INSERT INTO program_size_plan(user_id,project_id,base,deleted,modified,added,reused,total_new_and_changed,total_loc,total_new_reused) VALUES('" . $userId . "','" . $projectId . "','" . $pBLOC . "','" . $pDLOC . "','" . $pMLOC . "','" . $pALOC . "','" . $pRLOC . "','" . $pNLOC . "','" . $pLLOC . "','" . $pTLOC . "')";
$result = mysqli_query($con,$sql) or die(mysqli_error($con));
$sql = "INSERT INTO program_size_actual(user_id,project_id,base,deleted,modified,added,reused,total_new_and_changed,total_loc,total_new_reused) VALUES('" . $userId . "','" . $projectId . "','" . $aBLOC . "','" . $aDLOC . "','" . $aMLOC . "','" . $aALOC . "','" . $aRLOC . "','" . $aNLOC . "','" . $aLLOC . "','" . $aTLOC . "')";
$result = mysqli_query($con,$sql) or die(mysqli_error($con));
$sql = "INSERT INTO program_size_to_date(user_id,project_id,reused,total_new_and_changed,total_loc,total_new_reused) VALUES('" . $userId . "','" . $projectId . "','" . $tRLOC . "','" . $tNLOC . "','" . $tLLOC . "','" . $tTLOC . "')";
$result = mysqli_query($con,$sql) or die(mysqli_error($con));
$sql = "INSERT INTO time_plan(user_id,project_id,planning,design,code,compile,test,postmortem,total) VALUES('" . $userId . "','" . $projectId . "','" . $pPlanning . "','" . $pDesign . "','" . $pCode . "','" . $pCompile . "','" . $pTest . "','" . $pPostmortem . "','" . $pTotal . "')";
$result = mysqli_query($con,$sql) or die(mysqli_error($con));
$sql = "INSERT INTO time_actual(user_id,project_id,planning,design,code,compile,test,postmortem,total) VALUES('" . $userId . "','" . $projectId . "','" . $aPlanning . "','" . $aDesign . "','" . $aCode . "','" . $aCompile . "','" . $aTest . "','" . $aPostmortem . "','" . $aTotal . "')";
$result = mysqli_query($con,$sql) or die(mysqli_error($con));
$sql = "INSERT INTO time_to_date(user_id,project_id,planning,design,code,compile,test,postmortem,total) VALUES('" . $userId . "','" . $projectId . "','" . $tPlanning . "','" . $tDesign . "','" . $tCode . "','" . $tCompile . "','" . $tTest . "','" . $tPostmortem . "','" . $tTotal . "')";
$result = mysqli_query($con,$sql) or die(mysqli_error($con));
$sql = "INSERT INTO time_to_date_percent(user_id,project_id,planning,design,code,compile,test,postmortem,total) VALUES('" . $userId . "','" . $projectId . "','" . $tPPlanning . "','" . $tPDesign . "','" . $tPCode . "','" . $tPCompile . "','" . $tPTest . "','" . $tPPostmortem . "','" . $tPTotal . "')";
$result = mysqli_query($con,$sql) or die(mysqli_error($con));
$sql = "INSERT INTO defects_injected_actual(user_id,project_id,planning,design,code,compile,test,total_development) VALUES('" . $userId . "','" . $projectId . "','" . $dPlanning . "','" . $dDesign . "','" . $dCode . "','" . $dCompile . "','" . $dTest . "','" . $dTotal . "')";
$result = mysqli_query($con,$sql) or die(mysqli_error($con));
$sql = "INSERT INTO defects_injected_to_date(user_id,project_id,planning,design,code,compile,test,total_development) VALUES('" . $userId . "','" . $projectId . "','" . $tDPlanning . "','" . $tDDesign . "','" . $tDCode . "','" . $tDCompile . "','" . $tDTest . "','" . $tDTotal . "')";
$result = mysqli_query($con,$sql) or die(mysqli_error($con));
$sql = "INSERT INTO defects_injected_to_date_percent(user_id,project_id,planning,design,code,compile,test,total_development) VALUES('" . $userId . "','" . $projectId . "','" . $tDPPlanning . "','" . $tDPDesign . "','" . $tDPCode . "','" . $tDPCompile . "','" . $tDPTest . "','" . $tDPTotal . "')";
$result = mysqli_query($con,$sql) or die(mysqli_error($con));
$sql = "INSERT INTO defects_removed_actual(user_id,project_id,planning,design,code,compile,test,total_development,after_development) VALUES('" . $userId . "','" . $projectId . "','" . $rPlanning . "','" . $rDesign . "','" . $rCode . "','" . $rCompile . "','" . $rTest . "','" . $rTotal . "','" . $aDevelopment . "')";
$result = mysqli_query($con,$sql) or die(mysqli_error($con));
$sql = "INSERT INTO defects_removed_to_date(user_id,project_id,planning,design,code,compile,test,total_development,after_development) VALUES('" . $userId . "','" . $projectId . "','" . $tRPlanning . "','" . $tRDesign . "','" . $tRCode . "','" . $tRCompile . "','" . $tRTest . "','" . $tRTotal . "','" . $rADevelopment . "')";
$result = mysqli_query($con,$sql) or die(mysqli_error($con));
$sql = "INSERT INTO defects_removed_to_date_percent(user_id,project_id,planning,design,code,compile,test,total_development) VALUES('" . $userId . "','" . $projectId . "','" . $tRPPlanning . "','" . $tRPDesign . "','" . $tRPCode . "','" . $tRPCompile . "','" . $tRPTest . "','" . $tRPTotal . "')";
$result = mysqli_query($con,$sql) or die(mysqli_error($con));
mysqli_query($con, "UPDATE `project` SET `PPS`= 1 WHERE `project_id` = '".$projectId."' AND `user_id` = '".$userId."'") or die (mysqli_error());
mysqli_close($con);
header("Location:view_project.php?msg=done&user_id=$userId&project_id=$projectId");
?>