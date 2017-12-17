<?php
ob_start();
session_start();
include '../connection.php';
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
$userlist=array();
$query="";
   if(isset($_GET['v']))
   {
   	$v=intval($_GET['v']);                                     	
										if(isset($_GET["uid"]))
										{
											$uid=$_GET["uid"];
										$query=	"select * from tblusers where(UserId='$uid')";
										}
										else {
											$query=	"select * from tblusers order by UserId DESC limit 0,$v";
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
										
										$row_array['client_detail']=$row["UserId"]."<br>".$row["UserFirstName"]." ". $row["UserLastName"]."<br>".$row["UserEmail"]."<br>".$row["UserPhone"]."<br>".$row_array["address"];
										
											array_push($userlist,$row_array);
		                             	
									   }
		 }
									 
									 echo json_encode($userlist);
									  }
									  
									  
									  mysql_close();
									  ob_end_flush();
									  
		                             	?>