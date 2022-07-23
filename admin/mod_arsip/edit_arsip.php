<?php
require("../../config/config.default.php");
require("../../config/config.function.php");
require("../../config/functions.crud.php");
cek_session_guru();
$id = $_POST['id'];
$tindakan = $_POST['tindakan'];
$keluar = $_POST['keluar'];

            $data = [
                'keluar' => $keluar,
                'tindakan' => $tindakan
            ];
            update($koneksi, 'arsip', $data, ['id_arsip' => $id]);
          

?>