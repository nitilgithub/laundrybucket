<?php
include 'header.php';
include 'connection.php';
$uloginnstatus=mysql_real_escape_string($_SESSION["useriid"]);
?>
<title>Best laundry service & Laundry pickup service in Ghaziabad, Indirapuram</title>
<meta name="description" content="Best dry cleaning and laundry service in Ghaziabad, we offer laundry pickup service in Vaishali and Indirapuram, at low cost">
<link rel="canonical" href="https://www.laundrybucket.co.in/laundry-service"/>

<div class="container">
	<div class="row">
		<div>&nbsp;</div>
		<div>&nbsp;</div>
		</div>
	</div>
	
<style>

	@media only screen and (max-device-width: 680px) {
    .mobile_part {
        display: none;
    }
}
</style>	

<div class="container-fluid">
 <div class="row" style="border: 1px solid #0080ff; margin-top:40px;">
					<div class="col-md-12" style="background-color: rgb(0,66,164);padding: 10px;color:white;">
					<center> <h3>Laundry & Ironing Prices<br/></h3></center>
						</div>
                           
                            
                        </div>
                        </div>

<section class="content-2 col-4 mbr-parallax-background mobile_part" id="features1-12" style="background-image: url(assets/images/tmg-article-main-wide-2x1940x868-151.jpg);">
    <div class="mbr-overlay" style="opacity: 0.9; background-color: rgb(34, 34, 34);"></div>
    <div class="container">
        <div class="row">
            <div>
                <div class="thumbnail">
                    <img alt="" src="assets/images/delivery256x256-168.png">
                    <div class="caption">
                        <div>
                            <h3>Free Pickup &amp; Delivery</h3>
                            <p>Free pick-up and delivery at your doorsteps so that you can enjoy hassle-free laundry services.</p>
                        </div>
                        
                    </div>
                </div>
            </div>
            <div>
                <div class="thumbnail">
                    <img alt="" src="assets/images/hanger256x256-196.png">
                    <div class="caption">
                        <div>
                            <h3>Custom Packaging</h3>
                            <p>Each garment is returned to you individually packaged to protect against dust, light and mildew.</p>
                        </div>
                        
                    </div>
                </div>
            </div>
            <div>
                <div class="thumbnail">
                    <img alt="" src="assets/images/24256x256-122.png">
                    <div class="caption">
                        <div>
                            <h3>24hr Delivery*</h3>
                            <p>We ensure that you get your garments laundered within committed time.</p>
                        </div>
                        
                    </div>
                </div>
            </div>
            <div>
                <div class="thumbnail">
                    <img alt="" src="assets/images/affordable256x256-149.png">
                    <div class="caption">
                        <div>
                            <h3>Affordable</h3>
                            <p>Laundrybucket is a quick, efficient and cost effective way to get your laundry done.</p>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>



<div class="container">
	
	<div class="row" style="margin-top: 25px">
		<div class="col-md-12">
			&nbsp;
			</div>
		</div>
	
	<div class="row" style="border: 1px solid #F17F42">
					<div class="col-md-3" style="background-color: #F17F42;padding: 20px;color:white">
						<center><h3> Standard Rates</h3></center> <!-- <?php echo $uloginnstatus; ?>-->
						
					</div>
					<div class="col-md-6" style="padding: 5px; color:#F17F42;">
						<center>
						<h3 class="text-center"> Rs. 80/- Per Kg</h3>
						<p>Minimum order is 4 kg</p>
						</center>
						</div>
					<div class="col-md-3 text-center" style="padding: 25px; color:white;">
						 <a href="ordernow.php?otype=standard_laundry" class="btn btn-lg" style="background-color:#F17F42;color:white;padding: 10px"> ORDER NOW</a> 
						</div>
				</div>
				
				<div>&nbsp;</div>
				<div class="row" style="border: 1px solid #0080ff">
					<div class="col-md-3" style="background-color: #0080ff;padding: 20px;color:white;">
					<center><h3> Trial</h3></center>
						</div>
					<div class="col-md-6" style="padding: 5px; color:#0080ff;">
						<center>
						<h3 class="text-center"> Rs. 70/- Per Kg</h3>
						<p>Minimum order is 4 kg</p>
						</center>
						</div>
					<div class="col-md-3 text-center" style="padding: 25px; color:white;">
						 <a href="ordernow.php?otype=trial_laundry" class="btn btn-lg" style="background-color:#0080ff;color:white;padding: 10px"> ORDER NOW</a> 
						</div>
				</div>
				
				
			
	</div>
