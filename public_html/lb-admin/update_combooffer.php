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

function update_offer($id,$offername,$offeramt,$offerdesc,$pvalidity,$validity,$offerstart,$item_pic,$item_pictemp)

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

$interval="INTERVAL ".$validity." DAY";
	

	$query="update tbl_combo_offer set offerName='$offername',amount='$offeramt',offerDescription='$offerdesc',purchaseValidity='$pvalidity',validity='$validity',startDate='$offerstart',expireDate=date_add('$offerstart', $interval),offerPic='$item_pic' where offerId='$id'";

	$result2=mysql_query($query) or die(mysql_error());

	if(mysql_affected_rows())

	{

		  echo "<script>setTimeout(\"location.href = 'combo_offer_list.php';\",600);</script>";

  

		echo '<div class="alert alert-success">Offer Updated Successfully</div>';

		

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

                            <h3>Combo Offer</h3>

                        </div>



                        

                    </div>

                    <div class="clearfix"></div>

       

      

                        <div class="col-md-12 col-sm-12 col-xs-12">

                            <div class="x_panel">

                                <div class="x_title">

                                    <h2><i class="fa fa-bars"></i> Update Offer </h2>

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

			$result=mysql_query("select * from tbl_combo_offer where offerId='$id'") or die(mysql_error());

			if(mysql_affected_rows())

			{

				$data=mysql_fetch_array($result);


		?>

                                   

 <form method="post" role="form" class="form-horizontal" enctype="multipart/form-data">

                                    
<div class="item form-group">

                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="offercode">Offer Name

                                            </label>

                                            <div class="col-md-6 col-sm-6 col-xs-12">

                                           

                                        <input type="text" name="offername" class="form-control col-md-7 col-xs-12" required="" placeholder="Enter Offer Name" value="<?php echo $data['offerName'];?>"/>

                                        

                                            </div>

                                        </div>

                                
                                        
&nbsp;
              <div class="item form-group">

                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="offercode">Offer Description

                    </label>

                    <div class="col-md-6 col-sm-6 col-xs-12">

                   

                <textarea name="offerdesc" class="form-control col-md-7 col-xs-12" required="" placeholder="Enter Offer Description"><?php echo $data['offerDescription']; ?></textarea>

                

                    </div>

                </div>
                                        &nbsp;                          

                                        <div class="item form-group">

                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="offervalue">Offer Amount

                                            </label>

                                            <div class="col-md-2 col-sm-2 col-xs-5">

         

                                	           <input type="text" name="offeramt" class="form-control  col-md-7 col-xs-12" required="" placeholder="Amount" value="<?php echo $data['amount']; ?>"/>                    	

                                				</div>

                                				

                                				

                                				 <label class="control-label col-md-2 col-sm-2 col-xs-11" for="offerunit">Validity after purchase(in days) 

                                            </label>

                                            <div class="col-md-2 col-sm-2 col-xs-5">

         									<input type="text" name="pvalidity" required="required" class="form-control col-md-7 col-xs-12 digitonly" placeholder="Validity" value="<?php echo $data['purchaseValidity'];?>" />         	

                                				</div>

            			                    </div>

                          

            								&nbsp;

            	<div class="item form-group">

                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="offervalue">Offer Start Date

                            </label>

                            <div class="col-md-2 col-sm-2 col-xs-5">

 									<input type="text" id="datepicker" class="form-control date-picker col-md-7 col-xs-12"  name="offerstart"  placeholder="Select Offer Start Date" value="<?php $x=$data['startDate']; $xdate = DateTime::createFromFormat('Y-m-d', $x); $xxdate=$xdate->format('m/d/Y'); echo $xxdate; ?>" >

                        	 </div>

                				

                				 <label class="control-label col-md-2 col-sm-2 col-xs-11" for="offerunit">Time Validity(in days) 

                            </label>

                            <div class="col-md-2 col-sm-2 col-xs-5">

							<input type="text" name="validity" required="required" class="form-control col-md-7 col-xs-12 digitonly" placeholder="Offer Validity" value="<?php echo $data['validity']; ?>" />         	

                				</div>

		                    </div>	

                                        	

			
            			&nbsp;
            			<div class="item form-group">

                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="itpic">Upload Image

                    </label>

                    <div class="col-md-6 col-sm-6 col-xs-12">

                   

                <input type="file" name="itpic" class="form-control col-md-7 col-xs-12" />

                <input type="hidden" name="oldpic" value="<?php echo $data['offerPic']?>" />

                    </div>

                </div>
                                        

                                        &nbsp; 

                                        <div class="ln_solid"> </div>

                                        <div class="form-group">

                                            <div class="col-md-6 col-md-offset-3">

                                                

                                                <input type="submit" name="btnupdate" class="btn btn-success" value="Update Offer"/>&nbsp;

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


				$offername=mysql_real_escape_string($_POST["offername"]);

			$offeramt=mysql_real_escape_string($_POST["offeramt"]);

			$offerdesc=mysql_real_escape_string($_POST["offerdesc"]);
			
			$pvalidity=mysql_real_escape_string($_POST["pvalidity"]);

			$validity=mysql_real_escape_string($_POST["validity"]);
			
			
			//$offerstart=mysql_real_escape_string($_POST["offerstart"]);
			$x=mysql_real_escape_string($_POST["offerstart"]);
			 $xdate = DateTime::createFromFormat('m/d/Y', $x);
			  $offerstart=$xdate->format('Y-m-d');
			   

			if(empty($_FILES['itpic']['tmp_name']) || !is_uploaded_file($_FILES['itpic']['tmp_name']))
			{
				$item_pic=$_POST['oldpic'];
				
				$item_pictemp="";
			}
			else {
				
				
				$item_pic=mysql_real_escape_string($_FILES["itpic"]["name"]);
			
				$item_pictemp=mysql_real_escape_string($_FILES["itpic"]["tmp_name"]);
			}


						update_offer($id,$offername,$offeramt,$offerdesc,$pvalidity,$validity,$offerstart,$item_pic,$item_pictemp);

					

		}

		?>

                                </div>

                                                

                                            

                                            

                                        



                                </div>

                            </div>

                            </div>

                            </div>

                            

<?php include 'footer.php';?>                            

