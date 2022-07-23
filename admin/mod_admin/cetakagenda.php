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
$kelasQ=fetch($koneksi,'jadwal_mapel',['id_jadwal' => $id]);
$mapelQ=$kelasQ['mapel'];
$mapel=$kelasQ['kode'];
$kelas=$kelasQ['kelas'];
$guru=$kelasQ['guru'];

$rapor=fetch($koneksi,'setting_rapor',['id' => 1]);
$bl = date('m');
$bulane = fetch ($koneksi, 'bulan', ['bln' =>$bl]);

$user=fetch($koneksi,'pengawas',['id_pengawas' =>$kelasQ['guru']]);
$agenda = fetch($koneksi, 'agenda', ['kelas' => $kelas, 'mapel' => $mapel, 'guru' =>$guru]);
$absen = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM absen_mapel WHERE tgl_absen='$agenda[tanggal]' 
AND guru='$guru' AND mapel='$mapel' AND kelas='$kelas' "));
$jumlah = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM siswa WHERE id_kelas='$kelas' "));
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>

    <title>Agenda_<?= $user['nama'] ?></title>

   <link rel="stylesheet" href="../../plugins/bootstrap/dist/css/bootstrap.min.css">


</head>

<body style="font-size: 12px;">

   <center><h3><?= strtoupper($setting['sekolah']) ?></h3></center>
	<center> Alamat : <?= $setting['alamat']; ?> Kec. <?= $setting['kecamatan']; ?> Kab. <?= $setting['kota']; ?></center>
	  <hr>
      <img src="../../<?= $setting['logo'] ?>" style="margin-left:20px ;margin-top:-140px ;width: 60px;">
    
   <center><h5>AGENDA DAN JURNAL GURU</h5></center>
   <br>
   <div style="padding-left:20px;margin-right:50px ;" class="col-md-12">
    <table>
	<tbody>
            <tr>
                <td width='100px'>Mata Pelajaran</td>
                <td width='10px'>:</td>
                <td><?= $mapel ?></td>
				 <td width='700px'></td>
				<td width='100px'>Semester</td>
                <td width='10px'>:</td>
                <td><?= $rapor['semester'] ?></td>
            </tr>
			
                <tr>
                <td width='100px'>Kelas</td>
                <td width='10px'>:</td>
                <td><?= $kelas ?></td>
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
	<th width='10%' style="text-align: center;">Jam Pelajaran</th>
	<th width='5%' style="text-align: center;">Pertemuan Ke</th>
	<th width='5%' style="text-align: center;">Nomor KI/KD</th>
	<th style="text-align: center;">Materi</th>
	<th style="text-align: center;">Indikator</th>
	<th width='10%' style="text-align: center;">Pencapaian</th>
	<th width='5%' style="text-align: center;">Kehadiran Siswa</th>
	</tr>
	 </thead>
	 <?php
	  $query = mysqli_query($koneksi, "select * from agenda 
	 JOIN m_hari ON m_hari.inggris=agenda.harix WHERE mapel='$mapel' AND kelas='$kelas' AND guru='$guru' ORDER BY agenda.id ASC");
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
	 <td style="text-align: center;"><?= $kelasQ['dari'] ?> - <?= $kelasQ['sampai'] ?></td>
	 <td style="text-align: center;"><?= $agenda['ke'] ?></td>
	 <td style="text-align: center;"><?= $agenda['kikd'] ?></td>
	 <td><?= $agenda['materi'] ?></td>
	 <td><?= $agenda['indikator'] ?></td>
	 <td style="text-align: center;">
	 <?php if($prosen>=50){ ?>
	 Tercapai
	 <?php } ?>
	  <?php if($prosen<50){ ?>
	 Tidak Tercapai
	 <?php } ?>
	 </td>
	 <td style="text-align: center;"><?= round($prosen); ?>%</td>
	 
	 </tr>
	   <?php } ?>
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
