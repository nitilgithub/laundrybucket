<?php

header('Access-Control-Allow-Origin:*');
header('Content-Type:application/json');
include '../connection.php';
$return_array=array();

$title=mysql_real_escape_string($_GET['title']);
$pushMessage=mysql_real_escape_string($_GET['pushmesg']);
$nid=mysql_real_escape_string($_GET['nid']);

$query = "SELECT DeviceId FROM tblusers where DeviceId!='' and UserId='1664'";

$res=mysql_query($query);

while($row=mysql_fetch_array($res))
{
	$registrationIds = array( $row[0] );


$response=send_notification($title,$pushMessage,$registrationIds);
}


$query1 = "SELECT UserPhone FROM tblusers where UserPhone!='' and UserId='1664'";

$res1=mysql_query($query1);

while($row1=mysql_fetch_array($res1))
{
	$phone =  $row1[0];
	$txtmsg=urlencode("LAUNDRY BUCKET - $pushMessage");
    $ch = curl_init();
    $url= "http://text.sircltech.com/sendsms.jsp?user=laundry&password=123456&mobiles=$phone&sms=$txtmsg&senderid=LONDRY";
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);  //use to hide curl sms send response
    curl_exec($ch);
    curl_close($ch);


}


$update=mysql_query("update tbl_combo_offer set notifyStatus=1 where OfferId='$nid'");
if(mysql_affected_rows()){

$row_array['response']=1;
}
else
	{
		$row_array['response']=0;
	}

array_push($return_array,$row_array);
echo json_encode($return_array);

mysql_close();
?>
<?php
function send_notification($title,$pushMessage,$registrationIds){
$pushStatus = '';
 $gcmRegIds = array();

    
	define( 'API_ACCESS_KEY', 'AIzaSyBOMhYjSK9nvPinKOqaCy7i1wAXRblOyUA' );
    
		$msg = array
		(
			'message' 	=> $pushMessage,
			'title'		=> $title,
			'vibrate'	=> 1,
			'sound'		=> 1,
			'largeIcon'	=> 'large_icon',
			'smallIcon'	=> 'small_icon'
		);
		$fields = array
		(
			'registration_ids' 	=> $registrationIds,
			'data'			=> $msg
		);
		 
		$headers = array
		(
			'Authorization: key=' . API_ACCESS_KEY,
			'Content-Type: application/json'
		);
		 
		$ch = curl_init();
		curl_setopt( $ch,CURLOPT_URL, 'https://android.googleapis.com/gcm/send' );
		curl_setopt( $ch,CURLOPT_POST, true );
		curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
		curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
		curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
		curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
		$result = curl_exec($ch );
		curl_close( $ch );
		return $result;
   }


?>
