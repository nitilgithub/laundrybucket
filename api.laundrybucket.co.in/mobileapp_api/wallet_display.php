<?php
ob_start();
session_start();
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
include '../connection2.php';
$link = mysqli_connect($servername, $username, $password,$db);
if (!$link) {
    die("Connection failed: " . mysqli_connect_error());
}

$user_wallet=array();
//$uloginid=$_SESSION["uloginid"];
$uid=intval($_GET["uid"]);
//global $usemail;
										
		
												$i=0;
                                        $result2=mysqli_query($link,"select * from tbl_wallet where uid='$uid' order by id DESC") or die(mysqli_error($link));
										if(mysqli_num_rows($result2)>0)
	                                  {
		                                while($row=mysqli_fetch_array($result2))
		                              {
		                             	 
		                             	 
		                             	$row_array["srno"]=$i;
										$row_array["title"]=$row["title"];
										$row_array["amount"]=$row["amount"];
										$row_array["addon"]=$row["addon"];
										$row_array["status"]=1;
										
										array_push($user_wallet,$row_array);
		                            }
									 
									 }
									  
										else
											{
												$row_array["status"]=0;
												$row_array['message'] = "Your Wallet is Empty";
												$row_array['title']="Alert"; // Alert Title
												array_push($user_wallet,$row_array);
											}
									echo json_encode($user_wallet);	
									   mysqli_close($link);
									  ob_end_flush();
									  
		                             	?>