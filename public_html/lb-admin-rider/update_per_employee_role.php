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
$(document).on("click",".btnDelete",function(){
	var id=$(this).attr("title");
	$.ajax({
    type : "GET",
    url : "api_delete_per_employeerole.php?id="+id,
    success : function(data){
       $.each(data,function(i,field){
       				var status=field.status;
					if(status==1)
					{
						location.reload();
					}
					else
					{
						alert("error");
					}
				});
    }
});
});

 </script>



 <?php

function update_employee($id,$erole)

{

		$len=sizeof($erole);
		for($i=0;$i<$len;$i++){
			
		$query1="insert into tbl_per_employee_roles(empId,empRoleId,addon) values('$id','$erole[$i]',now())";
			$result3=mysql_query($query1) or die(mysql_error());
			if(mysql_affected_rows())

			{
		
			echo '<div class="alert alert-success">Employee Role Added Successfully</div>';
		
			}
		
			else{
		
				echo '<div class="alert alert-success">Error in processing request</div>';
		
				
		
			}
					
		}	

}
?>

   <div class="right_col" role="main">



 <div class="">

                    <div class="page-title">

                        <div class="title_left">

                            <h3>Employee Role</h3>

                        </div>



                        

                    </div>

                    <div class="clearfix"></div>

         	<?php
			
			if(isset($_GET["id"]))
			
			{
			
				
			
				$id=intval(trim($_GET["id"]));
			
			$result=mysql_query("select * from tbl_employee where empId='$id'") or die(mysql_error());
			
			if(mysql_affected_rows())
			
			{
			
				$data=mysql_fetch_array($result);
			
			
			?>

   
                        <div class="col-md-12 col-sm-12 col-xs-12">

                            <div class="x_panel">

                                <div class="x_title">

                                    <h2><i class="fa fa-bars"></i> Update <?php echo $data['empName'];?>'s Role</h2>

                                    <ul class="nav navbar-right panel_toolbox">

                                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>

                                        </li>

                                       

                                        <li><a class="close-link"><i class="fa fa-close"></i></a>

                                        </li>

                                    </ul>

                                    <div class="clearfix"></div>

                                </div>

                                <div class="x_content">

                                	

				

    

                                   	<span class="section"> &nbsp;</span>	

                                   	

                                 

                                   <form method="post" role="form" class="form-horizontal" enctype="multipart/form-data">

						<div class="item form-group">
                                				

                                				 <label class="control-label col-md-3 col-sm-3 col-xs-12" for="erole">Employee Role

                                            </label>

                                            <div class="col-md-6 col-sm-6 col-xs-12">

        								<select class="form-control col-md-7 col-xs-12" name="erole[]" required="required" multiple>
         										
         											<?php
         											/*$r1=mysql_query("select * from tbl_per_employee_roles where empId='$id'") or die(mysql_error());
													while($rows1=mysql_fetch_array($r1))
													{
														$row_array[]=$rows1['empRoleId'];
													}*/
         											$res=mysql_query("select * from tbl_employee_role where status=1") or die(mysql_error());
													if(mysql_affected_rows())
													{
														while($row=mysql_fetch_array($res))
														{
													?>
													<option style="padding: 10px;" value="<?php echo $row['roleId']?>" <?php/* foreach($row_array as $r){if($r==$row['roleId']){ echo selected; }}*/?>><?php echo $row['roleName'];?></option>
													<?php
														}
													}
													
         											?>
         										</select>                     	                           	

                                				</div>

            			                    </div>

                          

            								&nbsp;

            		

                                        	

            				

                                       

                                        <div class="form-group">

                                            <div class="col-md-6 col-md-offset-3">

                                                

                                                <input type="submit" name="btnupdate" class="btn btn-success" value="Add New Employee Role"/>&nbsp;

                                            </div>

                                        </div>
                                         <div class="ln_solid"> </div>

                                    </form>

 <table class="table table-striped table-bordered">
 	<caption>Delete Existing Roles</caption>
 	<tr>
 		<th>Role</th>
 		<th>Action</th>
 	</tr>
 	<?php
 	$r1=mysql_query("select * from tbl_per_employee_roles where empId='$id'") or die(mysql_error());
	while($row1=mysql_fetch_array($r1))
	{
		$emproleid=$row1['empRoleId'];
		$r2=mysql_query("select * from tbl_employee_role where roleId='$emproleid'");
		$row2=mysql_fetch_array($r2);
	?>
	<tr>
		<td><?php echo $row2['roleName'];?></td>
		<td><button class="btn btn-danger btn-xs btnDelete" title="<?php echo $row1['id'];?>">Delete</button></td>
	</tr>
	<?php	
	}
 	?>
 </table>                                  

                                   

                                   <?php

                                   }

                                  }

                                  

                                   ?>

                                   

                                   

                                   <?php

		if(isset($_POST["btnupdate"]))

		{

			$id=intval(trim($_GET["id"]));


			$erole=$_POST["erole"] ;

			


						update_employee($id,$erole);

					

		}

		?>

                                </div>

                                                

                                            

                                            

                                        



                                </div>

                            </div>

                            </div>

                            </div>

                            

<?php include 'footer.php';?>                            

