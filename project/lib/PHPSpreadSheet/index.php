<?php 
require_once("vendor/autoload.php"); 

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$objSpreadsheet = new Spreadsheet();
$sheet = $objSpreadsheet->getActiveSheet();
$sheet->setCellValue('A1', '晨蕾');

$writer = new Xlsx($objSpreadsheet);
$writer->save('export.xlsx');
?>
