<?php include('header.php');?>
 <title>Best laundry service & Laundry pickup service in Indirapuram </title> 
 

	<!-- BANNER -->
	<div class="section banner-page">
		<div class="container">
			<div class="row">
				<div class="col-sm-12 col-md-12">
					<div class="title-page">Offer Payment</div>
					<ol class="breadcrumb">
						<li><a href="index.php">Home</a></li>
						<li class="active">Offer Payment</li>
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
						Offer Payment
					</h2>
				
				<?php
				if(isset($_GET['id'])){
					$id=mysql_real_escape_string($_GET['id']);
					$arr=explode("-",$id);
					$orderid=$arr[0];
					$offerid=$arr[1];
					$userid=$arr[2];
					if($offerid==""){
						echo "<script>window.location.href='thanku.php'</script>";
					}
					
					$select=mysql_query("select * from tbl_combo_offer where offerId='$offerid'");
					$row=mysql_fetch_array($select);
					$amount=$row['amount'];
					
					
				
				?>
				
					<div id="" class="col-md-12 col-xs-12">
						<div class="row">
							<div class="col-md-8 col-md-offset-2 col-sm-12 col-xs-12">
								<p style="font-size: 16px;">Your order for selected offer <b><?php echo $row['offerName'];?></b> is successfully created. The offer payable amount is <b><?php echo $amount;?>/-</b></p>
							<a href="http://www.laundrybucket.co.in/paytmkit/pgRedirect.php?orderid=<?php echo $orderid;?>&userid=<?php echo $userid;?>&amt=<?php echo $amount;?>">
							<button class="btn btn-primary pull-left" id="btnPaynow">Pay Now with Paytm</button>
							</a>
							
							<!--<button class="btn btn-success pull-right" id="btnPaylater">Pay Later</button>-->
							</div>
						</div>
					</div>
					
					
					<?php } ?>
					
				

			</div>
			



		</div>
	</div>
	 
	


<?php include('footercta.php');?>
		 
<?php include('footer.php');?>
<script>
	$(document).on("click","#btnPaylater",function(){
		
		setTimeout(function(){
			window.location.href='thanku.php';
		},500);
	});
</script>	