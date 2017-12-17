<?php
include 'header.php';
include '../connection.php';
?>
<style>
	.addressul 
{
	overflow: hidden;
    
}
.address-bar ul li
{
	width: 257px;
border: 1px solid #DEEAEE;
border-radius: 4px;
-moz-border-radius: 4px;
-webkit-border-radius: 4px;
padding: 10px;
/*margin: 10px 10px 10px 0;*/
margin-left: 15px;
margin-bottom: 10px;
float: left !important;
height: 140px;

}
</style>
 <?php
function update_reguser($id,$ufname,$ulname,$uemail,$uph,$uph2)
{
	
	$query="update tblusers set UserFirstName='$ufname',UserLastName='$ulname',UserEmail='$uemail',UserPhone='$uph',UserPhone2='$uph2'  where UserId='$id'";
	$result2=mysql_query($query) or die(mysql_error());
	if(mysql_affected_rows())
	{
		  echo "<script>setTimeout(\"location.href = 'reguserlist_new.php';\",1000);</script>";
  
		echo '<div class="alert alert-success">User Detail Updated Successfully</div>';
		
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
                            <h3>Registered Users</h3>
                        </div>

                        
                    </div>
                    <div class="clearfix"></div>
       
      
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2><i class="fa fa-bars"></i> Update User Detail </h2>
                                    <ul class="nav navbar-right panel_toolbox">
                                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                        </li>
                                    </ul>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">
                                   	<!--<span class="section"> &nbsp;</span>-->	
                                   	
                                   	<?php
                                   	if(isset($_GET["id"]))
		{
			
			$id=intval(trim($_GET["id"]));
			$result=mysql_query("select * from tblusers where UserId='$id'") or die(mysql_error());
			if(mysql_affected_rows())
			{
				$data=mysql_fetch_array($result);
				
		?>
                                   
                                    <form method="post" role="form" class="form-horizontal" enctype="multipart/form-data">
                                   
                                      <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="itname">First Name
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                           
                                        <input type="text" name="crfname" id="fname" required=""  value="<?php echo $data["UserFirstName"]; ?>" class="form-control col-md-7 col-xs-12" placeholder="Enter User First Name"/>
                                        
                                            </div>
                                        </div> 
                                   
                                    
                                         	&nbsp;
            							
            							
            							  <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="itname">Last Name
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                           
                                        <input type="text" name="crlname" required=""  value="<?php echo $data["UserLastName"];?>" id="lname" required="" class="form-control col-md-7 col-xs-12" placeholder="Enter User Last Name"/>
                                        
                                            </div>
                                        </div>
                                      
            								&nbsp;
            								
            								
            								
            								  <div class="item form-group" id="usemail">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="itname">Email
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                           
                                        <input type="text" name="cremail" value="<?php echo $data["UserEmail"]; ?>" id="email"  class="form-control col-md-7 col-xs-12" placeholder="Enter User Email"/>
                                        
                                            </div>
                                        </div>
                                        
                                     					&nbsp;
                                                    								
            								  <div class="item form-group" id="usmobile">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="itname">Mobile
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                           
                                        <input type="tel" name="crmobile" required="" pattern="[0-9]{10}" title="Enter valid 10 digit mobile number" value="<?php echo $data["UserPhone"]; ?>"  id="mobile" data-inputmask="'mask' : '9999999999'" placeholder="Enter User Mobile No" class="form-control col-md-7 col-xs-12"/>
                                        
                                            </div>
                                        </div>
                                     
                                     &nbsp;
                                     	<div class="item form-group" id="usmobile">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="itname">Alt. Mobile
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                          <input type="tel" name="craltmobile" pattern="[0-9]{10}" title="Enter valid 10 digit mobile number"  value="<?php echo $data["UserPhone2"]; ?>" id="mobile2" data-inputmask="'mask' : '9999999999'" placeholder="Enter User Mobile No" class="form-control col-md-7 col-xs-12"/>
                                        
                                            </div>
                                        </div>&nbsp;
                                     					 <!-- <div class="ln_solid"> </div> -->
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
                                   
                                   
                                   <?php
		if(isset($_POST["btnupdate"]))
		{
			$id=intval(trim($_GET["id"]));
			
				$ufname=mysql_real_escape_string($_POST["crfname"]);
			$ulname=mysql_real_escape_string($_POST["crlname"]);
			$uemail=mysql_real_escape_string($_POST["cremail"]);
			$uph=mysql_real_escape_string($_POST["crmobile"]);
			$uph2=mysql_real_escape_string($_POST["craltmobile"]);
			
			$chkquery="select * from tblusers where(((UserEmail='$uemail'&&UserEmail!='') OR (UserPhone='$uph' && UserPhone!=''))AND UserId!='$id')";
			$chkresult=mysql_query($chkquery) or die(mysql_error());
			if(mysql_num_rows($chkresult)>0)
			{
				echo '<script language="javascript"> alert("Can not Update! This email or mobile already exist") </script>';
			}
			else {
				
				update_reguser($id,$ufname,$ulname,$uemail,$uph,$uph2);		
			}
		
					
		}
		?>
                                </div>
                                                
                                            
                                            
                                        

                                </div>
                            </div>
                            </div>
                            
                            
                            
                            
                            <?php
                                   	if(isset($_GET["id"]))
		{
			
			$id=intval(trim($_GET["id"]));
			$i=1;
					              		$rs1=mysql_query("select * from tblusers_address where UserID='$id'") or die(mysql_error());
										if(mysql_num_rows($rs1)>0)
										{
			?>
       <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2><i class="fa fa-bars"></i> User Addresses </h2>
                                    <ul class="nav navbar-right panel_toolbox">
                                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                        </li>
                                    </ul>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">
                                   	<!--<span class="section"> &nbsp;</span>-->	

			   <div class="col-md-12">
					              <span class="address-bar">
					              	 <ul style="list-style-type:none;margin-left:-50px" class="addressul">
					              		<?php
					              		
											while($row1=mysql_fetch_array($rs1))
											{
												$uaddid=$row1["id"];
												?>
												<li>
								    			<b>Address <?php echo $i; ?> <span class="text-right"><i class="glyphicon glyphicon-edit"></i></span>
								    				<span> <a href="update_useraddress.php?uaddid=<?php echo $uaddid;?>&uid=<?php echo $id; ?>" class="btn btn-sm btn-success" style="float:right"> Edit</a> </span>
								    			</b>
								                <address><i class="glyphicon glyphicon-map-marker"></i> <span class="addressspan"><?php echo $row1["Address"]; ?></span></address>
								               </li>
												<?php
												$i++;
											}
										
					              		?>
					              		
					               </ul>
					             </span>
             		</div>				
	
                                   
                                   
                                   
                                  
                                </div>
                                                
                                            
                                            
                                        

                                </div>
                            </div>
                          <?php
                          }
                          }
                          ?>
                            
                            </div>
                            
<?php include 'footer.php';?>                            
