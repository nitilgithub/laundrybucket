<?php
require 'class.phpmailer.php';
require 'class.smtp.php';
include 'connection.php';
error_reporting(0);
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
$op=intval($_GET["op"]);
$uid=intval($_GET["uid"]);
$utype=$_GET['utype'];
$uemail=$_GET['uemail'];
$upwd=$_GET['upwd'];
$ufname=$_GET['ufname'];
$ulname=$_GET['ulname'];
$udob=$_GET['udob'];
$usex=$_GET['usex'];
$ucity=$_GET['ucity'];
$ustate=$_GET['ustate'];
$uzip=$_GET['uzip'];
$uev=$_GET['uev'];
$uvmob=$_GET['uvmob'];
$uvcode=$_GET['uvcode'];
$uip=$_GET['uip'];
$uph=$_GET['uph'];
$ufax=$_GET['ufax'];
$uc=$_GET['uc'];
$uadd=$_GET['uadd'];
$ua=$_GET['ua'];
$uuby=$_GET['uuby'];
$uremark=$_GET['uremark'];



//if( $op==0)
//$op=7;

// Create connection
$conn = mysqli_connect($servername, $username, $password,$db);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Conection Process Complete
$return_arr = array();	

$query="call spUsers($op,$uid,$utype,'$uemail','$upwd','$ufname','$ulname','$udob','$usex','$ucity','$ustate','$uzip','$uev',
'$uvcode','$uip','$uph','$ufax','$uc','$uadd','$ua',$uuby,'$uremark')";
echo "$query";
$result=mysqli_query($conn,$query);

 	if(mysqli_affected_rows($conn))
	{
		while($row=mysqli_fetch_array($result))
		{
			$row_array['op'] = $row['OP'];
			$row_array['status'] = $row['Status'];
			$row_array['ts'] = $row['TS'];
			$ts=$row['TS'];
			
		
			
			if(($op==4 || $op==7) && $ts==1 )
			{
				
				
				$row_array['uid']=$row['UserID'];
				$row_array['utype']=$row['UserType'];
				$row_array['uemail']=$row['UserEmail'];
				$row_array['upwd']=$row['UserPassword'];
				$row_array['ufname']=$row['UserFirstName'];
				$row_array['ulname']=$row['UserLastName'];
				$row_array['udob']=$row['UserDOB'];
				$row_array['usex']=$row['UserSex'];
				$row_array['ucity']=$row['UserCity'];
				$row_array['ustate']=$row['UserState'];
				$row_array['uzip']=$row['UserZip'];
				$row_array['uev']=$row['UserEmailVerified'];
				$row_array['urdate']=$row['UserRegistrationDate'];
				$row_array['uvcode']=$row['UserVerificationCode'];
				$row_array['uip']=$row['UserIP'];
				$row_array['uph']=$row['UserPhone'];
				$row_array['ufax']=$row['UserFax'];
				$row_array['uc']=$row['UserCountry'];
				$row_array['uadd']=$row['UserAddress'];
				$row_array['ua']=$row['UserAddress2'];
				$row_array['uuby']=$row['UpdatedBy'];
				$row_array['uudate']=$row['RecordUpdatedDate'];
				$row_array['uremark']=$row['UpdateRemarks'];
				
				

				
			}


			array_push($return_arr,$row_array);
			
			if($op==1 && $ts==1 )
			{
				
		 

		
		$txtmsg=urlencode("Your Laundry Bucket OTP is- $uvmob . Use it to verify your identity and update your password.");
		$_SESSION[usph]=$uph;
		?>
		
		<span id="sms" style="display: none"> 
						<?php
						$ch = curl_init();
					// $url="http://text.sircltech.com/sendsms.jsp?user=rajeev&password=RJVOIL&mobiles=$upmob&sms=$utxtmsg&senderid=RJVOIL";
					 $url= "http://alerts.kapsystem.com/api/web2sms.php?workingkey=A28560483f0aa800b63f2d7ddeb3acb5a&to=$uph&sender=BUCKET&message=$txtmsg"
    ?>
    
						
										 <?php
										curl_setopt($ch, CURLOPT_URL, $url);
										curl_setopt($ch, CURLOPT_HEADER, 0);
										curl_exec($ch);
										curl_close($ch);
		
								?>
						</span>	
			<?php
   
   $str2="<table align='center' border='0' cellpadding='0' cellspacing='0' width='580'>
<tbody>
<tr>
<td style='border: 1px solid #d8d8d8; border-radius: 5px;' bgcolor='#fff'>
	 <table align='center' border='0' cellpadding='0' cellspacing='0' width='540'>
<tbody>
<tr>
<td height='23'>&nbsp;</td>
</tr>
<tr>
<td>
	<a style='text-decoration: none; font-family: Arial, Helvetica, sans-serif; font-size: 20px; font-weight: bold; color: #6ac451;' target='_blank'>
		<img src='http://laundrybucket.co.in/assets/images/img-1959-copy491x213-160.png' alt='Laundry Bucket' border='0'></a>
		</td>
</tr>
<tr>
<td height='23'>&nbsp;</td>
</tr>
<tr>
<td style='background: #cecece; height: 1px; line-height: 1px; font-size: 1px;'>&nbsp;</td>
</tr>
<tr>
<td height='23'>&nbsp;</td>
</tr>

<tr>
<td style='color:#0043a5;font-size:17px;margin:0!important;line-height:17px;font-family:Arial,Helvetica,sans-serif'><strong style='text-align:center'>
Thanks for signing up with us ! </strong> </td>
</tr>

<tr>
<td height='23'>&nbsp;</td>
</tr>

<tr>
<td style='color:#666666;font-size:15px;margin:0!important;line-height:17px;font-family:Arial,Helvetica,sans-serif'>

Your account has been created, Please Activate your account for login  by pressing the url below.

 </td>
</tr>

<tr>
<td height='23'>&nbsp;</td>
</tr>

<tr>
<td style='color: #666666; font-size: 15px; margin: 0!important; line-height: 17px; font-family: Arial, Helvetica, sans-serif;'><strong>
Please click this link to activate your account:</strong><br> 
<a href='http://laundrybucket.co.in/verify.php?email=$uemail&hash=$uvcode'>http://laundrybucket.co.in/verify.php?email=.$uemail.&hash=.$uvcode.</a>
<br> </td>
</tr>
<tr>
<td height='23'>&nbsp;</td>
</tr>
 
 
 
<tr><td height='23'>&nbsp;</td></tr><tr><td style='color: #666666; font-size: 15px; margin: 0!important; line-height: 17px; font-family: Arial, Helvetica, sans-serif;' valign='top'> <br> Laundry Bucket Website.</td>
</tr><tr><td height='23'>&nbsp;</td></tr></tbody></table></td></tr></tbody></table>";
		
		
		$mail = new PHPMailer(); // create a new object
$mail->IsSMTP(); // enable SMTP
$mail->SMTPDebug = 0; // debugging: 1 = errors and messages, 2 = messages only
$mail->SMTPAuth = true; // authentication enabled
$mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for GMail
$mail->Host = "smtp.gmail.com";
$mail->Port = 465; // or 587
$mail->IsHTML(true);
$mail->Username = "laundrybucket77@gmail.com"; /*gmail email here*/
$mail->Password = "bucket11**"; /*gmail password here*/
$mail->SetFrom("laundrybucket77@gmail.com"); /*from Address here*/
$mail->Subject = "Laundry Bucket Account Activation";
$mail->Body = $str2; 
$mail->AddAddress($uemail); /*Email to*/
 if($mail->Send())
    {
    echo "<p style='padding:10px;' class='bg bg-info'>Message Sent Successfully</p>";
   
	?>
				
				<?php
	 }
    else
    {
       echo "<p style='padding:10px;' class='bg bg-info'>Message cannot sent</p>";
      
    }	
   
			}
		}
	}
 	
 	  

else {
 	$row_array['op'] = $op;
	$row_array['status'] = "Transaction Failed";
	array_push($return_arr,$row_array);													

}

mysqli_close($conn);
echo json_encode($return_arr,JSON_UNESCAPED_UNICODE); 
?>
