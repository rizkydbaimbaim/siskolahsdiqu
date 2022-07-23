<?php
require "../../config/config.database.php";
require "../../vendor/autoload.php";
require("../../config/config.function.php");

use PhpOffice\PhpSpreadsheet\Helper\Sample;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

$id=$_GET['id'];
 $edit2=$koneksi->query("select * from jadwal_mapel where id_jadwal='$id'");
  $ms=mysqli_fetch_array($edit2);
  $mapel=$ms['kode'];


$spreadsheet = new Spreadsheet();
$spreadsheet->getProperties()->setCreator('Edi Sukarna')
->setLastModifiedBy('Edi Sukarna')
->setTitle('Office 2007 XLSX')
->setSubject('Office 2007 XLSX')
->setDescription('Test document for Office 2007 XLSX.')
->setKeywords('office 2007 openxml php')
->setCategory('Test result file');

$spreadsheet->getActiveSheet()->getStyle('A1:E1')
    ->getFont()->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_WHITE);

    $spreadsheet->getActiveSheet()->getStyle('A1:E1')->getFill()
    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
    ->getStartColor()->setARGB('FFFF0000');



$spreadsheet->setActiveSheetIndex(0)
->setCellValue('A1', "No")
->setCellValue('B1', "Kelas")
->setCellValue('C1', "Mapel")
->setCellValue('D1', "No Urut") 
->setCellValue('E1', "Deskripsi") 
; 

$i=2; 
$no=1; 
$sql = mysqli_query($koneksi, "SELECT * FROM jadwal_mapel WHERE id_jadwal='$id'");

while($row = mysqli_fetch_array($sql)){ 
$spreadsheet->setActiveSheetIndex(0)
	->setCellValue('A'.$i, $no)
	->setCellValue('B'.$i, $row['kelas'])
	->setCellValue('C'.$i, $row['kode'])
	->setCellValue('D'.$i, '1')
	->setCellValue('E'.$i, '')
	
	;
	
	$i++; $no++;
}

$spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(5); 
$spreadsheet->getActiveSheet()->getColumnDimension('B')->setWidth(6); 
$spreadsheet->getActiveSheet()->getColumnDimension('C')->setWidth(10); 
$spreadsheet->getActiveSheet()->getColumnDimension('D')->setWidth(8); 
$spreadsheet->getActiveSheet()->getColumnDimension('E')->setWidth(100); 


$spreadsheet->getActiveSheet()->setTitle('Des-KI4-'.$mapel);

$spreadsheet->setActiveSheetIndex(0);


header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');

header("Content-Disposition: attachment; filename=$ms[kode] Deskripsi KI-4 kelas $ms[kelas].xlsx");
header('Cache-Control: max-age=0');

header('Cache-Control: max-age=1');


header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); 
header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); 
header('Cache-Control: cache, must-revalidate'); 
header('Pragma: public');

$writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
$writer->save('php://output');

?>
