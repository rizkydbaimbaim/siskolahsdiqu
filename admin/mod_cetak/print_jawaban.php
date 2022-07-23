<?php
require("../../config/config.default.php");
require("../../config/config.function.php");
require("../../config/functions.crud.php");
session_start();
(isset($_SESSION['id_pengawas'])) ? $id_pengawas = $_SESSION['id_pengawas'] : $id_pengawas = 0;
($id_pengawas == 0) ? header('location:login.php') : null;
$id_tugas = $_GET['id'];

$tugas = fetch($koneksi, 'tugas', array('id_tugas' => $id_tugas));
$guru = fetch($koneksi, 'pengawas', array('id_pengawas' => $tugas['id_guru']));
$rapor=fetch($koneksi,'setting_rapor',['id' => 1]);
$bl = date('m');
$bulane = fetch ($koneksi, 'bulan', ['bln' =>$bl]);
?>
		<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>

    <title>Nilai_Tugas</title>
<link rel="stylesheet" href="../../plugins/bootstrap/dist/css/bootstrap.min.css">


</head>

			<body style="font-size: 12px;">
				
		 <center><h3><?= strtoupper($setting['sekolah']) ?></h3></center>
	   <center> Alamat : <?= $setting['alamat']; ?> Kec. <?= $setting['kecamatan']; ?> Kab. <?= $setting['kota']; ?></center>
	  <hr>
     <img src="../../../<?= $setting['logo'] ?>" style="margin-left:20px ;margin-top:-75px ;width: 80px;">
			
				<br>
				<div align='center'>
					<h6><b>LAPORAN TUGAS TERSTRUKTUR</b><br/>
					<b>MATA PELAJARAN <?=  strtoupper($tugas['mapel']) ?></b><br/>
					<b>SEMESTER <?= $rapor['semester'] ?>  TAHUN AJARAN  <?= $rapor['tp'] ?></b></h6><br/>
				</div>
				
			  <table style="font-size: 12px" class="table table-striped table-sm">
					<thead>
						<tr>
							<th width='5px'>No</th>
							<th>NIS</th>
							<th>Nama</th>
							<th width="5%">Kelas</th>
							<th width="10%">Nilai</th>
							
						</tr>
					</thead>
					<tbody>
<?php 
$tugasQ = select($koneksi, 'jawaban_tugas', array('id_tugas' => $id_tugas));
foreach ($tugasQ as $jtugas) {
	$no++;
	$siswa = fetch($koneksi, 'siswa', ['id_siswa' => $jtugas['id_siswa']]);
	?>
							<tr>
								<td align='center'><?= $no ?></td>
								<td align='center' width='100px'><?= $siswa[nis]  ?></td>
								<td><?= $siswa[nama]  ?></td>
								<td><?= $siswa[id_kelas]  ?></td>
								<td width='130px'><?= $jtugas[nilai]  ?></td>
								
							</tr>
<?php } ?>
					</tbody>
				</table>
				<br/>
				<table border='0' style="margin-left: 50px;margin-right:5px">>
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
							Guru Pengampu<br/>
							<br/>
							<br/>
							<br/>
							
							<u><?= $guru['nama'] ?></u><br/>
							NIP. <?= $guru['nip'] ?>
						</td>
					</tr>
				</table>
		</body>
</html>
