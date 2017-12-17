<?php
@ob_start();
@session_start();
include '../connection.php';
$id=intval(mysql_real_escape_string($_GET["id"]));
?>
<?php
  $result=mysql_query("update tbl_usersubscriptions set subs_status='inactive' where srno='$id'");
	
if(mysql_affected_rows())
{
	header("location:usersubscription.php?ref=activated&ias");  //ias stands for-inactivation success
	//echo "cancelled order";
}
else {
	header("location:usersubscription.php?ref=activated&iaf");  //iaf stands for-inactivation Faiure
}
ob_end_flush();
?>