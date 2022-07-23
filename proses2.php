<?php
require "config/config.default.php";
require "config/config.function.php";
require "config/functions.crud.php";
$setting = fetch($koneksi, 'setting', ['id_setting' => 1]);
$id_siswa = $_POST['id_siswa'];
$id_mapel = $_POST['id_mapel'];
$id_ujian = $_POST['id_ujian'];
$id_soal = $_POST['id_soal'];
$jenis = '5';
$urut1 = $_POST['urut1'];
$urut2 = $_POST['urut2'];
$urut3 = $_POST['urut3'];
$urut4 = $_POST['urut4'];
$urut5 = $_POST['urut5'];
  if($setting['jenjang']==SMA OR $setting['jenjang']==SMK){
$jawab = $urut1.', '.$urut2.', '.$urut3.', '.$urut4.', '.$urut5;
  }else{
$jawab = $urut1.', '.$urut2.', '.$urut3.', '.$urut4;
  }
$cekdata = "SELECT * FROM jawaban WHERE id_siswa='$id_siswa' AND id_ujian='$id_ujian' AND id_soal='$id_soal' AND jenis='$jenis'";
$jikaada = mysqli_query($koneksi,$cekdata);
if(mysqli_num_rows($jikaada)>0){
	if($setting['jenjang']==SMA OR $setting['jenjang']==SMK){
$exec = mysqli_query($koneksi, "UPDATE jawaban SET jawaburut='$jawab',urut1='$urut1',urut2='$urut2',urut3='$urut3',urut4='$urut4',urut5='$urut5' WHERE id_siswa='$id_siswa' AND id_ujian='$id_ujian' AND id_soal='$id_soal' AND jenis='$jenis'");
		}else{
			$exec = mysqli_query($koneksi, "UPDATE jawaban SET jawaburut='$jawab',urut1='$urut1',urut2='$urut2',urut3='$urut3',urut4='$urut4' WHERE id_siswa='$id_siswa' AND id_ujian='$id_ujian' AND id_soal='$id_soal' AND jenis='$jenis'");
		}
	echo "
	
	  <script type='text/javascript'>
			window.location.replace('testongoing/bFZRbFp2Wnd2QWVNek1LVDN2alVyQT09/TDBCaUdRZ1luaXBRWkdsTElRVUxkUT09');
	  </script>";
	
	}else{
 if($setting['jenjang']==SMA OR $setting['jenjang']==SMK){
$exec = mysqli_query($koneksi, "INSERT INTO jawaban (id_siswa,id_mapel,id_soal,id_ujian,jawaburut,jenis,urut1,urut2,urut3,urut4,urut5) VALUES ('$id_siswa','$id_mapel','$id_soal','$id_ujian','$jawab','$jenis','$urut1','$urut2','$urut3','$urut4','$urut5')");
 }else{
	$exec = mysqli_query($koneksi, "INSERT INTO jawaban (id_siswa,id_mapel,id_soal,id_ujian,jawaburut,jenis,urut1,urut2,urut3,urut4) VALUES ('$id_siswa','$id_mapel','$id_soal','$id_ujian','$jawab','$jenis','$urut1','$urut2','$urut3','$urut4')"); 
 }
echo "
	
	  <script type='text/javascript'>
			window.location.replace('testongoing/bFZRbFp2Wnd2QWVNek1LVDN2alVyQT09/Y1VMRDdLRUFnNGdwa3BkQ2N1dFdwdz09');
	  </script>";
	}
	

?>