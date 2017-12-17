<?php
include 'header.php';

?>
<script>
      $(document).ready(function () {

        $('#btnsubmit').on('click', function (e) {

          e.preventDefault();
			
          $.ajax({
            type: 'POST',
            url: 'http://www.laundrybucket.co.in/lb-admin/api_createorder.php',
            data: $('#orderform').serialize(),
            success:function (data) {
            	$.each(data,function(i,field){
            	$("#sorderid").val(field.orderid);
            	$("#orderidhide").val(field.orderid);
            	$("#orderidhide").trigger('change');
            	$("#ssuborderid").val(field.suborderid);
            	$("#ssuborderid").trigger('change');
            	$("#suserid").val(field.userid);
            	$("#sserviceid").val(field.serviceid);
            	var status=field.status;
            	if(status==1)
            	{
              $("#additemform").show();
              $("#suborderdiv").show();
             }
             });
            }
          });

        });


		$('#btnadd').on('click', function (e) {

   		
          $.ajax({
            type: 'POST',
            url: 'http://www.laundrybucket.co.in/lb-admin/api_additem.php',
            data: $('#additemform').serialize(),
            success:function (data) {
            	$.each(data,function(i,field){
            		var status=field.status;
            		$("#ssuborderid").val(field.suborderid);
            	    $("#ssuborderid").trigger('change');
            		
            		if(status==1)
            		{
            			$("#itemname").val("");
            			$("#itemrate").val("");
            			$("#itemprice").val("");
            			$("#qty").val("");
            			$("#tprice").val("");
            			$(".servicecat").val("");
            		}
            		 //$("#additemform")[0].reset();
            	});
            	
            }
          });
e.preventDefault();

        });
        
        $('#btndone').on('click', function (e) {
        	e.preventDefault();
        	
			
			$.ajax({
            type: 'POST',
            url: 'http://www.laundrybucket.co.in/lb-admin/api_updateorder.php',
            data: $('#additemform').serialize(),
            success:function (data) {
            	$.each(data,function(i,field){
            		var status=field.status;
            		$("#orderidhide").val(field.orderid);
            	    $("#orderidhide").trigger('change');
            		
            		if(status==1)
            		{
            			$("#additemform")[0].reset();
        				$("#additemform").hide();
        				$("#my_select").val("-1");
        				$("#deliverydiv").hide(100);
						$("#datepicker2").val("");
						$("#dfast").html("");
						$(".deliverytype").val("-1");
						$("#suborderdiv").hide();
            		}
            		 //$("#additemform")[0].reset();
            	});
            	
            }
          });
        });

      });
    </script>
   
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
		var url="http://www.laundrybucket.co.in/lb-admin/fetch_existuser.php?uemail="+email+"&uphone="+phone;
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
                         			
                         			var strurl="http://www.laundrybucket.co.in/lb-admin/apisave_newaddress.php?uid="+getuid+"&address="+address;
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
          </script>
          
<script type="text/javascript">
function chkdeliverytype(dtype) {
	document.getElementById('dfast').innerHTML="";
	var url="http://www.laundrybucket.co.in/lb-admin/fetch_deliverydays.php?did="+dtype;
		$.ajax({
			url:url,
			type:"GET",
			success:function(data)	
			{
				$.each(data,function(i,field){
					var status=field.status;
					if(status==1)
					{
						var deliverydays=field.deliverydays;
						document.getElementById('dfast').innerHTML = 'We deliver with in '+deliverydays+' days';
						var pickdate=document.getElementById('datepicker').value;
		 				var date = new Date(pickdate);
   			 			var newdate = new Date(date);
						
   						 newdate.setDate(newdate.getDate() + Number(deliverydays));
    				
    			var dd = addZero(newdate.getDate());
    			var mm = addZero(newdate.getMonth() + 1);
    			var y = addZero(newdate.getFullYear());

			function addZero(x) {
     		if (x < 10) {
         		x = "0" + x;
    		 }
    		 return x;
 				}

   			 	var someFormattedDate = mm + '/' + dd + '/' + y;
    			document.getElementById('datepicker2').value = someFormattedDate;
    	
					}
					else if(status==0)
					{
						document.getElementById('dfast').innerHTML ="Select a delivery type first";
						document.getElementById('datepicker2').value="";
					}
				});
			}
		})
	

}

