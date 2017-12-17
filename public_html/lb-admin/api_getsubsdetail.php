<?php
include '../connection.php'; 
$subs_id = $_GET['subsid'];

$uid=$_GET['uid'];

$res=mysql_query("select * from tbl_usersubscriptions where UserId='$uid' and subs_id='$subs_id' and subs_status='activated'");

if(mysql_num_rows($res)>0){
	
		echo "You already have this subscription. Try another or try later.";
}
else {
	
	
$query  = "SELECT * FROM tbl_subscriptions WHERE subs_id='$subs_id'";
$result = mysql_query($query) or die(mysql_error());
$row=mysql_fetch_array($result)  ?>

   									<label class="control-label col-md-3 col-sm-3 col-xs-12" for="subsname"> Subscription name 
                                            </label>
                                            <div class="col-md-3 col-sm-2 col-xs-5" >
         
                                	        <input type="text" name="subs_name" value="<?php echo $row["subs_name"]; ?>" id="subsname" class="form-control col-md-7 col-xs-12" readonly />                    	
                                				</div>
                                				
                                				
                                				 <label class="control-label col-md-3 col-sm-2 col-xs-11" for="subsservicetype">Subscription Service Type 
                                            </label>
                                            <div class="col-md-3 col-sm-2 col-xs-5" >
         
                                	           <input type="text" name="subsservicetype" value="<?php echo $row["Subs_ServiceType"]; ?>" id="subsservicetype" class="form-control col-md-7 col-xs-12" readonly />                    	
                                				</div>
                                
                                </div>
                                
                                 &nbsp;
                                 <br/>
                                <div class="form-group">				
         							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="subscost"> Subscription Cost
                                            </label>
                                            <div class="col-md-3 col-sm-2 col-xs-5" >
         
                                	        <input type="text" name="subs_cost" value="<?php echo $row["subs_cost"]; ?>" id="subscost" class="form-control col-md-7 col-xs-12" readonly />                    	
                                				</div>
                                				
                                				
                                				 <label class="control-label col-md-3 col-sm-2 col-xs-11" for="subswt">Subscription Weight 
                                            </label>
                                            <div class="col-md-3 col-sm-2 col-xs-5" >
         
                                	           <input type="text" name="subs_wt" value="<?php echo $row["subs_wt"]; ?>" id="subswt" class="form-control col-md-7 col-xs-12" readonly/>                    	
                                				</div>
                                		</div>
                                		 &nbsp;
                                
           <div class="form-group">				
					<label class="control-label col-md-3 col-sm-3 col-xs-12" for="subscost">Subs_Maximum Pickup					
					</label>					
					<div class="col-md-3 col-sm-2 col-xs-5" >					
					 					
					    <input type="text" name="subs_maxpickup" value="<?php echo $row["subs_maxpickup"]; ?>" id="subscost" class="form-control col-md-7 col-xs-12" readonly />                    						
					</div>					
					
					 <label class="control-label col-md-3 col-sm-2 col-xs-11" for="subswt">Subscription Garment Type 					
					</label>					
					<div class="col-md-3 col-sm-2 col-xs-5" >					
					 					
					    <input type="text" name="subs_garmenttype" value="<?php echo $row["Subs_GarmentType"]; ?>" id="subswt" class="form-control col-md-7 col-xs-12" readonly />                    						
					</div>
                                 </div>
                  &nbsp;                 
                  <div class="form-group">					
                  	<label class="control-label col-md-3 col-sm-3 col-xs-12" for="extrawtcost">
                  		
                  		
                  		Subs_Extra Weight Cost            
                  		
                  		
      		</label>            
      		
      		<div class="col-md-3 col-sm-2 col-xs-5" >            
      			
      			<input type="text" name="extrawtcost" value="<?php echo $row["subs_extra_wt_cost"]; ?>" id="extrawtcost" class="form-control col-md-7 col-xs-12" readonly />                    					
      			
      			</div>				 
      			
      			<label class="control-label col-md-3 col-sm-2 col-xs-11" for="v">
      				
      				Subs_Extra Pickup Cost             
      				
      				</label>            
      				
			<div class="col-md-3 col-sm-2 col-xs-5" >                    
				
				<input type="text" name="extrapickupcost" value="<?php echo $row["subs_extra_pickup_cost"]; ?>" id="extrapickupcost" class="form-control col-md-7 col-xs-12" readonly/>                    					
				
				</div>                                 
				
				</div>&nbsp;         
				
				<div class="form-group">								
					
					<label class="control-label col-md-3 col-sm-3 col-xs-12" for="subscost">Validity (in days)               
						
						</label>            
						
						<div class="col-md-3 col-sm-2 col-xs-5" >          
							
							<input type="text" name="validity" value="<?php echo $row["subs_validity"]; ?>" id="validity" class="form-control col-md-7 col-xs-12" readonly />                    					
							
							</div>	    				                                
      								
      					</div>                                         				

<?php  } ?>

            					