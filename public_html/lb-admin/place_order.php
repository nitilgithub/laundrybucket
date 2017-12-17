<?php
include 'header.php';
require '../class.phpmailer.php';
require '../class.smtp.php';
$createdbyName=$_SESSION['loginuser'];
if(isset($_GET['edit']))
$edit_id=$_GET['edit'];
else {
	$edit_id=0;
}
//if(empty($_SESSION['current_user']))
//header('location:customer_info.php');
if(isset($_GET['uid']))
{
$uid=$_GET['uid'];
}
else {
	$orderid=$_GET["oid"];
		$result=mysql_query("select OrderUserId from tbl_orders where OrderId='$orderid'") or die(mysql_error());
		$rows=mysql_fetch_array($result);
		$uid=$rows[0];
	}
if($uid!="")
{
	$rr=mysql_query("select feedbackFlag from tblusers where UserId='$uid'") or die(mysql_error());
	$rowr=mysql_fetch_array($rr);
	$flag=$rowr[0];
	
	$r=mysql_query("select * from tblusers where UserId='$uid'") or die(mysql_error());
					
	$urow=mysql_fetch_array($r);
	$name=$urow['UserFirstName']." ".$urow['UserLastName'];
	$email=$urow['UserEmail'];
	$phone=$urow['UserPhone'];
	
?>
<?php
if(isset($_POST['btnPlaceOrder']))
{
	$pickup_address=mysql_real_escape_string(trim($_POST["address"]));
	$pickdate=trim($_POST["pickdate"]);
	$picktime=trim($_POST["picktime"]);
	$remarks=trim($_POST["review"]);
	$pickby=trim($_POST['pickby']);
	$deliverby=trim($_POST['deliverby']);
	$deliverydate=trim($_POST["deliverydate"]);
	$order_via='website';
	$createdby="admin";
	$order_status_id=$_POST["orstatus"];
	$getcity=trim($_POST['getcity']);
	$receiptno=trim($_POST['receiptno']);
	
	$oprocess=trim($_POST['oprocess']);
	$franchiseid=trim($_POST['franchiseid']);
	
	
	if(!empty($_FILES['receiptpic']['tmp_name']) || is_uploaded_file($_FILES['receiptpic']['tmp_name']))
	{
	
	$item_pic=mysql_real_escape_string($_FILES["receiptpic"]["name"]);
	
	$item_pictemp=mysql_real_escape_string($_FILES["receiptpic"]["tmp_name"]);
	}
	else {
		
		$item_pic="";
		
		$item_pictemp="";
	}
	
	$usermessage = file_get_contents('../email_template/userorder.html');
	$adminmessage = file_get_contents('../email_template/adminorderemail.html');
	
	if($item_pic!="")
{
	
$target_dir = $_SERVER['DOCUMENT_ROOT'].'/../cdn.laundrybucket.co.in/images/';

$target_file = $target_dir . basename($item_pic);

$uploadOk = 1;

$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

// Check if file already exists
if (file_exists($target_file)) {
	
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
	
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
	
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
	
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($item_pictemp, $target_file)) {
    	
        echo "The file ". basename( $item_pic). " has been uploaded.";
    } else {
    	
        echo "Sorry, there was an error uploading your file.";
    }
}
}
	
	$res3=mysql_query("insert into tbl_orders(OrderUserId,Order_PickDate,Order_PickTime,PickupAddress,OrderCity,Remarks,Order_Via,CreatedBy,CreatedByName,OrderStatusId,RiderId,addon,DeliverByRider_Id,Order_DeliverDate,OrderReceiptId,OrderReceiptPic,OrderProcessType,franchiseId) values('$uid','$pickdate','$picktime','$pickup_address','$getcity','$remarks','$order_via','$createdby','$createdbyName','$order_status_id','$pickby',now(),'$deliverby','$deliverydate','$receiptno','$item_pic','$oprocess','$franchiseid')");
	if(mysql_affected_rows())
	{
		$oid=mysql_insert_id();
		$res7=mysql_query("insert into tbl_ordersremarks(OrderId,UserId,Remarks,RemarksBy,addon)values('$oid','$uid','$remarks','$createdby',NOW())");
		if(mysql_affected_rows())
		{
			
							// Replace the % with the actual information for sending email to user id
$usermessage = str_replace('%orderid%', $oid, $usermessage);

//$usermessage = str_replace('%ordertype%', $ord_type, $usermessage);

$usermessage = str_replace('%pickdate%', $pickdate, $usermessage);
$usermessage = str_replace('%picktime%', $picktime, $usermessage);			
$usermessage = str_replace('%address%', $pickup_address, $usermessage);							


// Replace the % with the actual information for sending email to Admin id
$adminmessage = str_replace('%client-name%', $name, $adminmessage);
$adminmessage = str_replace('%orderid%', $oid, $adminmessage);
$adminmessage = str_replace('%client-email%', $email, $adminmessage);
$adminmessage = str_replace('%client-mobile%', $phone, $adminmessage);

//$adminmessage = str_replace('%ordertype%', $ord_type, $adminmessage);

$adminmessage = str_replace('%pickdate%', $pickdate, $adminmessage);
$adminmessage = str_replace('%picktime%', $picktime, $adminmessage);
$adminmessage = str_replace('%city%', $getcity, $adminmessage);			
$adminmessage = str_replace('%address%', $pickup_address, $adminmessage);							
$adminmessage = str_replace('%review%', $remarks, $adminmessage);


							$mail = new PHPMailer(); // create a new object
								$mail->IsSMTP(); // enable SMTP
								$mail->SMTPDebug = 0; // debugging: 1 = errors and messages, 2 = messages only
								$mail->SMTPAuth = true; // authentication enabled
								$mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for GMail
								$mail->Host = "mail.laundrybucket.co.in";
								$mail->Port = 465; // or 587
								$mail->IsHTML(true);
								$mail->Username = "orders@laundrybucket.co.in"; //gmail email here
								//$mail->FromName = 'Laundry Ticket';
								$mail->Password = "91tGV@t!yP1S"; //gmail password here
								$mail->SetFrom($email,"Laundry Bucket Order"); //from Address here
								//$mail->AddReplyTo($email, 'Laundry Ticket');
								$mail->Subject = "New Order from laundrybucket.co.in";
								$mail->Body = $adminmessage;
								$mail->AddAddress("bucket@laundrybucket.co.in"); //Email to
								//$mail->AddCC("support@laundrybuckethelp.zendesk.com", 'cc account');


 if($mail->Send())
    {

								$mail = new PHPMailer(); // create a new object
								$mail->IsSMTP(); // enable SMTP
								$mail->SMTPDebug = 0; // debugging: 1 = errors and messages, 2 = messages only
								$mail->SMTPAuth = true; // authentication enabled
								$mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for GMail
								$mail->Host = "mail.laundrybucket.co.in";
								$mail->Port = 465; // or 587
								$mail->IsHTML(true);
								$mail->Username = "orders@laundrybucket.co.in"; //gmail email here
								//$mail->FromName = 'Laundry Ticket';
								$mail->Password = "91tGV@t!yP1S"; //gmail password here
								$mail->SetFrom("orders@laundrybucket.co.in","Laundry Bucket"); //from Address here
								//$mail->AddReplyTo($email, 'Laundry Ticket');
								$mail->Subject = "Thanks for placing order";
								$mail->Body = $usermessage;
								$mail->AddAddress($email); //Email to

 if($mail->Send())
    {
   	}
 else {
     
 }
    }
    else
    {
       echo "<p style='padding:10px;' class='bg bg-info'>Mail error</p>";
    }
    
    
	
	//$txtmsg=urlencode("Dear $name your order has been received of INR $address and its status is unpaid. OrderNo $ordid Dated $pickdate Login and get detail about order.");
	$txtmsg=urlencode("Laundry Bucket Order Placed Id $oid . Date $pickdate . Pickup $picktime . Client $name . Ph $phone .");
						$ch = curl_init();
					// $url="http://text.sircltech.com/sendsms.jsp?user=rajeev&password=RJVOIL&mobiles=$upmob&sms=$utxtmsg&senderid=RJVOIL";
					 $url= "http://alerts.kapsystem.com/api/web2sms.php?workingkey=A28560483f0aa800b63f2d7ddeb3acb5a&to=$phone,8744009933,9718661177&sender=BUCKET&message=".$txtmsg;
					 //echo $url;
    ?>
    
						
										 <?php
										curl_setopt($ch, CURLOPT_URL, $url);
										curl_setopt($ch, CURLOPT_HEADER, 0);
										//curl_exec($ch);
										
								    if($result = curl_exec($ch))
								    {
								//header("location:thanku.php");
								echo "Order Placed Successfully";
									
								    } 
										curl_close($ch);
	
	//echo "Order type is:".$ord_type;
	?>

<?php
	
   
			
			
			if($flag!=0 && $order_status_id==4)
			{
				header('location:api_sendfeedback.php?oid='.$oid.'&uid='.$uid);
			}
			else {
				header('location:create_suborder.php?oid='.$oid.'&uid='.$uid);
			}
		
    	}
		
	}
	else {
		echo mysql_error();
	}
}
if(isset($_POST['btnContinue']))
{
	$pickup_address=mysql_real_escape_string(trim($_POST["address"]));
	$pickdate=trim($_POST["pickdate"]);
	$picktime=trim($_POST["picktime"]);
	$pickby=trim($_POST['pickby']);
	$remarks=trim($_POST["review"]);
	$order_status_id=$_POST["orstatus"];
	$order_id=trim($_POST['orderId']);
	$deliverby=trim($_POST['deliverby']);
	$deliverydate=trim($_POST["deliverydate"]);
	$receiptno=trim($_POST['receiptno']);
	
	$oprocess=trim($_POST['oprocess']);
	$franchiseid=trim($_POST['franchiseid']);
	
	if(!empty($_FILES['receiptpic']['tmp_name']) || is_uploaded_file($_FILES['receiptpic']['tmp_name']))
	{
	
	$item_pic=mysql_real_escape_string($_FILES["receiptpic"]["name"]);
	
	$item_pictemp=mysql_real_escape_string($_FILES["receiptpic"]["tmp_name"]);
	}
	else {
		
		$item_pic=$_POST['receiptpic_old'];
		
		$item_pictemp="";
	}

if($item_pictemp!="")
{
	
$target_dir = $_SERVER['DOCUMENT_ROOT'].'/../cdn.laundrybucket.co.in/images/';

$target_file = $target_dir . basename($item_pic);

$uploadOk = 1;

$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

// Check if file already exists
if (file_exists($target_file)) {
	
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
	
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
	
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
	
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($item_pictemp, $target_file)) {
    	
        echo "The file ". basename( $item_pic). " has been uploaded.";
    } else {
    	
        echo "Sorry, there was an error uploading your file.";
    }
}
}	
	
	$res4=mysql_query("update tbl_orders set Order_PickDate='$pickdate',Order_PickTime='$picktime',PickupAddress='$pickup_address',Remarks='$remarks',OrderStatusId='$order_status_id',RiderId='$pickby',DeliverByRider_Id='$deliverby',Order_DeliverDate='$deliverydate',OrderReceiptId='$receiptno',OrderReceiptPic='$item_pic',OrderProcessType='$oprocess',franchiseId='$franchiseid' where OrderId='$order_id'");
	if($res4)
	{
		if($flag!=0 && $order_status_id==4)
			{
				header('location:api_sendfeedback.php?oid='.$order_id.'&uid='.$uid.'&edit='.$edit_id);
			}
			else {
				//header('location:create_suborder.php?oid='.$order_id.'&uid='.$uid.'&edit='.$edit_id);
				
				header('location:suborder_dashboard.php?oid='.$order_id);
			}
		
	}
	else {
		echo mysql_error();
	}
}
?>
<script>
$(document).on("click","#savenewaddress",function()
                         		{
                         		
                         			//alert("ok");
                         			var getuid=$("#getuid").val();
                         			var address=$("#newaddress").val();
                         			
                         			var strurl="https://www.laundrybucket.co.in/lb-admin/apisave_newaddress.php?uid="+getuid+"&address="+address;
						 			//alert(strurl);
						 			$.ajax({
						 				url:strurl,
						 				type:"GET",
						 				success:function(data)
						 				{
						 					//console.log(data);
						 					//$("#subscriptions_data").html(data);
						 					$("#headingTwo").css("background-color", "#444"); 
						 					$("#pickadd").val(address);
						 					
						 					
						 				},
						 				error:function(err)
						 				{
						 					alert($err);
						 				}
						 			 })
                         	});
                         	
