<?php
include 'header.php';
include '../connection.php';
require '../class.phpmailer.php';
require '../class.smtp.php';
?>

<?php
function submit_order($uid,$name,$ord_type,$email,$mobile,$address,$pickup_date,$order_status_id,$delivery_type,$order_weight,$order_amt,$order_date,$delivery_date,$order_via,$createdby)
{
	$ord_type=mysql_real_escape_string($_GET["ref"]);
	$result=mysql_query("insert into tbl_neworders(OrderType,OrderUserId,OrderShipName,OrderEmail,OrderPhone,OrderShipAddress,Order_PickDate,OrderDate,OrderStatusId,OrderDeliveryType,OrderTotalAmount,OrderTotalWeight,delivery_date,Order_Via,CreatedBy) values('$ord_type',$uid,'$name','$email','$mobile','$address','$pickup_date','$order_date','$order_status_id','$delivery_type',$order_amt,$order_weight,'$delivery_date','$order_via','$createdby')") or die(mysql_error());
							if(mysql_affected_rows())
							{
							//$ordid=mysql_insert_id();
							
							}
}
?>
	

   <div class="right_col" role="main">

 <div class="">
                    <div class="page-title">
                        <div class="title_left">
                            <h3>Upload Orders</h3>
                        </div>
                       
                        
                        <div class="title_right">
                         <form method="post" role="form" class="form-horizontal" enctype="multipart/form-data" >
                        
                                        <div class="ln_solid"> </div>
                                        <div class="form-group">
                                            <div class="col-md-6 col-md-offset-3">
                                               <input type="submit" name="btnfilter" class="btn btn-success" value="Filter or get Emails"/>&nbsp;
                                            </div>
                                            
                                             <div class="col-md-6 col-md-offset-3">
                                               <input type="submit" name="btnfilter2" class="btn btn-success" value="get orders from orders table"/>&nbsp;
                                            </div>
                                            
                                             <div class="col-md-6 col-md-offset-3">
                                               <input type="submit" name="btnfilter3" class="btn btn-success" value="change orderid series"/>&nbsp;
                                            </div>
                                        </div>
                                    </form>
                        </div>
                        
                        
                         
<?php
if(isset($_POST["btnfilter3"]))
{
	$newoid=608;
  $res11=mysql_query("select * from tbl_ordersbbr"); //fetch Excel Uploaded Orders from temporary table ie tbl_neworders 
  while($row11=mysql_fetch_array($res11))
  {
  	
  	$ordid=$row11["OrderId"]; //get order phoneno
	
			$res12=mysql_query("update tbl_ordersbbr set OrderId='$newoid' where(OrderId='$ordid')");
			$newoid=$newoid+1;
			echo $newoid."<br/>";
			
	}	
}
?>                     
                        
<?php
if(isset($_POST["btnfilter"]))
{
  $res3=mysql_query("select * from tbl_neworders where OrderEmail=''"); //fetch Excel Uploaded Orders from temporary table ie tbl_neworders 
  while($row3=mysql_fetch_array($res3))
  {
  	$ordph=$row3["OrderPhone"]; //get order phoneno
	$res4=mysql_query("select * from tbl_orders where(OrderPhone=$ordph && OrderEmail!='')"); //check for email exist in original table tbl_orders against mobileno
	if(mysql_num_rows($res4)>0) //if email exist against mob no
	{
			$row4=mysql_fetch_array($res4);
			$getorder_email=$row4["OrderEmail"]; //get email from order table
			
			$res8=mysql_query("update tbl_neworders set OrderEmail='$getorder_email' where(OrderPhone='$ordph')");
			
	}
	else {
		echo "email not exist in table orders";
	}
	
	
  }	
}
?>

