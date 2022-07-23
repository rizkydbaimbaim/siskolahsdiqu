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
    delete($koneksi, 'jurnal', ['id' => $id]);
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
		 $materi = addslashes($_POST['materi']);
         $hambat = addslashes($_POST['hambat']);
		  $pecah = addslashes($_POST['pecah']);
		  
	  $exec = mysqli_query($koneksi, "INSERT INTO jurnal (guru,mapel,kelas,harix,tanggal,ke,materi,hambatan,pemecahan,smt,tp) 
	  VALUES ('$guru','$mapel','$kelas','$harix','$tanggal','$ke','$materi','$hambat','$pecah','$smt','$tp')");
    echo $exec;
}




