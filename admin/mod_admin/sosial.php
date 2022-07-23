<?php ob_start();
error_reporting(0);
require("../../config/config.database.php");
require("../../config/config.function.php");
require("../../config/functions.crud.php");
session_start();

$kelas=$_GET['kelas'];
$bl = date('m');
$bulane = fetch ($koneksi, 'bulan', ['bln' =>$bl]);
$user=fetch($koneksi,'pengawas',['jabatan'=>$kelas]);
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>

     <title>KI-2_<?= $kelas ?></title>

    <!-- General CSS Files -->
   <link rel="stylesheet" href="../../plugins/bootstrap/dist/css/bootstrap.min.css">


</head>
<?php
    $setting=fetch($koneksi,'setting',['id_setting' => 1]);
	$rapor=fetch($koneksi,'setting_rapor',['id' => 1]);
	if($rapor['semester']=='1'){
{$smt="(Satu)";}
}elseif($rapor['semester']=='2'){
{$smt="(Dua)";}
}
  ?>
<body style="font-size: 12px;">
    
   
    <center>
        <h5>DAFTAR KUMPULAN NILAI</h5>
		<h5>(SIKAP SOSIAL)</h5>
    </center>
    <br>
    
    <div class="col-md-14">
	
        <table style="margin-left: 80px;margin-right:60px"  width="100%" >
            <tr>
                <td width="15%">Satuan Pendidikan</td>
                <td width="1%">:</td>
				<td width="40%"><?= $setting['sekolah'] ?></td>
				<td></td>
				<td width="17%">Kelas</td>
                <td width="1%">:</td>
				<td width="20%"><?= $kelas ?></td>
            </tr>
            <tr>
                <td >Alamat</td>
                <td>:</td>
				<td><?= $ms['alamat'] ?> Kec. <?= $setting['kecamatan'] ?></td>
				<td></td>
				<td>Semester</td>
                <td>:</td>
				<td> <?= $rapor['semester'] ?> <?= $smt ?></td>
            </tr>
			<tr>
                <td>Wali Kelas</td>
                <td>:</td>
				<td><?= $user['nama'] ?></td>
				<td></td>
				<td>Tahun Pelajaran</td>
                <td>:</td>
				<td><?= $rapor['tp'] ?></td>
            </tr>
			
        </table>
       
       
        <br>
 <table style="font-size: 12px" class="table table-striped table-sm">
  <thead>
            <tr style="text-align: center">
			<th width="3%" rowspan='2' >No</th>
			<th width="8%" rowspan='2'>NIS</th>
			<th rowspan='2'>NAMA LENGKAP</th>
			<th width="3%" rowspan='2'>JK</th>
			<th colspan='2'> SIKAP SOSIAL (KI-2)</th>
			<th width="5%"  rowspan='2'>PRED</th>
			</tr>
			<tr style="text-align: center">
			<th>Selalu dilakukan</th>
			<th>Sedang berkembang</th>
			</tr>
			</thead>
			 <?php
               $query = mysqli_query($koneksi, "select * from siswa_rapor WHERE kelas='$kelas' ");
                            $no = 0;
                            while ($siswa = mysqli_fetch_array($query)) {
				            $sosial=fetch($koneksi,'sosial',['niss' => $siswa['nis']]);
                                $no++;
                            ?>
							 <tbody>
                                <tr>
                                    <td style="text-align: center"><?= $no; ?></td>
                                    <td style="text-align: center"><?= $siswa['nis'] ?></td>
                                    <td>&nbsp;<?= $siswa['nama'] ?></td>
			                      <td style="text-align: center"><?= substr($siswa['jk'],0,1) ?></td>
                                        <td>&nbsp;<?= $sosial['keter'] ?></td>
										<td>&nbsp;<?= $sosial['keter2'] ?></td>
                                  <td style="text-align: center"><?= $sosial['pred'] ?></td>
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
							Wali Kelas <?= $kelas ?><br/>
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
