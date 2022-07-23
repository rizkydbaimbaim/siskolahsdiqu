<?php
require("../../config/config.default.php");
require("../../config/config.function.php");
require("../../config/functions.crud.php");
cek_session_guru();
(isset($_GET['pg'])) ? $pg = $_GET['pg'] : $pg = '';
error_reporting(0);

if ($pg == 'absen') {
   
        $data = [
            'sakit'     => $_POST['sakit'],
             'izin'     => $_POST['izin'],
			  'alpha'     => $_POST['alpha']
        ];
    
    $id = $_POST['idd'];
    $exec = update($koneksi, 'siswa', $data, ['id_siswa' => $id]);
    echo $exec;
}
if ($pg == 'tambahprestasi') {
   $nis=$_POST['nis'];
           $data = [
            'nis'     => $_POST['nis'],
             'pres'     => $_POST['pres'],
			  'ket'     => $_POST['ket']
        ];
  $cekdata = "SELECT * FROM prestasi WHERE nis='$nis'";
$jikaada = mysqli_query($koneksi,$cekdata);
if(mysqli_num_rows($jikaada)==0){

    $exec = insert($koneksi, 'prestasi', $data);
    echo $exec;
}else{
	$exec = update($koneksi, 'prestasi', $data,['nis'=>$nis]);
    echo $exec;
}
}
if ($pg == 'hapusprestasi') {
    $id = $_POST['id'];
    delete($koneksi, 'prestasi', ['id' => $id]);
}
if ($pg == 'catat') {
   
        $data = [
            'catatan'     => $_POST['catat']
          
        ];
    
    $id = $_POST['idd'];
    $exec = update($koneksi, 'siswa', $data, ['id_siswa' => $id]);
    echo $exec;
}
if ($pg == 'tambaheskul') {
   
        $data = [
            'nis'     => $_POST['nis'],
             'ekstra'     => $_POST['ekstra'],
			  'nilai'     => $_POST['nilai'],
			   'ket'     => $_POST['ket']
        ];
    
    $exec = insert($koneksi, 'eskul', $data);
    echo $exec;
}
if ($pg == 'hapuseskul') {
    $id = $_POST['id'];
    delete($koneksi, 'eskul', ['id' => $id]);
}