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
$kelas= $_GET['kelas'];
$ket=$_GET['ki'];
$jadwal=fetch($koneksi,'jadwal_mapel',['id_jadwal' =>$id]);
$mapel=$jadwal['kode'];
$guru = $jadwal['guru'];
if($ket=='1'){
{$grade="KI3";}
}elseif($ket=='2'){
{$grade="KI4";}
}
$bl = date('m');
$bulane = fetch ($koneksi, 'bulan', ['bln' =>$bl]);
$rapor=fetch($koneksi,'setting_rapor',['id' => 1]);
$user=fetch($koneksi,'pengawas',['id_pengawas' =>$guru]);
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>

    <title>nilai_<?= $user['nama'] ?></title>
<link rel="stylesheet" href="../../plugins/bootstrap/dist/css/bootstrap.min.css">

</head>

<body style="font-size: 12px;">

   <center><h3><?= strtoupper($setting['sekolah']) ?></h3></center>
	 <center> Alamat : <?= $setting['alamat']; ?> Kec. <?= $setting['kecamatan']; ?> Kab. <?= $setting['kota']; ?></center>
	  <hr>
    <img src="../../<?= $setting['logo'] ?>" style="margin-left:20px ;margin-top:-140px ;width: 60px;">
    <?php if($ket=='1'){ ?>
   <center><h5>REKAPITULASI NILAI PENGETAHUAN (KI-3)</h5></center>
	<?php }else{ ?>
	<center><h5>REKAPITULASI NILAI KETERAMPILAN (KI-4)</h5></center>
	<?php } ?>
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
	<th style="text-align: center;">Nama Siswa</th>
	 <?php
			$querys = mysqli_query($koneksi,"select * from kode WHERE ket='$ket' AND mapel='$mapel' GROUP BY kd");
              while ($kd = mysqli_fetch_array($querys)) {
			?>
			<th width='5%' style="text-align: center;"><?= $kd['kd'] ?></th>
			  <?php } ?>
			  <th width='5%' style="text-align: center;">NR</th>
	</tr>
	 </thead>
	  <?php
	       $no=0;
			$query = mysqli_query($koneksi,"select * from siswa WHERE id_kelas='$kelas[kelas]'");
              while ($siswa = mysqli_fetch_array($query)) {
				 
				  $no++;
			?>
     <tbody>
	
	         <tr>
	        <td><?= $no ?></td>
			<td><?= ucwords(strtolower($siswa['nama'])) ?></td>
	        <?php
			$queryxx = mysqli_query($koneksi,"select AVG(nilai) AS nkd from nilai_harian 
			JOIN kode ON kode.kd=nilai_harian.kd
			WHERE idsiswa='$siswa[id_siswa]' AND ki='$grade' AND nilai_harian.mapel='$mapel' GROUP  BY kode.kd ");
              while ($nilai = mysqli_fetch_array($queryxx)) {
		 
			?>
	
     	<td style="text-align: center;"><?= round($nilai['nkd'],2) ?></td>
			 <?php } ?>
			  <?php
			$queryxr = mysqli_query($koneksi,"select AVG(nilai) AS rata from nilai_harian 
			JOIN kode ON kode.kd=nilai_harian.kd
			WHERE idsiswa='$siswa[id_siswa]'  AND kode.ket='$ket' AND nilai_harian.mapel='$mapel' GROUP  BY nilai_harian.idsiswa ");
              while ($rata = mysqli_fetch_array($queryxr)) {
		 
			?>
			 <td style="text-align: center;"><?= round($rata['rata'],0) ?></td>
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
