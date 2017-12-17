<?php
include 'header.php';
?>
<?php
if(isset($_POST['btnsave']))
{
	$fname=mysql_real_escape_string(trim($_POST["fname"]));
	$lname=mysql_real_escape_string(trim($_POST["lname"]));
	$email=mysql_real_escape_string(trim($_POST["email"]));		
	$phone1=mysql_real_escape_string(trim($_POST["phone1"]));
	$phone2=mysql_real_escape_string(trim($_POST["phone2"]));
	$pickup_address=mysql_real_escape_string(trim($_POST["address"]));
	$reference=mysql_real_escape_string(trim($_POST["reference"]));
	
	$reftxt=mysql_real_escape_string(trim($_POST["reftxt"]));
	
	$city=$_POST["city"];
	$user_type='websiteuser';
	$upass=md5(rand(1111,9999));
	$user_status=0;
	$regdate=date("Y-m-d");
	$uid=$_POST['getuid'];
	$verify_code=rand(1111,9999);
	$createdby="admin";
	if(!empty($phone2))
	{
		$res5=mysql_query("select * from tblusers where UserId='$uid'");
		if(mysql_num_rows($res5)>0)
		{
			$res6=mysql_query("update tblusers set UserPhone2='$phone2' where UserId='$uid'");
		}
	}
	if(!empty($email))
	{
		$res5=mysql_query("select * from tblusers where UserId='$uid' and UserEmail=''");
		if(mysql_num_rows($res5)>0)
		{
			$res6=mysql_query("update tblusers set UserEmail='$email' where UserId='$uid'");
		}
	}
	
	if($uid=="")
	{
		$res1=mysql_query("insert into tblusers(UserType,UserEmail,UserPassword,UserFirstName,UserLastName,UserCity,UserVerifiedStatus,UserRegistrationDate,UserVerificationCode,UserPhone,UserAddress,CreatedBy,UserPhone2,UserReference,UserReferenceRemarks) values('$user_type','$email','$upass','$fname','$lname','$city','$user_status','$regdate','$verify_code','$phone1','$pickup_address','$createdby','$phone2','$reference','$reftxt')");
		if(mysql_affected_rows())
		{
		$uid=mysql_insert_id();
		$res2=mysql_query("insert into tblusers_address(UserId,Address,addon) values('$uid','$pickup_address',NOW())");
		if(mysql_affected_rows())
		{
		//$_SESSION['current_user']=$uid;
		header('location:order_dashboard.php?uid='.$uid);
    	}
		}
	}
	else
	{
		$q=mysql_query("update tblusers set UserCity='$city',UserReference='$reference',UserReferenceRemarks='$reftxt' where UserId='$uid'");
		if($q)
		{
		//$_SESSION['current_user']=$uid;
		header('location:order_dashboard.php?uid='.$uid);
		}
	}
	
}
?>
<script>
	$(document).on("keyup","#email, .phone",function()
	{
		var email=$("#email").val();
		var phone=$(".phone").val();
		$("#message").empty();
		$(".phone").empty();
		$(".phone2").val("");
		$("#pickadd").val("");
		$("#getuid").val("");
		var url="https://www.laundrybucket.co.in/lb-admin/fetch_existuser.php?uemail="+email+"&uphone="+phone;
		//alert(url);
		$.ajax({
			url:url,
			type:"GET",
			success:function(data)	
			{
				$.each(data,function(i,field){
					
					var status=field.status;
					if(status==1)
					{
						$("#message").html("<strong>This is already existing user</strong>");
						//var fetchphone=	field.phone;
						var pickupadd=field.address;
						
						$("#ufname").val(field.ufname);
						$("#ulname").val(field.ulname);
						$("#email").val(field.email);
						$(".phone").val(field.phone);
						$(".phone2").val(field.phone2);
						$("#pickadd").val(field.address);
						$("#unloginpickup").show();
						$("#getuid").val(field.userid);
						$("#city1").val(field.city);
					$("#reference").val(field.reference);
					$("#reference").trigger('change');
						$("#unlogin_addresslist").append(field.unloginuaddress);
						$('#pickadd').prop('readonly', true);
						$('#email').prop('readonly', true);
						$('.phone').prop('readonly', true);
						
						/*if(fetchphone==null || fetchphone=="")
						{
								$('.phone').prop('required', false);
								
								$('.phonegroup1, .phone').hide();
								$('.phone2').prop('required', true);
								$('.phonegroup2 label').text("Customer Phone no");
								$('.phone2').prop('placeholder', "Enter Customer Phone No");
						}
						else
						{
							$('.phone').prop('required', true);
							$('.phonegroup1, .phone').show();
							$('.phone2').prop('required', false);
							$('.phonegroup2 label').text("Customer Alternate Phone no");
							$('.phone2').prop('placeholder', "Enter Customer Alternate Phone No");
						}
						*/
						if(pickupadd==null || pickupadd=="")
						{
							
							$("#pickadd").prop('placeholder', "select Customer Pickup Address");
							$(".paneltext").text("select Customer Pickup Address");
						}
						else
						{
							$("#pickadd").prop('placeholder', "Change Customer Pickup Address");
							$(".paneltext").text("Change Customer Pickup Address");
						}
						
					}
					else if(status==0)
					{
						$("#message").html("<strong>New User</strong>");
						$("#unloginpickup").hide();
						$('#pickadd').prop('readonly', false);
						$('#email').prop('readonly', false);
						$('.phone').prop('readonly', false);
						$('.phone').prop('required', true);
						$('.phone2').prop('required', false);
						$("#pickadd").removeClass("readonly");
						$(".phone").val();
						$("#pickadd").val();
					}
					
				});
				}
			})
	});
	
