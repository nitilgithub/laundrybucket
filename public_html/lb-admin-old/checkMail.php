<?php
include 'connection.php';
?>
<?php$echeck="select email from tblusers where UserEmail=".mysql_real_escape_string($_POST['email']);
   $echk=mysql_query($echeck);
   $ecount=mysql_num_rows($echk);
  if($ecount!=0)
   {
   	echo "email already exist";
   }
  
 
   
?>