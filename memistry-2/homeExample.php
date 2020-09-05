<?php
session_start();
if(isset($_SESSION['username'])){

include "includes/nav_bar.php";
include "includes/db.php";
include "includes/class.user.php";

$userob = new users();

$username = $_SESSION['username'];

$row = $userob->getUserDetails($username, $con);

include "includes/header.php";

$meme_id = 

$query  = "select memes.post, memes.Title, memes.username, users.username, users.picture 
from memes inner join users ON memes.username = users.username order by meme_id desc";

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
            <div>
                  <img style="width:50px;" src="data:image;base64,'.base64_encode( $user_pic).'" alt="'.$username.'" />
                </div>
                <div>
                  <h4>'.$username.'</h4>
                </div>
            <img style="width:100%;" src="data:image;base64,'.base64_encode( $image).'" alt="'.$title.'" />
            <div>
              <h3>'.$title.'</h3> 
            </div>
          </div>';

        }
        else
        {
            $slides .= 
            '<div class="item">
            <div>
                  <img style="width:50px;" src="data:image;base64,'.base64_encode( $user_pic).'" alt="'.$username.'" />
                </div>
                <div>
                  <h3>'.$username.'</h3>
                </div>
            <img style="width:100%;" src="data:image;base64,'.base64_encode( $image).'" alt="'.$title.'" />
            <div>
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
          
          <div id="carousel-example-generic" class="carousel slide" data-interval="false">

        <!-- Wrapper for slides -->
        <div class="carousel-inner">
        <?php echo $slides; ?>  
        </div>


		  <!--<img class="img-responsive" src="images/postimagedemo.jpg" alt="post-image">-->
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
			  <h4 class="media-heading"></h4>
			  
			</div>
		  </div>
	  </div>
	</div>
  </div>

 
<?php
	include "includes/footer.php";
?>
<?php
	}
	else{
  		header("Location:login.php");
	}
?>