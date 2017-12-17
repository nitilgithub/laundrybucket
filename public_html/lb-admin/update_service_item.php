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

function update_service_item($id,$item_name,$srate,$prate,$priceunit,$service,$servicecat,$item_pic,$item_pictemp)

{

if($item_pictemp!="")
{
	
$target_dir = $_SERVER['DOCUMENT_ROOT'].'/../cdn.laundrybucket.co.in/images/';

$target_file = $target_dir . basename($item_pic);

$uploadOk = 1;

$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

// Check if file already exists
if (file_exists($target_file)) {
	
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
	
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
	
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
	
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($item_pictemp, $target_file)) {
    	
        echo "The file ". basename( $item_pic). " has been uploaded.";
    } else {
    	
        echo "Sorry, there was an error uploading your file.";
    }
}
}		

	$query="update tbl_services_itemsprice set ItemName='$item_name',StandardRate='$srate',PremiumRate='$prate',PriceUnit='$priceunit',ServiceCatId='$servicecat',ServiceId='$service',item_img='$item_pic' where ItemId='$id'";

	$result2=mysql_query($query) or die(mysql_error());

	if($result2)

	{

		  echo "<script>setTimeout(\"location.href = 'service_item_list.php';\",600);</script>";

  

		echo '<div class="alert alert-success">Service Item Updated Successfully</div>';

		

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

                            <h3>Service Item</h3>

                        </div>



                        

                    </div>

                    <div class="clearfix"></div>

       

      

                        <div class="col-md-12 col-sm-12 col-xs-12">

                            <div class="x_panel">

                                <div class="x_title">

                                    <h2><i class="fa fa-bars"></i> Update Service Item </h2>

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

			$result=mysql_query("select * from tbl_services_itemsprice where ItemId='$id'") or die(mysql_error());

			if(mysql_affected_rows())

			{

				$data=mysql_fetch_array($result);


		?>

                                   

                                    <form method="post" role="form" class="form-horizontal" enctype="multipart/form-data">

                                    

                                   

                                    

                                         <div class="item form-group">

                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="itname">Item_Name 

                                            </label>

                                            <div class="col-md-6 col-sm-6 col-xs-12">

                                           

                                        <input type="text" name="itname" value="<?php echo $data["ItemName"]; ?>" class="form-control col-md-7 col-xs-12"/>

                                        

                                            </div>

                                        </div>

                                        

                                        

                                        	&nbsp;
					<div class="item form-group">

            				  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="priceunit">Price Unit 

                                            </label>

                                            

                                             <div class="col-md-6 col-sm-6 col-xs-12">

            				<select name="priceunit" class="styledselect_form_1 form-control">

            

			<option value="-1">Select Price Unit</option>

			
<?php
			$result=mysql_query("select * from tbl_priceunit") or die(mysql_error());

										if(mysql_affected_rows())

	                                  {

		                                while($row=mysql_fetch_array($result))

		                             {
			?>

									<option  value="<?php echo $row['UnitId']; ?>" <?php if($row['UnitId']==$data['PriceUnit']) echo 'selected';?>  style="padding-bottom:7px"><?php echo $row['UnitName']; ?></option>

            <?php
             
             }  
			  }
             
            ?>
		</select>


            			</div>

            			</div>
                                        
					&nbsp;
                                       

                                        <div class="item form-group">

                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="srate">Standard Rate

                                            </label>

                                            <div class="col-md-2 col-sm-2 col-xs-5">

         

                                	           <input type="text" name="srate" value="<?php echo $data["StandardRate"]; ?>" class="form-control digitonly col-md-7 col-xs-12"/>                    	

                                				</div>

                                				

                                				

                                				 <label class="control-label col-md-2 col-sm-2 col-xs-11" for="prate">Premium Rate 

                                            </label>

                                            <div class="col-md-2 col-sm-2 col-xs-5">

         

                                	           <input type="text" name="prate" value="<?php echo $data["PremiumRate"]; ?>" class="form-control digitonly col-md-7 col-xs-12"/>                    	

                                				</div>

            			                    </div>

                          

            								&nbsp;

            		

                                        	

			<div class="item form-group">

            				  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="service">Service 

                                            </label>

                                            

                                             <div class="col-md-6 col-sm-6 col-xs-12">

            				<select name="service" class="styledselect_form_1 form-control">

            

			<option value="-1">Select Service</option>

			
<?php
			$result=mysql_query("select * from tbl_services") or die(mysql_error());

										if(mysql_affected_rows())

	                                  {

		                                while($row=mysql_fetch_array($result))

		                             {
			?>

									<option  value="<?php echo $row['ServiceId']; ?>" <?php if($row['ServiceId']==$data['ServiceId']) echo 'selected';?>  style="padding-bottom:7px"><?php echo $row['ServiceName']; ?></option>

            <?php
             
             }  
			  }
             
            ?>
		</select>


            			</div>

            			</div>


				<div class="item form-group">

            				  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="servicecat">Category

                                            </label>

                                            

                                             <div class="col-md-6 col-sm-6 col-xs-12">

            				<select name="servicecat" class="styledselect_form_1 form-control">

            

			<option value="-1">Select Service Category</option>

	<?php
			$result1=mysql_query("select * from tbl_services_category") or die(mysql_error());

										if(mysql_affected_rows())

	                                  {

		                                while($row1=mysql_fetch_array($result1))

		                             {
			?>

									<option  value="<?php echo $row1['ServiceCatId']; ?>" <?php if($row1['ServiceCatId']==$data['ServiceCatId']) echo 'selected';?>  style="padding-bottom:7px"><?php echo $row1['ServiceCatName']; ?></option>

            <?php
             
             }  
			  }
             
            ?>		

		</select>


            			</div>

            			</div>
                                        

                                        &nbsp;

   <div class="item form-group">

                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="itpic">Upload Image

                    </label>

                    <div class="col-md-6 col-sm-6 col-xs-12">

                   

                <input type="file" name="itpic" class="form-control col-md-7 col-xs-12" />

                <input type="hidden" name="oldpic" value="<?php echo $data['item_img']?>" />

                    </div>

                </div>
                                        

                                        &nbsp;                         	
            				

            				

                                        <div class="ln_solid"> </div>

                                        <div class="form-group">

                                            <div class="col-md-6 col-md-offset-3">

                                                

                                                <input type="submit" name="btnupdate" class="btn btn-success" value="Update Service Item"/>&nbsp;

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


						$item_name=mysql_real_escape_string($_POST["itname"]);

			$srate=mysql_real_escape_string($_POST["srate"]);

			$prate=mysql_real_escape_string($_POST["prate"]);
			
			$priceunit=mysql_real_escape_string($_POST["priceunit"]);
			
			$service=mysql_real_escape_string($_POST["service"]);

			$servicecat=mysql_real_escape_string($_POST["servicecat"]);

			if(empty($_FILES['itpic']['tmp_name']) || !is_uploaded_file($_FILES['itpic']['tmp_name']))
			{
				$item_pic=$_POST['oldpic'];
				
				$item_pictemp="";
			}
			else {
				
				
				$item_pic=mysql_real_escape_string($_FILES["itpic"]["name"]);
			
				$item_pictemp=mysql_real_escape_string($_FILES["itpic"]["tmp_name"]);
			}


						update_service_item($id,$item_name,$srate,$prate,$priceunit,$service,$servicecat,$item_pic,$item_pictemp);

					

		}

		?>

                                </div>

                                                

                                            

                                            

                                        



                                </div>

                            </div>

                            </div>

                            </div>

                            

<?php include 'footer.php';?>                            

