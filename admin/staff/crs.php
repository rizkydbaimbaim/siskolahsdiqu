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
   <center><h5>REKAPITULASI KEADAAN SISWA<br>Bulan <?= $bulane['ket'] ?> Tahun <?= date('Y') ?></h5></center>
   <br>
   <div style="padding-left:20px;margin-right:10px ;" class="col-md-12">
    <table style="font-size: 12px"  class='table table-bordered table-striped'>
                            <thead>
                                <tr>
								    <th colspan="5" style="text-align: center;">Masuk</th>
									  <th colspan="5" style="text-align: center;">Keluar</th>
									  </tr>
									  <tr>
                                    <th width='3%'>No</th>
									<th>Nama</th>
									<th width="5%">Kelas</th>
									<th width="10%">NISN</th>
									<th width="10%">Sekolah Asal</th>
                                    <th width='3%'>No</th>
									<th>Nama</th>
									<th width="5%">Kelas</th>
									<th width="10%">NISN</th>
									<th width="10%">Keterangan</th>
                                </tr>
                            </thead>
                            <tbody>
							       <?php     
								$no=0;
                              $siswaQ = mysqli_query($koneksi, "SELECT * FROM siswa_rapor JOIN mutasi ON mutasi.nisn=siswa_rapor.nisn WHERE  mutasi='1'");
                              while ($siswa = mysqli_fetch_array($siswaQ)){
								
                              $no++;
                                ?>
								<tr>
                                        <td><?= $no ?></td>
										<td><?= $siswa['nama'] ?> </td>
										<td><?= $siswa['kelas'] ?> </td>
									   <td><?= $siswa['nisn'] ?> </td>
									   <td><?= $siswa['asal_sek'] ?> </td>
                                    
                                          <?php     
								$no=0;
                              $siswaQ = mysqli_query($koneksi, "SELECT * FROM siswa_rapor JOIN mutasi ON mutasi.nisn=siswa_rapor.nisn WHERE  mutasi='2'");
                              while ($siswa = mysqli_fetch_array($siswaQ)){
								
                              $no++;
                                ?>
								
                                        <td><?= $no ?></td>
										<td><?= $siswa['nama'] ?> </td>
										<td><?= $siswa['kelas'] ?> </td>
									   <td><?= $siswa['nisn'] ?> </td>
									   <td><?= $siswa['alasan'] ?> </td>
                                    </tr>
							  <?php }} ?>
                            </tbody>
                        </table>
						
						<table style="font-size: 12px"  class='table table-bordered table-striped'>
                            <thead>
                                <tr >
								    <th rowspan="2" style="text-align: center;">Kelas</th>
									  <th colspan="3" style="text-align: center;">Awal Bulan</th>
									 <th colspan="3" style="text-align: center;">Masuk</th>
									  <th colspan="3" style="text-align: center;">Keluar</th>
									   <th colspan="3" style="text-align: center;">Akhir Bulan</th>
									    <th rowspan="2" style="text-align: center;">Keterangan</th>
										</tr>
										<tr>
                                    <th width='5%'>L</th>
									<th width='5%'>P</th>
									<th width="5%">JML</th>
									<th width='5%'>L</th>
									<th width='5%'>P</th>
									<th width="5%">JML</th>
									<th width='5%'>L</th>
									<th width='5%'>P</th>
									<th width="5%">JML</th>
									<th width='5%'>L</th>
									<th width='5%'>P</th>
									<th width="5%">JML</th>
                                </tr>
                            </thead>
                            <tbody>
							       <?php     
								
                              $kelasQ = mysqli_query($koneksi, "SELECT * FROM siswa_rapor GROUP BY kelas");
                              while ($kelas = mysqli_fetch_array($kelasQ)){
								$jumlahL = mysqli_num_rows(mysqli_query($koneksi,"SELECT * FROM siswa_rapor WHERE kelas='$kelas[kelas]' AND jk='Laki-laki' AND mutasi='0' "));
                                $jumlahP = mysqli_num_rows(mysqli_query($koneksi,"SELECT * FROM siswa_rapor WHERE kelas='$kelas[kelas]' AND jk='Perempuan' AND mutasi='0' "));
                                $jumlahA = mysqli_num_rows(mysqli_query($koneksi,"SELECT * FROM siswa_rapor WHERE kelas='$kelas[kelas]' AND mutasi='0' "));
                                $jumlahLM = mysqli_num_rows(mysqli_query($koneksi,"SELECT * FROM siswa_rapor WHERE kelas='$kelas[kelas]' AND jk='Laki-laki' AND mutasi='1' "));
                                $jumlahPM = mysqli_num_rows(mysqli_query($koneksi,"SELECT * FROM siswa_rapor WHERE kelas='$kelas[kelas]' AND jk='Perempuan' AND mutasi='1' "));
                                $jumlahAM = mysqli_num_rows(mysqli_query($koneksi,"SELECT * FROM siswa_rapor WHERE kelas='$kelas[kelas]' AND mutasi='1' "));
                                $jumlahLK = mysqli_num_rows(mysqli_query($koneksi,"SELECT * FROM siswa_rapor WHERE kelas='$kelas[kelas]' AND jk='Laki-laki' AND mutasi='2' "));
                                $jumlahPK = mysqli_num_rows(mysqli_query($koneksi,"SELECT * FROM siswa_rapor WHERE kelas='$kelas[kelas]' AND jk='Perempuan' AND mutasi='2' "));
                                $jumlahAK = mysqli_num_rows(mysqli_query($koneksi,"SELECT * FROM siswa_rapor WHERE kelas='$kelas[kelas]' AND mutasi='2' "));
							  
							    $jumlahLA = ($jumlahL + $jumlahLM)- $jumlahLK;
                                $jumlahPA = ($jumlahP + $jumlahPM)- $jumlahPK;
                                $jumlahAA = $jumlahLA + $jumlahPA;
							  
                                ?>
								<tr>
                                        <td style="text-align: center;"><?= $kelas['kelas'] ?></td>
										<td style="text-align: center;"><?= $jumlahL ?> </td>
										<td style="text-align: center;"><?= $jumlahP ?> </td>
									   <td style="text-align: center;"><?= $jumlahA ?> </td>
									   <td style="text-align: center;"><?= $jumlahLM ?> </td>
										<td style="text-align: center;"><?= $jumlahPM ?> </td>
									   <td style="text-align: center;"><?= $jumlahAM ?> </td>
                                        <td style="text-align: center;"><?= $jumlahLK ?> </td>
										<td style="text-align: center;"><?= $jumlahPK ?> </td>
									   <td style="text-align: center;"><?= $jumlahAK ?> </td>
									   <td style="text-align: center;"><?= $jumlahLA ?> </td>
										<td style="text-align: center;"><?= $jumlahPA ?> </td>
									   <td style="text-align: center;"><?= $jumlahAA ?> </td>
									    <td>-</td>
                                         </tr>
										 
							  <?php } ?>
							   <?php     
							   $totL = mysqli_num_rows(mysqli_query($koneksi,"SELECT * FROM siswa_rapor WHERE  jk='Laki-laki' AND mutasi='0' "));
							    $totP = mysqli_num_rows(mysqli_query($koneksi,"SELECT * FROM siswa_rapor WHERE  jk='Perempuan' AND mutasi='0' "));
							    $totA = mysqli_num_rows(mysqli_query($koneksi,"SELECT * FROM siswa_rapor WHERE  mutasi='0' "));
								$totLM = mysqli_num_rows(mysqli_query($koneksi,"SELECT * FROM siswa_rapor WHERE  jk='Laki-laki' AND mutasi='1' "));
							    $totPM = mysqli_num_rows(mysqli_query($koneksi,"SELECT * FROM siswa_rapor WHERE  jk='Perempuan' AND mutasi='1' "));
							    $totAM = mysqli_num_rows(mysqli_query($koneksi,"SELECT * FROM siswa_rapor WHERE  mutasi='1' "));
								$totLK = mysqli_num_rows(mysqli_query($koneksi,"SELECT * FROM siswa_rapor WHERE  jk='Laki-laki' AND mutasi='2' "));
							    $totPK = mysqli_num_rows(mysqli_query($koneksi,"SELECT * FROM siswa_rapor WHERE  jk='Perempuan' AND mutasi='2' "));
							    $totAK = mysqli_num_rows(mysqli_query($koneksi,"SELECT * FROM siswa_rapor WHERE  mutasi='2' "));
								$totLA = ($totL + $totLM)- $totLK;
                                $totPA = ($totP + $totPM)- $totPK;
                                $totAA = $totLA + $totPA;
								?>
							  <tr>
							  <td><b>Jumlah</b></td>
							  <td style="text-align: center;"><b><?= $totL ?></b> </td>
							  <td style="text-align: center;"><b><?= $totP ?></b> </td>
							  <td style="text-align: center;"><b><?= $totA ?></b> </td>
							  <td style="text-align: center;"><b><?= $totLM ?></b> </td>
							  <td style="text-align: center;"><b><?= $totPM ?></b> </td>
							  <td style="text-align: center;"><b><?= $totAM ?></b> </td>
							  <td style="text-align: center;"><b><?= $totLK ?></b> </td>
							  <td style="text-align: center;"><b><?= $totPK ?></b> </td>
							  <td style="text-align: center;"><b><?= $totAK ?></b> </td>
							  <td style="text-align: center;"><b><?= $totLA ?></b> </td>
							  <td style="text-align: center;"><b><?= $totPA ?></b> </td>
							  <td style="text-align: center;"><b><?= $totAA ?></b> </td>
							  <td>-</td>
							  </tr>
                            </tbody>
                        </table>
	
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
							Kepala Sekolah<br/>
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
