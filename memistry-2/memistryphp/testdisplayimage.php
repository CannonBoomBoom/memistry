<?php
include "includes/db.php";
include "includes/class.post.php";

/*
$postob = new post();

if(isset($_GET['image']))
	$image = $_GET['image'];
$postdetails = $postob->getPostDetails($conn);
*/
?>
<!DOCTYPE html>
<html>
<head>
	<title>Create-Memistry</title>
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
		  
<?php
$sql = "SELECT `image`, `title` FROM `post`";
/*
$array = array();*/
$result = $conn->query($sql);
/*
$index = 0;*/
while($row = mysqli_fetch_array($result)){
	/*
	$array[$index] = $row['image'];*/
	echo '<img style="width:60%" src="data:image;base64,'.base64_encode($row['image']).'" />';
}
/*
$index = 0;
foreach($array[$index] as $value)*/
?>

 <div class="container">
 	<div class="row">
 		<div class="col-sm-3 profileimage">
			 <?php/*
			  $image_show = $postdetails['image'];
			  if($image_show!="")
				  echo '<img style="width:100%" src="data:image;base64,'.base64_encode($image_show).'" />';
			  else
				 echo '<img src="https://via.placeholder.com/300" />';
			*/?>
 		</div>
		 </body>

		 </html>
