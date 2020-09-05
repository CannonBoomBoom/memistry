<?php
include "includes/db.php";
?>
<!DOCTYPE html>
<html>
<head>
	<title>Create-Memestry</title>
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
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
			  <span class="sr-only">Toggle navigation</span>
			  <span class="icon-bar"></span>
			  <span class="icon-bar"></span>
			  <span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="#">
				<img alt="Brand" margin=2m, nbvcvnm xc0px width=20 src="images/logo.gif">
			</a>
			<p class="navbar-text">Memistry</p>
		  </div>
		
		  <!-- Collect the nav links, forms, and other content for toggling -->
		  <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
			<ul class="nav navbar-nav">
				<li><a href="home.php">Home</a></li>
				<li><a href="Login.php">Login</a></li>
				<li><a href="Profile.php">Profile</a></li>
				<li><a href="newpost.php">New Post</a></li>
				<li><a href="logout.php"> Logout </a></li>
			</ul>
			
			
		  </div><!-- /.navbar-collapse -->
		</div><!-- /.container-fluid -->
	  </nav>
	<section>
	<?php
		
		if(isset($_POST['btn-register'])){
			if(getimagesize($_FILES['image']['tmp_name']) != false){
				$imgContent = addslashes(file_get_contents($_FILES['image']['tmp_name'])); // file_get_contents gets the content of the image to be uploaded to the database as a longblob datatype
				if($imgContent){
					echo "got image contents";
				}
			}
			$title = $_POST['title'];
			$sql = "insert into `memes`(`post`, `Title`) values ('$imgContent', '$title')";
			if($sql===TRUE){
				echo "sql insert created";
			} 
			if($con->query($sql)===TRUE){
				echo " image inserted successfully";
			} else {
				echo " image not inserted successfully";
			}
		}
	?>
	
	<form method="post" action="newpost.php" enctype="multipart/form-data">
		<label> Upload Image </label> 
					<input type="file" name="image" />
					<input type="text" name="title"/>
					<input type="submit" name="btn-register" class="btn btn-success form-control submit-button" />
	</form>


	<!--display images-->

	<!--
		<form method="post" action="newpost.php" enctype="multipart/form-data">
      <fieldset>
        <legend>Create a new post</legend>
        	<p>
          	<label>Post Title:</label>
          	<input type = "text" id = "myText"/>
        	</p>
        	<div class="input-group">
  				<div class="input-group-prepend">
    				<span class="input-group-text" id="inputGroupFileAddon01">Upload Image</span>
  				</div>
  				<div class="custom-file">
    				<input type="file" name="file" class="custom-file-input" id="inputGroupFile01"
      				aria-describedby="inputGroupFileAddon01">
  				</div>
			</div>
        	<div class="row buttons">
    			<div class="col-md-6">
    				<a class="btn btn-primary btn-sm" type="submit" name="submit" href="#"> UPLOAD</a>
    			</div>
    		</div>
      </fieldset>
    </form>
	-->
	</section>
	<footer class="smallfooter">
		<p>Terms of Service</p>
	</footer>
</body>
</html>