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

function add_newservicecat($servicecat_name)

{

	

	$query="insert into tbl_services_category(ServiceCatName,addon) values('$servicecat_name',now())";

	$result2=mysql_query($query) or die(mysql_error());

	if(mysql_affected_rows())

	{

		  

  echo '<div class="alert alert-success">Service Category Added Successfully</div>';

		

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

                                    <h2><i class="fa fa-bars"></i> Add New Service Category </h2>

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

                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="servicecatname">Service Category_Name 

                                            </label>

                                            <div class="col-md-6 col-sm-6 col-xs-12">

                                           

                                        <input type="text" name="servicecatname" class="form-control col-md-7 col-xs-12"/>

                                        

                                            </div>

                                        </div>

                                        

                                        

                                        	&nbsp;

                                       

                                        <div class="ln_solid"> </div>

                                        <div class="form-group">

                                            <div class="col-md-6 col-md-offset-3">

                                                

                                                <input type="submit" name="btnsave" class="btn btn-success" value="Add Service Category"/>&nbsp;

                                            </div>

                                        </div>

                                    </form>

                                   

                                 

                                   

                                   

                                   <?php

		if(isset($_POST["btnsave"]))

		{

	

				$servicecat_name=mysql_real_escape_string($_POST["servicecatname"]);


		add_newservicecat($servicecat_name);

					

		}

		?>

                                </div>

                                                

                                            

                                            

                                        



                                </div>

                            </div>

                            </div>

                            </div>

                            

<?php include 'footer.php';?>                            

