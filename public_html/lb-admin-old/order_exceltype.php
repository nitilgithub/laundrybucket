<?php
include 'header.php';
include '../connection.php';
require '../class.phpmailer.php';
require '../class.smtp.php';
?>

   <div class="right_col" role="main">

 <div class="">
                    <div class="page-title">
                        <div class="title_left">
                            <h3>Upload orders Excel</h3>
                        </div>

                        
                    </div>
                    <div class="clearfix"></div>
       
      
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2><i class="fa fa-bars"></i> Select Order Excel Type </h2>
                                    <ul class="nav navbar-right panel_toolbox">
                                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                        </li>
                                       
                                    </ul>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">
    							
    							<div class="col-md-12">
    								<div class="col-md-3">
    						<a href="uploadorders_excel.php?ref=laundry" class="btn btn-primary"> Upload Laundry Order Excel</a>
                             </div>
                             
                             <div class="col-md-3">
    						<a href="uploadorders_excel.php?ref=dryclean" class="btn btn-info"> Upload Dryclean Order Excel</a>
                             </div>
                             
                             
                             </div>
                                   
                                
                                </div>
                                                
                                            
                                            
                                        

                                </div>
                            </div>
                            </div>
                            </div>
                            
                            

                            
<?php include 'footer.php';?>                            
