<?php
include "includes/header.php";
include "includes/nav_bar.php";
?>

<section>
		<form>
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
    				<input type="file" class="custom-file-input" id="inputGroupFile01"
      				aria-describedby="inputGroupFileAddon01">
    				<label class="custom-file-label" for="inputGroupFile01">Choose Image</label>
  				</div>
			</div>
        	<div class="row buttons">
    			<div class="col-md-6">
    				<a class="btn btn-primary btn-sm" href="register.html"> Post</a>
    			</div>
    		</div>
      </fieldset>
    </form>
	</section>

<?php
	include "includes/footer.php";
?>