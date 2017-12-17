<?php
@ob_start();
@session_start();
include '../connection.php'; 
if(isset($_SESSION["userid"]))
{
	header("location:allorder_list_new.php");
	exit;
}?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laundry Bucket! |Admin Panel </title>

    <!-- Bootstrap core CSS -->

    <link href="css/bootstrap.min.css" rel="stylesheet">

    <link href="fonts/css/font-awesome.min.css" rel="stylesheet">
    <link href="css/animate.min.css" rel="stylesheet">

    <!-- Custom styling plus plugins -->
    <link href="css/custom.css" rel="stylesheet">
    <link href="css/icheck/flat/green.css" rel="stylesheet">


    <script src="js/jquery.min.js"></script>

    <!--[if lt IE 9]>
        <script src="../assets/js/ie8-responsive-file-warning.js"></script>
        <![endif]-->

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
<script>
	$(document).on("focus click","#txtrole",function(){
		
		var uname=$("#txtuname").val();
		var pass=$("#txtpass").val();
		if(uname=="" || pass=="")
		{
			//alert("Enter Username and Password");
		}
		else
		{
		//$("#txtrole").html("");
		$("#txtrole").find('option').remove();
		$.ajax(
		       {
				url:"api_getlogin_role.php?uname="+uname+"&pass="+pass,
				type:"GET",
				success:function(data)	
				{
					$.each(data,function(i,field){
						var status=field.status;
						
						if(status==1)
						{
						$("#txtrole").append("<option value='"+field.emproleid+"'>"+field.emprole+"</option>");
						}
						else
						{
							alert("Invalid Username or Password");
						}
					});
				}
				});
			}
			
	});
	
</script>
</head>

<body style="background:#F7F7F7;">
    
    <div class="">
    	
    	
    	
        <a class="hiddenanchor" id="toregister"></a>
        <a class="hiddenanchor" id="tologin"></a>

        <div id="wrapper">
        	
        	
            <div id="login" class="animate form">
            	
            	
            	
                <section class="login_content">
                    <form method="post">
                        <h1>Admin Login</h1>
                        <div>
                            <input type="text" name="txtuname" class="form-control" placeholder="Username" required="" id="txtuname" />
                        </div>
                        
                        <div>
                            <input type="password" name="txtpass" class="form-control" placeholder="Password" required="" id="txtpass" />
                        </div>
                        <div>
                        	<select name="txtrole" class="form-control" required="required" id="txtrole">
                        		<option value="">-Login As-</option>
                        	</select>
                        </div>
                      
                      
                         <div>
                         	<div class="col-md-4">
                         		</div>
                         		
                         		<div class="col-md-4">
                         	
                            <input type="submit"  value="login" name="btnlogin" class="form-control btn btn-primary" style="line-height: 0px"/>
                            </div>
                            
                            <div class="col-md-4">
                         		</div>
                         		
                        </div>
                        
                       
                        
                        <div class="clearfix"></div>
                        <div class="separator">

                            <div class="clearfix"></div>
                            <br />
                            <div>
                                <h1><img src="../washingf.png"> </img> Laundry Bucket!</h1>

                                <p>©2016 All Rights Reserved. Laundry Bucket!</p>
                            </div>
                        </div>
                        
                        <?php

if(isset($_POST["btnlogin"]))
{
	$uname=trim(mysql_real_escape_string($_POST["txtuname"]));
	$upass=trim(mysql_real_escape_string($_POST["txtpass"]));
	$urole=trim(mysql_real_escape_string($_POST["txtrole"]));
	//$result=mysql_query("select * from tbl_adminlogin where admin_name='$uname' and admin_password='$upass'") or die(mysql_error());
	
	$result=mysql_query("select * from tbl_employee where empEmail='$uname' and empPassword='$upass'") or die(mysql_error());
	
	if(mysql_affected_rows())
	{
		/*$row=mysql_fetch_array($result);
		$empid=$row['empId'];
		$res=mysql_query("select * from tbl_per_employee_roles where empId='$empid'") or die(mysql_error());
		*/
		$_SESSION["userid"]=1;
		$_SESSION['loginuser']=$uname;
		$_SESSION['loginrole']=$urole;
		
		$_SESSION['loginpass']=$upass;
		header("location:allorder_list_new.php");
		exit;
		
	}
	else
		{
			
			?>
			<p class="bg-danger text-center" style="padding:5px; color:#EC170F;"><strong>Invalid username or password</strong></p>
			<?php
			exit;
			
		}
}
?>	
                        
                    </form>
                    <!-- form -->
                </section>
                <!-- content -->
            </div>
           
            
        </div>
    </div>

</body>

</html>