<?php
include 'header.php';
if(isset($_GET['id']))
{
	$empid=$_GET['id'];
	
	

?>

<div class="right_col" role="main">
	<div class="row">
		<div class="container">
			<div class="col-md-12 col-sm-12 col-xs-12" style="text-align: center;">
				
				
			</div>
			<div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2><i class="fa fa-bars"></i> Employee Detail </h2>
                                    <a href="employee_list.php">&nbsp;&nbsp;&nbsp;<button class="btn btn-primary"><span class="glyphicon glyphicon glyphicon-circle-arrow-left"></span>&nbsp;Back</button></a>
                                    <ul class="nav navbar-right panel_toolbox">
                                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                        </li>
                                        <!--<li><a class="close-link"><i class="fa fa-close"></i></a>  </li>-->
                                    </ul>
                                    <div class="clearfix"></div>
                                </div>
                               


                                                  <div class="x_content table-responsive">
                                                  	
                                    <table id="example" class="table table-striped table-bordered responsive-utilities jambo_table">
                                        <thead>
                                            <tr class="headings">
                                                <!--
                                                <th>
                                                    <input type="checkbox" class="tableflat">
                                                </th>
                                                -->
                                               
												<th>Employee Id </th>
												
                                                
                                               <th>Name </th> 
                                                <th>Username </th>
                                               
                                                <th>Mobile </th>
                                               
                                                <th>Password</th>
                                            </tr>
                                            
                                         
                                        </thead>

                                        <tbody>
                              
											<tr class="even pointer">
	                                              
	                                               <?php
                                             	$query="select * from  tbl_employee where empId='$empid'";
													$res=mysql_query($query);
													$row1=mysql_fetch_array($res);
													 
	                                               	?>
												     <td><?php echo $empid; ?></a></td>
												     
												      <td class=" "><?php echo $row1["empName"];?></td> 
												      <td class=" "><?php echo $row1["empEmail"];?> </td>
	                                               
	                                                <td class=" "><?php echo  $row1["empPhone"];?>  </td>
	                                              
	                                                <td class=" "><?php echo  $row1["empPassword"];?>  </td>
	                                     
	                                                 		 </tr>
															 
												
                                            
                                        </tbody>

                                    </table>
                                    
                                    	                                </div>

                                </div>
                            </div>
                            
                            
                            
              
			
		</div>
	</div>
</div>
<?php
}
include 'footer.php';

?>