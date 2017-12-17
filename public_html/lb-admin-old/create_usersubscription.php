<?php
include 'header.php';
require '../class.phpmailer.php';
require '../class.smtp.php';
?>

<script type="text/javascript" src="js/datepicker/daterangepicker.js"></script>
	
  <script type="text/javascript">
                        $(document).ready(function () {
                            $('.datepicker').daterangepicker({
                                singleDatePicker: true,
                                calender_style: "picker_3",
                                 //showDropdowns: true
                            }, function (start, end, label) {
                                console.log(start.toISOString(), end.toISOString(), label);
                            });
                        });
  </script>
  
  
<script>
function showsubscriptionDetail(substypeid) {
  var xhttps;
  xhttps = new XMLHttpRequest();
  url="api_getsubsdetail.php?subsid="+substypeid;
 // alert(url);
  xhttps.onreadystatechange = function() {
    if (xhttps.readyState == 4 && xhttps.status == 200) {
      document.getElementById("subsdetail").innerHTML = xhttps.responseText;
      
    }
  };
  xhttps.open("GET",url, true);
  xhttps.send();
}

</script>



   <div class="right_col" role="main">

 <div class="">
                    <div class="page-title">
                        <div class="title_left">
                            <h3>Create Order</h3>
                        </div>

                        
                    </div>
                    <div class="clearfix"></div>
       
      
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2><i class="fa fa-bars"></i> Create New User Subscription </h2>
                                    <ul class="nav navbar-right panel_toolbox">
                                    	
                                    	 <li>
                                        	<button onclick="window.location.href=''" value="Reset Form!" class="btn btn-danger">Reset Subscription Form</button>
                                        	</li>
                                    	
                                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                        </li>
                                       
                                        <li><a class="close-link"><i class="fa fa-close"></i></a>
                                        </li>
                                        
                                       
                                    </ul>
                                    <div class="clearfix"></div>
                                 
                                </div>
                                <div class="x_content">
                                	
                                	
