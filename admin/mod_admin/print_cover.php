<?php ob_start();
error_reporting(0);
require("../../config/config.database.php");
require("../../config/config.function.php");
require("../../config/functions.crud.php");

session_start();
if (!isset($_SESSION['id_pengawas'])) {
    die('Anda tidak diijinkan mengakses langsung');
}
$ids=$_GET['nis'];
$tp=date('Y');
$tpk=$tp-1;
$seting = fetch($koneksi, 'setting', ['id_setting' => 1]);
$siswa = fetch($koneksi, 'siswa_rapor', ['nis' => $ids]);

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>

    <title>Cover_Rapor_<?= $siswa['nama'] ?></title>

  <link rel="stylesheet" href="../../plugins/bootstrap/dist/css/bootstrap.min.css">



</head>

<body style="font-size: 12px;">
    <br><br><br><br>
   <center>
        <h6>LAPORAN</h6>
		<h6>HASIL CAPAIAN KOMPETENSI PESERTA DIDIK</h6>
		<h6><?php echo strtoupper($seting['jenjang']); ?></h6>
    </center>
    <br>
    <br>
        
    <div class="col-md-12">
	
               <center><img src="../../dist/img/tutwuri.png" width="30%"></center>
         
        <br><br><br>
 <center>Nama Peserta Didik</center>
    <br>
            <table style="margin-left: 70px;margin-right:50px;" border ="1" width="100%">
                    <tr style="text-align: center;font-size: 18px;">
                        <td><b><?php echo ucfirst($siswa['nama']); ?></b></td>
                    </tr>
					</table>
					<br><br><br>
 <center>No. Induk / NISN</center>
    <br>
	<table style="margin-left: 70px;margin-right:50px;" border ="1" width="100%">
                    <tr style="text-align: center;font-size: 14px;">
                        <td><?php echo $siswa['nis']; ?> / <?php echo $siswa['nisn']; ?></td>
                    </tr>
					</table>
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
   <center>
        <h6>KEMENTRIAN PENDIDIKAN DAN KEBUDAYAAN</h6>
		<h6>REPUBLIK INDONESIA</h6>
		
    </center>
    <br>
					
					
                </body>
</html>
<?php

$html = ob_get_clean();
require_once '../../vendors/autoload.php';

use Dompdf\Dompdf;

$dompdf = new Dompdf();
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();
$dompdf->stream("Raport_" . $siswa['nama'] . ".pdf", array("Attachment" => false));
exit(0);
?>