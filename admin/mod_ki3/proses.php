<?php
require "../../config/config.database.php";
require "../../vendor/autoload.php";
require("../../config/config.function.php");
session_start();
 
use PhpOffice\PhpSpreadsheet\Helper\Sample;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

  $id=$_GET['id'];
  $edit2=$koneksi->query("select * from jadwal_mapel where id_jadwal='$id'");
  $ms=mysqli_fetch_array($edit2);
  $mapel=$ms['kode'];
  $klas=$ms['kelas'];
 
$spreadsheet = new Spreadsheet();
$spreadsheet->getProperties()->setCreator('Edi Sukarna')
->setLastModifiedBy('Edi Sukarna')
->setTitle('Office 2007 XLSX')
->setSubject('Office 2007 XLSX')
->setDescription('Test document for Office 2007 XLSX.')
->setKeywords('office 2007 openxml php')
->setCategory('Test result file');

$spreadsheet->getActiveSheet()->getStyle('A1:O1')
    ->getFont()->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_WHITE);

    $spreadsheet->getActiveSheet()->getStyle('A1:O1')->getFill()
    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
    ->getStartColor()->setARGB('FFFF0000');



$spreadsheet->setActiveSheetIndex(0)
->setCellValue('A1', "No")
->setCellValue('B1', "NIS")
->setCellValue('C1', "Nama Siswa")
->setCellValue('D1', "Mapel") 
->setCellValue('E1', "PH1")
->setCellValue('F1', "PH2")
->setCellValue('G1', "PH3")
->setCellValue('H1', "PH4")
->setCellValue('I1', "PH5")
->setCellValue('J1', "PH6")
->setCellValue('K1', "PH7")
->setCellValue('L1', "PH8")
->setCellValue('M1', "PTS")
->setCellValue('N1', "PAT")
->setCellValue('O1', "Kelas"); 
$i=2; 
$no=1; 
$sql = mysqli_query($koneksi, "SELECT * FROM siswa WHERE id_kelas='$klas'");

while($row = mysqli_fetch_array($sql)){ 
$spreadsheet->setActiveSheetIndex(0)
	->setCellValue('A'.$i, $no)
	->setCellValue('B'.$i, $row['nis'])
	->setCellValue('C'.$i, $row['nama'])
	->setCellValue('D'.$i, $mapel)
	->setCellValue('E'.$i, '')
	->setCellValue('F'.$i, '')
	->setCellValue('G'.$i, '')
	->setCellValue('H'.$i, '')
	->setCellValue('I'.$i, '')
	->setCellValue('J'.$i, '')
	->setCellValue('K'.$i, '')
	->setCellValue('L'.$i, '')
	->setCellValue('M'.$i, '')
	->setCellValue('N'.$i, '')
	->setCellValue('O'.$i, $row['id_kelas']);
	$i++; $no++;
}

$spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(5); 
$spreadsheet->getActiveSheet()->getColumnDimension('B')->setWidth(15); 
$spreadsheet->getActiveSheet()->getColumnDimension('C')->setWidth(30); 
$spreadsheet->getActiveSheet()->getColumnDimension('D')->setWidth(10); 
$spreadsheet->getActiveSheet()->getColumnDimension('E')->setWidth(5); 
$spreadsheet->getActiveSheet()->getColumnDimension('F')->setWidth(5);
$spreadsheet->getActiveSheet()->getColumnDimension('G')->setWidth(5); 
$spreadsheet->getActiveSheet()->getColumnDimension('H')->setWidth(5);
$spreadsheet->getActiveSheet()->getColumnDimension('I')->setWidth(5); 
$spreadsheet->getActiveSheet()->getColumnDimension('J')->setWidth(5);
$spreadsheet->getActiveSheet()->getColumnDimension('K')->setWidth(5); 
$spreadsheet->getActiveSheet()->getColumnDimension('L')->setWidth(5);
$spreadsheet->getActiveSheet()->getColumnDimension('M')->setWidth(5); 
$spreadsheet->getActiveSheet()->getColumnDimension('N')->setWidth(5);
$spreadsheet->getActiveSheet()->getColumnDimension('O')->setWidth(0);

$spreadsheet->getActiveSheet()->setTitle('KI-3-'.$mapel);

$spreadsheet->setActiveSheetIndex(0);


header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');

header("Content-Disposition: attachment; filename=$ms[kode] KI-3 kelas $klas.xlsx");
header('Cache-Control: max-age=0');

header('Cache-Control: max-age=1');


header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); 
header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); 
header('Cache-Control: cache, must-revalidate'); 
header('Pragma: public');

$writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
$writer->save('php://output');

?>
