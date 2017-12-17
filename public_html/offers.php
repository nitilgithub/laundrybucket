<?php include('header.php');?>
 <title>Best laundry service & Laundry pickup service in Indirapuram </title> 
 <style>
 	.shape{	
	border-style: solid; border-width: 0 75px 45px 0; float:right; height: 0px; width: 0px;
	-ms-transform:rotate(360deg); /* IE 9 */
	-o-transform: rotate(360deg);  /* Opera 10.5 */
	-webkit-transform:rotate(360deg); /* Safari and Chrome */
	transform:rotate(360deg);
}
.offer{
	background:#fff; border:1px solid #ddd; box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);  overflow:hidden;
}
.offer-radius{
	border-radius:7px;
}
.offer-danger {	border-color: #d9534f; }
.offer-danger .shape{
	border-color: transparent #d9534f transparent transparent;
	border-color: rgba(255,255,255,0) #d9534f rgba(255,255,255,0) rgba(255,255,255,0);
}
.offer-success {	border-color: #5cb85c; }
.offer-success .shape{
	border-color: transparent #5cb85c transparent transparent;
	border-color: rgba(255,255,255,0) #5cb85c rgba(255,255,255,0) rgba(255,255,255,0);
}
.offer-default {	border-color: #999999; }
.offer-default .shape{
	border-color: transparent #999999 transparent transparent;
	border-color: rgba(255,255,255,0) #999999 rgba(255,255,255,0) rgba(255,255,255,0);
}
.offer-primary {	border-color: #428bca; }
.offer-primary .shape{
	border-color: transparent #428bca transparent transparent;
	border-color: rgba(255,255,255,0) #428bca rgba(255,255,255,0) rgba(255,255,255,0);
}
.offer-info {	border-color: #5bc0de; }
.offer-info .shape{
	border-color: transparent #5bc0de transparent transparent;
	border-color: rgba(255,255,255,0) #5bc0de rgba(255,255,255,0) rgba(255,255,255,0);
}
.offer-warning {	border-color: #f0ad4e; }
.offer-warning .shape{
	border-color: transparent #f0ad4e transparent transparent;
	border-color: rgba(255,255,255,0) #f0ad4e rgba(255,255,255,0) rgba(255,255,255,0);
}

.shape-text{
	color:#fff; font-size:12px; font-weight:bold; position:relative; right:-40px; top:2px; white-space: nowrap;
	-ms-transform:rotate(30deg); /* IE 9 */
	-o-transform: rotate(360deg);  /* Opera 10.5 */
	-webkit-transform:rotate(30deg); /* Safari and Chrome */
	transform:rotate(31deg);
}	
.offer-content{
	padding:10px;
}
#cofferdiv .btn{
	color:#fff !important;
}
 </style>
	<!-- BANNER -->
	<div class="section banner-page">
		<div class="container">
			<div class="row">
				<div class="col-sm-12 col-md-12">
					<div class="title-page">Offers</div>
					<ol class="breadcrumb">
						<li><a href="index.php">Home</a></li>
						<li class="active">Offers</li>
					</ol>
				</div>
			</div>
		</div> 
	</div>
	 
	<!-- ABOUT FEATURE -->
	<div class="section pad" style="padding-top: 20px;">
		<div class="container">

			<div class="row" id="packages">
				<h2 class="section-heading" style="padding-bottom: 10px;">
						Offers
					</h2>
				
				
				
					<div id="cofferdiv" class="col-md-12 col-xs-12">
						<div class="row">
							<?php
        	$result1=mysql_query("select * from tbl_combo_offer where STR_TO_DATE(expireDate, '%Y-%m-%d') > CURDATE() and isActive='1' order by offerId")or die(mysql_error());
			if(mysql_affected_rows())
			{
				$i=0;
				$rcount=mysql_num_rows($result1);
				$classname = array("default", "danger", "success", "primary","info", "warning","default", "danger", "success", "primary","info", "warning","default", "danger", "success", "primary","info", "warning","default", "danger", "success", "primary","info", "warning","default", "danger", "success", "primary","info", "warning" );
				
				 while(($row1=mysql_fetch_array($result1)) && $i<$rcount)
				 {
				 	
				 	?>

							<div class="col-sm-3 col-md-3 col-xs-12">
								<div class="offer offer-<?php echo $classname[$i]; ?>" style="height: 110px; ">
									<?php
									if($row1['offerPic']=="" || $row1['offerPic']==NULL){
										echo "<img src='img/logo.png' style='height:95% !important; width:100%;'>";
									}
									else {
										?>								
									<img src="https://cdn.laundrybucket.co.in/images/<?php echo $row1['offerPic']?>" style="height:95% !important; width:100%;" />
									<?php } ?>
								</div>
								<div class="offer offer-<?php echo $classname[$i]; ?>">
									<div class="shape">
										<div class="shape-text">
											<?php echo $row1['amount']."/-"; ?>								
										</div>
									</div>
									<div class="offer-content">
										<p>
											<b><?php echo $row1['offerName']; ?></b>
										<br>
										
											<?php echo $row1['offerDescription']; ?>
											<br>
											<b>Valid For: <?php echo $row1['purchaseValidity'];?> days after purchase</b>
										</p>
										<a href="order_offer.php?offer=<?php echo $row1['offerId']; ?>"><button class="btn btn-xs btn-<?php echo $classname[$i]; ?>" style="padding:5px;">Choose Offer</button></a>
									</div>
								</div>
							</div>
				<?php
	 				$i++;
					 }
					 }
					 ?>
			
						</div>
					</div>
					
					
					
					
				

			</div>
			



		</div>
	</div>
	 
	
	

<?php include('footercta.php');?>
		 
<?php include('footer.php');?>