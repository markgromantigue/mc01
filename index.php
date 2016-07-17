<?php
	if(isset($_GET['msg'])){	
		$msg = $_GET['msg'];
		if ($msg ==  "success"){
			?> <script> alert("Registration Successful!"); </script> <?php
		}
	}
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Sign In</title>
		<meta charset="UTF-8">
		<meta name="veiwport" content="wdith=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="css/bootstrap.min.css">		
		<link rel="stylesheet" href="css/bootstrap-theme.min.css">
		<link rel="stylesheet" href="css/signup-in-style.css">
	</head>
	<body>

		<nav class="navbar navbar-static-top">
			<div class="container-fluid">
				<div class="navbar-header">
					<a href="index.php" class="navbar-brand"><!--<img src="assets/images/TRACKME LOGO2.png" alt="Logo" class="logo"> --></a>
				</div>
			</div>
		</nav>

		<div class="container">
			<div class="content">
				<form action="checklogin.php" method="post">
					<center><h2>Sign In</h2></center>
					<hr>
					Name: <input type="text" name="username" placeholder="Username" id="username"/>
					<br /><br />
					Password: <input type="password" name="pass" placeholder="Password" id="pass"/>
					<br /><br />
					<br>
					<center>
					<button class="btn-danger">Sign In</button>
					<a href="register.php">
						<button class="btn-danger" type="button">Register</button>
					</a>
					</center>
				</form>
				<br>
				<center>
				<?php
					if(isset($_GET['message'])){
						$msg = $_GET['message'];
						echo $msg;
						
					}
				?>
				</center>
					</div>
		</div>

	
	</body>
</html>