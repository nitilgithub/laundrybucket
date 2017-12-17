<?php
include 'header.php';
if(isset($_GET['userid']))
{
	
$uid=$_GET['userid'];	

?>
<style>
	@media screen and (max-width: 600px) {
table {width:100%;}
thead {display: none !important;}
tr:nth-of-type(2n) {background-color: inherit;}
tr td:first-child {background: #f0f0f0; font-weight:bold;font-size:1.3em;}
tbody td {display: block; }
tbody td:before { 
    content: attr(data-th); 
    display: block;
   	
  }
}
</style>

<div class="right_col" role="main">
	<div class="row">
		<div class="container">
			<div class="col-md-12 col-sm-12 col-xs-12" style="text-align: center;">
				<h2>Subscription History</h2>
				
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
                               


                                                  <div class="x_content table-responsive">
                                                  	
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
												     <td data-th="CustomerId" title="Click on this id to view complete detail of cutomer"><a href="reguserlist_new.php?uid=<?php echo $uid; ?>" style="color:black;display:block;"><?php echo $uid; ?></a></td>
												     
												      <td data-th="Name" class=" "><?php echo $row1["UserFirstName"].' '.$row1["UserLastName"];?></td> <!-- if user name not exist in table tblusers then fetch username from tbl_orders-->
												      <td data-th="Email" class=" "><?php echo $row1["UserEmail"];?> </td>
	                                               
	                                                <td data-th="Mobile" class=" "><?php echo  $row1["UserPhone"];?>  </td>
	                                     
	                                                 		 </tr>
															 
												
                                            
                                        </tbody>

                                    </table>
                                    
                                    	                                </div>

                                </div>
                            </div>
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
                                                <!--
                                                <th>
                                                    <input type="checkbox" class="tableflat">
                                                </th>
                                                -->
                                               
												<th>Id</th>
                                             
                                               <th>Subscription</th> 
                                               <th>Subscribe Date</th>
                                               <th>Start Date</th>
                                                <th>End Date </th>
                                                <th>Validity</th>
                                                <th>Used Weight</th>
                                                <th>Remaining Weight</th>
                                               <th>Used Pickup</th>
                                               <th>Remaining Pickup</th>
                                                <th>Status</th>
                                               
                                            </tr>
                                            
                                         
                                        </thead>

                                        <tbody>
                              
											
	                                              
                                    <?php
                                   $result=mysql_query("select * from tbl_usersubscriptions where UserId='$uid' order by srno DESC") or die(mysql_error());
										
                                       
		                               while($row=mysql_fetch_array($result))
									   {
									   	
										
										
										$subsid=$row["subs_id"];
										
									   	$query=mysql_query("select * from tbl_subscriptions where subs_id='$subsid'");
									   																					
									   	$rowss=mysql_fetch_array($query);
																														
									   	$subs_weight=$rowss['subs_wt'];	
																													
									   	if($subs_weight=="unlimited" || $subs_weight=="Unlimited")										
									   	{
									   														
									  $remainingweight="Unlimited";										
										}										
										
										else {
											$remainingweight=$subs_weight-$row['used_weight'];
										}
										
									   	
																																
											$date1=date_create($row['start_date']);
																					
											$date2=date_create($row['next_renewal']);
																						
											$diff=date_diff($date1,$date2);	
																					
											$validity=$diff->format("%a days");	
																																
											
										
										
							 $result1=mysql_query("select * from tblusers where UserId='$userid'") or die(mysql_error());
							              
										  $data=mysql_fetch_array($result1);
										  
										
										
							
							 $result2=mysql_query("select * from tbl_subscriptions where subs_id='$subsid'") or die(mysql_error());
							              
										  $data2=mysql_fetch_array($result2);
										  
										
										
						
										
                                   	?>
                                   	<tr class="even pointer">
												     <td data-th="Id"><?php echo $row["subs_id"]; ?></td>
												     
												      <td data-th="Subscription" class=" "><?php echo $data2["subs_name"];?></td> 
												      
												       <td data-th="Subscribe Date" class=" "><?php echo $row["subs_date"];?></td> 
												        <td data-th="Start Date" class=" "><?php echo $row['start_date'];?></td> 
												        
												      <td data-th="End Date" class=" "><?php echo $row['next_renewal'];?> </td>
												      <td data-th="Validity" class=" "><?php echo $validity;?> </td>
												      <td data-th="Used Weight" class=" "><?php echo $row['used_weight'];?> </td>
												      <td data-th="Remaining Weight" class=" "><?php echo $remainingweight;?> </td>
	                                               <td data-th="Used Pickup" class=" "><?php echo $row['max_pickup'];?> </td>
	                                               <td data-th="Remaining Pickup" class=" "><?php echo $rowss['subs_maxpickup']-$row['max_pickup'];?> </td>
	                                                <td data-th="Status" class=" "><?php echo  $row["subs_status"];?>  </td>
	                                              
	                                                 		 </tr>
															 
											<?php } ?>	
                                            
                                        </tbody>

                                    </table>
                                    
                                    	                                </div>

                                </div>
                            </div>
                            
                            
             
		</div>
	</div>
</div>
<?php
}
include 'footer.php';

?>