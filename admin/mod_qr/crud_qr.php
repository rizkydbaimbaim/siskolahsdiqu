<?php
require("../../config/config.default.php");
require("../../config/config.function.php");
require("../../config/functions.crud.php");
require("../phpqrcode/qrlib.php");
cek_session_admin();
(isset($_GET['pg'])) ? $pg = $_GET['pg'] : $pg = '';

if ($pg == 'ubah') {
	$kodex=1;
    
 
		
		$data = [
        'qrkode'        => $_POST['kode']
		
    ];
    update($koneksi, 'setting', $data, ['id_setting' => 1]);
	$tempdir = "../../temp/"; 
if (!file_exists($tempdir)) 
	
    mkdir($tempdir);
  
$codeContents = $_POST['kode'];
QRcode::png($codeContents, $tempdir . $_POST['kode'] . '.png', QR_ECLEVEL_M, 8);
}
