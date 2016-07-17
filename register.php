<?php
	if(isset($_GET['msg'])){
		$msg = $_GET['msg'];
		if ($msg ==  "fail"){
			?> <script> alert("Please fill up all fields!"); </script> <?php
		} else if ($msg ==  "special"){
			?> <script> alert("Special Characters ()!#$%^&* are not allowed!"); </script> <?php
		} else if ($msg ==  "bday"){
			?> <script> alert("Invalid Date!"); </script> <?php
		} else if ($msg ==  "user"){
			?> <script> alert("Username already taken!"); </script> <?php
		}
	}
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Register</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="css/bootstrap.min.css">
		<link rel="stylesheet" href="css/bootstrap-theme.min.css">
		<link rel="stylesheet" href="css/signup-in-style.css">

		<script src="js/jquery.min.js"></script>
		<script src="js/gen_validatorv4.js" type="text/javascript"></script>

	</head>
	<body>

		<nav class="navbar navbar-static-top">
			<div class="container-fluid">
				<div class="navbar-header">
					<a href="" class="navbar-brand"><!--<img src="assets/images/TRACKME LOGO2.png" alt="Logo" class="logo">--></a>
				</div>
			</div>
		</nav>
		<div class="container">
			<div class="content">
				<form id="form1" action="submit.php" method="post">
					<h2>Sign Up</h2>
					<hr>
					Name: <input type="text" name="username" size="30" value="">
					<br><br>
					Password: <input type="password" name="pass" size="20" value="">
					<br><br>

                    Program: <input type="text" name="me" size="30" value=""><br><br>

				<input class="btn-danger" type="submit" name="submit" value="Sign up">
				</form>
			</div>
		</div><!-- container -->
	
		<script type="text/javascript">
		 var frmvalidator = new Validator("form1");
		 
		 frmvalidator.addValidation("username","req","Please enter a username");
		 frmvalidator.addValidation("username","alnum","Special characters are not allowed");
		 frmvalidator.addValidation("username","maxlen=50","Max length for username is 50");
		 
		 frmvalidator.addValidation("pass","req","Please enter a password");
		 frmvalidator.addValidation("pass","alnum","Special characters are not allowed");
		 frmvalidator.addValidation("pass","maxlen=50","Max length for username is 50");
		 
		 frmvalidator.addValidation("me","req","Please enter your program");
		</script>
	</body>
</html>
