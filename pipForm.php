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
			?> <script> alert("PIP Form saved successfully!"); </script> <?php
		}
		else if ($msg ==  "edit"){
			?> <script> alert("Time log updated successfully!"); </script> <?php
		}
    }
    
    $query="SELECT * from users c, project o WHERE c.user_id = o. user_id AND o. user_id = $userId AND o. project_id = $projectId";
    $result=mysql_query($query);
    $row2 = mysql_fetch_array($result);
    if($row2['PIP'] == 1){
        header("Location:pipView.php?msg=done&user_id=$userId&project_id=$projectId");
    }
?>
<html>
<head>
<title>PIP Form</title>
<script src="js/jquery.js"></script>
<script>
	$(document).ready(function(){
		$("#addProblem").on("click",function() {
			$("#inputProblem").append('<textarea rows="10" cols="70" name="problem[]" required></textarea><br><br>');
		});
		$("#addProposal").on("click",function() {
			$("#inputProposal").append('<textarea rows="10" cols="70" name="proposal[]" required></textarea><br><br>');
		});
	});
</script>
</head>
<body>
<form action="pip.php?user_id=<?php echo $userId?>&project_id=<?php echo $projectId?>" method="post">
Problem Description:<br><button type="button" id="addProblem">Add Another Problem Description</button><br>
<section id="inputProblem"><textarea rows="10" cols="70" name="problem[]" required></textarea><br><br></section>
Proposal Description:<br><button type="button" id="addProposal">Add Another Proposal Description</button><br>
<section id="inputProposal"><textarea rows="10" cols="70" name="proposal[]" required></textarea><br><br></section>
Notes:<br>
<textarea rows="10" cols="70" name="notes" required></textarea><br>
<input type="submit" name="Submit">
</form>
</body>
</html>