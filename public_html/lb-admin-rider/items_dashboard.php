<?php
include 'header.php';
if(isset($_GET['soid']))
{
	$soid=$_GET['soid'];
	$oid=$_GET['oid'];
	$uid=$_GET['uid'];
	
}
?>

<script>
	$(document).on("click",".btndel",function(){
		var id=$(this).attr('title');
		var soid=$("#soid").val();
		var oid=$("#oid").val();
		var uid=$("#uid").val();
		var r=confirm("Do you really want to Delete this Item");
  		if(r==true)
  		{
  		 window.location.href="delete_item.php?id="+id+"&soid="+soid+"&oid="+oid+"&uid="+uid;
  		}
  		else
  		{
  			return false;
  		}
	});
	
	$(document).on("click",".editbtn",function(){
		var soid=$("#soid").val();
		var oid=$("#oid").val();
		var uid=$("#uid").val();
      
          var currentTD = $(this).closest('tr').find('.editqty');
          if ($(this).html() == 'Edit') {                  
              $.each(currentTD, function () {
              	//$(this).addClass("editborder");
                  //$(this).prop('contenteditable', true)
                  var v=$(this).text();
                  $(this).html("<input type='text' value='"+v+"' >");
              });
          } else if($(this).html() == 'Save'){
          	var id=$(this).attr("title");
             $.each(currentTD, function () {
                  
                  var qty=$(this).children().val();
                  var url="https://www.laundrybucket.co.in/lb-admin/api_updateitem.php?id="+id+"&qty="+qty+"&soid="+soid+"&oid="+oid+"&uid="+uid;
                 
                  window.location.href=url;
                
             });
            }
              else
              {
              	$.each(currentTD, function () {
                  $(this).prop('contenteditable', false)
              });
          }

          $(this).html($(this).html() == 'Edit' ? 'Save' : 'Edit')

      });


