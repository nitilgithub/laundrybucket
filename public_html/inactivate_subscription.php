<?php
@ob_start();
@session_start();
include '../connection.php';
$id=mysql_real_escape_string(intval($_GET["id"]));
?>
<?php
  $result=mysql_query("update tbl_usersubscriptions set subs_status='inactive' where srno='$id'");
	
if(mysql_affected_rows())
{
	header("location:subscription.php?ias");  //aas stands for-inactivation success
	//echo "cancelled order";
}
else {
	header("location:subscription.php?iaf");  //af stands for-inactivation Faiure
}

?>