<?php
 include 'header.php';
 include '../connection.php'; ?>
<?php

if(isset($_GET["id"]))
{
	$op=isset($_GET["op"])?$_GET["op"]:0;
	$id=intval($_GET["id"]);
	$result=mysql_query("update tbl_orders set OrderStatusId='5' where OrderId='$id'") or die(mysql_error());
	if(mysql_affected_rows())
	{
		if($op==0)
		{
		header("location:allorder_list_new.php?cancelsuccess");
		}
		else {
			echo "Order Cancel Successfully";
		}
		//echo "<script>setTimeout(\"Well done! Customer Deleted Successfully\",200);</script>";
      //echo "<div class='alert alert-success'>Well done! Price Added Successfully</div>";
      // echo "<script>setTimeout(\"location.href = 'regclient.php';\",1500);</script>";
  // echo "<div class='alert alert-success'>Well done! Price Added Successfully</div>";
		
		
			
		exit;
	}
	else
		{
			header("location:drycleanorder_list.php?cancelfail");
			exit;
		}

}
?>
<?php include 'footer.php'; ?>