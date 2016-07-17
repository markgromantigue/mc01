<?php
session_start();
mysql_connect("localhost","root","1234") or die (mysql_error());
mysql_select_db("advanse_mc01") or die (mysql_error());

$myusername = $_SESSION['myusername'];
$strSQL = "SELECT * FROM users WHERE name = '" . $myusername . "'";
$rs = mysql_query($strSQL);
$row = mysql_fetch_array($rs);

$required = array('program', 'prof', 'lang');
$error = false;
$isSpecial = false;

foreach($required as $field) {
		if (empty($_POST[$field]) || ctype_space($_POST[$field])) {
			$error = true;
		} else if (preg_match('/[\^£$%&*()}{#~?><>|=¬]/', $_POST[$field])){ //Check for special characters
			$isSpecial = true;
		}
	}

	if ($error) {
	    header("location:manage_projects.php?msg=fail");
	} else if ($isSpecial){
		header("location:manage_projects.php?msg=special");
	} else {	
        $strSQL = "INSERT INTO project(user_id,professor,program_no,language,date,status,TRL,PPS,PIP,ST) VALUES ('". $row[0] . "','" . $_POST["prof"] . "','". $_POST["program"] . "','" . $_POST["lang"] . "', CURRENT_TIMESTAMP, 'in progress',0,0,0,0)";
		 mysql_query($strSQL);
		 header("location:manage_projects.php?msg=success");
	}



?>
