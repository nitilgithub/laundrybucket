<?php
ob_start();
session_start();
include '../connection.php';
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
$filteruserslist=array();
$fdate=$_GET['fdate'];
$sdate=$_GET['sdate'];
$query="";


										
			$query=	"select * from tblusers where
((ifnull(str_to_date(UserRegistrationDate,'%Y-%m-%d'),UserRegistrationDate)
between str_to_date('$fdate','%m/%d/%Y') and str_to_date('$sdate','%m/%d/%Y'))) order by UserId DESC";
				
				
                $result1=mysql_query($query) or die(mysql_error());
				if(mysql_affected_rows())
              {
                while($row=mysql_fetch_array($result1))
             {
             	$uid=$row["UserId"];
				$refid=$row['UserReference'];
				
             	
             	$row_array["id"]=$row["UserId"];
			//	$row_array["mobile"]=empty($row["mobile"]) ? $row["usmobile"] : $row["mobile"] ;
				$row_array["name"]=$row["UserFirstName"]." ". $row["UserLastName"];
				$row_array["email"]=$row["UserEmail"] ;
				$row_array["mobile"]=$row["UserPhone"] ;
				$row_array["regdate"]=$row["UserRegistrationDate"];
				$row_array["usertype"]=$row["UserType"] ;
				
				$que1=mysql_query("select count(*) from tbl_orders where OrderUserId='$uid' and OrderStatusId=4");
				$rw=mysql_fetch_array($que1);
				
				$row_array['totaldeliverorder']=$rw[0];
				
				$que2=mysql_query("select sum(PayableAmount) from tbl_orders where OrderUserId='$uid' and OrderStatusId!=5");
				$rw2=mysql_fetch_array($que2);
				
				$row_array['totalbusiness']="₹ ".$rw2[0];
				
				if($row["UserAddress"]=="")
				{
				$result2=mysql_query("select * from tblusers_address where UserId='$uid' order by id DESC");
				$row2=mysql_fetch_array($result2);
				
					$row_array["address"]=$row2["Address"];
				}
				else {
					$row_array["address"]=$row["UserAddress"];
				}
				$res=mysql_query("select * from tbl_reference where RefId='$refid'") or die(mysql_error());
				$row1=mysql_fetch_array($res);
				$row_array['reference']=$row1['RefText'];
				
				$res1=mysql_query("select sum(amount) from tbl_wallet where uid='$uid'");
            	$rows1=mysql_fetch_array($res1);
				
				$res2=mysql_query("select sum(amount) from tbl_wallet_history where userId='$uid'");
				$rows2=mysql_fetch_array($res2);
				if($rows1[0]==""){
					$row_array['wallet']="₹ 0";
				} else {
					$row_array['wallet']="₹ ".( $rows1[0]-$rows2[0]); }
				
				
					array_push($filteruserslist,$row_array);
				
			 }
			 
			 echo json_encode($filteruserslist);
			  }
			  
			  
			  mysql_close();
			  ob_end_flush();
			  
             	?>