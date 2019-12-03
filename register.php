<?php

include "includes/db.php";

$username = $email = $first_name = $last_name = $password = $registerDone = "";
$usernameErr = $emailErr = $first_nameErr = $last_nameErr = $passErr = $imgErr = "";

if(isset($_POST['btn-register'])){ 

	$username = strtolower(trim($_POST['username'])); 

	if($username == ""){
		$usernameErr = "enter your username";
	} 
	else{

		$sqlUsername = "select * from users where username='$username'";
		$result = $con->query($sqlUsername);
		if($result->num_rows > 0)
			$usernameErr = "username already exists, please try another";
	}


	$email = strtolower(trim($_POST['email'])); 

	if($email == ""){
		$emailErr = "enter your email";
	}
	else{

		$sqlEmail = "select * from users where email='$email'";
		$result = $con->query($sqlEmail);
		if($result->num_rows > 0)
			$emailErr = "email already exists, please try another";
	}

	$first_name = ucfirst(strtolower(trim($_POST['firstname']))); 
	if($first_name == "")
		$first_nameErr = "enter your firstname";

	$last_name = ucfirst(strtolower(trim($_POST['lastname']))); 
	if($last_name == "")
		$last_nameErr = "enter your lastname";


	$password = trim($_POST['password']);
	if($password == "")
		$passErr = "enter your password";
	else
		$passwordEncrypt = md5($password); 

	if(getimagesize($_FILES['profileimage']['tmp_name']) != false){
		$imgContent = addslashes(file_get_contents($_FILES['profileimage']['tmp_name'])); 
	}
	else
		$imgErr = "upload an image";



	if($usernameErr=="" && $emailErr=="" && $first_nameErr=="" && $last_nameErr=="" && $passErr=="" && $imgErr==""){
		$sql = "insert into users(username, email, first_name, last_name, password, picture) values ('$username', '$email', '$first_name', '$last_name', '$passwordEncrypt', '$imgContent')";
	
		if($con->query($sql) === TRUE){
			$registerDone = "new users added successfully";
			$username = $email = $first_name = $last_name = $password = "";
		}
		else{
			echo "error".$con->error;
		}
	}
	
}

include "includes/header.php";
include "includes/nav_bar.php";
?>

<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<h2> Create an account for Memestry! </h2>
				<p> Fill in the following details to create a Memistry account </p>

				<p class="text-success"><?php echo $registerDone ?> </p>

				<form method="post" action="register.php" enctype="multipart/form-data">
					<label> Username </label> <span class="error"> <?php echo $usernameErr ?> </span>
					<input type="text" placeholder="Enter Username" name="username" class="form-control" value="<?php echo $username ?>" />
 
					<label> Email Address </label><span class="error"> <?php echo $emailErr ?> </span>
					<input type="text" placeholder="Enter Email Address" name="email" class="form-control" value="<?php echo $email ?>" />

					<label> First Name </label> <span class="error"> <?php echo $first_nameErr ?> </span>
					<input type="text" placeholder="Enter First Name" name="firstname" class="form-control" value="<?php echo $first_name ?>" />

					<label> Last Name </label> <span class="error"> <?php echo $last_nameErr ?> </span>
					<input type="text" placeholder="Enter Last Name" name="lastname" class="form-control" value="<?php echo $last_name ?>" />

					<label> Password </label> <span class="error"> <?php echo $passErr ?> </span>
					<input type="password" placeholder="Enter Password" name="password" class="form-control" value="<?php echo $password ?>" />
 
					<label> Upload Image </label> <span class="error"> <?php echo $imgErr ?> </span>
					<input type="file" name="profileimage" />

					<input type="submit" name="btn-register" class="btn btn-success form-control submit-button" />

					<p> I already have an account <a href="login.php"> login here </a></p>
				</form>
			</div>
		</div>
	</div>

<?php
	include "includes/footer.php";
?>