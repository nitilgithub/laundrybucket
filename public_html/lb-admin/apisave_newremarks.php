<?php

header('Access-Control-Allow-Origin: *');

include '../connection.php';

$uid=intval($_GET["uid"]);
$oid=intval($_GET['oid']);
$remarks=trim($_GET["remarks"]);

?>



                            <div class="form-group bg-success"> 		

                           <?php

                           $q="insert into tbl_ordersremarks(OrderId,UserId,Remarks,RemarksBy,addon)values('$oid','$uid','$remarks','admin',NOW())";

						 // echo $q;

                           $result=mysql_query($q) or die(mysql_error());

									if(mysql_affected_rows())

									{

										

										echo $status=1;

									}

									else {
										
									}

                           ?>

                            

                           

					       

                            </div>

                        