<?php
require "config/config.default.php";
require "config/config.function.php";
require "config/functions.crud.php";
$setting = fetch($koneksi, 'setting', ['id_setting' => 1]);
$iduser = $_POST['ids'];
$kode = $_POST['kode'];
$idsoal = $_POST['idsoal'];
$materi = $_POST['idm'];
$jawab = $_POST['jawab'];
if($kode=='1'){

$cekdata = "SELECT * FROM jawaban_quiz WHERE iduser='$iduser' AND idsoal='$idsoal' AND materi='$materi' AND jenis='$kode'";
$jikaada = mysqli_query($koneksi,$cekdata);
if(mysqli_num_rows($jikaada)>0){
	$exec = mysqli_query($koneksi, "UPDATE jawaban_quiz SET jawaban='$jawab' WHERE iduser='$iduser' AND idsoal='$idsoal' AND materi='$materi' AND jenis='$kode'");

	
	
	}else{
$exec = mysqli_query($koneksi, "INSERT INTO jawaban_quiz (iduser,materi,jenis,idsoal,jawaban) VALUES ('$iduser','$materi','$kode','$idsoal','$jawab')");

	}
	
}
if($kode=='2'){	
$jawaban=implode(', ',$_POST['jawab']);
	$cekdata = "SELECT * FROM jawaban_quiz WHERE iduser='$iduser' AND idsoal='$idsoal' AND materi='$materi' AND jenis='$kode'";
$jikaada = mysqli_query($koneksi,$cekdata);
if(mysqli_num_rows($jikaada)>0){
	$exec = mysqli_query($koneksi, "UPDATE jawaban_quiz SET jawaban='$jawaban' WHERE iduser='$iduser' AND idsoal='$idsoal' AND materi='$materi' AND jenis='$kode'");

	
	
	}else{
$exec = mysqli_query($koneksi, "INSERT INTO jawaban_quiz (iduser,materi,jenis,idsoal,jawaban) VALUES ('$iduser','$materi','$kode','$idsoal','$jawaban')");

	}
}
if($kode=='3'){

$cekdata = "SELECT * FROM jawaban_quiz WHERE iduser='$iduser' AND idsoal='$idsoal' AND materi='$materi' AND jenis='$kode'";
$jikaada = mysqli_query($koneksi,$cekdata);
if(mysqli_num_rows($jikaada)>0){
	$exec = mysqli_query($koneksi, "UPDATE jawaban_quiz SET jawaban='$jawab' WHERE iduser='$iduser' AND idsoal='$idsoal' AND materi='$materi' AND jenis='$kode'");

	echo "
	
	  <script type='text/javascript'>
			window.location.replace('?pg=soalquiz&tes=');
	  </script>";
	
	}else{
$exec = mysqli_query($koneksi, "INSERT INTO jawaban_quiz (iduser,materi,jenis,idsoal,jawaban) VALUES ('$iduser','$materi','$kode','$idsoal','$jawab')");

	}
	
}
if($kode=='4'){
 $jawabane = $_POST['jawabana'].', '.$_POST['jawabanb'].', '.$_POST['jawabanc'].', '.$_POST['jawaband'].', '.$_POST['jawabane'];
$cekdata = "SELECT * FROM jawaban_quiz WHERE iduser='$iduser' AND idsoal='$idsoal' AND materi='$materi' AND jenis='$kode'";
$jikaada = mysqli_query($koneksi,$cekdata);
if(mysqli_num_rows($jikaada)>0){
	$exec = mysqli_query($koneksi, "UPDATE jawaban_quiz SET jawaban='$jawabane' WHERE iduser='$iduser' AND idsoal='$idsoal' AND materi='$materi' AND jenis='$kode'");

	echo "
	
	  <script type='text/javascript'>
			window.location.replace('?pg=soalquiz&tes=');
	  </script>";
	
	}else{
$exec = mysqli_query($koneksi, "INSERT INTO jawaban_quiz (iduser,materi,jenis,idsoal,jawaban) VALUES ('$iduser','$materi','$kode','$idsoal','$jawabane')");

	}
	
}
?>