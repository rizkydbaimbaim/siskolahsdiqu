<?php ob_start();
error_reporting(0);
require("../../config/config.database.php");
require("../../config/config.function.php");
require("../../config/functions.crud.php");

session_start();
if (!isset($_SESSION['id_pengawas'])) {
    die('Anda tidak diijinkan mengakses langsung');
}
$kelas = $_GET['kelas'];
$rapor=fetch($koneksi,'setting_rapor',['id' => 1]);
$bl = date('m');
$bulane = fetch ($koneksi, 'bulan', ['bln' =>$bl]);

$user=fetch($koneksi,'pengawas',['jabatan' =>$kelas]);

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>

    <title>Absen_Kelas_<?= $kelas ?></title>
<link rel="stylesheet" href="../../plugins/bootstrap/dist/css/bootstrap.min.css">


</head>

<body style="font-size: 12px;">

   <center><h3><?= strtoupper($setting['sekolah']) ?></h3></center>
	   <center> Alamat : <?= $setting['alamat']; ?> Kec. <?= $setting['kecamatan']; ?> Kab. <?= $setting['kota']; ?></center>
	  <hr>
   
   <img src="../../<?= $setting['logo'] ?>" style="margin-left:20px ;margin-top:-140px ;width: 60px;">
 
   <center><h5>REKAP ABSENSI DARING<br>( Bulan <?= $bulane['ket'] ?> Tahun <?= date('Y') ?> )</h5></center>
   <br>
   <div style="padding-left:20px;margin-right:50px ;" class="col-md-12">
    <table>
	<tbody>
           
                <tr>
                <td width='100px'>Kelas</td>
                <td width='10px'>:</td>
                <td><?= $kelas ?></td>
				</tr>
				
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
   <table style="font-size: 12px" class="table table-sm table-bordered">
                     
        <thead class="thead-dark">
            <tr>
                <th>NO</th>
                <th>Nama Siswa</th>
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
			$query = mysqli_query($koneksi,"select * from siswa WHERE id_kelas='$kelas'");
             $no = 0;
              while ($siswa = mysqli_fetch_array($query)) {
		$hadir= mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM absen_daring WHERE idsiswa='$siswa[id_siswa]' AND ket='H'"));
         $sakit= mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM absen_daring WHERE idsiswa='$siswa[id_siswa]' AND ket='S' "));
		 $izin= mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM absen_daring WHERE idsiswa='$siswa[id_siswa]' AND ket='I' "));
         $alpha= mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM absen_daring WHERE idsiswa='$siswa[id_siswa]' AND ket='A' "));
			  $no++;
			?>
			
							<tr>
                                    <td><?= $no; ?></td>
                                    <td><?=  ucwords(strtolower($siswa['nama'])) ?></td>
									
				<?php 
				
				$tanggal = cal_days_in_month(CAL_GREGORIAN, $bulan, $tahun);
                    for ($i = 1; $i < $tanggal + 1; $i++) { ?>
                        <?php $tanggalbaru = date('Y-m-d', mktime(0, 0, 0, $bulan, $i, $tahun));
                        $cekabsen = fetch($koneksi, 'absen_daring', ['tanggal' => $tanggalbaru, 'idsiswa' => $siswa['id_siswa']]);
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
