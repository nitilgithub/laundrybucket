<?php

 include 'header.php';

 include '../connection.php'; ?>

<?php



if(isset($_GET["id"]))

{

	$op=isset($_GET["op"])?$_GET["op"]:0;

	$id=intval($_GET["id"]);

	$result=mysql_query("delete from tbl_employee where empId='$id'") or die(mysql_error());

	if(mysql_affected_rows())

	{
		$res1=mysql_query("delete from tbl_per_employee_roles where empId='$id'");

		if($op==0)

		{

		header("location:employee_list.php");

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