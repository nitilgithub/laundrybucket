<?php
include 'header.php';
//if(empty($_SESSION['current_user']))
//header('location:customer_info.php');
if(isset($_GET['oid']))
{
	
	$editId=$_GET['edit'];
	if($editId=='2')
	{?>
	
		<script>
		$(document).ready(function(){
			
			var orderid=$("#orderidhide").val();
			 var suborderid=$("#suborderidhide").val();
			 var userid=$("#getuid").val();
			 var ordertypeid=$("#ordercatid").val();
			$("#sorderid").val(orderid);
		$("#ssuborderid").val(suborderid);
		$("#ssuborderid").trigger('change');
		$("#suserid").val(userid);
		$("#sserviceid").val(ordertypeid);
		$("#sserviceid").trigger('change');
	 $("#additemform").show();
       $("#suborderdiv").show();
       $("#additemsshow").show();
       
      $("#quickordershow").hide();
       
        $("#collapse2").addClass("in");
			window.scrollTo(0, 1300);
		});
		
		</script>
			 
<?php	
	}
?>
<?php

$orderid=$_GET['oid'];
$res=mysql_query("select * from tbl_orders where OrderId='$orderid'") or die(mysql_error());
if(mysql_affected_rows())
{
	$row=mysql_fetch_array($res);
	if(isset($_GET['uid']))
	{
		$userid=$_GET['uid'];
	}
	else {
		$userid=$row['OrderUserId'];
	}
?>

<script>
	$(document).on("click",".btndel",function(){
		var id=$(this).attr('title');
		var soid=$("#ssuborderid").val();
		var oid=$("#sorderid").val();
		var uid=$("#suserid").val();
		var r=confirm("Do you really want to Delete this Item");
  		if(r==true)
  		{
  			$.ajax({
            type: 'GET',
            url: "https://www.laundrybucket.co.in/lb-admin/delete_item.php?id="+id+"&soid="+soid+"&oid="+oid+"&uid="+uid,
            success:function (data) {
            	$.each(data,function(i,field){
            	
            	var status=field.status;
            	if(status==1)
            	{
             	//location.reload();
             	
             	$("#ssuborderid").trigger("change");
             	}
             	else{
             	alert('error in deletion. Try again');
             	}
             
             
             });
           }
          });
          
  		// window.location.href="https://beta.laundrybucket.co.in/lb-admin/delete_item.php?id="+id+"&soid="+soid+"&oid="+oid+"&uid="+uid;
  		}
  		else
  		{
  			return false;
  		}
	});
	
	$(document).on("click",".editbtn",function(e){
		e.preventDefault();
		var soid=$("#ssuborderid").val();
		var oid=$("#sorderid").val();
		var uid=$("#suserid").val();
      
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
                 
                 $.ajax({
		            type: 'GET',
		            url: url,
		            success:function (data) {
		            	$.each(data,function(i,field){
		            	
		            	var status=field.status;
		            	if(status==1)
		            	{
		             	//location.reload();
             	
             			$("#ssuborderid").trigger("change");
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


</script>
<script>
      $(document).ready(function () {

        $('#btnAdd').on('click', function (e) {

          e.preventDefault();
			var x=$('#suborderform').serialize();
			console.log(x);
          $.ajax({
            type: 'GET',
            url: 'https://www.laundrybucket.co.in/lb-admin/api_createsuborder.php',
            data: $('#suborderform').serialize(),
            success:function (data) {
            	$.each(data,function(i,field){
            		
            	$("#sorderid").val(field.orderid);
            	
            	//$("#orderidhide").val(field.orderid);
            	//$("#orderidhide").trigger('change');
            	
            	$("#ssuborderid").val(field.suborderid);
            	$("#ssuborderid").trigger('change');
            	
            	$("#suborderidhide").val(field.suborderid);
            	
            	$("#suserid").val(field.userid);
            	$("#sserviceid").val(field.serviceid);
            	$("#sserviceid").trigger('change');
            	$("#ordercatid").val(field.serviceid);
            	var status=field.status;
            	if(status==1)
            	{
              //$("#additemform").show();
              //$("#suborderdiv").show();
              
              $("#hiddenbtns").show();
              
              alert("SubOrder Created Successfully");
             // $("#hidebtns1").hide();
             }
             });
            }
          });

        });


		$('#btnadditem').on('click', function (e) {

   		var x=$('#additemform').serialize();
   		console.log(x);
          $.ajax({
            type: 'POST',
            url: 'https://www.laundrybucket.co.in/lb-admin/api_additem.php',
            data: $('#additemform').serialize(),
            success:function (data) {
            	$.each(data,function(i,field){
            		var status=field.status;
            		
            		//$("#ssuborderid").val(field.suborderid);
            		
            	    $("#ssuborderid").trigger('change');
            		
            		if(status==1)
            		{
            			$("#itemname").val("");
            			$("#itemrate").val("");
            			$("#itemprice").val("");
            			$("#qty").val("");
            			$("#tprice").val("");
            			$(".servicecat").val("");
            			$("#descp").val("");
            			$("#priceunit").val("");
            		}
            		else
            		{
            			alert("error");
            		}
            		 //$("#additemform")[0].reset();
            	});
            	
            }
          });
e.preventDefault();

        });
        
        $('#btndone').on('click', function (e) {
        	e.preventDefault();
        	var x=$('#additemform').serialize();
			console.log(x);
			$.ajax({
            type: 'POST',
            url: 'https://www.laundrybucket.co.in/lb-admin/api_updateorder.php',
            data: $('#additemform').serialize(),
            success:function (data) {
            	$.each(data,function(i,field){
            		var status=field.status;
            		$("#orderidhide").val(field.orderid);
            	    $("#orderidhide").trigger('change');
            		
            		if(status==1)
            		{
            			$("#additemform")[0].reset();
        				$("#additemform").hide();
        				$("#my_select").val("-1");
        				$("#deliverydiv").hide(100);
        				$(".deliverbydiv").hide(100);
						$("#datepicker2").val("");
						$("#dfast").html("");
						$(".deliverytype").val("-1");
						$("#suborderdiv").hide();
						$(".deliverystatus").val("-1");
            		}
            		 //$("#additemform")[0].reset();
            	});
            	
            }
          });
        });

$('#btnUpdate').on('click', function (e) {

          e.preventDefault();
			
          $.ajax({
            type: 'POST',
            url: 'https://www.laundrybucket.co.in/lb-admin/api_updatesuborder.php',
            data: $('#suborderform1').serialize(),
            success:function (data) {
            	$.each(data,function(i,field){
            	$("#sorderid").val(field.orderid);
            	
            	//$("#orderidhide").val(field.orderid);
            	//$("#orderidhide").trigger('change');
            	
            	$("#ssuborderid").val(field.suborderid);
            	$("#ssuborderid").trigger('change');
            	$("#suserid").val(field.userid);
            	$("#sserviceid").val(field.serviceid);
            	$("#sserviceid").trigger('change');
            	var status=field.status;
            	//alert(field.serviceid);
            	if(status==1)
            	{
              //$("#additemform").show();
              //$("#suborderdiv").show();
              
              alert("Sub Order updated successfully");
              var x=confirm("Do you want to add items or change suborder total amount?");
              if(x==true)
              {
              	window.scroll(0,400);
              	$("#btnQuickadd").trigger('click');
              }
              else
              {
              	window.location.href="https://www.laundrybucket.co.in/lb-admin/allorder_list_new.php";
              }
             }
             });
            }
          });

        });


$(document).on("click","#btnQuickadd",function(e){
	 e.preventDefault();
	 var orderid=$("#orderidhide").val();
	 var suborderid=$("#suborderidhide").val();
	 var userid=$("#getuid").val();
	 var ordertypeid=$("#ordercatid").val();
	 
	 // var tpre = $('#taxpercent').val();
	 // console.log('Tax Precentage :'+tpre);
	 $("#sorderid").val(orderid);
		$("#ssuborderid").val(suborderid);
		$("#ssuborderid").trigger('change');
		$("#suserid").val(userid);
		$("#sserviceid").val(ordertypeid);
		$("#sserviceid").trigger('change');
	 $("#additemform").show();
       $("#suborderdiv").show();
       $("#quickordershow").show();
       $("#itemstotalselect").hide();
        $("#quicktotalselect").show();
       $("#quickradio").prop("checked", true);
        $("#itemradio").prop("checked", false);
       $("#quickradio").trigger('change');
       $("#collapse1").addClass("in");
       $("#collapse2").removeClass("in");
       $("#additemsshow").hide();
	 
});
$(document).on("click","#btnQuickadditems",function(e){
	 e.preventDefault();
	 var orderid=$("#orderidhide").val();
	 var suborderid=$("#suborderidhide").val();
	 var userid=$("#getuid").val();
	 var ordertypeid=$("#ordercatid").val();
	 $("#sorderid").val(orderid);
		$("#ssuborderid").val(suborderid);
		$("#ssuborderid").trigger('change');
		$("#suserid").val(userid);
		$("#sserviceid").val(ordertypeid);
		$("#sserviceid").trigger('change');
	 $("#additemform").show();
       $("#suborderdiv").show();
       $("#additemsshow").show();
       
      $("#quickordershow").hide();
       
        $("#collapse2").addClass("in");
	 
});

$(document).on("click","#btnadddiscount",function(){
	$("#quickordershow").show();
	$("#collapse1").addClass("in");
	 $("#quicktotalselect").hide();
       $("#itemstotalselect").show();
       $("#itemradio").prop("checked", true);
       $("#quickradio").prop("checked", false);
       $("#itemradio").trigger('change');
});

$(document).on("click","#quickordertab",function(){
	var suborderid=$("#suborderidhide").val();
	 $.ajax({
            type: 'GET',
            url: 'https://www.laundrybucket.co.in/lb-admin/api_getamttype.php?suboid='+suborderid,
            success:function (data) {
            	$.each(data,function(i,field){
            	
            	var status=field.status;
            	if(status==1)
            	{
             	if(field.amttype==1){
             	$("#quickradio").prop("checked", true);
             	$("#quickradio").trigger('change');
             	}
             	else{
             	$("#itemradio").prop("checked", true);
             	$("#itemradio").trigger('change');
             	}
             }
             else
             {
             	
             }
             });
            }
          });
});

$(document).on("change",".totalamttype",function(e){
	 if (this.checked) {
	var amttype=$(this).val();
	
	var suborderid=$("#ssuborderid").val();
	e.preventDefault();
			
          $.ajax({
            type: 'GET',
            url: 'https://www.laundrybucket.co.in/lb-admin/api_fetchamttype.php?amttype='+amttype+'&suboid='+suborderid,
            success:function (data) {
            	
            	$.each(data,function(i,field){
            	$("#subototalamt").val(field.totalamount);	
				$("#otherdiscount").val(field.ManualDiscount);	
				$("#subtaxamt").val(field.TaxableAmount);
				$("#taxpercent").val(field.TaxPercentage);
				$("#subtax").val(field.tax);
				$("#offerdiscounttotal").val(field.OfferDiscount);
				$("#subpayable").val(field.PayableAmount);
				$("#noofitems").val(field.totalItems);
            	var status=field.status;
            	if(status==1)
            	{
             
             }
             else
             {
             	alert('error');
             }
             });
            }
          });
         }
});


$(document).on("change",".refamt",function(e){
	 if (this.checked) {
	var ifref=$(this).val();
	if(ifref=='yes')
	{

var availablereferral=$("#availablereferral").val();
	var totalamt=$("#subototalamt").val();
	var taxpercent=$("#taxpercent").val();
	var subtaxamt=$("#subtaxamt").val();
var suborderid=$("#ssuborderid").val();
var userid=$("#suserid").val();

var url='https://www.laundrybucket.co.in/lb-admin/api_fetchamount_referral.php?totalamt='+totalamt+'&arefer='+availablereferral+'&taxpercent='+taxpercent+'&subtaxamt='+subtaxamt+'&suborderid='+suborderid+'&userid='+userid;
console.log(url);
e.preventDefault();

	$.ajax({
            type: 'GET',
            url: url,
            success:function (data) {
            	$.each(data,function(i,field){	
					
				
            	var status=field.status;
            	if(status==1)
            	{
            		$("#subtaxamt").val(field.taxableamt);
				
				$("#subtax").val(field.tax);
				$("#subpayable").val(field.payableamt);
             getofferdetail();
             }
             else if(status==2)
             {
             	alert("You have already used Referral Money on this Suborder");
             	 
             }
             else
             {
             	
             }
             });
            }
            
          });
	
         }
         
         }
});

/*$("#offercode").mousedown(function(e){
    e.preventDefault();

    var select = this;
    var scroll = select .scrollTop;

    e.target.selected = !e.target.selected;

    setTimeout(function(){select.scrollTop = scroll;}, 0);

    $(select ).focus();
}).mousemove(function(e){e.preventDefault()});*/

$(document).on("change","#offercode",function(e){
var offerid=$(this).val();
var totalamt=$("#subototalamt").val();
var otherdiscount=$("#otherdiscount").val();
var taxpercent=$("#taxpercent").val();
var subtaxamt=$("#subtaxamt").val();
var suborderid=$("#ssuborderid").val();
/*alert(offerid);
alert(totalamt);
alert(otherdiscount);
alert(taxpercent);*/
e.preventDefault();

	$.ajax({
            type: 'GET',
            url: 'https://www.laundrybucket.co.in/lb-admin/api_fetchamount.php?offerid='+offerid+'&totalamt='+totalamt+'&otherdiscount='+otherdiscount+'&taxpercent='+taxpercent+'&subtaxamt='+subtaxamt+'&suborderid='+suborderid,
            success:function (data) {
            	$.each(data,function(i,field){	
					
			
            	var status=field.status;
            	if(status==1)
            	{
            			$("#subtaxamt").val(field.taxableamt);
				$("#offerdiscounttotal").val(field.discount);
				$("#subtax").val(field.tax);
				$("#subpayable").val(field.payableamt);
             getofferdetail();
             }
             
             });
            }
            
          });
	
});

$(document).on("click",".removeoffer",function(e){
var offerid=$(this).attr("title");
var totalamt=$("#subototalamt").val();
var otherdiscount=$("#otherdiscount").val();
var taxpercent=$("#taxpercent").val();
var subtaxamt=$("#subtaxamt").val();
var suborderid=$("#ssuborderid").val();
$(this).hide(100);
$(this).prev().hide(100);
/*alert(offerid);
alert(totalamt);
alert(otherdiscount);
alert(taxpercent);*/
e.preventDefault();
	$.ajax({
            type: 'GET',
            url: 'https://www.laundrybucket.co.in/lb-admin/api_removeoffer.php?offerid='+offerid+'&totalamt='+totalamt+'&otherdiscount='+otherdiscount+'&taxpercent='+taxpercent+'&subtaxamt='+subtaxamt+'&suborderid='+suborderid,
            success:function (data) {
            	$.each(data,function(i,field){	
					
				
            	var status=field.status;
            	if(status==1)
            	{
             $("#subtaxamt").val(field.taxableamt);
				$("#offerdiscounttotal").val(field.discount);
				$("#subtax").val(field.tax);
				$("#subpayable").val(field.payableamt);
             }
            
             });
            }
            
          });
	
});

$(document).on("blur","#otherdiscount",function(e){
	var discount=$(this).val();
	var totalamt=$("#subototalamt").val();
	var taxpercent=$("#taxpercent").val();
	var subtaxamt=$("#subtaxamt").val();
var suborderid=$("#ssuborderid").val();

e.preventDefault();

	$.ajax({
            type: 'GET',
            url: 'https://www.laundrybucket.co.in/lb-admin/api_fetchamount_otherdiscount.php?totalamt='+totalamt+'&discount='+discount+'&taxpercent='+taxpercent+'&subtaxamt='+subtaxamt+'&suborderid='+suborderid,
            success:function (data) {
            	$.each(data,function(i,field){	
					
				
            	var status=field.status;
            	if(status==1)
            	{
            		$("#subtaxamt").val(field.taxableamt);
				
				$("#subtax").val(field.tax);
				$("#subpayable").val(field.payableamt);
             getofferdetail();
             }
             
             });
            }
            
          });
	
});
										
});
    </script>
   <script>
   	$(document).on("change",".deliverystatus",function(){
   		var deliverstatus=$(this).val();
   		if(deliverstatus==4)
   		$(".deliverbydiv").show();
   		else
   		$(".deliverbydiv").hide();
   	});
   </script>
    <script>
   	$(document).ready(function(){
   		var deliverstatus=$(".deliverystatus").val();
   		if(deliverstatus==4)
   		$(".deliverbydiv").show();
   		else
   		$(".deliverbydiv").hide();
   	});
   </script>
<script type="text/javascript">
function chkdeliverytype(dtype) {
	document.getElementById('dfast').innerHTML="";
	var url="https://www.laundrybucket.co.in/lb-admin/fetch_deliverydays.php?did="+dtype;
		$.ajax({
			url:url,
			type:"GET",
			success:function(data)	
			{
				$.each(data,function(i,field){
					var status=field.status;
					if(status==1)
					{
						var deliverydays=field.deliverydays;
						document.getElementById('dfast').innerHTML = 'We deliver with in '+deliverydays+' days';
						var pickdate=document.getElementById('datepicker').value;
		 				var date = new Date(pickdate);
   			 			var newdate = new Date(date);
						
   						 newdate.setDate(newdate.getDate() + Number(deliverydays));
    				
    			var dd = addZero(newdate.getDate());
    			var mm = addZero(newdate.getMonth() + 1);
    			var y = addZero(newdate.getFullYear());

			function addZero(x) {
     		if (x < 10) {
         		x = "0" + x;
    		 }
    		 return x;
 				}

   			 	var someFormattedDate = mm + '/' + dd + '/' + y;
    			document.getElementById('datepicker2').value = someFormattedDate;
    	
					}
					else if(status==0)
					{
						document.getElementById('dfast').innerHTML ="Select a delivery type first";
						document.getElementById('datepicker2').value="";
					}
				});
			}
		})
	

}

</script>
<script>
	function showdelivery(otype)
	{
		if(otype!=-1)
		{
			$("#deliverydiv").show(100);
			
		}
		else
		{
			$("#deliverydiv").hide(100);
			$("#datepicker2").val("");
			$("#dfast").html("");
			$(".deliverytype").val("-1");
			
		}
		
	}
</script>
 <script>    
  $(document).on("click","#savenewaddress",function()
                         		{
                         		
                         			//alert("ok");
                         			var getuid=$("#getuid").val();
                         			var address=$("#newaddress").val();
                         			
                         			var strurl="https://www.laundrybucket.co.in/lb-admin/apisave_newaddress.php?uid="+getuid+"&address="+address;
						 			//alert(strurl);
						 			$.ajax({
						 				url:strurl,
						 				type:"GET",
						 				success:function(data)
						 				{
						 					//console.log(data);
						 					//$("#subscriptions_data").html(data);
						 					$("#headingTwo").css("background-color", "#444"); 
						 					$("#pickadd").val(address);
						 					
						 					
						 				},
						 				error:function(err)
						 				{
						 					alert($err);
						 				}
						 			 })
                         	});                  	
$(document).on("click","#savenewremarks",function()
                         		{
                         		
                         			//alert("ok");
                         			var getuid=$("#getuserid").val();
                         			var getoid=$("#getorderid").val();
                         			var getsoid=$("#getsuborderid").val();
                         			var remarks=$("#newremarks").val();
                         			
                         			var strurl="https://www.laundrybucket.co.in/lb-admin/apisave_newremarks_suborder.php?uid="+getuid+"&remarks="+remarks+"&oid="+getoid+"&soid="+getsoid;
						 			//alert(strurl);
						 			$.ajax({
						 				url:strurl,
						 				type:"GET",
						 				success:function(data)
						 				{
						 					//console.log(data);
						 					//$("#subscriptions_data").html(data);
						 					$("#headingThree").css("background-color", "#444"); 
						 					$("#remark").val(remarks);
						 					
						 					
						 				},
						 				error:function(err)
						 				{
						 					alert($err);
						 				}
						 			 })
                         	});
                         	
                         
</script>
<script>
          	$(document).on("click",".btnaddress",function(){
          		var address=$(this).attr("title");
          		//alert(address);
          		$("#headingTwo").css("background-color", "#444");
          		$("#pickadd").val(address);
          		
          		//$("#collapseTwo").slideUp();
          		//$("#collapseTwo").collapse('hide');
          		
          	});
          </script>
<script>
	$(document).on("blur","#qty",function(){
		var qty=$(this).val();
		var iprice=$("#itemprice").val();
		var totalprice=qty*iprice;
		$("#tprice").val(totalprice);
	});
	
</script>
<div class="right_col" role="main">
	<div class="row">
		<div class="container">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="col-md-12 col-sm-12 col-xs-12" style="text-align:center;">
				<?php
					
					$r=mysql_query("select * from tblusers where UserId='$userid'") or die(mysql_error());
					if(mysql_affected_rows())
					{
						$urow=mysql_fetch_array($r);
						
					 echo "<h2>".$urow['UserFirstName']." ".$urow['UserLastName']."'s Create Sub Order</h2>";
					}
					 ?>
				</div>
				<!--<div class="col-md-4 col-sm-4 col-xs-12">
					<a href="suborder_dashboard.php?oid=<?php echo $orderid;?>&uid=<?php echo $userid;?>" style="color:#000000;"><button class="btn">View Sub Order</button></a>
				</div>-->
				<!--<div class="col-md-4 col-sm-4 col-xs-12">
					<?php
					
					$r=mysql_query("select * from tblusers where UserId='$userid'") or die(mysql_error());
					if(mysql_affected_rows())
					{
						$urow=mysql_fetch_array($r);
						
					?>
					<nav class="">
					  <div class="container-fluid">
					    <ul class="" style="list-style: none;">
					      <li class="dropdown">
					        <a class="dropdown-toggle" data-toggle="dropdown" href="#" style="color:#000000; text-transform: capitalize; font-size:18px;">Welcome <?php echo $urow['UserFirstName']." ".$urow['UserLastName'];?>
					        <span class="caret"></span></a>
					        <ul class="dropdown-menu">
					          <li><a href="user_logout.php">Log Out</a></li>
					        </ul>
					      </li>
					     </ul>
					  </div>
					</nav>
					<?php } ?>
				</div>-->
			</div>
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="col-md-10 col-sm-10 col-xs-12">
					<div class="col-md-12 col-sm-12 col-xs-12">
						<div class="row">
							<div class="col-md-6 col-sm-6 col-xs-12">
							<table class="table">
								<tr>
									<td>PickUp Date : </td>
									<td><?php echo $row['Order_PickDate'];?></td>
								</tr>
								<tr>
									<td>PickUp Time</td>
									<td><?php echo $row['Order_PickTime'];?></td>
								</tr>
								<tr>
									<td>PickUp Address</td>
									<td style="text-transform: capitalize;"><?php echo $row['PickupAddress'].", ".$row['OrderCity'];?></td>
								</tr>
								<tr>
									<td>User Selected Offer Codes</td>
									<td><?php echo $row['UserDemandOffer'];?></td>
								</tr>
							</table>
							</div>
							<div class="col-md-6 col-sm-6 col-xs-12" id="orderdetail">
			
							</div>
						</div>
						<hr>
<script>
function getorderdetail()
{
 var orderid1=document.getElementById('orderidhide').value;
 var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("orderdetail").innerHTML =this.responseText;
      
    }
  };
  xhttp.open("GET", "fetchorder_detail.php?oid="+orderid1, true);
  xhttp.send();
}

</script>
						<div class="row">
							<?php
							if(isset($_GET['soid']))
							{
								$soid=$_GET['soid'];
								$res=mysql_query("select * from tbl_suborders where SubOrderId='$soid'") or die(mysql_error());
								if(mysql_affected_rows())
								{
									$rows=mysql_fetch_array($res);
									$ordertypeid=$rows['OrderTypeId'];
									$deliverytypeid=$rows['DeliveryTypeId'];
							?>
							<form method="post" role="form" class="form-horizontal" name="suborderform1" enctype="multipart/form-data" id="suborderform1">
								<div class="item form-group">
									<label class="control-label col-md-2 col-sm-2 col-xs-5" for="ordstatus">Order Type
                                    </label>
                                    <div class="col-md-4 col-sm-4 col-xs-7" >
                                    <?php
	          			 $r1=mysql_query("select * from tbl_services where ServiceId='$ordertypeid'") or die(mysql_error());
						 $rw1=mysql_fetch_array($r1);
	          			 ?>         			
	           			<input type="text" class="form-control col-md-7 col-xs-12" name="ordertype" required="" readonly="readonly" placeholder="" value="<?php echo $rw1['ServiceName'];?>">
<input type="hidden" class="form-control col-md-7 col-xs-12" name="ordercat" id="ordercatid" required="" readonly="readonly" placeholder="" value="<?php echo $rows['OrderTypeId'];?>">
									<input type="hidden" id="datepicker" class="form-control date-picker col-md-7 col-xs-12" name="pickdate" required="" placeholder="Select Pickup Date" value="<?php echo $row['Order_PickDate'];?>">
									
									<input type="hidden" id="orderidhide" class="form-control col-md-7 col-xs-12" name="orderid" required="" placeholder="Order id" value="<?php echo $row['OrderId'];?>" onchange="getorderdetail();" onkeyup="this.onchange();" onpaste="this.onchange();" oninput="this.onchange();">
									
									<input type="hidden" id="suborderidhide" class="form-control col-md-7 col-xs-12" name="suborderid" required="" placeholder="Sub Order id" value="<?php echo $soid;?>">
									<!--<input type="hidden" id="review" class="form-control col-md-7 col-xs-12" name="review" required="" placeholder="Remarks" value="<?php echo $row['Remarks'];?>">-->
		                           	</div>
		                           	
		                           	<label class="control-label col-md-2 col-sm-2 col-xs-5" for="deliverystatus"> Select Delivery Status
                                     </label>
                                     <div class="col-md-4 col-sm-4 col-xs-7" >
                                      <select class="form-control deliverystatus" required name="dstatus" id="dstatus">
									 <option value=""  style="padding-bottom:7px">Select Delivery Status</option>
											
											<?php
								
									 $res2=mysql_query("SELECT * from tbl_orderstatus_id");			
										if(mysql_affected_rows())
									{
										while($rows2=mysql_fetch_array($res2))
								
									{
										?>
										<option  value="<?php echo $rows2["order_status_id"]; ?>" <?php if($rows['DeliveryStatusId']==$rows2['order_status_id']) echo selected;?>  style="margin-bottom:7px"><?php echo $rows2["order_status_text"]; ?></option>
										
										<?php
										}
										}
									?>
					                   </select>
                                    </div>
								</div>
								<div class="item form-group deliverbydiv">
									<label class="control-label col-md-2 col-sm-2 col-xs-5" for="deliverby"> Select Delivered By
                                     </label>
                                     <div class="col-md-4 col-sm-4 col-xs-7" >
                               <?php if($_SESSION['loginrole']==2 || $_SESSION['loginrole']==3){?>
                                      <select class="form-control" name="deliverby" id="deliverby">
									 <option value="-1"  style="padding-bottom:7px">Select Delivered By</option>
									 	<?php
									
										 $res2=mysql_query("SELECT * from tbl_per_employee_roles where empRoleId=7");			
											if(mysql_affected_rows())
										{
											while($rows2=mysql_fetch_array($res2))
									
										{
											$empid=$rows2['empId'];
											$r1=mysql_query("select * from tbl_employee where empId='$empid'");
											$row3=mysql_fetch_array($r1);
											?>
											<option  value="<?php echo $rows2["empId"]; ?>" <?php if($rows['RiderId']==$rows2['empId']) echo selected;?>   style="margin-bottom:7px"><?php echo $row3["empName"]; ?></option>
											
											<?php
											}
											}
										?>
															
					                   </select>
					                   
					                    <?php }
					else {
						$empuname=$_SESSION['loginuser'];
						$q1=mysql_query("select * from tbl_employee where empEmail='$empuname'");
						$rws=mysql_fetch_array($q1);
						if($rows['RiderId']==$rws['empId']||$rows['RiderId']==NULL||$rows['RiderId']==""||$rows['RiderId']==-1)
						{
					?>
					<input type="hidden" class="form-control" name="deliverby" id="deliverby" value="<?php echo $rws['empId']; ?>">
					<input type="text" class="form-control" readonly="readonly" value="<?php echo $rws['empName']; ?>">
					
					<?php
						}
						else
						{
							$rid=$rows['RiderId'];
						$q2=mysql_query("select * from tbl_employee where empId='$rid'");
						$rws1=mysql_fetch_array($q2);
						?>
						<input type="hidden" class="form-control" name="deliverby" id="deliverby" value="<?php echo $rws1['empId']; ?>">
					<input type="text" class="form-control" readonly="readonly" value="<?php echo $rws1['empName']; ?>">
						<?php
						}
					} ?>
					                   
                                    </div>
                                    <label class="control-label col-md-2 col-sm-2 col-xs-5" for="actualdd">Actual Delivery Date
                                    </label>
                                    <div class="col-md-4 col-sm-4 col-xs-7">
                          
                                   <input type="text" id="datepicker3" class="form-control date-picker col-md-7 col-xs-12"  name="actualdd"  placeholder="Select Actual Delivery Date" value="<?php echo $rows['ActualDeliveryDate']; ?>">      
                        			</div>
								</div>
								<div class="item form-group">
									 <label class="control-label col-md-2 col-sm-2 col-xs-5" for="ordstatus"> Select Delivery Type
                                     </label>
                                     <div class="col-md-4 col-sm-4 col-xs-7" >
                                     <select name="dtype" class="form-control deliverytype"  onchange="chkdeliverytype(this.value)" style="cursor: pointer" required>
            						<option value="-1"  style="padding-bottom:7px">Select Delivery Type</option>
            						
            						  <?php
            				      	$rs=mysql_query("select * from tbl_deliverytypes");
									while($row=mysql_fetch_array($rs))
									{
										?>
									<option value="<?php echo $row["DeliveryId"]; ?>" <?php if($rows['DeliveryTypeId']==$row["DeliveryId"]) echo selected;?> style="padding:10px"> <?php echo $row["DeliveryTitle"]; ?> </option>
									<?php	
									}  
            				      	?>
										
									</select> 
                                    </div>
								<!--</div>
								<div class="item form-group">-->
									<label class="control-label col-md-2 col-sm-2 col-xs-5" for="dob">Delivery Date
                                    </label>
                                    <div class="col-md-4 col-sm-4 col-xs-7">
                          
                                   <input type="text" id="datepicker2" class="form-control date-picker col-md-7 col-xs-12"  name="deliverydate"  placeholder="Select Delivery Date" value="<?php echo $rows['DeliveryDate']; ?>">      
                        			</div>
								</div>
								<div class="item form-group" >
                                <span class="col-md-3 col-sm-3 col-xs-12"> </span>
		                    	<span class="col-md-6 col-sm-6 col-xs-12"  style="color:red" id="dfast"> </span>
		                    	</div> 
		                    	<div class="item form-group">
									 
									 <label for="Image" class="control-label col-md-2 col-sm-2 col-xs-5">Delivery Address</label>
            				
            				<div class="col-md-4 col-sm-4 col-xs-7">
            			  
            			  <input type="text" class="form-control" readonly="" id="pickadd" name="address" required="" placeholder="Enter Customer Delivery Address" data-form-field="address" value="<?php echo $rows["DeliveryAddress"]; ?>" placeholder="<?php if(empty($rows['DeliveryAddress'])){ echo "Select Customer Delivery Address"; } else { echo "Change Customer Delivery Address" ; }?>">
            			       <!--</div>
            			       
            			       <div class="col-md-4 col-sm-4 col-xs-7">-->
            			        <div class="panel panel-default">
          	
			    <div class="panel-heading" role="tab" id="headingTwo" style="background-color: #0042A4; color:white;">
				    <h4 class="panel-title">
				    	
					    <a style="text-decoration:none;cursor: pointer" class="collapsed paneltext" data-toggle="collapse" data-target="#collapseTwo"  aria-expanded="false" aria-controls="collapseTwo">
						   <?php
						 if(empty($rows["DeliveryAddress"]))
						 {
						 echo "Select Your Delivery Address";	
						 }
						 else {
							 echo "Change Your Delivery Address";
						 }
						 ?>
						 
						 </a>
						       
					 </h4>
				 </div>
						    
    			<div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
      				<div class="panel-body">
               
              			<div class="col-md-12" style="border:1px solid red">
				              <h4>Add New Address</h4>
				         	<!-- We can not do nested form, so we do this using ajax without form tag-->
				         	   <div class="row">
				         	   	
				         	   	
				               	<div class="form-group">
				               		<?php
            			  $res1=mysql_query("select * from tblusers where UserId='$userid'") or die(mysql_error());
							if(mysql_affected_rows())
							{
								$rows1=mysql_fetch_array($res1);
            			  ?>
            			  <input type="text" class="form-control text-capitalize hidden" id="getcity" value="<?php echo $rows1["UserCity"]; ?>"  name="getcity"  placeholder="" data-form-field="">
            			  <?php
							}
            			  ?>
                            	<input type="text" class="form-control text-capitalize hidden" id="getuid" value="<?php echo $userid; ?>"  name="getuid"  placeholder="" data-form-field="">
                            <!-- Using this field to get userid dynamically from email and mobile keyup function-->
                            </div>
				                	<div class="col-md-6">
										<div class="form-group">
										<textarea class="form-control" rows="1" id="newaddress" name="newaddress"></textarea>
				       					</div>
				                    </div>
				                    
				                	<div class="col-md-6">
										<div class="form-group">
										<input type="button"  id="savenewaddress" value="Save" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo" class="btn btn-success"/>                    
								        </div>
				                    </div>
				              </div>
				              
            			</div>
            			
          				<br/>
         
          			   <div class="col-md-12">
					          <h4>Already Saved Address</h4>
					              <span class="address-bar">
					              	 <ul style="list-style-type:none;margin-left:-50px" id="unlogin_addresslist">
					              	<?php
					              		$i=1;
					              		$rs1=mysql_query("select * from tblusers_address where UserID='$userid'") or die(mysql_error());
										if(mysql_num_rows($rs1)>0)
										{
											while($row1=mysql_fetch_array($rs1))
											{
												?>
												
												<li>
								    
								              	<b>Address <?php echo $i; ?> <span class="text-right"><i class="glyphicon glyphicon-edit"></i></span></b>
								                <address><i class="glyphicon glyphicon-map-marker"></i> <span class="addressspan"><?php echo $row1["Address"]; ?></span></address>
								                 <button type="button" class="btn g-back btn-block btn-success btnaddress" title="<?php echo $row1["Address"]; ?>" data-target="#collapseTwo" data-toggle="collapse"  aria-expanded="false" aria-controls="collapseTwo">Select</button>
								                 
								               </li>
												<?php
												$i++;
											}
										}
					              		?>
					              		
					               </ul>
					             </span>
             						</div>
					          
					 			  </div>
					    	   </div>
					 	  </div>	
            				</div>  
									 
									 
								<!--</div>
								<div class="item form-group">-->
									<label class="control-label col-md-2 col-sm-2 col-xs-5" for="remarks">Remarks
                                    </label>
                                    <div class="col-md-4 col-sm-4 col-xs-7">
                          
                                  <input type="text" class="form-control col-md-7 col-xs-12" id="remark" readonly="readonly"  name="review" placeholder="Remarks" style="height: 95px" value="<?php echo $rows['Remarks']; ?>">      
                        			<!--</div>-->
                        			<!--remarks multiple-->
                         
                         <!--<div class="col-md-4 col-sm-4 col-xs-7">-->
            			        <div class="panel panel-default">
          	
			    <div class="panel-heading" role="tab" id="headingThree" style="background-color: #0042A4; color:white;">
				    <h4 class="panel-title">
				    	
					    <a style="text-decoration:none;cursor: pointer" class="collapsed paneltext" data-toggle="collapse" data-target="#collapseThree"  aria-expanded="false" aria-controls="collapseThree">
						   <?php
						 if(empty($rows["Remarks"]))
						 {
						 echo "Add Your Remarks";	
						 }
						 else {
							 echo "Add New Remarks";
						 }
						 ?>
						 
						 </a>
						       
					 </h4>
				 </div>
						    
    			<div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
      				<div class="panel-body">
               
              			<div class="col-md-12" style="border:1px solid red">
				              <h4>Add New Remarks</h4>
				         	<!-- We can not do nested form, so we do this using ajax without form tag-->
				         	   <div class="row">
				         	   	
				         	   	
				               	<div class="form-group">
				          <input type="text" class="form-control text-capitalize hidden" id="getsuborderid" value="<?php echo $soid; ?>"  name="getorderid"  placeholder="" data-form-field="">
            			  <input type="text" class="form-control text-capitalize hidden" id="getorderid" value="<?php echo $orderid; ?>"  name="getorderid"  placeholder="" data-form-field="">
            			  <input type="text" class="form-control text-capitalize hidden" id="getuserid" value="<?php echo $userid; ?>"  name="getuserid"  placeholder="" data-form-field="">
                           
                         </div>
				                	<div class="col-md-6">
										<div class="form-group">
										<textarea class="form-control" rows="1" id="newremarks" name="newremarks"></textarea>
				       					</div>
				                    </div>
				                    
				                	<div class="col-md-6">
										<div class="form-group">
										<input type="button"  id="savenewremarks" value="Save" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree" class="btn btn-success"/>                    
								        </div>
				                    </div>
				              </div>
				              
            			</div>
            			
          				<br/>
         
          			   <div class="col-md-12">
					          <h4>Remarks History</h4>
					              <span class="address-bar">
					              	 <ul style="list-style-type:none;margin-left:-50px" id="unlogin_remarkslist">
					              	<?php
					              		$i=1;
					              		$rs1=mysql_query("select * from tbl_subordersremarks where UserId='$userid' and OrderId='$orderid' and SubOrderId='$soid'") or die(mysql_error());
										if(mysql_num_rows($rs1)>0)
										{
											while($row1=mysql_fetch_array($rs1))
											{
												?>
												
												<li>
								    
								              	<b>Remarks<?php echo $i; ?> <span class="text-right"><i class="glyphicon glyphicon-edit"></i></span></b>
								                <address><i class=""></i> <span class="addressspan"><?php echo $row1["Remarks"]; ?></span></address>
								                 <!--<button type="button" class="btn g-back btn-block btn-success btnaddress" title="<?php echo $row1["Remarks"]; ?>" data-target="#collapseTwo" data-toggle="collapse"  aria-expanded="false" aria-controls="collapseTwo">Select</button>-->
								                 
								               </li>
												<?php
												$i++;
											}
										}
					              		?>
					              		
					               </ul>
					             </span>
             						</div>
					          
					 			  </div>
					    	   </div>
					 	  </div>	
            				</div>  
                         <!--end-->
								</div>
		                    	
		                    	<div class="form-group">
		                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-4 col-sm-offset-4">
		                            
		                            <label>Apply Tax <input type="checkbox" checked="checked" name="tax_apply_status"  /></label><br />
		                            
		                            <input type="submit" name="btnUpdate" class="btn btn-success" id="btnUpdate" value="Update"/>&nbsp;
		                            
		                            <input type="button" name="btnQuickadd" class="btn btn-success" id="btnQuickadd" value="Quick Order Pay"/>&nbsp;
		                            
		                            <input type="button" name="btnQuickadditems" class="btn btn-success" id="btnQuickadditems" value="Add Items"/>&nbsp;
		                        </div>
		                    </div> 
							</form>
							<?php
							}
							}
							else {
								
							
							?>
							<form method="post" role="form" class="form-horizontal" name="suborderform" enctype="multipart/form-data" id="suborderform">
								<div class="item form-group">
									<label class="control-label col-md-4 col-sm-5 col-xs-5" for="ordstatus"> Select Order Type
                                    </label>
                                    <div class="col-md-6 col-sm-7 col-xs-7" >
                                    <select class="form-control"  id="my_select" name="ordercat"   style="cursor: pointer" required onchange="showdelivery(this.value)">
		    						<option value="-1"  style="padding-bottom:7px">Select Order Type</option>
		    						<?php
		    				      	$rs1=mysql_query("select * from tbl_services where ServiceName not like '%subsc%'");
									while($row1=mysql_fetch_array($rs1))
									{
										?>
									<option value="<?php echo $row1["ServiceId"]; ?>" style="padding:10px"> <?php echo $row1["ServiceName"]; ?> </option>
									<?php	
									}  
		    				      	?>
		    						  						
										
									</select>
									<input type="hidden" id="datepicker" class="form-control date-picker col-md-7 col-xs-12" name="pickdate" required="" placeholder="Select Pickup Date" value="<?php echo $row['Order_PickDate'];?>">
									<input type="hidden" id="address" class="form-control col-md-7 col-xs-12" name="address" required="" placeholder="Select address" value="<?php echo $row['PickupAddress'];?>">
									<input type="hidden" id="orderidhide" class="form-control col-md-7 col-xs-12" name="orderid" required="" placeholder="Order id" value="<?php echo $row['OrderId'];?>" onchange="getorderdetail();" onkeyup="this.onchange();" onpaste="this.onchange();" oninput="this.onchange();">
									<input type="hidden" id="getuid" class="form-control col-md-7 col-xs-12" name="getuid" required="" placeholder="User id" value="<?php echo $userid;?>">
									<!--<input type="hidden" id="review" class="form-control col-md-7 col-xs-12" name="review" required="" placeholder="Remarks" value="<?php echo $row['Remarks'];?>">-->
		                           	
		                           	<input type="hidden" id="ordercatid" />
		                           	<input type="hidden" id="suborderidhide" />
		                           	</div>
								</div>
								<div id="deliverydiv" style="display:none;">
								<div class="item form-group">
									 <label class="control-label col-md-2 col-sm-2 col-xs-5" for="ordstatus"> Select Delivery Type
                                     </label>
                                     <div class="col-md-4 col-sm-4 col-xs-7" >
                                     <select name="dtype" class="form-control deliverytype"  onchange="chkdeliverytype(this.value)" style="cursor: pointer" required>
            						<option value="-1"  style="padding-bottom:7px">Select Delivery Type</option>
            						
            						  <?php
            				      	$rs=mysql_query("select * from tbl_deliverytypes");
									while($row=mysql_fetch_array($rs))
									{
										?>
									<option value="<?php echo $row["DeliveryId"]; ?>" style="padding:10px"> <?php echo $row["DeliveryTitle"]; ?> </option>
									<?php	
									}  
            				      	?>
										
									</select>
                                    </div>
								<!--</div>
								<div class="item form-group">-->
									<label class="control-label col-md-2 col-sm-2 col-xs-5" for="dob">Delivery Date
                                    </label>
                                    <div class="col-md-4 col-sm-4 col-xs-7">
                          
                                   <input type="text" id="datepicker2" class="form-control date-picker col-md-7 col-xs-12"  name="deliverydate"  placeholder="Select Delivery Date">      
                        			</div>
								</div>
								<div class="item form-group" >
                                <span class="col-md-3 col-sm-3 col-xs-12"> </span>
		                    	<span class="col-md-6 col-sm-6 col-xs-12"  style="color:red" id="dfast"> </span>
		                    	</div> 
		                    	<div class="item form-group">
									 <label class="control-label col-md-2 col-sm-2 col-xs-5" for="deliverystatus"> Select Delivery Status
                                     </label>
                                     <div class="col-md-4 col-sm-4 col-xs-7" >
                                     <select name="dstatus" class="form-control deliverystatus" style="cursor: pointer" required>
            						<option value="-1"  style="padding-bottom:7px">Select Delivery Status</option>
            						
            						  <?php
            				      	$rs=mysql_query("select * from tbl_orderstatus_id");
									while($row=mysql_fetch_array($rs))
									{
										?>
									<option value="<?php echo $row["order_status_id"]; ?>" style="padding:10px"> <?php echo $row["order_status_text"]; ?> </option>
									<?php	
									}  
            				      	?>
										
									</select>
                                    </div>
								<!--</div>
								<div class="item form-group">-->
									<label class="control-label col-md-2 col-sm-2 col-xs-5" for="remarks">Remarks
                                    </label>
                                    <div class="col-md-4 col-sm-4 col-xs-7">
                          
                                   <textarea id="remarks" class="form-control col-md-7 col-xs-12"  name="remarks"  placeholder="Enter Remarks"></textarea>      
                        			</div>
								</div>
		                    	</div>
		                    	<div class="item form-group deliverbydiv" hidden>
									 <label class="control-label col-md-2 col-sm-2 col-xs-5" for="deliverby"> Select Delivered By
                                     </label>
                                     <div class="col-md-4 col-sm-4 col-xs-7" >
                           <?php if($_SESSION['loginrole']==2 || $_SESSION['loginrole']==3){?>
                                     <select name="deliverby" class="form-control deliverby" style="cursor: pointer" >
            						<option value="-1"  style="padding-bottom:7px">Select Delivered By</option>
            							<?php
									
										 $res2=mysql_query("SELECT * from tbl_per_employee_roles where empRoleId=7");			
											if(mysql_affected_rows())
										{
											while($rows2=mysql_fetch_array($res2))
									
										{
											$empid=$rows2['empId'];
											$r1=mysql_query("select * from tbl_employee where empId='$empid'");
											$row3=mysql_fetch_array($r1);
											?>
											<option  value="<?php echo $rows2["empId"]; ?>"   style="margin-bottom:7px"><?php echo $row3["empName"]; ?></option>
											
											<?php
											}
											}
										?>
						            				
            						 
										
									</select>
									
									 <?php }
					else {
						$empuname=$_SESSION['loginuser'];
						$q1=mysql_query("select * from tbl_employee where empEmail='$empuname'");
						$rws=mysql_fetch_array($q1);
						
					?>
					<input type="hidden" class="form-control" name="deliverby" id="deliverby" value="<?php echo $rws['empId']; ?>">
					<input type="text" class="form-control" readonly="readonly" value="<?php echo $rws['empName']; ?>">
					
					<?php
					} ?>
                                    </div>
								<label class="control-label col-md-2 col-sm-2 col-xs-5" for="actualdd">Actual Delivery Date
                                    </label>
                                    <div class="col-md-4 col-sm-4 col-xs-7">
                          
                                   <input type="text" id="datepicker3" class="form-control date-picker col-md-7 col-xs-12"  name="actualdd"  placeholder="Select Actual Delivery Date">      
                        			</div>
								</div>
								
								
								
		                    	<div class="form-group">
		                        <div class="col-md-8 col-sm-8 col-xs-12 col-md-offset-2 col-sm-offset-2">
		                            <div id="hidebtns1">
		                            <input type="submit" name="btnAdd" class="btn btn-success" id="btnAdd" value="Create SubOrder"/>&nbsp;
		                            
		                            <a href="allorder_list_new.php"><input type="button" name="" class="btn btn-danger" id="" value="Cancel"/></a>&nbsp;
		                            
		                            </div>
		                            <div id="hiddenbtns" hidden>
		                            	
		                             <a href="allorder_list_new.php"><input type="button" name="" class="btn btn-danger" id="" value="Finish"/></a>&nbsp;
		                             	
		                            <input type="button" name="btnQuickadd" class="btn btn-success" id="btnQuickadd" value="Quick Order Pay"/>&nbsp;
		                            
		                            <input type="button" name="btnQuickadditems" class="btn btn-success" id="btnQuickadditems" value="Add Items"/>&nbsp;
		                            
		                          
		                        	
		                        	</div>
		                        </div>
		                    </div> 
							</form>
							<?php
							}
							?>
						</div>
						<hr>
<script>
function getitem(unitid) {
	var sid=document.getElementById("sserviceid").value;
	var scatid=document.getElementById("servicecat1").value;
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("itemname").innerHTML =this.responseText;
      
    }
  };
  xhttp.open("GET", "fetchitem.php?scat="+scatid+"&s="+sid+"&uid="+unitid, true);
  xhttp.send();
}
</script>
<script>
function getprice(irate) {
	var itemid=document.getElementById("itemname").value;
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("itemprice").value =this.responseText;
      
    }
  };
  xhttp.open("GET", "fetchitemprice.php?itmrate="+irate+"&iid="+itemid, true);
  xhttp.send();
}
</script>
<script>
function getitemname(itemid) {
	
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("itmname").value =this.responseText;
      
    }
  };
  xhttp.open("GET", "fetchitemname.php?itmid="+itemid, true);
  xhttp.send();
}
</script>

<script>
function getsuborderdetail()
{
 var suborderid1=document.getElementById('ssuborderid').value;
 var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("suborderdetail").innerHTML =this.responseText;
      
    }
  };
  xhttp.open("GET", "fetchsuborder_detail.php?soid="+suborderid1, true);
  xhttp.send();
}
</script>
<script>
function getoffercode(otype)
{
	//alert(otype);
	var xhttp = new XMLHttpRequest();
  		xhttp.onreadystatechange = function() {
    	if (this.readyState == 4 && this.status == 200) {
      	document.getElementById("offercode").innerHTML =this.responseText;
		}
	  };
	  xhttp.open("GET", "fetchoffercode.php?otypeid="+otype, true);
	  xhttp.send();
	 }
