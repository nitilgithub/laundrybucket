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
											$uid=mysql_real_escape_string($_GET["uid"]);
										$query=	"select * from tblusers where(UserId='$uid')";
										}
										else {
											$query=	"select * from tblusers order by UserId DESC";
										}
										
                                        $result1=mysql_query($query) or die(mysql_error());
										if(mysql_affected_rows())
	                                  {
		                                while($row=mysql_fetch_array($result1))
		                             {
		                             	$uid=$row["UserId"];
		                             	
		                             	$row_array["id"]=$row["UserId"];
									//	$row_array["mobile"]=empty($row["mobile"]) ? $row["usmobile"] : $row["mobile"] ;
										$row_array["name"]=$row["UserFirstName"]." ". $row["UserLastName"];
										$row_array["email"]=$row["UserEmail"] ;
										$row_array["mobile"]=$row["UserPhone"] ;
										$row_array["regdate"]=$row["UserRegistrationDate"];
										$row_array["usertype"]=$row["UserType"] ;
										
										$result2=mysql_query("select * from tblusers_address where UserId='$uid' order by id DESC");
										$row2=mysql_fetch_array($result2);
										
											$row_array["address"]=$row2["Address"];
											
											array_push($userlist,$row_array);
		                             	
									   }
									 
									 echo json_encode($userlist);
									  }
									  
									  
									  mysql_close();
									  ob_end_flush();
									  
		                             	?>