<?php
include 'header.php';

if(isset($_GET['oid']))
{
	
	
?>
<?php

$orderid=$_GET['oid'];
$res=mysql_query("select * from tbl_orders where OrderId='$orderid'") or die(mysql_error());
if(mysql_affected_rows())
{
	$row=mysql_fetch_array($res);
	if(isset($_GET['uid']))
	{
		$userid=$_GET['uid'];
	}
	else {
		$userid=$row['OrderUserId'];
	}
?>


<script>
      $(document).ready(function () {

        $('#btnAdd').on('click', function () {

        
			var x=$('#suborderform').serialize();
			console.log(x);
          $.ajax({
            type: 'POST',
            url: 'https://www.laundrybucket.co.in/lb-admin/api_createsubs_suborder.php',
            data: $('#suborderform').serialize(),
            success:function (data) {
            	$.each(data,function(i,field){
            	
            	var status=field.status;
            	if(status==1)
            	{
            		$("#orderidhide").val(field.orderid);
            	    $("#orderidhide").trigger('change');
            	    $("#suborderform")[0].reset();
            	    $("#dfast").html("");
              
             }
             });
            }
          });

        });


        
        $('#btndone').on('click', function (e) {
        	e.preventDefault();
        	var x=$('#additemform').serialize();
			//console.log(x);
			$.ajax({
            type: 'POST',
            url: 'https://www.laundrybucket.co.in/lb-admin/api_updateorder.php',
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
        				$(".deliverbydiv").hide(100);
						$("#datepicker2").val("");
						$("#dfast").html("");
						$(".deliverytype").val("-1");
						$("#suborderdiv").hide();
						$(".deliverystatus").val("-1");
            		}
            		 //$("#additemform")[0].reset();
            	});
            	
            }
          });
        });

$('#btnUpdate').on('click', function (e) {

          e.preventDefault();
			var frmdata=$('#suborderform1').serialize();
			//console.log(frmdata);
          $.ajax({
            type: 'POST',
            url: 'https://www.laundrybucket.co.in/lb-admin/api_update_subssuborder.php',
            data: frmdata,
            success:function (data) {
            	$.each(data,function(i,field){
            	
            	var status=field.status;
            	//alert(field.serviceid);
            	if(status==1)
            	{
             
              alert("Sub Order updated successfully");
              $("#orderidhide").val(field.orderid);
            	    $("#orderidhide").trigger('change');
            	  
             }
             });
            }
          });

        });


$(document).on("change","#my_select",function(e){
	
	 e.preventDefault();
	var subsid=$(this).val();
	var userid=$("#getuid").val();
		var url='https://www.laundrybucket.co.in/lb-admin/api_fetchused_subs_wt.php?subsid='+subsid+'&userid='+userid;
		console.log(url);
          $.ajax({
            type: 'GET',
            url: url,
            success:function (data) {
            	$.each(data,function(i,field){
            		
            	var status=field.status;
            	var availablewt=field.availableweight;
            	var usedwt=field.usedweight;
            	
          // alert(availablewt);
           //alert(status);
           
            	if(status==1)
            	{
            		$("#availablepickup").val(field.availablepickup);
					$("#extrapickupcost").val(field.extrapickupcost);
					$("#usedpickup").val(field.usedpickup);
             $("#usedwt").val(usedwt);
             $("#availablewt").val(availablewt);
             if(availablewt=='unlimited' || availablewt=='Unlimited')
             {
             	$("#remainwt").val('unlimited');
             }
             else
             {
             	var remainwt=Number(availablewt)-Number(usedwt);
             	$("#remainwt").val(remainwt);
             }
             }
             else
             {
             	$("#usedwt").val(0);
             $("#availablewt").val(0);
             $("#remainwt").val(0);
             $("#availablepickup").val(0);
					$("#extrapickupcost").val(0);
					$("#usedpickup").val(0);
             }
             });
            }
          });
});


