<?php
$conn=mysql_connect("sangwanbrothersproductiondb.clp1di3hdfiu.ap-south-1.rds.amazonaws.com","radmin","Ouat1agffA#") or die(mysql_error());
$db=mysql_select_db("laundrydb",$conn) or die(mysql_error());
//$conn=mysql_connect("localhost","laundry_user","Ouat1agffA") or die(mysql_error());
//$db=mysql_select_db("laundry_db",$conn) or die(mysql_error());
?>

