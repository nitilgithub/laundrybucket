<?php
include 'header.php';
include 'connection.php';

	?>

<title>Laundry Service & Dry Cleaning Rates | Laundry cleaning Services Rates in Noida</title>
<meta name="description" content="Best dry cleaning and laundry service rates , list here the rate of ironing and laundry cleaning service rates in noida Ghaziabad  ">


<div class="container" style="margin-top: 60px">
	
	
	<div class="row" style="background-color:#F0F8FF">
		<div>&nbsp; </div>
		<div>&nbsp; </div>
		
		<div class="col-md-12">
			<h2 style="font-family:Book Antiqua ; letter-spacing: 2px"> Sign in or Create a new account</h2>
			
		
		</div>
	</div>
	
 
<!-- Top to bottom-->

 
 <div class="row" style="margin-top: 20px; background-color:#F0F8FF">
 	
 	<div class="col-md-12" style="margin: 15px">
 	<div class="col-md-5" style="background-color: #A5ABB1;">
 		
 		<?php
			
			if(isset($_POST["btnsave"]))
{
	
	
	$email=trim(mysql_real_escape_string($_POST["email"]));
	$mob=trim(mysql_real_escape_string($_POST["phone"]));
	$pass=(rand(1, 9999));
	
	$error1=array();

	if(isset($_POST['$email'])|| ($_POST['$mob']))
		{ 	
	   if(filter_var($email,FILTER_VALIDATE_EMAIL)==false)
	   {
	   	$error1[]="Invalid email address";
	   }
	   
	   
	   if(preg_match("/^[0-9]+$/", $mob)==FALSE)
	   {
	   	$error1[]="number only";
	   }
	   elseif(strlen($mob)!=10)
	   {
	   	$error1[]="Mobile no. must be of 10 digits";
	   }
		}   
	    
	   	

  if(!empty($error1))
  {
  	foreach ($error1 as $err)
	 {
	 	echo $err."<br/>";
	 }
  }
  else
  	 {
  	 	
   $check_email_query="select * from tbl_reg WHERE email='$email'";
    $result=mysql_query($check_email_query);
	$count=mysql_num_rows($result);
	if(mysql_affected_rows())
	{
		echo "<script>alert('Email $email is already exist in our database, Please try another one!')</script>";
		//header("location:new_joining.php?d");
		//echo "email exist in tabe new joining";
		//$_SESSION["error_msg"]="Email Already Exists";
		
	}

else {
	
	$result=mysql_query("insert into tbl_reg(email,mobile,password,addon) values('$email','$mob','$pass',NOW())") or die(mysql_error());
	//$_SESSION["name1"]=$fname;
	//$_SESSION["channel1"]=$channel;
	
   if(mysql_affected_rows())
   
	{
		//header("location:welcome.php");
		echo "registered success";
		
	}
	else
		{
		
		//header("location:new_joining.php?rf");
		echo "not registered";
				
			
		}
	
}


}

 } 

    
							
		
			?>
 		
 		<h3 style="font-family:Book Antiqua ; letter-spacing: 2px; color: aliceblue">Cretae An Account
 		<hr/>
 		</h3>
 		
 		      <form method="post" enctype="multipart/form-data" style="padding: 8px">
                            <div class="form-group">
                            	
                                <input type="email" class="form-control" id="email" value="" name="email"  placeholder="Email" style="padding: 9px 18px">
                            </div>
                            
                            <h3 style="font-family:Book Antiqua ; letter-spacing: 2px;" class="text-center"> OR </h3>
                            
                            <div class="form-group">
                                <input type="tel" class="form-control" name="phone" placeholder="Mobile No" style="padding: 9px 18px">
                            </div>
                            
                            
            <input value="Signup" type="submit" name="btnsave" class="btn btn-primary">
                        </form>
 		</div>
 		
 		<div class="col-md-1">
 		
 		</div>
 		
 		<div class="col-md-5" style="background-color: #A5ABB1;">
 			<h3 style="font-family:Book Antiqua ; letter-spacing: 2px; color: aliceblue"> Already Registered
 		<hr/>
 		</h3>
 		
 		      <form method="post" enctype="multipart/form-data" style="padding: 8px">
                            <div class="form-group">
                            	
                                <input type="email" class="form-control" id="email" value="" name="email" required="" placeholder="Email" style="padding: 9px 18px">
                            </div>
                            
                           
                            <div class="form-group">
                                <input type="tel" class="form-control" name="phone" placeholder="Mobile No" style="padding: 9px 18px">
                            </div>
                            
                              <div class="form-group">
                            	
                                <input type="password" " class="form-control" id="password" value="" name="password" required="" placeholder="Password" style="padding: 9px 18px">
                            </div>
                            
            <input value="Signin" type="submit" name="submit" class="btn btn-primary">
                        </form>
 		
 		</div>
 		</div>
 			
  
</div>
<!-- end Left to right-->
 
 <div class="row">
<div> &nbsp;</div>
<div> &nbsp;</div>
<div> &nbsp;</div>
<div> &nbsp;</div>
<div> &nbsp;</div>
<div> &nbsp;</div>
<div> &nbsp;</div>
<div> &nbsp;</div>
<div> &nbsp;</div>
<div> &nbsp;</div>
		
		</div>
</div>

	









<?php
include 'footer.php';
?>