</script>

<script>
	function showdelivery(otype)
	{
		if(otype!=-1)
		{
			$("#deliverydiv").show(100);
		}
		else
		{
			$("#deliverydiv").hide(100);
			$("#datepicker2").val("");
			$("#dfast").html("");
			$(".deliverytype").val("-1");
		}
	}
</script>
<script>
	$(document).on("blur","#qty",function(){
		var qty=$(this).val();
		var iprice=$("#itemprice").val();
		var totalprice=qty*iprice;
		$("#tprice").val(totalprice);
	});
	
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
                                    <h2><i class="fa fa-bars"></i> Create New Order </h2>
                                    <ul class="nav navbar-right panel_toolbox">
                                    	
                                    	 <li>
                                        	<button onclick="window.location.href=''" value="Reset Form!" class="btn btn-danger">Reset Order Form</button>
                                        	</li>
                                    	
                                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                        </li>
                                       
                                        <li><a class="close-link"><i class="fa fa-close"></i></a>
                                        </li>
                                        
                                       
                                    </ul>
                                    <div class="clearfix"></div>
                                 
                                </div>
                                <script>
function getorderdetail()
{
 var orderid1=document.getElementById('orderidhide').value;
 var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("orderdetail").innerHTML =this.responseText;
      
    }
  };
  xhttp.open("GET", "fetchorder_detail.php?oid="+orderid1, true);
  xhttp.send();
}
</script>

	
               <div class="x_content">
               	