</script>
<script>
	function getofferdetail()
	{
		var suborderid=document.getElementById("ssuborderid").value;
		var xhttp = new XMLHttpRequest();
  		xhttp.onreadystatechange = function() {
    	if (this.readyState == 4 && this.status == 200) {
      	document.getElementById("selectedoffers").innerHTML =this.responseText;
		}
	  };
	  xhttp.open("GET", "fetchofferdetail.php?suborderid="+suborderid, true);
	  xhttp.send();
	}
	function settaxableamt(totalamt){
		
		var offerdis=document.getElementById("offerdiscounttotal").value;
		var otherdiscount=document.getElementById("otherdiscount").value;
		var totaldis=offerdis+otherdiscount;
		var taxableamt=totalamt-totaldis;
		document.getElementById("subtaxamt").value=taxableamt;
		var taxpercent=document.getElementById("taxpercent").value;
		var taxableamt=document.getElementById("subtaxamt").value;
		document.getElementById("subtax").value=taxableamt*(taxpercent/100);
		var tax=document.getElementById("subtax").value;
		document.getElementById("subpayable").value=Number(taxableamt)+Number(tax);
		
		//var payableamt=document.getElementById("subpayable").value;
		
		
		
		
	}
</script>
						<div class="row">
							
							<form method="post" role="form" class="form-horizontal" name="additem" enctype="multipart/form-data" id="additemform" hidden>
						
							<div class="panel-group" id="accordion">
								 
								  
								  <div class="panel panel-default" id="additemsshow" hidden>
								    <div class="panel-heading">
								      <h4 class="panel-title">
								        <a data-toggle="collapse" data-parent="#accordion" href="#collapse2">
								        Add Items &nbsp;&nbsp;&nbsp;<span class="glyphicon glyphicon-menu-down"></span></a>
								      </h4>
								    </div>
								    <div id="collapse2" class="panel-collapse collapse">
								      <div class="panel-body">
								      	
								   
								
								
								
								
							<h4>Add Items</h4>
							<input type="hidden" id="sorderid" name="sorderid" >
							<input type="hidden" id="ssuborderid" name="ssuborderid" onchange="getsuborderdetail();" onkeyup="this.onchange();" onpaste="this.onchange();" oninput="this.onchange();">
							<input type="hidden" id="suserid" name="suserid" >
							<input type="hidden" id="sserviceid" name="sserviceid" onchange="getoffercode(this.value);" onkeyup="this.onchange(this.value);" onpaste="this.onchange(this.value);" oninput="this.onchange(this.value);" >
							<div class="item form-group" >
		                      <label class="control-label col-md-2 col-sm-2 col-xs-5" for="servicecat"> Select Service Category
		                     </label>
							<div class="col-md-4 col-sm-4 col-xs-7" >
		                                             <select name="servicecat" class="form-control servicecat" id="servicecat1"  style="cursor: pointer">
		            						<option value=""  style="padding-bottom:7px">Select Service Category</option>
		            						
		            						  <?php
		            				      	$rs=mysql_query("select * from tbl_services_category");
											while($row1=mysql_fetch_array($rs))
											{
												?>
											<option value="<?php echo $row1["ServiceCatId"]; ?>" style="padding:10px"> <?php echo $row1["ServiceCatName"]; ?> </option>
											<?php	
											}  
		            				      	?>
												
												</select>
		                                    
		                       </div>
		                       
		                       <label class="control-label col-md-2 col-sm-2 col-xs-5" for="priceunit"> Select Price Unit
		                     </label>
							<div class="col-md-4 col-sm-4 col-xs-7" >
		                                             <select name="priceunit" class="form-control priceunit"  onchange="getitem(this.value)" style="cursor: pointer"  id="priceunit">
		            						<option value=""  style="padding-bottom:7px">Select Price Unit</option>
		            						
		            						  <?php
		            				      	$rs=mysql_query("select * from tbl_priceunit");
											while($row=mysql_fetch_array($rs))
											{
												?>
											<option value="<?php echo $row["UnitId"]; ?>" style="padding:10px"> <?php echo $row["UnitName"]; ?> </option>
											<?php	
											}  
		            				      	?>
												
												</select>
		                                    
		                       </div>
		                      </div>
		                      &nbsp;
		                      <div class="item form-group" >
		                       <label class="control-label col-md-2 col-sm-2 col-xs-5" for="itemname"> Select Item Name
		                       </label>
		                       <div class="col-md-4 col-sm-4 col-xs-7"  id="divitemname" >
		                                             <select name="item" class="form-control" id="itemname"  onchange="getitemname(this.value)" style="cursor: pointer" >
		            						
												</select>
		                                    <input type="hidden" id="itmname" name="itmname" >
		                       </div>
		                       
		                       <label class="control-label col-md-2 col-sm-2 col-xs-5" for="itemrate"> Select Item Rate
		                       </label>
		                       <div class="col-md-4 col-sm-4 col-xs-7"  id="itemrate1" >
		                                             <select name="itemrate" class="form-control" id="itemrate"  onchange="getprice(this.value)" style="cursor: pointer" >
		            						<option value=""  style="padding-bottom:7px">Select Item Rate</option>
		            						<option value="StandardRate"  style="padding-bottom:7px">Standard Rate</option>
		            						<option value="PremiumRate"  style="padding-bottom:7px">Premium Rate</option>
												</select>
		                                    
		                       </div>
		                      </div>
		                      &nbsp;
		                      <div class="item form-group" >
		                                            <label class="control-label col-md-2 col-sm-2 col-xs-5" for="itemprice">Item Price
		                                            </label>
		                                            <div class="col-md-4 col-sm-4 col-xs-7">
		                                      
		                                    <input type="text" class="form-control col-md-7 col-xs-12"  name="itemprice" id="itemprice" data-form-field="itemprice" readonly="readonly">
		                                
		                                            </div>
		                                      
		                                            <label class="control-label col-md-2 col-sm-2 col-xs-5" for="qty">Item Quantity
		                                            </label>
		                                            <div class="col-md-4 col-sm-4 col-xs-7">
		                                      
		                                    <input type="number" class="form-control col-md-7 col-xs-12"  name="qty" id="qty"  data-form-field="qty" placeholder="Enter quantity to order">
		                                
		                                            </div>
		                          </div>
		                          &nbsp;
		                          <div class="item form-group" >            
		                                            <label class="control-label col-md-2 col-sm-2 col-xs-5" for="tprice">Total Price
		                                            </label>
		                                            <div class="col-md-4 col-sm-4 col-xs-7">
		                                      
		                                    <input type="text" class="form-control col-md-7 col-xs-12"  name="tprice" id="tprice"  data-form-field="tprice" readonly="readonly">
		                                
		                                            </div>
		                                      <label class="control-label col-md-2 col-sm-2 col-xs-5" for="descp">Description
		                                            </label>
		                                            <div class="col-md-4 col-sm-4 col-xs-7">
		                                      
		                                    <input type="text" class="form-control col-md-7 col-xs-12"  name="descp" id="descp" data-form-field="descp">
		                                
		                                            </div>
		                                            
		                                        </div>
		                        &nbsp;
		                        <div class="form-group">
		                                            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-4 col-sm-offset-4">
		                                                
		                                                <input type="button" name="btnadditem" class="btn btn-success" id="btnadditem" value="Add Item"/>&nbsp;
		                                                <input type="button" name="btnadddiscount" class="btn btn-success" id="btnadddiscount" value="Add Discount/Offer"/>&nbsp;
		                                            </div>
		                                            
		                         </div>
						
						</div>
						<div class="row">
							<div class="col-md-12 col-sm-12 col-xs-12" id="suborderdiv" hidden>
							<div class="col-md-12 col-sm-12 col-xs-12">
								<h4>Items Summary</h4>
							</div>
							<div class="col-md-12 col-sm-12 col-xs-12" id="suborderdetail">
								
							</div>
							
						</div>
					</div>
					</div>
					</div>
					
					 <div class="panel panel-default" id="quickordershow" hidden>
								    <div class="panel-heading">
								      <h4 class="panel-title">
								        <a data-toggle="collapse" data-parent="#accordion" href="#collapse1" id="quickordertab">
								        Order Amount Completion &nbsp;&nbsp;&nbsp;<span class="glyphicon glyphicon-menu-down"></span></a>
								      </h4>
								    </div>
								    <div id="collapse1" class="panel-collapse collapse">
								      <div class="panel-body">
								      	<div class="item form-group">
											 <div id="quicktotalselect">
											 <label class="control-label col-md-2 col-sm-2 col-xs-5"> Quick Total
		                                     </label>
		                                     <div class="col-md-4 col-sm-4 col-xs-7" >
		                                     <input type="radio" name="totalamtselect" required="required" value="1" class="totalamttype" id="quickradio" />
		                                    </div>
		                                    </div>
		                                    <div id="itemstotalselect">
											<label class="control-label col-md-2 col-sm-2 col-xs-5">Items Total
		                                    </label>
		                                    <div class="col-md-4 col-sm-4 col-xs-7">
		                          
		                                   <input type="radio" name="totalamtselect" required="required" value="2" class="totalamttype" id="itemradio"  />      
		                        			</div>
		                        			</div>
										</div>
										<div class="item form-group">
											 <label class="control-label col-md-2 col-sm-2 col-xs-5"> Order Total Amount
		                                     </label>
		                                     <div class="col-md-4 col-sm-4 col-xs-7" >
		                                     <input type="text" name="subototalamt" class="form-control" placeholder="Enter Total SubOrder Amount" required="required" id="subototalamt" onchange="settaxableamt(this.value);" onkeyup="this.onchange(this.value);" onpaste="this.onchange(this.value);" oninput="this.onchange(this.value);" />
		                                    </div>
		                                     <div class="col-md-4 col-sm-5 col-xs-12 col-md-offset-2 col-sm-offset-1" id="selectedoffers">
	<?php
	if(isset($_GET['soid']))
	{
		$soid=$_GET['soid'];
	 $q="select * from tbl_applyOffer where subOrderId='$soid' order by id";

	 $result1=mysql_query($q) or die(mysql_error());


		while($row=mysql_fetch_array($result1))
		
				{
					
					?>
					
				
				<p><?php echo $row['OfferDescription'];?></p>
				<a href="#" title="<?php echo $row['id']; ?>" class="removeoffer" style="color:#57AFF7;">Remove</a>
				
				<?php	
				}  
		      	

		}

	 ?> 	

		                                    </div>
											
										</div>
										
										<div class="item form-group">
											<label class="control-label col-md-2 col-sm-2 col-xs-5">Taxable Amount
		                                     </label>
		                                     <div class="col-md-4 col-sm-4 col-xs-7" >
		                                     <input type="text" name="subtaxamt" class="form-control" placeholder="SubOrder Taxable Amount" required="required" id="subtaxamt" readonly="" value="0" />
		                                    </div>
											 <label class="control-label col-md-2 col-sm-2 col-xs-5">Discount Offer
		                                    </label>
		                                    <div class="col-md-4 col-sm-4 col-xs-7">
		                          			<select class="form-control col-md-7 col-xs-12" name="offercode" id="offercode" >
 											<option value="">Select Offer Code</option>
 											
 											</select>
	    								
		                        			</div>
		                                    
											 
										</div>
										<div class="item form-group">
											<label class="control-label col-md-2 col-sm-2 col-xs-5">Tax
		                                    </label>
		                                    <div class="col-md-4 col-sm-4 col-xs-7">
		                                    	<?php
		                                    	$q=mysql_query("select TaxPercentage from tbl_tax where TaxActive='y'");
		                                    	$rw=mysql_fetch_array($q);
		                                    	
		                                    	?>
		                                    	<input type="hidden" " name="taxpercent" required="required" id="taxpercent" value="<?php echo $rw[0]; ?>" />
		                          			<input type="text" name="subtax" class="form-control" placeholder="SubOrder Tax Applied" required="required" id="subtax" readonly="" value="0"/>
		                          			</div>
		                          			<label class="control-label col-md-2 col-sm-2 col-xs-5">Offer Discount
		                                     </label>
		                                     <div class="col-md-4 col-sm-4 col-xs-7" >
		                                     <input type="text" name="offerdiscounttotal" id="offerdiscounttotal" value="0" class="form-control" readonly="" />
		                                    </div>
		                          			 
											
										</div>
										<div class="item form-group">
											<label class="control-label col-md-2 col-sm-2 col-xs-5">Total Payable Amount
		                                    </label>
		                                    <div class="col-md-4 col-sm-4 col-xs-7">
		                          			<input type="text" name="subpayable" class="form-control" placeholder="SubOrder Payable Amount"  required="required" id="subpayable" readonly="" value="0" />
	    
		                        			</div>
		                        			<label class="control-label col-md-2 col-sm-2 col-xs-5">Other Discount
		                                     </label>
		                                     <div class="col-md-4 col-sm-4 col-xs-7" >
		                                     <input type="text" name="otherdiscount" class="form-control" placeholder="Enter Manual Discount(if any)" required="required" id="otherdiscount" value="0" />
		                                    </div>
										</div>
										
										<div class="item form-group">
											<label class="control-label col-md-2 col-sm-2 col-xs-5">Number of items
		                                    </label>
		                                    <div class="col-md-4 col-sm-4 col-xs-7">
		                          			<input type="number" name="noofitems" class="form-control" placeholder="Number of Items" id="noofitems"  value="0" />
	    
		                        			</div>
		                        			<?php
		                                    	$res1=mysql_query("select sum(amount) from tbl_wallet where uid='$userid'");
		                                    	$rows1=mysql_fetch_array($res1);
												
												$res2=mysql_query("select sum(amount) from tbl_wallet_history where userId='$userid'");
												$rows2=mysql_fetch_array($res2);
		                                    	?>
		                        			<label class="col-md-6 col-sm-6 col-xs-12">Available referral amount: <?php if($rows1[0]==""){ echo 0;} else {echo $rows1[0]-$rows2[0]; }?></label>
										<input type="hidden" value="<?php if($rows1[0]==""){ echo 0;} else {echo $rows1[0]-$rows2[0]; }?>" name="availablereferral" id="availablereferral" />
	    							
		                        			<label class=" col-md-6 col-sm-6 col-xs-12 col-md-offset-6 col-sm-offset-6">Want to use referral amount?
		                        				<?php
		                        				$q=mysql_query("select * from tbl_reward");
												$rowss=mysql_fetch_array($q);
												echo "(".$rowss['walletDeduction']."% deduction)";
												?>
		                                    </label>
		                           
		                                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-6 col-sm-offset-6">
		                                    	
		                                    	<input type="radio" value="yes" name="refamt" class="refamt" />YES
		                                    	&nbsp;&nbsp;&nbsp;
		                                    	<input type="radio" value="no" name="refamt" class="refamt" />NO
		                          			
		                        			
		                        			</div>
		                        			
		                        		</div>
										
										<div class="col-md-6 col-sm-12 col-xs-12 col-md-offset-4">
					                        
					                        <input type="button" name="btndone" class="btn btn-success" id="btndone" value="Done"/>&nbsp;
					                    </div>
								      	
								      </div>
								    </div>
								  </div> 
					
					<div class="col-md-6 col-sm-12 col-xs-12 col-md-offset-4">
                        
                        &nbsp;
                    </div>
                    </form>
					&nbsp;&nbsp;&nbsp;
			   	</div>
			   	</div>
			</div>
				</div>
				<div class="col-md-2 col-sm-2 col-xs-12">
					<a href="suborder_dashboard.php?oid=<?php echo $orderid;?>&uid=<?php echo $userid;?>" style="color:#000000;"><button class="btn">View Order</button></a>
					<h4>All Sub Orders</h4>
					<?php
					$result1=mysql_query("select * from tbl_suborders where UserId='$userid' and OrderId='$orderid'") or die(mysql_error());
					if(mysql_affected_rows())
					{
						while($rows1=mysql_fetch_array($result1))
						{
						$suboid=$rows1['SubOrderId'];
						$otypeid=$rows1['OrderTypeId'];
						$amt=$rows1['PayableAmount'];
						$res1=mysql_query("select * from tbl_services where ServiceId='$otypeid'") or die(mysql_error());
						$row2=mysql_fetch_array($res1);
						$otype=$row2['ServiceName'];
						if($otype=='Subscription'||$otype=='subscription')
						{
						?>
						<div class="col-md-12 col-sm-12 col-xs-12" style="border: 1px solid #c0c0c0;background-color:#c0c0c0; padding: 5px;">
						<p style="<?php if($_GET['soid']==$suboid){ echo 'background:#E8DC80;';}?> padding:5px;"><a href="create_subs_suborder.php?oid=<?php echo $orderid;?>&uid=<?php echo $userid;?>&soid=<?php echo $suboid;?>" style="color:#5C69F7;"><?php echo $suboid; ?></a>, <?php echo $otype; ?>, <?php echo "₹".$amt; ?></p>
					</div>
						<?php	
						}
						else {
						?>
						<div class="col-md-12 col-sm-12 col-xs-12" style="border: 1px solid #c0c0c0;background-color:#c0c0c0; padding: 5px;">
						<p style="<?php if($_GET['soid']==$suboid){ echo 'background:#E8DC80;';}?> padding:5px;"><a href="create_suborder.php?oid=<?php echo $orderid;?>&uid=<?php echo $userid;?>&soid=<?php echo $suboid;?>&edit=1" style="color:#5C69F7;"><?php echo $suboid; ?></a>, <?php echo $otype; ?>, <?php echo "₹".$amt; ?></p>
					</div>
						<?php
						}
					?>
					
					<?php
						}
					}
					?>
				</div>
				
				
				<!--<div class="col-md-2 col-sm-2 col-xs-12">
					<h4>All Orders</h4>
					<?php
					$result1=mysql_query("select * from tbl_orders where OrderUserId='$userid' and OrderId='$orderid'") or die(mysql_error());
					if(mysql_affected_rows())
					{
						$rows1=mysql_fetch_array($result1);
						
					?>
					<div class="col-md-12 col-sm-12 col-xs-12" style="border: 1px solid #c0c0c0;background-color:#c0c0c0;">
						<a href="create_suborder.php?oid=<?php echo $rows1['OrderId'];?>&uid=<?php echo $userid;?>" style="color:#000000;">
							
						<table class="table">
							<tr>
								<td>Order Id</td>
								<td><?php echo $rows1['OrderId'];?></td>
							</tr>
							<tr>
								<td>Order Total Amount</td>
								<td><?php echo $rows1['OrderTotalAmount'];?></td>
							</tr>
							<tr>
								<td colspan="2">
									<a href="suborder_dashboard.php?oid=<?php echo $rows1['OrderId'];?>&uid=<?php echo $userid;?>" style="color:#000000;"><button class="btn">View Order</button></a>
								</td>
							</tr>
						</table>
						</a>
					</div>&nbsp;
					<?php
						
					}
					?>
					<?php
					if($editId==0)
					{
					$result=mysql_query("select * from tbl_orders where OrderUserId='$userid' and OrderId!='$orderid'") or die(mysql_error());
					if(mysql_affected_rows())
					{
						while($rows=mysql_fetch_array($result))
						{
					?>
					<div class="col-md-12 col-sm-12 col-xs-12" style="border: 1px solid #c0c0c0;">
						<a href="create_suborder.php?oid=<?php echo $rows['OrderId'];?>&uid=<?php echo $userid;?>" style="color:#000000;">
							
						<table class="table">
							<tr>
								<td>Order Id</td>
								<td><?php echo $rows['OrderId'];?></td>
							</tr>
							<tr>
								<td>Order Total Amount</td>
								<td><?php echo $rows['OrderTotalAmount'];?></td>
							</tr>
							<tr>
								<td colspan="2">
									<a href="suborder_dashboard.php?oid=<?php echo $rows1['OrderId'];?>&uid=<?php echo $userid;?>" style="color:#000000;"><button class="btn">View Order</button></a>
								</td>
							</tr>
						</table>
						</a>
					</div>&nbsp;
					<?php
						}
					}
					}
					?>
					
				</div>-->
				
				
			</div>
			&nbsp;&nbsp;
			
		</div>
	</div>
</div>
<?php
}
}
?>
<?php
include 'footer.php';

?>