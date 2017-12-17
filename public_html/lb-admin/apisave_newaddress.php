<?php

header('Access-Control-Allow-Origin: *');

include '../connection.php';

$uid=intval($_GET["uid"]);

$address=trim($_GET["address"]);

?>



                            <div class="form-group bg-success"> 		

                           <?php

                           $q="insert into tblusers_address(UserID,Address,addon)values('$uid','$address',NOW())";

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

                        