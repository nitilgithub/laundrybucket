<?php
@ob_start();
@session_start();
error_reporting(E_ALL);
ini_set('memory_limit', '1024M'); // or you could use 1G
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
date_default_timezone_set('Europe/London');
/*$conn=mysql_connect("132.148.21.135","laundryb_lusr","x~[i#[96J;Sq") or die(mysql_error());
$db=mysql_select_db("laundryb_ldb",$conn) or die(mysql_error());*/

$conn=mysql_connect("132.148.21.135","laundryb_lusr","x~[i#[96J;Sq") or die(mysql_error());
$db=mysql_select_db("laundryb_beta",$conn) or die(mysql_error());

//include '../../connection.php';
if (PHP_SAPI == 'cli')
	die('This example should only be run from a Web Browser');
 $f_date="";
 $s_date="";
 $ostatus="all";
 $queryIns="";
if(isset($_POST['fdate']))
{
$f_date=$_POST['fdate'];	
$s_date=$_POST['sdate'];
$type=$_POST['type'];
$ostatus=$_POST['ostatus'];
$franchiseid=$_POST["franchiseid"];
}
 //** Include PHPExcel */
require_once dirname(__FILE__) . '/PHPExcel.php';


// Create new PHPExcel object
$objPHPExcel = new PHPExcel();

// Set document properties
$objPHPExcel->getProperties()->setCreator("Maarten Balliauw")
							 ->setLastModifiedBy("Maarten Balliauw")
							 ->setTitle("Office 2007 XLSX Test Document")
							 ->setSubject("Office 2007 XLSX Test Document")
							 ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
							 ->setKeywords("office 2007 openxml php")
							 ->setCategory("Test result file");


