<?php
require("../../config/config.default.php");
require("../../config/config.function.php");
require("../../config/functions.crud.php");
cek_session_guru();
(isset($_GET['pg'])) ? $pg = $_GET['pg'] : $pg = '';
$pengawas = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM pengawas  WHERE id_pengawas='$_SESSION[id_pengawas]'"));
$id_pengawas = $pengawas['id_pengawas'];
$rapor = fetch($koneksi, 'setting_rapor', ['id' => 1]);

if ($pg == 'hapus') {
    $id = $_POST['id'];
    delete($koneksi, 'agenda', ['id' => $id]);
}

if ($pg == 'tambah') {
	    $smt=$rapor['semester'];
		 $tp=$rapor['tp'];
        $guru = $_POST['guru'];
        $mapel = $_POST['mapel'];
        $kelas = $_POST['kelas'];
	    $tanggal = $_POST['tgl'];
		$harix = date('D',strtotime($tanggal));
        $ke = $_POST['ke'];
         $kd = $_POST['kd'];
		 $materi = addslashes($_POST['materi']);
         $indikator = addslashes($_POST['indikator']);
		  
		  
	  $exec = mysqli_query($koneksi, "INSERT INTO agenda (guru,mapel,kelas,harix,tanggal,ke,kikd,materi,indikator,smt,tp) 
	  VALUES ('$guru','$mapel','$kelas','$harix','$tanggal','$ke','$kd','$materi','$indikator','$smt','$tp')");
    echo $exec;
}
