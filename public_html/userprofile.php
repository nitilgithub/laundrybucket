<?php
include 'header.php';

$uid=mysql_real_escape_string($_SESSION["uid"]);

$result=mysql_query("select * from tblusers where UserId='$uid'");
$row=mysql_fetch_array($result);
?>
<title>Best laundry service & Laundry pickup service in Indirapuram </title> 




<!-- BANNER -->
	<div class="section banner-page">
		<div class="container">
			<div class="row">
				<div class="col-sm-12 col-md-12">
					<div class="title-page">My Profile</div>
					<ol class="breadcrumb">
						<li><a href="index.php">Home</a></li>
						<li class="active">My Profile</li>
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
							<li><a href="usersubscription.php">My Subscriptions</a></li>
							<li class="active"><a href="userprofile.php">My Profile</a></li>
							<li><a href="contact.php">Assist Me</a></li>
						</ul>
					</div>
					
					
				</div>

				<div class="col-sm-9 col-md-9">

					<div class="single-page">

<div class="col-md-12">
	<h3 class="text-center text-capitalize"> My Profile</h3>
	</div>	
	
	<div class="col-md-12"> &nbsp; </div>
	
	
	
	<div class="col-md-8 col-md-offset-2">
		<input type="hidden" value="<?php echo $uid; ?>" id="uid" />
		 <table class="table">
		 	<tr>
		 		<td colspan="2" align="center" style="font-size: 20px;"><?php echo $row['UserFirstName']." ".$row['UserLastName']; ?></td>
		 		
		 	</tr>
		 	<tr>
		 		<td>Phone Number </td>
		 		<td><?php echo $row['UserPhone'];?></td>
		 	</tr>
		 	<tr>
		 		<td>Email </td>
		 		<td><?php echo $row['UserEmail']; ?></td>
		 	</tr>
		 	<tr>
		 		<td>Address(s) </td>
		 		<td><?php //echo "1. ".$row['UserAddress']."<br>";
		 		
		 			$count=1;
					$q=mysql_query("select * from tblusers_address where UserId='$uid'");
					if(mysql_affected_rows())
					{
						while($r=mysql_fetch_array($q))
						{
							echo $count.". <span>".$r['Address']."</span><span class='fa fa-pencil editbtn pull-right' style='cursor:pointer;' title='".$r['id']."'>Edit</span><br>";
							$count++;
						}
					}
		 			?>
		 			<br>
		 			<button type="button" class="btn btn-info" data-toggle="modal" data-target="#mymodal">
						 <i class="fa fa-plus"></i> Add New Address
					</button>
		 		</td>
		 	</tr>
		 	<tr>
		 		<td>City </td>
		 		<td><?php echo $row['UserCity'];?></td>
		 	</tr>
		 </table>
 
 
 <!-- Modal -->
						<div class="modal fade" id="mymodal" tabindex="-1" role="dialog" aria-labelledby="mymodalTitle" aria-hidden="true">
						  <div class="modal-dialog" role="document">
						    <div class="modal-content">
						      <div class="modal-header">
						        <h5 class="modal-title" id="mymodalTitle">Add Address</h5>
						        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
						          <span aria-hidden="true">&times;</span>
						        </button>
						      </div>
						      <div class="modal-body">
						      	
						      
						       <input type="text" id="new_addr" class="form-control" />
						      </div>
						      <div class="modal-footer">
						        <button type="button" class="btn btn-secondary" data-dismiss="modal" id="btnCloseModal">Close</button>
						        <button type="button" class="btn btn-primary" id="btnSaveAddress">Save changes</button>
						      </div>
						    </div>
						  </div>
						</div>
<!--modal end-->
		</div>



		
	
</div>

</div>
</div>
</div>
</div>


<?php
include 'footercta.php';
include 'footer.php';

?>
<script>
	$(document).on("click",".editbtn",function(e){
		e.preventDefault();
		
		var uid=$("#uid").val();
      
          var currentTD = $(this).prev();
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
                   var newaddr=$(this).children().val();
                 
                  var url="https://www.laundrybucket.co.in/api_update_useraddress.php?id="+id+"&uid="+uid+"&newaddr="+newaddr;
                 
                 $.ajax({
		            type: 'GET',
		            url: url,
		            success:function (data) {
		            	$.each(data,function(i,field){
		            	
		            	var status=field.status;
		            	if(status==1)
		            	{
		             	location.reload();
             	
             			
		             	}
		             	else{
		             	alert('error in updation. Try again');
		             	}
		             
		             
		             });
		           }
		          });
                 
                  //window.location.href=url;
                
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



$(document).on("click","#btnSaveAddress",function(){
	var newaddr=$("#new_addr").val();
	var uid=$("#uid").val();
	  var url="https://www.laundrybucket.co.in/api_add_useraddress.php?uid="+uid+"&newaddr="+newaddr;
                 
     $.ajax({
        type: 'GET',
        url: url,
        success:function (data) {
        	$.each(data,function(i,field){
        	
        	var status=field.status;
        	if(status==1)
        	{
         	location.reload();
 	
 			
         	}
         	else{
         	alert('error in insertion. Try again');
         	}
         
         
         });
       }
      });
});
</script>