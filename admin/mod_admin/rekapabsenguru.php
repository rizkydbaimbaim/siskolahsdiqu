<?php ob_start();
error_reporting(0);
require("../../config/config.database.php");
require("../../config/config.function.php");
require("../../config/functions.crud.php");

session_start();
if (!isset($_SESSION['id_pengawas'])) {
    die('Anda tidak diijinkan mengakses langsung');
}

$bl = date('m');
$bulane = fetch ($koneksi, 'bulan', ['bln' =>$bl]);
$rapor=fetch($koneksi,'setting_rapor',['id' => 1]);
$user=fetch($koneksi,'pengawas',['id_pengawas' =>$id]);
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>

    <title>Absen_bulan<?= $bulane['ket'] ?></title>
<link rel="stylesheet" href="../../plugins/bootstrap/dist/css/bootstrap.min.css">


</head>

<body style="font-size: 12px;">

   <center><h3><?= strtoupper($setting['sekolah']) ?></h3></center>
	   <center> Alamat : <?= $setting['alamat']; ?> Kec. <?= $setting['kecamatan']; ?> Kab. <?= $setting['kota']; ?></center>
	  <hr>
   
     <img src="../../<?= $setting['logo'] ?>" style="margin-left:20px ;margin-top:-140px ;width: 60px;">
 
   <center><h5>REKAPITULASI ABSENSI GURU<br>( Bulan <?= $bulane['ket'] ?> Tahun <?= date('Y') ?> )</h5></center>
   <br>
   <div style="padding-left:20px;margin-right:50px ;" class="col-md-12">
    <table>
	<tbody>
                
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
   <table style="font-size: 12px" class="table table-striped table-sm">
                     
        <thead class="thead-dark">
            <tr>
                <th>No</th>
                <th>Nama </th>
                <?php
				$bulan= date('m');
				$tahun=date('Y');
                	$tanggal = cal_days_in_month(CAL_GREGORIAN, $bulan, $tahun);
                    for ($i = 1; $i < $tanggal + 1; $i++) { ?>
                    <th><?= $i ?></th>
                <?php } ?>
                <th>H</th>
                <th>S</th>
                <th>I</th>
                <th>A</th>
            </tr>
        </thead>
       
							 <tbody>
							
            <?php
			$query = mysqli_query($koneksi,"select * from pengawas WHERE level='guru'");
             $no = 0;
              while ($guru = mysqli_fetch_array($query)) {
		$hadir= mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM absen_guru WHERE guru='$guru[id_pengawas]' AND ket='H' "));
         $sakit= mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM absen_guru WHERE guru='$guru[id_pengawas]' AND ket='S' "));
		 $izin= mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM absen_guru WHERE guru='$guru[id_pengawas]' AND ket='I' "));
         $alpha= mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM absen_guru WHERE guru='$guru[id_pengawas]' AND ket='A' "));
			  $no++;
			?>
			
							<tr>
                                    <td><?= $no; ?></td>
                                    <td><?= $guru['nama'] ?></td>
									
				<?php 
				
				$tanggal = cal_days_in_month(CAL_GREGORIAN, $bulan, $tahun);
                    for ($i = 1; $i < $tanggal + 1; $i++) { ?>
                        <?php $tanggalbaru = date('Y-m-d', mktime(0, 0, 0, $bulan, $i, $tahun));
                        $cekabsen = fetch($koneksi, 'absen_guru', ['tanggal' => $tanggalbaru, 'guru' => $guru['id_pengawas']]);
                       if ($cekabsen) { ?>
					 
                            <td><?= $cekabsen['ket'] ?></td>
                        <?php } else { ?>
                            <td></td>
                        <?php } ?>
                    <?php } ?>
					
							  <td><?= $hadir; ?></td>
							  <td><?= $sakit; ?></td>
							 <td><?= $izin; ?></td>
							  <td><?= $alpha; ?></td>
							  
									 </tr>   
			  <?php } ?>
         
			 
        </tbody>
    </table>
	
	<table style="margin-left: 850px;margin-right:5px">
	<tr>
	<td style="text-align: center;"><?= $setting['kecamatan'] ?>, <?php echo date('d'); ?> <?= $bulane['ket'] ?> <?= date('Y') ?></td>
	</tr>
	<tr>
	<td style="text-align: center;">Kepala Sekolah<br>
	<br>
	<br>
	<br>
	<?= $setting['kepsek'] ?><br>NIP. <?= $setting['nip'] ?>
	</td>
	</tr>
	</table>
</body>
</html>
