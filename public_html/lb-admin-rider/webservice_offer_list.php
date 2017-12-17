<?php

ob_start();

session_start();

include '../connection.php';

header('Access-Control-Allow-Origin: *');

header('Content-Type: application/json');

$offerlist=array();

                                        	

										

                                        $result=mysql_query("select * from tbl_offer") or die(mysql_error());

										if(mysql_affected_rows())

	                                  {

		                                while($row=mysql_fetch_array($result))

		                             {

		                             	

		                             	

										$row_array["id"]=$row["OfferId"];

									

										$row_array["offer_code"]=$row["OfferCode"];


										$row_array["offer_value"]=$row["OfferValue"];
										
										$row_array["offer_unit"]=$row["OfferUnit"];
										
										$row_array["validity"]=$row["Validity"]." days";

										$tmpdate=$row["StartDate"];
										 $xdate = DateTime::createFromFormat('Y-m-d', $tmpdate);
			 							 $row_array["start_date"]=$xdate->format('d-m-Y');
										 
										 
										 $tmpdate1=$row["ExpiryDate"];
										 $xdate1 = DateTime::createFromFormat('Y-m-d', $tmpdate1);
			 							 $row_array["end_date"]=$xdate1->format('d-m-Y');
										
										$currentdate=date("Y-m-d");
										if($currentdate<=$tmpdate1)
										{
											$row_array['status']="ACTIVE";
										}
										else {
											$row_array['status']="EXPIRED";
										}
										
										//$row_array["start_date"]=$row["StartDate"] ;
										
										$otypeid=$row["OrderTypeId"] ;
										
										$res=mysql_query("select * from tbl_services where ServiceId='$otypeid'") or die(mysql_error());
										
										$rows=mysql_fetch_array($res);

										$row_array["service_name"]=$rows['ServiceName'];
										
										$row_array['description']=$row['OfferDescription'];
										
										
$row_array['offerdetail']="Code: ".$row_array["offer_code"]."<br>Value: ".$row_array["offer_value"]."<br>Unit: ".$row_array["offer_unit"]."<br>Validity: ".$row_array["validity"]."<br>StartDate: ".$row_array["start_date"]."<br>EndDate: ".$row_array["end_date"]."<br>Status: ".$row_array['status'];										

										array_push($offerlist,$row_array);

		                             	

										

									 }

									 

									 echo json_encode($offerlist);

									  }

									  

									  

									  mysql_close();

									  ob_end_flush();

									  

		                             	?>