<div>&nbsp;</div>
<div class="container-fluid">
<div class="row" style="border: 1px solid #0080ff; margin-top:40px;">
					<div class="col-md-12" style="background-color: rgb(0,66,164);padding: 10px;color:white;">
					<center> <h3>Laundry Power Plan <br/></h3></center>
						</div>
                           
                          </div>
                        </div>
                        

<section class="pricing-table-1 col-4 mbr-background" id="pricing-table1-11" style="background-image: url(assets/images/headerphoto2980x352-160.jpg);">
   
    <div class="mbr-overlay" style="opacity: 0.5; background-color: rgb(34, 34, 34);"></div>


    <div class="container">
    	
        <div class="row">
            <div>
            	<?php
        	$result2=mysql_query("select * from tbl_subscriptions_old where subs_name ='Laundry10'")or die(mysql_error());
			if(mysql_affected_rows())
			{
				$row2=mysql_fetch_array($result2);
			
        	?>
                <div class="plan green">
                    <h3 ><?php echo $row2["subs_name"];?></h3>
                    <div class="price">
                    <p style="width: 100%; border: 1px solid rgb(122, 198, 115); border-radius: 80px; padding-left: 20%; background-color: rgb(122, 198, 115);">
                    	
                        <strong style="color:white"><span><strong> &nbsp;&nbsp;&#8377;<?php echo $row2["subs_cost"]; ?> </strong></span>
                        <br/>
                        
                        </strong>
                   
                    </p>
                    </div> 
                    <div>
                   <ul>
                   	<li><strong>Weight <?php echo $row2["subs_wt"]; ?> Kg</strong></li>
                   	<li><strong> Monthly Package</strong></li>
                    <li><strong> 20% discount on 1st month</strong></li>
                    <li><strong> Laundry and Steam Ironing</strong></li>
                   	<li><strong>Maximum <?php echo $row2["subs_maxpickup"]; ?> Times Pickup</strong></li>
                   	<li><strong style="color:  rgb(122, 198, 115);">Billing Discount Offer </strong></li>
                   	<li><strong>6 Month 10% </strong></li>
                   	<li><strong>Annual 20%</strong></li>
                   	
                   	</ul>
                   	</div>
                    <p><a href="subscribenow.php?o=subscribe&s=<?php echo $row2["subs_id"];?>" class="btn btn-success">SUBSCRIBE NOW</a></p>
                </div>
                <?php
			}
                ?>
            </div>
            
            <div>
            	<?php
        	$result3=mysql_query("select * from tbl_subscriptions_old where subs_name='Laundry15'")or die(mysql_error());
			if(mysql_affected_rows())
			{
			 $row3=mysql_fetch_array($result3);
        	?>
                 <div class="plan orange favorite">
                    <h3 ><?php echo $row3["subs_name"];?></h3>
                    <div class="price">
                    <p style="width:100%;border: 1px solid rgb(250, 175, 64); border-radius: 80px; padding-left: 20%; background-color:rgb(250, 175, 64);">
                    	
                        <strong style="color:white"><span><strong> &nbsp;&nbsp;&#8377;<?php echo $row3["subs_cost"]; ?> </strong></span>
                        <br/>
                        </strong>
                   
                    </p>
                    </div> 
                    <div><ul>
                    <li><strong>Weight <?php echo $row3["subs_wt"]; ?> Kg</strong></li>
                    <li><strong> Monthly Package</strong></li>
                     <li><strong> 25% discount on 1st month</strong></li>
                    <li><strong> Laundry and Steam Ironing</strong></li>
                   	<li><strong>Maximum <?php echo $row3["subs_maxpickup"]; ?>  Times Pickup</strong></li>
                   	<li><strong style="color:  rgb(250, 175, 64);">Billing Discount Offer </strong></li>
                   	<li><strong>6 Month 10% </strong></li>
                   	<li><strong>Annual 20%</strong></li>
                   	
                    	</ul></div>
                    
                    <p><a href="subscribenow.php?o=subscribe&s=<?php echo $row3["subs_id"];?>"  style="background-color:rgb(250, 175, 64); border-color: rgb(250, 175, 64)" class="btn btn-success">SUBSCRIBE NOW</a></p>
                </div>
            </div>
            <?php
            }
            ?>
            
            
            <div>
            	<?php
        	$result4=mysql_query("select * from tbl_subscriptions_old where subs_name='Laundry25'")or die(mysql_error());
			if(mysql_affected_rows())
			{
				 $row4=mysql_fetch_array($result4);
			
        	?>
                <div class="plan blue favorite">
                    <h3 > <?php echo $row4["subs_name"];?> </h3>
                   <div class="price">
                    <p style="width:100%;border: 1px solid rgb(39, 170, 224); border-radius: 80px; padding-left: 20%; background-color:rgb(39, 170, 224);">
                    	
                        <strong style="color:white"><span><strong> &nbsp;&nbsp;&#8377;<?php echo $row4["subs_cost"]; ?> </strong></span>
                        <br/>
                       
                        </strong>
                   
                    </p>
                    </div> 
                    <div><ul>
                    	<li><strong>Weight <?php echo $row4["subs_wt"]; ?> Kg</strong></li>
                    	<li><strong> Monthly Package</strong></li>
                         <li><strong> 25% discount on 1st month</strong></li>
                    <li><strong> Laundry and Steam Ironing</strong></li>
                   	<li><strong>Maximum <?php echo $row4["subs_maxpickup"];?> Times Pickup</strong></li>
                   	<li><strong style="color:  rgb(39, 170, 224);">Billing Discount Offer </strong></li>
                   	<li><strong>6 Month 15% </strong></li>
                   	<li><strong>Annual 25%</strong></li>
                    	</ul></div>
                    <p><a href="subscribenow.php?o=subscribe&s=<?php echo $row4["subs_id"];?>" style="border-color:rgb(39, 170, 224);background-color: rgb(39, 170, 224); " class="btn btn-success">SUBSCRIBE NOW</a></p>
                </div>
                 <?php
            }
            ?>
            </div>
            <div>
            	<?php
        	$result5=mysql_query("select * from tbl_subscriptions_old where subs_name='Laundry50'")or die(mysql_error());
			if(mysql_affected_rows())
			{
				 $row5=mysql_fetch_array($result5);
			
        	?>
                <div class="plan green">
                    <h3> <?php echo $row5["subs_name"];?> </h3>
                   
                    <div class="price">
                    <p style="width: 100%; padding-left: 20%; border: 1px solid rgb(122, 198, 115); border-radius: 80px; background-color:rgb(122, 198, 115);">

                        <strong style="color:white"><span><strong> &nbsp;&nbsp;&#8377;<?php echo $row5["subs_cost"]; ?> </strong></span>
                        <br/>
                        
                        </strong>
                   
                    </p>
                    </div> 
                    <div>
                    	<ul>
                    		<li><strong>Weight <?php echo $row5["subs_wt"]; ?> Kg</strong></li>
                    		<li><strong> Monthly Package</strong></li>
                             <li><strong> 25% discount on 1st month</strong></li>
                    <li><strong> Laundry and Steam Ironing</strong></li>
                   	<li><strong>Maximum <?php echo $row5["subs_maxpickup"];?>  Times Pickup</strong></li>
                   	<li><strong style="color:  rgb(122, 198, 115);">Billing Discount Offer </strong></li>
                   	<li><strong>6 Month 15% </strong></li>
                   	<li><strong>Annual 25%</strong></li>
                    		</ul></div>
                    <p><a href="subscribenow.php?o=subscribe&s=<?php echo $row5["subs_id"];?>" class="btn btn-success">SUBSCRIBE NOW</a></p>
                </div>
                 <?php
            }
            ?>
            </div>
           
           
           
    	
    	
           
        </div>
    </div>
</section>
<div>&nbsp;</div>
<section class="mbr-section mbr-section--relative mbr-parallax-background" id="msg-box4-23">
    <div class="mbr-overlay" style="opacity: 0.8; background-color:#f7f7f7"></div>
    <div class="mbr-section__container mbr-section__container--isolated container" style="padding-bottom: 40px;padding-top: 33px;">
        <div class="row">
            <div class="mbr-box mbr-box--fixed mbr-box--adapted">
                
                <div class="mbr-box__magnet mbr-class-mbr-box__magnet--center-left col-sm-6 mbr-section__right">
                    <div class="mbr-section__container mbr-section__container--middle" style="padding-bottom: 0px">
                        <div class="mbr-header mbr-header--auto-align mbr-header--wysiwyg" style="margin-top: 0px">
                            <p>Please call us if you have order more than 100 kg on monthly basis, we may be able to give you corporate rates.</p>
                            <p>Terms &amp; Conditions:</p>
                            <ul>
                            	<li>Minimum order is 4 kg for trial and standard orders</li>
                            	<li>Minimum order does not apply on packages</li>
                            </ul>
                            
                        </div>
                    </div>
                    
                    
                </div>
                
            </div>
        </div>
    </div>
</section>

<?php
include 'footer.php';
?>