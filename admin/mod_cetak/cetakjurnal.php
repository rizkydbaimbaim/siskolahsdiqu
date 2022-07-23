<?php ob_start();
error_reporting(0);
require("../../config/config.database.php");
require("../../config/config.function.php");
require("../../config/functions.crud.php");

session_start();
if (!isset($_SESSION['id_pengawas'])) {
    die('Anda tidak diijinkan mengakses langsung');
}
$id = $_GET['id'];
$jadwal=fetch($koneksi,'jadwal_mapel',['id_jadwal' =>$id]);
$mapel=$jadwal['kode'];
$kelas= $_GET['kelas'];
$guru=$jadwal['guru'];

$rapor=fetch($koneksi,'setting_rapor',['id' => 1]);
$user=fetch($koneksi,'pengawas',['id_pengawas' =>$_SESSION['id_pengawas']]);
$bl = date('m');
$bulane = fetch ($koneksi, 'bulan', ['bln' =>$bl]);
$agendax = fetch($koneksi, 'jurnal', ['kelas' => $kelas, 'mapel' => $mapel, 'guru'=>$guru]);
$jadwal=fetch($koneksi,'jadwal_mapel',['kelas' => $kelas, 'kode' => $mapel, 'guru'=>$guru]);
$absen = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM absen_mapel WHERE tgl_absen='$agendax[tanggal]' 
AND guru='$guru' AND mapel='$mapel' AND kelas='$kelas' "));
$jumlah = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM siswa WHERE id_kelas='$kelas' "));
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>

    <title>Jurnal_<?= $user['nama'] ?></title>

   <link rel="stylesheet" href="../../plugins/bootstrap/dist/css/bootstrap.min.css">


</head>

<body style="font-size: 12px;">

  <center><h3><?= strtoupper($setting['sekolah']) ?></h3></center>
	<center> Alamat : <?= $setting['alamat']; ?> Kec. <?= $setting['kecamatan']; ?> Kab. <?= $setting['kota']; ?></center>
	  <hr>
   <img src="../../<?= $setting['logo'] ?>" style="margin-left:20px ;margin-top:-140px ;width: 60px;">
    
   <center><h5>JURNAL MENGAJAR GURU</h5></center>
   <br>
   <div style="padding-left:20px;margin-right:50px ;" class="col-md-12">
    <table>
	<tbody>
            <tr>
                <td width='100px'>Mata Pelajaran</td>
                <td width='10px'>:</td>
                <td><?= $jadwal['kode'] ?></td>
					<td width='700px'></td>
				 <td width='100px'>Semester</td>
                <td width='10px'>:</td>
                <td><?= $rapor['semester'] ?></td>
            </tr>
			
                <tr>
                <td width='100px'>Kelas</td>
                <td width='10px'>:</td>
                <td><?= $agendax['kelas'] ?></td>
					<td width='700px'></td>
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
	<th width='15%' style="text-align: center;">Hari, Tanggal</th>
	<th width='10%' style="text-align: center;">Jam Ke</th>
	<th style="text-align: center;">Bahasan Materi</th>
	<th style="text-align: center;">Hambatan</th>
	<th style="text-align: center;">Pemecahan</th>
	<th width='5%' style="text-align: center;">Kehadiran Siswa</th>
	</tr>
	 </thead>
	 <?php
	  $query = mysqli_query($koneksi, "select * from jurnal 
	 JOIN m_hari ON m_hari.inggris=jurnal.harix WHERE jurnal.mapel='$mapel' ORDER BY jurnal.id ASC");
      $no = 0;
       while ($agenda = mysqli_fetch_array($query)) {
	  $tanggalmu=date('d-m-Y',strtotime($agenda['tanggal']));
	  $hadir = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM absen_mapel WHERE mapel='$agenda[mapel]' AND tgl_absen='$agenda[tanggal]' 
	  AND guru='$agenda[guru]' AND kelas='$agenda[kelas]' AND ket='H'"));
	  $bagi=100/$jumlah;
	  $prosen=$bagi * $hadir;
       $no++;
	   
	   
	   
	 ?>
     <tbody>
	 <tr>
	 <td style="text-align: center;"><?= $no ?></td>
	 <td style="text-align: center;"><?= $agenda['hari'] ?>, <?= $tanggalmu ?></td>
	 <td style="text-align: center;"><?= $agenda['ke'] ?></td>
	 <td><?= $agenda['materi'] ?></td>
	 <td><?= $agenda['hambatan'] ?></td>
	  <td><?= $agenda['pemecahan'] ?></td>
	 <td style="text-align: center;"><?= round($prosen); ?>%</td>
	 
	 </tr>
	   <?php } ?>
	 </tbody>
	</table>
	
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
						<td width='650px'></td>
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
