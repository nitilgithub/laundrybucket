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
            ->setCellValue('A2', 'UserId')
            ->setCellValue('B2', 'UserFirstName')
            ->setCellValue('C2', 'UserLastName')
            ->setCellValue('D2', 'UserPhone')
            ->setCellValue('E2', 'UserEmail')
			->setCellValue('F2', 'Address');


			
		
	
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
  	 $queryIns="select * from tblusers order by UserId DESC";
  				$result1=mysql_query($queryIns);
    			if(mysql_num_rows($result1)>0)
				{
					while($row=mysql_fetch_array($result1))
					{
							$uid=$row["UserId"];
										$result2=mysql_query("select * from tblusers_address where UserId='$uid' order by id DESC");

										$row2=mysql_fetch_array($result2);

										

											
						
					  $objPHPExcel->setActiveSheetIndex(0)
			            ->setCellValue('A'.$i, $row["UserId"])
			            ->setCellValue('B'.$i,$row["UserFirstName"])
			            ->setCellValue('c'.$i, $row["UserLastName"])
						->setCellValue('d'.$i,$row["UserPhone"])
			            ->setCellValue('E'.$i,$row["UserEmail"])
						->setCellValue('F'.$i, $row2["Address"])
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
header('Content-Disposition: attachment; filename=user.xlsx');
$objWriter->save('php://output');
exit;