$(document).on("keyup","#orderwt",function(){
	var apickup=$("#availablepickup").val();
	var extracost_per=$("#extrapickupcost").val();
	var usedpickup=$("#usedpickup").val();
	if((Number(usedpickup)+1)>apickup)
	{
		var extrapickups=(Number(usedpickup)+1)-Number(apickup);
		var extrapkcost=Number(extrapickups)*Number(extracost_per);
		$("#extrawpickcost").val(extrapkcost);
	}
	var orderwt=$(this).val();
	var orderwtold=$("#orderwtold").val();
	var remainwt=$("#remainwt").val();
	if(remainwt=='unlimited' || remainwt=='Unlimited')
	{
		remainwt=$("#remainwt").val();
	}
	else
	{
		remainwt=Number($("#remainwt").val())+Number(orderwtold);
		 		
	}
	
	var subsid=$("#my_select").val();
	var url='https://www.laundrybucket.co.in/lb-admin/api_fetchextra_wtcost.php?subsid='+subsid+'&orderwt='+orderwt+'&remainwt='+remainwt;
		console.log(url);
          $.ajax({
            type: 'GET',
            url: url,
            success:function (data) {
            	$.each(data,function(i,field){
            		
            	var status=field.status;
            	
            	if(status==1)
            	{
            $("#extrawtcost").val(field.extrawtcost);
            $("#extrawtcost").trigger('keyup');
            
             }
             else
             {
             	 $("#extrawtcost").val(0);
             	  $("#extrawtcost").trigger('keyup');
             }
             });
            }
          });
});


$(document).on("keyup","#extrawtcost",function(){
	var x=$(this).val();
	var y=$("#extrawpickcost").val();
	var total=Number(x)+Number(y);
	$("#totalcost").val(total);
});
										
});
    </script>
   <script>
   	$(document).on("change",".deliverystatus",function(){
   		var deliverstatus=$(this).val();
   		if(deliverstatus==4)
   		$(".deliverbydiv").show();
   		else
   		$(".deliverbydiv").hide();
   	});
   </script>
    <script>
   	$(document).ready(function(){
   		var deliverstatus=$(".deliverystatus").val();
   		if(deliverstatus==4)
   		$(".deliverbydiv").show();
   		else
   		$(".deliverbydiv").hide();
   	});
   </script>
