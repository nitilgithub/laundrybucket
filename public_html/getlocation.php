<?php
include 'connection.php';

$city=mysql_real_escape_string($_GET['city']);
$res=mysql_query("select l.locName from tbl_location as l join tbl_city as c on c.id=l.cityId where c.CityName='$city'");

while($row=mysql_fetch_array($res))
{
?>
<option value="<?php echo $row['locName']; ?>"><?php echo $row['locName']; ?></option>
<?php
}
?>