<?php
if(isset($_GET["userid"]))
{
	$userid=$_GET["userid"];
	$res=mysql_query("select * from tblusers where UserId='$userid'") or die(mysql_error());
if(mysql_affected_rows())
{
	$rows=mysql_fetch_array($res);

?>

                 <form method="post" role="form" class="form-horizontal" name="ordern" enctype="multipart/form-data" id="orderform">
                 	<!--<div class="col-md-6 col-sm-6 col-xs-12">
                 		<input type="submit" value="Create New Order" class="btn btn-default" name="neworder">
                 	</div>-->
                 	<?php 
                 	
						$res1=mysql_query("insert into tbl_orders(addon) values(now())");
						if(mysql_affected_rows())
						{
							$oid=mysql_insert_id();
						
                 	?>
                 	<div class="item form-group" id="orderid">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="orderid">Order Id
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                     
                                         <input type="text" class="form-control col-md-5 col-xs-12" readonly=""  name="orderid" value="<?php echo $oid; ?>"  data-form-field="orderid">
                                       <input type="hidden" id="orderidhide" onchange="getorderdetail();" onkeyup="this.onchange();" onpaste="this.onchange();" oninput="this.onchange();" >
                                            </div>
                      </div>
                      &nbsp;
                      
                      <div class="col-md-12 col-sm-12 col-xs-12" id="orderdiv">
		<div class="col-md-3 col-sm-3 col-xs-12 col-md-offset-2 col-sm-offset-2">
			<h3>Add Order Type</h3>
		</div>
		<div class="col-md-5 col-sm-5 col-xs-12" id="orderdetail">
			
		</div>
	
	</div>
	&nbsp;
                      	<div class="col-md-12 col-sm-12 col-xs-12 text-center">
                                    		<span id="message" style="color:red;"> </span>
                                    			</div>
                                   		 
                                   		      &nbsp;
                      <div class="item form-group">
                       <div id="usemail">
                                            <label class="control-label col-md-2 col-sm-2 col-xs-5" for="itname">Customer Email
                                            </label>
                                            <div class="col-md-4 col-sm-4 col-xs-7">
                                      <input type="email" class="form-control col-md-7 col-xs-12" id="email" readonly="" name="email" value="<?php echo $rows['UserEmail']; ?>"   placeholder="Enter Customer Email Id" data-form-field="Email">
                                
                                            </div>
                                        </div>
                      
                             <?php
                            if(empty($rows["UserPhone"]))
							{
								?>
                      <div class="phonegroup1" id="usmobile">
                                            <label class="control-label col-md-2 col-sm-2 col-xs-5" for="itname">Mobile
                                            </label>
                                            <div class="col-md-4 col-sm-4 col-xs-7">
                                     
                                         <input type="tel" class="form-control col-md-7 col-xs-12 phone" name="phone1" required="" pattern="[0-9]{10}" title="Enter your mobile number"  data-inputmask="'mask' : '9999999999'" placeholder="Enter Customer Mobile no" data-form-field="Phone" value="<?php echo $rows['UserPhone2']; ?>">
                                           
                                            </div>
                     </div>
                     <?php
							} 
							else {
								
							
                     ?>
                   <div class="phonegroup1" id="usmobile">
                                            <label class="control-label col-md-2 col-sm-2 col-xs-5" for="itname">Mobile
                                            </label>
                                            <div class="col-md-4 col-sm-4 col-xs-7">
                                     
                                         <input type="tel" class="form-control col-md-7 col-xs-12 phone" name="phone1" readonly="" required="" pattern="[0-9]{10}" title="Enter your mobile number"  data-inputmask="'mask' : '9999999999'" placeholder="Enter Customer Mobile no" data-form-field="Phone" value="<?php echo $rows["UserPhone"]; ?>">
                                           
                                            </div>
                    </div>
                    <?php  } ?>
                    </div>
                    &nbsp;
                    <div class="item form-group">
                      <div class="phonegroup2" id="usmobile2">
                                            <label class="control-label col-md-2 col-sm-2 col-xs-5" for="itname">Alternate Mobile
                                            </label>
                                            <div class="col-md-4 col-sm-4 col-xs-7">
                                     
                                         <input type="tel" class="form-control col-md-7 col-xs-12 phone2" name="phone2" pattern="[0-9]{10}" title="Enter your mobile number"  data-inputmask="'mask' : '9999999999'" placeholder="Enter Customer another Mobile no" data-form-field="Phone" value="<?php echo $rows['UserPhone2']; ?>">
                                           
                                            </div>
                                        </div>
            
                      
                      
                                            <label class="control-label col-md-2 col-sm-2 col-xs-5" for="firstname">Customer First Name
                                            </label>
                                            <div class="col-md-4 col-sm-4 col-xs-7">
                                      
                                    <input type="text" class="form-control col-md-7 col-xs-12"   name="fname" id="ufname" onblur="return usname(document.ordern.name)" required="" placeholder="Enter Customer First Name" data-form-field="Name" value="<?php echo $rows["UserFirstName"]; ?>">
                            <span id="nameerr" style="color: Red; display: none">Characters only </span>    
                                            </div>
                                           </div>
                                           &nbsp;
                         <div class="item form-group">
                                      
                                            <label class="control-label col-md-2 col-sm-2 col-xs-5" for="lastname">Customer Last Name
                                            </label>
                                            <div class="col-md-4 col-sm-4 col-xs-7">
                                      
                                    <input type="text" class="form-control col-md-7 col-xs-12"  name="lname" id="ulname" required="" placeholder="Enter Customer Last Name" data-form-field="Name" value="<?php echo $rows["UserLastName"]; ?>">
                                
                                            </div>
                                       
            				<label for="Image" class="control-label col-md-2 col-sm-2 col-xs-5">Pickup Address</label>
            				
            				<div class="col-md-4 col-sm-4 col-xs-7">
            			  
            			  <input type="text" class="form-control" readonly="" id="pickadd" name="address" required="" placeholder="Enter Customer Pickup Address" data-form-field="address" value="<?php echo $rows["UserAddress"]; ?>" placeholder="<?php if(empty($rows['UserAddress'])){ echo "Select Customer Pickup Address"; } else { echo "Change Customer Pickup Address" ; }?>">
            			       </div>
            			       
            			       <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-6 col-sm-offset-6">
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
                        <div class="item form-group" >
                                            <label class="control-label col-md-2 col-sm-2 col-xs-5" for="ordcity"> Select City
                                            </label>
                                            <div class="col-md-4 col-sm-4 col-xs-7" >
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
                                        
                                            <label class="control-label col-md-2 col-sm-2 col-xs-5" for="dob">Pickup Date
                                            </label>
                                            <div class="col-md-4 col-sm-4 col-xs-7">
                                  
                                   <input type="text" id="datepicker" class="form-control date-picker col-md-7 col-xs-12" name="pickdate" required="" placeholder="Select Pickup Date">      
                                            </div>
                                           </div>
                                           &nbsp;
                             <div class="item form-group" >            
            				<label for="Image" class="control-label col-md-2 col-sm-2 col-xs-5">Pickup Time</label>
            				
            				<div class="col-md-4 col-sm-4 col-xs-7">
            				
            		<!--	<input id="timepicker2" type="text" class="input-small form-control" required="" name="picktime" placeholder="Enter Pickup Time: eg-4:00AM">-->
            		<select name="picktime" class="form-control" style="padding: 0px" required="">
            									<option value="">Select Pickup Time</option>
            									<option value="08-09-AM" style="padding:10px">08-09 AM</option>
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
												<option value="08-09-PM" style="padding:10px">08-09 PM</option>
                   					</select>	
            				</div>  
            				
            			
            		
                                            <label class="control-label col-md-2 col-sm-2 col-xs-5" for="ordstatus">Order Status <span class="required">*</span>
                                            </label>
                                            <div class="col-md-4 col-sm-4 col-xs-7">
                                             <select class="form-control" required name="orstatus" id="orstatus">
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
            			<div class="item form-group">
                                            <label class="control-label col-md-2 col-sm-2 col-xs-5" for="itname">Remarks
                                            </label>
                                            <div class="col-md-4 col-sm-4 col-xs-7">
                                      
                                    <input type="text" class="form-control col-md-7 col-xs-12"  name="review" placeholder="Remarks" style="height: 95px">
                                 
                                            </div>
                                        
                                            <label class="control-label col-md-2 col-sm-2 col-xs-5" for="ordstatus"> Select Order Type
                                            </label>
                                            <div class="col-md-4 col-sm-4 col-xs-7" >
                                             <select class="form-control"  id="my_select" name="ordercat"   style="cursor: pointer" required onchange="showdelivery(this.value)">
            						<option value="-1"  style="padding-bottom:7px">Select Order Type</option>
            						<?php
            				      	$rs1=mysql_query("select * from tbl_services");
									while($row1=mysql_fetch_array($rs1))
									{
										?>
									<option value="<?php echo $row1["ServiceId"]; ?>" style="padding:10px"> <?php echo $row1["ServiceName"]; ?> </option>
									<?php	
									}  
            				      	?>
            						  						
										
										</select>
                                            </div>
                                        </div>
                &nbsp;
                <div id="deliverydiv" style="display:none;">
            	<div class="item form-group" >
                                            <label class="control-label col-md-2 col-sm-2 col-xs-5" for="ordstatus"> Select Delivery Type
                                            </label>
                                            <div class="col-md-4 col-sm-4 col-xs-7" >
                                             <select name="dtype" class="form-control deliverytype"  onchange="chkdeliverytype(this.value)" style="cursor: pointer" required>
            						<option value="-1"  style="padding-bottom:7px">Select Delivery Type</option>
            						
            						  <?php
            				      	$rs=mysql_query("select * from tbl_deliverytypes");
									while($row=mysql_fetch_array($rs))
									{
										?>
									<option value="<?php echo $row["DeliveryId"]; ?>" style="padding:10px"> <?php echo $row["DeliveryTitle"]; ?> </option>
									<?php	
									}  
            				      	?>
										
										</select>
                                    
                                            </div>
                                        
                                            <label class="control-label col-md-2 col-sm-2 col-xs-5" for="dob">Delivery Date
                                            </label>
                                            <div class="col-md-4 col-sm-4 col-xs-7">
                                  
                                   <input type="text" id="datepicker2" class="form-control date-picker col-md-7 col-xs-12"  name="deliverydate"  placeholder="Select Delivery Date">      
                                            </div>
                                        </div>
                                     <div class="item form-group" >
                                               	<span class="col-md-3 col-sm-3 col-xs-12"> </span>
                    	<span class="col-md-6 col-sm-6 col-xs-12"  style="color:red" id="dfast"> </span>
                    	</div>    
                                </div>
                                          &nbsp;
                       
            			
            	<div class="form-group">
                                            <div class="col-md-4 col-sm-4 col-xs-12 col-md-offset-3 col-sm-offset-3">
                                                
                                                <input type="submit" name="btnsave" class="btn btn-success" id="btnsubmit" value="Generate Order"/>&nbsp;
                                            </div>
                                            <div class="col-md-4 col-sm-4 col-xs-12">
                                                
                                                <input type="submit" name="btnalldone" class="btn btn-success" id="btnalldone" value="Done"/>&nbsp;
                                            </div>
                                        </div>
                      <?php
                      }
					}
                      ?>
                 	
				</form>
				&nbsp;
				
				<?php	
				}
			
			
			
			else {
				?>
				
				<form method="post" role="form" class="form-horizontal" name="ordern" enctype="multipart/form-data" id="orderform">
                 	<div class="col-md-6 col-sm-6 col-xs-12">
                 		<input type="submit" value="Create New Order" class="btn btn-default" name="neworder">
                 	</div>
                 	<?php 
                 	if(isset($_POST['neworder']))
					{
						$res1=mysql_query("insert into tbl_orders(addon) values(now())");
						if(mysql_affected_rows())
						{
							$oid=mysql_insert_id();
						
                 	?>
                 	<div class="item form-group" id="orderid">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="orderid">Order Id
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                     
                                         <input type="text" class="form-control col-md-5 col-xs-12" readonly=""  name="orderid" value="<?php echo $oid; ?>"  data-form-field="orderid">
                                       <input type="hidden" id="orderidhide" onchange="getorderdetail();" onkeyup="this.onchange();" onpaste="this.onchange();" oninput="this.onchange();" >
                                            </div>
                      </div>
                      &nbsp;
                      
                      <div class="col-md-12 col-sm-12 col-xs-12" id="orderdiv">
		<div class="col-md-3 col-sm-3 col-xs-12 col-md-offset-2 col-sm-offset-2">
			<h3>Add Order Type</h3>
		</div>
		<div class="col-md-5 col-sm-5 col-xs-12" id="orderdetail">
			
		</div>
	
	</div>
	&nbsp;
                      	<div class="col-md-12 col-sm-12 col-xs-12 text-center">
                                    		<span id="message" style="color:red;"> </span>
                                    			</div>
                                   		 
                                   		      &nbsp;
                      <div class="item form-group">
                       <div id="usemail">
                                            <label class="control-label col-md-2 col-sm-2 col-xs-5" for="itname">Customer Email
                                            </label>
                                            <div class="col-md-4 col-sm-4 col-xs-7">
                                      <input type="email" class="form-control col-md-7 col-xs-12" id="email" name="email"   placeholder="Enter Customer Email Id" data-form-field="Email">
                                
                                            </div>
                                        </div>
                      
                      <div class="phonegroup1" id="usmobile">
                                            <label class="control-label col-md-2 col-sm-2 col-xs-5" for="itname">Mobile
                                            </label>
                                            <div class="col-md-4 col-sm-4 col-xs-7">
                                     
                                         <input type="tel" class="form-control col-md-7 col-xs-12 phone" name="phone1" required="" pattern="[0-9]{10}" title="Enter your mobile number"  data-inputmask="'mask' : '9999999999'" placeholder="Enter Customer Mobile no" data-form-field="Phone">
                                           
                                            </div>
                                        </div>
                    </div>
                    &nbsp;
                    <div class="item form-group">
                      <div class="phonegroup2" id="usmobile2">
                                            <label class="control-label col-md-2 col-sm-2 col-xs-5" for="itname">Alternate Mobile
                                            </label>
                                            <div class="col-md-4 col-sm-4 col-xs-7">
                                     
                                         <input type="tel" class="form-control col-md-7 col-xs-12 phone2" name="phone2" pattern="[0-9]{10}" title="Enter your mobile number"  data-inputmask="'mask' : '9999999999'" placeholder="Enter Customer another Mobile no" data-form-field="Phone">
                                           
                                            </div>
                                        </div>
            
                      
                      
                                            <label class="control-label col-md-2 col-sm-2 col-xs-5" for="firstname">Customer First Name
                                            </label>
                                            <div class="col-md-4 col-sm-4 col-xs-7">
                                      
                                    <input type="text" class="form-control col-md-7 col-xs-12"   name="fname" id="ufname" onblur="return usname(document.ordern.name)" required="" placeholder="Enter Customer First Name" data-form-field="Name">
                            <span id="nameerr" style="color: Red; display: none">Characters only </span>    
                                            </div>
                                           </div>
                                           &nbsp;
                         <div class="item form-group">
                                      
                                            <label class="control-label col-md-2 col-sm-2 col-xs-5" for="lastname">Customer Last Name
                                            </label>
                                            <div class="col-md-4 col-sm-4 col-xs-7">
                                      
                                    <input type="text" class="form-control col-md-7 col-xs-12"  name="lname" id="ulname" required="" placeholder="Enter Customer Last Name" data-form-field="Name">
                                
                                            </div>
                                       
            				<label for="Image" class="control-label col-md-2 col-sm-2 col-xs-5">Pickup Address</label>
            				
            				<div class="col-md-4 col-sm-4 col-xs-7">
            			  
            			  <input type="text" class="form-control"  id="pickadd" name="address" required="" placeholder="Enter Customer Pickup Address" data-form-field="address">
            			       </div>
            			       
            			       <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-6 col-sm-offset-6">
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
                        <div class="item form-group" >
                                            <label class="control-label col-md-2 col-sm-2 col-xs-5" for="ordcity"> Select City
                                            </label>
                                            <div class="col-md-4 col-sm-4 col-xs-7" >
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
                                        
                                            <label class="control-label col-md-2 col-sm-2 col-xs-5" for="dob">Pickup Date
                                            </label>
                                            <div class="col-md-4 col-sm-4 col-xs-7">
                                  
                                   <input type="text" id="datepicker" class="form-control date-picker col-md-7 col-xs-12" name="pickdate" required="" placeholder="Select Pickup Date">      
                                            </div>
                                           </div>
                                           &nbsp;
                             <div class="item form-group" >            
            				<label for="Image" class="control-label col-md-2 col-sm-2 col-xs-5">Pickup Time</label>
            				
            				<div class="col-md-4 col-sm-4 col-xs-7">
            				
            		<!--	<input id="timepicker2" type="text" class="input-small form-control" required="" name="picktime" placeholder="Enter Pickup Time: eg-4:00AM">-->
            		<select name="picktime" class="form-control" style="padding: 0px" required="">
            									<option value="">Select Pickup Time</option>
            									<option value="08-09-AM" style="padding:10px">08-09 AM</option>
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
												<option value="08-09-PM" style="padding:10px">08-09 PM</option>
                   					</select>	
            				</div>  
            				
            			
            		
                                            <label class="control-label col-md-2 col-sm-2 col-xs-5" for="ordstatus">Order Status <span class="required">*</span>
                                            </label>
                                            <div class="col-md-4 col-sm-4 col-xs-7">
                                             <select class="form-control" required name="orstatus" id="orstatus">
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
            			<div class="item form-group">
                                            <label class="control-label col-md-2 col-sm-2 col-xs-5" for="itname">Remarks
                                            </label>
                                            <div class="col-md-4 col-sm-4 col-xs-7">
                                      
                                    <input type="text" class="form-control col-md-7 col-xs-12"  name="review" placeholder="Remarks" style="height: 95px">
                                 
                                            </div>
                                        
                                            <label class="control-label col-md-2 col-sm-2 col-xs-5" for="ordstatus"> Select Order Type
                                            </label>
                                            <div class="col-md-4 col-sm-4 col-xs-7" >
                                             <select class="form-control"  id="my_select" name="ordercat"   style="cursor: pointer" required onchange="showdelivery(this.value)">
            						<option value="-1"  style="padding-bottom:7px">Select Order Type</option>
            						<?php
            				      	$rs1=mysql_query("select * from tbl_services");
									while($row1=mysql_fetch_array($rs1))
									{
										?>
									<option value="<?php echo $row1["ServiceId"]; ?>" style="padding:10px"> <?php echo $row1["ServiceName"]; ?> </option>
									<?php	
									}  
            				      	?>
            						  						
										
										</select>
                                            </div>
                                        </div>
                &nbsp;
                <div id="deliverydiv" style="display:none;">
            	<div class="item form-group" >
                                            <label class="control-label col-md-2 col-sm-2 col-xs-5" for="ordstatus"> Select Delivery Type
                                            </label>
                                            <div class="col-md-4 col-sm-4 col-xs-7" >
                                             <select name="dtype" class="form-control deliverytype"  onchange="chkdeliverytype(this.value)" style="cursor: pointer" required>
            						<option value="-1"  style="padding-bottom:7px">Select Delivery Type</option>
            						
            						  <?php
            				      	$rs=mysql_query("select * from tbl_deliverytypes");
									while($row=mysql_fetch_array($rs))
									{
										?>
									<option value="<?php echo $row["DeliveryId"]; ?>" style="padding:10px"> <?php echo $row["DeliveryTitle"]; ?> </option>
									<?php	
									}  
            				      	?>
										
										</select>
                                    
                                            </div>
                                        
                                            <label class="control-label col-md-2 col-sm-2 col-xs-5" for="dob">Delivery Date
                                            </label>
                                            <div class="col-md-4 col-sm-4 col-xs-7">
                                  
                                   <input type="text" id="datepicker2" class="form-control date-picker col-md-7 col-xs-12"  name="deliverydate"  placeholder="Select Delivery Date">      
                                            </div>
                                        </div>
                                     <div class="item form-group" >
                                               	<span class="col-md-3 col-sm-3 col-xs-12"> </span>
                    	<span class="col-md-6 col-sm-6 col-xs-12"  style="color:red" id="dfast"> </span>
                    	</div>    
                                </div>
                                          &nbsp;
                       
            			
            	<div class="form-group">
                                            <div class="col-md-4 col-sm-4 col-xs-12 col-md-offset-3 col-sm-offset-3">
                                                
                                                <input type="submit" name="btnsave" class="btn btn-success" id="btnsubmit" value="Generate Order"/>&nbsp;
                                            </div>
                                            <div class="col-md-4 col-sm-4 col-xs-12">
                                                
                                                <input type="submit" name="btnalldone" class="btn btn-success" id="btnalldone" value="Done"/>&nbsp;
                                            </div>
                                        </div>
                      <?php
                      }
					}
                      ?>
                 	
				</form>
	<?php	
}

