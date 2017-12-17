<?php include('header.php');
require 'class.phpmailer.php';
require 'class.smtp.php';
$uid=mysql_real_escape_string($_SESSION["uid"]);
if(!isset($_GET["id"]))
{
	//header("location:usersubscription.php");
	
	echo "<script>window.location.href='usersubscription.php';</script>";
}
$user_subscription_id=mysql_real_escape_string($_GET["id"]);
?>
<style>
	.mybtn{color:#fff; padding:5px; font-weight: normal;}
</style>


	<!-- BANNER -->
	<div class="section banner-page">
		<div class="container">
			<div class="row">
				<div class="col-sm-12 col-md-12">
					<div class="title-page">Subscription Order</div>
					<ol class="breadcrumb">
						<li><a href="index.php">Home</a></li>
						<li class="active">Subscription Order</li>
					</ol>
				</div>
			</div>
		</div>
	</div>
	 
	<!-- ABOUT FEATURE -->
	<div class="section pad">
		<div class="container">
			
			<div class="row">
				<div class="col-sm-3 col-md-3">
					<div class="widget categories">
						<ul class="category-nav">
							
							<li><a href="userorderhistory.php">Order History</a></li>
							<li class="active"><a href="usersubscription.php">My Subscriptions</a></li>
							<li><a href="userprofile.php">My Profile</a></li>
							<li><a href="contact.php">Assist Me</a></li>
						</ul>
					</div>
					
					
				</div>

				<div class="col-sm-9 col-md-9">
					<?php
function send_clientmessage($ordid,$pickdate,$picktime,$uname,$uphone)

{
	$txtmsg=urlencode("Laundry Bucket Order Placed Id $ordid . Date $pickdate . Pickup $picktime . Client $uname . Ph $uphone .");
						$ch = curl_init();
					 $url= "http://alerts.kapsystem.com/api/web2sms.php?workingkey=A28560483f0aa800b63f2d7ddeb3acb5a&to=$uphone&sender=BUCKET&message=".$txtmsg;
					 //echo $url;
    									curl_setopt($ch, CURLOPT_URL, $url);
										curl_setopt($ch, CURLOPT_HEADER, 0);
										//curl_exec($ch);
	
	if($result = curl_exec($ch))
    {
  	//header("location:usersubscription.php?ref=current&ordersuccess");
    }
										else
											{
												//header("location:usersubscription.php?ref=current&orderfail");
											} 
										
								    
								   	curl_close($ch);
	
}


function send_adminmessage($ufame,$order_type,$uphone,$address)
{

$admmsg=urlencode("Laundry Order Detail: Name: $ufame, Ph: $uphone , Type: $order_type , Add: $address Thanks.	");
						$ch = curl_init();
					// $url="http://text.sircltech.com/sendsms.jsp?user=rajeev&password=RJVOIL&mobiles=$upmob&sms=$utxtmsg&senderid=RJVOIL";
					 $url= "http://alerts.kapsystem.com/api/web2sms.php?workingkey=A28560483f0aa800b63f2d7ddeb3acb5a&to=8744009933,9718661177&sender=BUCKET&message=".$admmsg;
					 //echo $url;
    									curl_setopt($ch, CURLOPT_URL, $url);
										curl_setopt($ch, CURLOPT_HEADER, 0);
										//curl_exec($ch);
										
								    if($result = curl_exec($ch))
								    {
								    	echo "<script>window.location.href='usersubscription.php?ref=current&ordersuccess'</script>";
								//header("location:usersubscription.php?ref=current&ordersuccess");
								
									} 
									
									else
											{
												echo "<script>window.location.href='usersubscription.php?ref=current&orderfail'</script>";
								//header("location:usersubscription.php?ref=current&orderfail");
								
											} 
										curl_close($ch);
	
}
?>


<?php
    
function submit_order($order_type,$uid,$uemail,$ufame,$uname,$uphone,$user_subscription_id,$address,$pickdate,$picktime,$order_status_id,$review,$order_total_weight)
{
	$usermessage = file_get_contents('email_template/usersubscription_userorder.html');
$adminmessage = file_get_contents('email_template/usersubscription_adminorder.html');
	
	$ordervia='website';
	$createdby='user';
		$result=mysql_query("insert into  tbl_orders(OrderUserId,PickupAddress,OrderStatusId,Order_PickDate,Order_PickTime,Remarks,Order_Via,CreatedBy,addon) values('$uid','$address','$order_status_id','$pickdate','$picktime','$review','$ordervia','$createdby',now())") or die(mysql_error());
							
		if(mysql_affected_rows())
	{
						$ordid=mysql_insert_id();
		
		$q=mysql_query("select * from tbl_services where ServiceName like '%$order_type%'");
		$r=mysql_fetch_array($q);
		$ordertypeid=$r['ServiceId'];
						
		$result1=mysql_query("insert into tbl_suborders(OrderId,UserId,OrderTypeId,addon) values('$ordid','$uid','$ordertypeid',now())");
		if($result1)
		{
			$suboid=mysql_insert_id();
			
			$q1=mysql_query("select * from tbl_usersubscriptions where srno='$user_subscription_id'");
			$r1=mysql_fetch_array($q1);
			$subs_id=$r1['subs_id'];
			
			$result2=mysql_query("insert into tbl_subs_suborder(subOrderId,user_subs_id,addon) values('$suboid','$user_subscription_id',now())");
			if($result2)
			{
				echo "ok";
			}
else
{
	echo mysql_error();
}
			
	}
	

// Replace the % with the actual information for sending email to user id
   $usermessage = str_replace('%orderid%', $ordid, $usermessage);
   $usermessage = str_replace('%pickdate%', $pickdate, $usermessage);
   $usermessage = str_replace('%picktime%', $picktime, $usermessage);			
   $usermessage = str_replace('%address%', $address, $usermessage);							

 // Replace the % with the actual information for sending email to Admin id

   $adminmessage = str_replace('%client-name%', $uname, $adminmessage);
   $adminmessage = str_replace('%orderid%', $ordid, $adminmessage);
   $adminmessage = str_replace('%client-email%', $uemail, $adminmessage);
   $adminmessage = str_replace('%client-mobile%', $uphone, $adminmessage);
   $adminmessage = str_replace('%pickdate%', $pickdate, $adminmessage);
   $adminmessage = str_replace('%picktime%', $picktime, $adminmessage);			
   $adminmessage = str_replace('%address%', $address, $adminmessage);							
   $adminmessage = str_replace('%review%', $review, $adminmessage);

  
      $mail = new PHPMailer(); // create a new object
      $mail->IsSMTP(); // enable SMTP
      $mail->SMTPDebug = 0; // debugging: 1 = errors and messages, 2 = messages only
      $mail->SMTPAuth = true; // authentication enabled
      $mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for GMail
      $mail->Host = "smtp.gmail.com";
      $mail->Port = 465; // or 587
      $mail->IsHTML(true);
      $mail->Username = "laundrybucket77@gmail.com"; //gmail email here
      $mail->Password = "5qgapFAnR8giCOjA"; //gmail password here
      $mail->SetFrom("laundrybucket77@gmail.com"); //from Address here
      $mail->Subject = "New Subscription Order from laundrybucket.co.in";
      $mail->Body = $adminmessage ;
      $mail->AddAddress("laundrybucket1988@gmail.com"); //Email t0 testadmin@laundrybucket.co.in

      
 if($mail->Send())
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
$mail->Subject = "Thanks for placing order";
$mail->Body = $usermessage ;
$mail->AddAddress($uemail); /*Email t0*/
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
    
     send_clientmessage($ordid,$pickdate,$picktime,$uname,$uphone);	
		
	send_adminmessage($ufame,$order_type,$uphone,$address);	
	
    } 
							else
								{
								echo "not inserted";	
								}

}
?>

 <?php
			
			if(isset($_POST["submit"]))
		{
			
			$order_type="subscription";
			$address=mysql_real_escape_string(trim($_POST["address"]));
			$pickdate=mysql_real_escape_string(trim($_POST["pickdate"]));
			$picktime=mysql_real_escape_string(trim($_POST["picktime"]));
			
			$order_status_id=0; // here order status zero means Order is Ready for Pickup store in table tbl_orderstatus_id
			$order_total_weight=0;
			
			$review=mysql_real_escape_string(trim($_POST["review"]));
			
			
			
			
			
				$result=mysql_query("select * from tblusers where UserId='$uid'");
				$row=mysql_fetch_array($result);
				
				$ufame=$row["UserFirstName"];
				$ulame=$row["UserLastName"];
				$uname=$ufame.' '.$ulame;
				$uemail=$row["UserEmail"];
				$uphone=$row["UserPhone"];
				
		
	 		submit_order($order_type,$uid,$uemail,$ufame,$uname,$uphone,$user_subscription_id,$address,$pickdate,$picktime,$order_status_id,$review,$order_total_weight);


					
							}

				?>	
	<?php
	
	$q=mysql_query("select * from tblusers where UserId='$uid'");
	$rw=mysql_fetch_array($q);
	?>	
					
					<div class="single-page row">
						<div class="col-md-12 col-sm-12 col-xs-12">
						<form method="post" data-form-title="PROVIDE YOUR PICK UP DETAILS">
                          
                            <input type="hidden" value="6H50uNkmkicfaj9R3ES/7SG6674QJObvsCo4vcoF9BaYt6FYAdBOD/7NF1AyIMy5aKhnr8n+ZoOm+BIVJoQw1r6Ixrkqmx9bfRt1vuOvd0MA8CP4KHfc0lTEL/giMBND" data-form-email="true">
                            
                            
                           
             			<div class="item form-group">
                    	
            				<div>
            			  
            			  <input type="text" class="form-control" readonly="" id="pickadd" name="address" required="" data-form-field="address" value="<?php echo $rw['UserAddress']; ?>" placeholder="<?php if(empty($rw['UserAddress'])){ echo "Select  Pickup Address"; } else { echo "Change  Pickup Address" ; }?>">
            			       </div>
            			       
            			       <div>
            			        <div class="panel panel-default">
          	
			    <div class="panel-heading" role="tab" id="headingTwo" style="background-color: #0042A4; color:white;">
				    <h4 class="panel-title">
				    	
					    <a style="text-decoration:none;cursor: pointer" class="collapsed paneltext" data-toggle="collapse" data-target="#collapseTwo"  aria-expanded="false" aria-controls="collapseTwo">
						   <?php
						 if(empty($rw['UserAddress']))
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
				               		
            			  <input type="text" class="form-control text-capitalize hidden" id="getcity" value="<?php echo $rw["UserCity"]; ?>"  name="getcity"  placeholder="" data-form-field="">
            			  
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
					              	 <ul style="list-style-type:none;" id="unlogin_addresslist">
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
                            
                             <div class="form-group">
                 <input type="text" id="datepicker" class="form-control datepicker" name="pickdate" required="" readonly="" placeholder="Select Pickup Date">
                            </div>
                            
                      
                       <div class="form-group">
                   	<select name="picktime" required class="form-control" style="padding: 0px">
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
												
                   					</select>
                
                </div>        
                                     
                          
                
                     <div class="form-group">
                               <input type="text"  class="form-control"  name="review" placeholder="Remarks" style="height: 95px">
                            </div>
  
      
                            <div class="mbr-buttons mbr-buttons--right">
                            	<input value="Place Order" type="submit" name="submit" class="btn btn-primary btn-lg btn-info">
                            	</div>
                        </form>	
						</div>
					 </div>

				</div>

			</div>
	
		</div>
	</div>

<?php include('footercta.php')?>
		
<?php include('footer.php');?>
<script>
$(document).on("click","#savenewaddress",function()
{

	
	var getuid=$("#getuid").val();
	var address=$("#newaddress").val();
	
	var strurl="https://beta.laundrybucket.co.in/lb-admin/apisave_newaddress.php?uid="+getuid+"&address="+address;
	//alert(strurl);
	$.ajax({
		url:strurl,
		type:"GET",
		success:function(data)
		{
			
			$("#headingTwo").css("background-color", "#444"); 
			$("#pickadd").val(address);
				
				
			},
			error:function(err)
			{
				alert($err);
			}
		 })
});

$(document).on("click",".btnaddress",function(){
	var address=$(this).attr("title");
	
	$("#headingTwo").css("background-color", "#444");
	$("#pickadd").val(address);
	
	
	
});
</script>