<?php
include 'header.php';
include '../connection.php';
?>

 <?php
function update_reguser($uid,$uaddid,$uaddress)
{
	
	$query="update tblusers_address set Address='$uaddress'  where id='$uaddid'";
	$result2=mysql_query($query) or die(mysql_error());
	if(mysql_affected_rows())
	{
		  echo "<script>setTimeout(\"location.href = 'update_reguser.php?id=$uid';\",1000);</script>";
  
		echo '<div class="alert alert-success">User Address Updated Successfully</div>';
		
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
                                    <h2><i class="fa fa-bars"></i> Update User Address </h2>
                                    <ul class="nav navbar-right panel_toolbox">
                                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                        </li>
                                    </ul>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">
                                   	<!--<span class="section"> &nbsp;</span>-->	
                                   	
                                   	<?php
                                   	if(isset($_GET["uaddid"]))
		{
			
			$uaddid=intval(trim(mysql_real_escape_string($_GET["uaddid"])));
			
			$result=mysql_query("select * from tblusers_address where id='$uaddid'") or die(mysql_error());
			if(mysql_num_rows($result)>0)
			{
				$data=mysql_fetch_array($result);
				
				
		?>
                                   
                                    <form method="post" role="form" class="form-horizontal" enctype="multipart/form-data">
                                   
                                     <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="current address">User Current Address
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                       <input type="text"  value="<?php echo $data["Address"]; ?>"  class="form-control" disabled>
                                            </div>
                                        </div>
                                        &nbsp;
                                        
            							  <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="itname">Change Current Address
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                        <textarea class="form-control  col-md-7 col-xs-12" rows="1"  name="useraddress"> <?php echo $data["Address"]; ?></textarea>
                                            </div>
                                        </div>
                                      
            								&nbsp;
            								
            								
                                     					
                                     					 <!-- <div class="ln_solid"> </div> -->
                                        <div class="form-group">
                                            <div class="col-md-6 col-md-offset-3">
                                                <input type="submit" name="btnupdateaddress" class="btn btn-success" value="Update"/>&nbsp;
                                            </div>
                                        </div>
                                        
                                   
                                        
                                               </form>
                                   
                                   
                                   <?php
                                   }
                                  }
                                  
                                   ?>
                                   
                                   
                                   <?php
		if(isset($_POST["btnupdateaddress"]))
		{
			
			$uaddid=intval(trim(mysql_real_escape_string($_GET["uaddid"])));
			$uid=intval(trim(mysql_real_escape_string($_GET["uid"])));
			
			$uaddress=mysql_real_escape_string($_POST["useraddress"]);
			
		update_reguser($uid,$uaddid,$uaddress);
					
		}
		?>
                                </div>
                                                
                                            
                                            
                                        

                                </div>
                            </div>
                            </div>
                            
                            
                            </div>
                            
<?php include 'footer.php';?>                            
