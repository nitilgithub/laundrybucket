<?php
@ob_start();
@session_start();
include '../connection.php';

header('Access-Control-Allow-Origin: *');

header('Content-Type: application/json');

$uemail=trim($_GET["uemail"]);

$uphone=trim($_GET["uphone"]);

$return_array=array();

     

	 $q="select * from tblusers where((UserEmail='$uemail'&&UserEmail!='') OR (UserPhone='$uphone' && UserPhone!=''))";

	 $result1=mysql_query($q) or die(mysql_error());

	 $count=mysql_num_rows($result1);



							if(mysql_num_rows($result1)>0)

									{

										$row=mysql_fetch_array($result1);



										$rows["status"]=1;


										$userid=$row["UserId"];

										$rows["userid"]=$row["UserId"];

										$rows["address"]=$row["UserAddress"];

										$rows["email"]=$row["UserEmail"];

										$rows["phone"]=$row["UserPhone"];

										$rows["phone2"]=$row["UserPhone2"];

										$rows["ufname"]=$row["UserFirstName"];

										$rows["ulname"]=$row["UserLastName"];
										
										$rows["city"]=$row["UserCity"];
										$rows["reference"]=$row["UserReference"];
										
										$rows['franchiseid']=$row['franchiseId'];

			
										$i=1;

					              		$rs1=mysql_query("select * from tblusers_address where UserID='$userid'") or die(mysql_error());

										if(mysql_num_rows($rs1)>0)

										{

											while($row1=mysql_fetch_array($rs1))

											{

												 $rows["unloginuaddress"]='<li><b>Address'.$i.'<span class="text-right"><i class="glyphicon glyphicon-edit"></i></span></b> 

				 <address><i class="glyphicon glyphicon-map-marker"></i> <span id="addressp" class="addressspan'.$i.'">'.$row1["Address"].'</span></address>

				 <button type="button" class="btn g-back btn-block btn-success btnaddress" title="'.$row1["Address"].'" data-target="#collapseTwo" data-toggle="collapse"  aria-expanded="false" aria-controls="collapseTwo">Select</button></li>';

												

												$i++;

												array_push($return_array,$rows);

												

											}

										}

										

										else {
											array_push($return_array,$rows);
										}	
								
						}

							else {

								$rows["status"]=0;

								array_push($return_array,$rows);

							}

									

						echo json_encode($return_array);

						mysql_close();	

						 ?> 	

						 

                           