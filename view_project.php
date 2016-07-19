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
    
    if(isset($_GET['msg'])){
		$msg = $_GET['msg'];
		if ($msg ==  "done"){
			?> <script> 
            alert("Data successfully saved!"); 
            window.location.href = "view_project.php?user_id=<?php echo $userId;?>&project_id=<?php echo $projectId;?>";
            </script> <?php
		}
    }
    
    $myusername = $_SESSION['myusername'];
    $strSQL = "SELECT * FROM users WHERE name = '" . $myusername . "'";
    $rs = mysql_query($strSQL);
    $row = mysql_fetch_array($rs);
    
    $query="SELECT * from users c, project o WHERE c.user_id = o. user_id AND o. user_id = $userId AND o. project_id = $projectId";
    $result=mysql_query($query);
    $row2 = mysql_fetch_array($result);
    if($row2['TRL'] == 1 && $row2['PPS'] == 1 && $row2['PIP'] == 1 && $row2['ST'] == 1){
        $query5 = mysql_query("UPDATE `project` SET `status`= 'completed' WHERE `project_id` = '".$projectId."' AND `user_id` = '".$userId."'");
    }
?>

<!DOCTYPE html>
<html>
<head>
	<title>VIEW PROJECT</title>
    <link rel="stylesheet" href="css/bootstrap.min.css"charset="utf-8">
    <link rel="stylesheet" href="css/bootstrap-theme.min.css"charset="utf-8">
    <link rel="stylesheet" href="css/landing-page.css" charset="utf-8">
    <script src="js/jquery.js"></script>
    <script>
            function logoutFunction(){
                $("input#logout").val(1);
                // alert($("input#logout").val());
                $("form#logoutForm").submit();
            }
    </script>
</head>
<body>
    <header>
        <font color="white"><h1>WELCOME <?php echo $row[1] ?>! </font><!--<a href="cart.php"><img align="right" src= "res/cart.png" width="95" height="50"></a><a href="store.php"><img align="right" src= "res/store.png" width="95" height="50">--></h1></a>
    </header>
    <form id="logoutForm" action="logout.php" method="POST">
            <input type="hidden" name="logout" id="logout"/>
    </form>
    
	<div id="frame">
		<div id="page">
			<div id="header">
				<h2>VIEW PROJECT</h2><br>
				<span class = "welcome">
				<a href="manage_projects.php">Go Back To Managing Projects</a><br>
				<a href="#" onclick="logoutFunction();">Log-Out</a>
				</span>
			</div>

			<?php
                if (isset($_SESSION['error']))
                {
                    echo "<span id=\"error\"><p>" . $_SESSION['error'] . "</p></span>";
                    unset($_SESSION['error']);
                }
                ?>

			<div class="content">
				<?php
					$userId = $_GET['user_id'];
					$projectId = $_GET['project_id'];
					$query="SELECT * from users c, project o WHERE c.user_id = o. user_id AND o. user_id = $userId AND o. project_id = $projectId";$result=mysql_query($query);
				?>
				<span class = "rockwell">
				<fieldset>
					<legend><h3><font color="white">Customer Info</font></h3></legend>
					<?php
					$row = mysql_fetch_array($result);
					echo "<b>Program No</b>: " . $row['program_no'] . "<br>";
					//echo "Address: " . $row['address'] . "<br>";
					//echo "Contact No: " . $row['contact_no'] . "<br>";
					echo "<b>Professor: </b>" . $row['professor'];
					?>
				</fieldset>
				<?php
					echo "<b>Language: </b>". $row['language'];
					echo "<br>";
					echo "<br>";

					//$values is an array of strings concatenated by group_concat
					//PRINT CARDS BOUGHT
					$count = count($values);
					echo"<table border='1' cellpadding='5px' cellspacing='1px'>";
					echo '<tr bgcolor="grey" style="font-weight:bold"><td colspan="5" width="30%">Templates</td></tr>';
                    echo"<tr>";
                    echo"<td>";
                    echo "<a href='time_recording_log.php?user_id=$userId&project_id=$projectId'>Time Recording Log</a>";
                    echo "</td>";
					echo"</tr>";
                    echo"<tr>";
                    echo"<td>";
					if($row2['TRL'] == 1 && $row2['ST'] == 1) {
						echo "<a href='ppsForm.php?user_id=$userId&project_id=$projectId'>Project Plan Summary</a>";
					} else {
						echo "Project Plan Summary (requires completing Time Recording Log and Size Estimating Template)";
					}
                    echo "</td>";
					echo"</tr>";
                    echo"<tr>";
                    echo"<td>";
                    echo "<a href='pipForm.php?user_id=$userId&project_id=$projectId'>PIP Form</a>";
                    echo "</td>";
					echo"</tr>";
                    echo"<tr>";
                    echo"<td>";
                    echo "<a href='sizeEstimatingTemplate.php?user_id=$userId&project_id=$projectId'>Size Estimating Template</a>";
                    echo "</td>";
					echo"</tr>";
					
					echo"</table>";
					echo "<br>";
					echo "Date Created: " . $row['date'];
				?>
				</span>
			</div>
		</div>
	</div>


</body>
</html>