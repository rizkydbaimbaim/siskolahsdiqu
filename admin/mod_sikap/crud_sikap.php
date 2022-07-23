<?php
require("../../config/config.default.php");
require("../../config/config.function.php");
require("../../config/functions.crud.php");
cek_session_guru();
(isset($_GET['pg'])) ? $pg = $_GET['pg'] : $pg = '';

if ($pg == 'hapussos') {
    $id = $_POST['id'];
    delete($koneksi, 'sosial', ['ids' => $id]);
}
if ($pg == 'hapusspi') {
    $id = $_POST['id'];
    delete($koneksi, 'spiritual', ['ids' => $id]);
}
