<?php ob_start();
error_reporting(0);
require("../../../config/config.database.php");
require("../../../config/config.function.php");
require("../../../config/functions.crud.php");

session_start();
if (!isset($_SESSION['id_pengawas'])) {
    die('Anda tidak diijinkan mengakses langsung');
}

$idmateri = $_GET['id'];
$materi=fetch($koneksi,'materi',['id_materi' => $idmateri]);
$user=fetch($koneksi,'pengawas',['id_pengawas' =>$_SESSION['id_pengawas']]);
$rapor=fetch($koneksi,'setting_rapor',['id' => 1]);
$bl = date('m');
$bulane = fetch ($koneksi, 'bulan', ['bln' =>$bl]);
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>

    <title>Nilai_Quiz_<?= $materi['mapel'] ?></title>

   <link rel="stylesheet" href="../../../plugins/bootstrap/dist/css/bootstrap.min.css">


</head>

<body style="font-size: 12px;">

  <center><h3><?= strtoupper($setting['sekolah']) ?></h3></center>
	<center> Alamat : <?= $setting['alamat']; ?> Kec. <?= $setting['kecamatan']; ?> Kab. <?= $setting['kota']; ?></center>
	  <hr>
    <img src="../../../<?= $setting['logo'] ?>" style="margin-left:20px ;margin-top:-75px ;width: 80px;">
    
   <center><h5>NILAI QUIZ</h5></center>
   <br>
   <div style="padding-left:20px;margin-right:50px ;" class="col-md-12">
    <table>
	<tbody>
            <tr>
                <td width='100px'>Mata Pelajaran</td>
                <td width='10px'>:</td>
                <td><?= $materi['mapel'] ?></td>
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
	<th width='5%' style="text-align: center;">Kelas</th>
	<th style="text-align: center;">Nama</th>
	<th  width='5%'  style="text-align: center;">Nilai</th>
	
	</tr>
	 </thead>
	 <?php
	  $query = mysqli_query($koneksi, "select * from nilaiquiz WHERE idmateri='$idmateri'");
      $no = 0;
       while ($nilai = mysqli_fetch_array($query)) {
	   $siswa=fetch($koneksi,'siswa',['id_siswa'=>$nilai['idsiswa']]);
       $no++;
	   
	   
	 ?>
     <tbody>
	 <tr>
	 <td style="text-align: center;"><?= $no ?></td>
	 <td style="text-align: center;"><?= $siswa['id_kelas'] ?></td>
	 <td><?= $siswa['nama'] ?></td>
	 <td><?= $nilai['nilai'] ?></td>
	 
	 </tr>
	   <?php } ?>
	 </tbody>
	</table>
	<br/>
	<table border='0' style="width:550;margin-left: 50px;">
					<tr>
					
						<td>
							Mengetahui, <br/>
							Kepala Sekolah <br/>
							<br/>
							<br/>
							<br/>
							
							<u><?= $setting['kepsek'] ?></u><br/>
							NIP. <?= $setting['nip'] ?>
						</td>
						<td width='250px'></td>
						<td>
							<?= $setting['kecamatan'] ?>, <?php echo date('d'); ?> <?= $bulane['ket'] ?> <?= date('Y') ?><br/>
							Guru Mata Pelajaran<br/>
							<br/>
							<br/>
							<br/>
							
							<u><?= $user['nama'] ?></u><br/>
							NIP. <?= $user['nip'] ?>
						</td>
					</tr>
				</table>
</body>

</html>
<?php

$html = ob_get_clean();
require_once '../../../vendors/autoload.php';

use Dompdf\Dompdf;

$dompdf = new Dompdf();
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'potrait');
$dompdf->render();
$dompdf->stream("jurnal.pdf", array("Attachment" => false));

exit(0);
?>