<?php
include '../connection.php'; 
$category = (mysql_real_escape_string($_GET['cat']));

$query  = "SELECT * FROM tbl_usersubscriptions WHERE UserId='$category'";
$result = mysql_query($query);

?>

<option value="-1"  style="margin-bottom:7px">Select Item Package</option>
<?php while ($row=mysql_fetch_array($result)) { ?>
<option value="<?php echo $row['srno']?>" id="<?php echo $row['srno']?>" style="padding-bottom:7px"> <?php echo $row['srno'];?></option>

<?php } ?>

            					