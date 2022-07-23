<?php ob_start();
error_reporting(0);
require("../../config/config.database.php");
require("../../config/config.function.php");
require("../../config/functions.crud.php");

session_start();
if (!isset($_SESSION['id_pengawas'])) {
    die('Anda tidak diijinkan mengakses langsung');
}
$id = $_GET['idmap'];
$kelas = $_GET['kelas'];
$kode = fetch($koneksi, 'jadwal_mapel', ['id_jadwal' => $id]);
$mapel=$kode['mapel'];
$kodemap=$kode['kode'];
$bl = date('m');
$bulane = fetch ($koneksi, 'bulan', ['bln' =>$bl]);
$rapor=fetch($koneksi,'setting_rapor',['id' => 1]);

$user=fetch($koneksi,'pengawas',['id_pengawas' =>$kode['guru']]);
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>

    <title>Nilai_KI-4_<?= $mapel ?>_Kelas_<?= $kelas ?></title>
<link rel="stylesheet" href="../../plugins/bootstrap/dist/css/bootstrap.min.css">

</head>

<body style="font-size: 12px;">

   <center><h3><?= strtoupper($setting['sekolah']) ?></h3></center>
	 <center> Alamat : <?= $setting['alamat']; ?> Kec. <?= $setting['kecamatan']; ?> Kab. <?= $setting['kota']; ?></center>
	  <hr>
    <img src="../../<?= $setting['logo'] ?>" style="margin-left:20px ;margin-top:-75px ;width: 80px;">
    
   <center><h5>NILAI KETERAMPILAN (KI-4)</h5></center>
   <center><h6>SEMESTER <?= $rapor['semester'] ?> TAHUN PELAJARAN <?= $rapor['tp'] ?></h6></center>
   <br>
   <div style="padding-left:20px;margin-right:50px ;" class="col-md-12">
    <table>
	<tbody>
            <tr>
                <td width='100px'>Mata Pelajaran</td>
                <td width='10px'>:</td>
                <td><?= $mapel ?></td>
            </tr>
			 <tr>
                <td width='100px'>KKM</td>
                <td width='10px'>:</td>
                <td><?= $kode['kkm'] ?></td>
            </tr>
                <tr>
                <td width='100px'>Kelas</td>
                <td width='10px'>:</td>
                <td><?= $kelas ?></td>
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
			$querys = mysqli_query($koneksi,"select * from nilai_kh WHERE kelas='$kelas' AND mapel='$kodemap' AND nilai >0 GROUP BY ket ORDER BY id");
              while ($kd = mysqli_fetch_array($querys)) {
			?>
			<th width='5%' style="text-align: center;"><?= $kd['ket'] ?></th>
			  <?php } ?>
			 
			  <th width='5%' style="text-align: center;">NR</th>
			  <th width='5%' style="text-align: center;">PRED</th>
	</tr>
	 </thead>
	  <?php
	       $no=0;
			$query = mysqli_query($koneksi,"select * from siswa WHERE id_kelas='$kelas'");
              while ($siswa = mysqli_fetch_array($query)) {
				 
				  $no++;
			?>
     <tbody>
	
	         <tr>
	        <td><?= $no ?></td>
			<td><?= ucwords(strtolower($siswa['nama']))  ?></td>
	        <?php
			$queryxx = mysqli_query($koneksi,"select * from nilai_kh
			WHERE kelas='$kelas' AND mapel='$kodemap' AND nilai >0 AND nis='$siswa[nis]' GROUP BY ket ORDER BY id");
              while ($nilai = mysqli_fetch_array($queryxx)) {
		 
			?>
	
     	<td style="text-align: center;"><?= round($nilai['nilai']) ?></td>
			 <?php } ?>
			 
			  <?php
			$queryxr = mysqli_query($koneksi,"select AVG(nilai) AS rata from nilai_kh
			WHERE kelas='$kelas' AND mapel='$kodemap' AND nilai >0 AND nis='$siswa[nis]' ");
              while ($rata = mysqli_fetch_array($queryxr)) {
				$rerata=$rata['rata'];
		 $rentang=round(100-$kode['kkm'])/3;		
    $predD=round($kode['kkm']-1);
   $nilC1=round($kode['kkm']);
	$nilC2=round($rentang)+($kode['kkm']);				 
	$nilB1=round($nilC2+1);
	$nilB2=round($nilC2)+round($rentang);
	$nilA1=round($nilB2+1);
	$nilA2=round($nilB2)+round($rentang);
	if($rerata<=$predD){
{$predikat="D";}
}elseif($rerata>=$nilC1 && $rerata<=$nilC2){
{$predikat="C";}
}elseif($rerata>=$nilB1 && $rerata<=$nilB2){
{$predikat="B";}
}elseif($rerata>=$nilA1 && $rerata<=$nilA2){
{$predikat="A";}
}	
			?>
			 <td style="text-align: center;"><?= round($rata['rata']) ?></td>
			 <td style="text-align: center;"><?= $predikat ?></td>
			  <?php }  } ?>
	 </tr>
	  
	 </tbody>
	</table>
	<br/>
	<table border='0' style="margin-left: 80px;width:850">
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
						<td width='400px'></td>
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
require_once '../../vendors/autoload.php';

use Dompdf\Dompdf;

$dompdf = new Dompdf();
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'landscape');
$dompdf->render();
$dompdf->stream("nilai.pdf", array("Attachment" => false));

exit(0);
?>