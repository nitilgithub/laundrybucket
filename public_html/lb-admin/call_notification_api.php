<?php
include('header.php');
include('api_notification.php');


$query = "SELECT DeviceId FROM tblusers where DeviceId!='' and UserId='1664' or UserId='1556'";

$res=mysql_query($query);

while($row=mysql_fetch_array($res))
{
	$registrationIds = array( $row[0] );


$title="Test Message";
	
$pushMessage="notification api";

$response=send_notification($title,$pushMessage,$registrationIds);

echo $response;
}

include('footer.php');
?>