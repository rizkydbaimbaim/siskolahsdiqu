<?php
require("../../config/config.default.php");
require("../../config/config.function.php");
require("../../config/functions.crud.php");
cek_session_admin();
(isset($_GET['pg'])) ? $pg = $_GET['pg'] : $pg = '';
if ($pg == 'ubah') {
    $id = $_POST['idu'];
    $data = [
       
        'nama'         => str_replace("'", "&#39;", $_POST['nama']),
        'visi'         => $_POST['visi'],
        'misi'     => $_POST['misi']
     
    ];

    
        $exec = update($koneksi, 'kandidat', $data, ['id' => $id]);
        echo $exec;
    
}

if ($pg == 'hapus') {
    $id = $_POST['id'];
    delete($koneksi, 'kandidat', ['id' => $id]);
}
