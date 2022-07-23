<?php
require("../../config/config.default.php");
require("../../config/config.function.php");
require("../../config/functions.crud.php");
cek_session_guru();
$id = $_POST['id'];
$materi=$_POST['materi'];
$waktu=$_POST['waktu'];
$sisipan=$_POST['sisipan'];
$tgl=$_POST['tgl'];


    $data = [
        'tanggal' => $tgl,
        'materi' => $materi,
        'alokasi' => $waktu,
        'sisipan' => $sisipan
		 
    ];
    update($koneksi, 'rpp', $data, ['id_rpp' => $id]);
    
    echo "ok";

