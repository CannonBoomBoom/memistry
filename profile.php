<?php

session_start();

if(!isset($_SESSION['username']))
	header("Location: login.php");


include "includes/db.php"; 
include "includes/class.user.php";

$userob = new users();

if(isset($_GET['username']))
	$username = trim($_GET['username']);
else
	$username  = $_SESSION['username'];


$userdetails = $userob->getUserDetails($username, $con);
 

include "includes/header.php";
include "includes/nav_bar.php";
?>

<div class="container">
 	<div class="row">
 		<div class="col-sm-3 profileimage">
			 <?php
			  $image_show = $userdetails['picture'];
			  if($image_show!="")
				  echo '<img style="width:100%" src="data:image;base64,'.base64_encode($image_show).'" />';
			  else
				 echo '<img src="https://via.placeholder.com/300" />';
			?>
 		</div>

 		<div class="col-sm-9">
 			<h1> <?php echo $userdetails['first_name']." ".$userdetails['last_name']; ?> </h1>
 			<div class="col-sm-3">
 				<h4> Followers </h4>
 				<p> <?php echo $userob->getNoFollowers($username, $con) ?></p>
 			</div>
 			<div class="col-sm-3">
 				<h4> Following </h4>
 				<p> <?php echo $userob->getNoFollows($username, $con) ?></p>
 			</div>
 			<div class="col-sm-3">
 				<h4> Memes </h4>
 				<p id="noMemes"> <?php echo $userob->getNoMemes($username, $con) ?> </p>
 			</div>
 			<div class="col-sm-3">
 				<h4> Likes </h4>
 				<p> <?php echo $userob->getNoLikes($username, $con) ?> </p>
			 </div>
			 

			 <?php
			 if($username != $_SESSION['username']){
				 $isFollow = $userob->isFollowing($username, $_SESSION['username'], $con);
				
				 $class="";
				 if($isFollow=='yes')
				 	$class='btn-danger';
				 else
				 	$class='btn-success';
				 ?>
			 		<div class="col-sm-12">
						 <button class="btn <?php echo $class ?> follow-button" onclick="followUser('<?php echo $username ?>')"><?php if($isFollow=='yes') { echo "Unfollow"; } else { echo "Follow"; } ?></button>
			 		</div>
			 <?php
			 }
			 ?>
 		</div>
	 </div>
	 <?php
	 if($username == $_SESSION['username']){
	?>
 	<div class="row">
 		<div class="col-sm-12">
			 <h2> Create your Meme </h2>
			 <p class="error"></p>
 			 <textarea class="form-control" id="meme"></textarea>
 			 <a class="btn btn-primary pull-right" id="memeButton"> Time to Meme </a>
 		</div>
	 </div>
	 <?php
	 }
	 ?>


 	<div class="row">
 		<div class="col-sm-12">
 			<h2> Your Memes </h2>
 		</div>

 		<div class="col-sm-12 memes">
			<?php
				$usermemes = $userob->getUserMemes($username, $con);
				$num_memes = $usermemes->num_rows;
	 			if($num_memes>0) {
					while($row = $usermemes->fetch_assoc()){
						$type = $row['type'];
			?>
 			<div class="meme">
 				<div class="col-sm-1">
					 <?php
					 	$image_show_meme = $row['pic'];
						 if($image_show_meme!="")
							 echo '<img style="width:100%" src="data:image;base64,'.base64_encode($image_show_meme).'" />';
						 else
							echo '<img src="https://via.placeholder.com/300" />';
					?>
 				</div>
 				<div class="col-sm-11">
					 <?php
					 if($type==2){
						 ?>
				 <small> <a href="profile.php?username=<?php echo $username ?>"><?php echo $username ?></a> rememeed this meme from <a href="profile.php?username=<?php echo $row['username'] ?>"><?php echo $row['username'] ?></a> on <?php echo date('m/d/Y', strtotime($row['date_meme'])) ?></small>
				<?php
					 }
					 ?>	 
				 <p class="lead"> <?php 
				 $meme_text = $row['meme_text'];

				 $meme_new_text = preg_replace('/(?<!\S)#([0-9a-zA-Z]+)/', '<a href="hashtag.php?hashtag=$1">#$1</a>', $meme_text);


				 
				 echo $meme_new_text ?> </p>
				 <?php
					 if($type==2){
						
						 ?>
				 <small> <?php echo date('m/d/Y', strtotime($row['date_original'])) ?> </small>
				 <?php
					 }
					 else {
					 ?>
					<small> <?php echo date('m/d/Y', strtotime($row['date_meme'])) ?> </small>
					 <?php
					 }
					 ?>
 				</div>
 			</div>

 			<div class="clearfix"></div>
			 
			 
			 <?php
				 }
				}
			?>
			</div>


 		</div>
 	</div>


 </div>
 <script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>

 <script>
 $('#memeButton').click(function(e){
	var memeMessage = $('#meme').val();

	if($.trim(memeMessage) == ""){
		$('.error').html('Please enter somethng to meme');
	}
	else{
		$('.error').html('');
		$.ajax({
			method: "POST",
			url: "includes/functions.php",
			data: {memeMessage: memeMessage, option: "memeforuser"}
		}).done(function(msg){
			var message = msg.split("-");
			var pimage = $('.profileimage').html();

			if($.trim(message[0])=='yayy'){
				var memehtml = '<div class="meme"><div class="col-sm-1">'+pimage+'</div><div class="col-sm-11"><p class="lead">'+memeMessage+'</p><small>'+message["2"]+'</small></div></div><div class="clearfix"></div>';
				$('.memes').prepend(memehtml);
				$('.error').html('your meme was successfully submitted');
				$('#meme').val("");

				$('#nomemes').html(message[1]);
			}
			else{
				$('.error').html('there was an error submitting your meme');
			}
		});
	}
 });


 function followUser(username){
	$.ajax({
		method: "POST",
		url: "includes/functions.php",
		data:{following: username, option: "followUser"}
	}).done(function(msg){
		
		if($.trim(msg)=='success'){
			if($.trim($('.follow-button').html()) == 'Unfollow'){
				$('.follow-button').html('Follow');
				$('.follow-button').removeClass('btn-danger');
				$('.follow-button').addClass('btn-success');
			}
			else{
				$('.follow-button').html('Unfollow');
				$('.follow-button').removeClass('btn-success');
				$('.follow-button').addClass('btn-danger');
			}
		}
	});
	
 }
 </script>

<?php
	include "includes/footer.php";
?>