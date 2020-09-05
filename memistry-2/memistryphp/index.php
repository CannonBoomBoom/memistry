<!DOCTYPE html>
<html>
<head>
	<title>Memistry</title>
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
          <li><a href="logout.php"> Logout </a></li>
				</ul>
			  </div><!-- /.navbar-collapse -->
			</div><!-- /.container-fluid -->
		  </nav>


		  <!--Post-->
	<div class="row">
	<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 col-sm-offset-3 col-md-offset-3 col-lg-offset-3">
	  <div class="thumbnail box">
		  <div class="row">

			<!--Profile of Poster -->
			<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
				<img class="img-responsive img-rounded" src="images/profilepicdemo.jpeg" alt="profile-pic">
			  </div>
			  <div>
				<h4>profile name here</h4>
			  </div>
			
		  </div>
		  <!--Image of Post-->
		<div class="caption">
		  <h3>Image Title</h3>
		  <img class="img-responsive" src="images/postimagedemo.jpg" alt="post-image">
		  <p>Description: A disturbance In the force there is</p>
		  <div class="row">
			  <div class="col-xs-5 col-sm-4 col-md-4 col-lg-4 col-xs-offset-7 col-sm-offset-8 col-md-offset-8 col-lg-offset-8">
				  <a href="#" class="btn btn-danger glyphicon glyphicon-menu-left" role="button"></a> <a href="#" class="btn btn-success glyphicon glyphicon-menu-right" role="button"></a>
		  
				</div>
			</div>
		  
		</div>
		
		<!--Posts-->

    <div class="row">
 		<div class="col-sm-12">
 			<h2> Your posts & comments </h2>
 		</div>

 		<div class="col-sm-12 tweets">
			<?php
				$usertweets = $userob->getUserTweets($username, $con);
				$num_tweets = $usertweets->num_rows;
	 			if($num_tweets>0) {
					while($row = $usertweets->fetch_assoc()){
						$type = $row['type'];
			?>
 			<!-- for all tweets -->
 			<div class="tweet">
 				<div class="col-sm-1">
					 <?php
					 	$image_show_tweet = $row['pic'];
						 if($image_show_tweet!="")
							 echo '<img style="width:100%" src="data:image;base64,'.base64_encode($image_show_tweet).'" />';
						 else
							echo '<img src="https://via.placeholder.com/300" />';
					?>
 				</div>
 				<div class="col-sm-11">
					 <?php
					 if($type==2){
						 ?>
				 <small> <a href="profile.php?username=<?php echo $username ?>"><?php echo $username ?></a> retweeted this tweet from <a href="profile.php?username=<?php echo $row['username'] ?>"><?php echo $row['username'] ?></a> on <?php echo date('m/d/Y', strtotime($row['date_tweet'])) ?></small>
				<?php
					 }
					 ?>	 
				 <p class="lead"> <?php 
				 $tweet_text = $row['tweet_text'];

				 $tweet_new_text = preg_replace('/(?<!\S)#([0-9a-zA-Z]+)/', '<a href="hashtag.php?hashtag=$1">#$1</a>', $tweet_text);


				 
				 echo $tweet_new_text ?> </p>
				 <?php
					 if($type==2){
						
						 ?>
				 <small> <?php echo date('m/d/Y', strtotime($row['date_original'])) ?> </small>
				 <?php
					 }
					 else {
					 ?>
					<small> <?php echo date('m/d/Y', strtotime($row['date_tweet'])) ?> </small>
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
 $('#tweetButton').click(function(e){
	var tweetMessage = $('#tweet').val();

	if($.trim(tweetMessage) == ""){
		$('.error').html('Please enter somethng to tweet');
	}
	else{
		$('.error').html('');
		$.ajax({
			method: "POST",
			url: "includes/functions.php",
			data: {tweetMessage: tweetMessage, option: "tweetforuser"}
		}).done(function(msg){
			var message = msg.split("-");
			var pimage = $('.profileimage').html();

			if($.trim(message[0])=='yayy'){
				var tweethtml = '<div class="tweet"><div class="col-sm-1">'+pimage+'</div><div class="col-sm-11"><p class="lead">'+tweetMessage+'</p><small>'+message["2"]+'</small></div></div><div class="clearfix"></div>';
				$('.tweets').prepend(tweethtml);
				$('.error').html('your tweet was successfully submitted');
				$('#tweet').val("");

				$('#noTweets').html(message[1]);
			}
			else{
				$('.error').html('there was an error submitting your tweet');
			}
		});
	}
 });

<!--End posts-->

<!--Comments-->
<div class="container col-xs-10 col-sm-10 col-md-10 col-lg-10">
  <div class="post-comments">
    <form>
      <div class="form-group">
        <label for="comment">Leave A Comment</label>
        <textarea name="comment" class="form-control" rows="3"></textarea>
      </div>
      <button type="submit" class="btn btn-default">Send</button>
    </form>

    <div class="comments-nav">
      <ul class="nav nav-pills">
        <li role="presentation" class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                  there are 2593 comments <span class="caret"></span>
                </a>
          <ul class="dropdown-menu">
            <li><a href="#">Best</a></li>
            <li><a href="#">Hot</a></li>
          </ul>
        </li>
      </ul>
    </div>

    <div class="row">

      <div class="media">
        <!-- first comment -->

        <div class="media-heading">
          <button class="btn btn-default btn-xs" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseExample"><span class="glyphicon glyphicon-minus" aria-hidden="true"></span></button> <span class="label label-info">12314</span> terminator 12 hours ago
        </div>

        <div class="panel-collapse collapse in" id="collapseOne">

          <div class="media-left">
            <div class="vote-wrap">
              <div class="save-post">
                <a href="#"><span class="glyphicon glyphicon-star" aria-label="Save"></span></a>
              </div>
              <div class="vote up">
                <i class="glyphicon glyphicon-menu-up"></i>
              </div>
              <div class="vote inactive">
                <i class="glyphicon glyphicon-menu-down"></i>
              </div>
            </div>
            <!-- vote-wrap -->
          </div>
          <!-- media-left -->


          <div class="media-body">
            <p>yazmayın artık amk, görmeyeyim sol framede. insan bi meraklanıyor, ümitleniyor. sonra yine özlem dolu yazıları görüp hayal kırıklığıyla okuyorum.</p>
            <div class="comment-meta">
              <span><a href="#">delete</a></span>
              <span><a href="#">report</a></span>
              <span><a href="#">hide</a></span>
              <span>
                        <a class="" role="button" data-toggle="collapse" href="#replyCommentT" aria-expanded="false" aria-controls="collapseExample">reply</a>
                      </span>
              <div class="collapse" id="replyCommentT">
                <form>
                  <div class="form-group">
                    <label for="comment">Your Comment</label>
                    <textarea name="comment" class="form-control" rows="3"></textarea>
                  </div>
                  <button type="submit" class="btn btn-default">Send</button>
                </form>
              </div>
            </div>
            <!-- comment-meta -->

            <div class="media">
              <!-- answer to the first comment -->

              <div class="media-heading">
                <button class="btn btn-default btn-collapse btn-xs" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseExample"><span class="glyphicon glyphicon-minus" aria-hidden="true"></span></button> <span class="label label-info">12314</span> vertu 12 sat once yazmis
              </div>

              <div class="panel-collapse collapse in" id="collapseTwo">

                <div class="media-left">
                  <div class="vote-wrap">
                    <div class="save-post">
                      <a href="#"><span class="glyphicon glyphicon-star" aria-label="Save"></span></a>
                    </div>
                    <div class="vote up">
                      <i class="glyphicon glyphicon-menu-up"></i>
                    </div>
                    <div class="vote inactive">
                      <i class="glyphicon glyphicon-menu-down"></i>
                    </div>
                  </div>
                  <!-- vote-wrap -->
                </div>
                <!-- media-left -->


                <div class="media-body">
                  <p>yazmayın artık amk, görmeyeyim sol framede. insan bi meraklanıyor, ümitleniyor. sonra yine özlem dolu yazıları görüp hayal kırıklığıyla okuyorum.</p>
                  <div class="comment-meta">
                    <span><a href="#">delete</a></span>
                    <span><a href="#">report</a></span>
                    <span><a href="#">hide</a></span>
                            <span>
                              <a class="" role="button" data-toggle="collapse" href="#replyCommentThree" aria-expanded="false" aria-controls="collapseExample">reply</a>
                            </span>
                    <div class="collapse" id="replyCommentThree">
                      <form>
                        <div class="form-group">
                          <label for="comment">Your Comment</label>
                          <textarea name="comment" class="form-control" rows="3"></textarea>
                        </div>
                        <button type="submit" class="btn btn-default">Send</button>
                      </form>
                    </div>
                  </div>
                  <!-- comment-meta -->
                </div>
              </div>
              <!-- comments -->

            </div>
            <!-- answer to the first comment -->

          </div>
        </div>
        <!-- comments -->

      </div>
      <!-- first comment -->
      <div class="media">
        <!-- first comment -->

        <div class="media-heading">
          <button class="btn btn-default btn-xs" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseExample"><span class="glyphicon glyphicon-minus" aria-hidden="true"></span></button> <span class="label label-info">12314</span> vertu 12 sat once yazmis
        </div>

        <div class="panel-collapse collapse in" id="collapseThree">

          <div class="media-left">
            <div class="vote-wrap">
              <div class="save-post">
                <a href="#"><span class="glyphicon glyphicon-star" aria-label="Kaydet"></span></a>
              </div>
              <div class="vote up">
                <i class="glyphicon glyphicon-menu-up"></i>
              </div>
              <div class="vote inactive">
                <i class="glyphicon glyphicon-menu-down"></i>
              </div>
            </div>
            <!-- vote-wrap -->
          </div>
          <!-- media-left -->


          <div class="media-body">
            <p>yazmayın artık amk, görmeyeyim sol framede. insan bi meraklanıyor, ümitleniyor. sonra yine özlem dolu yazıları görüp hayal kırıklığıyla okuyorum.</p>
            <div class="comment-meta">
              <span><a href="#">sil</a></span>
              <span><a href="#">kaydet</a></span>
              <span><a href="#">sikayer et</a></span>
              <span>
                        <a class="" role="button" data-toggle="collapse" href="#replyCommentFour" aria-expanded="false" aria-controls="collapseExample">cevapla</a>
                      </span>
              <div class="collapse" id="replyCommentFour">
                <form>
                  <div class="form-group">
                    <label for="comment">Yorumunuz</label>
                    <textarea name="comment" class="form-control" rows="3"></textarea>
                  </div>
                  <button type="submit" class="btn btn-default">Yolla</button>
                </form>
              </div>
            </div>
            <!-- comment-meta -->

            <div class="media">
              <!-- answer to the first comment -->

              <div class="media-heading">
                <button class="btn btn-default btn-collapse btn-xs" type="button" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseExample"><span class="glyphicon glyphicon-minus" aria-hidden="true"></span></button> <span class="label label-info">12314</span> vertu 12 sat once yazmis
              </div>

              <div class="panel-collapse collapse in" id="collapseFour">

                <div class="media-left">
                  <div class="vote-wrap">
                    <div class="save-post">
                      <a href="#"><span class="glyphicon glyphicon-star" aria-label="Kaydet"></span></a>
                    </div>
                    <div class="vote up">
                      <i class="glyphicon glyphicon-menu-up"></i>
                    </div>
                    <div class="vote inactive">
                      <i class="glyphicon glyphicon-menu-down"></i>
                    </div>
                  </div>
                  <!-- vote-wrap -->
                </div>
                <!-- media-left -->


                <div class="media-body">
                  <p>yazmayın artık amk, görmeyeyim sol framede. insan bi meraklanıyor, ümitleniyor. sonra yine özlem dolu yazıları görüp hayal kırıklığıyla okuyorum.</p>
                  <div class="comment-meta">
                    <span><a href="#">sil</a></span>
                    <span><a href="#">kaydet</a></span>
                    <span><a href="#">sikayer et</a></span>
                    <span>
                              <a class="" role="button" data-toggle="collapse" href="#replyCommentFive" aria-expanded="false" aria-controls="collapseExample">cevapla</a>
                            </span>
                    <div class="collapse" id="replyCommentFive">
                      <form>
                        <div class="form-group">
                          <label for="comment">Yorumunuz</label>
                          <textarea name="comment" class="form-control" rows="3"></textarea>
                        </div>
                        <button type="submit" class="btn btn-default">Yolla</button>
                      </form>
                    </div>
                  </div>
                  <!-- comment-meta -->

                  <div class="media">
                    <!-- first comment -->

                    <div class="media-heading">
                      <button class="btn btn-default btn-xs" type="button" data-toggle="collapse" data-target="#collapseFive" aria-expanded="false" aria-controls="collapseExample"><span class="glyphicon glyphicon-minus" aria-hidden="true"></span></button> <span class="label label-info">12314</span> vertu 12 sat once yazmis
                    </div>

                    <div class="panel-collapse collapse in" id="collapseFive">

                      <div class="media-left">
                        <div class="vote-wrap">
                          <div class="save-post">
                            <a href="#"><span class="glyphicon glyphicon-star" aria-label="Kaydet"></span></a>
                          </div>
                          <div class="vote up">
                            <i class="glyphicon glyphicon-menu-up"></i>
                          </div>
                          <div class="vote inactive">
                            <i class="glyphicon glyphicon-menu-down"></i>
                          </div>
                        </div>
                        <!-- vote-wrap -->
                      </div>
                      <!-- media-left -->


                      <div class="media-body">
                        <p>yazmayın artık amk, görmeyeyim sol framede. insan bi meraklanıyor, ümitleniyor. sonra yine özlem dolu yazıları görüp hayal kırıklığıyla okuyorum.</p>
                        <div class="comment-meta">
                          <span><a href="#">sil</a></span>
                          <span><a href="#">kaydet</a></span>
                          <span><a href="#">sikayer et</a></span>
                          <span>
                        <a class="" role="button" data-toggle="collapse" href="#replyCommentSix" aria-expanded="false" aria-controls="collapseExample">cevapla</a>
                      </span>
                          <div class="collapse" id="replyCommentSix">
                            <form>
                              <div class="form-group">
                                <label for="comment">Yorumunuz</label>
                                <textarea name="comment" class="form-control" rows="3"></textarea>
                              </div>
                              <button type="submit" class="btn btn-default">Yolla</button>
                            </form>
                          </div>
                        </div>
                        <!-- comment-meta -->

                        <div class="media">
                          <!-- answer to the first comment -->

                          <div class="media-heading">
                            <button class="btn btn-default btn-collapse btn-xs" type="button" data-toggle="collapse" data-target="#collapseSix" aria-expanded="false" aria-controls="collapseExample"><span class="glyphicon glyphicon-minus" aria-hidden="true"></span></button> <span class="label label-info">12314</span> vertu 12 sat once yazmis
                          </div>

                          <div class="panel-collapse collapse in" id="collapseSix">

                            <div class="media-left">
                              <div class="vote-wrap">
                                <div class="save-post">
                                  <a href="#"><span class="glyphicon glyphicon-star" aria-label="Kaydet"></span></a>
                                </div>
                                <div class="vote up">
                                  <i class="glyphicon glyphicon-menu-up"></i>
                                </div>
                                <div class="vote inactive">
                                  <i class="glyphicon glyphicon-menu-down"></i>
                                </div>
                              </div>
                              <!-- vote-wrap -->
                            </div>
                            <!-- media-left -->


                            <div class="media-body">
                              <p>yazmayın artık amk, görmeyeyim sol framede. insan bi meraklanıyor, ümitleniyor. sonra yine özlem dolu yazıları görüp hayal kırıklığıyla okuyorum.</p>
                              <div class="comment-meta">
                                <span><a href="#">sil</a></span>
                                <span><a href="#">kaydet</a></span>
                                <span><a href="#">sikayer et</a></span>
                                <span>
                              <a class="" role="button" data-toggle="collapse" href="#replyCommentOne" aria-expanded="false" aria-controls="collapseExample">cevapla</a>
                            </span>
                                <div class="collapse" id="replyCommentOne">
                                  <form>
                                    <div class="form-group">
                                      <label for="comment">Yorumunuz</label>
                                      <textarea name="comment" class="form-control" rows="3"></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-default">Yolla</button>
                                  </form>
                                </div>
                              </div>
                              <!-- comment-meta -->


                            </div>
                          </div>
                          <!-- comments -->

                        </div>
                        <!-- answer to the first comment -->

                      </div>
                    </div>
                    <!-- comments -->

                  </div>
                  <!-- first comment -->
                </div>
              </div>
              <!-- comments -->

            </div>
            <!-- answer to the first comment -->

          </div>
        </div>
        <!-- comments -->

      </div>
      <!-- first comment -->
    </div>

  </div>
  <!-- post-comments -->
  
</div>

	
	  </div>
	</div>
  </div>


	<footer class="footer">
		<p>Terms of Service</p>
	</footer>
</body>
</html>