<?php

		if(isset($_POST["btnsave"]))
		{
			$uid=mysql_real_escape_string($_GET["userid"]);
			$fname=trim(mysql_real_escape_string($_POST["fname"]));
			$lname=trim(mysql_real_escape_string($_POST["lname"]));
			$name=$fname." ".$lname;
			
			$email=trim(mysql_real_escape_string($_POST["email"]));
			
			$phone1=trim(mysql_real_escape_string($_POST["phone1"]));
			$phone2=trim(mysql_real_escape_string($_POST["phone2"]));
			$phone=(empty($phone1) ? $phone2:$phone1);
			
			$soldby=trim(mysql_real_escape_string($_POST["soldby"]));
			
			$subsid=trim(mysql_real_escape_string($_POST["substype"]));
			
			$sub_startdate=trim(mysql_real_escape_string($_POST["sub_startdate"]));
			
			$startdate = date('F d, Y',strtotime($sub_startdate));
			
			//  $duedate = date('F d, Y', strtotime('+1 month'));                                               
         
		 	$new_renewal=date('F d, Y', strtotime($startdate. '+1 month'));
		
		 
			 $maxpickup=0;
		 	$used_weight=0;
		
		 	$subs_status='inactive';
		 
			$date=date('m/d/Y');
							
			$subs_name=trim(mysql_real_escape_string($_POST["subs_name"]));
			$subs_cost=trim(mysql_real_escape_string($_POST["subs_cost"]));
			$subs_wt=trim(mysql_real_escape_string($_POST["subs_wt"]));
			$subs_maxpickup=trim(mysql_real_escape_string($_POST["subs_maxpickup"]));
			
	        $result2=mysql_query("insert into tbl_usersubscriptions(UserId,subs_id,start_date,next_renewal,last_renewal,max_pickup,used_weight,subs_status,soldby,addon) values('$uid','$subsid','$startdate','$new_renewal','$startdate','$maxpickup','$used_weight','$subs_status','$soldby',NOW())");
			$usersubid=mysql_insert_id();
			
			if(mysql_affected_rows())
			{
			
			$customermsg = file_get_contents('../email_template/placesubscription_user.html');
	        $adminmessage = file_get_contents('../email_template/placesubscription_admin.html');
	
	
	  $adminmessage = str_replace('%uname%', $name, $adminmessage);
   	  $adminmessage = str_replace('%uemail%', $email, $adminmessage);
      $adminmessage = str_replace('%umobile%', $phone, $adminmessage);
   
   $adminmessage = str_replace('%usersubid%', $usersubid, $adminmessage);
   $adminmessage = str_replace('%subname%', $subs_name, $adminmessage);
   $adminmessage = str_replace('%subcost%', $subs_cost, $adminmessage);			
   $adminmessage = str_replace('%subweight%', $subs_wt, $adminmessage);							
   $adminmessage = str_replace('%subexpiredate%', $new_renewal, $adminmessage);
							
							
							// Replace the % with the actual information for sending email to customer id

   $customermsg = str_replace('%customername%', $name, $customermsg);
   $customermsg = str_replace('%usersubid%', $usersubid, $customermsg);
   $customermsg = str_replace('%subname%', $subs_name, $customermsg);
   $customermsg = str_replace('%subcost%', $subs_cost, $customermsg);			
   $customermsg = str_replace('%subweight%', $subs_wt, $customermsg);							
   $customermsg = str_replace('%subexpiredate%', $new_renewal, $customermsg);
	$customermsg = str_replace('%substatus%', $subs_status, $customermsg);		
	
		
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
								$mail->SetFrom($email,"Laundry Bucket Subscription"); //from Address here
								//$mail->AddReplyTo($usemail, 'Laundry Ticket');
								$mail->Subject = "New Subscription  from laundrybucket.co.in";
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
								$mail->Subject = "Laundry Subscription plan:".$subs_name;
								$mail->Body = $customermsg;
								$mail->AddAddress($email); //Email to
								//$mail->AddCC("support@laundrybuckethelp.zendesk.com", 'cc account');
							 if($mail->Send())
							    {
							    //header("location:thnkulaundry.php");
								 //exit;
								
							    }
							    else
							    {
							       //echo "<p style='padding:10px;' class='bg bg-info'>Mail error</p>";
							    }
	 					
						}
				
				else {
						
					}
				
				
				
			$txtmsg=urlencode("Dear $name, Thanks to Subscribe Our Plan $subs_name . Subscription id $usersubid Regards,Team Laundry Bucket.");
		
		
						$ch = curl_init();
					// $url="http://text.sircltech.com/sendsms.jsp?user=rajeev&password=RJVOIL&mobiles=$upmob&sms=$utxtmsg&senderid=RJVOIL";
		$url= "http://alerts.kapsystem.com/api/web2sms.php?workingkey=A28560483f0aa800b63f2d7ddeb3acb5a&to=$phone&sender=BUCKET&message=$txtmsg";
    									curl_setopt($ch, CURLOPT_URL, $url);
										curl_setopt($ch, CURLOPT_HEADER, 0);
										//curl_exec($ch);
	
										if($result = curl_exec($ch))
									    {
									  	//echo 'alert("subscription subscribed successfully")';
										// header("location:thnkulaundry.php");
									      echo '<script type="text/js"> alert("subscription subscribed successfully"); </script>';
									    }
										
										else
											{
										//header("location:thnkulaundry.php");		
											} 
									 
curl_close($ch);

			echo '<script type="text/javascript">alert("subscription subscribed successfully");</script>';
		}
			                        	
	}                             	
?>                                	
                                	
                                	
    					

