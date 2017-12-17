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

function update_service($id,$service_name)

{

	

	$query="update tbl_services set ServiceName='$service_name' where ServiceId='$id'";

	$result2=mysql_query($query) or die(mysql_error());

	if(mysql_affected_rows())

	{

		  echo "<script>setTimeout(\"location.href = 'service_list.php';\",600);</script>";

  

		echo '<div class="alert alert-success">Service Updated Successfully</div>';

		

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

                            <h3>Services</h3>

                        </div>



                        

                    </div>

                    <div class="clearfix"></div>

       

      

                        <div class="col-md-12 col-sm-12 col-xs-12">

                            <div class="x_panel">

                                <div class="x_title">

                                    <h2><i class="fa fa-bars"></i> Update Services</h2>

                                    <ul class="nav navbar-right panel_toolbox">

                                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>

                                        </li>

                                       

                                        <li><a class="close-link"><i class="fa fa-close"></i></a>

                                        </li>

                                    </ul>

                                    <div class="clearfix"></div>

                                </div>

                                <div class="x_content">

                                	

				

    

                                   	<span class="section"> &nbsp;</span>	

                                   	

                                   	<?php

                                   	if(isset($_GET["id"]))

		{

			

			$id=intval(trim($_GET["id"]));

			$result=mysql_query("select * from tbl_services where ServiceId='$id'") or die(mysql_error());

			if(mysql_affected_rows())

			{

				$data=mysql_fetch_array($result);

				

		?>

                                   

                                    <form method="post" role="form" class="form-horizontal" enctype="multipart/form-data">

  
                                         <div class="item form-group">

                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="servicename">Service_Name 

                                            </label>

                                            <div class="col-md-6 col-sm-6 col-xs-12">

                                           

                                        <input type="text" name="servicename" value="<?php echo $data["ServiceName"]; ?>" class="form-control col-md-7 col-xs-12"/>

                                        

                                            </div>

                                        </div>

     
                                        	&nbsp;


                                        <div class="ln_solid"> </div>

                                        <div class="form-group">

                                            <div class="col-md-6 col-md-offset-3">

                                                

                                                <input type="submit" name="btnupdate" class="btn btn-success" value="Update Service"/>&nbsp;

                                            </div>

                                        </div>

                                    </form>

                                   <?php

                                   }

                                  }

                                  

                                   ?>

  
                                   <?php

		if(isset($_POST["btnupdate"]))

		{

			$id=intval(trim($_GET["id"]));

			

						$service_name=mysql_real_escape_string($_POST["servicename"]);

						update_service($id,$service_name);

					

		}

		?>

                                </div>

                   </div>

                            </div>

                            </div>

                            </div>

                            

<?php include 'footer.php';?>                            

