<?php include('header.php');
$uid=mysql_real_escape_string($_SESSION["uid"]);
?>
<title>Best laundry service & Laundry pickup service in Indirapuram </title> 

<style>
	.mybtn{color:#fff; padding:5px; font-weight: normal;}
</style>
	<!-- BANNER -->
	<div class="section banner-page">
		<div class="container">
			<div class="row">
				<div class="col-sm-12 col-md-12">
					<div class="title-page">My Subscriptions</div>
					<ol class="breadcrumb">
						<li><a href="index.php">Home</a></li>
						<li class="active">My Subscriptions</li>
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
					
					<div class="single-page row" id="mysubscription">
						
						<ul class="nav nav-tabs">
						  <li class="active"><a data-toggle="tab" href="#current">Current Subscriptions</a></li>
						  <li><a data-toggle="tab" href="#previous">Previous Subscriptions</a></li>
						 
						</ul>
						<br>
						<div class="tab-content">
							<div id="current" class="tab-pane fade in active">
								<div class="row">
									<?php
		
									if(isset($_GET["successmsg"]))
									{
										echo "<script type='text/javascript'> alert('Your Subscription Cancelled Successfully');</script>";
										
									}
									elseif (isset($_GET["errmsg"])) {
										echo "<script type='text/javascript'> alert('Please Try Later');</script>";
									}
								
								
									if(isset($_GET["ordersuccess"]))
									{
										echo "<script type='text/javascript'> alert('Your Subscription Order Placed Successfully');
										window.location.href='usersubscription.php';
										</script>";
										
									}
									elseif (isset($_GET["orderfail"])) {
										echo "<script type='text/javascript'> 
										alert('Please Try Later');
										window.location.href='usersubscription.php';
										</script>";
									}
								
								?>
								<?php
									/* code start for checking if any subscrbed package expired or not , if expired then 1stly update status to expire and then diplay other unexpired packages*/
									
									
									$todaydate = strtotime("Now");
									
									 $check_subs_query="select * from tbl_usersubscriptions WHERE (UserId='$uid'  AND subs_status!='expired')";
									$result=mysql_query($check_subs_query);
									if(mysql_num_rows($result))
									{
										while($row=mysql_fetch_array($result))
												{
														
													$next_renewal_date=strtotime($row["next_renewal"]);
													$id=$row["0"];
													
													 if($next_renewal_date<$todaydate)
												    {
												  
																  $result1=mysql_query("update tbl_usersubscriptions SET subs_status='expired' where (UserId='$uid' AND srno='$id')");
											
												    }
										
												}   
									
									            show_currentsubscription();
									}
									else
										{
											show_currentsubscription();
							
										}
										
									
									?>
									<?php
									function show_currentsubscription()
									{
									$uid=mysql_real_escape_string($_SESSION["uid"]);
											$result1=mysql_query("select * from tbl_usersubscriptions where UserId='$uid' and (subs_status='activated' or subs_status='inactive')order by srno desc") or die(mysql_error());
								if(mysql_affected_rows())
								{
									while($row1=mysql_fetch_array($result1))
									{
										$id=$row1["srno"];
										$usubs_id=$row1["subs_id"];
										
										$todaydate = date('F d, Y');
										$start_date=$row1["start_date"];
										$next_renewal=$row1["next_renewal"];
									
									$last_renewal=date('F d, Y', strtotime('-1 month', strtotime($next_renewal)));
									
									
									$used_wt=$row1["used_weight"];
									
								    $subs_status=$row1["subs_status"];
									//$last_renewal.'-1 month');
									
										
									?>
									
									<div class="col-sm-4 col-md-4 col-xs-12">
									
									<div class="panel panel-pricing">
									<header class="panel-heading">
									<?php
								 
									
									$result2=mysql_query("select * from tbl_subscriptions where subs_id='$usubs_id'") or die(mysql_error());
									
									if(mysql_affected_rows())
								{
									$row2=mysql_fetch_array($result2);
									$subs_name=$row2["subs_name"];
									$subs_weight=$row2["subs_wt"];
									
									$pending_weight=$subs_weight-$used_wt;
									
									?>
									
									<h3 class="text-center"> <?php echo $subs_name; ?> </h3>
									</header>
									<div class="panel-body">
									<table class="table table-striped">
										<tbody>
										<tr><td>Start Date</td><td><?php echo $start_date; ?></td></tr>
										<tr><td>Next Renewal Date</td><td><?php echo $next_renewal; ?></td></tr>
										<tr><td>Last Renewal Date</td><td><?php echo $last_renewal; ?></td></tr>
									
										<tr><td>Washed</td><td><?php echo $used_wt; ?> Kg</td></tr>
									
										<tr><td>Pending</td><td><?php echo $pending_weight;?> Kg</td></tr>
									
										<tr><td>Status</td><td><?php echo $subs_status; ?> </td></tr>
									
									
									</tbody>
									</table>
									
									</div>
									<div class="panel-footer">
									
										<a href="cancel_usersubscription.php?id=<?php echo $id; ?>&subs_name=<?php echo $subs_name; ?>" class="btn btn-danger mybtn"> Cancel Subscription</a>
										<?php
								if($subs_status=='activated')
								{
								?>
										<a href="usersubscription_orders.php?id=<?php echo $id; ?>" class="btn btn-success mybtn"> Place Order</a>
									<?php	
								}
								else {
									?>
									
										<a href="#" class="btn btn-success disabled mybtn"> Place Order</a>
										
									<?php
								}
								?>	
									</div>
									</div>
								
								
								
									<?php
								}
								?>
								</div>
									
								<?php
								}
								}
										}
								?>
								
								
								</div>
							</div>
							
							<div id="previous" class="tab-pane fade">
								<div class="row">
									<?php
									/* code start for checking if any subscrbed package expired or not , if expired then 1stly update status to expire and then diplay other unexpired packages*/
										$todaydate = strtotime("Now");
									$check_subs_query="select * from tbl_usersubscriptions WHERE (UserId='$uid'  AND subs_status!='expired')";
									$result=mysql_query($check_subs_query);
									if(mysql_num_rows($result))
									{
										while($row=mysql_fetch_array($result))
										{
												
											$next_renewal_date=strtotime($row["next_renewal"]);
											$id=$row["0"];
											
											 if($next_renewal_date<$todaydate)
										    {
										 
												$result1=mysql_query("update tbl_usersubscriptions SET subs_status='expired' where (UserId='$uid' AND srno='$id')");
									
										    }
								
										}   
									
									             previos_subscription();
									}
									else
									{
										 previos_subscription();
						
									}
										
							  
									?>
									<?php
									function previos_subscription()
									{
										$uid=mysql_real_escape_string($_SESSION["uid"]);
												$result1=mysql_query("select * from tbl_usersubscriptions where UserId='$uid' and (subs_status='cancel' or subs_status='expired') order by srno desc") or die(mysql_error());
									if(mysql_affected_rows())
									{
										while($row1=mysql_fetch_array($result1))
										{
											$next_renewal=$row1["next_renewal"];
										$last_renewal=date('F d, Y', strtotime('-1 month', strtotime($next_renewal)));
										?>
									
									<div class="col-sm-4 col-md-4 col-xs-12">
									
									<div class="panel panel-pricing">
									<header class="panel-heading">
									<?php
									$usubs_id=$row1["subs_id"];
									
									$result2=mysql_query("select * from tbl_subscriptions where subs_id='$usubs_id'") or die(mysql_error());
									
									if(mysql_affected_rows())
									{
									$row2=mysql_fetch_array($result2);
									$subs_name=$row2["subs_name"];
									
									
									?>
									
									<h3 class="text-center"> <?php echo $subs_name; ?> </h3>
									</header>
									<div class="panel-body">
									<table class="table table-striped">
										<tbody>
										<tr><td>Start Date</td><td><?php echo $row1["start_date"]; ?></td></tr>
										<tr><td>Next Renewal Date</td><td><?php echo $next_renewal; ?></td></tr>
										<tr><td>Last Renewal Date</td><td><?php echo $last_renewal; ?></td></tr>
									
										<tr><td>Washed</td><td><?php echo $row1["used_weight"]; ?> Kg</td></tr>
									
										<tr><td>Pending</td><td><?php echo $row2["subs_wt"]; ?> Kg</td></tr>
									
										<tr><td>Status</td><td><?php echo $row1["subs_status"]; ?> </td></tr>
									
									
									</tbody>
									</table>
									
									</div>
									<div class="panel-footer">
									
										
									</div>
									</div>
								
								
								
									<?php
								}
								?>
								</div>
									
								<?php
								}
								}
										}
								?>
								
								
								</div>
							</div>
							
							
						</div>
						
					 </div>

				</div>

			</div>
	
		</div>
	</div>

<?php include('footercta.php')?>
		
<?php include('footer.php');?>