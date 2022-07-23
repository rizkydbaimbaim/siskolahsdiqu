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
$siswa=fetch($koneksi,'siswa_rapor',['id' => $id]);

$bl = date('m');
$bulane = fetch ($koneksi, 'bulan', ['bln' =>$bl]);

$skb=fetch($koneksi,'skkb',['id' =>1]);

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>


   <link rel="stylesheet" href="../../plugins/bootstrap/dist/css/bootstrap.min.css">


</head>

<body style="font-size: 14px;">

  <center><h4><?= strtoupper($skb['header']) ?><br>
  <?= strtoupper($setting['sekolah']) ?></h4></center>
	<center> Alamat : <?= $setting['alamat']; ?> Kec. <?= $setting['kecamatan']; ?> Kab. <?= $setting['kota']; ?></center>
	  <hr>
   <img src="../../<?= $setting['logo'] ?>" style="margin-left:20px ;margin-top:-155px ;width: 80px;">
    
   <center><h5>SURAT KETERANGAN KELAKUAN BAIK</h5></center>
   <br>
   <div style="padding-left:20px;margin-right:10px ;" class="col-md-12">
   <p>Yang bertanda tangan dibawah ini :</p>
    <table>
	<tbody>
          
			 <tr>
                <td width="130px">Nama</td>
				<td width="10px">:</td>
				<td><?= $setting['kepsek'] ?></td>
            </tr>
			
                <tr>
                <td>NIP</td>
				<td>:</td>
				<td><?= $setting['nip'] ?></td>
            </tr>
			
                <tr>
                <td>Jabatan</td>
				<td>:</td>
				<td>Kepala <?= $setting['sekolah'] ?></td>
            </tr>
			</tbody>
    </table>
	<br/>
   <p>Menerangkan bahwa :</p>
    <table>
	<tbody>
          
			 <tr>
                <td width="130px">Nama</td>
				<td width="10px">:</td>
				<td><?= $siswa['nama'] ?></td>
            </tr>
                <tr>
                <td>NIS / NISN</td>
				<td>:</td>
				<td><?= $siswa['nis'] ?> / <?= $siswa['nisn'] ?></td>
            </tr>
			
                <tr>
                <td>Tempat, Tgl Lahir</td>
				<td>:</td>
				<td><?= $siswa['tempat'] ?>, <?= $siswa['tgl_lahir'] ?></td>
            </tr>
			
                <tr>
                <td>Jenis Kelamin</td>
				<td>:</td>
				<td><?= $siswa['jk'] ?></td>
            </tr>
			
                <tr>
                <td>Agama</td>
				<td>:</td>
				<td><?= $siswa['agama'] ?></td>
            </tr>
			
                <tr>
                <td>Alamat</td>
				<td>:</td>
				<td><?= $siswa['alamat'] ?></td>
            </tr>
			
                <tr>
                <td>Desa/Kelurahan</td>
				<td>:</td>
				<td><?= $siswa['desa'] ?></td>
            </tr>
			
                <tr>
                <td>Kecamatan</td>
				<td>:</td>
				<td><?= $siswa['kec'] ?></td>
            </tr>
			
                <tr>
                <td>Kabupaten</td>
				<td>:</td>
				<td><?= $siswa['kab'] ?></td>
            </tr>
			</tbody>
    </table>
	<br/>
	<p><?= $skb['isi'] ?> </p>
	<p><?= $skb['foter'] ?> </p>
	
	</div>
     <br>
    
	<table border='0' style="margin-left: 80px;width:850">
					<tr>
					
						<td width='150px'>
							<br/>
							 <br/>
							<br/>
							<br/>
							<br/>
							
							<br/>
							
						</td>
						<td width='200px'></td>
						<td>
							<?= $setting['kecamatan'] ?>, <?php echo date('d'); ?> <?= $bulane['ket'] ?> <?= date('Y') ?><br/>
							Yang Membuat Pernyataan<br/>
							<br/>
							<br/>
							<br/>
							
							<u><?= $setting['kepsek'] ?></u><br/>
							NIP. <?= $setting['nip'] ?>
						</td>
					</tr>
				</table>
</body>

</html>
