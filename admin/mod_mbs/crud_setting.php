<?php
require("../../config/config.default.php");
require("../../config/config.function.php");
require("../../config/functions.crud.php");
cek_session_admin();
(isset($_GET['pg'])) ? $pg = $_GET['pg'] : $pg = '';

if ($pg == 'setting_clear') {
    $pengawas = fetch($koneksi, 'pengawas', ['id_pengawas' => $_SESSION['id_pengawas']]);
    $password = $_POST['password'];
    if (!password_verify($password, $pengawas['password'])) {
        echo "password salah";
    } else {
        if (!empty($_POST['data'])) {
            $data = $_POST['data'];
            if ($data <> '') {
                foreach ($data as $table) {
                    if ($table <> 'pengawas') {
                        mysqli_query($koneksi, "TRUNCATE $table");
                    } else {
                        mysqli_query($koneksi, "DELETE FROM $table WHERE level!='admin'");
                    }
                }
                echo "ok";
            }
        }
    }
}

if ($pg == 'setting_menu') {
     $datax = [
        'absen' => $_POST['absen'],
        'jadwal' => $_POST['jadwal']
		];
    $exec = update($koneksi, 'setting', $datax, ['id_setting' => 1]);
}
if ($pg == 'setting_nilai') {
     $datax = [
        'absendaring' => $_POST['nilai'],
        'undian' => $_POST['undian']
		];
    $exec = update($koneksi, 'setting', $datax, ['id_setting' => 1]);
}