$(document).on("click","#savenewremarks",function()
                         		{
                         		
                         			//alert("ok");
                         			var getuid=$("#getuserid").val();
                         			var getoid=$("#getorderid").val();
                         			var remarks=$("#newremarks").val();
                         			
                         			var strurl="https://www.laundrybucket.co.in/lb-admin/apisave_newremarks.php?uid="+getuid+"&remarks="+remarks+"&oid="+getoid;
						 			//alert(strurl);
						 			$.ajax({
						 				url:strurl,
						 				type:"GET",
						 				success:function(data)
						 				{
						 					//console.log(data);
						 					//$("#subscriptions_data").html(data);
						 					$("#headingThree").css("background-color", "#444"); 
						 					$("#remark").val(remarks);
						 					
						 					
						 				},
						 				error:function(err)
						 				{
						 					alert($err);
						 				}
						 			 })
                         	});
                         	
                         
</script>

<script>
          	$(document).on("click",".btnaddress",function(){
          		var address=$(this).attr("title");
          		//alert(address);
          		$("#headingTwo").css("background-color", "#444");
          		$("#pickadd").val(address);
          		
          		//$("#collapseTwo").slideUp();
          		//$("#collapseTwo").collapse('hide');
          		
          	});
          	function sendfeedback(orderStatusid){
          		if(orderStatusid==4 || orderStatusid==3)
          		{
          			//$("#feedbackCheck").show(100);
          			//$(".feedback").attr('checked', true);
          			$(".orderdeliverdiv").show(100);
          		}
          		else
          		{
          			//$("#feedbackCheck").hide(100);
          			//$(".feedback").attr('checked', false);
          			$(".orderdeliverdiv").hide(100);
          			$("#datepicker4").val("");
          			$("#deliverby").val("-1");
          		}
          		
          	};
          	$(document).ready(function(){
		   		var orderstatus=$("#orstatus").val();
		   		if(orderstatus==4 || orderstatus==3)
		   		{
		   			//$("#feedbackCheck").show(100);
          			//$(".feedback").attr('checked', true);
          			$(".orderdeliverdiv").show(100);	
		   		}
		   		else
		   		{
		   			//$("#feedbackCheck").hide(100);
          			//$(".feedback").attr('checked', false);
          			$(".orderdeliverdiv").hide(100);
          			$("#datepicker4").val("");
          			$("#deliverby").val("-1");
		   		}
		   	});
          	
          	
          	/*function sendfeedback(orderStatusid){
          		var orderId=$("#orderId").val();
          		if(orderStatusid==4)
          		{
          			var r=confirm("Do you want to send feedback mail to the customer?");
          			if(r==true)
          			{
          				$.ajax({
					    type : "GET",
					    url : "api_sendfeedback.php?oid="+orderId,
					    success : function(data){
					       $.each(data,function(i,field){
					       				var status=field.status;
										if(status==1)
										{
											alert("Message Sent Successfully");
										}
										else
										{
											alert("Message cannot sent");
										}
									});
					    }
					});
          			}
          			else
          			{
          				return false;
          			}
          		}
          	}*/
          </script>