</script>

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
    
    function showreftxt(refval)
    {
    	if(refval==5)
    	{
    		$("#reftxtdiv").show();
    	}
    	else
    	{
    		$("#reftxtdiv").hide();
    		$("#reftxt").val("");
    	}
    }      	
       
       $(document).ready(function(){
       	var refval1=$("#reference").val();
       	if(refval1==5)
    	{
    		$("#reftxtdiv").show();
    	}
    	else
    	{
    		$("#reftxtdiv").hide();
    		$("#reftxt").val("");
    	}
       });   	
       
          </script>

<div class="right_col" role="main">
	<div class="row">
		<div class="container">
			<div class="col-md-12 col-sm-12 col-xs-12" style="text-align: center;">
				<h2>Customer Personal Information</h2>
			</div>
			<div class="col-md-12 col-sm-12 col-xs-12">
<?php
if(isset($_GET["userid"]))
{
	$userid=$_GET["userid"];
	$res=mysql_query("select * from tblusers where UserId='$userid'") or die(mysql_error());
if(mysql_affected_rows())
{
	$rows=mysql_fetch_array($res);

?>
				<form method="post" role="form" class="form-horizontal" name="" enctype="multipart/form-data" id="">
					<div class="col-md-8 col-sm-12 col-xs-12 text-center col-md-offset-2">
            		<span id="message" style="color:red;"> </span>
            			</div>
           		 
           		      &nbsp;
					<div class="item form-group">
                       <div id="usemail">
                        <label class="control-label col-md-4 col-sm-5 col-xs-5" for="itname">Customer Email
                        </label>
                        <div class="col-md-6 col-sm-7 col-xs-7">
                  		<input type="email" class="form-control col-md-7 col-xs-12" id="email" readonly="" name="email" value="<?php echo $rows['UserEmail']; ?>"   placeholder="Enter Customer Email Id" data-form-field="Email">
            
                        </div>
                        </div>
                    </div>
                    &nbsp;
                    <div class="item form-group">
                        <?php
                            if(empty($rows["UserPhone"]))
							{
								?>
                      <div class="phonegroup1" id="usmobile">
                        <label class="control-label col-md-4 col-sm-5 col-xs-5" for="itname">Mobile
                        </label>
                        <div class="col-md-6 col-sm-7 col-xs-7">
                 
                     <input type="tel" class="form-control col-md-7 col-xs-12 phone" name="phone1" required="" pattern="[0-9]{10}" title="Enter your mobile number"  data-inputmask="'mask' : '9999999999'" placeholder="Enter Customer Mobile no" data-form-field="Phone" value="<?php echo $rows['UserPhone2']; ?>">
                       
                        </div>
                     </div>
                     <?php
							} 
							else {
								
							
                     ?>
                   <div class="phonegroup1" id="usmobile">
                        <label class="control-label col-md-4 col-sm-5 col-xs-5" for="itname">Mobile
                        </label>
                        <div class="col-md-6 col-sm-7 col-xs-7">
                 
                     <input type="tel" class="form-control col-md-7 col-xs-12 phone" name="phone1" readonly="" required="" pattern="[0-9]{10}" title="Enter your mobile number"  data-inputmask="'mask' : '9999999999'" placeholder="Enter Customer Mobile no" data-form-field="Phone" value="<?php echo $rows["UserPhone"]; ?>">
                       
                        </div>
                    </div>
                    <?php  } ?>
                    </div>
                    &nbsp;
                    <div class="item form-group">
                      <div class="phonegroup2" id="usmobile2">
                            <label class="control-label col-md-4 col-sm-5 col-xs-5" for="itname">Alternate Mobile
                            </label>
                            <div class="col-md-6 col-sm-7 col-xs-7">
                     
                         <input type="tel" class="form-control col-md-7 col-xs-12 phone2" name="phone2" pattern="[0-9]{10}" title="Enter your mobile number"  data-inputmask="'mask' : '9999999999'" placeholder="Enter Customer another Mobile no" data-form-field="Phone" value="<?php echo $rows['UserPhone2']; ?>">
                           
                            </div>
                        </div>
                     </div>
                    &nbsp;
                    <div class="item form-group">
                    	<label class="control-label col-md-4 col-sm-5 col-xs-5" for="firstname">Customer First Name
			            </label>
			            <div class="col-md-6 col-sm-7 col-xs-7">
			      
			    		<input type="text" class="form-control col-md-7 col-xs-12"   name="fname" id="ufname" onblur="return usname(document.ordern.name)" required="" placeholder="Enter Customer First Name" data-form-field="Name" value="<?php echo $rows["UserFirstName"]; ?>">
						<span id="nameerr" style="color: Red; display: none">Characters only </span>    
			            </div>
                    </div>
                    &nbsp;
                    <div class="item form-group">
                    	 <label class="control-label col-md-4 col-sm-5 col-xs-5" for="lastname">Customer Last Name
                        </label>
                        <div class="col-md-6 col-sm-7 col-xs-7">
                  
                		<input type="text" class="form-control col-md-7 col-xs-12"  name="lname" id="ulname" required="" placeholder="Enter Customer Last Name" data-form-field="Name" value="<?php echo $rows["UserLastName"]; ?>">
            
                        </div>
                    </div>
                    &nbsp;
                    <div class="item form-group">
                    	
                    	<label for="Image" class="control-label col-md-4 col-sm-5 col-xs-5">Pickup Address</label>
            				
            				<div class="col-md-6 col-sm-7 col-xs-7">
            			  
            			  <input type="text" class="form-control" readonly="" id="pickadd" name="address" required="" placeholder="Enter Customer Pickup Address" data-form-field="address" value="<?php echo $rows["UserAddress"]; ?>" placeholder="<?php if(empty($rows['UserAddress'])){ echo "Select Customer Pickup Address"; } else { echo "Change Customer Pickup Address" ; }?>">
            			       </div>
            			       
            			       <div class="col-md-8 col-sm-12 col-xs-12 col-md-offset-2">
            			        <div class="panel panel-default">
          	
			    <div class="panel-heading" role="tab" id="headingTwo" style="background-color: #0042A4; color:white;">
				    <h4 class="panel-title">
				    	
					    <a style="text-decoration:none;cursor: pointer" class="collapsed paneltext" data-toggle="collapse" data-target="#collapseTwo"  aria-expanded="false" aria-controls="collapseTwo">
						   <?php
						 if(empty($rows["UserAddress"]))
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
                            	<input type="text" class="form-control text-capitalize hidden" id="getuid" value="<?php echo $userid; ?>"  name="getuid"  placeholder="" data-form-field="">
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
					              		$rs1=mysql_query("select * from tblusers_address where UserID='$userid'") or die(mysql_error());
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
                    	<label class="control-label col-md-4 col-sm-5 col-xs-5" for="ordcity"> Select City
                        </label>
                         <div class="col-md-6 col-sm-7 col-xs-7" >
                                             <select class="form-control" name="city"  style="cursor: pointer" required>
            						<option value=""  style="padding-bottom:7px">Select City</option>
            						
            						 <?php
            				      	$rs=mysql_query("select * from tbl_city");
									while($row=mysql_fetch_array($rs))
									{
										?>
									<option value="<?php echo $row["CityName"]; ?>" <?php if($row['CityName']==$rows['UserCity']) echo 'selected';?> style="padding:10px"> <?php echo $row["CityName"]; ?> </option>
									<?php	
									}  
            				      	?>
            					</select>
                          </div>
                    </div>
                    &nbsp;
                    <div class="item form-group">
                    	<label class="control-label col-md-4 col-sm-5 col-xs-5" for="reference"> How User know about us?
                        </label>
                        <div class="col-md-6 col-sm-7 col-xs-7" >
                         <select class="form-control" name="reference" id="reference"  style="cursor: pointer" required onchange="showreftxt(this.value)">
							<option value=""  style="padding-bottom:7px">Select</option>
							
							 <?php
            					$res1=mysql_query("select * from tbl_reference") or die(mysql_error());
								while($row1=mysql_fetch_array($res1))
								{
								?>
								<option value="<?php echo $row1['RefId'];?>" <?php if($row1['RefId']==$rows['UserReference']) echo 'selected';?>  style="padding:10px"><?php echo $row1['RefText'];?></option>
								<?php	
								}
            					?>
						
							
						</select>
                        </div>
                    </div>
                    &nbsp;
                    
                    <div class="item form-group" id="reftxtdiv" hidden>
                    	<label class="control-label col-md-4 col-sm-5 col-xs-5" for="reftxt"> Other Reference
                        </label>
                        <div class="col-md-6 col-sm-7 col-xs-7" >
                         <input type="text" class="form-control" name="reftxt" id="reftxt" value="<?php echo $rows['UserReferenceRemarks'];?>">
							
						
                        </div>
                    </div>
                    &nbsp;
                    
                    <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-4 col-sm-offset-4">
                            
                            <input type="submit" name="btnsave" class="btn btn-success" id="btnsubmit" value="Save & Continue"/>&nbsp;
                        </div>
                    </div>
				</form>
		<?php	
				}
			
			}
			
			else {
				?>


				<form method="post" role="form" class="form-horizontal" name="" enctype="multipart/form-data" id="">
					<div class="col-md-8 col-sm-12 col-xs-12 text-center col-md-offset-2">
            		<span id="message" style="color:red;"> </span>
            			</div>
           		 
           		      &nbsp;
					<div class="item form-group">
                       <div id="usemail">
                        <label class="control-label col-md-4 col-sm-5 col-xs-5" for="itname">Customer Email
                        </label>
                        <div class="col-md-6 col-sm-7 col-xs-7">
                  		<input type="email" class="form-control col-md-7 col-xs-12" id="email" name="email"   placeholder="Enter Customer Email Id" data-form-field="Email">
            
                        </div>
                        </div>
                    </div>
                    &nbsp;
                    <div class="item form-group">
                       <div class="phonegroup1" id="usmobile">
                        <label class="control-label col-md-4 col-sm-5 col-xs-5" for="itname">Mobile
                        </label>
                        <div class="col-md-6 col-sm-7 col-xs-7">
                 
                     	<input type="tel" class="form-control col-md-7 col-xs-12 phone" name="phone1" required="" pattern="[0-9]{10}" title="Enter your mobile number"  data-inputmask="'mask' : '9999999999'" placeholder="Enter Customer Mobile no" data-form-field="Phone">
                       
                        </div>
                        </div>
                    </div>
                    &nbsp;
                    <div class="item form-group">
                      <div class="phonegroup2" id="usmobile2">
                        <label class="control-label col-md-4 col-sm-5 col-xs-5" for="itname">Alternate Mobile
                        </label>
                        <div class="col-md-6 col-sm-7 col-xs-7">
                 
                     <input type="tel" class="form-control col-md-7 col-xs-12 phone2" name="phone2" pattern="[0-9]{10}" title="Enter your mobile number"  data-inputmask="'mask' : '9999999999'" placeholder="Enter Customer another Mobile no" data-form-field="Phone">
                       
                        </div>
                    </div>
                   </div>
                    &nbsp;
                    <div class="item form-group">
                    	<label class="control-label col-md-4 col-sm-5 col-xs-5" for="firstname">Customer First Name
			            </label>
			            <div class="col-md-6 col-sm-7 col-xs-7">
			      
			    		<input type="text" class="form-control col-md-7 col-xs-12"   name="fname" id="ufname" onblur="return usname(document.ordern.name)" required="" placeholder="Enter Customer First Name" data-form-field="Name">
						<span id="nameerr" style="color: Red; display: none">Characters only </span>    
			            </div>
                    </div>
                    &nbsp;
                    <div class="item form-group">
                    	 <label class="control-label col-md-4 col-sm-5 col-xs-5" for="lastname">Customer Last Name
                        </label>
                        <div class="col-md-6 col-sm-7 col-xs-7">
                  
                		<input type="text" class="form-control col-md-7 col-xs-12"  name="lname" id="ulname" required="" placeholder="Enter Customer Last Name" data-form-field="Name">
            
                        </div>
                    </div>
                    &nbsp;
                    <div class="item form-group">
                    	
                    	<label for="Image" class="control-label col-md-4 col-sm-5 col-xs-5">Pickup Address</label>
            				
            				<div class="col-md-6 col-sm-7 col-xs-7">
            			  
            			  <input type="text" class="form-control"  id="pickadd" name="address" required="" placeholder="Enter Customer Pickup Address" data-form-field="address">
            			       </div>
            			       
            			       <div class="col-md-8 col-sm-12 col-xs-12 col-md-offset-2">
            			        <div class="panel panel-default" id="unloginpickup" style="display:none">
          	
			    <div class="panel-heading" role="tab" id="headingTwo" style="background-color: #0042A4; color:white;">
				    <h4 class="panel-title">
					    <a style="text-decoration:none;cursor: pointer" class="collapsed paneltext" data-toggle="collapse" data-target="#collapseTwo"  aria-expanded="false" aria-controls="collapseTwo">
						   Change Your Pickup Address
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
                            	<input type="text" class="form-control text-capitalize hidden" id="getuid"  name="getuid"  placeholder="" data-form-field="">
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
                    	<label class="control-label col-md-4 col-sm-5 col-xs-5" for="ordcity"> Select City
                        </label>
                        <div class="col-md-6 col-sm-7 col-xs-7" >
                         <select class="form-control" name="city" id="city1"  style="cursor: pointer" required>
							<option value=""  style="padding-bottom:7px">Select City</option>
							
							 <?php
					      	$rs=mysql_query("select * from tbl_city");
							while($row=mysql_fetch_array($rs))
							{
								?>
							<option value="<?php echo $row["CityName"]; ?>" style="padding:10px"> <?php echo $row["CityName"]; ?> </option>
							<?php	
							}  
					      	?>
						</select>
                        </div>
                    </div>
                    &nbsp;
                     <div class="item form-group">
                    	<label class="control-label col-md-4 col-sm-5 col-xs-5" for="reference"> How User know about us?
                        </label>
                        <div class="col-md-6 col-sm-7 col-xs-7" >
                         <select class="form-control" name="reference" id="reference"  style="cursor: pointer" required onchange="showreftxt(this.value)">
							<option value=""  style="padding-bottom:7px">Select</option>
							
							 <?php
            					$res1=mysql_query("select * from tbl_reference") or die(mysql_error());
								while($row1=mysql_fetch_array($res1))
								{
								?>
								<option value="<?php echo $row1['RefId'];?>" style="padding:10px"><?php echo $row1['RefText'];?></option>
								<?php	
								}
            					?>
						
							
						</select>
                        </div>
                    </div>
                    &nbsp;
                    
                     <div class="item form-group" id="reftxtdiv" hidden>
                    	<label class="control-label col-md-4 col-sm-5 col-xs-5" for="reftxt"> Other Reference
                        </label>
                        <div class="col-md-6 col-sm-7 col-xs-7" >
                         <input type="text" class="form-control" name="reftxt" id="reftxt" value="">
							
						
                        </div>
                    </div>
                    &nbsp;
                    
                    
                    <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-4 col-sm-offset-4">
                            
                            <input type="submit" name="btnsave" class="btn btn-success" id="btnsubmit" value="Save & Continue"/>&nbsp;
                        </div>
                    </div>
				</form>
				<?php }?>
			</div>
		</div>
	</div>
</div>
<?php
include 'footer.php';

?>