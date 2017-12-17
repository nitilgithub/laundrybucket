<?php include('header.php'); ?>
<title>Best laundry service & Laundry pickup service in Indirapuram </title> 
	<!-- BANNER -->
	<div class="section banner-page">
		<div class="container">
			<div class="row">
				<div class="col-sm-12 col-md-12">
					<div class="title-page">Login</div>
					<ol class="breadcrumb">
						<li><a href="index.php">Home</a></li>
						<li class="active">Login</li>
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
					<h2 class="section-heading">
						Login to View Your Order Detail
					</h2>
				</div>
				<div class="col-sm-8 col-md-6 col-md-offset-3 col-sm-offset-2 col-xs-12">
						<?php
    	if(isset($_GET["e"]))  //Alert message for if user subscribe any package without login to their account 
		{
			?>
			<div class=" row alert alert-warning fade in">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong> </strong>To subscribe any package, You must login
  </div>
			
							
		<?php
		}
    	?>
					  							<?php
				
if(isset($_POST["btnlogin"]))
{
		$_SESSION["uemail"]="";
		$_SESSION["umob"]="";
	
	
			$uloginid=mysql_real_escape_string(trim($_POST["loginid"]));
			$upwd=mysql_real_escape_string(trim(md5($_POST["password"])));
			$return_arr = array();
	
			$query="call spUserLogin('$uloginid','$upwd')";			
			
			
			$result=mysql_query($query) or die(mysql_error()) ;

 	if(mysql_affected_rows())
	{
		while($row=mysql_fetch_array($result))
		{
			$row_array['status'] = $row['Status'];
			$row_array['ts'] = $row['TS'];
			$ts=$row['TS'];
			//$row_array['uid'] = $row['UserId'];
			$row_array['uid'] = $row['UserId'];
				$uid=$row_array['uid'];
		if($row_array['ts']==1)
		{
		   $_SESSION["uid"]=$uid;
		 $_SESSION["uloginid"]=$uloginid;
			
        
			$_SESSION["useriid"]=1; //using this session variable in header.php for replacing login option with user name
			$_SESSION["userloginstatus"]=1;
		//header("location:userordershistory.php?otype=dryclean");
		
			if(isset($_GET["e"])) 
		{
			//header("location:laundry.php");
			
			echo "<script>window.location.href='package.php';</script>";
		}
			else
				{
				
		//header("location:userorderhistory.php");
		
		echo "<script>window.location.href='userorderhistory.php';</script>";
				}	
		}
		
		else {
echo "<h4 class='alert alert-success' style='color:black'> ".$row_array['status']."</h3>";			
		}
		}
		

   
   }
	
			
}

		
			?>
					<div class="free-quote">
						<h2 class="section-heading-2 color_white">
							Member Login <i class="fa fa-user"></i>
						</h2>
						
						<form action="" method="post" class="form-contact" ><!--id="contactForm" data-toggle="validator">-->
							<div class="form-group iconinput">
								
								<input type="text" class="form-control" name="loginid" id="p_name" placeholder="Email or Mobile..." required="">
								<span><i class="fa fa-envelope"></i></span>
								<div class="help-block with-errors"></div>
							</div>
							<div class="form-group iconinput">
								
								<input type="password" class="form-control" name="password" id="p_pswd" placeholder="Enter Your Password..." required="">
								<span><i class="fa fa-lock"></i></span>
								<div class="help-block with-errors"></div>
							</div>
							<div class="form-group">
								<input type="checkbox" id="p_remember" >
								<label>Remember Me</label>
							</div>
							
							<div class="form-group">
								<div id="success"></div>
								<button type="submit" class="btn btn-primary" name="btnlogin">LOGIN</button>
							</div>
						</form>
						<div class="loginlinks">
						<a href="forgotpass.php">Forgot Password?</a>
						<br>
						New User <a href="signup.php">Sign Up</a>
						</div>
					</div>

				</div>

			</div>

		</div>
	</div>

<?php include('footercta.php'); ?>
		 
<?php include('footer.php'); ?>