// Add some data
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A2', 'OrderId')
            ->setCellValue('B2', 'OrderReceiptId')
            ->setCellValue('C2', 'OrderType')
            ->setCellValue('D2', 'OrderUserId')
            ->setCellValue('E2', 'OrderTotalAmount')
			->setCellValue('F2', 'OrderTotalWeight')
			->setCellValue('G2', 'OrderShipName')
			->setCellValue('H2', 'OrderShipAddress')
			->setCellValue('I2', 'delivery_address')
			->setCellValue('J2', 'OrderCity')
			->setCellValue('K2', 'OrderPhone')
			->setCellValue('L2', 'OrderEmail')
			->setCellValue('M2', 'OrderDate')
			->setCellValue('N2', 'OrderStatusId')
			->setCellValue('O2', 'OrderDeliveryType')
			->setCellValue('P2', 'Order_PickupDate')
			->setCellValue('Q2', 'Order_PickTime')
			->setCellValue('R2', 'Review')
			->setCellValue('S2', 'Order_Via')
			->setCellValue('T2', 'CreatedBy')
			->setCellValue('U2', 'delivery_date')
			->setCellValue('V2', 'discount')
			->setCellValue('W2', 'tax')
			->setCellValue('X2', 'PaidAmount')
			/*->setCellValue('Y2', 'Order_PickupDate')
			->setCellValue('Z2', 'Order_PickTime')
			->setCellValue('AA2', 'Review')
			->setCellValue('AB2', 'Order_Via')
			->setCellValue('AC2', 'walletdeduction_amt')
			->setCellValue('AD2', 'CreatedBy')
			->setCellValue('AE2', 'Rider')
			->setCellValue('AF2', 'delivery_date')
			->setCellValue('AG2', 'discount')
			->setCellValue('AH2', 'tax')
			->setCellValue('AI2', 'PaidAmount')*/
			
			;


			
			
	
          /*$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('AB2', 'Pmt. Deposited');
			 $objPHPExcel->getActiveSheet()->getStyle('AB2')->getFont()->setBold(true);
			 

$objPHPExcel->getActiveSheet()->getStyle('AB2')->applyFromArray(
    array(
        'fill' => array(
            'type' => PHPExcel_Style_Fill::FILL_SOLID,
            'color' => array('rgb' => 'FFFF00')
        )
    )
);*/
	
	 $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(TRUE);
   	 $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(TRUE);
   	 $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(TRUE);
   	 $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize(TRUE);
   	 $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setAutoSize(TRUE);
   	 $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setAutoSize(TRUE);
   	 $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setAutoSize(TRUE);
   	 $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setAutoSize(TRUE);
   	 $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setAutoSize(TRUE);
   	 $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setAutoSize(TRUE);
   	 $objPHPExcel->getActiveSheet()->getColumnDimension('K')->setAutoSize(TRUE);
   	 $objPHPExcel->getActiveSheet()->getColumnDimension('L')->setAutoSize(TRUE);
   	 $objPHPExcel->getActiveSheet()->getColumnDimension('M')->setAutoSize(TRUE);
   	 $objPHPExcel->getActiveSheet()->getColumnDimension('N')->setAutoSize(TRUE);
   	 $objPHPExcel->getActiveSheet()->getColumnDimension('O')->setAutoSize(TRUE);
   	 $objPHPExcel->getActiveSheet()->getColumnDimension('W')->setAutoSize(TRUE);
   	 $objPHPExcel->getActiveSheet()->getColumnDimension('X')->setAutoSize(TRUE);
   	// $objPHPExcel->getActiveSheet()->getColumnDimension('aB')->setAutoSize(TRUE);
   	
		
			// Add some data
 $letters = range('A','Z');
  $count =0;
  $cell_name="";
  $i=26;
  while($i>0)
  {
   $cell_name = $letters[$count]."2";
   $count++;
   $i--;
   
   // Make bold cells
   $objPHPExcel->getActiveSheet()->getStyle($cell_name)->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle($cell_name)->applyFromArray(
    array(
        'fill' => array(
            'type' => PHPExcel_Style_Fill::FILL_SOLID,
            'color' => array('rgb' => 'FFFF00')
        )
    )
);

  }
  $objPHPExcel->getActiveSheet()->getStyle('AA2')->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle('AA2')->applyFromArray(
    array(
        'fill' => array(
            'type' => PHPExcel_Style_Fill::FILL_SOLID,
            'color' => array('rgb' => 'FFFF00')
        )
    )
);
  $objPHPExcel->getActiveSheet()->getStyle('AA2')->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle('AA2')->applyFromArray(
    array(
        'fill' => array(
            'type' => PHPExcel_Style_Fill::FILL_SOLID,
            'color' => array('rgb' => 'FFFF00')
        )
    )
);$objPHPExcel->getActiveSheet()->getStyle('AA2')->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle('AA2')->applyFromArray(
    array(
        'fill' => array(
            'type' => PHPExcel_Style_Fill::FILL_SOLID,
            'color' => array('rgb' => 'FFFF00')
        )
    )
);$objPHPExcel->getActiveSheet()->getStyle('AA2')->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle('AA2')->applyFromArray(
    array(
        'fill' => array(
            'type' => PHPExcel_Style_Fill::FILL_SOLID,
            'color' => array('rgb' => 'FFFF00')
        )
    )
);$objPHPExcel->getActiveSheet()->getStyle('AA2')->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle('AA2')->applyFromArray(
    array(
        'fill' => array(
            'type' => PHPExcel_Style_Fill::FILL_SOLID,
            'color' => array('rgb' => 'FFFF00')
        )
    )
);$objPHPExcel->getActiveSheet()->getStyle('AB2')->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle('AB2')->applyFromArray(
    array(
        'fill' => array(
            'type' => PHPExcel_Style_Fill::FILL_SOLID,
            'color' => array('rgb' => 'FFFF00')
        )
    )
);$objPHPExcel->getActiveSheet()->getStyle('AC2')->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle('AC2')->applyFromArray(
    array(
        'fill' => array(
            'type' => PHPExcel_Style_Fill::FILL_SOLID,
            'color' => array('rgb' => 'FFFF00')
        )
    )
);$objPHPExcel->getActiveSheet()->getStyle('AD2')->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle('AD2')->applyFromArray(
    array(
        'fill' => array(
            'type' => PHPExcel_Style_Fill::FILL_SOLID,
            'color' => array('rgb' => 'FFFF00')
        )
    )
);
$objPHPExcel->getActiveSheet()->getStyle('AE2')->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle('AE2')->applyFromArray(
    array(
        'fill' => array(
            'type' => PHPExcel_Style_Fill::FILL_SOLID,
            'color' => array('rgb' => 'FFFF00')
        )
    )
);$objPHPExcel->getActiveSheet()->getStyle('AF2')->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle('AF2')->applyFromArray(
    array(
        'fill' => array(
            'type' => PHPExcel_Style_Fill::FILL_SOLID,
            'color' => array('rgb' => 'FFFF00')
        )
    )
);$objPHPExcel->getActiveSheet()->getStyle('AG2')->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle('AG2')->applyFromArray(
    array(
        'fill' => array(
            'type' => PHPExcel_Style_Fill::FILL_SOLID,
            'color' => array('rgb' => 'FFFF00')
        )
    )
);$objPHPExcel->getActiveSheet()->getStyle('AH2')->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle('AH2')->applyFromArray(
    array(
        'fill' => array(
            'type' => PHPExcel_Style_Fill::FILL_SOLID,
            'color' => array('rgb' => 'FFFF00')
        )
    )
);$objPHPExcel->getActiveSheet()->getStyle('AI2')->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle('AI2')->applyFromArray(
    array(
        'fill' => array(
            'type' => PHPExcel_Style_Fill::FILL_SOLID,
            'color' => array('rgb' => 'FFFF00')
        )
    )
);
  
    $i=3;
  $sr=1;
  
  if($_SESSION['loginrole']==9)
{
	if($type=='all' && $ostatus=='all')
	{
		$queryIns="SELECT o.OrderId,o.OrderReceiptId,s.ServiceName,o.OrderUserId,b.TotalAmount,b.TotalWeight,u.UserFirstName,u.UserLastName,o.PickupAddress,b.DeliveryAddress,o.OrderCity,u.UserPhone,u.UserEmail,o.addon,t.order_status_text,d.DeliveryTitle,ifnull(str_to_date(o.Order_PickDate,'%m/%d/%Y'),o.Order_PickDate)as Order_PickupDate,o.Order_PickTime,b.Remarks,o.Order_Via,o.CreatedBy,
b.DeliveryDate,b.OfferDiscount,b.ManualDiscount,b.tax,o.PaidAmount FROM
tbl_orders as o join tbl_suborders as b on o.OrderId=b.OrderId join tbl_services as s on b.OrderTypeId=s.ServiceId join tblusers as u on u.UserId=b.UserId join tbl_orderstatus_id as t on t.order_status_id=o.OrderStatusId join tbl_deliverytypes as d on d.DeliveryId=b.DeliveryTypeId where o.franchiseId='$franchiseid' and
((ifnull(str_to_date(o.Order_PickDate,'%m/%d/%Y'),o.Order_PickDate)
between str_to_date('$f_date','%m/%d/%Y') and str_to_date('$s_date','%m/%d/%Y'))&& (o.OrderStatusId!=5) && (o.franchiseId='".$_SESSION['loginid']."')) order by o.OrderId";
	}	
	else if($type=='all' && $ostatus!='all'){
	$queryIns="SELECT o.OrderId,o.OrderReceiptId,s.ServiceName,o.OrderUserId,b.TotalAmount,b.TotalWeight,u.UserFirstName,u.UserLastName,o.PickupAddress,b.DeliveryAddress,o.OrderCity,u.UserPhone,u.UserEmail,o.addon,t.order_status_text,d.DeliveryTitle,ifnull(str_to_date(o.Order_PickDate,'%m/%d/%Y'),o.Order_PickDate)as Order_PickupDate,o.Order_PickTime,b.Remarks,o.Order_Via,o.CreatedBy,
b.DeliveryDate,b.OfferDiscount,b.ManualDiscount,b.tax,o.PaidAmount FROM
tbl_orders as o join tbl_suborders as b on o.OrderId=b.OrderId join tbl_services as s on b.OrderTypeId=s.ServiceId join tblusers as u on u.UserId=b.UserId join tbl_orderstatus_id as t on t.order_status_id=o.OrderStatusId join tbl_deliverytypes as d on d.DeliveryId=b.DeliveryTypeId where o.franchiseId='$franchiseid' and
((ifnull(str_to_date(o.Order_PickDate,'%m/%d/%Y'),o.Order_PickDate)
between str_to_date('$f_date','%m/%d/%Y') and str_to_date('$s_date','%m/%d/%Y'))&& (o.OrderStatusId='$ostatus') && (o.franchiseId='".$_SESSION['loginid']."')) order by o.OrderId";
}
else if($type!='all' && $ostatus=='all'){
$queryIns="SELECT o.OrderId,o.OrderReceiptId,s.ServiceName,o.OrderUserId,b.TotalAmount,b.TotalWeight,u.UserFirstName,u.UserLastName,o.PickupAddress,b.DeliveryAddress,o.OrderCity,u.UserPhone,u.UserEmail,o.addon,t.order_status_text,d.DeliveryTitle,ifnull(str_to_date(o.Order_PickDate,'%m/%d/%Y'),o.Order_PickDate)as Order_PickupDate,o.Order_PickTime,b.Remarks,o.Order_Via,o.CreatedBy,
b.DeliveryDate,b.OfferDiscount,b.ManualDiscount,b.tax,o.PaidAmount FROM
tbl_orders as o join tbl_suborders as b on o.OrderId=b.OrderId join tbl_services as s on b.OrderTypeId=s.ServiceId join tblusers as u on u.UserId=b.UserId join tbl_orderstatus_id as t on t.order_status_id=o.OrderStatusId join tbl_deliverytypes as d on d.DeliveryId=b.DeliveryTypeId where o.franchiseId='$franchiseid' and
((ifnull(str_to_date(o.Order_PickDate,'%m/%d/%Y'),o.Order_PickDate)
between str_to_date('$f_date','%m/%d/%Y') and str_to_date('$s_date','%m/%d/%Y'))&& (o.OrderStatusId!=5)&& (o.franchiseId='".$_SESSION['loginid']."')&& (s.ServiceName like '%".$type."%')) order by o.OrderId";					
}				
	else 
	{
	
							
    $queryIns="SELECT o.OrderId,o.OrderReceiptId,s.ServiceName,o.OrderUserId,b.TotalAmount,b.TotalWeight,u.UserFirstName,u.UserLastName,o.PickupAddress,b.DeliveryAddress,o.OrderCity,u.UserPhone,u.UserEmail,o.addon,t.order_status_text,d.DeliveryTitle,ifnull(str_to_date(o.Order_PickDate,'%m/%d/%Y'),o.Order_PickDate)as Order_PickupDate,o.Order_PickTime,b.Remarks,o.Order_Via,o.CreatedBy,
b.DeliveryDate,b.OfferDiscount,b.ManualDiscount,b.tax,o.PaidAmount FROM
tbl_orders as o join tbl_suborders as b on o.OrderId=b.OrderId join tbl_services as s on b.OrderTypeId=s.ServiceId join tblusers as u on u.UserId=b.UserId join tbl_orderstatus_id as t on t.order_status_id=o.OrderStatusId join tbl_deliverytypes as d on d.DeliveryId=b.DeliveryTypeId where o.franchiseId='$franchiseid' and
((ifnull(str_to_date(o.Order_PickDate,'%m/%d/%Y'),o.Order_PickDate)
between str_to_date('$f_date','%m/%d/%Y') and str_to_date('$s_date','%m/%d/%Y'))&& (o.OrderStatusId='$ostatus')&& (o.franchiseId='".$_SESSION['loginid']."')&& (s.ServiceName like '%".$type."%')) order by o.OrderId";					
								
	}
}
else {
	
  if($type=='all' && $ostatus=='all')
  {
  	 $queryIns="SELECT o.OrderId,o.OrderReceiptId,s.ServiceName,o.OrderUserId,b.TotalAmount,b.TotalWeight,u.UserFirstName,u.UserLastName,o.PickupAddress,b.DeliveryAddress,o.OrderCity,u.UserPhone,u.UserEmail,o.addon,t.order_status_text,d.DeliveryTitle,ifnull(str_to_date(o.Order_PickDate,'%m/%d/%Y'),o.Order_PickDate)as Order_PickupDate,o.Order_PickTime,b.Remarks,o.Order_Via,o.CreatedBy,
b.DeliveryDate,b.OfferDiscount,b.ManualDiscount,b.tax,o.PaidAmount FROM
tbl_orders as o join tbl_suborders as b on o.OrderId=b.OrderId join tbl_services as s on b.OrderTypeId=s.ServiceId join tblusers as u on u.UserId=b.UserId join tbl_orderstatus_id as t on t.order_status_id=o.OrderStatusId join tbl_deliverytypes as d on d.DeliveryId=b.DeliveryTypeId where o.franchiseId='$franchiseid' and
((ifnull(str_to_date(o.Order_PickDate,'%m/%d/%Y'),o.Order_PickDate)
between str_to_date('$f_date','%m/%d/%Y') and str_to_date('$s_date','%m/%d/%Y'))&& (o.OrderStatusId!=5)) order by o.OrderId";
  }
  else if($type=='all' && $ostatus!='all'){
	$queryIns="SELECT o.OrderId,o.OrderReceiptId,s.ServiceName,o.OrderUserId,b.TotalAmount,b.TotalWeight,u.UserFirstName,u.UserLastName,o.PickupAddress,b.DeliveryAddress,o.OrderCity,u.UserPhone,u.UserEmail,o.addon,t.order_status_text,d.DeliveryTitle,ifnull(str_to_date(o.Order_PickDate,'%m/%d/%Y'),o.Order_PickDate)as Order_PickupDate,o.Order_PickTime,b.Remarks,o.Order_Via,o.CreatedBy,
b.DeliveryDate,b.OfferDiscount,b.ManualDiscount,b.tax,o.PaidAmount FROM
tbl_orders as o join tbl_suborders as b on o.OrderId=b.OrderId join tbl_services as s on b.OrderTypeId=s.ServiceId join tblusers as u on u.UserId=b.UserId join tbl_orderstatus_id as t on t.order_status_id=o.OrderStatusId join tbl_deliverytypes as d on d.DeliveryId=b.DeliveryTypeId where o.franchiseId='$franchiseid' and
((ifnull(str_to_date(o.Order_PickDate,'%m/%d/%Y'),o.Order_PickDate)
between str_to_date('$f_date','%m/%d/%Y') and str_to_date('$s_date','%m/%d/%Y'))&& (o.OrderStatusId='$ostatus')) order by o.OrderId";
}
else if($type!='all' && $ostatus=='all'){
	$queryIns="SELECT o.OrderId,o.OrderReceiptId,s.ServiceName,o.OrderUserId,b.TotalAmount,b.TotalWeight,u.UserFirstName,u.UserLastName,o.PickupAddress,b.DeliveryAddress,o.OrderCity,u.UserPhone,u.UserEmail,o.addon,t.order_status_text,d.DeliveryTitle,ifnull(str_to_date(o.Order_PickDate,'%m/%d/%Y'),o.Order_PickDate)as Order_PickupDate,o.Order_PickTime,b.Remarks,o.Order_Via,o.CreatedBy,
b.DeliveryDate,b.OfferDiscount,b.ManualDiscount,b.tax,o.PaidAmount FROM
tbl_orders as o join tbl_suborders as b on o.OrderId=b.OrderId join tbl_services as s on b.OrderTypeId=s.ServiceId join tblusers as u on u.UserId=b.UserId join tbl_orderstatus_id as t on t.order_status_id=o.OrderStatusId join tbl_deliverytypes as d on d.DeliveryId=b.DeliveryTypeId where o.franchiseId='$franchiseid' and
((ifnull(str_to_date(o.Order_PickDate,'%m/%d/%Y'),o.Order_PickDate)
between str_to_date('$f_date','%m/%d/%Y') and str_to_date('$s_date','%m/%d/%Y'))&& (o.OrderStatusId!=5)&& (s.ServiceName like '%".$type."%')) order by o.OrderId";					
}	
  else {
  
  $queryIns="SELECT o.OrderId,o.OrderReceiptId,s.ServiceName,o.OrderUserId,b.TotalAmount,b.TotalWeight,u.UserFirstName,u.UserLastName,o.PickupAddress,b.DeliveryAddress,o.OrderCity,u.UserPhone,u.UserEmail,o.addon,t.order_status_text,d.DeliveryTitle,ifnull(str_to_date(o.Order_PickDate,'%m/%d/%Y'),o.Order_PickDate)as Order_PickupDate,o.Order_PickTime,b.Remarks,o.Order_Via,o.CreatedBy,
b.DeliveryDate,b.OfferDiscount,b.ManualDiscount,b.tax,o.PaidAmount FROM
tbl_orders as o join tbl_suborders as b on o.OrderId=b.OrderId join tbl_services as s on b.OrderTypeId=s.ServiceId join tblusers as u on u.UserId=b.UserId join tbl_orderstatus_id as t on t.order_status_id=o.OrderStatusId join tbl_deliverytypes as d on d.DeliveryId=b.DeliveryTypeId where o.franchiseId='$franchiseid' and
((ifnull(str_to_date(o.Order_PickDate,'%m/%d/%Y'),o.Order_PickDate)
between str_to_date('$f_date','%m/%d/%Y') and str_to_date('$s_date','%m/%d/%Y'))&& (o.OrderStatusId='$ostatus')&& (s.ServiceName like '%".$type."%')) order by o.OrderId";
  }	
  }

  				$result1=mysql_query($queryIns);
    			if(mysql_num_rows($result1)>0)
				{
					while($row=mysql_fetch_array($result1))
					{
					  $objPHPExcel->setActiveSheetIndex(0)
			            ->setCellValue('A'.$i, $row["OrderId"])
			            ->setCellValue('B'.$i,$row["OrderReceiptId"])
			            ->setCellValue('C'.$i, $row["ServiceName"])
						->setCellValue('D'.$i,$row["OrderUserId"])
			            ->setCellValue('E'.$i,$row["TotalAmount"])
						->setCellValue('F'.$i, $row["TotalWeight"])
						->setCellValue('G'.$i, $row["UserFirstName"]." ".$row["UserLastName"])
						->setCellValue('H'.$i, $row["PickupAddress"])
						->setCellValue('I'.$i, $row["DeliveryAddress"])
						->setCellValue('J'.$i, $row["OrderCity"])
						->setCellValue('K'.$i, $row["UserPhone"])
						->setCellValue('L'.$i, $row["UserEmail"])
						->setCellValue('M'.$i, $row["addon"])
						->setCellValue('N'.$i, $row["order_status_text"])
						->setCellValue('O'.$i, $row["DeliveryTitle"])
						->setCellValue('P'.$i, $row["Order_PickupDate"])
						->setCellValue('Q'.$i,$row["Order_PickTime"])
						->setCellValue('R'.$i, $row["Remarks"])
						->setCellValue('S'.$i,$row["Order_Via"])
						->setCellValue('T'.$i, $row["CreatedBy"])
						->setCellValue('U'.$i,$row["DeliveryDate"])
						->setCellValue('V'.$i, $row["OfferDiscount"]+$row['ManualDiscount'])
						->setCellValue('W'.$i, $row["tax"])
						->setCellValue('X'.$i, $row["PaidAmount"])
						
						/*->setCellValue('Y'.$i, $row["Order_PickupDate"])
					    ->setCellValue('Z'.$i, $row["Order_PickTime"])
						->setCellValue('AA'.$i, $row["Review"])
						->setCellValue('AB'.$i, $row["Order_Via"])
						->setCellValue('AC'.$i, $row["walletdeduction_amt"])
						->setCellValue('AD'.$i, $row["CreatedBy"])
						->setCellValue('AE'.$i, $row["RiderId"])
						->setCellValue('AF'.$i, $row["delivery_date"])
						->setCellValue('AG'.$i, $row["discount"])
						->setCellValue('AH'.$i, $row["tax"])
						->setCellValue('AI'.$i, $row["PaidAmount"])*/
						
						;
						
					
  
   $i++;
   $sr++;
  
					}
				}
  
 

  
// Miscellaneous glyphs, UTF-8

// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('Simple');


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);



// Save Excel 2007 file
#echo date('H:i:s') . " Write to Excel2007 format\n";
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
ob_end_clean();
// We'll be outputting an excel file
header('Content-type: application/vnd.ms-excel');
header('Content-Disposition: attachment; filename="'.$f_date.'.xlsx"');
$objWriter->save('php://output');
exit;

