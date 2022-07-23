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
$rapor=fetch($koneksi,'setting_rapor',['id' => 1]);
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>

    <title>Biodata_Rapor_<?= $siswa['nama'] ?></title>

<link rel="stylesheet" href="../../plugins/bootstrap/dist/css/bootstrap.min.css">


</head>
<body style="font-size: 13px;">
    <br><br><br>
   <center>
        <h6>IDENTITAS PESERTA DIDIK</h6>
		
    </center>
    <br>
    <br>
    <br>
    <div class="col-md-12">
	
        <table style="margin-left:30px;margin-right:10px"  width="100%">
            <tr>
			  <td width="1%">1.</td>
                <td width="15%">Nama Peserta Didik</td>
                <td width="1%">:</td>
			<td width="40%"><?= $siswa['nama'] ?></td>
            </tr>
            <tr>
			  <td width="1%">2.</td>
                <td width="15%">Nomor Induk</td>
                <td width="1%">:</td>
			<td width="40%"><?= $siswa['nis'] ?></td>
            </tr>
			 <tr>
			  <td width="1%">3.</td>
                <td width="15%">Tempat, Tanggal Lahir</td>
                <td width="1%">:</td>
			<td width="40%"><?= $siswa['tempat'] ?>, <?= $siswa['tgl_lahir'] ?></td>
            </tr>
			 <tr>
			  <td width="1%">4.</td>
                <td width="15%">Jenis Kelamin</td>
                <td width="1%">:</td>
			<td width="40%"><?= $siswa['jk'] ?></td>
            </tr>
			 <tr>
			  <td width="1%">5.</td>
                <td width="15%">Agama</td>
                <td width="1%">:</td>
			<td width="40%"><?= $siswa['agama'] ?></td>
            </tr>
			 <tr>
			  <td width="1%">6.</td>
                <td width="15%">Pendidikan Sebelumnya</td>
                <td width="1%">:</td>
			<td width="40%"><?= $siswa['asal_sek'] ?></td>
            </tr>
			<tr>
			  <td width="1%">7.</td>
                <td width="15%">Alamat Peserta Didik</td>
                <td width="1%">:</td>
			<td width="40%"><?= $siswa['alamat'] ?></td>
            </tr>
			<tr>
			  <td width="1%">8.</td>
                <td width="15%">Nama Orang Tua</td>
                <td width="1%"></td>
			<td width="40%"></td>
            </tr>
			<tr>
			  <td width="4%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;a. </td>
                <td width="12%">Ayah</td>
                <td width="1%">:</td>
			<td width="40%"><?= $siswa['ayah'] ?></td>
            </tr>
			<tr>
			  <td width="4%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;b. </td>
                <td width="12%">Ibu</td>
                <td width="1%">:</td>
			<td width="40%"><?= $siswa['ibu'] ?></td>
            </tr>
			<tr>
			  <td width="1%">9.</td>
                <td width="15%">Pekerjaan Orang Tua</td>
                <td width="1%"></td>
			<td width="40%"></td>
            </tr>
			<tr>
			  <td width="4%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;a. </td>
                <td width="12%">Ayah</td>
                <td width="1%">:</td>
			<td width="40%"><?= $siswa['pek_ayah'] ?></td>
            </tr>
			<tr>
			  <td width="4%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;b. </td>
                <td width="12%">Ibu</td>
                <td width="1%">:</td>
			<td width="40%"><?= $siswa['pek_ibu'] ?></td>
            </tr>
			<tr>
			  <td width="1%">10.</td>
                <td width="15%">Alamat Orang Tua</td>
                <td width="1%"></td>
			<td width="40%"></td>
            </tr>
			<tr>
			  <td width="4%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </td>
                <td width="12%">Jalan</td>
                <td width="1%">:</td>
			<td width="40%"><?= $siswa['jalan'] ?></td>
            </tr>
			<tr>
			  <td width="4%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </td>
                <td width="12%">Kelurahan/Desa</td>
                <td width="1%">:</td>
			<td width="40%"><?= $siswa['desa'] ?></td>
            </tr>
			<tr>
			  <td width="4%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </td>
                <td width="12%">Kecamatan</td>
                <td width="1%">:</td>
			<td width="40%"><?= $siswa['kec'] ?></td>
            </tr>
			<tr>
			  <td width="4%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </td>
                <td width="12%">Kabupaten</td>
                <td width="1%">:</td>
			<td width="40%"><?= $siswa['kab'] ?></td>
            </tr>
			<tr>
			  <td width="4%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </td>
                <td width="12%">Propinsi</td>
                <td width="1%">:</td>
			<td width="40%"><?= $siswa['prov'] ?></td>
            </tr>
			<tr>
			  <td width="1%">11.</td>
                <td width="15%">Wali Peserta Didik</td>
                <td width="1%"></td>
			<td width="40%"></td>
            </tr>
			<tr>
			  <td width="4%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;a. </td>
                <td width="12%">Nama</td>
                <td width="1%">:</td>
			<td width="40%"></td>
            </tr>
			<tr>
			  <td width="4%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;b. </td>
                <td width="12%">Pekerjaan</td>
                <td width="1%">:</td>
			<td width="40%"></td>
            </tr>
			<tr>
			  <td width="4%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;c. </td>
                <td width="12%">Alamat</td>
                <td width="1%">:</td>
			<td width="40%"></td>
            </tr>
			
        </table>
        <table width="100%">
            <tr>
               <td style="text-align: center;width:50px"></td>
                <td style="text-align: center;width:180px">
				<br>
                    <?php if ($siswa['photo'] <>'') { ?>
                        <img width="90" class="img" src="../../foto/fotosiswa/<?= $siswa['photo'] ?>" width="80" >
                    <?php } ?>
                   <?php if ($siswa['photo'] =='') { ?>
                        <img width="90" class="img" src="../../foto/fotosiswa/polos.png">
                    <?php } ?>
                </td>

                <td style="text-align: center;width:180px">
                    
                </td>
                <td style="text-align: center">
                    <?= $setting['kecamatan'] ?>, <?= $rapor['tanggal'] ?><br>
                    Kepala Sekolah,

                   
                    
                        <br><br><br><br>
                    

                    <u><b><?= $setting['kepsek'] ?></b></u>
                    <br>
                    <?= $setting['nip'] ?>
                    
                        <br>
                        
                   
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
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();
$dompdf->stream("Raport_" . $siswa['nama'] . ".pdf", array("Attachment" => false));
exit(0);
?>