<?php
if(isset($_POST["btnfilter2"]))
{
  $res3=mysql_query("select * from tbl_orders WHERE(month(OrderDate)>7 && month(OrderDate)< 11)"); //Fetch Phone no from original table tbl_orders  
  while($row3=mysql_fetch_array($res3))
  {
  	$ordph=$row3["OrderPhone"]; //get order phoneno
	$res4=mysql_query("select * from tbl_neworders where(OrderPhone=$ordph)"); //check for email exist in original table tbl_orders against mobileno
	if(mysql_num_rows($res4)>0) //if email exist against mob no
	{
		//echo "Phone exist in table orders";	
	}
	else {
		
			$oreceiptid=($row3["OrderReceiptId"]=='')?"NULL":"'".$row3["OrderReceiptId"]."'";
			$otype=($row3["OrderType"]=='')?"NULL":"'".$row3["OrderType"]."'";
			$osubtype=($row3["OrderSubType"]=='')?"NULL":"'".$row3["OrderSubType"]."'";
			$ouserid=($row3["OrderUserId"]=='')?"NULL":"'".$row3["OrderUserId"]."'";
			$usubsid=($row3["User_Subsid"]=='')?"NULL":"'".$row3["User_Subsid"]."'";
			$ota=($row3["OrderTotalAmount"]=='')?"NULL":"'".$row3["OrderTotalAmount"]."'";
			$otw=($row3["OrderTotalWeight"]=='')?"NULL":"'".$row3["OrderTotalWeight"]."'";
			$oshipname=($row3["OrderShipName"]=='')?"NULL":"'".$row3["OrderShipName"]."'";
			$oshipaddress=($row3["OrderShipAddress"]=='')?"NULL":"'".$row3["OrderShipAddress"]."'";
			$ophone=($row3["OrderPhone"]=='')?"NULL":"'".$row3["OrderPhone"]."'";
			$oemail=($row3["OrderEmail"]=='')?"NULL":"'".$row3["OrderEmail"]."'";
			$odate=($row3["OrderDate"]=='')?"NULL":"'".$row3["OrderDate"]."'";
			$ostatusid=($row3["OrderStatusId"]=='')?"NULL":"'".$row3["OrderStatusId"]."'";
			$odtype=($row3["OrderDeliveryType"]=='')?"NULL":"'".$row3["OrderDeliveryType"]."'";
			$opickdate=($row3["Order_PickDate"]=='')?"NULL":"'".$row3["Order_PickDate"]."'";
			$opicktime=($row3["Order_PickTime"]=='')?"NULL":"'".$row3["Order_PickTime"]."'";
			$oreview=($row3["Review"]=='')?"NULL":"'".$row3["Review"]."'";
			$oreceiptpic=($row3["OrderReceiptPic"]=='')?"NULL":"'".$row3["OrderReceiptPic"]."'";
			$order_via=($row3["Order_Via"]=='')?"NULL":"'".$row3["Order_Via"]."'";
			$wda=($row3["walletdeduction_amt"]=='')?"NULL":"'".$row3["walletdeduction_amt"]."'";
			$ocy=($row3["CreatedBy"]=='')?"NULL":"'".$row3["CreatedBy"]."'";
			$oddate=($row3["delivery_date"]=='')?"NULL":"'".$row3["delivery_date"]."'";
			
			$result=mysql_query("insert into tbl_neworders(OrderReceiptId,OrderType,OrderSubType,OrderUserId,User_Subsid,OrderTotalAmount,OrderTotalWeight,OrderShipName,OrderShipAddress,OrderPhone,OrderEmail,OrderDate,OrderStatusId,OrderDeliveryType,Order_PickDate,Order_PickTime,Review,OrderReceiptPic,Order_Via,walletdeduction_amt,CreatedBy,delivery_date) values($oreceiptid,$otype,$osubtype,$ouserid,$usubsid,$ota,$otw,$oshipname,$oshipaddress,$ophone,$oemail,$odate,$ostatusid,$odtype,$opickdate,$opicktime,$oreview,$oreceiptpic,$order_via,$wda,$ocy,$oddate)") or die(mysql_error());
			if($result)
			{
				echo "Record inserted success";
			}
			
	}
	
	
  }	
}
?>
                        
                    </div>
                    <div class="clearfix"></div>
       
      
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2 class="text-capitalize"><i class="fa fa-bars"></i> Upload <?php echo $_GET["ref"]; ?> Orders via excel </h2>
                                    <ul class="nav navbar-right panel_toolbox">
                                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                        </li>
                                        
                                        <li><a href="order_exceltype.php"><i class="fa fa-backward"></i></a>
                                        </li>
                                       
                                    </ul>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">
    							
    							
    							<?php
