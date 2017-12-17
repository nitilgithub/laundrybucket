<?php
 include 'header.php';
 include '../connection.php'; ?>
<?php

if(isset($_GET["id"]))
{
	
	$id=intval(mysql_real_escape_string($_GET["id"]));
	$result=mysql_query("delete from tbl_contactenquiry where id='$id'") or die(mysql_error());
	if(mysql_affected_rows())
	{
		header("location:querycontact.php");
		
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