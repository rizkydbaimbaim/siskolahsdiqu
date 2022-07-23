<?php
require "config/config.default.php";
require "config/config.function.php";
require "config/functions.crud.php";
$setting = fetch($koneksi, 'setting', ['id_setting' => 1]);
$id_siswa = $_POST['id_siswa'];
$id_mapel = $_POST['id_mapel'];
$id_ujian = $_POST['id_ujian'];
$id_soal = $_POST['id_soal'];
$jenis = '3';
$jawab = implode($_POST['jawab'], ', ');
$cekdata = "SELECT * FROM jawaban WHERE id_siswa='$id_siswa' AND id_ujian='$id_ujian' AND id_soal='$id_soal' AND jenis='$jenis'";
$jikaada = mysqli_query($koneksi,$cekdata);
if(mysqli_num_rows($jikaada)>0){
	$exec = mysqli_query($koneksi, "UPDATE jawaban SET jawabmulti='$jawab' WHERE id_siswa='$id_siswa' AND id_ujian='$id_ujian' AND id_soal='$id_soal' AND jenis='$jenis'");

	echo "
	
	  <script type='text/javascript'>
			window.location.replace('testongoing/bFZRbFp2Wnd2QWVNek1LVDN2alVyQT09/TDBCaUdRZ1luaXBRWkdsTElRVUxkUT09');
	  </script>";
	
	}else{
$exec = mysqli_query($koneksi, "INSERT INTO jawaban (id_siswa,id_mapel,id_soal,id_ujian,jawabmulti,jenis) VALUES ('$id_siswa','$id_mapel','$id_soal','$id_ujian','$jawab','$jenis')");

echo "
	
	  <script type='text/javascript'>
			window.location.replace('testongoing/bFZRbFp2Wnd2QWVNek1LVDN2alVyQT09/Y1VMRDdLRUFnNGdwa3BkQ2N1dFdwdz09');
	  </script>";
	}
	

?>