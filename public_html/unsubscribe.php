<?php
include 'connection.php';
if(isset($_GET['uid']))
{
	$uid=$_GET['uid'];
	$res=mysql_query("update tblusers set feedbackFlag=0 where UserId='$uid'") or die(mysql_error());
	if(mysql_affected_rows())
	{
		echo "<h1 style='text-align:center;'>Unsubscription Successfull</h1>";
	}
}
?>