<?php

$res1=mysql_query("select * from tbl_usersubscriptions order by srno");
while($row1=mysql_fetch_array($res1))
{
	$srno=$row1['srno'];
	
	$subsid=$row1['subs_id'];
	
	$res2=mysql_query("select * from tbl_subscriptions where subs_id='$subsid'");
	
	$row2=mysql_fetch_array($res2);
	
	$date1=date_create(date('Y-m-d'));
											
	$date2=date_create($row1['next_renewal']);
												
	$diff=date_diff($date1,$date2);	
											
	$validity=$diff->format("%R%a");	
	
	if($validity<=0)
	{
		$r=mysql_query("update tbl_usersubscriptions set subs_status='expired' where srno='$srno'");
	}
	
	/*$used_wt=$row1['used_weight'];
	$available_wt=$row2['subs_wt'];
	$remain_wt=$available_wt-$used_wt;
	
	$used_pickup=$row1['max_pickup'];
	$available_pickup=$row2['subs_maxpickup'];
	$remain_pickup=$available_pickup-$used_pickup;
	
	if($remain_wt<=0 && $remain_pickup<=0)
	{
		$r1=mysql_query("update tbl_usersubscriptions set subs_status='completed' where srno='$srno'");
	}*/
	
	
	
}
?>