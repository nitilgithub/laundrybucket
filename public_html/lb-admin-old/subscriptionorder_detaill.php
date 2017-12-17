<?php include 'header.php';?>
<?php
$order_id=intval(trim(mysql_real_escape_string($_GET["id"])));

global $orderreceipt_id;
?>


 <script>
 /*
  Allowed Digit Only
 
 $(document).ready(function () {
  //called when key is pressed in textbox
  $("#quantity").keypress(function (e) {
     //if the letter is not digit then display error and don't type anything
     if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
        //display error message
        $("#errmsg").html("Digits Only").show().fadeOut("slow");
               return false;
    }
   });
});
*
*/

/*allow digit and decimal(Point) */
 $(document).ready(function () {
  //called when key is pressed in textbox
  $(".digitonly").keypress(function (e) {
     //if the letter is not digit then display error and don't type anything
     if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57) &&(e.which != 46 && e.which > 31)) {
        //display error message
        //$("#errmsg").html("Digits Only").show().fadeOut("slow");
        alert("digit only")
               return false;
    }
   });
});
 </script>
 
<?php
			
function  update_orderitemdetail($order_id,$uid,$receipt_id,$order_weight,$filepath,$order_status,$ord_remarks,$user_subsid)
{
	
	//$result=mysql_query("update tbl_orders set OrderReceiptId='$receipt_id',OrderTotalWeight='$order_weight',OrderReceiptPic='$filepath' where OrderId='$order_id'");
	$result=mysql_query("update tbl_orders set OrderReceiptId='$receipt_id',OrderTotalWeight='$order_weight',OrderReceiptPic='$filepath',OrderStatusId='$order_status',Review='$ord_remarks' where OrderId='$order_id'");
	 if($result)
  {

  	//echo "<script>setTimeout(\"location.href = 'subscriptionorder_detail.php?id=$order_id';\",1500);</script>";
   //echo "<div class='alert alert-success'>Well done! Subs Items Added Successfully</div>";
    $result11=mysql_query("select SUM(OrderTotalWeight) as otweight from tbl_orders where (User_Subsid='$user_subsid' and OrderUserId='$uid')") or die(mysql_error());
	if(mysql_num_rows($result11)>0)
	{
		$row11=mysql_fetch_array($result11);
		$order_total_weight=$row11["otweight"];
		
		$result=mysql_query("update tbl_usersubscriptions set used_weight='$order_total_weight' where srno='$user_subsid'");
	}
      ?> 
   <script>
    alert("Order  updated successfully");
    window.location.href="subscriptionorder_detail.php?id=<?php echo $order_id; ?>";
   	
   	</script><?php
  }
	 else {
		  ?>
		   <script> alert("Please Try Later");
		   	window.location.href="subscriptionorder_detail.php?id=<?php echo $order_id; ?>";
		   	</script>
		   
		  <?php
	 }

}
?>

            <!-- page content -->
            <div class="right_col" role="main" style="min-height: 1500px">