if(isset($_POST["btnupload"]))
{            $file=$_FILES["file"]["name"];
			 
			 	$docextension=pathinfo($file);
					if($docextension["extension"]=='xlsx')
								{
								@move_uploaded_file($_FILES["file"]["tmp_name"],date("m-d-y").'_'.time().'.'.$docextension["extension"]);
								$filepath=date("m-d-y").'_'.time().'.'.$docextension["extension"];
							
					$Filepath = $filepath;
			              $c = 0;
						
							// Excel reader from http://code.google.com/p/php-excel-reader/
							require('phpexcelupload/php-excel-reader/excel_reader2.php');
							require('phpexcelupload/SpreadsheetReader.php');
						
							date_default_timezone_set('UTC');
						
							$StartMem = memory_get_usage();
						
						
							try
							{
								$Spreadsheet = new SpreadsheetReader($Filepath);
								$BaseMem = memory_get_usage();
						        $Sheets = $Spreadsheet -> Sheets();
						
						
								foreach ($Sheets as $Index => $Name)
								{
						
									$Time = microtime(true);
						
									$Spreadsheet -> ChangeSheet($Index);
						
									foreach ($Spreadsheet as $Key => $Row)
									{
										if( $Key>2)
										{
										if ($Row)
										{
											$name=$Row[1];
											$email=$Row[2];
											$address=$Row[3];
											$mobile=$Row[4];
											
											$order_weight=($Row[5]=='')?"NULL":"'$Row[5]'";//fetch order amount in a variable
											$order_amt=($Row[6]=='')?"NULL":"'$Row[6]'";//fetch order amount in a variable
											//$order_amt=number_format($order_amt1,3); //convert order amount value to float
											
											$pickup_date=$Row[7];
											//$order_date=$Row[7];
											$order_date=date("Y-m-d",strtotime($Row['7']));
											//$order_date=
											
											$ord_type=mysql_real_escape_string($_GET["ref"]);
											$order_status_id=4;
											$delivery_type="normal";
											
											$delivery_date=$Row[8];
											
											$order_via='website';
											$createdby="admin";
										
										if($email=='' && $mobile=='')
										{
											
										}
										else {
						
											$query="";
                        if($email!='')				
						{
						$query="select * from tblusers where UserEmail='$email'";
							
						}
							
						elseif($mobile!='') 
						{
						$query="select * from tblusers where UserPhone='$mobile'";	
						
						}
						
							
						
								$res=mysql_query($query) or die(mysql_error());
								if(mysql_num_rows($res)>0)
								{
									$row=mysql_fetch_array($res);
									$uid="'".$row['UserId']."'";
									
									submit_order($uid,$name,$ord_type,$email,$mobile,$address,$pickup_date,$order_status_id,$delivery_type,$order_weight,$order_amt,$order_date,$delivery_date,$order_via,$createdby);
								}
								
								else 
								{
							
									$uid="NULL";
								submit_order($uid,$name,$ord_type,$email,$mobile,$address,$pickup_date,$order_status_id,$delivery_type,$order_weight,$order_amt,$order_date,$delivery_date,$order_via,$createdby);
										
								
									
						  }

					
							}
						
											$c = $c + 1;
										}
									  if ($Key && ($Key % 500 == 0))
										{
										}
									}
								}
		
							}
		
						}
					catch (Exception $E)
					{
						echo $E -> getMessage();
					}
//exel Reader
			unlink($filepath);
							if($result)
								    {
										echo '<script>alert("Student Recored updated");</script>';
                                   
									}
								else
									 {
									echo '<script>alert("Student Recored updated ");</script>';
                                     
									}    
      						}
						else {
						echo '<script>alert("Select an Excel File only");</script>';
						}

}
?>
  		<h1 style="color:red" class="text-capitalize">Add Only <?php echo $_GET["ref"]; ?> Orders  Excel File</h1>
  		<br/>
    									<!-- <a href="excel_f/Book1.xlsx" target="_blank" style="color:red ">(Excel Format Example)</a>-->   	
								                                   
                                    <form method="post" role="form" class="form-horizontal" enctype="multipart/form-data" onsubmit="return validation()">
                                    
                                              
                                         <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="itname">Select Excel File
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                           
                                        	<input type="file" name="file" id="file" class="form-control"  required="true"  />
                                        
                                            </div>
                                        </div>
                                      
            			
                                        <div class="ln_solid"> </div>
                                        <div class="form-group">
                                            <div class="col-md-6 col-md-offset-3">
                                                
                                               <input type="submit" name="btnupload" class="btn btn-success" value="Upload"/>&nbsp;
                                            </div>
                                        </div>
                                    </form>
                                   
                             
                                   
                                
                                </div>
                                                
                                            
                                            
                                        

                                </div>
                            </div>
                            </div>
                            </div>
                            
                            
 
                            
<?php include 'footer.php';?>                            
