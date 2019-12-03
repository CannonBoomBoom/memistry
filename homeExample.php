<?php
include "includes/header.php";
include "includes/nav_bar.php";
include "includes/db.php";

$query  = "select memes.post, memes.Title, memes.username, users.username, users.picture from memes inner join users where memes.username=users.username order by meme_id desc";
$res    = mysqli_query($con,$query);
$count  =   mysqli_num_rows($res);
$slides='';
$Indicators='';
$counter=0;

    while($row=mysqli_fetch_array($res))
    {

        $title = $row['Title'];
        $image = $row['post'];
        $username = $row['username'];
        $user_pic = $row['picture'];

        if($counter == 0)
        {
            $slides .= 
            '<div class="item active">
            <img src="data:image;base64,'.base64_encode( $image).'" alt="'.$title.'" />
            <div class="carousel-caption">
              <h3>'.$title.'</h3> 
            </div>
          </div>';

        }
        else
        {
            $slides .= 
            '<div class="item">
            <img src="data:image;base64,'.base64_encode( $image).'" alt="'.$title.'" />
            <div class="carousel-caption">
              <h3>'.$title.'</h3>       
            </div>
          </div>';
        }
        $counter++;
    }

?>
<div class="row">
	<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 col-sm-offset-3 col-md-offset-3 col-lg-offset-3">
	  <div class="thumbnail box">
		  <div class="row">
		  <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
				<img class="img-responsive img-rounded" src="images/profilepicdemo.jpeg" alt="profile-pic">
			  </div>
			  <div>
				<h4>profile name here</h4>
			  </div>
			
		  </div>
          
          <div id="carousel-example-generic" class="carousel slide">

        <!-- Wrapper for slides -->
        <div class="carousel-inner">
        <?php echo $slides; ?>  
        </div>


		  <!--<img class="img-responsive" src="images/postimagedemo.jpg" alt="post-image">-->
          <p><?php echo $title; ?></p>
		  <div class="row">
			  
		  <div class="col-xs-5 col-sm-4 col-md-4 col-lg-4 col-xs-offset-7 col-sm-offset-8 col-md-offset-8 col-lg-offset-8">
                    <a href="#carousel-example-generic" data-slide="next">
                    <span class="btn btn-danger glyphicon glyphicon-chevron-left"></span>
                    </a>
                    <a href="#carousel-example-generic" data-slide="next">
                        <span class="btn btn-success glyphicon glyphicon-chevron-right"></span>
                    </a>
				</div>
			</div>

		</div>
		<div class="media">
			<div class="media-left">
			  <a href="#">
				<img class="media-object" src="images/profilepicdemo.jpeg" alt="...">
			  </a>
			</div>
			<div class="media-body">
			  <h4 class="media-heading">Profile Name</h4>
			  ...
			</div>
		  </div>
	  </div>
	</div>
  </div>

 
<?php
	include "includes/footer.php";
?>