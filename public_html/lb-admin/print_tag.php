<?php
@ob_start();
@session_start();
include '../connection.php';
if(!isset($_SESSION["userid"]))
{
		header("location:index.php");
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laundry Bucket Admin Panel! | </title>

    <!-- Bootstrap core CSS -->

    <link href="css/bootstrap.min.css" rel="stylesheet">
    
    <link rel="stylesheet" href="css/bootstrap-table/bootstrap-table.min.css">

    <link href="fonts/css/font-awesome.min.css" rel="stylesheet">
    <link href="css/animate.min.css" rel="stylesheet">

    <!-- Custom styling plus plugins -->
    <link href="css/custom2.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/maps/jquery-jvectormap-2.0.1.css" />
    <link href="css/icheck/flat/green.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="css/progressbar/bootstrap-progressbar-3.3.0.css">
     <link href="css/datatables/tools/css/dataTables.tableTools.css" rel="stylesheet">
    <link rel="stylesheet" href="css/mystyle.css">
    
    <link href="../assets/bootstrap-timepicker.min.css" rel="stylesheet">
  
    
     <script src="js/jquery.min.js"></script>
     <script src="js/bootstrap.min.js"></script>
      <script src="css/bootstrap-table/bootstrap-table.js"></script>
    <script src="css/bootstrap-table/extension/multiple-search/bootstrap-table-multiple-search.js"></script>
   <script src="../assets/formvalidation.js"></script>
   <script src="js/jquery.blockUI.js"></script>
    <!--<script src="css/bootstrap-table.min.js"></script>-->
   <style>
  .nav .open > a, .nav .open > a:hover, .nav .open > a:focus {
    background-color: #535353;
    border-color: #070809;
   }
  </style>
  
  
    
    <!--[if lt IE 9]>
        <script src="../assets/js/ie8-responsive-file-warning.js"></script>
        <![endif]-->

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        
        <script>
        $(function() {
        
  $('#lst-group-item').on('click', function() {
    $('.fa', this)
      .toggleClass('fa fa-plus')
      .toggleClass('fa fa-minus');
  });

});
        </script>
<style>
@media print {
  body * {
     }
  #section-to-print, #section-to-print * {
    visibility: visible;
  -webkit-print-color-adjust:exact; 
  }
  #section-to-print,img, {
    visibility: visible;
    left: 0;
    top: 0;
   -webkit-print-color-adjust:exact; 
  }
  #section-to-print,div {
  
    visibility: visible;
  }
}
</style>
 <style type="text/css" media="print">
  @page { size: 1in 1.5in; }
</style>
</head>

    
   
 <?php
                                        	if(true)
										{
			
												$oid=$_POST['oid'];
												$numclothes=$_POST['numclothes'];
												$otype=$_POST['otype'];
								
                                         $result=mysql_query("select o.Order_PickDate,u.UserFirstName,u.UserLastName from tbl_orders as o join tblusers as u on u.UserId=o.OrderUserId where o.OrderId='$oid'") or die(mysql_error());
											if(	$row1=mysql_fetch_array($result))
										{
											?>



<body onload="window.print()" style="visibility: hidden">
	<div class="container">
		<div class="row">
			<?php
			for($i=1;$i<=$numclothes;$i++)
			{
			?>
			<p style="font-size: 13px; text-align: center;">
				<?php echo $row1['UserFirstName']." ".$row1['UserLastName'];?><br>
				<?php echo date("d-m-Y", strtotime($row1['Order_PickDate'])); ?><br>
				<?php echo $otype;?>,&nbsp;
				<?php echo $i."/".$numclothes; ?>
			</p>
			<?php
			}
			?>
		</div>

         
    </div>

    

 
</body>

 <?php
                                            
     
        }
        }?>

</html>
 