<?php ob_start();
error_reporting(0);
require("../../config/config.database.php");
require("../../config/config.function.php");
require("../../config/functions.crud.php");
session_start();

$kelas=$_GET['kelas'];
$kelas=$_GET['kelas'];
$jmpl = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM jadwal_mapel WHERE kelas='$kelas' "));
$bl = date('m');
$bulane = fetch ($koneksi, 'bulan', ['bln' =>$bl]);
$user=fetch($koneksi,'pengawas',['jabatan'=>$kelas]);
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>

     <title>KI-3_<?= $kelas ?></title>
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
		<h5>(PENGETAHUAN)</h5>
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
			<th colspan='<?= $jmpl ?>'>PENGETAHUAN (KI-3)</th>
			<th width="5%"  rowspan='2'>JML NILAI</th>
			</tr>
			<tr style="text-align: center">
			<?php
             $queryx = mysqli_query($koneksi, "select * from jadwal_mapel WHERE kelas='$kelas' order by urut");
              while ($mapel = mysqli_fetch_array($queryx)) { ?>
                 <th width="4%"><?= $mapel['kode'] ?></th>
                                <?php } ?>
			
			</tr>
			 </thead>
			 <?php
               $query = mysqli_query($koneksi, "select * from siswa_rapor where kelas='$kelas' ");
                            $no = 0;
                            while ($siswa = mysqli_fetch_array($query)) {
                                $no++;
                            ?>
							 <tbody>
                                <tr>
                                    <td style="text-align: center"><?= $no; ?></td>
                                    <td style="text-align: center"><?= $siswa['nis'] ?></td>
                                    <td>&nbsp;<?= ucwords(strtolower($siswa['nama'])) ?></td>
			                      <td style="text-align: center"><?= substr($siswa['jk'],0,1) ?></td>
								  <?php
                                    $queryx = mysqli_query($koneksi, "select * from jadwal_mapel WHERE kelas='$kelas' order by urut");
                                    while ($mapel = mysqli_fetch_array($queryx)) {
                                       $n1 = mysqli_query($koneksi, "SELECT AVG(nilai) AS rata FROM nilai_ph WHERE mapel='$mapel[kode]' AND nis='$siswa[nis]' AND nilai>0");
                                    while ($kl = mysqli_fetch_array($n1)) {
						           $rerata=$kl['rata'];
								  
								   ?>
                                        <td style="text-align: center"><?= round($rerata) ?></td>
										
                                    <?php } }?>
									<?php
									 $n2 = mysqli_query($koneksi, "SELECT SUM(nilai) AS ratax,COUNT(nilai) AS bagi FROM nilai_ph WHERE nis='$siswa[nis]' AND nilai>0");
                                    while ($kl2 = mysqli_fetch_array($n2)) {
										$n3 = mysqli_query($koneksi, "SELECT COUNT(jadwal_mapel.kode) AS kali FROM jadwal_mapel WHERE EXISTS(SELECT mapel FROM nilai_ph
										WHERE jadwal_mapel.kode=nilai_ph.mapel AND jadwal_mapel.kelas='$kelas')");
										 $kl3 = mysqli_fetch_array($n3);
										$jumlah=($kl2['ratax']/$kl2['bagi'])*$kl3['kali'];
									
										 ?>
		                            <td style="text-align: center"><?= round($jumlah,0) ?></td>   
									<?php } ?>
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
						<td width='400px'></td>
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
