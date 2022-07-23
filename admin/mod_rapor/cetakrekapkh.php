<?php ob_start();
error_reporting(0);
require("../../config/config.database.php");
require("../../config/config.function.php");
require("../../config/functions.crud.php");

session_start();
if (!isset($_SESSION['id_pengawas'])) {
    die('Anda tidak diijinkan mengakses langsung');
}
$idmap = $_GET['mapel'];
$guru = $_GET['guru'];
$kelas = fetch($koneksi, 'kode', ['id' => $idmap]);
$mapel=$kelas['mapel'];
$bl = date('m');
$bulane = fetch ($koneksi, 'bulan', ['bln' =>$bl]);
$rapor=fetch($koneksi,'setting_rapor',['id' => 1]);
$user=fetch($koneksi,'pengawas',['id_pengawas' =>$guru]);
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>

    <title>KI-4_<?= $mapel ?>_<?= $kelas['kelas'] ?></title>
<link rel="stylesheet" href="../../plugins/bootstrap/dist/css/bootstrap.min.css">

</head>

<body style="font-size: 12px;">

   <center><h3><?= $setting['sekolah'] ?></h3></center>
	 <center> Alamat : <?= $setting['alamat']; ?> Kec. <?= $setting['kecamatan']; ?> Kab. <?= $setting['kota']; ?></center>
	  <hr>
    <img src="../../<?= $setting['logo'] ?>" style="margin-left:20px ;margin-top:-75px ;width: 80px;">
    
   <center><h5>REKAPITULASI NILAI PENGETAHUAN (KI-3)</h5></center>
   <br>
   <div style="padding-left:20px;margin-right:50px ;" class="col-md-12">
    <table>
	<tbody>
            <tr>
                <td width='100px'>Mata Pelajaran</td>
                <td width='10px'>:</td>
                <td><?= $kelas['mapel'] ?></td>
            </tr>
			
                <tr>
                <td width='100px'>Kelas</td>
                <td width='10px'>:</td>
                <td><?= $kelas['kelas'] ?></td>
				</tr>
				
				<tr>
                <td width='100px'>Semester</td>
                <td width='10px'>:</td>
                <td><?= $rapor['semester'] ?></td>
            </tr>
			
			<tr>
                <td width='100px'>Tahun Pelajaran</td>
                <td width='10px'>:</td>
                <td><?= $rapor['tp'] ?></td>
            </tr>
			</tbody>
    </table>
	</div>
     <br>
    <table style="margin-left: 20px;margin-right:5px" class="table table-sm table-bordered">
	
	 <thead>
      <tr>
	<th width='2%' style="text-align: center;">No</th>
	<th style="text-align: center;">Nama Siswa</th>
	 <?php
			$querys = mysqli_query($koneksi,"select * from kode WHERE ket='2' AND mapel='$mapel'");
              while ($kd = mysqli_fetch_array($querys)) {
			?>
			<th width='5%' style="text-align: center;"><?= $kd['kd'] ?></th>
			  <?php } ?>
			  <th width='5%' style="text-align: center;">NR</th>
	</tr>
	 </thead>
	  <?php
	       $no=0;
			$query = mysqli_query($koneksi,"select * from siswa_rapor WHERE kelas='$kelas[kelas]'");
              while ($siswa = mysqli_fetch_array($query)) {
				 
				  $no++;
			?>
     <tbody>
	
	         <tr>
	        <td><?= $no ?></td>
			<td><?= $siswa['nama'] ?></td>
	        <?php
			$queryxx = mysqli_query($koneksi,"select AVG(nilai) AS nkd from nilai_harian 
			JOIN kode ON kode.id=nilai_harian.idkode
			WHERE idsiswa='$siswa[id]' AND kode.ket='2' AND mapel='$mapel' GROUP  BY idkode");
              while ($nilai = mysqli_fetch_array($queryxx)) {
		 
			?>
	
     	<td style="text-align: center;"><?= round($nilai['nkd']) ?></td>
			 <?php } ?>
			  <?php
			$queryxr = mysqli_query($koneksi,"select AVG(nilai) AS rata from nilai_harian 
			JOIN kode ON kode.id=nilai_harian.idkode
			WHERE idsiswa='$siswa[id]' AND kode.ket='2' AND mapel='$mapel'");
              while ($rata = mysqli_fetch_array($queryxr)) {
		 
			?>
			 <td style="text-align: center;"><?= round($rata['rata']) ?></td>
			  <?php }  } ?>
	 </tr>
	  
	 </tbody>
	</table>
	
	<table style="margin-left: 850px;margin-right:5px">
	<tr style="text-align: center;">
	<td><?= $setting['kota'] ?>, <?php echo date('d-m-Y'); ?></td>
	</tr>
	<tr style="text-align: center;">
	<td>Guru Mapel</td>
	</tr>
	</table>
	<br><br><br>
	<table style="margin-left: 872px;margin-right:5px">
	<tr >
	<td style="text-align: center;"><b><?= $user['nama'] ?></b></td>
	</tr>
	</table>
</body>
</html>
<?php

$html = ob_get_clean();
require_once '../../vendors/autoload.php';

use Dompdf\Dompdf;

$dompdf = new Dompdf();
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'landscape');
$dompdf->render();
$dompdf->stream("nilai.pdf", array("Attachment" => false));

exit(0);
?>