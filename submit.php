<?php
mysql_connect("localhost","root","1234") or die (mysql_error());
mysql_select_db("advanse_mc01") or die (mysql_error());

$strSQL = "SELECT COUNT(*) FROM users WHERE name = '" . $_POST["username"] . "' AND password = '" . $_POST["pass"] . "'";
$rs = mysql_query($strSQL);
$row = mysql_fetch_array($rs);
$count = $row[0];

$required = array('username', 'pass', 'me');
$error = false;
$isSpecial = false;
$pass = $_POST["pass"];

foreach($required as $field) {
		if (empty($_POST[$field]) || ctype_space($_POST[$field])) {
			$error = true;
		} else if (preg_match('/[\^£$%&*()}{#~?><>|=¬]/', $_POST[$field])){ //Check for special characters
			$isSpecial = true;
		}
	}
    
    //password encoding
    $salt = sha1(md5($pass));
    $pass = md5($pass.$salt);

	if ($error) {
	    header("location:register.php?msg=fail");
	} else if ($isSpecial){
		header("location:register.php?msg=special");
	} else if ($count == 1) {
		header("location:register.php?msg=user");
	} else {	
        $strSQL = "INSERT INTO users(name,program,password) VALUES ('". $_POST["username"] . "','" . $_POST["me"] . "','" . $pass . "')";
		 mysql_query($strSQL);
		 header("location:index.php?msg=success");
	}



?>
