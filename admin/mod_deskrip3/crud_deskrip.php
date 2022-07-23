<?php
require("../../config/config.database.php");
require("../../config/config.function.php");
require("../../config/functions.crud.php");
require "../../vendor/autoload.php";
session_start();
   
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Csv;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;

    $file_mimes = array('application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');

    if (isset($_FILES['file']['name']) && in_array($_FILES['file']['type'], $file_mimes)) {

        $arr_file = explode('.', $_FILES['file']['name']);
        $extension = end($arr_file);

        if ('csv' == $extension) {
            $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
        } else {
            $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
        }

        $spreadsheet = $reader->load($_FILES['file']['tmp_name']);

        $sheetData = $spreadsheet->getActiveSheet()->toArray();
        $sukses = $gagal = 0;
       
       
            for ($i = 1; $i < count($sheetData); $i++) {
				$kelas = $sheetData[$i]['1'];
                $mapel = $sheetData[$i]['2'];
				$kodek = $sheetData[$i]['3'];
				$deskrip = $sheetData[$i]['4'];
               
               $query = "INSERT INTO deskripsi_3(mapel,kelas,kodek,deskripsi) VALUES('".$mapel."','".$kelas."','".$kodek."','".$deskrip."')";
			mysqli_query($koneksi, $query);
            }
        }

