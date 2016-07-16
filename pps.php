<?php
$con = mysqli_connect("localhost","root","") or die(mysqli_error());
mysqli_select_db($con,"mco1") or die(mysqli_error($con));
$name = $_POST["name"];
$program = $_POST["program"];
$professor = $_POST["professor"];
$programNo = $_POST["program_no"];
$language = $_POST["language"];
$date = $_POST["datetime"];
$pLOCHour = $_POST["plochour"];
$aLOCHour = $_POST["alochour"];
$pTime = $_POST["ptime"];
$aTime = $_POST["atime"];
$pBLOC = $_POST["pbloc"];
$pDLOC = $_POST["pdloc"];
$pMLOC = $_POST["pmloc"];
$pALOC = $_POST["paloc"];
$pRLOC = $_POST["prloc"];
$pNLOC = $pMLOC + $pALOC;
$pLLOC = $pALOC + $pBLOC + $pRLOC - $pDLOC;
$pTLOC = $_POST["ptloc"];
$aBLOC = $_POST["abloc"];
$aDLOC = $_POST["adloc"];
$aMLOC = $_POST["amloc"];
$aALOC = $_POST["aaloc"];
$aRLOC = $_POST["arloc"];
$aNLOC = $aMLOC + $aALOC;
$aLLOC = $aALOC + $aBLOC + $aRLOC - $aDLOC;
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
$aPlanning = $_POST["aplanning"];
$aDesign = $_POST["adesign"];
$aCode = $_POST["acode"];
$aCompile = $_POST["acompile"];
$aTest = $_POST["atest"];
$aPostmortem = $_POST["apostmortem"];
$aTotal = $aPlanning + $aDesign + $aCode + $aCompile + $aTest + $aPostmortem;
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
$sql = "SELECT * FROM summary_to_date WHERE user_id = '" . $userId . "'";
$result = mysqli_query($con,$sql);
$rows = mysqli_num_rows($result);
if ($rows == 0) {
	$tPlanTime = $pTime;
	$tActualTime = $aTime;
} else {
	$tPlanTime = 0;
	$tActualTime = 0;
	while ($row = mysqli_fetch_array($result)) {
		$tPlanTime = max($tPlanTime,$row['planned_time']);
		$tActualTime = max($tActualTime,$row['actual_time']);
	}
	$tPlanTime = $tPlanTime + $pTime;
	$tActualTime = $tActualTime + $aTime;
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
	while ($row = mysqli_fetch_array($result)) {
		$tRLOC = max($tRLOC,$row['reused']);
		$tNLOC = max($tNLOC,$row['total_new_and_changed']);
		$tLLOC = max($tLLOC,$row['total_loc']);
		$tTLOC = max($tTLOC,$row['total_new_reused']);
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
	while ($row = mysqli_fetch_array($result)) {
		$tPlanning = max($tPlanning,$row['planning']);
		$tDesign = max($tDesign,$row['design']);
		$tCode = max($tCode,$row['code']);
		$tCompile = max($tCompile,$row['compile']);
		$tTest = max($tTest,$row['test']);
		$tPostmortem = max($tPostmortem,$row['postmortem']);
		$tTotal = max($tTotal,$row['total']);
	}
	$tPlanning = $tPlanning + $aPlanning;
	$tDesign = $tDesign + $aDesign;
	$tCode = $tCode + $aCode;
	$tCompile = $tCompile + $aCompile;
	$tTest = $tTest + $aTest;
	$tPostmortem = $tPostmortem + $aPostmortem;
	$tTotal = $tTotal + $aTotal;
}
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
	while ($row = mysqli_fetch_array($result)) {
		$tDPlanning = max($tDPlanning,$row['planning']);
		$tDDesign = max($tDDesign,$row['design']);
		$tDCode = max($tDCode,$row['code']);
		$tDCompile = max($tDCompile,$row['compile']);
		$tDTest = max($tDTest,$row['test']);
		$tDTotal = max($tDTotal,$row['total_development']);
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
	while ($row = mysqli_fetch_array($result)) {
		$tRPlanning = max($tRPlanning,$row['planning']);
		$tRDesign = max($tRDesign,$row['design']);
		$tRCode = max($tRCode,$row['code']);
		$tRCompile = max($tRCompile,$row['compile']);
		$tRTest = max($tRTest,$row['test']);
		$tRTotal = max($tRTotal,$row['total_development']);
		$rADevelopment = max($rADevelopment,$row['after_development']);
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
$sql = "INSERT INTO summary_plan(user_id,project_id,loc_per_hour,planned_time,percent_reused,percent_new_reused) VALUES('" . $userId . "','" . $projectId . "','" . $pLOCHour . "','" . $pTime . "','" . $pReused . "','" . $pNReused . "')";
$result = mysqli_query($con,$sql) or die(mysqli_error($con));
$sql = "INSERT INTO summary_actual(user_id,project_id,loc_per_hour,actual_time,percent_reused,percent_new_reused) VALUES('" . $userId . "','" . $projectId . "','" . $aLOCHour . "','" . $aTime . "','" . $aReused . "','" . $aNReused . "')";
$result = mysqli_query($con,$sql) or die(mysqli_error($con));
$sql = "INSERT INTO summary_to_date(user_id,project_id,planned_time,actual_time,cpi,percent_reused,percent_new_reused) VALUES('" . $userId . "','" . $projectId . "','" . $tPlanTime . "','" . $tActualTime . "','" . $cpi . "','".  $tReused . "','" . $tNReused . "')";
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
mysqli_close($con);
?>