<?php
include 'header.php';
require 'class.phpmailer.php';
require 'class.smtp.php';

/*include 'connection.php';
if(!isset($_SESSION["verified"]))
{
	header("location:forgotpass.php");
	exit;
}
else if(isset($_SESSION["verified"])==1)
{
	//echo "I am in update Password form";
	//header("location:verifyotp.php");
	//exit;
}
*/


?>

<title>Laundry Service & Dry Cleaning Rates | Laundry cleaning Services Rates in Noida</title>
<meta name="description" content="Best dry cleaning and laundry service rates , list here the rate of ironing and laundry cleaning service rates in noida Ghaziabad  ">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<script>
$(document).ready(function()
{
	$('#confirm_pass').on('keyup', function () {
    if ($(this).val() == $('#pass').val()) {
        $('#message').html('Password match').css('color', 'green');
        
    } 
    else $('#message').html('Password do not match!').css('color', 'red');
});
})
</script>
<!-- BANNER -->
	<div class="section banner-page">
		<div class="container">
			<div class="row">
				<div class="col-sm-12 col-md-12">
					<div class="title-page">Update Password</div>
					<ol class="breadcrumb">
						<li><a href="index.php">Home</a></li>
						<li class="active">Update Password</li>
					</ol>
				</div>
			</div>
		</div>
	</div>
	 
	<!-- ABOUT FEATURE -->
	<div class="section pad">
		<div class="container">
			
			<div class="row">
				<div class="col-sm-12 col-md-12">
 							
 							<?php
 							
 								if(isset($_POST["btnupdate"]))
{
		
			$pass=trim(mysql_real_escape_string(md5($_POST["uppass"])));
			//$confirm_pass=trim(mysql_real_escape_string($_POST["confirmpass"]));
				$loginid=mysql_real_escape_string($_SESSION["loginid"]);
		$result9=mysql_query("update tblusers set UserPassword='$pass' where (UserEmail='$loginid' or UserPhone='$loginid')") or die(mysql_error());
		
		if(mysql_affected_rows() && $result9)
	{
		$_SESSION["verified"]=="";
		echo "<div class='alert alert-success fade in'>Well Done!  <br/>Your password has been updated successfully ! You can Login Now</div>";
echo "<script>setTimeout(\"location.href = 'login.php';\",4000);</script>";
	
	/*
		?>
				 <div class=" row alert alert-warning fade in">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong> </strong>Password Updated Success
  </div>
				<?php
	 * 
	 */
	 session_destroy();
    }	
	 
	 	
		else
			{
				?>
				 <div class=" row alert alert-warning fade in">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong> </strong>Can not Update try again later!
  </div>
				<?php
				//echo "<p class='text-error'>Incorrect Password.</p>";
			}
	
	}
		
?>
 			  </div>
 						
 						  <h2 class="section-heading">Change Password
 	               		  </h2>
 	               		  </div>
		 	            <div class="col-sm-8 col-md-8 col-md-offset-2 col-sm-offset-2 col-xs-12">
					
						 <div class="free-quote"> 
						 	<h2 class="section-heading-2 color_white">
						 		Change your password <i class="fa fa-key"></i>
							</h2>
					
				<form method="post" class="form-contact">
						
							 <div class="form-group iconinput">
							 	<input type="password"  name="uppass" id="pass" class="form-control" placeholder="Your Password..." required="">
								<span><i class="fa fa-key"></i></span>
								<div class="help-block with-errors"></div>
		                    	
		    				 </div>
                            <div class="form-group iconinput">
							 	<input type="password"  name="confirmpass" id="confirm_pass" class="form-control" placeholder="Confirm Password..." required="">
								<span><i class="fa fa-lock"></i></span>
								<div class="help-block with-errors"></div>
		                    	<span id='message'></span>
		    				 </div>
                    
                    	<div class="form-group">
							<div id="success"></div>
                       		<button type="submit" class="btn btn-info" name="btnupdate" id="btnsave" >Reset Password</button>
                       		
				          </div>
                          
                     
                        <!--  <input value="Submit" type="button" name="btnsave" class="btn btn-primary" id="btnsave" style="display:none">--> 
				</form>


				</div>
				</div>
				</div>
				
			</div>
		
	
<?php
include 'footercta.php';
include 'footer.php';
?>
