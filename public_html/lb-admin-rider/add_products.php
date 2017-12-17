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
function add_newproducts($ctype, $item_name, $dryminp,$drymaxp,$laundryminp,$laundrymaxp,$filepath)
{
	
	$query="insert into tbl_ratelist (item_name,dminp,dmaxp,lminp,lmaxp,imagename,category) values('$item_name','$dryminp','$drymaxp','$laundryminp','$laundrymaxp','$filepath','$ctype')";
	$result2=mysql_query($query) or die(mysql_error());
	if(mysql_affected_rows())
	{
		  
  echo '<div class="alert alert-success">Product Added Successfully</div>';
		
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
                            <h3>Products</h3>
                        </div>

                        
                    </div>
                    <div class="clearfix"></div>
       
      
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2><i class="fa fa-bars"></i> Add New Product </h2>
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
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="itname">Item_Name 
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                           
                                        <input type="text" name="itname" class="form-control col-md-7 col-xs-12"/>
                                        
                                            </div>
                                        </div>
                                        
                                        
                                        	&nbsp;
                                        
                                       
                                        <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="drymin">Dryclean Min. Price 
                                            </label>
                                            <div class="col-md-2 col-sm-2 col-xs-5">
         
                                	           <input type="text" name="drymin" class="form-control digitonly col-md-7 col-xs-12"/>                    	
                                				</div>
                                				
                                				
                                				 <label class="control-label col-md-2 col-sm-2 col-xs-11" for="drymax">Dryclean Max. Price 
                                            </label>
                                            <div class="col-md-2 col-sm-2 col-xs-5">
         
                                	           <input type="text" name="drymax"  class="form-control digitonly col-md-7 col-xs-12"/>                    	
                                				</div>
            			                    </div>
                          
            								&nbsp;
            		
                                        	
			<div class="item form-group">
            				  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="category">Category 
                                            </label>
                                            
                                             <div class="col-md-6 col-sm-6 col-xs-12">
            				<select name="ctype" class="styledselect_form_1 form-control">
            
			<option value="-1">Select Product Category</option>
			
									<option  value="Men"  style="padding-bottom:7px">Men</option>
            						 <option  value="Women"  style="padding-bottom:7px">Women</option>
            						  <option  value="House-Hold"  style="padding-bottom:7px">House Hold</option>
			
		</select>
		
            			</div>
            			</div>
                                        
                                        &nbsp;
                            	<div class="item form-group">
            				<label for="Image" class="control-label col-md-3 col-sm-3 col-xs-12">Product Image</label>
            				
            				<div class="col-md-6 col-sm-6 col-xs-12">
            				<input type="file" name="file" /> <!--(Max File Size 128MB Resolution 500*500)-->
        
            				</div>
            				
            				
            			  
            				</div>
            				
            				
                                        <div class="ln_solid"> </div>
                                        <div class="form-group">
                                            <div class="col-md-6 col-md-offset-3">
                                                
                                                <input type="submit" name="btnsave" class="btn btn-success" value="Add Product"/>&nbsp;
                                            </div>
                                        </div>
                                    </form>
                                   
                                 
                                   
                                   
                                   <?php
		if(isset($_POST["btnsave"]))
		{
			$ctype=mysql_real_escape_string($_POST["ctype"]);
				$item_name=mysql_real_escape_string($_POST["itname"]);
			$dryminp=mysql_real_escape_string($_POST["drymin"]);
			$drymaxp=mysql_real_escape_string($_POST["drymax"]);
			
			$laundryminp=0;
			$laundrymaxp=0;
			
			$filename=$_FILES["file"]["name"];
			
			if(empty($filename))
						{
							$filepath="#";
						}
						else
							{
						$extension=pathinfo($filename);
						
						if($ctype=='Men')
						{
						@move_uploaded_file($_FILES["file"]["tmp_name"],"../drycleanimages/".date("m-d-y").'_'.time().'.'.$extension["extension"]);
						$filepath="".date("m-d-y").'_'.time().'.'.$extension["extension"];	
						}
						
						elseif($ctype=='Women')
							{
							@move_uploaded_file($_FILES["file"]["tmp_name"],"../drycleanimages/women/".date("m-d-y").'_'.time().'.'.$extension["extension"]);
						$filepath="women/".date("m-d-y").'_'.time().'.'.$extension["extension"];	
							}
							
							elseif($ctype=='House Hold')
							{
							@move_uploaded_file($_FILES["file"]["tmp_name"],"../drycleanimages/house/".date("m-d-y").'_'.time().'.'.$extension["extension"]);
						$filepath="house/".date("m-d-y").'_'.time().'.'.$extension["extension"];	
							}
							
							}
						
			
			
		add_newproducts($ctype, $item_name, $dryminp,$drymaxp,$laundryminp,$laundrymaxp,$filepath);
					
		}
		?>
                                </div>
                                                
                                            
                                            
                                        

                                </div>
                            </div>
                            </div>
                            </div>
                            
<?php include 'footer.php';?>                            
