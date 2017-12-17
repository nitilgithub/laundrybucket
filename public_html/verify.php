<?php
include 'header.php';
include 'connection.php';
?>
<div class="container-fluid">
	<div class="row">
	<div class="col-md-12 col-sm-12" >
		&nbsp;
		</div>
		<div class="col-md-12 col-sm-12" style="margin-top: 15%;margin-bottom: 23%">
	<div class="col-md-3 col-sm-12">
		</div>
	<div class="col-md-6 col-sm-12">
		
		
		
<?php
if(isset($_GET['email']) && !empty($_GET['email']) AND isset($_GET['hash']) && !empty($_GET['hash']))
{
    // Verify data
    $email = mysql_escape_string($_GET['email']); // Set email variable
    $hash = mysql_escape_string($_GET['hash']); // Set hash variable
    
    
   $search = mysql_query("SELECT UserEmail, UserVerificationCode, UserEmailVerifiedStatus FROM tblusers WHERE UserEmail='".$email."' AND UserVerificationCode='".$hash."' AND UserEmailVerifiedStatus='0'") or die(mysql_error()); 
$match  = mysql_num_rows($search);
//echo $match;

if($match > 0)
{
	mysql_query("UPDATE tblusers SET UserEmailVerifiedStatus='1' WHERE UserEmail='".$email."' AND UserVerificationCode='".$hash."' AND UserEmailVerifiedStatus='0'") or die(mysql_error());
echo '<div class="text-success"><h3>Your account has been activated successfully, you can <a href="useremail.php">login now </a></h3></div>';
    // We have a match, activate the account
}
else
{
 echo '<div class="text-danger"><h3> You  have already activated your account. Please <a href="login.php">Login Now</a></h3></div>';    // No match -> invalid url or account has already been activated.
}
    
    
}

else{
    // Invalid approach
    echo '<div class="text-warning"><h3>Invalid approach, please use the link that has been send to your email.</h3></div>';
}
?>
</div>
<div class="col-md-3 col-sm-12">
		</div>
		</div>
		
			</div>
	</div>
<?php
include 'footer.php';
?>