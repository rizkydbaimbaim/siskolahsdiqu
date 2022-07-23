<?php
require("../../config/config.database.php");
require("../../config/config.function.php");
require("../../config/functions.crud.php");
require_once("../../PHPExcel/PHPExcel.php");
session_start();
 $nama_file_baru = 'data.xlsx';
	
				if(is_file('../../temp/'.$nama_file_baru)) 
					unlink('../../temp/'.$nama_file_baru); 

				$ext = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION); 
				$tmp_file = $_FILES['file']['tmp_name'];
				if($ext == "xlsx"){
					move_uploaded_file($tmp_file, '../../temp/'.$nama_file_baru);
     
	$excelreader = new PHPExcel_Reader_Excel2007();
	$loadexcel = $excelreader->load('../../temp/'.$nama_file_baru); 
	$sheet = $loadexcel->getActiveSheet()->toArray();
			
	
	 $nama_file_baru = 'data.xlsx';
        $sukses = $gagal = 0;
       
        for ($a = 4; $a < 14; $a++) {
            $kode = $sheet['0'][$a];
            
            for ($i = 1; $i < count($sheet); $i++) {
				

                $nis = $sheet[$i]['1'];
				$mapel = $sheet[$i]['3'];
				$kelas = $sheet[$i]['14'];
                $kode = $kode;
                $nilai = $sheet[$i][$a];
				
              
				
	
$query = "INSERT INTO nilai_ph(id,nis,mapel,nilai,ket,kelas) VALUES('','".$nis."','".$mapel."','".$nilai."','".$kode."','".$kelas."')";

		
			mysqli_query($koneksi, $query);
			
            }
        }
}

