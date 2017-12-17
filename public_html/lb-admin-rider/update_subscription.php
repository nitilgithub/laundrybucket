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
function update_subscription($id,$subs_name,$subs_servicetype,$subs_garmenttype,$subs_cost,$subs_weight,$subs_maxpickup,$subs_discountmonthly,$subs_remarks,$extracost,$validity,$extrapickup)
{
	
	$query="update tbl_subscriptions set subs_name='$subs_name',Subs_ServiceType='$subs_servicetype',Subs_GarmentType='$subs_garmenttype',subs_cost='$subs_cost',subs_wt='$subs_weight',subs_maxpickup='$subs_maxpickup',Remark='$subs_remarks',subs_extra_wt_cost='$extracost',subs_validity='$validity',subs_extra_pickup_cost='$extrapickup' where subs_id='$id'";
	$result2=mysql_query($query) or die(mysql_error());
	if(mysql_affected_rows())
	{
		  echo "<script>setTimeout(\"location.href = 'subscriptionlist.php';\",1000);</script>";
  
		echo '<div class="alert alert-success">Subscription Detail Updated Successfully</div>';
		
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
                                    <h2><i class="fa fa-bars"></i> Update Subscription Detail </h2>
                                    <ul class="nav navbar-right panel_toolbox">
                                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                        </li>
                                    </ul>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">
                                	
											   <?php		if(isset($_POST["btnupdate"]))		
											   
											   {
											   	
															$id=intval(trim($_GET["id"]));							
											   
											   $subs_name=mysql_real_escape_string($_POST["subsname"]);								
											   
											   $subs_servicetype=mysql_real_escape_string($_POST["subservicetype"]);								
											   
											   $subs_garmenttype=mysql_real_escape_string($_POST["subgarmenttype"]);			
											   
											   $subs_cost=mysql_real_escape_string($_POST["subscost"]);			
											   
											   $subs_weight=mysql_real_escape_string($_POST["subsweight"]);			
											   
											   $subs_maxpickup=mysql_real_escape_string($_POST["subsmaxpickup"]);						
											   
											   $subs_discountmonthly=0;							
											   
											   $subs_remarks=mysql_real_escape_string($_POST["remarks"]);
											   
											   $extracost=mysql_real_escape_string($_POST["extracost"]);
											   
											   $extrapickup=mysql_real_escape_string($_POST["extrapickup"]);
											   
											   $validity=mysql_real_escape_string($_POST["validity"]);								
											   
											   update_subscription($id,$subs_name,$subs_servicetype,$subs_garmenttype,$subs_cost,$subs_weight,$subs_maxpickup,$subs_discountmonthly,$subs_remarks,$extracost,$validity,$extrapickup);							

}		?>
    
                                   	<span class="section"> &nbsp;</span>	
                                   	
                                   	<?php
                                   	if(isset($_GET["id"]))
		{
			
			$id=intval(trim($_GET["id"]));
			$result=mysql_query("select * from tbl_subscriptions where subs_id='$id'") or die(mysql_error());
			if(mysql_affected_rows())
			{
				$data=mysql_fetch_array($result);
				
		?>
                   
                    <form method="post" role="form" class="form-horizontal" enctype="multipart/form-data">
                   
                      <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="itname">Subscription Name
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                           
                        <input type="text" name="subsname" id="subsname"  value="<?php echo $data["subs_name"]; ?>" class="form-control col-md-7 col-xs-12" placeholder="Enter Subscription Name"/>
                        
                            </div>
                        </div> 
                   
                    
                         	&nbsp;
            							
                      <div class="item form-group">                                            
                      	<label class="control-label col-md-3 col-sm-3 col-xs-12" for="subservice">Subscription Service Type                                            
                      		
                      		</label>                                            
                      		
                      		<div class="col-md-6 col-sm-6 col-xs-12">                                                                                   
                      	
                      	<input type="text" name="subservicetype" id="subservicetype"  value="<?php echo $data["Subs_ServiceType"]; ?>" class="form-control col-md-7 col-xs-12" placeholder="Enter Subscription Service Type Like Wash & Iron"/>                                                                                    
                      	
                      	</div>                                       
                      	
                      	
                      	 </div>                                                                        
                      	 
                      	 &nbsp;            							            								            								            								
                      	 
                      	  <div class="item form-group">                                           
                      	  	
                      	  	 <label class="control-label col-md-3 col-sm-3 col-xs-12" for="subgarment">Subscription Garment Type                                           
                      	  	 	
          	  	 	 </label>                                          
          	  	 	 
          	  	 	   <div class="col-md-6 col-sm-6 col-xs-12">                                                                                 
          	  	 	   	
          	  	 	   	  <input type="text" name="subgarmenttype" id="subgarmenttype"  value="<?php echo $data["Subs_GarmentType"]; ?>" class="form-control col-md-7 col-xs-12" placeholder="Enter Subscription Garment Type Like Apparels"/>                                                                              
          	  	 	   	  
          	  	 	   	        </div>                                     
          	  	 	   	        
          	  	 	   	           </div>                                                                   
          	  	 	   	        
  	 	   	             &nbsp;            								
							  <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="subcost">Subscription Cost ( ₹ )
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                               
                            <input type="text" name="subscost"  value="<?php echo $data["subs_cost"];?>" id="subscost" required="" class="form-control digitonly col-md-7 col-xs-12" placeholder="Enter Subscription Cost"/>
                            
                                </div>
                            </div>
                          
								&nbsp;
            								
            								
							
							  <div class="item form-group" id="usemail">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="itname">Subscription Weight ( Kg )
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                           
                        <input type="text" name="subsweight" pattern="[A-Za-z0-9]+" title="Please Enter alphabets or any digits only"  value="<?php echo $data["subs_wt"]; ?>" id="subsweight"  class="form-control col-md-7 col-xs-12 text-lowercase" placeholder="Enter Subscription Weight"/>
                        
                            </div>
                        </div>
                        	&nbsp;
                           <div class="item form-group">
			            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="extracost">Extra Weight Cost (per kg)
			            </label>
			            <div class="col-md-6 col-sm-6 col-xs-12">
			           
			        <input type="text" name="extracost" required="" id="extracost" value="<?php echo $data["subs_extra_wt_cost"]; ?>"  class="form-control col-md-7 col-xs-12" placeholder="Enter Extra Weight Cost per kg"/>
			        
			            </div>
			        </div>
			        
				&nbsp; 
                        
                     				
                                    								
						  
                 	  <div class="item form-group" id="usemail">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="itname">Subscription Maximum Pickup
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                       
                    <input type="text" name="subsmaxpickup"  value="<?php echo $data["subs_maxpickup"]; ?>" id="subsmaxpickup"  class="form-control col-md-7 col-xs-12 digitonly" placeholder="Enter Subscription Maximum Pickup"/>
                    
                        </div>
                    </div>
                                                    &nbsp; 
                  
				 <div class="item form-group">
	            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="extrapickup">Extra Pickup Cost (per pickup)
	            </label>
	            <div class="col-md-6 col-sm-6 col-xs-12">
	           
	        <input type="text" name="extrapickup" required="" id="extrapickup"  class="form-control col-md-7 col-xs-12" placeholder="Enter Extra Pickup Cost per pickup" value="<?php echo $data["subs_extra_pickup_cost"]; ?>"/>
	        
	            </div>
	        </div>
	        
		&nbsp; 
		   
		
		 <div class="item form-group">
	            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="validity">Validity (in days)
	            </label>
	            <div class="col-md-6 col-sm-6 col-xs-12">
	           
	        <input type="number" name="validity" required="" id="validity"  class="form-control col-md-7 col-xs-12" placeholder="Enter Validity in days" value="<?php echo $data["subs_validity"]; ?>"/>
	        
	            </div>
	        </div>
	        
		&nbsp;                                                                                        
                                                            
                        <div class="item form-group" id="usemail">                                            
                        	
                        	<label class="control-label col-md-3 col-sm-3 col-xs-12" for="itname">Subscription Remarks                                            
                        		
                        		
                        		</label>                                            
                        		
                        		<div class="col-md-6 col-sm-6 col-xs-12">												 
                        			
                        			<textarea name="remarks" class="formcontrol col-md-7 col-xs-12"> <?php echo $data["Remark"]; ?> </textarea>                                            
                        			
                        			</div>                                        
                        			
                        			</div>
 
                                     
                         					&nbsp;
                         					
                         					 <div class="ln_solid"> </div>
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-3">
                                    
                                    <input type="submit" name="btnupdate" class="btn btn-success" value="Update"/>&nbsp;
                                </div>
                            </div>
                                        
                                   
                                        
                           </form>
                                   
                                   
                                   <?php
                                   }
                                  }
                                  
                                   ?>

                                </div>
                                                
                                            
                                            
                                        

                                </div>
                            </div>
                            </div>
                            </div>
                            
<?php include 'footer.php';?>                            
