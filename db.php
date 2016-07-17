<?php
$username="root";
$password="1234";
$database="advanse_mc01";

$link = mysql_connect('localhost', $username, $password);
        if (!$link) {
            die('Could not connect');
        }
        @mysql_select_db($database) or die( "Unable to select database");
		session_start();

	function connect()
    {
        global $username;
        global $password;
        global $database;
	

        $link = mysql_connect('localhost', $username, $password);
        if (!$link) {
            die('Could not connect');
        }
        @mysql_select_db($database) or die( "Unable to select database");
    }

?>