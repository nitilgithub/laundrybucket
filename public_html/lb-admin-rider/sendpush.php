<?php include 'header.php'; ?>
<div class="right_col" role="main">
  <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Dashboard
            <small>Control panel</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
    <h1>Google Cloud Messaging (GCM) Server</h1>
    <form method = 'POST'>
    	 <div class="form-group">
    	 	<label>Title</label>
            <input type="text" name="title" class="form-control" />
        </div>
        <div class="form-group">
        	<label>Message</label>
            <input type="text" name="message" class="form-control" />
        </div>
        <div>
            <input type = 'submit' name="btnpush" value = 'Send Push Notification via GCM' class="btn btn-info">
        </div>
        
    </form>
 </section>
 </div><!-- /.content -->
 <?php
$pushStatus = '';
 $gcmRegIds = array();
if(isset($_POST["btnpush"])) {
    $pushMessage = $_POST['message'];
	$title=$_POST["title"];
	
	$res=mysql_query("insert into tbl_notifications(title,text,addon) values('$title','$pushMessage',now())");
	if($res)
	{
	define( 'API_ACCESS_KEY', 'AIzaSyBOMhYjSK9nvPinKOqaCy7i1wAXRblOyUA' );
    $query = "SELECT DeviceId FROM tblusers where DeviceId!='' and UserId='1664'";
    if($query_run = mysql_query($query)) {

        //$result=mysqli_query($link,"insert into tbl_push_message(title,message) values('$title','$pushMessage')");
        
        while($query_row = mysql_fetch_array($query_run)) {
        	
        //$message = array('message' => $pushMessage);
		//$pushtitle=array('title'=>$title);
		
        $registrationIds = array( $query_row[0] );
		// prep the bundle
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
		echo $result;
   }
 }
else {
	echo "error in query";
}
}
else {
	echo "Notification not inserted";
}
}
?>
      </div><!-- /.content-wrapper -->
<?php include 'footer.php'; ?>