<?php
   if(isset($_GET["id"]))
 {
    $id=intval(trim(mysql_real_escape_string($_GET["id"])));
	
	  $result=mysql_query("select * from tbl_orders where OrderId='$order_id'") or die(mysql_error());
	   if(mysql_num_rows($result)>0)
	     {
	       $row=mysql_fetch_array($result);
		   $uid=$row["OrderUserId"];
		   $uemail=$row["OrderEmail"];//n
		   $uphone=$row["OrderPhone"];//n
		   
		     $order_type=$row["OrderType"];//n
		   
		   
		   $user_subsid=$row["User_Subsid"];
		   $orderreceipt_id=$row["OrderReceiptId"];
		   
		   $order_date=$row["OrderDate"];
		   $address=$row["OrderShipAddress"];
		   $pickdate=$row["Order_PickDate"];
		   $picktime=$row["Order_PickTime"];
		   $order_weight=$row["OrderTotalWeight"];
		     //$order_total_amt=$row["OrderTotalAmount"];
			 $order_statusid=$row["OrderStatusId"];
			 $orderreceipt_pic=$row["OrderReceiptPic"];
			 
			 $order_remarks=$row["Review"]; //n
		    
	
?>
                
                    <div class="page-title">
                        <div class="title_left">
                            <h3>Orders # <?php echo $order_id;?></h3>
                        </div>
                    </div>
                    
                    <div class="clearfix"></div>

<!-- Start section for customer detail-->
                    <div class="">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2><i class="fa fa-bars"></i> Customer Detail </h2>
                                    <ul class="nav navbar-right panel_toolbox">
                                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                        </li>
                                        <!--<li><a class="close-link"><i class="fa fa-close"></i></a>  </li>-->
                                    </ul>
                                    <div class="clearfix"></div>
                                </div>
                               


                                                  <div class="x_content table-responsive">
                                                  	
                                    <table id="example" class="table table-striped table-bordered responsive-utilities jambo_table">
                                        <thead>
                                            <tr class="headings">
                                                <!--
                                                <th>
                                                    <input type="checkbox" class="tableflat">
                                                </th>
                                                -->
                                                <?php
                                                if($row["OrderUserId"]!='0')
												{
													?>
												<th title="Click on id to view complete detail of cutomer">CustomerId </th>
												<?php	
												}
												else {
													
												}
                                                ?>
                                                
                                               <th>Name </th> 
                                                <th>Email </th>
                                               
                                                <th>Mobile </th>
                                            </tr>
                                            
                                         
                                        </thead>

                                        <tbody>
                              
											<tr class="even pointer">
	                                              
	                                               <?php
                                                if($row["OrderUserId"]!='0')
												{
														
	                                               	$query="select * from  tblusers where UserId='$uid'";
													$res=mysql_query($query);
													$row1=mysql_fetch_array($res);
	                                               	?>
												     <td title="Click on this id to view complete detail of cutomer"><a href="reguserlist.php?uid=<?php echo $uid; ?>" style="color:black;display:block;"><?php echo $uid; ?></a></td>
												     
												     <td class=" "><?php echo empty($row1["UserFirstName"]) ? ($row["OrderShipName"]):($row1["UserFirstName"].' '.$row1["UserLastName"]);?></td> <!-- if user name not exist in table tblusers then fetch username from tbl_orders-->
												      <td class=" "><?php echo empty($row1["UserEmail"])? $uemail : $row1["UserEmail"];?> </td>
	                                               
	                                                <td class=" "><?php echo empty($row1["UserPhone"])?$uphone : $row1["UserPhone"];?>  </td>
												     
												<?php	
												}
												else
													{
														?>
													 <td class=" "><?php echo $row["OrderShipName"];?></td>
													  <td class=" "><?php echo $uemail ;?> </td>
	                                               
	                                                <td class=" "><?php echo $uphone ;?>  </td>
													 <?php	
													}
                                                ?>
                                                
	                                            
	                                              
	                                               
	                                               	
	                                             
	                                               
	                                                 		 </tr>
															 
												
                                            
                                        </tbody>

                                    </table>
                                    
                                    	                                </div>

                                </div>
                            </div>
                        </div>

<!-- End section for customer detail-->
	
	<div class="clearfix"></div>	
    <div class="row">
    	<div class="col-md-12">
    		&nbsp;
    		</div>
    	<div class="col-md-12"> &nbsp;</div>
    	</div>
    
     <!-- Start Section for Subscription  Details-->

                   <div class="">

                        <div class="col-md-12 col-sm-12 col-xs-12">

                            <div class="x_panel">

                                <div class="x_title">

                                    <h2><i class="fa fa-bars"></i> Subscription Detail </h2>

                                    <ul class="nav navbar-right panel_toolbox">

                                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>

                                        </li>

                                        <!--<li><a class="close-link"><i class="fa fa-close"></i></a>  </li>-->

                                    </ul>

                                    <div class="clearfix"></div>

                                </div>

                               

	                             <div class="x_content table-responsive">

									 <table id="example" class="table table-striped table-bordered responsive-utilities jambo_table">

                                       	 <thead>

                                            <tr class="headings">

                                               <th>Subscription Name </th> 

                                                <th>Subs_Total Weight</th>

												 <th>Used Weight </th>
												 
											</tr>
											
										</thead>

									 	 <tbody>

                                		<?php

                                         $result23=mysql_query("select * from tbl_usersubscriptions where srno='$user_subsid'") or die(mysql_error());

											if(mysql_affected_rows())
	
		                                  {
	
			                                   $row23=mysql_fetch_array($result23);
	
											   $subs_id=$row23["subs_id"];
	
				                              $used_weight=$row23["used_weight"];

										 	$result24=mysql_query("select * from tbl_subscriptions where subs_id='$subs_id'") or die(mysql_error());

												$row24=mysql_fetch_array($result24);

										       

										       $subs_name=$row24["subs_name"];

											   $subs_total_Weight=$row24["subs_wt"];

											?>

											<tr class="even pointer">

	                                              

	                                               <td class=" "><?php echo $subs_name;?></td>

	                                             

	                                                <td class=" "><?php echo $subs_total_Weight;?> Kg</td>

	                                               

	                                                <td class=" "><?php echo $used_weight. " Kg ";?>  </td>

	                                               

	                                                 		 </tr>

													<?php

                                             }

                                               ?>

										</tbody>

									</table>

								</div>

							 </div>

                            </div>

                        </div>

                    
  <!-- End Section for Subscription  Details-->
              

              

                <div class="clearfix"></div>	

    <div class="row">

    	<div class="col-md-12">

    		&nbsp;

    		</div>

    	<div class="col-md-12"> &nbsp;</div>

    	</div>

    
    
 <!-- Start Section for  Order Details-->
 
   <div class="">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2 class="text-capitalize"><i class="fa fa-bars"></i><?php echo $order_type; ?> Order Detail </h2>
                                    <ul class="nav navbar-right panel_toolbox">
                                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                        </li>
                                        <!--<li><a class="close-link"><i class="fa fa-close"></i></a>  </li>-->
                                    </ul>
                                    <div class="clearfix"></div>
                                </div>
                               
	                                                  <div class="x_content table-responsive">
                                                  	
                                    <table id="example" class="table table-striped table-bordered responsive-utilities jambo_table">
                                        <thead>
                                            <tr class="headings">
                                               
                                               <th>Order Id </th>
                                              
                                               <?php
                                               if($orderreceipt_id!="")
											   {
											   	?>
											   	<th> Order Receipt No. </th>
											   	<?php
											   }
											   else {
												
											   }
                                               ?>
                                               
                                                <th>Order Date </th> 
                                                <th>Address</th>
                                                <th>Pickup Date</th>
                                               <th>Pickup Time</th>
                                                <!--<th>Order Weight(Kg) </th>-->
                                                
                                                <?php
                                               if($order_weight!="")
											   {
											   	?>
											   	<th> Order Weight(Kg)</th>
											   	<?php
											   }
											   else {
												
											   }
                                               ?>
                                               
                                               
                                                 <th>Order Status </th>
                                                 
                                                 <?php
                                               if(!empty($order_remarks))
											   {
											   	?>
											   	<th> Order Remarks </th>
											   	<?php
											   }
											   else {
												
											   }
                                               ?>
                                                
                                                 
                                               <?php
                                               if($orderreceipt_pic!="#")
											   {
											   	?>
											   	<th> Order Receipt image </th>
											   	<?php
											   }
											   else {
												
											   }
                                               ?>
                                               
                                               
                                              
                                            </tr>
                                            
                                         
                                        </thead>

                                        <tbody>
                                <?php
                                		     $result2=mysql_query("select * from tbl_orderstatus_id where order_status_id='$order_statusid'") or die(mysql_error());
			                             	
			                             	   $row2=mysql_fetch_array($result2);
										       $order_status_text=$row2["order_status_text"];
											   
											   
			                             	?>
											<tr class="even pointer">
	                                              
	                                                <td class=" "><?php echo $order_id;?></td>
	                                                
	                                                  <?php
                                               if($orderreceipt_id!="")
											   {
											   	?>
											   	<td> <?php echo $orderreceipt_id; ?> </td>
											   	<?php
											   }
											   else {
												
											   }
                                               ?>
	                                                
	                                                 <td class=" "><?php echo $order_date;?></td>	
	                                                  <td class=" "><?php echo $address;?></td>
	                                                    <td class=" "><?php echo $pickdate;?></td>
	                                               <td class=" "><?php echo $picktime;?></td>
	                                             
	                                               <!-- <td class=" "><?php echo $order_weight;?> </td>-->
	                                           
	                                               
	                                                   <?php
                                               if($order_weight!="")
											   {
											   	?>
											  	<td>  <?php echo $order_weight; ?> Kg </td>
											   	<?php
											   }
											   else {
												
											   }
                                               ?>
                                               
	                                               
	                                                <td class=" "><?php echo $order_status_text;?>  </td>
	                                                
	                                               
	                                               
	                                                    <?php
                                               if(!empty($order_remarks))
											   {
											   	?>
											  	<td>  <?php echo $order_remarks; ?> </td>
											   	<?php
											   }
											   else {
												
											   }
                                               ?>
	                                               
	                                               
	                                                   <?php
                                               if($orderreceipt_pic!="#")
											   {
											   	?>
											   	<td> <a href="../<?php echo $orderreceipt_pic ?>" target=_blank><img src="../<?php echo $orderreceipt_pic ?>" class="image-responsive" style="height: 50px;width: 50px"></a> </td>
											   	<?php
											   }
											   else {
												
											   }
                                               ?>
	                                               
	                                                 		 </tr>
															 
									 </tbody>

                                   </table>
                                    
                                  </div>
                                </div>
                            </div>
                        </div>
 
 <!-- End Section for Order Detail -->  
    
    
                 
    <div class="clearfix"></div>	
    <div class="row">
    	<div class="col-md-12">
    		&nbsp;
    		</div>
    	<div class="col-md-12"> &nbsp;</div>
    	</div>
                 
             
    <!-- Start Section For Orders Remarks History-->
    
    <?php
      $result11=mysql_query("select * from tbl_ordersremarks where OrderId='$order_id'") or die(mysql_error());
	  if(mysql_num_rows($result11)>0)
	  {
	?>
    
        <div class="">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2><i class="fa fa-bars"></i> Remarks History </h2>
                                    <ul class="nav navbar-right panel_toolbox">
                                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                        </li>
                                        <!--<li><a class="close-link"><i class="fa fa-close"></i></a>  </li>-->
                                    </ul>
                                    <div class="clearfix"></div>
                                </div>
                               


                                                  <div class="x_content table-responsive">
                                                  	
                                    <table id="example" class="table table-striped table-bordered responsive-utilities jambo_table">
                                        <thead>
                                            <tr class="headings">
                                               	<th> #</th> 
                                               	<th>Remarks </th> 
                                                <th>Remarks By </th>
                                                <th>Addon </th>
                                            </tr>
                                            
                                         
                                        </thead>

                                        <tbody>
                                     <?php
	                                               $i=0;
                                              while($row11=mysql_fetch_array($result11))
                                              {
                                              	$i=$i+1;
	                                               	?>
												     <tr class="even pointer">
												     <td> <?php echo $i; ?> </td>
												     <td class=" "><?php echo $row11["Remarks"];?></td>
												     <td class=" "><?php echo $row11["RemarksBy"] ;?> </td>
	                                               	 <td class=" "><?php echo $row11["addon"] ;?>  </td>
												      </tr>
												<?php	
												}
											
                                                ?>
                                                  		
															 
												
                                            
                                        </tbody>

                                    </table>
                                    
                                    	                                </div>

                                </div>
                            </div>
                        </div>
  
    <!-- End Section For Remarks History-->
    
	<div class="clearfix"></div>	
    <div class="row">
    	<div class="col-md-12">
    		&nbsp;
    		</div>
    	<div class="col-md-12"> &nbsp;</div>
    	</div>
      <?php
    }
else
	{
		
	}
    ?>
    
             
                 
                 <!-- Start Section for Updating Order Detail  Details-->
              
              
          <!-- Start of tabs -->
                <div class="">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                
                                <div class="x_content">


                                    <div class="" role="tabpanel" data-example-id="togglable-tabs">
                                        <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                                            <li role="presentation" class="active"><a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true"> Update Order Detail</a>
                                            </li>
                                            
                                            <li role="presentation" ><a href="#tab_content3" role="tab" id="profile-tab2" data-toggle="tab"  aria-expanded="false">Update Status</a>
                                            </li>
                                           
                                             <li role="presentation" ><a href="#tab_content4" role="tab" id="profile-tab3" data-toggle="tab"  aria-expanded="false">Add Remarks</a>
                                            </li>
                                           
											                                           
                                        </ul>
               
                    
                    
                    <div id="myTabContent" class="tab-content">
                                            <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">
              
                <div class="">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2><i class="fa fa-bars"></i> Update Order Detail  </h2>
                                    <ul class="nav navbar-right panel_toolbox">
                                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                        </li>
                                       
                                     <!--   <li><a class="close-link"><i class="fa fa-close"></i></a></li>-->
                                        
                                    </ul>
                                    <div class="clearfix"></div>
                                </div>
                               


                                  
                                                  <div class="x_content">
                                                  	
                                 	   <?php
		if(isset($_POST["btnadditems"]))
		{
			
			
			$receipt_id=mysql_real_escape_string($_POST["receiptid"]);
			
			//$order_weight=mysql_real_escape_string($_POST["orderweight"]);
			$order_weight=mysql_real_escape_string($_POST["orderweight"]);
			
			$receipt_id=mysql_real_escape_string($_POST["receiptid"]);
			
			$order_status=mysql_real_escape_string($_POST["ordstatus"]);
			
			$ord_newremarks=mysql_real_escape_string($_POST["newremarks"]);
			
			$ord_oldremarks=mysql_real_escape_string($_POST["oldremarks"]); //existing remarks from database this way if admin do not enter any value in remarks field than existing remrks in database will not update with empty
			
			$ord_remarks= (empty($ord_newremarks)? $ord_oldremarks:$ord_newremarks);
			
			
			
		$filename=$_FILES["file"]["name"];
			
   if($filename=="")
						{
		$filepath=$_POST['hidephoto'];
						}
						
						else
				{ 
			$extension=pathinfo($filename);
			@move_uploaded_file($_FILES["file"]["tmp_name"],"../images/all-orderitem-receipt/".date("m-d-y").'_'.time().'.'.$extension["extension"]);
			$filepath="images/all-orderitem-receipt/".date("m-d-y").'_'.time().'.'.$extension["extension"];
			
		}
				
			
		if(!empty($ord_newremarks))
		{
			$remarksby="admin";
			$userid=(empty($uid)? "NULL":"'".$uid."'");
			$remarksbyid="NULL";
			$result66=mysql_query("insert into tbl_ordersremarks(OrderId,UserId,Remarks,RemarksBy,RemarksById,addon)values('$order_id',$userid,'$ord_newremarks','$remarksby',$remarksbyid,NOW())") or die(mysql_error());
			if(mysql_affected_rows())
			{
				update_orderitemdetail($order_id,$uid,$receipt_id,$order_weight,$filepath,$order_status,$ord_remarks,$user_subsid);
			}  
		}
		else {
		
			//update_orderitemdetail($order_id,$receipt_id,$order_weight,$filepath,$user_subsid);
			    update_orderitemdetail($order_id,$uid,$receipt_id,$order_weight,$filepath,$order_status,$ord_remarks,$user_subsid);
		}	 
			

         
 
  
   

?>
<span class="section"> &nbsp;</span>
<?php

}


		?>
                   
    							
                                   
                                    <form method="post" role="form" class="form-horizontal" enctype="multipart/form-data">
                                    		
                                    		
                                    		
                                    		  <div class="item form-group" id="qty">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="itname">OrderReceipt Id 
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                           
                                        <input type="text" name="receiptid" id="receiptid" value="<?php echo $orderreceipt_id; ?>" required class="form-control col-md-7 col-xs-12" placeholder="Enter Order Receipt Id"/>
                                        
                                        
                                            </div>
                                        </div>
                                        
                                    		

                                   		 &nbsp;
  
                                        <!--
                                          <div class="item form-group" id="qty">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="itname">Order Total Weight
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" name="orderweight" id="orderweight" value="<?php echo $order_weight; ?>" class="form-control col-md-7 col-xs-12" placeholder=""/>
                                        &nbsp;<span id="errmsg" class="text-warning" style="font-size:1.4em"></span>
                                            </div>
                                        </div>
                                     -->
                                      <div class="item form-group" id="qty">
											<label class="control-label col-md-3 col-sm-3 col-xs-12" for="itname">Order Total Weight(Kg)
											</label>

                                            <div class="col-md-6 col-sm-6 col-xs-12">

                                        <input type="text" name="orderweight" pattern="^-?\d+(?:\.\d+)?$" title="Please Enter Digit Only" id="orderweight" value="<?php echo $order_weight; ?>" class="form-control col-md-7 col-xs-12" placeholder="Enter Order Total Weight"/>

                                        &nbsp;<span id="errmsg" class="text-warning" style="font-size:1.4em"></span> 

                                        <!--(pattern="^-?\d+(?:\.\d+)?$") this pattern allow number and dot only in input field -->

                                            </div>

                                        </div>
                                        
                                        
                                     	  <div class="item form-group" id="qty">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="itname">Upload Receipt Image 
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                           
                                        <input type="file" name="file" class="form-control col-md-7 col-xs-12"/>
                                     
                                          <input type="hidden" name="hidephoto" value="<?php echo $orderreceipt_pic; ?>" />
                                            </div>
                                        </div>
                                      
                                      &nbsp;
        								
        								  <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="ordstatus">Order Status 
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                             <select class="form-control"  name="ordstatus" id="ordstatus">
            						 
            						
            						<?php
            			// $result3=mysql_query("select * from tbl_orderstatus_id");
							 $result22=mysql_query("SELECT * from tbl_orderstatus_id");			
								if(mysql_affected_rows())
							{
								while($row22=mysql_fetch_array($result22))
		
							{
								?>
								<option <?php echo ($order_statusid==$row22["order_status_id"])?"selected":""?> value="<?php echo $row22["order_status_id"]; ?>"  style="margin-bottom:7px"><?php echo $row22[2]; ?></option>
								
								<?php
								}
							}
						?>
                                           </select>
                                       

                                            </div>
                                        </div>
            								  
            	&nbsp;
            	
            	  <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="addremarks"> Add Remarks 
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                             <input type="text" name="newremarks"  class="form-control col-md-7 col-xs-12" placeholder="Add Remarks(Optional)">
                                             <input type="hidden" name="oldremarks"  class="form-control col-md-7 col-xs-12" value="<?php echo $order_remarks; ?>">
                                            </div>
                                        </div>
            
            			
                                        <div class="ln_solid"> </div>
                                        <div class="form-group">
                                            <div class="col-md-6 col-md-offset-3">
                                                <input type="submit" name="btnadditems" class="btn btn-success" value="Submit"/>
                                                &nbsp;
                                                <br/>
                                            </div>
                                        </div>
                                    </form>
                                   
                              
                                    
                                    	                                </div>
                                                
                                            
                                            
                                        

                                </div>
                            </div>
                        </div>      
                    
                    </div>
                    
  
                    
                    <!--
                      <div class="clearfix"></div>	
    <div class="row">
    	<div class="col-md-12">
    		&nbsp;
    		</div>
    	<div class="col-md-12"> &nbsp;</div>
    	</div>
                  -->


                                     


     <div role="tabpanel" class="tab-pane fade" id="tab_content3" aria-labelledby="profile-tab">
<!--Start of Dryclean Order status Edit -->
    <div class="clearfix"></div>	
    <div class="row">
    	<div class="col-md-12">
    		&nbsp;
    		</div>
    	<div class="col-md-12"> &nbsp;</div>
    	</div>

                    <div class="">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2><i class="fa fa-bars"></i> Update Order Status </h2>
                                    <ul class="nav navbar-right panel_toolbox">
                                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                        </li>
                                       
                                        <li><a class="close-link"><i class="fa fa-close"></i></a>
                                        </li>
                                    </ul>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">


                                  
                                                  <div class="x_content">
                                   
                                   	
                                   	<?php
                                   	
                                   	
		if(isset($_POST["btnsave"]))
		{
			
			$orstatus=mysql_real_escape_string($_POST["orstatus"]);
		
			
			$query="update tbl_orders set OrderStatusId='$orstatus' where OrderId='$order_id'";
	$result4=mysql_query($query) or die(mysql_error());
	if(mysql_affected_rows())
	{
		
		?>
		
		<script>
		
		alert("Order Status Updated Successfully");
		window.location.href="allorders_detail.php?id=<?php echo $order_id;?>"
		</script>
		<?php
			//echo "<div class='alert alert-success'>Well done! Order Status updated successfully</div>";
//echo "<script>setTimeout(\"location.href = 'allorders_detail.php?id=$id';\",2000);</script>";
	}
	else{
		?>
		<script>
		alert("Please Try Later");
		window.location.href="allorders_detail.php?id=<?php echo $order_id;?>"
		</script>
		<?php
	}
	
						
						
					
		}
		?>
                                   
                                   	<span class="section"> &nbsp;</span>	
                                   
                                    <form method="post" role="form" class="form-horizontal">
                                    
                                    
						                
                                        
                                         <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="ordstatus">Order Status <span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                             <select class="form-control" required name="orstatus" id="orstatus">
            						 
            						
            						<?php
            			// $result3=mysql_query("select * from tbl_orderstatus_id");
							 $result3=mysql_query("SELECT * from tbl_orderstatus_id");			
								if(mysql_affected_rows())
							{
								while($row3=mysql_fetch_array($result3))
		
							{
								?>
								<option <?php echo ($order_statusid==$row3["order_status_id"])?"selected":""?> value="<?php echo $row3["order_status_id"]; ?>"  style="margin-bottom:7px"><?php echo $row3[2]; ?></option>
								
								<?php
								}
							}
						?>
                                           </select>
                                       

                                            </div>
                                        </div>
                                        
                                        
                                        	&nbsp;
                                    
                                      
                                        <div class="form-group">
                                            <div class="col-md-6 col-md-offset-3">
                                                
                                                <input type="submit" name="btnsave" class="btn btn-success pull-right" value="Update"/>&nbsp;
                                            </div>
                                        </div>
                                          <div class="ln_solid"> </div>
                                    </form>
                                   
                                   
                                </div>
                                                
                                            
                                            
                                        

                                </div>
                            </div>
                            </div>

</div>

</div> <!-- End Tab content -->


   <div role="tabpanel" class="tab-pane fade" id="tab_content4" aria-labelledby="profile-tab3">
<!--Start of Add Remarks -->
    <div class="clearfix"></div>	
    <div class="row">
    	<div class="col-md-12">
    		&nbsp;
    		</div>
    	<div class="col-md-12"> &nbsp;</div>
    	</div>

                    <div class="">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2><i class="fa fa-bars"></i> Add Orders Remarks </h2>
                                    <ul class="nav navbar-right panel_toolbox">
                                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                        </li>
                                       
                                        <li><a class="close-link"><i class="fa fa-close"></i></a>
                                        </li>
                                    </ul>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">
    <div class="x_content">
                                   
                                   	
                                   	<?php
        if(isset($_POST["btnsaveremarks"]))
		{
			
			$txtremarks=mysql_real_escape_string($_POST["txtremarks"]);
			$remarksby="admin";
			$userid=(empty($uid)? "NULL":"'".$uid."'");
			$remarksbyid="NULL";

		$result6=mysql_query("insert into tbl_ordersremarks(OrderId,UserId,Remarks,RemarksBy,RemarksById,addon)values('$order_id',$userid,'$txtremarks','$remarksby',$remarksbyid,NOW())") or die(mysql_error());
		if(mysql_affected_rows())
		{
			$query7="update tbl_orders set Review='$txtremarks' where OrderId='$order_id'";
	$result7=mysql_query($query7) or die(mysql_error());
	if(mysql_affected_rows())
	{
		?>
		<script>
		alert("Remarks Added Successfully");
		window.location.href="allorders_detail.php?id=<?php echo $order_id;?>"
		</script>
		<?php
			//echo "<div class='alert alert-success'>Well done! Order Status updated successfully</div>";
//echo "<script>setTimeout(\"location.href = 'allorders_detail.php?id=$id';\",2000);</script>";
	   }
		else{
		?>
		<script>
		alert("Please Try Later");
		window.location.href="allorders_detail.php?id=<?php echo $order_id;?>"
		</script>
		<?php
	}
  }
	
	}
		?>
                                   
                                   	<span class="section"> &nbsp;</span>	
                                   
                                    <form method="post" role="form" class="form-horizontal">
                                    <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="addremarks">Remarks <span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                             <input type="text" name="txtremarks" required="" class="form-control col-md-7 col-xs-12">
                                            </div>
                                        </div>
                                        &nbsp;
                                    <div class="form-group">
                                            <div class="col-md-6 col-md-offset-3">
                                                
                                                <input type="submit" name="btnsaveremarks" class="btn btn-success pull-right" value="Submit"/>&nbsp;
                                            </div>
                                        </div>
                                          <div class="ln_solid"> </div>
                                    </form>
                                   
                                   
                                </div>
                                                
                                            
                                            
                                        

                                </div>
                            </div>
                            </div>

</div>

</div> <!-- End Tab content -->




</div> <!-- End tab panel-->

</div> <!-- End x-content -->
</div><!-- End x-panel-->
</div><!-- End of div 12-->

</div> <!-- end of div-->
<!--<!-- Start of tabs -->
</div>
<?php
}
}
?>
	</div>					

                
<?php include 'footer.php'; ?>