</script>
<div class="right_col" role="main">
	<div class="row">
		<div class="container">
			<div class="col-md-12 col-sm-12 col-xs-12" style="text-align: center;">
				<h2>Items Summary/Items Dashboard</h2>
				<input type="hidden" value="<?php echo $soid;?>" id="soid" />
				<input type="hidden" id="oid" value="<?php echo $oid;?>" />
				<input type="hidden" id="uid" value="<?php echo $uid;?>" />
			</div>
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
                               


                                                  <div class="x_content table-responsive" style="display: none;">
                                                  	
                                    <table id="example" class="table table-striped table-bordered responsive-utilities jambo_table">
                                        <thead>
                                            <tr class="headings">
                                                <!--
                                                <th>
                                                    <input type="checkbox" class="tableflat">
                                                </th>
                                                -->
                                               
												<th title="Click on id to view complete detail of cutomer">CustomerId </th>
												
                                                
                                               <th>Name </th> 
                                                <th>Email </th>
                                               
                                                <th>Mobile </th>
                                            </tr>
                                            
                                         
                                        </thead>

                                        <tbody>
                              
											<tr class="even pointer">
	                                              
	                                               <?php
                                             	$query="select * from  tblusers where UserId='$uid'";
													$res=mysql_query($query);
													$row1=mysql_fetch_array($res);
	                                               	?>
												     <td title="Click on this id to view complete detail of cutomer"><a href="reguserlist.php?uid=<?php echo $uid; ?>" style="color:black;display:block;"><?php echo $uid; ?></a></td>
												     
												      <td class=" "><?php echo $row1["UserFirstName"].' '.$row1["UserLastName"];?></td> <!-- if user name not exist in table tblusers then fetch username from tbl_orders-->
												      <td class=" "><?php echo $row1["UserEmail"];?> </td>
	                                               
	                                                <td class=" "><?php echo  $row1["UserPhone"];?>  </td>
	                                     
	                                                 		 </tr>
															 
												
                                            
                                        </tbody>

                                    </table>
                                    
                                    	                                </div>

                                </div>
                            </div>
                            <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2><i class="fa fa-bars"></i> Order Detail </h2>
                                    <ul class="nav navbar-right panel_toolbox">
                                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                        </li>
                                        <!--<li><a class="close-link"><i class="fa fa-close"></i></a>  </li>-->
                                    </ul>
                                    <div class="clearfix"></div>
                                </div>
                               


                                                  <div class="x_content table-responsive" style="display: none;">
                                                  	
                                    <table id="example" class="table table-striped table-bordered responsive-utilities jambo_table">
                                        <thead>
                                            <tr class="headings">
                                                <!--
                                                <th>
                                                    <input type="checkbox" class="tableflat">
                                                </th>
                                                -->
                                               
												<th>Order Id </th>
												
                                                
                                               <th>PickUp Date </th> 
                                                <th>Order Amount </th>
                                               
                                                <th>Order Status</th>
                                                <th>Remarks</th>
                                            </tr>
                                            
                                         
                                        </thead>

                                        <tbody>
                              
											<tr class="even pointer">
	                                              
                                    <?php
                                    $query="select * from  tbl_orders where OrderId='$oid'";
									$res=mysql_query($query);
									$row1=mysql_fetch_array($res);
									$order_statusid=$row1["OrderStatusId"];	
									$result2=mysql_query("select * from tbl_orderstatus_id where order_status_id='$order_statusid'") or die(mysql_error());
	                             	$data2=mysql_fetch_array($result2);
								
                                   	?>
												     <td><?php echo $oid; ?></td>
												     
												      <td class=" "><?php echo $row1["Order_PickDate"];?></td> <!-- if user name not exist in table tblusers then fetch username from tbl_orders-->
												      <td class=" "><?php echo $row1["PayableAmount"];?> </td>
	                                               
	                                                <td class=" "><?php echo  $data2["order_status_text"];?>  </td>
	                                                <td class=" "><?php echo  $row1["Remarks"];?>  </td>
	                                     
	                                                 		 </tr>
															 
												
                                            
                                        </tbody>

                                    </table>
                                    
                                    	                                </div>

                                </div>
                            </div>
                            
                            
              <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2><i class="fa fa-bars"></i> Sub Order Detail </h2>
                                    <ul class="nav navbar-right panel_toolbox">
                                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                        </li>
                                        <!--<li><a class="close-link"><i class="fa fa-close"></i></a>  </li>-->
                                    </ul>
                                    <div class="clearfix"></div>
                                </div>
                               


                                                  <div class="x_content table-responsive" style="display: none;">
                                                  	
                                    <table id="example" class="table table-striped table-bordered responsive-utilities jambo_table">
                                        <thead>
                                            <tr class="headings">
                                                <!--
                                                <th>
                                                    <input type="checkbox" class="tableflat">
                                                </th>
                                                -->
                                               
												<th>Sub Order Id </th>
												<th>Order Type</th>
												<th>Delivery Type</th>
												<th>Delivery Date</th>
                                                <th>Delivery Address</th>
                                                 <th>Delivery Status</th>
                                                
                                               <th>Payable Amount</th>
                                               <th>Remarks</th>
                                             
                                            </tr>
                                            
                                         
                                        </thead>

                                        <tbody>
                              <?php
			$res=mysql_query("select * from tbl_suborders where OrderId='$oid' and UserId='$uid' and SubOrderId='$soid'") or die(mysql_error());
			if(mysql_affected_rows())
			{
				$row=mysql_fetch_array($res);
					$ordertype_id=$row['OrderTypeId'];
					$deliverytype_id=$row['DeliveryTypeId'];
					$deliverystatus_id=$row['DeliveryStatusId'];
					$result1=mysql_query("select * from tbl_services where ServiceId='$ordertype_id'") or die(mysql_error());
					$row1=mysql_fetch_array($result1);
					$result2=mysql_query("select * from tbl_deliverytypes where DeliveryId='$deliverytype_id'") or die(mysql_error());
					$row2=mysql_fetch_array($result2);
					$result3=mysql_query("select * from tbl_orderstatus_id where order_status_id='$deliverystatus_id'") or die(mysql_error());
					$row3=mysql_fetch_array($result3);
			?>
											<tr class="even pointer">
	                                              
                                  
												     <td><?php echo $row['SubOrderId'];?></td>
												     
												      <td class=" "><?php echo $row1['ServiceName'];?></td> <!-- if user name not exist in table tblusers then fetch username from tbl_orders-->
												      <td class=" "><?php echo $row2['DeliveryTitle'];?> </td>
	                                               
	                                                <td class=" "><?php echo $row['DeliveryDate'];?></td>
	                                                <td class=" "><?php echo $row['DeliveryAddress'];?> </td>
	                                                <td><?php echo $row3['order_status_text'];?></td>
	                                                <td><?php echo $row['PayableAmount'];?></td>
	                                                <td><?php echo $row['Remarks'];?></td>
	                                    
	                                                 		 </tr>
															 
						<?php
						}
						
						?>						
                                            
                                        </tbody>

                                    </table>
                                    
                                    	                                </div>

                                </div>
                            </div>



