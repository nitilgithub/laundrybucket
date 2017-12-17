<?php include 'header.php';?>

<script>
	$(document).on("click",".viewitem",function(){
		var serviceid=$(this).attr("title");
		var servicecatid=$(this).attr("id");
		
		//alert(serviceid+servicecatid);
		
		$.ajax({
            type: 'GET',
            url: "https://www.laundrybucket.co.in/lb-admin/view_itemlist.php?service="+serviceid+"&servicecat="+servicecatid,
            success:function (data) {
            	$("#mytable").empty();
            	$("#mytable").append('<tr><th>Item Name</th><th>Standard Rate</th><th>Premium Rate</th><th>Price</th></tr>');
            	$.each(data,function(i,field){
            	
            	var status=field.status;
            	if(status==1)
            	{
             	
             	$("#mytable").append('<tr><td>'+field.ItemName+'</td><td>'+field.StandardRate+'</td><td>'+field.PremiumRate+'</td><td>'+field.UnitName+'</td></tr>');
             	$("#mytable").show();
             	window.scrollTo(0,300);
             	}
             	else{
             	alert('error . Try again');
             	}
             
             
             });
           }
          });
	});
	
</script>

            <!-- page content -->

            <div class="right_col" role="main">



                <div class="">

                    <div class="page-title">

                        <div class="title_left">

                            <h3> Items Rate List </h3>

                        </div>



                        

                    </div>

                    <div class="clearfix"></div>



                    <div class="">

                        <div class="col-md-12 col-sm-12 col-xs-12">

                            <div class="x_panel tile">

                                <div class="x_title">

                                    <h2><i class="fa fa-bars"></i>Items Detail </h2>

                                    <ul class="nav navbar-right panel_toolbox">

                                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>

                                        </li>

                                       

                                    </ul>

                                    <div class="clearfix"></div>

                                </div>

                                <div class="x_content table-responsive">

      

                    

 <div class="fixed-table-toolbar">

 	

  <div class="columns columns-left btn-group pull-left">

  	 <!-- <button id="remove" class="btn btn-danger" >

            <i class="glyphicon glyphicon-remove"></i> Delete

</button>-->

  </div>

  <div class="row">
  	<div class="panel-group" id="accordion">
  	<?php
  	//$res=mysql_query("select s.ServiceName, s.ServiceId, c.ServiceCatId, c.ServiceCatName from tbl_services as s join tbl_services_itemsprice as i on s.ServiceId=i.ServiceId join tbl_services_category as c on c.ServiceCatId=i.ServiceCatId group by s.ServiceName order by s.ServiceName,c.ServiceCatName");
  	
  	$res=mysql_query("select * from tbl_services order by ServiceName");
  	while($row=mysql_fetch_array($res))
	{
		 $serviceid=$row['ServiceId'];
		 
		?>
	
	<div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $row['ServiceId']?>">
        <?php echo $row['ServiceName'];?><i class="glyphicon glyphicon-chevron-down" style="float: right;"></i></a>
      </h4>
    </div>
    <div id="collapse<?php echo $row['ServiceId']?>" class="panel-collapse collapse">
      <div class="panel-body">
      	<?php
      	$res1=mysql_query("select c.ServiceCatId, c.ServiceCatName from tbl_services_category as c join tbl_services_itemsprice as i on c.ServiceCatId=i.ServiceCatId where i.ServiceId='$serviceid' group by c.ServiceCatName  order by c.ServiceCatName");
      	while($row1=mysql_fetch_array($res1))
		{
      	?>
      	<a href="#" id="<?php echo $row1['ServiceCatId'];?>" title="<?php echo $row['ServiceId'];?>" class="viewitem" style="color:#000;"><p><?php echo $row1['ServiceCatName'];?></p></a>
      	<?php
		}
      	?>
      </div>
    </div>
  </div>
  
		<?php
	}
  	?>
  	
  
  
</div>



  </div>

<div class="row">
	<table class="table" id="mytable" hidden>
		
		
	</table>
</div>

				


                                </div>

                            </div>

                        </div>





<?php include 'footer.php'; ?>