<?php
include 'header.php';

?>
<title>Best laundry service & Laundry pickup service in Indirapuram </title> 

<style>
fieldset.scheduler-border {
    border: 2px groove #ddd !important;
    padding: 0 1.4em 1.4em 1.4em !important;
    margin: 0 0 1.5em 0 !important;
    -webkit-box-shadow:  0px 0px 0px 0px #000;
            box-shadow:  0px 0px 0px 0px #000;
            color:white;
}

legend.scheduler-border {
        font-size: 1.1em !important;
        font-weight: bold !important;
        text-align: left !important;
        width:auto;
        padding:0 10px;
         border-bottom:none;
         padding-top: 19px;
        color:white;
    }
</style>

<div class="container">
	<div class="row">
		<div>&nbsp;</div>
		<div>&nbsp;</div>
		</div>
	</div>
<section  class="mbr-section mbr-section--relative mbr-parallax-background" id="msg-box4-23" style="background-image: url(assets/images/slide-51024x521-151.jpg);">
    <div class="mbr-overlay"  style="opacity: 0.9; background-color: rgb(34, 34, 34);"></div>
    <div class="mbr-section__container mbr-section__container--isolated container" >
        <div class="row"  style="margin-bottom: 160px; color: #fff;">
            
                <div class="mbr-class-mbr-box_col-sm-12" style="display: ">
                    <div class="mbr-section__container mbr-section__container--middle">
                        <div class="mbr-header mbr-header--auto-align mbr-header--wysiwyg">
                            <h3 class="mbr-header__text" style="text-align: center" >Thank You <br></h3>
                            
                        </div>
                    </div>
                    
                    
                    
                    
                    <div class="mbr-section__container mbr-section__container--middle">
                        <div class="mbr-article mbr-article--auto-align mbr-article--wysiwyg">
                    
                    
                 
                        	
                        	<div class="col-md-6"> 
                        	<p style="text-align: center">
                        	
                        	Thanks for Signing up with us ! &nbsp;  
                        	Please Activate Your Account via  <br/>
                        	<p class="text-center"> - &nbsp; &nbsp;link send to your email </p>
                        	<p class="text-center"> OR </p>
                        	<p class="text-center"> - &nbsp; &nbsp;Code sent to Your Mobile no.</p>
                        	
                        </p><p><br></p>
                        </div>
                        
                        
                                     		
                        	<div class="col-md-6"> 
                        		
                        		   <div class="col-md-12">
                        		   	
                    	 							
 							<?php
 							
 								if(isset($_POST["btnsave"]))
{
		$return_arr = array();
			$uvcode=mysql_real_escape_string(md5($_POST["actcode"]));
			$uemail=mysql_real_escape_string($_SESSION["uemail"]);
			$uph=mysql_real_escape_string($_SESSION["uph"]);
			$query="call spUserVerify('$uemail','$uph','$uvcode')";		
			
			//echo $query;
			$result=mysql_query($query);

 	if(mysql_affected_rows())
	{
		while($row=mysql_fetch_array($result))
		{
			$row_array['status'] = $row['Status'];
			$row_array['ts'] = $row['TS'];
			$ts=$row['TS'];
		
			
		
		}
	echo "<h3 class='text-success bg-success' style='color:black'>Activation status is: ".$row_array['status']."</h3>";	
					//array_push($return_arr,$row_array);
					session_destroy();
		}	
}
		
?>
                    	</div>
                        	
                        	<div class="col-md-12">
                        	<div class="col-md-2"> </div>
                        	
                        	<div class="col-md-3"> </div>
                        	<div class="col-md-7"> 
                        		
                        		<form method="post" class="frm">
					<fieldset class="scheduler-border">
				<legend class="scheduler-border">Account Activation via Mobile</legend>
					        		 
                    <div class="form-group" id="txtemail">
                    
      					<label for="actcode" name="actcode" style="font-weight: lighter"> Enter Your Activation Code<small> sent to Your mobile</small></label>
                      <input type="text"  class="form-control" required=""  value="" name="actcode"  placeholder="Enter Your activation code" style="padding: 9px 18px">
    
                     
                    </div>
                    
                     
                          
                           <div class="form-group">
                           	
           <!-- <input value="RESEND OTP" type="submit" name="btnresend"  style="border:none;background-color: transparent">-->
           &nbsp; &nbsp; &nbsp;
                   <input value="submit" type="submit" name="btnsave" class="btn btn-primary btn-lg" id="btnsave" style="border-radius: 2px; padding: 9px 18px; background-color:rgb(1, 111, 199);border-color: rgb(1, 111, 199);">
              
                   </div>
                   
                  
         
         
         
	         
	         
         </fieldset>
                        
                        <!--  <input value="Submit" type="button" name="btnsave" class="btn btn-primary" id="btnsave" style="display:none">--> 
				</form>
</div>
                        	
                        </div>
                        
                        </div>
                        </div>
                    </div>
                    
                    
                  
                    
                </div>
                
            </div>
        </div>
    </div>
    
</section>
<div class="container">
	<div>&nbsp;</div>
	</div>

<?php
include 'footer.php';
?>