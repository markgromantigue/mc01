<?php 
session_start();

$logout = $_POST['logout'];
if($logout == 1){
    session_destroy();
    echo $logout;
    header("location: index.php");
}else{
    header("location: manage_projects.php");
}
?>