<?php

include 'header.php';

include '../connection.php';

?>

 <script>

 $(document).ready(function () {

  //called when key is pressed in textbox

  $(".digitonly").keypress(function (e) {

     //if the letter is not digit then display error and don't type anything

     if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {

        //display error message

        //$("#errmsg").html("Digits Only").show().fadeOut("slow");

        alert("digit only")

               return false;

    }

   });

});

 </script>

 <?php

function add_new_offer($offercode,$ordertype,$offervalue,$offerunit,$validity,$offerstart,$offerdesc)

{

	$interval="INTERVAL ".$validity." DAY";

	$query="insert into tbl_offer(OfferCode,OrderTypeId,OfferValue,OfferUnit,Validity,StartDate,ExpiryDate,OfferDescription,addon) values('$offercode','$ordertype','$offervalue','$offerunit','$validity','$offerstart',date_add('$offerstart', $interval),'$offerdesc',now())";

	$result2=mysql_query($query) or die(mysql_error());

	if(mysql_affected_rows())

	{

		  

  echo '<div class="alert alert-success">Offer Added Successfully</div>';

		

	}

	else{

		echo '<div class="alert alert-success">Error in processing request</div>';

		

	}

	

}

?>

   <div class="right_col" role="main">



 <div class="">

                    <div class="page-title">

                        <div class="title_left">

                            <h3>Offers</h3>

                        </div>



                        

                    </div>

                    <div class="clearfix"></div>

       

      

                        <div class="col-md-12 col-sm-12 col-xs-12">

                            <div class="x_panel">

                                <div class="x_title">

                                    <h2><i class="fa fa-bars"></i> Add New Offer</h2>

                                    <ul class="nav navbar-right panel_toolbox">

                                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>

                                        </li>

                                    </ul>

                                    <div class="clearfix"></div>

                                </div>

                                <div class="x_content">

                                	

				

    

                                   	<span class="section"> &nbsp;</span>	

                                   	

                                   

                                   

                                    <form method="post" role="form" class="form-horizontal" enctype="multipart/form-data">

                                    

                                   

                                    

                                         <div class="item form-group">

                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="offercode">Offer Code

                                            </label>

                                            <div class="col-md-6 col-sm-6 col-xs-12">

                                           

                                        <input type="text" name="offercode" class="form-control col-md-7 col-xs-12" required="" placeholder="Enter Offer Code"/>

                                        

                                            </div>

                                        </div>

                                        

                                        

                                        	&nbsp;
							<div class="item form-group">

            				  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="ordertype">Order Type

                                            </label>

                                            

                                             <div class="col-md-6 col-sm-6 col-xs-12">

            				<select name="ordertype" class="styledselect_form_1 form-control" required>

            

			<option value="">Select Order Type</option>

			<?php
			$result=mysql_query("select * from tbl_services") or die(mysql_error());

										if(mysql_affected_rows())

	                                  {

		                                while($row=mysql_fetch_array($result))

		                             {
			?>

									<option  value="<?php echo $row['ServiceId']; ?>"  style="padding-bottom:7px"><?php echo $row['ServiceName']; ?></option>

            <?php
             
             }  
			  }
             
            ?>
			

		</select>

		

            			</div>

            			</div>
                                        
&nbsp;
                                       

                                        <div class="item form-group">

                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="offervalue">Offer Value

                                            </label>

                                            <div class="col-md-2 col-sm-2 col-xs-5">

         

                                	           <input type="text" name="offervalue" class="form-control digitonly col-md-7 col-xs-12" required=""/>                    	

                                				</div>

                                				

                                				

                                				 <label class="control-label col-md-2 col-sm-2 col-xs-11" for="offerunit">Offer Value Unit

                                            </label>

                                            <div class="col-md-2 col-sm-2 col-xs-5">

         									<select name="offerunit"  class="styledselect_form_1 form-control" required="">
         										<option value="">Select OfferUnit</option>
         										<option value="flat">FLAT</option>
         										<option value="percent">IN PERCENT(%)</option>
         									</select>

                                	                            	

                                				</div>

            			                    </div>

                          

            								&nbsp;

            		

                                        	

			<div class="item form-group">

            				  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="validity">Time Validity(in days)

                                            </label>

                                            

                                             <div class="col-md-6 col-sm-6 col-xs-12">

            				<input type="text" name="validity" required="required" class="form-control col-md-7 col-xs-12 digitonly" />

		

            			</div>

            			</div>
            			&nbsp;
            			
        <div class="item form-group">

            				  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="servicecat">Offer Start Date

                                            </label>

                                            

                                             <div class="col-md-6 col-sm-6 col-xs-12">

            				<input type="text" id="datepicker" class="form-control date-picker col-md-7 col-xs-12"  name="offerstart"  placeholder="Select Offer Start Date" >
            			</div>

            			</div>

                                        

                                        &nbsp;
                                        <div class="item form-group">

            				  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="offerdesc">Offer Description

                                            </label>

                                            

                                             <div class="col-md-6 col-sm-6 col-xs-12">

            				<input type="text" name="offerdesc" class="form-control col-md-7 col-xs-12" value="" placeholder="Enter Offer Description" />

		

            			</div>

            			</div>
            			&nbsp;

                            	

                                        <div class="ln_solid"> </div>

                                        <div class="form-group">

                                            <div class="col-md-6 col-md-offset-3">

                                                

                                                <input type="submit" name="btnsave" class="btn btn-success" value="Add Offer"/>&nbsp;

                                            </div>

                                        </div>

                                    </form>

                                   

                                 

                                   

                                   

                                   <?php

		if(isset($_POST["btnsave"]))

		{

				$offercode=mysql_real_escape_string($_POST["offercode"]);

			$ordertype=mysql_real_escape_string($_POST["ordertype"]);

			$offervalue=mysql_real_escape_string($_POST["offervalue"]);
			
			$offerunit=mysql_real_escape_string($_POST["offerunit"]);

			$validity=mysql_real_escape_string($_POST["validity"]);
			
			$offerdesc=mysql_real_escape_string($_POST["offerdesc"]);
			
			//$offerstart=mysql_real_escape_string($_POST["offerstart"]);
			$x=mysql_real_escape_string($_POST["offerstart"]);
			 $xdate = DateTime::createFromFormat('m/d/Y', $x);
			  $offerstart=$xdate->format('Y-m-d');
			   


		add_new_offer($offercode,$ordertype,$offervalue,$offerunit,$validity,$offerstart,$offerdesc);

					

		}

		?>

                                </div>

                                                

                                            

                                            

                                        



                                </div>

                            </div>

                            </div>

                            </div>

                            

<?php include 'footer.php';?>                            

