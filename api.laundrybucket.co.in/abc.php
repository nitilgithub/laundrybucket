<?php
include 'header.php';
require 'class.phpmailer.php';
require 'class.smtp.php';
?>
  <title>laundry & ironing services | Dry Cleaning Pickup Services  Noida</title>
<meta name="description" content="laundry Bucket offers Dry cleaning & Laundry services at doorstep in Noida and Ghaziabad, Laundry , ironing services in Noida with  Home pickup and delivery at low rates">

<link rel="publisher" href="https://plus.google.com" />
<meta name="keywords" content="Best Laundry Service in Ghaziabad, Best Laundry Service in Noida, Best Laundry Service in Indirapuram, Laundry and Dry Cleaning Service in Noida ,Laundry and Dry Cleaning Service in Ghaziabad, Laundry and Dry Cleaning Service in Indirapuaram, Best Ironing service in Noida, Best Ironing service in Ghaziabad, Best Ironing service in Indirapuram"/>
<meta name="subject" content=" Dry Cleaning">
<meta name="copyright" content=" laundry bucket">
<meta name="robots" content="index, follow">
<meta name="revised" content="All" />
<meta name="author" content="Admin, info@ laundrybucket.co.in ">
<meta property="og:url" content="http://laundrybucket.co.in/" />
<meta property="og:site_name" content="laundry bucket " />
<meta property="og:image" content="http://laundrybucket.co.in/assets/images/img-1959-copy491x213-160.png" />
<meta property="og:type" content="Local service" />
<link rel="canonical" href="http://laundrybucket.co.in/"/>

<section class="mbr-section mbr-section--relative mbr-section--fixed-size mbr-parallax-background <?php if(!isset($_GET['contid'])) { ?> hidemobilediv <?php } ?>  " id="msg-box3-21" style="background-image: url(assets/images/img-65803888x2592-190.jpg);">
  
   <div class="container-fluid">

<div class="row">

			<div class="col-md-6  col-md-push-1"  style="position:relative; z-index: 3; color:#ffffff; font-family:'Roboto", Helvetica, Arial, sans-serif">
				<h1 class="text-center" style="font-weight: bolder; letter-spacing: 3px">CONTACT US <br/>
					<!--<small class="text-center" style="font-size: 50%; color: #ffffff"> Do you have some kind of problem with our product</small>-->
					</h1>
					
                   	<h3 style="color:#FF6633;"><?php echo $_GET[msg];?></h3>
					<hr>
				
					<form method="post" enctype="multipart/form-data">
  
  
    <div class="form-group">
	<input type="text" name="name" id="name" value="" required=""  class="form-control" pattern=".{3,}" title="Username should only contain letters having minimum length 3 character. e.g. John" style="color:black" placeholder="Enter your Name" />
	
	</div>
	<div class="form-group">
    <input type="email"  name="email" id="email" value="" required="" style="color:black" class="form-control" placeholder="Enter your Email" />
    
   </div>
   <div class="form-group">
    <input type="text"  name="phone" id="phone" pattern="[7-9]{1}[0-9]{9}" value="" required="" style="color:black" class="form-control" placeholder="Enter your Phone No." />
    
   </div>
   
   
    
   
    <div class="form-group">
    <textarea rows="7" name="message" id="message" class="form-control" style="color:black" placeholder=" Your Message"></textarea>
    </div>
    
    
	<input type="submit" value="Send Your Message" name="submit" id="submitButton" class="btn btn-info pull-right" title="Click here to submit your message!" />
	
	
	
</form>  				 	
			<?php
			
			if(isset($_POST["submit"]))
		{
			
			$name=trim($_POST["name"]);
			$email=trim($_POST["email"]);
			$msg=trim($_POST["message"]);
			$phone=trim($_POST["phone"]);
			$error=array();
			
			
					if(preg_match("/^[a-z A-Z]+$/", $name)==false)
					{
						$error[]="Character Only";
					}
					/*
					else if(strlen($name)<3 || strlen($name)>30)
					{
						$error[]="Invalid Name Length";
					}
					*/
					if(filter_var($email,FILTER_VALIDATE_EMAIL)==false)
					{
						$error[]="Invalid Email Address";
					}
					
				
				if(!empty($error))
				{
					foreach($error as $err)
					{
						echo $err.'<br/>';
					}
				}
				else
					{
	$result=mysql_query("insert into tbl_contactenquiry(name,email,phone,message,addon) values('$name','$email','$phone','$msg',NOW())") or die(mysql_error());
	if(mysql_affected_rows())
	{
	
						$mail = new PHPMailer(); // create a new object
$mail->IsSMTP(); // enable SMTP
$mail->SMTPDebug = 0; // debugging: 1 = errors and messages, 2 = messages only
$mail->SMTPAuth = true; // authentication enabled
$mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for GMail
$mail->Host = "smtp.gmail.com";
$mail->Port = 465; // or 587
$mail->IsHTML(true);
$mail->Username = "laundrybucket77@gmail.com"; /*gmail email here*/
$mail->Password = "5qgapFAnR8giCOjA"; /*gmail password here*/
$mail->SetFrom("laundrybucket77@gmail.com"); /*from Address here*/
$mail->Subject = "New Enquiry Mail From  $name";
$mail->Body = "name is : ".$name. "<br/>"."Email is : ".$email. "<br/>"."Mobile No. : ".$phone."<br/>"."Message is ".$msg;
$mail->AddAddress("laundrybucket1988@gmail.com"); /*Email to*/
 if($mail->Send())
    {
    //echo "Message Sent Successfully";
    header("location:thanksconatct.php");
    ?>
    <!--
    <script>
    alert("Message send success");
    </script>
    -->
    <?php
	
	}
    else
    {
    	?>
       <script>
    alert("Message send failure");
    </script> 
    <?php   }
	
	}
					}
		}
				?>	
						
				
				
				<div>&nbsp;</div>
				
				</div>
					</div>
					
					
<div class="row">
	<div>&nbsp;</div>
	</div>

                    
                </div>

</section>


<?php
include 'footer.php';
?>
