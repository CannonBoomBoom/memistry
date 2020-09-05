<?php
include "includes/db.php";

if(isset($_POST['btn-register'])){ //isset checks if the button was clicked or not
	/*if(getimagesize($_FILES['postimage']['tmp_name']) != false){
		$imgContent = addslashes(file_get_contents($_FILES['postimage']['tmp_name'])); // file_get_contents gets the conten of the image to be uploaded to the database as a longblob datatype
	}
	else
		$imgErr = "upload an image";
    }*/
    
        $filename = $_FILES['postimage']['name'];
		$filetmpname = $_FILES['postimage']['tmp_name'];

		$folder = 'uploads/';
		move_uploaded_file($filetmpname,$folder.$filename);
		
        $sql = "INSERT INTO `post` (`image`) VALUES('$filename')";
        if($sql != ""){
            echo "inserted image into database";
        }
    }
?>
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
			
				<form method="post" action="testuploadimage.php" enctype="multipart/form-data">
					
					<label> Upload Image </label> <span class="error">  </span>
					<input type="file" name="postimage" />

					<input type="submit" name="btn-register" class="btn btn-success form-control submit-button" />

					<p> already have an account <a href="login.php"> login here </a></p>
				</form>
			</div>
		</div>
	</div>



<?php
?>