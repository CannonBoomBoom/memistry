<?php

session_start();

if(isset($_SESSION['username']))
	header("Location: profile.php");

include "includes/db.php";

$username = $password = "";
$usernameErr = $passErr = "";
$loginErr = "";

if(isset($_POST['btn-login'])){ 
	if(trim($_POST['username'])=="")
		$usernameErr = "enter username";
	else
		$username = strtolower(trim($_POST['username']));

	if(trim($_POST['password']) == "")
		$passErr = "enter password";
	else{
		$password = trim($_POST['password']);
		$passwordEncrypt = md5($password);
	}

	if($usernameErr=="" && $passErr==""){
		$sql = "select * from user where username='$username' && password='$passwordEncrypt'";
		$result = $con->query($sql);

		if($result->num_rows > 0){
			$_SESSION['username'] = $username;
			header("Location: profile.php");
		}
		else{
			$loginErr = "Error logging in, please check your username and or password";
		}
	}
}


include "includes/header.php";
include "includes/nav_bar.php";
?>

<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<h3> Login to Memistry </h3>
				<p> Enter your username and password to login </p>
				<p class="text-danger"> <?php echo $loginErr ?> </p>
				<form method="post" action="login.php">
					<label> Username </label> <span class="error"> <?php echo $usernameErr ?> </span>
					<input type="text" placeholder="Enter username" name="username" class="form-control" />

					<label> Password </label> <span class="error"> <?php echo $passErr ?> </span>
					<input type="password" placeholder="Enter password" name="password" class="form-control" />

					<input type="submit" class="btn btn-success form-control submit-button" name="btn-login" />

					<br />
					<p> I don't have an account? <a href="register.php"> Register Here </a></p>
				</form>
			</div>
		</div>
	</div>

<?php
	include "includes/footer.php";
?>