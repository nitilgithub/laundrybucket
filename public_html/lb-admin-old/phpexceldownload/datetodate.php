<?php
@ob_start();
@session_start();
error_reporting(E_ALL);
ini_set('memory_limit', '1024M'); // or you could use 1G
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
date_default_timezone_set('Europe/London');
$conn=mysql_connect("132.148.21.135","laundryb_lusr","x~[i#[96J;Sq") or die(mysql_error());
$db=mysql_select_db("laundryb_ldb",$conn) or die(mysql_error());
//include '../../connection.php';
if (PHP_SAPI == 'cli')
	die('This example should only be run from a Web Browser');
 $f_date="";
 $s_date="";
 $queryIns="";
if(isset($_POST['fdate']))
{
$f_date=$_POST['fdate'];	
$s_date=$_POST['sdate'];
$type=$_POST['type'];
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
            ->setCellValue('D2', 'OrderSubType')
            ->setCellValue('E2', 'OrderUserId')
			->setCellValue('F2', 'User_Subsid')
			->setCellValue('G2', 'OrderTotalAmount')
			->setCellValue('H2', 'OrderTotalWeight')
			->setCellValue('I2', 'OrderShipName')
			->setCellValue('J2', 'OrderShipAddress')
			->setCellValue('K2', 'delivery_address')
			->setCellValue('L2', 'OrderCity')
			->setCellValue('M2', 'OrderState')
			->setCellValue('N2', 'OrderZip')
			->setCellValue('O2', 'OrderCountry')
			->setCellValue('P2', 'OrderPhone')
			->setCellValue('Q2', 'OrderFax')
			->setCellValue('R2', 'OrderShipping')
			->setCellValue('S2', 'OrderEmail')
			->setCellValue('T2', 'OrderDate')
			->setCellValue('U2', 'OrderStatusId')
			->setCellValue('V2', 'OrderTrackingNumber')
			->setCellValue('W2', 'OrderCustReceiptCopy')
			->setCellValue('X2', 'OrderDeliveryType')
			->setCellValue('Y2', 'Order_PickupDate')
			->setCellValue('Z2', 'Order_PickTime')
			->setCellValue('AA2', 'Review')
			->setCellValue('AB2', 'Order_Via')
			->setCellValue('AC2', 'walletdeduction_amt')
			->setCellValue('AD2', 'CreatedBy')
			->setCellValue('AE2', 'Rider')
			->setCellValue('AF2', 'delivery_date')
			->setCellValue('AG2', 'discount')
			->setCellValue('AH2', 'tax')
			->setCellValue('AI2', 'PaidAmount')
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
  if($type=="all")
  {
  	 $queryIns="SELECT `OrderId`,`OrderReceiptId`,`OrderType`,`OrderSubType`,`OrderUserId`,`User_Subsid`,
`OrderTotalAmount`,`OrderTotalWeight`,`OrderShipName`,`OrderShipAddress`,`delivery_address`,
`OrderCity`,`OrderState`,`OrderZip`,`OrderCountry`,`OrderPhone`,`OrderFax`,
`OrderShipping`,`OrderEmail`,`OrderDate`,`OrderStatusId`,`OrderTrackingNumber`,
`OrderCustReceiptCopy`,`OrderDeliveryType`,ifnull(str_to_date(Order_PickDate,'%m/%d/%Y'),Order_PickDate)
as Order_PickupDate,
`Order_PickTime`,`Review`,`Order_Via`,`walletdeduction_amt`,`CreatedBy`,
`RiderId`,`delivery_date`,`discount`,`tax`,`PaidAmount` FROM
`tbl_orders` where
((ifnull(str_to_date(Order_PickDate,'%m/%d/%Y'),Order_PickDate)
between str_to_date('$f_date','%m/%d/%Y') and
str_to_date('$s_date','%m/%d/%Y'))&& (OrderStatusId!=5))"; 
  }
  else {
  
  $queryIns="SELECT `OrderId`,`OrderReceiptId`,`OrderType`,`OrderSubType`,`OrderUserId`,`User_Subsid`,
`OrderTotalAmount`,`OrderTotalWeight`,`OrderShipName`,`OrderShipAddress`,`delivery_address`,
`OrderCity`,`OrderState`,`OrderZip`,`OrderCountry`,`OrderPhone`,`OrderFax`,
`OrderShipping`,`OrderEmail`,`OrderDate`,`OrderStatusId`,`OrderTrackingNumber`,
`OrderCustReceiptCopy`,`OrderDeliveryType`,ifnull(str_to_date(Order_PickDate,'%m/%d/%Y'),Order_PickDate)
as Order_PickupDate,
`Order_PickTime`,`Review`,`Order_Via`,`walletdeduction_amt`,`CreatedBy`,
`RiderId`,`delivery_date`,`discount`,`tax`,`PaidAmount` FROM
`tbl_orders` where
((ifnull(str_to_date(Order_PickDate,'%m/%d/%Y'),Order_PickDate)
between str_to_date('$f_date','%m/%d/%Y') and
str_to_date('$s_date','%m/%d/%Y'))&& (OrderStatusId!=5)&& (OrderType like '%".$type."%'))"; 
  }	
  				$result1=mysql_query($queryIns);
    			if(mysql_num_rows($result1)>0)
				{
					while($row=mysql_fetch_array($result1))
					{
					  $objPHPExcel->setActiveSheetIndex(0)
			            ->setCellValue('A'.$i, $row["OrderId"])
			            ->setCellValue('B'.$i,$row["OrderReceiptId"])
			            ->setCellValue('D'.$i, $row["OrderType"])
						->setCellValue('c'.$i,$row["OrderSubType"])
			            ->setCellValue('E'.$i,$row["OrderUserId"])
						->setCellValue('F'.$i, $row["User_Subsid"])
						->setCellValue('G'.$i, $row["OrderTotalAmount"])
						->setCellValue('H'.$i, $row["OrderTotalWeight"])
						->setCellValue('I'.$i, $row["OrderShipName"])
						->setCellValue('J'.$i, $row["OrderShipAddress"])
						->setCellValue('K'.$i, $row["delivery_address"])
						->setCellValue('L'.$i, $row["OrderCity"])
						->setCellValue('M'.$i, $row["OrderState"])
						->setCellValue('N'.$i, $row["OrderZip"])
						->setCellValue('O'.$i, $row["OrderCountry"])
						->setCellValue('P'.$i, $row["OrderPhone"])
						->setCellValue('Q'.$i,$row["OrderFax"])
						->setCellValue('R'.$i, $row["OrderShipping"])
						->setCellValue('S'.$i,$row["OrderEmail"])
						->setCellValue('T'.$i, $row["OrderDate"])
						->setCellValue('U'.$i,$row["OrderStatusId"])
						->setCellValue('V'.$i, $row["OrderTrackingNumber"])
						->setCellValue('W'.$i, $row["OrderCustReceiptCopy"])
						->setCellValue('X'.$i, $row["OrderDeliveryType"])
						->setCellValue('Y'.$i, $row["Order_PickupDate"])
					    ->setCellValue('Z'.$i, $row["Order_PickTime"])
						->setCellValue('AA'.$i, $row["Review"])
						->setCellValue('AB'.$i, $row["Order_Via"])
						->setCellValue('AC'.$i, $row["walletdeduction_amt"])
						->setCellValue('AD'.$i, $row["CreatedBy"])
						->setCellValue('AE'.$i, $row["RiderId"])
						->setCellValue('AF'.$i, $row["delivery_date"])
						->setCellValue('AG'.$i, $row["discount"])
						->setCellValue('AH'.$i, $row["tax"])
						->setCellValue('AI'.$i, $row["PaidAmount"])
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