<div class="right_col" role="main">
	<div class="row">
		<div class="container">
			<div class="col-md-12 col-sm-12 col-xs-12">
				
				<div class="col-md-12 col-sm-12 col-xs-12" style="text-align: center;">
					<?php
					
					
						
					 echo "<h2>".$urow['UserFirstName']." ".$urow['UserLastName']."'s Place Order(New)/Check Status of Existing Order</h2>";
					
					 ?>
				</div>
				<!--<div class="col-md-4 col-sm-4 col-xs-12">
					<?php
					
					$r=mysql_query("select * from tblusers where UserId='$uid'") or die(mysql_error());
					if(mysql_affected_rows())
					{
						$urow=mysql_fetch_array($r);
						
					?>
					<nav class="">
					  <div class="container-fluid">
					    <ul class="" style="list-style: none;">
					      <li class="dropdown">
					        <a class="dropdown-toggle" data-toggle="dropdown" href="#" style="color:#000000; text-transform: capitalize; font-size:18px;">Welcome <?php echo $urow['UserFirstName']." ".$urow['UserLastName'];?>
					        <span class="caret"></span></a>
					        <ul class="dropdown-menu">
					          <li><a href="user_logout.php">Log Out</a></li>
					        </ul>
					      </li>
					     </ul>
					  </div>
					</nav>
					<?php } ?>
				</div>-->
			</div>
			&nbsp;
			<div class="col-md-12 col-sm-12 col-xs-12">