<div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2><i class="fa fa-bars"></i> Items Detail </h2>
                                    <ul class="nav navbar-right panel_toolbox">
                                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                        </li>
                                        <!--<li><a class="close-link"><i class="fa fa-close"></i></a>  </li>-->
                                    </ul>
                                    <div class="clearfix"></div>
                                </div>


                              <div class="x_content table-responsive">
                              	<a href="create_suborder.php?oid=<?php echo $oid;?>&uid=<?php echo $uid;?>&soid=<?php echo $soid;?>&edit=2"><button class="btn btn-primary">Add Items</button></a>
                              	
                                    <table id="example" class="table table-striped table-bordered responsive-utilities jambo_table">
                                        <thead>
                                            <tr class="headings">
                                                <!--
                                                <th>
                                                    <input type="checkbox" class="tableflat">
                                                </th>
                                                -->
                                               
												<th>Item Id </th>
												<th>Item Name</th>
												<th>Item Rate</th>
												<th>Quantity</th>
                                                <th>Total Amount</th>
                                               
                                               <th>Service Category</th>
                                               <th>Price Unit</th>
                                             <th>Action</th>
                                            </tr>
                                            
                                         
                                        </thead>

                                        <tbody>
                              <?php
			$res=mysql_query("select * from tbl_suborders_items where OrderId='$oid' and UserId='$uid' and SubOrderId='$soid'") or die(mysql_error());
			if(mysql_affected_rows())
			{
				while($row=mysql_fetch_array($res))
				{
					$item_id=$row['ItemId'];
					$item_name=$row['ItemName'];
					$item_rate=$row['ItemRate'];
					$qty=$row['Qty'];
					$total=$row['TotalAmount'];
					$result1=mysql_query("select * from tbl_services_itemsprice where ItemId='$item_id'") or die(mysql_error());
					$row1=mysql_fetch_array($result1);
					$servicecatid=$row1['ServiceCatId'];
					$priceunit=$row1['PriceUnit'];
					$result2=mysql_query("select * from tbl_priceunit where UnitId='$priceunit'") or die(mysql_error());
					$row2=mysql_fetch_array($result2);
					$result3=mysql_query("select * from tbl_services_category where ServiceCatId='$servicecatid'") or die(mysql_error());
					$row3=mysql_fetch_array($result3);
			?>
											<tr class="even pointer">
	                                              
                                  
												     <td><?php echo $item_id;?></td>
												     
												      <td class=" "><?php echo $item_name;?></td> <!-- if user name not exist in table tblusers then fetch username from tbl_orders-->
												      <td class=" "><?php echo $item_rate;?> </td>
	                                               
	                                                <td class="editqty"><?php echo $qty;?></td>
	                                                <td class=" "><?php echo $total;?> </td>
	                                                <td><?php echo $row3['ServiceCatName'];?></td>
	                                                <td><?php echo $row2['UnitName'];?></td>
	                                                <td><button class="btn btn-primary editbtn" title="<?php echo $row['srno'];?>">Edit</button>
	                                                	<button class="btn btn-danger btndel" title="<?php echo $row['srno'];?>">Delete</button></td>
	                                    
	                                                 		 </tr>
															 
						<?php
						}
						}
						?>						
                                            
                                        </tbody>

                                    </table>
                                    
                                    	                                </div>

                                </div>
                            </div>
			
			<!--<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="row">
			<?php
			$res=mysql_query("select * from tbl_suborders where OrderId='$oid' and UserId='$uid'") or die(mysql_error());
			if(mysql_affected_rows())
			{
				while($row=mysql_fetch_array($res))
				{
					$ordertype_id=$row['OrderTypeId'];
					$deliverytype_id=$row['DeliveryTypeId'];
					$result1=mysql_query("select * from tbl_services where ServiceId='$ordertype_id'") or die(mysql_error());
					$row1=mysql_fetch_array($result1);
					$result2=mysql_query("select * from tbl_deliverytypes where DeliveryId='$deliverytype_id'") or die(mysql_error());
					$row2=mysql_fetch_array($result2);
			?>
			<div class="col-md-4 col-sm-6 col-xs-12">
				<div class="col-md-12 col-sm-12 col-xs-12" style="border: 1px solid #c0c0c0; padding:5px;">
				<table class="table">
					<tr>
						<td>SubOrder Id : </td>
						<td><?php echo $row['SubOrderId'];?></td>
					</tr>
					<tr>
						<td>Order Type : </td>
						<td><?php echo $row1['ServiceName'];?></td>
					</tr>
					<tr>
						<td>Delivery Type : </td>
						<td><?php echo $row2['DeliveryTitle'];?></td>
					</tr>
					<tr>
						<td>Delivery Date : </td>
						<td><?php echo $row['DeliveryDate'];?></td>
					</tr>
					<tr>
						<td>Delivery Address : </td>
						<td><?php echo $row['DeliveryAddress'];?></td>
					</tr>
					<tr>
						<td>Payable Amount : </td>
						<td><?php echo $row['PayableAmount'];?></td>
					</tr>
				</table>
				</div>
			</div>
			<?php
				}
			}			
			?>
			</div>
			</div>-->
		</div>
	</div>
</div>
<?php
include 'footer.php';

?>