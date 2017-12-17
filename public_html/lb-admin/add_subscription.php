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
function add_newsubscription($subs_name,$subs_servicetype,$subs_garmenttype,$subs_cost,$subs_weight,$subs_maxpickup,$subs_discountmonthly,$subs_remarks,$extracost,$validity,$extrapickup)
{
	
	$query="insert into tbl_subscriptions (subs_name,Subs_ServiceType,Subs_GarmentType,subs_cost,subs_wt,subs_maxpickup,SubsDiscount_Monthly,Remark,addon,subs_extra_wt_cost,subs_validity,subs_extra_pickup_cost) values('$subs_name','$subs_servicetype','$subs_garmenttype','$subs_cost','$subs_weight','$subs_maxpickup','$subs_discountmonthly','$subs_remarks',NOW(),'$extracost','$validity','$extrapickup')";
	$result2=mysql_query($query) or die(mysql_error());
	if(mysql_affected_rows())
	{
		  
  echo '<div class="alert alert-success">Subscription Added Successfully</div>';
		
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
                            <h3>Subscriptions</h3>
                        </div>

                        
                    </div>
                    <div class="clearfix"></div>
       
      
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2><i class="fa fa-bars"></i> Add New Subscription </h2>
                                    <ul class="nav navbar-right panel_toolbox">
                                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                        </li>
                                    </ul>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">
                                	
									        <?php
									         if(isset($_POST["btnsave"]))		
									         {
									         	$subs_name=mysql_real_escape_string($_POST["subsname"]);
												$subs_servicetype=mysql_real_escape_string($_POST["subservicetype"]);	
												$subs_garmenttype=mysql_real_escape_string($_POST["subgarmenttype"]);		
												$subs_cost=mysql_real_escape_string($_POST["subscost"]);
												$subs_weight=mysql_real_escape_string($_POST["subsweight"]);
												$subs_maxpickup=mysql_real_escape_string($_POST["subsmaxpickup"]);
												$extracost=mysql_real_escape_string($_POST["extracost"]);	
												$extrapickup=mysql_real_escape_string($_POST["extrapickup"]);
												$subs_discountmonthly=0;	
												$subs_remarks=mysql_real_escape_string($_POST["remarks"]);
												
												$validity=mysql_real_escape_string($_POST["validity"]);
												
						add_newsubscription($subs_name,$subs_servicetype,$subs_garmenttype,$subs_cost,$subs_weight,$subs_maxpickup,$subs_discountmonthly,$subs_remarks,$extracost,$validity,$extrapickup);							
											
											 }	
										   ?>
    
                                   	<span class="section"> &nbsp;</span>	
                                   	
                                   
                                   
                                    <form method="post" role="form" class="form-horizontal" enctype="multipart/form-data">
                                   
      <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="itname">Subscription Name
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
           
        <input type="text" name="subsname" id="subsname" required=""  class="form-control col-md-7 col-xs-12" placeholder="Enter Subscription Name"/>
        
            </div>
        </div> 

         	&nbsp;																														   
         	
         	<div class="item form-group">                                            
         		
         		<label class="control-label col-md-3 col-sm-3 col-xs-12" for="itsubservicetype">Subscription Service Type                                            
         			
         			</label>                                            
         			
         			<div class="col-md-6 col-sm-6 col-xs-12">                                                                                   
         				
         				<input type="text" name="subservicetype" id="subservicetype" required=""  class="form-control col-md-7 col-xs-12" placeholder="Enter Subscription Service Type like Wash & Iron"/>                                                                                    
         				
         				</div>                                        </div> 
			            									
			            									
					&nbsp;																														   
					
					<div class="item form-group">                                            
					
					<label class="control-label col-md-3 col-sm-3 col-xs-12" for="subgarment">Subscription Garment Type                                            
					
					</label>                                            
					
					<div class="col-md-6 col-sm-6 col-xs-12">                                                                                   
					
					<input type="text" name="subgarmenttype" id="subgarmenttype" required=""  class="form-control col-md-7 col-xs-12" placeholder="Enter Subscription Garment Type Like Apparels and Household"/>                                                                                    
					
					</div>                                        
					
					</div> 										
					
					&nbsp;
		
		  <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="itname">Subscription Cost ( ₹ )
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
           
        <input type="text" name="subscost" required=""  id="subscost" required="" class="form-control digitonly col-md-7 col-xs-12" placeholder="Enter Subscription Cost"/>
        
            </div>
        </div>
      
			&nbsp;
			
			
			
			  <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="itname">Subscription Weight ( Kg )
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">								 
            	
            	<input type="text" name="subsweight" required=""  id="subsweight" pattern="[A-Za-z0-9]+" title="Please Enter alphabets or any digits only"  class="form-control col-md-7 col-xs-12 text-lowercase" placeholder="Enter Subscription Weight"/>
        
            </div>
        </div>
        
     					&nbsp;
     					 <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="extracost">Extra Weight Cost (per kg)
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
           
        <input type="text" name="extracost" required="" id="extracost"  class="form-control col-md-7 col-xs-12" placeholder="Enter Extra Weight Cost per kg"/>
        
            </div>
        </div>
        
	&nbsp; 
                    								
			  
     	  <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="itname">Subscription Maximum Pickup
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
           
        <input type="text" name="subsmaxpickup" required="" id="subsmaxpickup"  class="form-control digitonly col-md-7 col-xs-12" placeholder="Enter Subscription Maximum Pickup"/>
        
            </div>
        </div>
        
	&nbsp;   
	 <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="extrapickup">Extra Pickup Cost (per pickup)
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
           
        <input type="text" name="extrapickup" required="" id="extrapickup"  class="form-control col-md-7 col-xs-12" placeholder="Enter Extra Pickup Cost per pickup"/>
        
            </div>
        </div>
        
	&nbsp; 
	   
	
	 <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="validity">Validity (in days)
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
           
        <input type="number" name="validity" required="" id="validity"  class="form-control col-md-7 col-xs-12" placeholder="Enter Validity in days"/>
        
            </div>
        </div>
        
	&nbsp;                                                    								            								                                       	  
	
	<div class="item form-group">                                            
		
		<label class="control-label col-md-3 col-sm-3 col-xs-12" for="itname">Remarks                                            
			
			</label>                                            
			
			<div class="col-md-6 col-sm-6 col-xs-12">                                                                                   
				
				<textarea name="remarks" class="formcontrol col-md-7 col-xs-12"> </textarea>                                                                                    
				
				</div>                                        
				
				</div>                                     
     
     					&nbsp;
     					
     					 <div class="ln_solid"> </div>
        <div class="form-group">
            <div class="col-md-6 col-md-offset-3">
                
                <input type="submit" name="btnsave" class="btn btn-success" value="Submit"/>&nbsp;
            </div>
        </div>
        
   
        
               </form>
                                   
                                 
                                   
                                   
                                </div>
                                                
                                            
                                            
                                        

                                </div>
                            </div>
                            </div>
                            </div>
                            
<?php include 'footer.php';?>                            
