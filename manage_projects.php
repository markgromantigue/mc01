<?php
	error_reporting(0);
	session_start();
    if(!isset($_SESSION['myusername'])){ //if login in session is not set
    header("Location:index.php");
	}

	include_once 'db.php';
    
    //code block for deleting a project
	if(isset($_GET['project_id'])){
		$projectId = $_GET['project_id'];
		$query="DELETE FROM project WHERE project_id like '$projectId'";$result=mysql_query($query);
	}
    
    if(isset($_GET['msg'])){
		$msg = $_GET['msg'];
		if ($msg ==  "fail"){
			?> <script> alert("Please fill up all fields!"); </script> <?php
		} else if ($msg ==  "special"){
			?> <script> alert("Special Characters ()!#$%^&* are not allowed!"); </script> <?php
		} else if ($msg ==  "success"){
			?> <script> alert("Project successfully added!"); </script> <?php
		}
	}
    
    $myusername = $_SESSION['myusername'];
    $strSQL = "SELECT * FROM users WHERE name = '" . $myusername . "'";
    $rs = mysql_query($strSQL);
    $row = mysql_fetch_array($rs);
    $userId = $row[0];
?>

<!DOCTYPE html>
<html>
<head>
	<title>MANAGE PROJECTS</title>
    <link rel="stylesheet" href="css/bootstrap.min.css"charset="utf-8">
    <link rel="stylesheet" href="css/bootstrap-theme.min.css"charset="utf-8">
    <link rel="stylesheet" href="css/profile.css">
    <link rel="stylesheet" href="css/landing-page.css" charset="utf-8">
    <script src="js/jquery.js"></script>
    <script src='js/moment.min.js'></script>
    <script src="js/bootstrap.min.js"></script>
    <script>
        function logoutFunction(){
            $("input#logout").val(1);
            // alert($("input#logout").val());
            $("form#logoutForm").submit();
        }
    </script>
    <script>
        var a = 0;
        var b = 0;
        var elem = 1;
        /*function moreDates() {
            elem = this;
            var newDiv = document.createElement('div');
            alert(elem.value);
        }*/

        function addDates(name) {
            var newDiv = document.createElement('div');
            newDiv.innerHTML = "<br><div id=container><div id=temp2 style= display:inline;><select name='cond'><option value=AND>AND</option><option value=OR>OR</option></select> <select id=doption" + b + "  name=doption[] onchange=myFunction('doption" + b + "','hider" + b + "')><option value=1>Between</option><option value=2>Earlier</option><option value=3>Later</option><option value=4>During</option></select></div> <div id=temp style= display:inline;><input type=date name='d0[]'> <input type=date id=hider" + b + " name=d1[]></div></div>";
            document.getElementById("testing").appendChild(newDiv);
            b++;
        }
		function show_popup() {
		  var p = window.createPopup()
		  var pbody = p.document.body
		  pbody.style.backgroundColor = "lime"
		  pbody.style.border = "solid black 1px"
		  pbody.innerHTML = "This is a pop-up! Click outside to close."
		  p.show(150,150,200,50,document.body)
		}
        function lightbox_open(){
				window.scrollTo(0,0);
				document.getElementById('light').style.display='block';
				document.getElementById('fade').style.display='block';  
        }
        function lightbox_close(){
            document.getElementById('light').style.display='none';
            document.getElementById('fade').style.display='none';
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
				<h2>MANAGE PROJECTS</h2><br>
				<span class = "welcome">
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
					$query="SELECT * from users c, project o WHERE c.user_id = o. user_id AND o. user_id = $userId";$result=mysql_query($query);
                    if(mysql_num_rows($result) > 0){?>
                        <form method="post" action="query.php">
                            <div id="testing"></div><br>
                            <div id="testing2"></div>
                                <input type="button" value='Filter by date' onClick=addDates('testing')>
                        </form>
                        <?php
                        echo "<p></p>";
                        echo '<table class="rockwell" width="100%">';
                        echo '<tr bgcolor="grey" style="font-weight:bold"><td align="center" width="10%">Program no.</td><td width="10%" align="center">Professor</td><td align="center" width="10%">Language</td><td align="center">Options</td><td align="center">Status</td></tr>';
                        while($row = mysql_fetch_array($result)){
                            echo
                            "<table border='1' cellpadding='5px' cellspacing='1px' style='font-family:Verdana, Geneva, sans-serif; color:white; font-size:13px; background-color:black' width='100%'>"
                            ."<tr><td width = '10%' align='center'>"
                            ."<font color='white'>". $row['program_no']."</font>"
                            . "</td>"
                            ."<td width = '10%' align='center'>"
                            ."<font color='white'>". $row['professor']."</font>"
                            . "</td>"
                            ."<td width = '10%' align='center'>"
                            ."<font color='white'>". $row['language']."</font>"
                            . "</td>"
                            ."<td width = '20%' align='center'><a href='view_project.php?project_id=".$row['project_id']."&user_id=".$row['user_id']."'><font color='white'>View Project</font></a></td>"	
                            ."<td width = '20%' align='center'><a href='manage_projects.php?project_id=".$row['project_id']."'" ?> onclick="return confirm('Are you sure you want to delete this project?')";<?php echo "><font color='white'>Delete Project</font></a></td>"
                            ."<td width = '30%' align='center'><font color='white'>". $row['status']."</font></td></tr>"                        
                            ."</table>";
                        }
                        echo '</table>';
                    }else{
                        echo "<center><br><br><h3>You do not have any projects yet!</h3></center>";
                        echo "<center><h5>Click + to add</h5></center>";
                    }
					mysql_close();  
				?>  
                <div id='matDesPlus'>
                    <a href='#' onclick='lightbox_open();'><img src='res/add.png' alt='upload new photo' width='50px'></a>
                </div><!--end of div matDesPlus-->
                
                <div id='light'>
                    <div id="formHeader" style="margin-left:auto; margin-right:auto; background-color:#ecf0f1; width:50%; border-radius:10px;">
                        <h2 style="text-align:center;">Add Project</h2>
                        <span style="text-align:center;"><p>Please fill out the details below.</p></span>
                    </div>
                        <div class="col-md-4">
                            <form action="add_project.php" method="post">
                                <span class="thumb"><center><h3>Project Details</h3></center></span>
                                <hr>
                                Program No: &nbsp;&nbsp;
                                <input type="text" name="program" size="30" value="">
                                <br><br>
                                Professor: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <input type="text" name="prof" size="30" value="">
                                <br><br>
                                Language: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <input type="text" name="lang" size="30" value=""><br><br>
                                <input type="submit" name="submit" value="Submit" style="width:30%; margin-left:155px; margin-top:20px; margin-bottom:8px; border-radius:4px; background-color:#AA3939; color:white;"/>
                            </form>
                        </div><!--end of col-md-4-->
                </div><!--end of light box-->
                
                <div id='fade' onClick='lightbox_close();'></div>
		  	</div><!--end of div content-->
		</div>
	</div>

</body>
</html>