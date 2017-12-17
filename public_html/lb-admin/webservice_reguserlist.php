<?php
ob_start();
session_start();
include '../connection.php';
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
$userlist=array();
$query="";
                                        	
										if(isset($_GET["uid"]))
										{
											$uid=$_GET["uid"];
										$query=	"select * from tblusers where(UserId='$uid')";
										}
										else {
											if($_SESSION['loginrole']==9)
											{
												$query=	"select * from tblusers where franchiseId='".$_SESSION['loginid']."' order by UserId DESC";
											}
											else {					
											$query=	"select * from tblusers order by UserId DESC";
											}
										}
										
                                        $result1=mysql_query($query) or die(mysql_error());
										if(mysql_affected_rows())
	                                  {
		                                while($row=mysql_fetch_array($result1))
		                             {
		                             	$uid=$row["UserId"];
										$refid=$row['UserReference'];
										
		                             	
		                             	$row_array["id"]=$row["UserId"];
									//	$row_array["mobile"]=empty($row["mobile"]) ? $row["usmobile"] : $row["mobile"] ;
										$row_array["name"]=$row["UserFirstName"]." ". $row["UserLastName"];
										$row_array["email"]=$row["UserEmail"] ;
										$row_array["mobile"]=$row["UserPhone"] ;
										$row_array["regdate"]=$row["UserRegistrationDate"];
										$row_array["usertype"]=$row["UserType"] ;
										
										$que1=mysql_query("select count(*) from tbl_orders where OrderUserId='$uid' and OrderStatusId=4");
										$rw=mysql_fetch_array($que1);
										
										$row_array['totaldeliverorder']=$rw[0];
										
										$que2=mysql_query("select sum(PayableAmount) from tbl_orders where OrderUserId='$uid' and OrderStatusId!=5");
										$rw2=mysql_fetch_array($que2);
										
										$row_array['totalbusiness']="₹ ".$rw2[0];
										
										if($row["UserAddress"]=="")
										{
										$result2=mysql_query("select * from tblusers_address where UserId='$uid' order by id DESC");
										$row2=mysql_fetch_array($result2);
										
											$row_array["address"]=$row2["Address"];
										}
										else {
											$row_array["address"]=$row["UserAddress"];
										}
										$res=mysql_query("select * from tbl_reference where RefId='$refid'") or die(mysql_error());
										$row1=mysql_fetch_array($res);
										$row_array['reference']=$row1['RefText'];
										
										$res1=mysql_query("select sum(amount) from tbl_wallet where uid='$uid'");
	                                	$rows1=mysql_fetch_array($res1);
										
										$res2=mysql_query("select sum(amount) from tbl_wallet_history where userId='$uid'");
										$rows2=mysql_fetch_array($res2);
										if($rows1[0]==""){
											$row_array['wallet']="₹ 0";
										} else {
											$row_array['wallet']="₹ ".( $rows1[0]-$rows2[0]); }
										
										
											array_push($userlist,$row_array);
											
if($_SESSION['loginrole']==2){
$query1=mysql_query("select * from tbl_wallet where uid='$uid' and status=0");
if(mysql_num_rows($query1)>0)
{
	$rfquery="select * from tbl_reward";
	$rfresult=mysql_query($rfquery);
	$rfrow=mysql_fetch_array($rfresult);
	
	$surprise_reward=$rfrow["SurpriseRewardAmount"];
	
	$query2=mysql_query("insert into tbl_wallet(uid,title,amount,addon) values('$uid','Surprise Reward','$surprise_reward',now())");
	if(mysql_affected_rows())
	{
		$title="Laundry Bucket Offer";
		$pushMessage="Your wallet updated with INR ".$surprise_reward." as a Surprise Offer. Order now to claim the offer. T&C applied";
		$query3=mysql_query("update tbl_wallet set status=1 where uid='$uid'");
		
			define( 'API_ACCESS_KEY', 'AIzaSyBOMhYjSK9nvPinKOqaCy7i1wAXRblOyUA' );
		    
				$deviceid=$row['DeviceId'];
		        $registrationIds = array( $deviceid );
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
				
				//echo $result;
		   
		
	}
}						
}											
		                             	
									   }
									 
									 echo json_encode($userlist);
									  }
									  
									  
									  mysql_close();
									  ob_end_flush();
									  
		                             	?>