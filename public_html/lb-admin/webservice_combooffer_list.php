<?php

ob_start();

session_start();

include '../connection.php';

header('Access-Control-Allow-Origin: *');

header('Content-Type: application/json');

$offerlist=array();

                                        	

										

                                        $result=mysql_query("select * from tbl_combo_offer") or die(mysql_error());

										if(mysql_affected_rows())

	                                  {

		                                while($row=mysql_fetch_array($result))

		                             {

		                             	

		                             	

										$row_array["id"]=$row["offerId"];

									

										$row_array["offer_name"]=$row["offerName"];


										$row_array["offer_amt"]=$row["amount"];
										
										$row_array["pvalidity"]=$row["purchaseValidity"]." days";
										
										$row_array["validity"]=$row["validity"]." days";

										$row_array["offerimage"]=$row["offerPic"];
										
										
										$row_array['description']=$row['offerDescription'];
										
										$tmpdate=$row["startDate"];
										 $xdate = DateTime::createFromFormat('Y-m-d', $tmpdate);
			 							 $row_array["start_date"]=$xdate->format('d-m-Y');
										 
										 
										 $tmpdate1=$row["expireDate"];
										 $xdate1 = DateTime::createFromFormat('Y-m-d', $tmpdate1);
			 							 $row_array["end_date"]=$xdate1->format('d-m-Y');
										
										$currentdate=date("Y-m-d");
										if($currentdate<=$tmpdate1)
										{
											$row_array['status']="ACTIVE";
											if($row['notifyStatus']!=1){
												$row_array['notify']=1;
												$row_array['nmesg']="Enjoy the new offer ".$row["offerName"]." worth ".$row['amount']."/- .".$row['offerDescription'].". Hurry up!";
											}
											else{
												$row_array['notify']=0;
											}
										}
										else {
											$row_array['status']="EXPIRED";
											$row_array['notify']=0;
										}
										
										if($row['isActive']==1){
											$row_array['isactive']="ACTIVATED";
											$row_array['isactivestatus']=1;
										}
										else
											{
												$row_array['isactive']="DEACTIVATED";
												$row_array['isactivestatus']=0;
											}

										array_push($offerlist,$row_array);

		                             	

										

									 }

									 

									 echo json_encode($offerlist);

									  }

									  

									  

									  mysql_close();

									  ob_end_flush();

									  

		                             	?>