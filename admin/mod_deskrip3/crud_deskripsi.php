<?php
require("../../config/config.default.php");
require("../../config/config.function.php");
require("../../config/functions.crud.php");
cek_session_guru();
(isset($_GET['pg'])) ? $pg = $_GET['pg'] : $pg = '';
if ($pg == 'ubah') {
    $wkt = explode(" ",  $_POST['tgl_ujian']);
    $wkt_ujian = $wkt[1];
    $id = $_POST['idm'];
    $acak = (isset($_POST['acak'])) ? 1 : 0;
    $token = (isset($_POST['token'])) ? 1 : 0;
    $hasil = (isset($_POST['hasil'])) ? 1 : 0;
    $acakopsi = (isset($_POST['acakopsi'])) ? 1 : 0;
    $reset = (isset($_POST['reset'])) ? 1 : 0;
    $data = [
        'lama_ujian'         => $_POST['lama_ujian'],
        'tgl_ujian'        => $_POST['tgl_ujian'],
        'tgl_selesai'        => $_POST['tgl_selesai'],
        'waktu_ujian' => $wkt_ujian,
        'sesi'       => $_POST['sesi'],
        'acak'        => $acak,
        'token'        => $token,
        'hasil'        => $hasil,
        'ulang'        => $acakopsi,
        'reset'        => $reset
    ];
    $exec = update($koneksi, 'ujian', $data, ['id_ujian' => $id]);
    echo mysqli_error($koneksi);
}
if ($pg == 'hapus') {
    $id = $_POST['id'];
    delete($koneksi, 'deskripsi_3', ['id' => $id]);
}
if ($pg == 'ubah') {
     $data = [
            'deskripsi'     => $_POST['deskripsi']
            
        ];
    
    $id = $_POST['id'];
    $exec = update($koneksi, 'deskripsi_3', $data, ['id' => $id]);
    echo $exec;
}
if ($pg == 'token') {
    function create_random($length)
    {
        $data = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $string = '';
        for ($i = 0; $i < $length; $i++) {
            $pos = rand(0, strlen($data) - 1);
            $string .= $data[$pos];
        }
        return $string;
    }
    $token = create_random(6);
    $now = date('Y-m-d H:i:s');
    echo $token;
    $cek = rowcount($koneksi, 'token');
    if ($cek <> 0) {
        $query = fetch($koneksi, 'token');
        $time = $query['time'];
        $tgl = buat_tanggal('H:i:s', $time);
        $exec = update($koneksi, 'token', ['token' => $token, 'time' => $now], ['id_token' => 1]);
    } else {
        $exec = insert($koneksi, 'token', ['token' => $token, 'masa_berlaku' => '00:15:00']);
    }
}
