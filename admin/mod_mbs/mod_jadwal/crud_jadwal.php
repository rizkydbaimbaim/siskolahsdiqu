<?php
require("../../../config/config.default.php");
require("../../../config/config.function.php");
require("../../../config/functions.crud.php");
cek_session_admin();
(isset($_GET['pg'])) ? $pg = $_GET['pg'] : $pg = '';
if ($pg == 'hapus_jadwal') {
    $id = $_POST['id'];
    delete($koneksi, 'jadwal_mapel', ['id_jadwal' => $id]);
}
if ($pg == 'editjadwal') {
    $kelas = $_POST['kelas'];
				$kode = $_POST['kode'];
                $mapel = $_POST['mapel'];
				$ke = $_POST['ke'];
                $hari = $_POST['hari'];
                $dari = $_POST['dari'];
                $sampai = $_POST['sampai'];
				$guru = $_POST['guru'];
$data = [
'kelas' => $kelas,
'kode' => $kode,
'mapel' => $mapel,
'ke' => $ke,
'hari' => $hari,
'dari' => $dari,
'sampai' => $sampai,
'guru' => $guru
];

   $idj = $_POST['idj'];
    update($koneksi, 'jadwal_mapel',$data,['id_jadwal' => $idj]);
}
