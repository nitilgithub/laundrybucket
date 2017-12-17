<?php include 'header.php';?>
<?php
$order_id=intval(trim(mysql_real_escape_string($_GET["id"])));
global $orderreceipt_id;
?>


 <script>
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
			
function update_orderitemdetail($order_id,$receipt_id,$order_weight,$filepath,$user_subsid)
{
	$result=mysql_query("update tbl_orders set OrderReceiptId='$receipt_id',OrderTotalWeight='$order_weight',OrderReceiptPic='$filepath' where OrderId='$order_id'");
	
	 if(mysql_affected_rows())
  {	 $result11=mysql_query("select SUM(OrderTotalWeight) as otweight from tbl_orders where User_Subsid='$user_subsid'") or die(mysql_error());
	if(mysql_affected_rows())
	{
		$row=mysql_fetch_array($result11);
		$order_total_weight=$row["otweight"];
	//	echo $row["otweight"];
		$result=mysql_query("update tbl_usersubscriptions set used_weight='$order_total_weight' where srno='$user_subsid'");
		
	}
	 

  	//echo "<script>setTimeout(\"location.href = 'subscriptionorder_detail.php?id=$order_id';\",1500);</script>";
   //echo "<div class='alert alert-success'>Well done! Subs Items Added Successfully</div>";

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
	   if(mysql_affected_rows())
	     {
	       $row=mysql_fetch_array($result);
		   $uid=$row["OrderUserId"];
		   
		   $user_subsid=$row["User_Subsid"];
		   $orderreceipt_id=$row["OrderReceiptId"];
		   
		   $order_date=$row["OrderDate"];
		   $address=$row["OrderShipAddress"];
		   $pickdate=$row["Order_PickDate"];
		   $picktime=$row["Order_PickTime"];
		     $order_weight=$row["OrderTotalWeight"];
			 $order_statusid=$row["OrderStatusId"];
			 $orderreceipt_pic=$row["OrderReceiptPic"];
		    
	
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
                                               <th>Name </th> 
                                                <th>Email </th>
                                               
                                                <th>Mobile </th>
                                            </tr>
                                            
                                         
                                        </thead>

                                        <tbody>
                                <?php
                                         $result=mysql_query("select * from tblusers where UserId='$uid'") or die(mysql_error());
										if(mysql_affected_rows())
	                                  {
		                                   $row=mysql_fetch_array($result);
			                             
			                             	//$orderreceipt_id=$row["OrderReceiptId"];
			                             	?>
											<tr class="even pointer">
	                                              
	                                               <td class=" "><?php echo $row["UserFirstName"].' '.$row["UserLastName"];?></td>
	                                             
	                                                <td class=" "><?php echo $row["UserEmail"];?> </td>
	                                               
	                                                <td class=" "><?php echo $row["UserPhone"];?>  </td>
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

<!-- End section for customer detail-->
	
	<div class="clearfix"></div>	
    <div class="row">
    	<div class="col-md-12">
    		&nbsp;
    		</div>
    	<div class="col-md-12"> &nbsp;</div>
    	</div>
    
    
 <!-- Start Section for Subscription Order Details-->
 
   <div class="">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2><i class="fa fa-bars"></i> Subscription Order Detail </h2>
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
                                                <th>Order Weight(Kg) </th>
                                                 <th>Order Status </th>
                                                 
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
			                             	
			                             	   $row=mysql_fetch_array($result2);
										       $order_status_text=$row["order_status_text"];
											   
											   
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
	                                             
	                                                <td class=" "><?php echo $order_weight;?> Kg</td>
	                                               
	                                                <td class=" "><?php echo $order_status_text;?>  </td>
	                                               
	                                               
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
 
 <!-- End Section fot Subscription Order Detail -->  
    
    
                 
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
                                         $result=mysql_query("select * from tbl_usersubscriptions where srno='$user_subsid'") or die(mysql_error());
										if(mysql_affected_rows())
	                                  {
		                                   $row=mysql_fetch_array($result);
										   $subs_id=$row["subs_id"];
			                             $used_weight=$row["used_weight"];
										 
										     $result2=mysql_query("select * from tbl_subscriptions where subs_id='$subs_id'") or die(mysql_error());
			                             	
			                             	   $row=mysql_fetch_array($result2);
										       
										       $subs_name=$row["subs_name"];
											   $subs_total_Weight=$row["subs_wt"];
											   
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
                    
              
              
                <div class="clearfix"></div>	
    <div class="row">
    	<div class="col-md-12">
    		&nbsp;
    		</div>
    	<div class="col-md-12"> &nbsp;</div>
    	</div>
              
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
			$order_weight=mysql_real_escape_string($_POST["orderweight"]);
		$filename=$_FILES["file"]["name"];
			
   if($filename=="")
						{
		$filepath=$_POST['hidephoto'];
						}
						
						else
				{ 
			$extension=pathinfo($filename);
			@move_uploaded_file($_FILES["file"]["tmp_name"],"../images/subscription-orderitem-receipt/".date("m-d-y").'_'.time().'.'.$extension["extension"]);
			$filepath="images/subscription-orderitem-receipt/".date("m-d-y").'_'.time().'.'.$extension["extension"];
			
		}
			update_orderitemdetail($order_id,$receipt_id,$order_weight,$filepath,$user_subsid);

         
 
  
   

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
  
                                        
                                          <div class="item form-group" id="qty">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="itname">Order Total Weight
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" name="orderweight" pattern="^-?\d+(?:\.\d+)?$" id="orderweight" value="<?php echo $order_weight; ?>" class="digitonly form-control col-md-7 col-xs-12" placeholder=""/>
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
		window.location.href="subscriptionorder_detail.php?id=<?php echo $order_id;?>"
		</script>
		<?php
			//echo "<div class='alert alert-success'>Well done! Order Status updated successfully</div>";
//echo "<script>setTimeout(\"location.href = 'drycleanorder_detail.php?id=$id';\",2000);</script>";
	}
	else{
		?>
		<script>
		alert("Please Try Later");
		window.location.href="subscriptionorder_detail.php?id=<?php echo $order_id;?>"
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
								while($row=mysql_fetch_array($result3))
		
							{
								?>
								<option <?php echo ($order_statusid==$row["order_status_id"])?"selected":""?> value="<?php echo $row["order_status_id"]; ?>"  style="margin-bottom:7px"><?php echo $row[2]; ?></option>
								
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