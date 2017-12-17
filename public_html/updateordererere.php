<?php
include 'header.php';
?>

  	<div class="container">
  		<div>&nbsp;</div>
  		<div>&nbsp;</div>
  		<div>&nbsp;</div>
  		<div>&nbsp;</div>
  		<div>&nbsp;</div>
  		<div class="col-md-4  col-xs-12" style="margin-top:5%;">
  		
  		
  		    <div class="container">
  		    	
  		    	<!-- Save Delivery Date of those orders whose delivery date is empty -->
  		    	<?php
  		    	/*
  		    	$query="SELECT * FROM `tbl_orders` WHERE  ISNULL(delivery_date) ";
		
		$result=mysql_query($query);
		echo mysql_num_rows($result)."<br/>";
		$i=0;
		
		while($row=mysql_fetch_array($result))
		{
			$i=$i+1;
			$pickdate=$row['Order_PickDate'];
			$dtype=$row['OrderDeliveryType'];
			$oid=$row['OrderId'];
			$delivery_date="";
		
			if($dtype=="fast")
			{
				$delivery_date=date("m/d/Y", strtotime($pickdate. ' + 1 days'));
				echo "oid:".$oid." pickdate:".$pickdate. " ddte:".$delivery_date. " dtype: ".$dtype."<br/>";
				
				
			}
			else 
			{
				$delivery_date=date("m/d/Y", strtotime($pickdate. ' + 3 days'));
				echo "oid:".$oid." pickdate:".$pickdate. " ddte:".$delivery_date. " dtype: ".$dtype."<br/>";
			}
		 
		 
			$qu="update `tbl_orders` set delivery_date='$delivery_date' where OrderId='$oid'";
		    $rest=mysql_query($qu) or die(mysql_error());
		
			
		}
		*/
  		    	?>
  		    	<!-- End of code -->
  		    	
  		    	
  		   <!-- Check For Duplicate entries for user via UserPhone or UserEmail --> 	
  		    	<?php
		/*   		    	
		$query="SELECT * FROM `tblusers`";
		
		$result=mysql_query($query);
		echo mysql_num_rows($result)."<br/>";
		$i=0;
		while($row=mysql_fetch_array($result))
		{
			$i=$i+1;
			$phone=$row['UserPhone'];
			$email=$row['UserEmail'];
			$uid=$row['UserId'];
			
			//echo "Userid=".$uid." UserPhone=".$phone."<br/>";
			
		$query2="select * from tblusers where((UserEmail='$email' && UserEmail!=''))";
		$result2=mysql_query($query2);
		//echo $i."()".mysql_num_rows($result2). "<br/>";
		if(mysql_num_rows($result2)>1)
		{
			//echo mysql_num_rows($result2). "<br/>";
			while($ro=mysql_fetch_array($result2))
			{
			
			//$ro=mysql_fetch_array($result2);
			$us=$ro['UserId'];
			$uph=$ro['UserPhone'];
			$uem=$ro['UserEmail'];
			
			
			echo "Uid=".$us." UPhone=".$uph." UserEmail=".$uem."<br/>";
			}
		}		
			
		}
		*/
  		    	?>
  		 <!--End Check For Duplicate entries for user via UserPhone or UserEmail -->
  		 
  		 
  		  	
  		    	
  		    	<!-- Case 1 (If OrderUserId is NULL in tbl_orders)-->
		<?php 
		/*
		$query="SELECT * FROM `tbl_orders` WHERE(OrderUserId IS NULL)";
		
		$result=mysql_query($query);
		echo mysql_num_rows($result)."<br/>";
		$i=0;
		while($row=mysql_fetch_array($result))
		{
			$i=$i+1;
			$uophone=$row['OrderPhone'];
			$uoemail=$row['OrderEmail'];
			$oid=$row['OrderId'];
			
		$query2="select * from tblusers where((UserEmail='$uoemail'&&UserEmail!='') OR (UserPhone='$uophone' && UserPhone!=''))";
		$result2=mysql_query($query2);
		echo $i."()".mysql_num_rows($result2). "<br/>";
		if(mysql_num_rows($result2)==1)
		{
			//echo mysql_num_rows($result2). "<br/>";
			$ro=mysql_fetch_array($result2);
			$oid. "Userid:";
			$us=$ro['UserId'];
			
			echo $oid;
			echo $us."<br/>";

			$qu="update `tbl_orders` set OrderUserId='$us' where OrderId='$oid'";
		    $rest=mysql_query($qu) or die(mysql_error());
		if($rest)
		{
			echo "<br/>".$oid."is updated <br/>";
		}
			 
		}		
			
		}
		*/
		?>
			<!-- End Case 1 (If OrderUserId is NULL in tbl_orders)-->
			
			
			
			
			
			
				    	<!-- Case 2 (If OrderUserId is empty that means Zero in tbl_orders)-->
		<?php 
		/*
		$query="SELECT * FROM `tbl_orders` WHERE(OrderUserId='')";
		
		$result=mysql_query($query);
		echo mysql_num_rows($result)."<br/>";
		$i=0;
		while($row=mysql_fetch_array($result))
		{
			
			$uophone=$row['OrderPhone'];
			$uoemail=$row['OrderEmail'];
			$oid=$row['OrderId'];
			
		$query2="select * from tblusers where((UserEmail='$uoemail'&&UserEmail!='') OR (UserPhone='$uophone' && UserPhone!=''))";
		$result2=mysql_query($query2);
		//echo $i." ".mysql_num_rows($result2). "<br/>";
		if(mysql_num_rows($result2)==1)
		{
			$i=$i+1;
			echo $i." ".mysql_num_rows($result2). "<br/>";
			$ro=mysql_fetch_array($result2);
			$oid. "Userid:";
			$us=$ro['UserId'];
			
			echo $oid;
			echo $us."<br/>";
			
			$qu="update `tbl_orders` set OrderUserId='$us' where OrderId='$oid'";
		    $rest=mysql_query($qu) or die(mysql_error());
		if($rest)
		{
			echo "<br/>".$oid."is updated";
		}
			
		}		
			
		}
		*/
		?>
			<!-- End Case 2 (If OrderUserId is that means Zero in tbl_orders)-->
			
			
			<!-- Case 3 (If OrderUserId is NULL in tbl_orders and no record found in tblusers then create account)-->
		<?php 
		/*
		$query="SELECT * FROM `tbl_orders` WHERE(OrderUserId IS NULL)";
		//  $query="SELECT * FROM `tbl_orderscopy142` WHERE (OrderId=1 or OrderId=144 or OrderId=27)";
		
		$result=mysql_query($query);
		echo mysql_num_rows($result)."<br/>";
		$i=0;
		while($row=mysql_fetch_array($result))
		{
			$i=$i+1;
			
		 $uophone=$row['OrderPhone'];
		 $uoemail=$row['OrderEmail'];
		 $oid=$row['OrderId']."<br/>";
		$uname=$row['OrderShipName'];	
		$address=$row['OrderShipAddress'];
			echo "id is:".$i."(".$oid. ")". "<br/>";
			
		$query2="select * from tblusers where((UserEmail='$uoemail'&&UserEmail!='') OR (UserPhone='$uophone' && UserPhone!=''))";
		$result2=mysql_query($query2);
		//echo $i." ".mysql_num_rows($result2). "<br/>";
		if(mysql_num_rows($result2)>0)
		{
			//echo mysql_num_rows($result2). "<br/>";
			echo "already Exist <br/> <br/>";
		}
		
		else
		{
			
			$upass=md5(rand(1111,9999));
	$regdate=date("Y-m-d");
	$ucreatedby="admin";
	$uevstatus=1;
	$usertype="websiteuser";
	$result2=mysql_query("insert into tblusers(UserFirstName,UserEmail,UserPhone,UserPassword,UserAddress,UserRegistrationDate,UserEmailVerified,UserType,CreatedBy) values('$uname','$uoemail','$uophone','$upass','$address','$regdate','$uevstatus','$usertype','$ucreatedby')");
	
	if(mysql_affected_rows())
	{
		$uid=mysql_insert_id();
		
$result4=mysql_query("insert into tblusers_address(UserId,Address,addon) values('$uid','$address',NOW())");
 echo "Inserted <br/> <br/>";
    }

	else
	{
	echo " not inserted";
	}
			
}		
		
	}
		*/
		?>
			<!-- End Case 3 (If OrderUserId is NULL in tbl_orders and no record found in tblusers then create account)-->
			
			
		<!-- Start Case 4 (If OrderUserId is empty means zero in tbl_orders and no record found in tblusers then create account)-->
		<?php
		/*
		$query="SELECT * FROM `tbl_orders` WHERE(OrderUserId='')";
		
		$result=mysql_query($query);
		echo mysql_num_rows($result)."<br/>";
		$i=0;
		while($row=mysql_fetch_array($result))
		{
			$i=$i+1;
			$uophone=$row['OrderPhone'];
			$uoemail=$row['OrderEmail'];
			$oid=$row['OrderId'];
				$uname=$row['OrderShipName'];	
		$address=mysql_real_escape_string($row['OrderShipAddress']);
			echo "id is:".$i."(".$oid. ")". "<br/>";
			
		$query2="select * from tblusers where((UserEmail='$uoemail'&& UserEmail!='') OR (UserPhone='$uophone' && UserPhone!=''))";
		$result2=mysql_query($query2);
		//echo $i." ".mysql_num_rows($result2). "<br/>";
		if(mysql_num_rows($result2)>0)
		{
				echo "already Exist <br/> <br/>";
		}		
			
		else {
				$upass=md5(rand(1111,9999));
	$regdate=date("Y-m-d");
	$ucreatedby="admin";
	$uevstatus=1;
	$usertype="websiteuser";
	$query3="insert into tblusers(UserFirstName,UserEmail,UserPhone,UserPassword,UserAddress,UserRegistrationDate,UserEmailVerified,UserType,CreatedBy) values('$uname','$uoemail','$uophone','$upass','$address','$regdate','$uevstatus','$usertype','$ucreatedby')";
	
	//echo $query3;
	
	$result3=mysql_query($query3)or die(mysql_error());
	
//	$result3=mysql_query("insert into tblusers(UserFirstName,UserEmail,UserPhone,UserPassword,UserAddress,UserRegistrationDate,UserEmailVerified,UserType,CreatedBy) values('$name','$uoemail','$uophone','$upass','$address','$regdate','$uevstatus','$usertype','$ucreatedby')") or die(mysql_error());
	
	if($result3)
	{
		$uid=mysql_insert_id();
	//echo $uid;	
$result4=mysql_query("insert into tblusers_address(UserId,Address,addon) values('$uid','$address',NOW())");
 echo "Inserted <br/> <br/>".$uid;
    }

	else
	{
	echo " not inserted";
	}
		}	
		}
		*/ 
		?>
		
		<!-- End Case 4 (If OrderUserId is empty means zero in tbl_orders and no record found in tblusers then create account)-->
			
			
		<?php 
		/*
		$query="SELECT  DISTINCT(OrderPhone) FROM `tbl_orders` where  OrderUserId is null ";
		$result=mysql_query($query);
		echo mysql_num_rows($result);
		while($row1=mysql_fetch_array($result))
		{
			$user=$row1['OrderPhone'];
			
			
		$query="select * from tbluserscopy where UserPhone='$user'";
		$re=mysql_query($query);
		echo mysql_num_rows($re).' ';
		if(mysql_num_rows($re)==0)
		{
		$query2="SELECT  * FROM `tbl_orders` where  OrderPhone='$user' ";
		$result2=mysql_query($query2);
		echo mysql_num_rows($result2);
		$row=mysql_fetch_array($result2);		
					$utype="websiteuser";
					$uemail=$row['OrderEmail'];
					$upwd=md5(rand(11111,99999));
					$arr = explode(" ", $row['OrderShipName'],2);

					$ufname=$arr[0];
					$ulname=$arr[1];
					$udob='';
					$usex='';
					$ucity=$row['OrderCity'];
					$ustate=$row['OrderState'];
					$uzip= $row['OrderZip'];
					$uev=0;
					//$uvcode="NA";
					$uvmob=rand(1111,9999);
					$uvcode=md5($uvmob);
					
					$uip=$_SERVER['SERVER_ADDR'];
					$uph=$user;
					$ufax=016666-290399;
					$uc="India";
					$uadd=rawurlencode($row['OrderShipAddress']);
					$ua=0;
					$uuby=0;
					$uremark=0;
			$ucreatedby="developer";
				$result3=mysql_query("insert into tbluserscopy(UserType,UserFirstName,UserLastName,UserEmail,UserVerificationCode,UserPhone,UserPassword,UserAddress,UserCity,UserState,UserZip,UserRegistrationDate,UserEmailVerified,CreatedBy)
				 values('$utype','$ufname','$ulname','$uemail','$uvcode','$uph','$upwd','$uadd','$ucity','$ustate','$uzip',now(),'0','$ucreatedby')");
				 /*
			$qu="update tbl_orders set OrderUserId='$us' where OrderId='$oid'";
		    $rest=mysql_query($qu);*/
		    /*
		if($result3)
		{
			echo '<br>'.$oid.' is updated';
		}
		}		
		}
		*/
		?>
		
<?php include 'footer.php'; ?>
