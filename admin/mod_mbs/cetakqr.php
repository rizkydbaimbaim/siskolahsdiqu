<?php ob_start();
error_reporting(0);
require("../../config/config.database.php");
require("../../config/config.function.php");
require("../../config/functions.crud.php");

session_start();
if (!isset($_SESSION['id_pengawas'])) {
    die('Anda tidak diijinkan mengakses langsung');
}
$kode = $_GET['kode'];
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>

    <title>QR Code</title>

   <link rel="stylesheet" href="../../plugins/bootstrap/dist/css/bootstrap.min.css">


</head>

<body style="font-size: 12px;">

    <center><h3> QR CODE ABSENSI GURU</h3> </center>
	<center><b> Ditempel di Tembok untuk di Scan oleh Guru dengan HP saat Absen Masuk dan Pulang</b> </center>
	<br><br>
    <center><img src="../../temp/<?= $kode ?>.png" ></center>
   
</body>
</html>
<?php

$html = ob_get_clean();
require_once '../../vendors/autoload.php';

use Dompdf\Dompdf;

$dompdf = new Dompdf();
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'potrait');
$dompdf->render();
$dompdf->stream("agenda.pdf", array("Attachment" => false));

exit(0);
?>