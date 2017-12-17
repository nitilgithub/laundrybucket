<?php
include 'header.php';
include 'connection.php';
if($_REQUEST["id"]!="")
{
	$_SESSION["bucket"]=$_SESSION["bucket"].",".$_REQUEST["id"];

}
if(isset($_GET["cat"]))
{
	$wearcat=mysql_real_escape_string($_GET["cat"]);
}
	?>
<!--
<title>Laundry Service & Dry Cleaning Rates | Laundry cleaning Services Rates in Noida</title>
<meta name="description" content="Best dry cleaning and laundry service rates , list here the rate of ironing and laundry cleaning service rates in noida Ghaziabad  ">
-->
<div class="container-fluid">
<div class="row" style="border: 1px solid #0080ff; margin-top:90px;">
					<div class="col-md-12" style="background-color: rgb(0,66,164);padding: 10px;color:white;">
					<center> <h3><?php echo $wearcat; ?>'s Wear Drycleaning Prices</h3></center>
						</div>
                        </div>
                        </div>

<div class="container"> <!--style="margin-top: -120px;"--> 
	
	
	<div class="row" style="background-color:#F0F8FF;">
		<div>&nbsp; </div>
		<div>&nbsp; </div>
		<div>&nbsp;</div>
		<div class="col-md-12">
			
			
		<ul class="nav nav-tabs nav-justified">
  <li role="presentation" class="active"><a href="drycleaning.php?cat=Men">Men's Wear Rate List</a>
  	
  </li>
  <li role="presentation" class="tab"><a href="drycleaning.php?cat=Women">Women's Wear Rate List</a></li>
  <li role="presentation" class="tab"><a href="drycleaning.php?cat=House Hold">House Hold</a></li>
  <!-- <li role="presentation" class="tab" ><a href="cart.php">My Bucket</a></li>-->  
</ul>
		
		</div>
	</div>
	
 
<!-- Top to bottom-->

 
 <div class="row" style="margin-top: 20px; background-color:#F0F8FF">
 	
 	
 		<?php
function fetch_ratelist()
{
	//$_SESSION['cart']=array();
	$wearcat=mysql_real_escape_string($_GET["cat"]);
	$result=mysql_query("select * from tbl_ratelist where category='$wearcat'") or die(mysql_error());
	if(mysql_affected_rows())
	{
		while($row=mysql_fetch_array($result))
		{
			?>


 <div class="col-sm-3 col-md-3 col-xs-6" style="margin-bottom: 20px;" >
 <div class="col-md-12 col-sm-12 col-xs-12" style="background-color: #F0F0F0;">
 <div class="row">
 
			<div class="col-md-12" align="center"><img src="drycleanimages/<?php echo $row[6];?>" width="100" height="100"></div>
			
			
			<div class="col-md-12 col-xs-12 col-sm-12" align="center"><strong><?php echo $row[1]; ?></strong></div>
			<div class="col-md-12 col-xs-12 col-sm-12" align="center">&#8377;<?php  echo $row[2]; ?> - &#8377;<?php echo $row[3]?></div>
				<div class="col-md-12 col-xs-12 col-sm-12" align="center" style="display: none;">Laundry: Call Us</div>
			<div class="col-md-12 col-xs-12 col-sm-12" align="center" style="display: none;">
				<a style="margin-left:-17px" href="cart_add.php?add=<?php echo $row[0]; ?>&type=<?php echo $row[7]; ?>" class="btn btn-primary btn-sm"> Put in Bucket</a>
				</div>
				
			


    </div>
 </div>
  </div>

		<?php
		}
	}
	
}
?>	
  	
  	
  	<div class="col-md-12" style="margin-top: 20px;"> 
<?php fetch_ratelist(); ?>
</div>


	
  
</div>
<!-- end Left to right-->
 
</div>

	

<section class="mbr-section" id="image2-22">
    <div class="mbr-section__container container mbr-section__container--isolated">
        <div class="row">
            <div class="col-sm-8 col-sm-offset-2">
                <figure class="mbr-figure mbr-figure--wysiwyg mbr-figure--full-width mbr-figure--caption-outside-bottom mbr-figure--no-bg">

                    
                    <figcaption class="mbr-figure__caption mbr-figure__caption--no-padding">
                        <small class="mbr-figure__caption-small">We are ready &nbsp;to Pick up&nbsp;<a href="ordernow.php">YOUR ORDER NOW</a></small>
                    </figcaption>
                </figure>
            </div>
        </div>
    </div>
</section>








<?php
include 'footer.php';
?>