<?php
if(isset($_GET["oid"]))
{
	$orderid=$_GET["oid"];

	$res=mysql_query("select * from tbl_orders where OrderId='$orderid'") or die(mysql_error());
if(mysql_affected_rows())
{
	$rows=mysql_fetch_array($res);

?>
				<form method="post" role="form" class="form-horizontal" name="" enctype="multipart/form-data" id="">
	        
	        		<div class="item form-group">
		        		<label class="control-label col-md-4 col-sm-5 col-xs-5" for="dob">Pickup Date
	                    </label>
	                    <div class="col-md-6 col-sm-7 col-xs-7">
	          			<input type="hidden" value="<?php echo $orderid;?>" name="orderId" id="orderId" />
	          			
	           			<input type="text" id="datepicker" class="form-control date-picker col-md-7 col-xs-12" name="pickdate" required="" placeholder="Select Pickup Date" value="<?php echo $rows['Order_PickDate'];?>">      
	                    </div>
	                </div>
	                &nbsp;
	                <div class="item form-group">
	                	<label for="Image" class="control-label col-md-4 col-sm-5 col-xs-5">Pickup Time</label>
            				
            				<div class="col-md-6 col-sm-7 col-xs-7">
            				
            		<!--	<input id="timepicker2" type="text" class="input-small form-control" required="" name="picktime" placeholder="Enter Pickup Time: eg-4:00AM">-->
            		<select name="picktime" class="form-control" style="padding: 0px" required="">
            									<option value="">Select Pickup Time</option>
            											
						<?php
			
				 $res2=mysql_query("SELECT * from tbl_pickuptime");			
					if(mysql_affected_rows())
				{
					while($rows2=mysql_fetch_array($res2))
			
				{
					?>
					<option  value="<?php echo $rows2["PickupTime"]; ?>" <?php if($rows['Order_PickTime']==$rows2['PickupTime']) echo selected;?>   style="padding:10px"><?php echo $rows2["PickupTime"]; ?></option>
					
					<?php
					}
					}
				?>
            									<!--<option value="08-09-AM" style="padding:10px" <?php if($rows['Order_PickTime']=="08-09-AM") echo selected;?>>08-09 AM</option>
												<option value="09-10-AM" style="padding:10px" <?php if($rows['Order_PickTime']=="09-10-AM") echo selected;?>>09-10 AM</option>
												<option value="10-11-AM" style="padding:10px" <?php if($rows['Order_PickTime']=="10-11-AM") echo selected;?>>10-11 AM</option>
												<option value="11-12-AM" style="padding:10px" <?php if($rows['Order_PickTime']=="11-12-AM") echo selected;?>>11-12 AM</option>
												<option value="12-01-PM" style="padding:10px" <?php if($rows['Order_PickTime']=="12-01-PM") echo selected;?>>12-01 PM</option>
												<option value="01-02-PM" style="padding:10px" <?php if($rows['Order_PickTime']=="01-02-PM") echo selected;?>>01-02 PM</option>
												<option value="02-03-PM" style="padding:10px" <?php if($rows['Order_PickTime']=="02-03-PM") echo selected;?>>02-03 PM</option>
												<option value="03-04-PM" style="padding:10px" <?php if($rows['Order_PickTime']=="03-04-PM") echo selected;?>>03-04 PM</option>
												<option value="04-05-PM" style="padding:10px" <?php if($rows['Order_PickTime']=="04-05-PM") echo selected;?>>04-05 PM</option>
												<option value="05-06-PM" style="padding:10px" <?php if($rows['Order_PickTime']=="05-06-PM") echo selected;?>>05-06 PM</option>
												<option value="06-07-PM" style="padding:10px" <?php if($rows['Order_PickTime']=="06-07-PM") echo selected;?>>06-07 PM</option>
												<option value="07-08-PM" style="padding:10px" <?php if($rows['Order_PickTime']=="07-08-PM") echo selected;?>>07-08 PM</option>
												<option value="08-09-PM" style="padding:10px" <?php if($rows['Order_PickTime']=="08-09-PM") echo selected;?>>08-09 PM</option>-->
                   					</select>	
            				</div> 
	                </div>
	                &nbsp;
                   <div class="item form-group">
                    	
                    	<label for="Image" class="control-label col-md-4 col-sm-5 col-xs-5">Pickup Address</label>
            				
            				<div class="col-md-6 col-sm-7 col-xs-7">
            			  
            			  <input type="text" class="form-control" readonly="" id="pickadd" name="address" required="" placeholder="Enter Customer Pickup Address" data-form-field="address" value="<?php echo $rows["PickupAddress"]; ?>" placeholder="<?php if(empty($rows['PickupAddress'])){ echo "Select Customer Pickup Address"; } else { echo "Change Customer Pickup Address" ; }?>">
            			       </div>
            			       
            			       <div class="col-md-6 col-sm-8 col-xs-12 col-md-offset-4 col-sm-offset-4">
            			        <div class="panel panel-default">
          	
			    <div class="panel-heading" role="tab" id="headingTwo" style="background-color: #0042A4; color:white;">
				    <h4 class="panel-title">
				    	
					    <a style="text-decoration:none;cursor: pointer" class="collapsed paneltext" data-toggle="collapse" data-target="#collapseTwo"  aria-expanded="false" aria-controls="collapseTwo">
						   <?php
						 if(empty($rows["PickupAddress"]))
						 {
						 echo "Select Your Pickup Address";	
						 }
						 else {
							 echo "Change Your Pickup Address";
						 }
						 ?>
						 
						 </a>
						       
					 </h4>
				 </div>
						    
    			<div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
      				<div class="panel-body">
               
              			<div class="col-md-12" style="border:1px solid red">
				              <h4>Add New Address</h4>
				         	<!-- We can not do nested form, so we do this using ajax without form tag-->
				         	   <div class="row">
				         	   	
				         	   	
				               	<div class="form-group">
				               		<?php
            			  $res1=mysql_query("select * from tblusers where UserId='$uid'") or die(mysql_error());
							if(mysql_affected_rows())
							{
								$rows1=mysql_fetch_array($res1);
            			  ?>
            			  <input type="text" class="form-control text-capitalize hidden" id="getcity" value="<?php echo $rows1["UserCity"]; ?>"  name="getcity"  placeholder="" data-form-field="">
            			  <?php
							}
            			  ?>
                            	<input type="text" class="form-control text-capitalize hidden" id="getuid" value="<?php echo $uid; ?>"  name="getuid"  placeholder="" data-form-field="">
                            <!-- Using this field to get userid dynamically from email and mobile keyup function-->
                            </div>
				                	<div class="col-md-6">
										<div class="form-group">
										<textarea class="form-control" rows="1" id="newaddress" name="newaddress"></textarea>
				       					</div>
				                    </div>
				                    
				                	<div class="col-md-6">
										<div class="form-group">
										<input type="button"  id="savenewaddress" value="save address" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo" class="btn btn-success"/>                    
								        </div>
				                    </div>
				              </div>
				              
            			</div>
            			
          				<br/>
         
          			   <div class="col-md-12">
					          <h4>Already Saved Address</h4>
					              <span class="address-bar">
					              	 <ul style="list-style-type:none;margin-left:-50px" id="unlogin_addresslist">
					              	<?php
					              		$i=1;
					              		$rs1=mysql_query("select * from tblusers_address where UserID='$uid'") or die(mysql_error());
										if(mysql_num_rows($rs1)>0)
										{
											while($row1=mysql_fetch_array($rs1))
											{
												?>
												
												<li>
								    
								              	<b>Address <?php echo $i; ?> <span class="text-right"><i class="glyphicon glyphicon-edit"></i></span></b>
								                <address><i class="glyphicon glyphicon-map-marker"></i> <span class="addressspan"><?php echo $row1["Address"]; ?></span></address>
								                 <button type="button" class="btn g-back btn-block btn-success btnaddress" title="<?php echo $row1["Address"]; ?>" data-target="#collapseTwo" data-toggle="collapse"  aria-expanded="false" aria-controls="collapseTwo">Select</button>
								                 
								               </li>
												<?php
												$i++;
											}
										}
					              		?>
					              		
					               </ul>
					             </span>
             						</div>
					          
					 			  </div>
					    	   </div>
					 	  </div>	
            				</div>  
                    	
                    </div>
                    &nbsp;
                    
                     <div class="item form-group">
                    <label class="control-label col-md-4 col-sm-5 col-xs-5" for="pickby">Order Picked By 
                    </label>
                    <div class="col-md-6 col-sm-7 col-xs-7">
                    	
                   <?php if($_SESSION['loginrole']==2 || $_SESSION['loginrole']==3){?>
                    	
                     <select class="form-control" name="pickby" id="pickby">
						 <option value="-1"  style="padding-bottom:7px">Select Order Picked By</option>
						<?php
			
				 $res2=mysql_query("SELECT * from tbl_per_employee_roles where empRoleId=7");			
					if(mysql_affected_rows())
				{
					while($rows2=mysql_fetch_array($res2))
			
				{
					$empid=$rows2['empId'];
					$r1=mysql_query("select * from tbl_employee where empId='$empid'");
					$row3=mysql_fetch_array($r1);
					?>
					<option  value="<?php echo $rows2["empId"]; ?>" <?php if($rows['RiderId']==$rows2['empId']) echo selected;?>   style="margin-bottom:7px"><?php echo $row3["empName"]; ?></option>
					
					<?php
					}
					}
				?>
						
                   </select>
                        <?php }
					else {
						$empuname=$_SESSION['loginuser'];
						$q1=mysql_query("select * from tbl_employee where empEmail='$empuname'");
						$rws=mysql_fetch_array($q1);
						if($rows['RiderId']==$rws['empId']||$rows['RiderId']==NULL||$rows['RiderId']==""||$rows['RiderId']==-1)
						{
					?>
					<input type="hidden" class="form-control" name="pickby" id="pickby" value="<?php echo $rws['empId']; ?>">
					<input type="text" class="form-control" readonly="readonly" value="<?php echo $rws['empName']; ?>">
					
					<?php
						}
						else
						{
							$rid=$rows['RiderId'];
						$q2=mysql_query("select * from tbl_employee where empId='$rid'");
						$rws1=mysql_fetch_array($q2);
						?>
						<input type="hidden" class="form-control" name="pickby" id="pickby" value="<?php echo $rws1['empId']; ?>">
					<input type="text" class="form-control" readonly="readonly" value="<?php echo $rws1['empName']; ?>">
						<?php
						}
					} ?>
               

                    </div>
                    </div>
                    &nbsp;
                    
                    
                    <div class="item form-group">
                    <label class="control-label col-md-4 col-sm-5 col-xs-5" for="ordstatus">Order Status <span class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-7 col-xs-7">
                     <select class="form-control" required name="orstatus" id="orstatus" onchange="sendfeedback(this.value)">
						 <option value=""  style="padding-bottom:7px">Select Order Status</option>
						
						<?php
			
				 $res2=mysql_query("SELECT * from tbl_orderstatus_id");			
					if(mysql_affected_rows())
				{
					while($rows2=mysql_fetch_array($res2))
			
				{
					?>
					<option  value="<?php echo $rows2["order_status_id"]; ?>" <?php if($rows['OrderStatusId']==$rows2['order_status_id']) echo selected;?>  style="margin-bottom:7px"><?php echo $rows2["order_status_text"]; ?></option>
					
					<?php
					}
					}
				?>
                   </select>
               

                    </div>
                    </div>
                    &nbsp;
                    
                    <div class="orderdeliverdiv">
                    	
                    	<div class="item form-group">
			        		<label class="control-label col-md-4 col-sm-5 col-xs-5" for="deliverydate">Delivery Date
		                    </label>
		                    <div class="col-md-6 col-sm-7 col-xs-7">
		          			
		          			
		           			<input type="text" id="datepicker4" class="form-control date-picker col-md-7 col-xs-12" name="deliverydate"  placeholder="Select Delivery Date" value="<?php echo $rows['Order_DeliverDate'];?>">      
		                    </div>
		                </div>
		                &nbsp;
	                    	
                    	
	                    <div class="item form-group">
	                    <label class="control-label col-md-4 col-sm-5 col-xs-5" for="deliverby">Order Delivered By 
	                    </label>
	                    <div class="col-md-6 col-sm-7 col-xs-7">
	                  <?php if($_SESSION['loginrole']==2 || $_SESSION['loginrole']==3){?>
	                     <select class="form-control" name="deliverby" id="deliverby">
							 <option value="-1"  style="padding-bottom:7px">Select Order Deliver By</option>
								<?php
			
				$res2=mysql_query("SELECT * from tbl_per_employee_roles where empRoleId=7");	
					if(mysql_affected_rows())
				{
					while($rows2=mysql_fetch_array($res2))
			
				{
					$empid=$rows2['empId'];
					$r1=mysql_query("select * from tbl_employee where empId='$empid'");
					$row3=mysql_fetch_array($r1);
					?>
					<option  value="<?php echo $rows2["empId"]; ?>" <?php if($rows['RiderId']==$rows2['empId']) echo selected;?>   style="margin-bottom:7px"><?php echo $row3["empName"]; ?></option>
					
					<?php
					}
					}
				?>		
					
	                   </select>
	                   
	                      <?php }
					else {
						$empuname=$_SESSION['loginuser'];
						$q1=mysql_query("select * from tbl_employee where empEmail='$empuname'");
						$rws=mysql_fetch_array($q1);
						if($rows['RiderId']==$rws['empId']||$rows['RiderId']==NULL||$rows['RiderId']==""||$rows['RiderId']==-1)
						{
					?>
					<input type="hidden" class="form-control" name="deliverby" id="deliverby" value="<?php echo $rws['empId']; ?>">
					<input type="text" class="form-control" readonly="readonly" value="<?php echo $rws['empName']; ?>">
					
					<?php
						}
						else
						{
							$rid=$rows['RiderId'];
						$q2=mysql_query("select * from tbl_employee where empId='$rid'");
						$rws1=mysql_fetch_array($q2);
						?>
						<input type="hidden" class="form-control" name="deliverby" id="deliverby" value="<?php echo $rws1['empId']; ?>">
					<input type="text" class="form-control" readonly="readonly" value="<?php echo $rws1['empName']; ?>">
						<?php
						}
					} ?>
	               
	
	                    </div>
	                    </div>
	                    &nbsp;
                    	
                    </div>
                    
                    <div class="item form-group">
		        		<label class="control-label col-md-4 col-sm-5 col-xs-5" for="receiptno">Order Receipt No
	                    </label>
	                    <div class="col-md-6 col-sm-7 col-xs-7">
	          			
	          			
	           			<input type="text" id="receiptno" class="form-control col-md-7 col-xs-12" name="receiptno"  placeholder="Enter Receipt Number" value="<?php echo $rows['OrderReceiptId'];?>">      
	                    </div>
	                </div>
	                &nbsp;
	                
	                 <div class="item form-group">
		        		<label class="control-label col-md-4 col-sm-5 col-xs-5" for="receiptpic">Order Receipt Pic
	                    </label>
	                    <div class="col-md-6 col-sm-7 col-xs-7">
	          			
	          			<input type="hidden" name="receiptpic_old" id="receiptpic_old" value="<?php echo $rows['OrderReceiptPic'];?>" />
	           			<input type="file" id="receiptpic" class="form-control col-md-7 col-xs-12" name="receiptpic"  placeholder="Select Receipt Pic" >      
	                    </div>
	                </div>
	                &nbsp;
	                
                  <div class="item form-group">
                    <label class="control-label col-md-4 col-sm-5 col-xs-5" for="oprocess">Order Process Type
                    </label>
                    <div class="col-md-6 col-sm-7 col-xs-7">
                     <select class="form-control" required name="oprocess" id="oprocess">
						 <option value=""  style="padding-bottom:7px">Select Order Process Type</option>
					
					<option  value="fresh" <?php if($rows['OrderProcessType']=='fresh') echo selected;?>  style="margin-bottom:7px">Fresh Order</option>
					
					<option  value="reprocess" <?php if($rows['OrderProcessType']=='reprocess') echo selected;?>  style="margin-bottom:7px">Reprocess Order</option>
					
                   </select>
               

                    </div>
                    </div>
                    &nbsp;
                    <div class="item form-group">
                    <label class="control-label col-md-4 col-sm-5 col-xs-5" for="franchiseid">Franchise
                    </label>
                    <div class="col-md-6 col-sm-7 col-xs-7">
                     <select class="form-control" required name="franchiseid" id="franchiseid">
                     	<option value="1">Laundry Bucket</option>
						<?php
						$query1=mysql_query("select e.empId,e.empName,r.empRoleId from tbl_employee as e join tbl_per_employee_roles as r on r.empId=e.empId where r.empRoleId='9' order by e.empId");
						while($rows1=mysql_fetch_array($query1))
						{
						?>
						<option  value="<?php echo $rows1['empId'];?>" <?php if($rows['franchiseId']==$rows1['empId']) echo selected;?>  style="margin-bottom:7px"><?php echo $rows1['empName'];?></option>
					
					<?php
						
						}
						?>
					
					
                   </select>
               

                    </div>
                    </div>
                    &nbsp;
                   
                  <div class="item form-group">
                                            <label class="control-label col-md-4 col-sm-5 col-xs-5" for="itname">Remarks
                                            </label>
                                            <div class="col-md-6 col-sm-7 col-xs-7">
                                      
                                    <input type="text" class="form-control col-md-7 col-xs-12" id="remark" readonly="readonly"  name="review" placeholder="Remarks" style="height: 95px" value="<?php echo $rows['Remarks']; ?>">
                                 
                                            </div>
                         <!--remarks multiple-->
                         
                         <div class="col-md-6 col-sm-8 col-xs-12 col-md-offset-4 col-sm-offset-4">
            			        <div class="panel panel-default">
          	
			    <div class="panel-heading" role="tab" id="headingThree" style="background-color: #0042A4; color:white;">
				    <h4 class="panel-title">
				    	
					    <a style="text-decoration:none;cursor: pointer" class="collapsed paneltext" data-toggle="collapse" data-target="#collapseThree"  aria-expanded="false" aria-controls="collapseThree">
						   <?php
						 if(empty($rows["Remarks"]))
						 {
						 echo "Add Your Remarks";	
						 }
						 else {
							 echo "Add New Remarks";
						 }
						 ?>
						 
						 </a>
						       
					 </h4>
				 </div>
						    
    			<div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
      				<div class="panel-body">
               
              			<div class="col-md-12" style="border:1px solid red">
				              <h4>Add New Remarks</h4>
				         	<!-- We can not do nested form, so we do this using ajax without form tag-->
				         	   <div class="row">
				         	   	
				         	   	
				               	<div class="form-group">
				             
            			  <input type="text" class="form-control text-capitalize hidden" id="getorderid" value="<?php echo $orderid; ?>"  name="getorderid"  placeholder="" data-form-field="">
            			  <input type="text" class="form-control text-capitalize hidden" id="getuserid" value="<?php echo $uid; ?>"  name="getuserid"  placeholder="" data-form-field="">
                           
                         </div>
				                	<div class="col-md-6">
										<div class="form-group">
										<textarea class="form-control" rows="1" id="newremarks" name="newremarks"></textarea>
				       					</div>
				                    </div>
				                    
				                	<div class="col-md-6">
										<div class="form-group">
										<input type="button"  id="savenewremarks" value="Save Remarks" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree" class="btn btn-success"/>                    
								        </div>
				                    </div>
				              </div>
				              
            			</div>
            			
          				<br/>
         
          			   <div class="col-md-12">
					          <h4>Remarks History</h4>
					              <span class="address-bar">
					              	 <ul style="list-style-type:none;margin-left:-50px" id="unlogin_remarkslist">
					              	<?php
					              		$i=1;
					              		$rs1=mysql_query("select * from tbl_ordersremarks where UserId='$uid' and OrderId='$orderid'") or die(mysql_error());
										if(mysql_num_rows($rs1)>0)
										{
											while($row1=mysql_fetch_array($rs1))
											{
												?>
												
												<li>
								    
								              	<b>Remarks<?php echo $i; ?> <span class="text-right"><i class="glyphicon glyphicon-edit"></i></span></b>
								                <address><i class=""></i> <span class="addressspan"><?php echo $row1["Remarks"]; ?></span></address>
								                 <!--<button type="button" class="btn g-back btn-block btn-success btnaddress" title="<?php echo $row1["Remarks"]; ?>" data-target="#collapseTwo" data-toggle="collapse"  aria-expanded="false" aria-controls="collapseTwo">Select</button>-->
								                 
								               </li>
												<?php
												$i++;
											}
										}
					              		?>
					              		
					               </ul>
					             </span>
             						</div>
					          
					 			  </div>
					    	   </div>
					 	  </div>	
            				</div>  
                         <!--end-->
                   </div>
                   
                
                 <!--<div class="item form-group" id="feedbackCheck" hidden>
                    <label class="control-label col-md-4 col-sm-5 col-xs-5" for="feedback">
                    </label>
                    <div class="col-md-6 col-sm-7 col-xs-7">
                     
               <input type="checkbox" name="feedback" class="feedback"  />
               <span>Do you want to send feedback mail to the customer?</span>

                    </div>
                 </div>-->
                    &nbsp;
                    <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-4 col-sm-offset-4">
                            
                            <input type="submit" name="btnContinue" class="btn btn-success" id="btnsubmit" value="Update"/>&nbsp;
                        </div>
                    </div>
				</form>
		<?php	
				}
			
			}
			
			else {
				?>


				<form method="post" role="form" class="form-horizontal" name="" enctype="multipart/form-data" id="">
					
					<div class="item form-group">
		        		<label class="control-label col-md-4 col-sm-5 col-xs-5" for="dob">Pickup Date
	                    </label>
	                    <div class="col-md-6 col-sm-7 col-xs-7">
	          
	           			<input type="text" id="datepicker" class="form-control date-picker col-md-7 col-xs-12" name="pickdate" required="" placeholder="Select Pickup Date">      
	                    </div>
	                </div>
	                &nbsp;
	                <div class="item form-group">
	                	<label for="Image" class="control-label col-md-4 col-sm-5 col-xs-5">Pickup Time</label>
            				
            				<div class="col-md-6 col-sm-7 col-xs-7">
            				
            		<!--	<input id="timepicker2" type="text" class="input-small form-control" required="" name="picktime" placeholder="Enter Pickup Time: eg-4:00AM">-->
            		<select name="picktime" class="form-control" style="padding: 0px" required="">
            									<option value="">Select Pickup Time</option>
            											<?php
			
				 $res2=mysql_query("SELECT * from tbl_pickuptime");			
					if(mysql_affected_rows())
				{
					while($rows2=mysql_fetch_array($res2))
			
				{
					?>
					<option  value="<?php echo $rows2["PickupTime"]; ?>"  style="padding:10px"><?php echo $rows2["PickupTime"]; ?></option>
					
					<?php
					}
					}
				?>
            			
            									<!--<option value="08-09-AM" style="padding:10px">08-09 AM</option>
												<option value="09-10-AM" style="padding:10px">09-10 AM</option>
												<option value="10-11-AM" style="padding:10px">10-11 AM</option>
												<option value="11-12-AM" style="padding:10px">11-12 AM</option>
												<option value="12-01-PM" style="padding:10px">12-01 PM</option>
												<option value="01-02-PM" style="padding:10px">01-02 PM</option>
												<option value="02-03-PM" style="padding:10px">02-03 PM</option>
												<option value="03-04-PM" style="padding:10px">03-04 PM</option>
												<option value="04-05-PM" style="padding:10px">04-05 PM</option>
												<option value="05-06-PM" style="padding:10px">05-06 PM</option>
												<option value="06-07-PM" style="padding:10px">06-07 PM</option>
												<option value="07-08-PM" style="padding:10px">07-08 PM</option>
												<option value="08-09-PM" style="padding:10px">08-09 PM</option>-->
                   					</select>	
            				</div> 
	                </div>
	                &nbsp;
	
	              <div class="item form-group">
                    	
                    	<label for="Image" class="control-label col-md-4 col-sm-5 col-xs-5">Pickup Address</label>
            				
            				<div class="col-md-6 col-sm-7 col-xs-7">
            			  <?php
            			  $res1=mysql_query("select * from tblusers where UserId='$uid'") or die(mysql_error());
							if(mysql_affected_rows())
							{
								$rows1=mysql_fetch_array($res1);
            			  ?>
            			  <input type="text" class="form-control" readonly="" id="pickadd" name="address" required="" placeholder="Enter Customer Pickup Address" data-form-field="address" value="<?php echo $rows1["UserAddress"]; ?>" placeholder="<?php if(empty($rows1['UserAddress'])){ echo "Select Customer Pickup Address"; } else { echo "Change Customer Pickup Address" ; }?>">
            			       </div>
            			       
            			       <div class="col-md-6 col-sm-8 col-xs-12 col-md-offset-4 col-sm-offset-4">
            			        <div class="panel panel-default">
          	
			    <div class="panel-heading" role="tab" id="headingTwo" style="background-color: #0042A4; color:white;">
				    <h4 class="panel-title">
				    	
					    <a style="text-decoration:none;cursor: pointer" class="collapsed paneltext" data-toggle="collapse" data-target="#collapseTwo"  aria-expanded="false" aria-controls="collapseTwo">
						   <?php
						 if(empty($rows1["UserAddress"]))
						 {
						 echo "Select Your Pickup Address";	
						 }
						 else {
							 echo "Change Your Pickup Address";
						 }
						 ?>
						 </a>
						       
					 </h4>
				 </div>
						    
    			<div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
      				<div class="panel-body">
               
              			<div class="col-md-12" style="border:1px solid red">
				              <h4>Add New Address</h4>
				         	<!-- We can not do nested form, so we do this using ajax without form tag-->
				         	   <div class="row">
				         	   	
				         	   	
				               	<div class="form-group">
                            	<input type="text" class="form-control text-capitalize hidden" id="getuid" value="<?php echo $uid; ?>"  name="getuid"  placeholder="" data-form-field="">
                            	<input type="text" class="form-control text-capitalize hidden" id="getcity" value="<?php echo $rows1["UserCity"]; ?>"  name="getcity"  placeholder="" data-form-field="">
                            <!-- Using this field to get userid dynamically from email and mobile keyup function-->
                            </div>
				                	<div class="col-md-6">
										<div class="form-group">
										<textarea class="form-control" rows="1" id="newaddress" name="newaddress"></textarea>
				       					</div>
				                    </div>
				                    
				                	<div class="col-md-6">
										<div class="form-group">
										<input type="button"  id="savenewaddress" value="save address" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo" class="btn btn-success"/>                    
								        </div>
				                    </div>
				              </div>
				              
            			</div>
            			
          				<br/>
         
          			   <div class="col-md-12">
					          <h4>Already Saved Address</h4>
					              <span class="address-bar">
					              	 <ul style="list-style-type:none;margin-left:-50px" id="unlogin_addresslist">
					              	<?php
					              		$i=1;
					              		$rs1=mysql_query("select * from tblusers_address where UserID='$uid'") or die(mysql_error());
										if(mysql_num_rows($rs1)>0)
										{
											while($row1=mysql_fetch_array($rs1))
											{
												?>
												
												<li>
								    
								              	<b>Address <?php echo $i; ?> <span class="text-right"><i class="glyphicon glyphicon-edit"></i></span></b>
								                <address><i class="glyphicon glyphicon-map-marker"></i> <span class="addressspan"><?php echo $row1["Address"]; ?></span></address>
								                 <button type="button" class="btn g-back btn-block btn-success btnaddress" title="<?php echo $row1["Address"]; ?>" data-target="#collapseTwo" data-toggle="collapse"  aria-expanded="false" aria-controls="collapseTwo">Select</button>
								                 
								               </li>
												<?php
												$i++;
											}
										}
										}
					              		?>
					              		
					               </ul>
					             </span>
             						</div>
					          
					 			  </div>
					    	   </div>
					 	  </div>	
            				</div>  
                    	
                    </div>
                        &nbsp;
                    <div class="item form-group">
                    <label class="control-label col-md-4 col-sm-5 col-xs-5" for="pickby">Order Picked By
                    </label>
                    <div class="col-md-6 col-sm-7 col-xs-7">
                    	 <?php if($_SESSION['loginrole']==2 || $_SESSION['loginrole']==3){?>
                     <select class="form-control" name="pickby" id="pickby">
						 <option value="-1"  style="padding-bottom:7px">Select Order Picked By</option>
							<?php
			
				 $res2=mysql_query("SELECT * from tbl_per_employee_roles where empRoleId=7");			
					if(mysql_affected_rows())
				{
					while($rows2=mysql_fetch_array($res2))
			
				{
					$empid=$rows2['empId'];
					$r1=mysql_query("select * from tbl_employee where empId='$empid'");
					$row3=mysql_fetch_array($r1);
					?>
					<option  value="<?php echo $rows2["empId"]; ?>"   style="margin-bottom:7px"><?php echo $row3["empName"]; ?></option>
					
					<?php
					}
					}
				?>
						
                   </select>
                   
                   <?php }
					else {
						$empuname=$_SESSION['loginuser'];
						$q1=mysql_query("select * from tbl_employee where empEmail='$empuname'");
						$rws=mysql_fetch_array($q1);
						
					?>
					<input type="hidden" class="form-control" name="pickby" id="pickby" value="<?php echo $rws['empId']; ?>">
					<input type="text" class="form-control" readonly="readonly" value="<?php echo $rws['empName']; ?>">
					
					<?php
					} ?>
               

                    </div>
                    </div>
                
                    
                    
                    &nbsp;
                    <div class="item form-group">
                    <label class="control-label col-md-4 col-sm-5 col-xs-5" for="ordstatus">Order Status <span class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-7 col-xs-7">
                     <select class="form-control" required name="orstatus" id="orstatus" onchange="sendfeedback(this.value)">
						 <option value=""  style="padding-bottom:7px">Select Order Status</option>
						
						<?php
			
				 $res2=mysql_query("SELECT * from tbl_orderstatus_id");			
					if(mysql_affected_rows())
				{
					while($rows2=mysql_fetch_array($res2))
			
				{
					?>
					<option  value="<?php echo $rows2["order_status_id"]; ?>"  style="margin-bottom:7px"><?php echo $rows2["order_status_text"]; ?></option>
					
					<?php
					}
					}
				?>
                   </select>
               

                    </div>
                    </div>
                    &nbsp;
                    
                    <div class="orderdeliverdiv">
                    	
                    	<div class="item form-group">
			        		<label class="control-label col-md-4 col-sm-5 col-xs-5" for="deliverydate">Delivery Date
		                    </label>
		                    <div class="col-md-6 col-sm-7 col-xs-7">
		          			
		          			
		           			<input type="text" id="datepicker4" class="form-control date-picker col-md-7 col-xs-12" name="deliverydate"  placeholder="Select Delivery Date" >      
		                    </div>
		                </div>
		                &nbsp;
	                    	
                    	
	                    <div class="item form-group">
	                    <label class="control-label col-md-4 col-sm-5 col-xs-5" for="deliverby">Order Delivered By 
	                    </label>
	                    <div class="col-md-6 col-sm-7 col-xs-7">
	                  <?php if($_SESSION['loginrole']==2 || $_SESSION['loginrole']==3){?>
	                     <select class="form-control" name="deliverby" id="deliverby">
							 <option value="-1"  style="padding-bottom:7px">Select Order Deliver By</option>
								<?php
			
				$res2=mysql_query("SELECT * from tbl_per_employee_roles where empRoleId=7");	
					if(mysql_affected_rows())
				{
					while($rows2=mysql_fetch_array($res2))
			
				{
					$empid=$rows2['empId'];
					$r1=mysql_query("select * from tbl_employee where empId='$empid'");
					$row3=mysql_fetch_array($r1);
					?>
					<option  value="<?php echo $rows2["empId"]; ?>"  style="margin-bottom:7px"><?php echo $row3["empName"]; ?></option>
					
					<?php
					}
					}
				?>		
					
						
	                   </select>
	                    <?php }
					else {
						$empuname=$_SESSION['loginuser'];
						$q1=mysql_query("select * from tbl_employee where empEmail='$empuname'");
						$rws=mysql_fetch_array($q1);
						
					?>
					<input type="hidden" class="form-control" name="deliverby" id="deliverby" value="<?php echo $rws['empId']; ?>">
					<input type="text" class="form-control" readonly="readonly" value="<?php echo $rws['empName']; ?>">
					
					<?php
					} ?>
	               
	
	                    </div>
	                    </div>
	                    &nbsp;
                    	
                    </div>

                      <div class="item form-group">
		        		<label class="control-label col-md-4 col-sm-5 col-xs-5" for="receiptno">Order Receipt No
	                    </label>
	                    <div class="col-md-6 col-sm-7 col-xs-7">
	          			
	          			
	           			<input type="text" id="receiptno" class="form-control col-md-7 col-xs-12" name="receiptno"  placeholder="Enter Receipt Number" >      
	                    </div>
	                </div>
	                &nbsp;
	                
	                 <div class="item form-group">
		        		<label class="control-label col-md-4 col-sm-5 col-xs-5" for="receiptpic">Order Receipt Pic
	                    </label>
	                    <div class="col-md-6 col-sm-7 col-xs-7">
	          			
	          			
	           			<input type="file" id="receiptpic" class="form-control col-md-7 col-xs-12" name="receiptpic"  placeholder="Select Receipt Pic" >      
	                    </div>
	                </div>
	                &nbsp;
	                
	                 <div class="item form-group">
                    <label class="control-label col-md-4 col-sm-5 col-xs-5" for="oprocess">Order Process Type
                    </label>
                    <div class="col-md-6 col-sm-7 col-xs-7">
                     <select class="form-control" required name="oprocess" id="oprocess">
						 <option value=""  style="padding-bottom:7px">Select Order Process Type</option>
					
					<option  value="fresh" selected="selected" style="margin-bottom:7px">Fresh Order</option>
					
					<option  value="reprocess"  style="margin-bottom:7px">Reprocess Order</option>
					
                   </select>
               

                    </div>
                    </div>
                    &nbsp;
                    
                    <div class="item form-group">
                    <label class="control-label col-md-4 col-sm-5 col-xs-5" for="franchiseid">Franchise
                    </label>
                    <div class="col-md-6 col-sm-7 col-xs-7">
                     <select class="form-control" required name="franchiseid" id="franchiseid">
                     	<option value="1">Laundry Bucket</option>
						<?php
						$query1=mysql_query("select e.empId,e.empName,r.empRoleId from tbl_employee as e join tbl_per_employee_roles as r on r.empId=e.empId where r.empRoleId='9' order by e.empId");
						while($rows1=mysql_fetch_array($query1))
						{
						?>
						<option  value="<?php echo $rows1['empId'];?>" <?php if($rows1['empId']==$_SESSION['loginid']) echo selected;?>  style="margin-bottom:7px"><?php echo $rows1['empName'];?></option>
					
					<?php
						
						}
						?>
					
					
                   </select>
               

                    </div>
                    </div>
                    &nbsp;
                    
                    <div class="item form-group">
                                            <label class="control-label col-md-4 col-sm-5 col-xs-5" for="itname">Remarks
                                            </label>
                                            <div class="col-md-6 col-sm-7 col-xs-7">
                                      
                                    <input type="text" class="form-control col-md-7 col-xs-12"  name="review" placeholder="Remarks" style="height: 95px">
                                 
                                            </div>
                       <!--remarks multiple
                       
                       <div class="col-md-8 col-sm-12 col-xs-12 col-md-offset-2">
            			        <div class="panel panel-default" id="unloginpickup" style="display:none">
          	
			    <div class="panel-heading" role="tab" id="headingThree" style="background-color: #0042A4; color:white;">
				    <h4 class="panel-title">
					    <a style="text-decoration:none;cursor: pointer" class="collapsed paneltext" data-toggle="collapse" data-target="#collapseThree"  aria-expanded="false" aria-controls="collapseThree">
						   Change Your Remarks
						 </a>
						       
					 </h4>
				 </div>
						    
    			<div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
      				<div class="panel-body">
               
              			<div class="col-md-12" style="border:1px solid red">
				              <h4>Add New Remarks</h4>
				         	
				         	   <div class="row">
				         	   	
				         	   	
				               	<div class="form-group">
                            	
            			  <input type="text" class="form-control text-capitalize hidden" id="getuserid" value="<?php echo $uid; ?>"  name="getuserid"  placeholder="" data-form-field="">
                            </div>
				                	<div class="col-md-6">
										<div class="form-group">
										<textarea class="form-control" rows="1" id="newremarks" name="newremarks"></textarea>
				       					</div>
				                    </div>
				                    
				                	<div class="col-md-6">
										<div class="form-group">
										<input type="button"  id="savenewremarks" value="Save Remarks" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree" class="btn btn-success"/>                    
								        </div>
				                    </div>
				              </div>
				              
            			</div>
            			
          				<br/>
         
          			   <div class="col-md-12">
					          <h4>Already Saved Remarks</h4>
					              <span class="address-bar">
					              	 <ul style="list-style-type:none;margin-left:-50px" id="unlogin_remarkslist">
					              	
					              		
					               </ul>
					             </span>
             		</div>
          
 			  </div>
    	   </div>
 	  </div>	
            				</div>
                    end-->
                   </div>
                   
                   <!--<div class="item form-group" id="feedbackCheck" hidden>
                    <label class="control-label col-md-4 col-sm-5 col-xs-5" for="feedback">
                    </label>
                    <div class="col-md-6 col-sm-7 col-xs-7">
                     
               <input type="checkbox" name="feedback" class="feedback"  />
               <span>Do you want to send feedback mail to the customer?</span>

                    </div>
                   </div>-->
                    &nbsp;
                
                    <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-4 col-sm-offset-4">
                            
                            <input type="submit" name="btnPlaceOrder" class="btn btn-success" id="btnsubmit" value="Place Order"/>&nbsp;
                        </div>
                    </div>
				</form>
				<?php }?>
			</div>
		</div>
	</div>
</div>
<?php
}
?>
<br>
<br>
<?php
include 'footer.php';

?>