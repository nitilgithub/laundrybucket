<?php

header('Access-Control-Allow-Origin: *');

header('Content-Type: application/json');

include '../connection.php';
$arr=array();
$return_array=array();
$city=array();
global $countcity;

$val=mysql_real_escape_string($_GET['val']);
//$query="SELECT ifnull(count(*),0) as no_of_orders,OrderCity as OrderCity,MONTHNAME(ifnull(str_to_date(Order_PickDate,'%m/%d/%Y'),Order_PickDate)) as Months FROM `tbl_orders` WHERE year(ifnull(str_to_date(Order_PickDate,'%m/%d/%Y'),Order_PickDate))='$val' and (OrderCity='Noida' or OrderCity='Gaziabad' or OrderCity LIKE '%Greater%' )GROUP BY MONTH(ifnull(str_to_date(Order_PickDate,'%m/%d/%Y'),Order_PickDate)),OrderCity DESC";
//$query="SELECT ifnull(count(*),0) as no_of_orders,OrderCity as OrderCity,MONTHNAME(ifnull(str_to_date(Order_PickDate,'%m/%d/%Y'),Order_PickDate)) as Months FROM `tbl_orders` WHERE (year(ifnull(str_to_date(Order_PickDate,'%m/%d/%Y'),Order_PickDate))='$val' and (OrderCity='Noida' or OrderCity='Gaziabad'  or OrderCity='Greater Noida'))GROUP BY MONTH(ifnull(str_to_date(Order_PickDate,'%m/%d/%Y'),Order_PickDate)),OrderCity";
$rs2=mysql_query("select CityName from tbl_city ORDER BY CityName DESC ");
$countcity=mysql_num_rows($rs2);

//echo $countcity;
  
	while($row2=mysql_fetch_array($rs2))
	{
		$city[]=$row2["CityName"];
		
	}

$cities = join("', '", $city);


//	print_r($cities);

$rs=mysql_query("select DISTINCT(MONTHNAME(ifnull(str_to_date(Order_PickDate,'%m/%d/%Y'),Order_PickDate))) as Months from tbl_orders where((Year(ifnull(str_to_date(Order_PickDate,'%m/%d/%Y'),Order_PickDate)))='$val') order by MONTH(ifnull(str_to_date(Order_PickDate,'%m/%d/%Y'),Order_PickDate))");
while($row1=mysql_fetch_array($rs))
{
	$month=$row1["Months"];
	//echo $month."<br/>";
		//echo $city;
		$query="select ifnull(count(*),0) as no_of_orders,OrderCity from tbl_orders where((MONTHNAME(ifnull(str_to_date(Order_PickDate,'%m/%d/%Y'),Order_PickDate))='$month') and OrderCity IN ('$cities')) Group by OrderCity DESC";	
		//echo $query;
		$result=mysql_query($query);
		
		
		if(mysql_num_rows($result)<$countcity)
		{
			//$i=0;
			$fmonth=$row1["Months"];
	$ress=mysql_query("CREATE or replace view temporder as select ifnull(count(*),0) as no_of_orders,OrderCity from tbl_orders where((MONTHNAME(ifnull(str_to_date(Order_PickDate,'%m/%d/%Y'),Order_PickDate))='$fmonth') and OrderCity IN ('$cities')) Group by OrderCity DESC");		
		$ress2=mysql_query("SELECT c.CityName,t.no_of_orders FROM  tbl_city as c LEFT OUTER JOIN `temporder` as t ON c.CityName = t.OrderCity order by c.CityName DESC");	
			$row=mysql_fetch_array($ress2);
		
				$row_array['y'] = $row1["Months"];
				$row_array['a'] = (empty($row['no_of_orders'])?0:$row['no_of_orders']);
				$row=mysql_fetch_array($ress2);
				$row_array['b'] = (empty($row['no_of_orders'])?0:$row['no_of_orders']);
				$row=mysql_fetch_array($ress2);
				$row_array['c'] = (empty($row['no_of_orders'])?0:$row['no_of_orders']);
				$row=mysql_fetch_array($ress2);
				$row_array['d'] = (empty($row['no_of_orders'])?0:$row['no_of_orders']);
				$row=mysql_fetch_array($ress2);
				$row_array['e'] = (empty($row['no_of_orders'])?0:$row['no_of_orders']);
				
				
	array_push($return_array,$row_array);			
		
			
			
		}
			else
				{
					
			$row=mysql_fetch_array($result);
		
				
				$row_array['y'] = $row1["Months"];
				
				$row_array['a'] = (empty($row['no_of_orders'])?0:$row['no_of_orders']);
				$row=mysql_fetch_array($result);
				$row_array['b'] = (empty($row['no_of_orders'])?0:$row['no_of_orders']);
				$row=mysql_fetch_array($result);
				$row_array['c'] = (empty($row['no_of_orders'])?0:$row['no_of_orders']);
				$row=mysql_fetch_array($result);
				$row_array['d'] = (empty($row['no_of_orders'])?0:$row['no_of_orders']);
				$row=mysql_fetch_array($result);
				$row_array['e'] = (empty($row['no_of_orders'])?0:$row['no_of_orders']);
				
	array_push($return_array,$row_array);			
		
		
				}
		
				
	
	
}



	         //  $result=mysql_query($query) or die(mysql_error());
			  
			   /*while($row=mysql_fetch_array($result))

					   {

						
				$row_array['y'] = $row['Months'];
				$row_array['a'] = intval($row['no_of_orders']);
				$row=mysql_fetch_array($result);
				$row_array['b'] = intval($row['no_of_orders']);
				$row=mysql_fetch_array($result);
				$row_array['c'] = intval($row['no_of_orders']);
				
				
				array_push($return_arr,$row_array);
				 			        }
*/
				    			//array_push($return_arr,$row_array);

					 echo json_encode($return_array);

					 mysql_close();

?>

										

								