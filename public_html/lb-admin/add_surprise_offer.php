<?php

include 'header.php';

include '../connection.php';

?>

 


   <div class="right_col" role="main">



 <div class="">

                    <div class="page-title">

                        <div class="title_left">

                            <h3>Surprise Offer</h3>

                        </div>



                        

                    </div>

                    <div class="clearfix"></div>

       

      

                        <div class="col-md-12 col-sm-12 col-xs-12">

                            <div class="x_panel">

                                <div class="x_title">

                                    <h2><i class="fa fa-bars"></i>Update Surprise Offer</h2>

                                    <ul class="nav navbar-right panel_toolbox">

                                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>

                                        </li>

                                    </ul>

                                    <div class="clearfix"></div>

                                </div>

                                <div class="x_content">

   <?php
   $res1=mysql_query("select SurpriseRewardAmount from tbl_reward");
   $row1=mysql_fetch_array($res1);
   echo "<p>Current Surprise Offer Amount is ".$row1[0]."</p>";
   ?>
                                   	<span class="section"> &nbsp;</span>	

                                   

                         <form method="post" role="form" class="form-horizontal" enctype="multipart/form-data">

                   
                                        <div class="item form-group">

                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="offervalue">Offer Amount

                                            </label>

                                            <div class="col-md-6 col-sm-6 col-xs-12">

         

                                	           <input type="text" name="offervalue" class="form-control  col-md-7 col-xs-12" required=""/>                    	

                                				</div>

            			                    </div>

                            	

                                        <div class="ln_solid"> </div>

                                        <div class="form-group">

                                            <div class="col-md-6 col-md-offset-3">

                                                

                                                <input type="submit" name="btnsave" class="btn btn-success" value="Set Offer and Reset Values"/>&nbsp;

                                            </div>

                                        </div>

                                    </form>
                                   
            </div>


                                </div>
                                
 <?php

if(isset($_POST["btnsave"]))

{


	$offervalue=mysql_real_escape_string($_POST["offervalue"]);
	

	$query="update tbl_reward set SurpriseRewardAmount='$offervalue' where id=1";

	$result2=mysql_query($query) or die(mysql_error());

	if(mysql_affected_rows())

	{
		$query1=mysql_query("update tbl_wallet set status=0");
		if($query1)
		{

  			echo '<div class="alert alert-success">Surprise Offer Updated Successfully</div>';
		}
		else{

		echo '<div class="alert alert-success">Error in processing request. Cannot update the wallet </div>';

		}

	}

	else{

		echo '<div class="alert alert-success">Error in processing request. Either you entered the same amount again or there is some server error </div>';

	}

	

}

?>
                                               
                                

                            </div>

                            </div>

                            </div>

                            

<?php include 'footer.php';?>                            

