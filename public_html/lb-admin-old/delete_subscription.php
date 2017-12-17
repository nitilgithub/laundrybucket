<?php
 include 'header.php';
 include '../connection.php'; ?>
<?php

if(isset($_GET["id"]))
{
	$op=isset($_GET["op"])?mysql_real_escape_string($_GET["op"]):0;
	$id=intval(mysql_real_escape_string($_GET["id"]));
	$result=mysql_query("delete from tbl_subscriptions where subs_id='$id'") or die(mysql_error());
	if(mysql_affected_rows())
	{
		if($op==0)
		{
		header("location:subscriptionlist.php");
		}
		else {
			echo "Record Delete Successfully";
		}
		//echo "<script>setTimeout(\"Well done! Customer Deleted Successfully\",200);</script>";
      //echo "<div class='alert alert-success'>Well done! Price Added Successfully</div>";
      // echo "<script>setTimeout(\"location.href = 'regclient.php';\",1500);</script>";
  // echo "<div class='alert alert-success'>Well done! Price Added Successfully</div>";
		
		
			
		exit;
	}
	else
		{
			echo "can't deleted try later";
			exit;
		}

}
?>
<?php include 'footer.php'; ?>