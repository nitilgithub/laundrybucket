<?php
@ob_start();
@session_start();
include '../connection.php';

header('Access-Control-Allow-Origin: *');

header('Content-Type: application/json');
$return_array=array();
$uname=mysql_real_escape_string($_GET['uname']);
$pass=mysql_real_escape_string($_GET['pass']);
$result=mysql_query("select * from tbl_employee where empEmail='$uname' and empPassword='$pass'") or die(mysql_error());	
	if(mysql_affected_rows())
	{
		$row=mysql_fetch_array($result);
		$empid=$row['empId'];
		$res1=mysql_query("select * from tbl_per_employee_roles where empId='$empid'") or die(mysql_error());
		while($row1=mysql_fetch_array($res1))
		{
			$emproleid=$row1['empRoleId'];
			$res2=mysql_query("select * from tbl_employee_role where roleId='$emproleid'") or die(mysql_error());
			$row2=mysql_fetch_array($res2);
			$rows['emprole']=$row2['roleName'];
			$rows['emproleid']=$row2['roleId'];
			$rows['status']=1;
			array_push($return_array,$rows);
			
		}
	
	
		
	}
	else {
		$rows['status']=0;
		array_push($return_array,$rows);
	}


echo json_encode($return_array);
mysql_close();	

?> 	
