<?php
include 'header.php';
if(isset($_GET['soid']))
{
	$soid=$_GET['soid'];
	$oid=$_GET['oid'];
	$uid=$_GET['uid'];
	
?>
<?php

if(isset($_POST['btnContinue']))
{
	$delivery_add=trim($_POST["address"]);
	$delivery_type=$_POST["dtype"];
	$delivery_status=$_POST["dstatus"];
	
	$deliverydate=trim($_POST["deliverydate"]);
	//$date = DateTime::createFromFormat('m/d/Y', $ddate);
	//$deliverydate=$date->format('Y-m-d');
	
	$remarks=trim($_POST["review"]);
	
	
	$res4=mysql_query("update tbl_suborders set DeliveryTypeId='$delivery_type',DeliveryStatusId='$delivery_status',DeliveryDate='$deliverydate',DeliveryAddress='$delivery_add',Remarks='$remarks' where SubOrderId='$soid'");
	if($res4)
	{
		header('location:suborder_dashboard.php?oid='.$oid.'&uid='.$uid);
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
$(document).on("click","#savenewremarks",function()
                         		{
                         		
                         			//alert("ok");
                         			var getuid=$("#getuserid").val();
                         			var getoid=$("#getorderid").val();
                         			var getsoid=$("#getsuborderid").val();
                         			var remarks=$("#newremarks").val();
                         			
                         			var strurl="http://www.laundrybucket.co.in/lb-admin/apisave_newremarks_suborder.php?uid="+getuid+"&remarks="+remarks+"&oid="+getoid+"&soid="+getsoid;
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

   			 	var someFormattedDate = y + '-' + mm + '-' + dd;
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

<div class="right_col" role="main">
	<div class="row">
		<div class="container">
			<div class="col-md-12 col-sm-12 col-xs-12">
				
				<div class="col-md-12 col-sm-12 col-xs-12" style="text-align: center;">
					<?php
					
					$r=mysql_query("select * from tblusers where UserId='$uid'") or die(mysql_error());
					if(mysql_affected_rows())
					{
						$urow=mysql_fetch_array($r);
						
					 echo "<h2>".$urow['UserFirstName']." ".$urow['UserLastName']."'s Check/Edit Status of Existing Sub Order</h2>";
					}
					 ?>
				</div>
				
			</div>
			&nbsp;
			<div class="col-md-12 col-sm-12 col-xs-12">
<?php

	$res=mysql_query("select * from tbl_suborders where SubOrderId='$soid'") or die(mysql_error());
if(mysql_affected_rows())
{
	$rows=mysql_fetch_array($res);
	$ordertypeid=$rows['OrderTypeId'];
	$deliverytypeid=$rows['DeliveryTypeId'];

?>
				<form method="post" role="form" class="form-horizontal" name="" enctype="multipart/form-data" id="">
	        
	        		<div class="item form-group">
		        		<label class="control-label col-md-4 col-sm-5 col-xs-5" for="ordertype">Order Type
	                    </label>
	                    <div class="col-md-6 col-sm-7 col-xs-7">
	          			 <?php
	          			 $r1=mysql_query("select * from tbl_services where ServiceId='$ordertypeid'") or die(mysql_error());
						 $rw1=mysql_fetch_array($r1);
	          			 ?>         			
	           			<input type="text" class="form-control col-md-7 col-xs-12" name="ordertype" required="" readonly="readonly" placeholder="" value="<?php echo $rw1['ServiceName'];?>">      
	                    </div>
	                </div>
	                &nbsp;
	                 <div class="item form-group">
	                	<label for="deliverytype" class="control-label col-md-4 col-sm-5 col-xs-5">Select Delivery Type</label>
       		
	                    <div class="col-md-6 col-sm-7 col-xs-7">
	          			         			
	           			<select name="dtype" class="form-control deliverytype"  onchange="chkdeliverytype(this.value)" style="cursor: pointer" required>
            						<option value="-1"  style="padding-bottom:7px">Select Delivery Type</option>
            						
            						  <?php
            				      	$rs=mysql_query("select * from tbl_deliverytypes");
									while($row=mysql_fetch_array($rs))
									{
										?>
									<option value="<?php echo $row["DeliveryId"]; ?>" <?php if($rows['DeliveryTypeId']==$row["DeliveryId"]) echo selected;?> style="padding:10px"> <?php echo $row["DeliveryTitle"]; ?> </option>
									<?php	
									}  
            				      	?>
										
									</select>      
	                    </div>
	                </div>
	                &nbsp;
	                <div class="item form-group">
	                	<label class="control-label col-md-4 col-sm-5 col-xs-5" for="dob">Delivery Date
                                    </label>
                                    <div class="col-md-6 col-sm-7 col-xs-7">
                        	<?php
                        	 $r3=mysql_query("select * from tbl_orders where OrderId='$oid'") or die(mysql_error());
						 $rw3=mysql_fetch_array($r3);
                        	?>
                          <input type="hidden" id="datepicker" class="form-control date-picker col-md-7 col-xs-12" name="pickdate" required="" placeholder="Select Pickup Date" value="<?php echo $rw3['Order_PickDate'];?>">
                                   <input type="text" id="datepicker2" class="form-control date-picker col-md-7 col-xs-12"  name="deliverydate"  placeholder="Select Delivery Date" value="<?php echo $rows['DeliveryDate'];?>">
                                         
                        			</div>
	                </div>
	                <div class="item form-group" >
	                <span class="col-md-4 col-sm-5 col-xs-5"> </span>
	            	<span class="col-md-6 col-sm-7 col-xs-7"  style="color:red" id="dfast"> </span>
	            	</div>
	                &nbsp;
	               
                   <div class="item form-group">
                    	
                    	<label for="Image" class="control-label col-md-4 col-sm-5 col-xs-5">Delivery Address</label>
            				
            				<div class="col-md-6 col-sm-7 col-xs-7">
            			  
            			  <input type="text" class="form-control" readonly="" id="pickadd" name="address" required="" placeholder="Enter Customer Delivery Address" data-form-field="address" value="<?php echo $rows["DeliveryAddress"]; ?>" placeholder="<?php if(empty($rows['DeliveryAddress'])){ echo "Select Customer Delivery Address"; } else { echo "Change Customer Delivery Address" ; }?>">
            			       </div>
            			       
            			       <div class="col-md-8 col-sm-12 col-xs-12 col-md-offset-2">
            			        <div class="panel panel-default">
          	
			    <div class="panel-heading" role="tab" id="headingTwo" style="background-color: #0042A4; color:white;">
				    <h4 class="panel-title">
				    	
					    <a style="text-decoration:none;cursor: pointer" class="collapsed paneltext" data-toggle="collapse" data-target="#collapseTwo"  aria-expanded="false" aria-controls="collapseTwo">
						   <?php
						 if(empty($rows["DeliveryAddress"]))
						 {
						 echo "Select Your Delivery Address";	
						 }
						 else {
							 echo "Change Your Delivery Address";
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
                    <label class="control-label col-md-4 col-sm-5 col-xs-5" for="dstatus">Delivery Status <span class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-7 col-xs-7">
                     <select class="form-control" required name="dstatus" id="dstatus">
						 <option value=""  style="padding-bottom:7px">Select Delivery Status</option>
						
						<?php
			
				 $res2=mysql_query("SELECT * from tbl_orderstatus_id");			
					if(mysql_affected_rows())
				{
					while($rows2=mysql_fetch_array($res2))
			
				{
					?>
					<option  value="<?php echo $rows2["order_status_id"]; ?>" <?php if($rows['DeliveryStatusId']==$rows2['order_status_id']) echo selected;?>  style="margin-bottom:7px"><?php echo $rows2["order_status_text"]; ?></option>
					
					<?php
					}
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
                         
                         <div class="col-md-8 col-sm-12 col-xs-12 col-md-offset-2">
            			        <div class="panel panel-default">
          	
			    <div class="panel-heading" role="tab" id="headingThree" style="background-color: #0042A4; color:white;">
				    <h4 class="panel-title">
				    	
					    <a style="text-decoration:none;cursor: pointer" class="collapsed paneltext" data-toggle="collapse" data-target="#collapseThree"  aria-expanded="false" aria-controls="collapseThree">
						   <?php
						 if(empty($rows["Remarks"]))
						 {
						 echo "Select Your Remarks";	
						 }
						 else {
							 echo "Change Your Remarks";
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
				          <input type="text" class="form-control text-capitalize hidden" id="getsuborderid" value="<?php echo $soid; ?>"  name="getorderid"  placeholder="" data-form-field="">
            			  <input type="text" class="form-control text-capitalize hidden" id="getorderid" value="<?php echo $oid; ?>"  name="getorderid"  placeholder="" data-form-field="">
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
					              	<?php
					              		$i=1;
					              		$rs1=mysql_query("select * from tbl_subordersremarks where UserId='$uid' and OrderId='$oid' and SubOrderId='$soid'") or die(mysql_error());
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
                   &nbsp;
                
                    <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-4 col-sm-offset-4">
                            
                            <input type="submit" name="btnContinue" class="btn btn-success" id="btnsubmit" value="Update"/>&nbsp;
                        </div>
                    </div>
				</form>
		<?php	
				}
			
			
			
			?>
			</div>
		</div>
	</div>
</div>
<?php
}
?>
<?php
include 'footer.php';

?>