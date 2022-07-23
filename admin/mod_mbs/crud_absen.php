<?php
require("../../config/config.database.php");
require("../../config/config.function.php");
require("../../config/functions.crud.php");
session_start();

if ($pg == 'tambah') {
	$tanggale=date('Y-m-d');
	 $mapelmu = $_POST['mapelmu'];
	   $gurumu = $_POST['gurumu'];
	 $tgl_absen = $_POST['tgl'];
	  $mapel = $_POST['mapel'];
	   $guru = $_POST['guru'];
		$kelas = $_POST['kelas'];
		$siswa = $_POST['siswa'];
		$ket = $_POST['ket'];
	    $smt = $_POST['smt'];
		$tp = $_POST['tp'];
		$bln= $_POST['bln'];
$cekdata = "SELECT * FROM absen_mapel WHERE tgl_absen='$tanggale' AND mapel='$mapelmu' AND guru='$gurumu' ";
$jikaada = mysqli_query($koneksi,$cekdata);
if(mysqli_num_rows($jikaada)>0){
	
}else{
$query = "INSERT INTO absen_mapel VALUES";
$index = 0; 
foreach($siswa as $datasiswa){
	$query .= "('','".$datasiswa."','".$tgl_absen[$index]."','".$mapel[$index]."','".$kelas[$index]."','".$guru[$index]."','".$ket[$index]."','".$smt[$index]."','".$tp[$index]."','".$bln[$index]."'),";
	$index++;
}
$query = substr($query, 0, strlen($query) - 1).";";
mysqli_query($koneksi, $query);

}
}
