<?php
require "../../config/config.default.php";
require "../../vendor/autoload.php";
require("../../config/config.function.php");
cek_session_admin();
$file_mimes = array('application/vnd.ms-excel', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
if (isset($_FILES['file']['name'])) {
    $ext = ['xls', 'xlsx'];
    $arr_file = explode('.', $_FILES['file']['name']);
    $extension = end($arr_file);
    if (in_array($extension, $ext)) {
        if ('xls' == $extension) {
            $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
        } else {
            $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
        }

        $spreadsheet = $reader->load($_FILES['file']['tmp_name']);

        $sheetData = $spreadsheet->getActiveSheet()->toArray();
        $sukses = $gagal = 0;
        $exec = mysqli_query($koneksi, "TRUNCATE siswa_rapor");
        for ($i = 1; $i < count($sheetData); $i++) {
                $id = $sheetData[$i]['0'];
                 $nama = $sheetData[$i]['1'];
                 $nama = addslashes($nama);
                $kelas = $sheetData[$i]['2'];
                $nis = $sheetData[$i]['3'];
				$nisn = $sheetData[$i]['4'];
                $tempat = $sheetData[$i]['5'];
                $tgl = $sheetData[$i]['6'];
                $jk = $sheetData[$i]['7'];
                $agama = $sheetData[$i]['8'];
                $alamat = $sheetData[$i]['9'];
                $password = $sheetData[$i]['10'];
				 $ayah = $sheetData[$i]['11'];
				  $ibu = $sheetData[$i]['12'];
				   $pek_ayah = $sheetData[$i]['13'];
				    $pek_ibu = $sheetData[$i]['14'];
					 $jalan = $sheetData[$i]['15'];
					  $desa = $sheetData[$i]['16'];
					   $kec = $sheetData[$i]['17'];
					    $kab = $sheetData[$i]['18'];
						 $prov = $sheetData[$i]['19'];
						 $asal_sek = $sheetData[$i]['20'];
				         $photo = $sheetData[$i]['21'];
			
			 if ($nama <> '') {
                $exec = mysqli_query($koneksi, "INSERT INTO siswa_rapor (nama,kelas,nis,nisn,tempat,tgl_lahir,jk,agama,alamat,password,ayah,ibu,pek_ayah,pek_ibu,jalan,desa,kec,kab,prov,photo,asal_sek) VALUES 
				('$nama','$kelas','$nis','$nisn','$tempat','$tgl','$jk','$agama','$alamat','$password','$ayah','$ibu','$pek_ayah','$pek_ibu','$jalan','$desa','$kec','$kab','$prov','$photo','$asal_sek')");
                ($exec) ? $sukses++ : $gagal++;
            }
        }
        echo "Berhasil: $sukses | Gagal: $gagal ";
    } else {
        echo "Pilih file yang bertipe xlsx or xls";
    }
}