<?php
require("../../config/config.default.php");
require("../../config/config.function.php");
require("../../config/functions.crud.php");
cek_session_admin();
(isset($_GET['pg'])) ? $pg = $_GET['pg'] : $pg = '';
if ($pg == 'editjadwal') {
    $id = $_POST['id'];
	
	$data=[
	'hari' => $_POST['hari'],
	'jam_ke' => $_POST['ke'],
	'dari' => $_POST['dari'],
	'sampai' => $_POST['sampai']
	];
    update($koneksi, 'mapel_rapor',$data, ['id' => $id]);
}
