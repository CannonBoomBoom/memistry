
<?php
include "includes/db.php";
 
$query  = "SELECT `post`, `title` FROM `memes`";
$res    = mysqli_query($conn,$query);
$count  =   mysqli_num_rows($res);
$slides='';
$Indicators='';
$counter=0;
 
    while($row=mysqli_fetch_array($res))
    {
 
        $title = $row['title'];
        $image = $row['post'];
        if($counter == 0)
        {
            $slides .= '<div class="row">
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
                  <div class="caption">
                  <h3>'.$title.'</h3>
                  <img class="img-responsive" src="data:image;base64,'.base64_encode( $image).'" alt="'.$title.'">
                  <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ratione corporis ad mollitia est distinctio esse earum. Sequi illum culpa, vel exercitationem labore nisi voluptate at perferendis cum cupiditate consequuntur neque.</p>
                  <div class="row">
                      <div class="col-xs-5 col-sm-4 col-md-4 col-lg-4 col-xs-offset-7 col-sm-offset-8 col-md-offset-8 col-lg-offset-8">
                          <a href="#" class="btn btn-danger glyphicon glyphicon-menu-left" role="button"></a> <a href="#" class="btn btn-success glyphicon glyphicon-menu-right" role="button"></a>
                  
                        </div>
                    </div>
                  
                </div>
        
              </div>
            </div>
            </div>';


          
    
	  
        
 
        }
        else
        {
            $slides .= '<div class="row">
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
                  <div class="caption">
                  <h3>'.$title.'</h3>
                  <img class="img-responsive" src="data:image;base64,'.base64_encode( $image).'" alt="'.$title.'">
                  <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ratione corporis ad mollitia est distinctio esse earum. Sequi illum culpa, vel exercitationem labore nisi voluptate at perferendis cum cupiditate consequuntur neque.</p>
                  <div class="row">
                      <div class="col-xs-5 col-sm-4 col-md-4 col-lg-4 col-xs-offset-7 col-sm-offset-8 col-md-offset-8 col-lg-offset-8">
                          <a href="#" class="btn btn-danger glyphicon glyphicon-menu-left" role="button"></a> <a href="#" class="btn btn-success glyphicon glyphicon-menu-right" role="button"></a>
                  
                        </div>
                    </div>
                  
                </div>
        
              </div>
            </div>
            </div>';
        }
        $counter++;
    }
 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
    <title>Reddit Style Posts Page</title>
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <style type="text/css">
 
      img {border-width: 0}
      * {font-family:'Lucida Grande', sans-serif;}
    </style>
  </head>
  <body>
    <h2>Reddit Style Posts Page</h2>
 
<link rel="stylesheet" href="css/bootstrap.min.css" />

<ol>
    <?php
        echo $slides;
    ?>
</ol>


  </body>
</html>