<?php
if(isset($_GET["userid"]))
{
	$userid=$_GET["userid"];
	$res=mysql_query("select * from tblusers where UserId='$userid'") or die(mysql_error());
if(mysql_affected_rows())
{
	$rows=mysql_fetch_array($res);

?>
 <form method="post" role="form" class="form-horizontal" name="ordern" enctype="multipart/form-data">
                                    		
                                    	
                                    		<div class="col-md-12 col-sm-12 col-xs-12">
                                    			&nbsp;<br/>
                                    			</div>
                                   		      &nbsp;
                                       
            								 <div class="item form-group <?php if(empty($rows["UserEmail"])) { echo "hidden" ;}?>" id="usemail">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="itname">Customer Email
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                      <input type="email" class="form-control col-md-7 col-xs-12 <?php if(empty($rows["UserEmail"])) { echo "hidden" ;}?>" readonly=""   id="email" name="email" value="<?php echo $rows["UserEmail"]; ?>"   placeholder="Enter Customer Email Id" data-form-field="Email">
                                
                                            </div>
                                        </div>

            								&nbsp;
            						             
            						               <?php
                            if(empty($rows["UserPhone"]))
							{
								?>
								       								
            								 <div class="item form-group hidden" id="usmobile">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="itname">Mobile
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                     
                                         <input type="tel" class="form-control col-md-7 col-xs-12 phone hidden" readonly=""  name="phone1" value="<?php echo $rows["UserPhone"]; ?>"  data-inputmask="'mask' : '9999999999'" placeholder="Enter Customer Mobile no" data-form-field="Phone">
                                           
                                            </div>
                                        </div>
            
                                        &nbsp;
                                        
                                        &nbsp;
            						               								
            								 <div class="item form-group phonegroup2" id="usmobile2">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="itname"> Mobile no*
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                     
                                         <input type="tel" class="form-control col-md-7 col-xs-12" name="phone2" required="" pattern="[0-9]{10}" title="Enter valid 10 digit mobile number" value="<?php echo $rows["UserPhone2"]; ?>"  data-inputmask="'mask' : '9999999999'" placeholder="Enter Customer Mobile no" data-form-field="Phone">
                                           
                                            </div>
                                        </div>
            
                                        &nbsp;
							<?php	
							}
							else {
								?>
								 <div class="item form-group" id="usmobile">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="itname">Mobile*
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                     
                                         <input type="tel" class="form-control col-md-7 col-xs-12 phone" readonly=""   name="phone1" required="" value="<?php echo $rows["UserPhone"]; ?>"  data-inputmask="'mask' : '9999999999'" placeholder="Enter Customer Mobile no" data-form-field="Phone">
                                           
                                            </div>
                                        </div>
            
                                        &nbsp;
                                        
                                        &nbsp;
            						               								
            								 <div class="item form-group phonegroup2" id="usmobile2">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="itname">Alternate Mobile no
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                     
                                         <input type="tel" class="form-control col-md-7 col-xs-12" name="phone2"  value="<?php echo $rows["UserPhone2"]; ?>"  pattern="[0-9]{10}" title="Enter valid 10 digit mobile number"  data-inputmask="'mask' : '9999999999'" placeholder="Enter Customer Alternate Mobile no" data-form-field="Phone">
                                           
                                            </div>
                                        </div>
            
                                        &nbsp;
							<?php										
							}
								?>
            						        
                                        
            							  <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="firstname">Customer First Name
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                      
                                    <input type="text" class="form-control col-md-7 col-xs-12 text-capitalize"   name="fname" value="<?php echo $rows["UserFirstName"]; ?>" id="ufname" required=""  placeholder="Enter Customer First Name" data-form-field="Name">
                            
                                            </div>
                                        </div>
                                      
                                       &nbsp;
                                       
                                        
                                         <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="lastname">Customer Last Name
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                      
                                    <input type="text" class="form-control col-md-7 col-xs-12 text-capitalize"  name="lname" value="<?php echo $rows["UserLastName"]; ?>" id="ulname" required="" placeholder="Enter Customer Last Name" data-form-field="Name">
                                
                                            </div>
                                        </div>
									&nbsp;
									
									<div class="item form-group">
									 	<label class="control-label col-md-3 col-sm-3 col-xs-12" for="from date"> Subscription Start Date:</label>
             						   <div class="col-md-6 col-sm-6 col-xs-12">
             							<input type="text"  name="sub_startdate" value="<?php echo date("m/d/Y"); ?>"  class="col-md-7 col-xs-12 form-control datepicker"  placeholder="Select Subscription Start Date">
               						 </div>
               						</div>
									                                      
                                  &nbsp;
                                  
                                   <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="lastname">Sold By
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                      
                                    <input type="text" class="form-control col-md-7 col-xs-12 text-capitalize"  name="soldby" id="soldby"  placeholder="Sold By" data-form-field="Sold By">
                                
                                            </div>
                                        </div>
                                        
                                      &nbsp;
                                                                     
                                              <div class="item form-group" >
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12"> Select Subscription
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12" >
                                             <select class="form-control"  id="substype" name="substype" onchange="showsubscriptionDetail(this.value)"   style="cursor: pointer" required>
            							<option value=""  style="padding-bottom:7px">Select Subscription Type</option>
            						
            						<?php
            						$rs1=mysql_query("select * from tbl_subscriptions") or die(mysql_error());
										if(mysql_num_rows($rs1)>0)
										{
											while($row1=mysql_fetch_array($rs1))
											{
												?>
							<option value="<?php echo $row1["subs_id"]; ?>"  style="padding-bottom:7px"> <?php echo $row1["subs_name"]; ?> </option>			
            							
										<?php
											}
										 }	
										?>
										</select>
                                            </div>
                                        </div>
                            
                                        &nbsp;
                          	
                          <div class="subsdetail form-group" id="subsdetail">
                                   			
                           </div>	
            			                   
            			                   </div>
            			                   
                                        <div class="ln_solid"> </div>
                                        <div class="form-group">
                                            <div class="col-md-6 col-md-offset-3">
                                                
                                                <input type="submit" name="btnsave" class="btn btn-success" id="btnsubmit" value="Save & Continue..."/>&nbsp;
                                            </div>
                                        </div>
                                    </form>
                                   
			<?php	
				}
			}
			
			
			else {
		
				}
					
		?>
                           
                                   
                                   
                                   
                                  
                             
                                   
                                
                                </div>
                                                
                                            
                                            
                                        

                                </div>
                            </div>
                            </div>
                            </div>
                            
<?php include 'footer.php';?>                            
