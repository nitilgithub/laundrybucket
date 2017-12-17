<?php
require '../class.phpmailer.php';
require '../class.smtp.php';
//header('Access-Control-Allow-Origin: *');

//header('Content-Type: application/json');
//$return_array=array();
?>

<?php
include '../connection.php';
if(isset($_GET['oid']))
{

	$oid=$_GET['oid'];
	$uid=$_GET['uid'];
	$res1=mysql_query("select * from tblusers where UserId='$uid'") or die(mysql_error());
	$row1=mysql_fetch_array($res1);
	$uemail=$row1['UserEmail'];
	$res2=mysql_query("select * from tbl_orders where OrderId='$oid'") or die(mysql_error());
	$row2=mysql_fetch_array($res2);
	
	$res3=mysql_query("update tbl_suborders set DeliveryStatusId=4 where OrderId='$oid'");
	
	if($uemail=="")
	{
		echo '<script>window.location.href="pay_order.php?oid='.$oid.'"</script>';
	}
?>
<?php

ob_start();
?>
<html>
	<head>
		<title>Laundry Bucket Feedback</title>
		<style>
			* { margin: 0; padding: 0; }
body { font: 14px/1.4; }
#page-wrap { width: 800px; margin: 0 auto; }

span { border: 0; font: 14px; overflow: hidden; resize: none; }
#logo { text-align: right; float: right; position: relative; margin-top: 5px; border: 1px solid #fff; max-width: 540px; max-height: 70px; overflow: hidden; }
#address { width: 250px;  float: left; margin:10px; }
#customer { overflow: hidden; }
#container{ background-color:#ffffff; margin-top:10px; padding:20px; border:1px solid #ccc; text-align:center; border-radius:5px;}
#subcontainer{ width: 700px; margin: 0 auto; background-color:#fff; text-align:center; color:#4C4C4D; padding:10px; border:1px solid #ccc; border-radius:5px;}
button{    font-size:16px;
    text-decoration: none;
    background-color: #00a63f;
    border-top: 14px solid #00a63f;
    border-bottom: 14px solid #00a63f;
    border-left: 14px solid #00a63f;
    border-right: 14px solid #00a63f;
    display: inline-block;
    border-radius: 3px;
    color:#fff;
      margin:30px;
    cursor: pointer;
    }
    p{ line-height: 24px;}
		</style>
	</head>	
	<body>
			<div id="page-wrap">
<div id="header">

			<div id="identity">
		
            <span id="address">Laundry Bucket<br>
Email: admin@laundrybucket.co.in
<br>
Phone: 011 39589786</span>

            <div id="logo">
  
              <img id="image" src="https://laundrybucket.co.in/assets/images/img-1959-copy491x213-160.png" alt="logo" height="70px" />
            </div>
			</div>
		</div>
		<div style="clear:both"></div>
		<div id="container">
			<p>Hi <?php echo $row1['UserFirstName']." ".$row1['UserLastName'];?></p>
			<div id="subcontainer">
				
<h1 style="background: #008aed; color: #fff; text-align: center; padding: 20px 10px;font-family: arial; border-top-left-radius: 6px; border-top-right-radius: 6px;">Order Delivered </h1>
<p>We are pleased to inform you that your order has been delivered. Thank you for contacting us!</p>
<table cellpadding="10px" cellspacing="10px">
	<tr>
		<td align="left">Order No.</td>
		<td><?php echo $oid; ?></td>
	</tr>
	<tr>
		<td align="left">Order Pickup Date</td>
		<td><?php echo $row2['Order_PickDate']; ?></td>
	</tr>
	<tr>
		<td align="left">Order Delivery Date</td>
		<td><?php echo $row2['Order_DeliverDate']; ?></td>
	</tr>
	<tr>
		<td align="left">Order Amount</td>
		<td><?php echo "INR ".$row2['PayableAmount']; ?></td>
	</tr>
	
</table>
</div>
<p style="font-size:12px;">Laundry Bucket!  bless your clothes for long life . |
   <span class="lead" style="font-size:12px;"> <img src="https://laundrybucket.co.in/washingf.png" height="15px" width="15px">Laundry Bucket!</span>
</p>
</div>
</div>
</body>
</html>
<?php
$deliveryhtml=ob_get_clean();

//echo $invoicehtml;
//echo $authcode;
?>

<?php
if(isset($deliveryhtml))
{
//$uemail="jainneha7257@gmail.com";


$mail = new PHPMailer(); // create a new object
								$mail->IsSMTP(); // enable SMTP
								$mail->SMTPDebug = 0; // debugging: 1 = errors and messages, 2 = messages only
								$mail->SMTPAuth = true; // authentication enabled
								$mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for GMail
								$mail->Host = "mail.laundrybucket.co.in";
								$mail->Port = 465; // or 587
								$mail->IsHTML(true);
								$mail->Username = "bucket@laundrybucket.co.in"; //gmail email here
								//$mail->FromName = 'Laundry Ticket';
								$mail->Password = "Admin111***"; //gmail password here
								$mail->SetFrom("bucket@laundrybucket.co.in","Laundry Bucket"); //from Address here
								//$mail->AddReplyTo($email, 'Laundry Ticket');
								$mail->Subject = "Order Delivered!";
								$mail->Body = $deliveryhtml;
								$mail->AddAddress($uemail); //Email to
								$mail->AddCC("sales@laundrybucket.co.in", 'cc account');
 if($mail->Send())
    {
    //$rows['status']=1;
    $status=1;
}
else
    {
       //$rows['status']=0;
       echo "<script>alert('Message1 not sent. Try again!);</script>";
	   echo '<script>window.location.href="pay_order.php?oid='.$oid.'"</script>';
    }
	?>
<?php
if(isset($status))
{	

ob_start();
?>


<html>
	<head>
		<title>Laundry Bucket Feedback</title>
		<style>
			* { margin: 0; padding: 0; }
body { font: 14px/1.4 Georgia, serif; }
#page-wrap { width: 800px; margin: 0 auto; }

span { border: 0; font: 14px Georgia, Serif; overflow: hidden; resize: none; }
#logo { text-align: right; float: right; position: relative; margin-top: 5px; border: 1px solid #fff; max-width: 540px; max-height: 70px; overflow: hidden; }
#address { width: 250px;  float: left; margin:10px; }
#customer { overflow: hidden; }
#container{ background-color:#6581A6; margin-top:10px; padding:20px;}
#subcontainer{ width: 600px; margin: 0 auto; background-color:#fff; text-align:center; color:#4C4C4D; padding:10px;}
button{    font-size:16px;
    text-decoration: none;
    background-color: #00a63f;
    border-top: 14px solid #00a63f;
    border-bottom: 14px solid #00a63f;
    border-left: 14px solid #00a63f;
    border-right: 14px solid #00a63f;
    display: inline-block;
    border-radius: 3px;
    color:#fff;
      margin:30px;
    cursor: pointer;
    }
    p{ line-height: 24px;}
		</style>
	</head>	
	<body>
	
	<div id="page-wrap">
		<div id="header">
			<div id="identity">
		
            <span id="address">Laundry Bucket<br>
Email: admin@laundrybucket.co.in
<br>
Phone: 011 39589786</span>

            <div id="logo">
  
              <img id="image" src="https://laundrybucket.co.in/assets/images/img-1959-copy491x213-160.png" alt="logo" height="70px" />
            </div>
			</div>
		</div>
		<div style="clear:both"></div>
		<div id="container">
			<div id="subcontainer">
				<h1>We value your feedback</h1>
				<p>Thanks for contacting with us.</p>
				<br>
				<p>Customer service is our top priority. Our team focus on providing you first-class service. We'd love it if you clicked the link below to tell us how we did during your recent experience.</p>
				<a href="https://www.laundrybucket.co.in/survey/<?php echo $oid;?>/<?php echo $uid;?>/" target="_blank"><button>Complete the Survey</button></a>
				
				<p>Complete the survey now and win the chance to be our special customer. Get discount on your new orders just by rating us. For any queries or information: Call us on- 011 39589786 or Email at admin@laundrybucket.co.in </p>
				<br>
				<p style="font-size: 10px;">If you do not wish to receive our feedback emails, please unsubscribe. <a href="https://www.laundrybucket.co.in/unsubscribe/<?php echo $oid;?>/<?php echo $uid;?>/">Click here</a> to unsubscribe.</p>
				<p>	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
				<p style="font-size:12px;">Laundry Bucket!  bless your clothes for long life . |
                   <span class="lead" style="font-size:12px;"> <img src="https://laundrybucket.co.in/washingf.png" height="15px" width="15px">Laundry Bucket!</span>
                </p>
			</div>
		</div>
	</div>
	</body>
</html>
<?php
$feedbackhtml=ob_get_clean();

//echo $invoicehtml;
//echo $authcode;
?>

<?php
if(isset($feedbackhtml))
{
//$uemail="jainneha7257@gmail.com";


$mail = new PHPMailer(); // create a new object
								$mail->IsSMTP(); // enable SMTP
								$mail->SMTPDebug = 0; // debugging: 1 = errors and messages, 2 = messages only
								$mail->SMTPAuth = true; // authentication enabled
								$mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for GMail
								$mail->Host = "mail.laundrybucket.co.in";
								$mail->Port = 465; // or 587
								$mail->IsHTML(true);
								$mail->Username = "bucket@laundrybucket.co.in"; //gmail email here
								//$mail->FromName = 'Laundry Ticket';
								$mail->Password = "Admin111***"; //gmail password here
								$mail->SetFrom("bucket@laundrybucket.co.in","Laundry Bucket"); //from Address here
								//$mail->AddReplyTo($email, 'Laundry Ticket');
								$mail->Subject = "Thanks for calling us. Let us know how we did!";
								$mail->Body = $feedbackhtml;
								$mail->AddAddress($uemail); //Email to
								//$mail->AddCC("sales@laundrybucket.co.in", 'cc account');
 if($mail->Send())
    {
    //$rows['status']=1;
    if(isset($_GET['edit']))
	{
		$edit_id=$_GET['edit'];
		
		//echo '<script>window.location.href="create_suborder.php?oid='.$oid.'&uid='.$uid.'&edit='.$edit_id.'"</script>';
		
		echo '<script>window.location.href="pay_order.php?oid='.$oid.'"</script>';
		
	}
	else {
		echo '<script>window.location.href="create_suborder.php?oid='.$oid.'&uid='.$uid.'"</script>';
	}
    }
    else
    {
       //$rows['status']=0;
       echo "<script>alert('Message not sent. Try again!);</script>";
	   echo '<script>window.location.href="pay_order.php?oid='.$oid.'"</script>';
    }
	//array_push($return_array,$rows);
//echo json_encode($return_array);
//mysql_close();	
}	
}
}
?> 
    

<?php
	}
	
	?>