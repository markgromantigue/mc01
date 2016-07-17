<?php

mysql_connect("localhost","root","1234") or die (mysql_error());
mysql_select_db("advanse_mc01") or die (mysql_error());
$tbl_name = "users";

// username and password sent from form
$myusername=$_POST['username'];
$salt = sha1(md5($_POST['pass']));
$mypassword = md5($_POST['pass'].$salt);

// To protect MySQL injection
$myusername = stripslashes($myusername);
$mypassword = stripslashes($mypassword);
$myusername = mysql_real_escape_string($myusername);
$mypassword = mysql_real_escape_string($mypassword);
//$sql="SELECT * FROM $tbl_name WHERE username='$myusername' and password='$mypassword'";
$result = mysql_query("SELECT * FROM $tbl_name WHERE name='$myusername' and password='$mypassword'");

// Mysql_num_row is counting table row
$count=mysql_num_rows($result);

$row = mysql_fetch_array($result);

// If result matched $myusername and $mypassword, table row must be 1 row
if($count==1){
// Register $myusername, $mypassword and redirect to file "profile.php"
session_start();
$_SESSION['myusername'] = $myusername;
header("location:manage_projects.php");
}
else {
header("location:index.php?message=Wrong Name or Password");
}


?>
</html>
