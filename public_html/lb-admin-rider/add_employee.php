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
$("select").mousedown(function(e){
    e.preventDefault();

    var select = this;
    var scroll = select .scrollTop;

    e.target.selected = !e.target.selected;

    setTimeout(function(){select.scrollTop = scroll;}, 0);

    $(select ).focus();
}).mousemove(function(e){e.preventDefault()});
});

/*$(document).on("blur","#phone",function(){
	var ph=$(this).val();
	var len=ph.length;
	var sub=ph.substring(len-4,len);
	//alert(sub);
	var pswd="laundry@"+sub;
	$("#passwd").val(pswd);
});*/

 </script>

 <?php

function add_new_employee($name,$phone,$email,$passwd,$erole)

{
	$query="insert into tbl_employee(empName,empPhone,empEmail,empPassword,addon) values('$name','$phone','$email','$passwd',now())";

	$result2=mysql_query($query) or die(mysql_error());
	if(mysql_affected_rows())
	{
		$empid=mysql_insert_id();
		$len=sizeof($erole);
		for($i=0;$i<$len;$i++){
			
		$query1="insert into tbl_per_employee_roles(empId,empRoleId,addon) values('$empid','$erole[$i]',now())";
			$result3=mysql_query($query1) or die(mysql_error());
			if(mysql_affected_rows())

			{
		
			echo "";
		
			}
		
			else{
		
				echo '<div class="alert alert-success">Error in processing request</div>';
		
				
		
			}
					
		}
		  echo '<div class="alert alert-success">Employee Added Successfully</div>';
	}
	else {
			echo '<div class="alert alert-success">Error in processing request</div>';
	}
	

}

?>

   <div class="right_col" role="main">



 <div class="">

                    <div class="page-title">

                        <div class="title_left">

                            <h3>Employees</h3>

                        </div>



                        

                    </div>

                    <div class="clearfix"></div>

       

      

                        <div class="col-md-12 col-sm-12 col-xs-12">

                            <div class="x_panel">

                                <div class="x_title">

                                    <h2><i class="fa fa-bars"></i> Add New Employee </h2>

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

                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="empname">Employee Name 

                                            </label>

                                            <div class="col-md-6 col-sm-6 col-xs-12">

                                           

                                        <input type="text" name="empname" class="form-control col-md-7 col-xs-12" required=""/>

                                        

                                            </div>

                                        </div>

                                        

                                        

                                        	&nbsp;
							<div class="item form-group">

            				  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="phone">Phone

                                            </label>

                                            

                                             <div class="col-md-6 col-sm-6 col-xs-12">

            				<input type="text" name="phone" class="form-control col-md-7 col-xs-12" required="" id="phone"/>

		

            			</div>

            </div>
                                        
&nbsp;
                                       

                                        <div class="item form-group">

                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Username

                                            </label>

                                            <div class="col-md-6 col-sm-6 col-xs-12">

         

                                	           <input type="text" name="email" class="form-control col-md-7 col-xs-12" required="" placeholder="For login"/>                    	

                                				</div>

                                			</div>
                                			&nbsp;
                                				
 								<div class="item form-group">
                                				

                                				 <label class="control-label col-md-3 col-sm-3 col-xs-12" for="erole">Employee Role

                                            </label>

                                            <div class="col-md-6 col-sm-6 col-xs-12">

         										<select class="form-control col-md-7 col-xs-12" name="erole[]"  multiple required="required">
         											<!--<option value="">Select Employee Role</option>-->
         											<?php
         											$res=mysql_query("select * from tbl_employee_role where status=1") or die(mysql_error());
													if(mysql_affected_rows())
													{
														while($row=mysql_fetch_array($res))
														{
													?>
													<option style="padding: 10px;" value="<?php echo $row['roleId']?>"><?php echo $row['roleName'];?></option>
													<?php
														}
													}
         											?>
         										</select>
                                				</div>

            			                    </div>

                          

            								&nbsp;

            		

                                        	

			
                                        <div class="ln_solid"> </div>

                                        <div class="form-group">

                                            <div class="col-md-6 col-md-offset-3">

                                                

                                                <input type="submit" name="btnsave" class="btn btn-success" value="Add Employee"/>&nbsp;

                                            </div>

                                        </div>

                                    </form>

                                   

                                 

                                   

                                   

                                   <?php

		if(isset($_POST["btnsave"]))

		{

				$name=mysql_real_escape_string($_POST["empname"]);

			$phone=mysql_real_escape_string($_POST["phone"]);

			$email=mysql_real_escape_string($_POST["email"]);
			
			$x=substr($phone,6,4);
			$passwd="laundry".rand(11,999)."@".$x;
			
			$erole=$_POST["erole"] ;
			
	


		add_new_employee($name,$phone,$email,$passwd,$erole);

					

		}

		?>

                                </div>

                                                

                                            

                                            

                                        



                                </div>

                            </div>

                            </div>

                            </div>

                            

<?php include 'footer.php';?>                            