?>
   			
				
				<script>
function getitem(unitid) {
	var sid=document.getElementById("sserviceid").value;
	var scatid=document.getElementById("servicecat1").value;
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("itemname").innerHTML =this.responseText;
      
    }
  };
  xhttp.open("GET", "fetchitem.php?scat="+scatid+"&s="+sid+"&uid="+unitid, true);
  xhttp.send();
}
</script>
<script>
function getprice(irate) {
	var itemid=document.getElementById("itemname").value;
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("itemprice").value =this.responseText;
      
    }
  };
  xhttp.open("GET", "fetchitemprice.php?itmrate="+irate+"&iid="+itemid, true);
  xhttp.send();
}
</script>
<script>
function getitemname(itemid) {
	
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("itmname").value =this.responseText;
      
    }
  };
  xhttp.open("GET", "fetchitemname.php?itmid="+itemid, true);
  xhttp.send();
}
</script>
<script>
function getsuborderdetail()
{
 var suborderid1=document.getElementById('ssuborderid').value;
 var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("suborderdetail").innerHTML =this.responseText;
      
    }
  };
  xhttp.open("GET", "fetchsuborder_detail.php?soid="+suborderid1, true);
  xhttp.send();
}
</script>

	<div class="col-md-12 col-sm-12 col-xs-12" id="suborderdiv" hidden>
		<div class="col-md-3 col-sm-3 col-xs-12 col-md-offset-2 col-sm-offset-2">
			<h3>Add Items</h3>
		</div>
		<div class="col-md-5 col-sm-5 col-xs-12" id="suborderdetail">
			
		</div>
	
	</div>
	
				<form method="post" role="form" class="form-horizontal" name="additem" enctype="multipart/form-data" id="additemform" hidden>
					<input type="hidden" id="sorderid" name="sorderid">
					<input type="hidden" id="ssuborderid" name="ssuborderid" onchange="getsuborderdetail();" onkeyup="this.onchange();" onpaste="this.onchange();" oninput="this.onchange();">
					<input type="hidden" id="suserid" name="suserid" >
					<input type="hidden" id="sserviceid" name="sserviceid" >
					<div class="item form-group" >
                      <label class="control-label col-md-2 col-sm-2 col-xs-5" for="servicecat"> Select Service Category
                     </label>
					<div class="col-md-4 col-sm-4 col-xs-7" >
                                             <select name="servicecat" class="form-control servicecat" id="servicecat1"  style="cursor: pointer" required>
            						<option value=""  style="padding-bottom:7px">Select Service Category</option>
            						
            						  <?php
            				      	$rs=mysql_query("select * from tbl_services_category");
									while($row=mysql_fetch_array($rs))
									{
										?>
									<option value="<?php echo $row["ServiceCatId"]; ?>" style="padding:10px"> <?php echo $row["ServiceCatName"]; ?> </option>
									<?php	
									}  
            				      	?>
										
										</select>
                                    
                       </div>
                       
                       <label class="control-label col-md-2 col-sm-2 col-xs-5" for="priceunit"> Select Price Unit
                     </label>
					<div class="col-md-4 col-sm-4 col-xs-7" >
                                             <select name="priceunit" class="form-control priceunit"  onchange="getitem(this.value)" style="cursor: pointer" required>
            						<option value=""  style="padding-bottom:7px">Select Price Unit</option>
            						
            						  <?php
            				      	$rs=mysql_query("select * from tbl_priceunit");
									while($row=mysql_fetch_array($rs))
									{
										?>
									<option value="<?php echo $row["UnitId"]; ?>" style="padding:10px"> <?php echo $row["UnitName"]; ?> </option>
									<?php	
									}  
            				      	?>
										
										</select>
                                    
                       </div>
                      </div>
                      &nbsp;
                      <div class="item form-group" >
                       <label class="control-label col-md-2 col-sm-2 col-xs-5" for="itemname"> Select Item Name
                       </label>
                       <div class="col-md-4 col-sm-4 col-xs-7"  id="divitemname" >
                                             <select name="item" class="form-control" id="itemname"  onchange="getitemname(this.value)" style="cursor: pointer" required>
            						
										</select>
                                    <input type="hidden" id="itmname" name="itmname" >
                       </div>
                       
                       <label class="control-label col-md-2 col-sm-2 col-xs-5" for="itemrate"> Select Item Rate
                       </label>
                       <div class="col-md-4 col-sm-4 col-xs-7"  id="itemrate1" >
                                             <select name="itemrate" class="form-control" id="itemrate"  onchange="getprice(this.value)" style="cursor: pointer" required>
            						<option value=""  style="padding-bottom:7px">Select Item Rate</option>
            						<option value="StandardRate"  style="padding-bottom:7px">Standard Rate</option>
            						<option value="PremiumRate"  style="padding-bottom:7px">Premium Rate</option>
										</select>
                                    
                       </div>
                      </div>
                      &nbsp;
                      <div class="item form-group" >
                                            <label class="control-label col-md-2 col-sm-2 col-xs-5" for="itemprice">Item Price
                                            </label>
                                            <div class="col-md-4 col-sm-4 col-xs-7">
                                      
                                    <input type="text" class="form-control col-md-7 col-xs-12"  name="itemprice" id="itemprice" required="" data-form-field="itemprice" readonly="readonly">
                                
                                            </div>
                                      
                                            <label class="control-label col-md-2 col-sm-2 col-xs-5" for="qty">Item Quantity
                                            </label>
                                            <div class="col-md-4 col-sm-4 col-xs-7">
                                      
                                    <input type="number" class="form-control col-md-7 col-xs-12"  name="qty" id="qty" required="" data-form-field="qty" placeholder="Enter quantity to order">
                                
                                            </div>
                          </div>
                          &nbsp;
                          <div class="item form-group" >            
                                            <label class="control-label col-md-4 col-sm-4 col-xs-5" for="tprice">Total Price
                                            </label>
                                            <div class="col-md-7 col-sm-7 col-xs-7">
                                      
                                    <input type="text" class="form-control col-md-7 col-xs-12"  name="tprice" id="tprice" required="" data-form-field="tprice" readonly="readonly">
                                
                                            </div>
                                        </div>
                        &nbsp;
                        <div class="form-group">
                                            <div class="col-md-4 col-sm-4 col-xs-12 col-md-offset-3 col-sm-offset-3">
                                                
                                                <input type="submit" name="btnadd" class="btn btn-success" id="btnadd" value="Add Item"/>&nbsp;
                                            </div>
                                            <div class="col-md-4 col-sm-4 col-xs-12">
                                                
                                                <input type="submit" name="btndone" class="btn btn-success" id="btndone" value="Done"/>&nbsp;
                                            </div>
                                        </div>
				</form>
               </div>
    		</div>
     		</div>
     </div>
</div>
<?php
include 'footer.php';

?>