<script type="text/javascript">
function chkdeliverytype(dtype) {
	document.getElementById('dfast').innerHTML="";
	var url="https://www.laundrybucket.co.in/lb-admin/fetch_deliverydays.php?did="+dtype;
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
                         			var getsoid=$("#getsuborderid").val();
                         			var remarks=$("#newremarks").val();
                         			
                         			var strurl="https://www.laundrybucket.co.in/lb-admin/apisave_newremarks_suborder.php?uid="+getuid+"&remarks="+remarks+"&oid="+getoid+"&soid="+getsoid;
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
<script>

</script>
<div class="right_col" role="main">
	<div class="row">
		<div class="container">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="col-md-12 col-sm-12 col-xs-12" style="text-align:center;">
				<?php
					
					$r=mysql_query("select * from tblusers where UserId='$userid'") or die(mysql_error());
					if(mysql_affected_rows())
					{
						$urow=mysql_fetch_array($r);
						
					 echo "<h2>".$urow['UserFirstName']." ".$urow['UserLastName']."'s Create Subscription Sub Order</h2>";
					}
					 ?>
				</div>
				
			</div>
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="col-md-10 col-sm-10 col-xs-12">
					<div class="col-md-12 col-sm-12 col-xs-12">
						<div class="row">
							<div class="col-md-6 col-sm-6 col-xs-12">
							<table class="table">
								<tr>
									<td>PickUp Date : </td>
									<td><?php echo $row['Order_PickDate'];?></td>
								</tr>
								<tr>
									<td>PickUp Time</td>
									<td><?php echo $row['Order_PickTime'];?></td>
								</tr>
								<tr>
									<td>PickUp Address</td>
									<td style="text-transform: capitalize;"><?php echo $row['PickupAddress'].", ".$row['OrderCity'];?></td>
								</tr>
							</table>
							</div>
							<div class="col-md-6 col-sm-6 col-xs-12" id="orderdetail">
			
							</div>
						</div>
						<hr>
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
						<div class="row">
							<?php
							if(isset($_GET['soid']))
							{
								$soid=$_GET['soid'];
								$res=mysql_query("select * from tbl_suborders where SubOrderId='$soid'") or die(mysql_error());
								if(mysql_affected_rows())
								{
									$rows=mysql_fetch_array($res);
									$ordertypeid=$rows['OrderTypeId'];
									$deliverytypeid=$rows['DeliveryTypeId'];
							?>
							<form method="post" role="form" class="form-horizontal" name="suborderform1" enctype="multipart/form-data" id="suborderform1">
								<div class="item form-group">
									<label class="control-label col-md-2 col-sm-2 col-xs-5" for="ordstatus">Order Type
                                    </label>
                                    <div class="col-md-4 col-sm-4 col-xs-7" >
                                    <?php
	          			 $r1=mysql_query("select * from tbl_services where ServiceId='$ordertypeid'") or die(mysql_error());
						 $rw1=mysql_fetch_array($r1);
	          			 ?>         			
	           			<input type="text" class="form-control col-md-7 col-xs-12" name="ordertype" required="" readonly="readonly" placeholder="" value="<?php echo $rw1['ServiceName'];?>">
<input type="hidden" class="form-control col-md-7 col-xs-12" name="ordercat" id="ordercatid" required="" readonly="readonly" placeholder="" value="<?php echo $rows['OrderTypeId'];?>">
									<input type="hidden" id="datepicker" class="form-control date-picker col-md-7 col-xs-12" name="pickdate" required="" placeholder="Select Pickup Date" value="<?php echo $row['Order_PickDate'];?>">
									
									<input type="hidden" id="orderidhide" class="form-control col-md-7 col-xs-12" name="orderid" required="" placeholder="Order id" value="<?php echo $row['OrderId'];?>" onchange="getorderdetail();" onkeyup="this.onchange();" onpaste="this.onchange();" oninput="this.onchange();">
									
									<input type="hidden" id="suborderidhide" class="form-control col-md-7 col-xs-12" name="suborderid" required="" placeholder="Sub Order id" value="<?php echo $soid;?>">
									<!--<input type="hidden" id="review" class="form-control col-md-7 col-xs-12" name="review" required="" placeholder="Remarks" value="<?php echo $row['Remarks'];?>">-->
		                           	</div>
		                           	<label class="control-label col-md-2 col-sm-2 col-xs-5" for="ordstatus"> Subscription Type
                                    </label>
                                    <div class="col-md-4 col-sm-4 col-xs-7" >
                                    <?php
				          			 $r1=mysql_query("select * from tbl_subs_suborder where subOrderId='$soid'") or die(mysql_error());
									 $rw1=mysql_fetch_array($r1);
									 $user_subs_id=$rw1['user_subs_id'];
									 
									 $que1=mysql_query("select * from tbl_usersubscriptions where srno='$user_subs_id'");
									 $ro1=mysql_fetch_array($que1);
									 $subs_id=$ro1['subs_id'];
									 
									 $q=mysql_query("select * from tbl_subscriptions where subs_id='$subs_id'");
									 $rw2=mysql_fetch_array($q);
				          			 ?>         			
				           			<input type="text" class="form-control col-md-7 col-xs-12" name="substype" required="" readonly="readonly" placeholder="" value="<?php echo $rw2['subs_name'];?>">
									<input type="hidden" class="form-control col-md-7 col-xs-12" name="usersubstypeid" id="my_select" required="" readonly="readonly" placeholder="" value="<?php echo $rw1['user_subs_id'];?>">
									<input type="hidden" class="form-control col-md-7 col-xs-12" name="subswt" id="subswt" required="" readonly="readonly" placeholder="" value="<?php echo $rw1['subs_wt'];?>">	
									<input type="hidden" class="form-control col-md-7 col-xs-12" name="availablepickup" id="availablepickup" required="" readonly="readonly" placeholder="" value="<?php echo $rw2['subs_maxpickup'];?>">
									<input type="hidden" class="form-control col-md-7 col-xs-12" name="extrapickupcost" id="extrapickupcost" required="" readonly="readonly" placeholder="" value="<?php echo $rw2['subs_extra_pickup_cost'];?>">			
									</div>
		                           	
								</div>
								
		                        <div class="item form-group">   
		                        	
		                       <label class="control-label col-md-2 col-sm-2 col-xs-5" for="usedwt">Used Weight
                                </label>
                                <div class="col-md-4 col-sm-4 col-xs-7">
                      			<?php
								
								$result1=mysql_query("select * from tbl_usersubscriptions where UserId='$userid' and srno='$user_subs_id'");
								$rowss1=mysql_fetch_array($result1);
								?>
                               <input type="text" id="usedwt" class="form-control col-md-7 col-xs-12"  name="usedwt"  placeholder="Used Weight" readonly="" value="<?php echo $rowss1['used_weight'];?>">      
                    			
                    			 <input type="hidden" id="remainwt" class="form-control col-md-7 col-xs-12"  name="remainwt"  placeholder="Remaining Weight" readonly="" value="<?php if($rw2['subs_wt']=='unlimited'||$rw2['subs_wt']=='Unlimited'){ echo "unlimited";} else{ echo $rw2['subs_wt']-$rowss1['used_weight'];} ?>">
                    			 
                    			 <input type="hidden" id="usedpickup" class="form-control col-md-7 col-xs-12"  name="usedpickup"  placeholder="" readonly="" value="<?php echo $rowss1['max_pickup']-1;?>">
                    			
                    			</div>
						<label class="control-label col-md-2 col-sm-2 col-xs-5" for="orderwt">Order Weight
                                    </label>
                                    <div class="col-md-4 col-sm-4 col-xs-7">
                          
                                   <input type="text" id="orderwt" class="form-control col-md-7 col-xs-12"  name="orderwt"  placeholder="Order Weight" value="<?php echo $rows['TotalWeight'];?>"> 
                                   
                                   <input type="hidden" id="orderwtold" class="form-control col-md-7 col-xs-12"  name="orderwtold"  placeholder="Order Weight" value="<?php echo $rows['TotalWeight'];?>">      
                        			</div>
                                    
                    			
		                        </div> 
		                        <div class="item form-group">
		                        	<label class="control-label col-md-2 col-sm-2 col-xs-5" for="extrawtcost">Extra Weight Cost
                                    </label>
                                    <div class="col-md-4 col-sm-4 col-xs-7">
                          
                                   <input type="text" id="extrawtcost" class="form-control col-md-7 col-xs-12"  name="extrawtcost"  placeholder="Extra Weight Cost" value="<?php echo $rw1['extra_wt_cost'];?>">      
                        			</div>
								
								
									<label class="control-label col-md-2 col-sm-2 col-xs-5" for="extrawpickcost">Extra PickUp Cost
                                    </label>
                                    <div class="col-md-4 col-sm-4 col-xs-7">
                          
                                   <input type="text" id="extrawpickcost" class="form-control col-md-7 col-xs-12"  name="extrawpickcost"  placeholder="Extra PickUp Cost" value="<?php echo $rw1['extra_pickup_cost'];?>">      
                        			</div>
		                        </div>
		                        
		                        <div class="item form-group">
		                        	<label class="control-label col-md-2 col-sm-2 col-xs-5" for="totalcost">Total Cost
                                    </label>
                                    <div class="col-md-4 col-sm-4 col-xs-7">
                          
                                   <input type="text" id="totalcost" class="form-control col-md-7 col-xs-12"  name="totalcost"  placeholder="Total Cost" value="<?php echo $rows['TotalAmount'];?>">      
                        			</div>	
		                           	<label class="control-label col-md-2 col-sm-2 col-xs-5" for="deliverystatus">Delivery Status
                                     </label>
                                     <div class="col-md-4 col-sm-4 col-xs-7" >
                                      <select class="form-control deliverystatus" required name="dstatus" id="dstatus">
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
								<div class="item form-group deliverbydiv">
									<label class="control-label col-md-2 col-sm-2 col-xs-5" for="deliverby">Delivered By
                                     </label>
                                     <div class="col-md-4 col-sm-4 col-xs-7" >
                              <?php if($_SESSION['loginrole']==2 || $_SESSION['loginrole']==3){?>
                                      <select class="form-control" name="deliverby" id="deliverby">
									 <option value="-1"  style="padding-bottom:7px">Select Delivered By</option>
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
                                    <label class="control-label col-md-2 col-sm-2 col-xs-5" for="actualdd">ActualDeliveryDate
                                    </label>
                                    <div class="col-md-4 col-sm-4 col-xs-7">
                          
                                   <input type="text" id="datepicker3" class="form-control date-picker col-md-7 col-xs-12"  name="actualdd"  placeholder="Select Actual Delivery Date" value="<?php echo $rows['ActualDeliveryDate']; ?>">      
                        			</div>
								</div>
								<div class="item form-group">
									 <label class="control-label col-md-2 col-sm-2 col-xs-5" for="ordstatus">Delivery Type
                                     </label>
                                     <div class="col-md-4 col-sm-4 col-xs-7" >
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
								<!--</div>
								<div class="item form-group">-->
									<label class="control-label col-md-2 col-sm-2 col-xs-5" for="dob">Delivery Date
                                    </label>
                                    <div class="col-md-4 col-sm-4 col-xs-7">
                          
                                   <input type="text" id="datepicker2" class="form-control date-picker col-md-7 col-xs-12"  name="deliverydate"  placeholder="Select Delivery Date" value="<?php echo $rows['DeliveryDate']; ?>">      
                        			</div>
								</div>
								<div class="item form-group" >
                                <span class="col-md-3 col-sm-3 col-xs-12"> </span>
		                    	<span class="col-md-6 col-sm-6 col-xs-12"  style="color:red" id="dfast"> </span>
		                    	</div> 
		                    	<div class="item form-group">
									 
									 <label for="Image" class="control-label col-md-2 col-sm-2 col-xs-5">Delivery Address</label>
            				
            				<div class="col-md-4 col-sm-4 col-xs-7">
            			  
            			  <input type="text" class="form-control" readonly="" id="pickadd" name="address" required="" placeholder="Enter Customer Delivery Address" data-form-field="address" value="<?php echo $rows["DeliveryAddress"]; ?>" placeholder="<?php if(empty($rows['DeliveryAddress'])){ echo "Select Customer Delivery Address"; } else { echo "Change Customer Delivery Address" ; }?>">
            			       <!--</div>
            			       
            			       <div class="col-md-4 col-sm-4 col-xs-7">-->
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
            			  $res1=mysql_query("select * from tblusers where UserId='$userid'") or die(mysql_error());
							if(mysql_affected_rows())
							{
								$rows1=mysql_fetch_array($res1);
            			  ?>
            			  <input type="text" class="form-control text-capitalize hidden" id="getcity" value="<?php echo $rows1["UserCity"]; ?>"  name="getcity"  placeholder="" data-form-field="">
            			  <?php
							}
            			  ?>
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
										<input type="button"  id="savenewaddress" value="Save" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo" class="btn btn-success"/>                    
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
									 
									 
								<!--</div>
								<div class="item form-group">-->
									<label class="control-label col-md-2 col-sm-2 col-xs-5" for="remarks">Remarks
                                    </label>
                                    <div class="col-md-4 col-sm-4 col-xs-7">
                          
                                  <input type="text" class="form-control col-md-7 col-xs-12" id="remark" readonly="readonly"  name="review" placeholder="Remarks" style="height: 95px" value="<?php echo $rows['Remarks']; ?>">      
                        			<!--</div>-->
                        			<!--remarks multiple-->
                         
                         <!--<div class="col-md-4 col-sm-4 col-xs-7">-->
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
				          <input type="text" class="form-control text-capitalize hidden" id="getsuborderid" value="<?php echo $soid; ?>"  name="getorderid"  placeholder="" data-form-field="">
            			  <input type="text" class="form-control text-capitalize hidden" id="getorderid" value="<?php echo $orderid; ?>"  name="getorderid"  placeholder="" data-form-field="">
            			  <input type="text" class="form-control text-capitalize hidden" id="getuserid" value="<?php echo $userid; ?>"  name="getuserid"  placeholder="" data-form-field="">
                           
                         </div>
				                	<div class="col-md-6">
										<div class="form-group">
										<textarea class="form-control" rows="1" id="newremarks" name="newremarks"></textarea>
				       					</div>
				                    </div>
				                    
				                	<div class="col-md-6">
										<div class="form-group">
										<input type="button"  id="savenewremarks" value="Save" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree" class="btn btn-success"/>                    
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
					              		$rs1=mysql_query("select * from tbl_subordersremarks where UserId='$userid' and OrderId='$orderid' and SubOrderId='$soid'") or die(mysql_error());
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
		                    	
		                    	<div class="form-group">
		                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-4 col-sm-offset-4">
		                            
		                            <input type="submit" name="btnUpdate" class="btn btn-success" id="btnUpdate" value="Update"/>&nbsp;
		                            
		                           
		                        </div>
		                    </div> 
							</form>
							<?php
							}
							}
							else {
								
							
							?>
							<form method="post" role="form" class="form-horizontal" name="suborderform" enctype="multipart/form-data" id="suborderform">
								<div class="item form-group">
									<label class="control-label col-md-2 col-sm-2 col-xs-5" for="ordstatus">Subscription Type
                                    </label>
                                    <div class="col-md-4 col-sm-4 col-xs-7" >
                                    <select class="form-control"  id="my_select" name="usersubstypeid"   style="cursor: pointer" required onchange="showdelivery(this.value)">
		    						<option value="-1"  style="padding-bottom:7px">Select Subscription Type</option>
		    						<?php
		    				      	$rs1=mysql_query("select * from tbl_usersubscriptions where UserId='$userid' and subs_status='activated'");
									while($row1=mysql_fetch_array($rs1))
									{
										$subs_id=$row1["subs_id"];
										$q=mysql_query("select * from tbl_subscriptions where subs_id='$subs_id'");
										$row2=mysql_fetch_array($q);
										?>
									<option value="<?php echo $row1["srno"]; ?>" style="padding:10px"> <?php echo $row2["subs_name"]; ?> </option>
									<?php	
									}  
		    				      	?>
		    						  						
										
									</select>
									<input type="hidden" class="form-control col-md-7 col-xs-12" name="subswt" id="subswt" required="" readonly="readonly" placeholder="" value="">
									<input type="hidden" id="datepicker" class="form-control date-picker col-md-7 col-xs-12" name="pickdate" required="" placeholder="Select Pickup Date" value="<?php echo $row['Order_PickDate'];?>">
									<input type="hidden" id="address" class="form-control col-md-7 col-xs-12" name="address" required="" placeholder="Select address" value="<?php echo $row['PickupAddress'];?>">
									<input type="hidden" id="orderidhide" class="form-control col-md-7 col-xs-12" name="orderid" required="" placeholder="Order id" value="<?php echo $row['OrderId'];?>" onchange="getorderdetail();" onkeyup="this.onchange();" onpaste="this.onchange();" oninput="this.onchange();">
									<input type="hidden" id="getuid" class="form-control col-md-7 col-xs-12" name="getuid" required="" placeholder="User id" value="<?php echo $userid;?>">
									<!--<input type="hidden" id="review" class="form-control col-md-7 col-xs-12" name="review" required="" placeholder="Remarks" value="<?php echo $row['Remarks'];?>">-->
		                           	</div>
		                           	
		                           	<label class="control-label col-md-2 col-sm-2 col-xs-5" for="usedwt">Used Weight
                                    </label>
                                    <div class="col-md-4 col-sm-4 col-xs-7">
                          
                                   <input type="text" id="usedwt" class="form-control col-md-7 col-xs-12"  name="usedwt"  placeholder="Used Weight" readonly="">      
                        			<input type="hidden" id="availablewt" name="availablewt"  />
                        			<input type="hidden" id="remainwt" class="form-control col-md-7 col-xs-12"  name="remainwt"  placeholder="Remaining Weight" readonly="">
                        			<input type="hidden" class="form-control col-md-7 col-xs-12" name="availablepickup" id="availablepickup" required="" readonly="readonly" placeholder="" >
									<input type="hidden" class="form-control col-md-7 col-xs-12" name="extrapickupcost" id="extrapickupcost" required="" readonly="readonly" placeholder="" >
                        			 <input type="hidden" id="usedpickup" class="form-control col-md-7 col-xs-12"  name="usedpickup"  placeholder="" readonly="" >
                        			</div>
		                           	
		                           
								</div>
								
								<div class="item form-group">
							   	
		                           	<label class="control-label col-md-2 col-sm-2 col-xs-5" for="orderwt">Order Weight
                                    </label>
                                    <div class="col-md-4 col-sm-4 col-xs-7">
                          
                                   <input type="text" id="orderwt" class="form-control col-md-7 col-xs-12"  name="orderwt"  placeholder="Order Weight">      
                        			<input type="hidden" id="orderwtold" class="form-control col-md-7 col-xs-12"  name="orderwtold"  placeholder="Order Weight" value="0">
                        			</div>
                        			<label class="control-label col-md-2 col-sm-2 col-xs-5" for="extrawpickcost">Extra PickUpCost
                                    </label>
                                    <div class="col-md-4 col-sm-4 col-xs-7">
                          
                                   <input type="text" id="extrawpickcost" class="form-control col-md-7 col-xs-12"  name="extrawpickcost"  placeholder="Extra PickUp Cost" value="0">      
                        			</div>
                        			
								</div>
								
								<div class="item form-group">
									<label class="control-label col-md-2 col-sm-2 col-xs-5" for="extrawtcost">Extra WeightCost
                                    </label>
                                    <div class="col-md-4 col-sm-4 col-xs-7">
                          
                                   <input type="text" id="extrawtcost" class="form-control col-md-7 col-xs-12"  name="extrawtcost"  placeholder="Extra Weight Cost" value="0">      
                        			</div>
		                           	
		                           	<label class="control-label col-md-2 col-sm-2 col-xs-5" for="totalcost">Total Cost
                                    </label>
                                    <div class="col-md-4 col-sm-4 col-xs-7">
                          
                                   <input type="text" id="totalcost" class="form-control col-md-7 col-xs-12"  name="totalcost"  placeholder="Total Cost">      
                        			</div>
								</div>
								
								<div id="deliverydiv" style="display:none;">
								<div class="item form-group">
									 <label class="control-label col-md-2 col-sm-2 col-xs-5" for="ordstatus">Delivery Type
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
								<!--</div>
								<div class="item form-group">-->
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
		                    	<div class="item form-group">
									 <label class="control-label col-md-2 col-sm-2 col-xs-5" for="deliverystatus">Delivery Status
                                     </label>
                                     <div class="col-md-4 col-sm-4 col-xs-7" >
                                     <select name="dstatus" class="form-control deliverystatus" style="cursor: pointer" required>
            						<option value="-1"  style="padding-bottom:7px">Select Delivery Status</option>
            						
            						  <?php
            				      	$rs=mysql_query("select * from tbl_orderstatus_id");
									while($row=mysql_fetch_array($rs))
									{
										?>
									<option value="<?php echo $row["order_status_id"]; ?>" style="padding:10px"> <?php echo $row["order_status_text"]; ?> </option>
									<?php	
									}  
            				      	?>
										
									</select>
                                    </div>
								<!--</div>
								<div class="item form-group">-->
									<label class="control-label col-md-2 col-sm-2 col-xs-5" for="remarks">Remarks
                                    </label>
                                    <div class="col-md-4 col-sm-4 col-xs-7">
                          
                                   <textarea id="remarks" class="form-control col-md-7 col-xs-12"  name="remarks"  placeholder="Enter Remarks"></textarea>      
                        			</div>
								</div>
		                    	</div>
		                    	<div class="item form-group deliverbydiv" hidden>
									 <label class="control-label col-md-2 col-sm-2 col-xs-5" for="deliverby">Delivered By
                                     </label>
                                     <div class="col-md-4 col-sm-4 col-xs-7" >
                              <?php if($_SESSION['loginrole']==2 || $_SESSION['loginrole']==3){?>
                                     <select name="deliverby" class="form-control deliverby" style="cursor: pointer" >
            						<option value="-1"  style="padding-bottom:7px">Select Delivered By</option>
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
					<input type="hidden" class="form-control" name="deliverby" id="deliverby" value="<?php echo $rws['empId']; ?>">
					<input type="text" class="form-control" readonly="readonly" value="<?php echo $rws['empName']; ?>">
					
					<?php
					} ?>
                                    </div>
								<label class="control-label col-md-2 col-sm-2 col-xs-5" for="actualdd">ActualDeliveryDate
                                    </label>
                                    <div class="col-md-4 col-sm-4 col-xs-7">
                          
                                   <input type="text" id="datepicker3" class="form-control date-picker col-md-7 col-xs-12"  name="actualdd"  placeholder="Select Actual Delivery Date">      
                        			</div>
								</div>
								
								
								
		                    	<div class="form-group">
		                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-4 col-sm-offset-4">
		                            
		                            <input type="button" name="btnAdd" class="btn btn-success" id="btnAdd" value="Create"/>&nbsp;
		                        </div>
		                    </div> 
							</form>
							<?php
							}
							?>
						</div>
					
			</div>
				</div>
				<div class="col-md-2 col-sm-2 col-xs-12">
					<a href="suborder_dashboard.php?oid=<?php echo $orderid;?>&uid=<?php echo $userid;?>" style="color:#000000;"><button class="btn">View Order</button></a>
					<h4>All Sub Orders</h4>
					<?php
					$result1=mysql_query("select * from tbl_suborders where UserId='$userid' and OrderId='$orderid'") or die(mysql_error());
					if(mysql_affected_rows())
					{
						while($rows1=mysql_fetch_array($result1))
						{
						$suboid=$rows1['SubOrderId'];
						$otypeid=$rows1['OrderTypeId'];
						$amt=$rows1['PayableAmount'];
						$res1=mysql_query("select * from tbl_services where ServiceId='$otypeid'") or die(mysql_error());
						$row2=mysql_fetch_array($res1);
						$otype=$row2['ServiceName'];
					if($otype=='Subscription'||$otype=='subscription')
						{
						?>
						<div class="col-md-12 col-sm-12 col-xs-12" style="border: 1px solid #c0c0c0;background-color:#c0c0c0; padding: 5px;">
						<p style="<?php if($_GET['soid']==$suboid){ echo 'background:#E8DC80;';}?> padding:5px;"><a href="create_subs_suborder.php?oid=<?php echo $orderid;?>&uid=<?php echo $userid;?>&soid=<?php echo $suboid;?>" style="color:#5C69F7;"><?php echo $suboid; ?></a>, <?php echo $otype; ?>, <?php echo "₹".$amt; ?></p>
					</div>
						<?php	
						}
						else {
						?>
						<div class="col-md-12 col-sm-12 col-xs-12" style="border: 1px solid #c0c0c0;background-color:#c0c0c0; padding: 5px;">
						<p style="<?php if($_GET['soid']==$suboid){ echo 'background:#E8DC80;';}?> padding:5px;"><a href="create_suborder.php?oid=<?php echo $orderid;?>&uid=<?php echo $userid;?>&soid=<?php echo $suboid;?>&edit=1" style="color:#5C69F7;"><?php echo $suboid; ?></a>, <?php echo $otype; ?>, <?php echo "₹".$amt; ?></p>
					</div>
						<?php
						}
					?>
					<?php
						}
					}
					?>
				</div>
				
			</div>
			&nbsp;&nbsp;
			
		</div>
	</div>
</div>
<?php
}
}
?>
<?php
include 'footer.php';

?>