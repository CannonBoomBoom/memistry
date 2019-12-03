
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <title>Register-Memistry</title>
  	<meta charset="utf-8" />
  	<meta name="viewport" content="width=divice-width, initial-scale=1" />
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
    <link rel="stylesheet" type="text/css" href="css/style.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  </head>
  <body>
    <nav class="navbar navbar-default navvisuals">
			<div class="container-fluid">
			  <!-- Brand and toggle get grouped for better mobile display -->
			  <div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navheaderCollapse">
				  <span class="sr-only">Toggle navigation</span>
				  <span class="icon-bar"></span>
				  <span class="icon-bar"></span>
          <span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="#">
					<img alt="Brand" margin=3m, nbvcvnm xc0px width=20 src="images/logo.gif">
				</a>
				<p class="navbar-text">Memistry</p>
			  </div>
			
			  <!-- Collect the nav links, forms, and other content for toggling -->
			  <div class="collapse navbar-collapse" id="navheaderCollapse">
				<ul class="nav navbar-nav">
				  <li><a href="home.php">Home</a></li>
				  <li><a href="Login.php">Login</a></li>
				  <li><a href="Profile.php">Profile</a></li>
				  <li><a href="newpost.php">New Post</a></li>
				</ul>
				
				
			  </div><!-- /.navbar-collapse -->
			</div><!-- /.container-fluid -->
		  </nav>
      <!--
    <form>
      <fieldset>
        <legend>Create Account</legend>
        <p>
          <label>Username:</label>
          <input type = "text"
                 id = "myText"/>
        </p>
        <p>
          <label>Password:</label>
          <input type = "password"
                  id = "myPwd"/>
        </p>
        <p>
          <label>Email: &nbsp &nbsp &nbsp </label>
          <input type = "email"
                  id = "myEmail"/>
        </p>
        <div class="row buttons">
    				<div class="col-md-6">
    					<a class="btn btn-primary btn-sm" href="register.html"> Register</a>
    				</div>
        </div>
      </fieldset>
    </form>
-->
<?php
include "includes/db.php";
$username = $email = $password = $registerDone = "";
$usernameErr = $emailErr = $passErr = "";

if(isset($_POST['btn-register'])){ //isset checks if the button was clicked or not

	$username = strtolower(trim($_POST['username'])); // removes white spaces from left and right and strtolower converts the string to lowercase

	if($username == ""){
		$usernameErr = "enter your username";
	}
	else{

		$sqlUsername = "select * from user where username='$username'";
		$result = $conn->query($sqlUsername);
		if($result->num_rows > 0)
			$usernameErr = "username already exists, please try another";
	}


	$email = strtolower(trim($_POST['email'])); // removes white spaces from left and right and strtolower converts the string to lowercase

	if($email == ""){
		$emailErr = "enter your email";
	}
	else{

		$sqlEmail = "select * from user where email='$email'";
		$result = $conn->query($sqlEmail);
		if($result->num_rows > 0)
			$emailErr = "email already exists, please try another";
	}

	$password = trim($_POST['password']);
	if($password == "")
		$passErr = "enter your password";
	else
		$passwordEncrypt = md5($password); //md5 is used to encrypt the password before we save it to the database


	if($usernameErr=="" && $emailErr=="" && $passErr==""){
		$sql = "insert into user(username, email, password) values ('$username', '$email', '$passwordEncrypt')";
	
		if($conn->query($sql) === TRUE){
			$registerDone = "new user added successfully";
			$username = $email = $password = "";
		}
		else{
			echo "error".$conn->error;
		}
	}
	
}




?>
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<h2> Register to Memistry </h2>
				<p> Fill in the following details to create a memistry account </p>

				<p class="text-success"><?php echo $registerDone ?> </p>

				<form method="post" action="Register.php" enctype="multipart/form-data">
					<label> Username </label> <span class="error"> <?php echo $usernameErr ?> </span>
					<input type="text" placeholder="Enter Username" name="username" class="form-control" value="<?php echo $username ?>" />
 
					<label> Password </label> <span class="error"> <?php echo $passErr ?> </span>
					<input type="password" placeholder="Enter Password" name="password" class="form-control" value="<?php echo $password ?>" />

					<label> Email Address </label><span class="error"> <?php echo $emailErr ?> </span>
					<input type="text" placeholder="Enter Email Address" name="email" class="form-control" value="<?php echo $email ?>" />
 

					<input type="submit" name="btn-register" class="btn btn-success form-control submit-button" />

					<p> already have an account <a href="login.php"> login here </a></p>
				</form>
			</div>
		</div>
	</div>

    <footer>
    <p>Terms of Service</p>
  </footer>
  </body>
</html>
