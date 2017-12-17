<?php
include 'header.php';
?>

<?php
if(isset($_GET['loc']))
{
	$city=mysql_real_escape_string($_GET['loc']);
	
	
	$city=str_replace('-', ' ', $city);
	
	$location=mysql_real_escape_string($_GET['place']);
	

	$location=str_replace('-', ' ', $location);
	
	$service=mysql_real_escape_string($_GET['service']);
	$service=str_replace('-', ' ', $service);
	
	
	
?>
<link href="css/rightbtn.css" type="text/css" rel="stylesheet">
<title>alll links </title>
<meta name="description" content="laundry Bucket offers Dry cleaning & Laundry services at doorstep in <?php echo $location;?>, <?php echo $city;?>, <?php echo $service;?> services in your location  with  Home pickup and delivery Services">


<script>
	
</script>

<style>
	#frmcontact input,#frmcontact textarea	{ border: 1px solid #27aae0;}
	
</style>
<!--  Arrange a Call  code starts from here, included files rightbtn.css and rightbtn.js-->
<div id="request_free">
	<form method="post" id="frmcontact">
            <a class="anchor">
                <img alt="Arrange a Call" src="images/enquiry_btn.png"></a>
            <div id="slideOut">
                <div id="slideContent">
                    <a class="anchor closeInside">x</a>
                    <h3>Send Your Enquiry</h3>
                    <div class="form-group">
	<input type="text" name="name" id="name" value="" required=""  class="form-control text-capitalize" pattern=".{3, }" title="Username should only contain letters having minimum length 3 character. e.g. John" style="color:black" placeholder="Enter your Name" />
	
	</div>
	<div class="form-group">
    <input type="email"  name="email" id="email" value="" required="" style="color:black" class="form-control" placeholder="Enter your Email" />
    
   </div>
   <div class="form-group">
    <input type="text"  name="phone" id="phone" pattern="[7-9]{1}[0-9]{9}" title="Enter Valid mobile no" value="" required="" style="color:black" class="form-control" placeholder="Enter your Phone No." />
    
   </div>
   
  
    <div class="form-group">
    <textarea rows="3" name="message" id="message" class="form-control" style="color:black" placeholder=" Your Message"></textarea>
    </div>
    <input type="hidden" name="enqtype" value="Landing" /> 
    
	<input type="button" value="Send Your Message" name="submit" id="btnsendcontact" class="btn btn-info pull-right" title="Click here to submit your message!" />
	

                </div>
            </div>
     </form>
 </div>
 
<div class="container-fluid">
	
	<div class="row" style="margin-top: 120px;">
<div class="col-md-12 col-sm-12 col-xs-12">
	<h1 class="alert alert-info" align="center"><?php echo $service;?>  in <?php echo $location;?>, <?php echo $city;?></h1>
	
	<h3 style="text-align: center; letter-spacing: 2px;">Yes, we provide the services in your selected Area <?php echo $location;?>, <?php echo $city;?> and the prices are as below:</h3>
	



 <div class="row">
 	<div class="col-md-6 col-sm-12 col-xs-12" style="padding-left: 10px;padding-right: 10px;">
  	<div class="panel-group" id="accordion">
  	<?php
  	if($service=='Laundry' || $service=='Wash and Iron' || $service=='Wash and Fold' || $service=='Ironing' || $service=='Steam Ironing')
	{
		$servicename="Laundry";
	}			
	if($service=='Dry Cleaning')
	{
	$servicename="dryclean";
	}
	if($service=='Sofa Cleaning')
	{
		$servicename="SofaCleaning";
	}
  	$q=mysql_query("select * from tbl_services where ServiceName like '%$servicename%'");
  	$r=mysql_fetch_array($q);
  	$serviceid=$r['ServiceId'];
  	
  	
 	$res=mysql_query("select c.ServiceCatId, c.ServiceCatName from tbl_services_category as c join tbl_services_itemsprice as i on c.ServiceCatId=i.ServiceCatId where i.ServiceId='$serviceid' group by c.ServiceCatName  order by c.ServiceCatName");
  	while($row=mysql_fetch_array($res))
	{
		 $servicecatid=$row['ServiceCatId'];
		 
		?>
	
	<div class="panel panel-default firstopen">
	    <a href=““>://www.laundrybucket.co.in/Laundry-services-Sector-61-in-Noida</a>
    <div class="panel-heading">
      <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $row['ServiceCatId']?>">
        <?php echo $row['ServiceCatName']." Rate List";?><i class="glyphicon glyphicon-chevron-down" style="float: right;"></i></a>
      </h4>
    </div>
    <div id="collapse<?php echo $row['ServiceCatId']?>" class="panel-collapse collapse">
      <div class="panel-body">
      	<table class="table">
      		<tr>
      			<th>Service Item</th>
      			<th>Standard Price</th>
      			<th>Premium Price</th>
      		</tr>
      	<?php
      	$res1=mysql_query("select * from tbl_services_itemsprice where ServiceId='$serviceid' and ServiceCatId='$servicecatid'");
      	while($row1=mysql_fetch_array($res1))
		{
			$priceunit=$row1['PriceUnit'];
			$q1=mysql_query("select * from tbl_priceunit where UnitId='$priceunit'");
			$r1=mysql_fetch_array($q1);
			
      	?>
      	<tr>
      		<td><a href=““>://www.laundrybucket.co.in/Laundry-services-Sector-61-in-Noida</a></td>
      		<td></td>
      		<td></td>
      		<td></td>
      		<td></td>
      		<td></td>
      		<td></td>
      		<td></td>
      		<td></td>
      		<td></td>
      		<td></td>
      		<td></td>
      		<td></td>
      		<td></td>
      		<td></td>
      		<td></td>
      		<td></td>
      		<td></td>
      		<td></td>
      		<td></td>
      		<td></td>
      		<td></td>
      		<td></td>
      		<td></td>
      		<td></td>
      		<td></td>
      		<td></td>
      		<td></td>
      		<td></td>
      		<td></td>
      		<td></td>
      		<td></td>
      		<td></td>
      		<td></td>
      		<td></td>
      		<td></td>
      		<td></td>
      		<td></td>
      		<td></td>
      		<td></td>
      		<td></td>
      		<td></td>
      		<td></td>
      		<td></td>
      		<td></td>
      		<td></td>
      		<td></td>
      		<td></td><td></td>
      		<td></td>
      		<td></td>
      	</tr>
      	<?php
		}
      	?>
      	</table>
      </div>
    </div>
  </div>
  
		<?php
	}
  	?>
  	
  
  
</div>
</div>
<div class="col-md-6 hidden-sm hidden-xs" style="padding-left: 10px;padding-right: 10px;">

<figure class="mbr-figure mbr-figure--adapted mbr-figure--caption-inside-bottom mbr-figure--full-width">
<iframe class="mbr-embedded-video img-thumbnail" src="https://www.youtube.com/embed/VTHQEOpY2zY?rel=0" width="1280" height="620" frameborder="0" allowfullscreen></iframe>
</figure>
</div>


  </div>


</div>
</div>




	

 
 </div>
<?php	
}
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<script src="js/rightbtn.js"></script>
<?php
include 'footer.php';
?>

