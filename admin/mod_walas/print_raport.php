<?php ob_start();
error_reporting(0);
require("../../config/config.database.php");
require("../../config/config.function.php");
require("../../config/functions.crud.php");

session_start();
if (!isset($_SESSION['id_pengawas'])) {
    die('Anda tidak diijinkan mengakses langsung');
}
$user = mysqli_fetch_array(mysqli_query($koneksi, "select * from pengawas where id_pengawas='$_SESSION[id_pengawas]'"));

$ids=$_GET['nis'];

$seting = fetch($koneksi, 'setting', ['id_setting' => 1]);
$siswa = fetch($koneksi, 'siswa_rapor', ['nis' => $ids]);
$klas=$siswa['kelas'];
$rapor=fetch($koneksi,'setting_rapor',['id' => 1]);
	if($rapor['semester']=='1'){
{$smt="(Satu)";}
}elseif($rapor['semester']=='2'){
{$smt="(Dua)";}
}
$ma = fetch($koneksi, 'spiritual', ['niss' => $ids]);	
$ceklis=$ma['pred'];
	if($ceklis=='A'){
{$grades="Sangat Baik";}
}elseif($ceklis=='B'){
{$grades="Baik";}
}elseif($ceklis=='C'){
{$grades="Cukup";}
}elseif($ceklis=='D'){
{$grades="Kurang";}
}
$mas = fetch($koneksi, 'sosial', ['niss' => $ids]);
$cek=$mas['pred'];
if($cek=='A'){
{$gra="Sangat Baik";}
}elseif($cek=='B'){
{$gra="Baik";}
}elseif($cek=='C'){
{$gra="Cukup";}
}elseif($cek=='D'){
{$gra="Kurang";}
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>

    <title>Raport_<?= $siswa['nama'] ?></title>
<link rel="stylesheet" href="../../plugins/bootstrap/dist/css/bootstrap.min.css">
</head>

<body style="font-size: 12px;">
    
   
    <center>
        <h5>PENCAPAIAN KOMPETENSI PESERTA DIDIK</h5>
    </center>
    <br>
    
    <div class="col-md-14">
	
        <table style="margin-left: 10px;margin-right:10px"  width="100%">
            <tr>
                <td width="15%">Nama Sekolah</td>
                <td width="1%">:</td>
				<td width="40%"><?= $setting['sekolah'] ?></td>
				<td></td>
				<td width="17%">Kelas</td>
                <td width="1%">:</td>
				<td width="20%"><?= $siswa['kelas'] ?></td>
            </tr>
            <tr>
                <td >Alamat</td>
                <td>:</td>
				<td><?= $setting['alamat'] ?> </td>
				<td></td>
				<td>Semester</td>
                <td>:</td>
				<td><?= $rapor['semester'] ?> <?= $smt ?></td>
            </tr>
			<tr>
                <td>Nama</td>
                <td>:</td>
				<td><?= $siswa['nama'] ?></td>
				<td></td>
				<td>Tahun Pelajaran</td>
                <td>:</td>
				<td><?= $rapor['tp'] ?></td>
            </tr>
			<tr>
                <td>N I S</td>
                <td>:</td>
				<td><?= $siswa['nis'] ?></td>
				<td></td>
				<td>N I S N</td>
                <td>:</td>
				<td><?= $siswa['nisn'] ?></td>
            </tr>
        </table>
       
        <br>
 <b>A. SIKAP</b><p></p>
    <b>1. Sikap Spiritual</b>
            <table style="margin-left: 10px;margin-right:10px;" border ="1" width="100%">
                <thead>
                    <tr>
                        <th width="20%"><center>Predikat</center></th>
                        <th><center>Deskripsi</center></th>
                       
                    </tr>
                </thead>
                <tbody>
				 <?php if ($ma['niss'] <> '') { ?>
                    <tr>
                        <td height="30"><center> <?= $ma['pred'] ?> ( <?= $grades ?> )</center></td>
                  <td>Selalu <?= $ma['keter'] ?> dan sikap <?= $ma['keter2'] ?> mulai berkembang</td>
				  </tr>
				   <?php } ?>
                </tbody>
            </table>
            <b>2. Sikap Sosial</b>
            <table style="margin-left: 10px;margin-right:10px;" border ="1" width="100%">
                <thead>
                    <tr>
                        <th width="20%"><center>Predikat</center></th>
                        <th><center>Deskripsi</center></th>
                       
                    </tr>
                </thead>
                <tbody>
				 <?php if ($mas['niss'] <> '') { ?>
                    <tr>
                     <td height="30"><center> <?= $mas['pred'] ?> ( <?= $gra ?> )</center></td>
                  <td>Selalu menunjukan <?= $mas['keter'] ?> sedangkan sikap <?= $mas['keter2'] ?> mengalami peningkatan</td>
				  </tr>
				    <?php } ?>
                </tbody>
            </table>
            <br>
			
			 <b>B. PENGETAHUAN</b>
			
            <table style="margin-left: 10px;margin-right:10px;" border ="1" width="100%">
                <thead>
                    <tr>
                       <th width="2%"><center>No</center></th>
                        <th width="32%"><center>Mata Pelajaran</center></th>
                       <th width="2%"><center>KKM</center></th>
					   <th width="2%"><center>Nilai</center></th>
					   <th width="2%"><center>Pred</center></th>
					   <th width="60%"><center>Deskripsi</center></th>
                    </tr>
                </thead>
                <tbody>
                    
                        <?php
                        $q1 = mysqli_query($koneksi, "SELECT * FROM mapel_rapor WHERE kelas_r='$klas' group by kelompok order by kelompok");
                        $no = 0;
                        while ($kelompok = mysqli_fetch_array($q1)) {

                            $query = mysqli_query($koneksi, "SELECT * FROM mapel_rapor where kelompok='$kelompok[kelompok]'  AND kelas_r='$klas' order by urut ");
                          
                        ?>
                            <tr>
                                <td colspan="6"><?= $kelompok['kelompok'] ?></td>
                            </tr>
                           
							<?php
							while ($mapel = mysqli_fetch_array($query)) {
	$rentang=round(100-$mapel['kkm'])/3;		
    $predD=round($mapel['kkm']-1);
   $nilC1=round($mapel['kkm']);
	$nilC2=round($rentang)+($mapel['kkm']);				 
	$nilB1=round($nilC2+1);
	$nilB2=round($nilC2)+round($rentang);
	$nilA1=round($nilB2+1);
	$nilA2=round($nilB2)+round($rentang);			
								
					$n1 = mysqli_query($koneksi, "SELECT AVG(nilai) AS rata FROM nilai_ph 
					JOIN mapel_rapor ON mapel_rapor.kode=nilai_ph.mapel WHERE  mapel_rapor.kelas_r='$klas' AND nilai_ph.mapel= '$mapel[kode]' AND nilai_ph.nis='$siswa[nis]' AND nilai_ph.nilai>'0'  ");
                        while ($kl = mysqli_fetch_array($n1)) {
						$rerata=$kl['rata'];
if($rerata<=$predD){
{$predikat="D";}
}elseif($rerata>=$nilC1 && $rerata<=$nilC2){
{$predikat="C";}
}elseif($rerata>=$nilB1 && $rerata<=$nilB2){
{$predikat="B";}
}elseif($rerata>=$nilA1 && $rerata<=$nilA2){
{$predikat="A";}
}	
		if($predikat=='A'){
{$edis="sangat Baik";}
}elseif($predikat=='B'){
{$edis="baik";}
}elseif($predikat=='C'){
{$edis="cukup";}
}elseif($predikat=='D'){
{$edis="kurang";}
}		
			
			$queryx = mysqli_query($koneksi, "select mapel,nis,MIN(nilai) as mini,MAX(nilai) as mak
				 from nilai_ph WHERE nis='$ids' AND nilai>'0'  AND ket<>'PTS'  AND ket<>'PAT' AND mapel= '$mapel[kode]'");				
				while ($ade = mysqli_fetch_array($queryx)) {			
  
$max   = $ade['mak'];
$min   = $ade['mini'];		

	$pos = fetch($koneksi, 'nilai_ph', ['nilai' => $max,'mapel' => $mapel['kode'],'nis' =>$ids]);	
	$posisi=substr($pos['ket'],2);
		$desmax = fetch($koneksi, 'deskripsi_3', ['kodek' => $posisi,'mapel' => $mapel['kode'],'kelas' =>$klas]);	
		
		$pose = fetch($koneksi, 'nilai_ph', ['nilai' => $min,'mapel' => $mapel['kode'],'nis' =>$ids]);	
	$posisin=substr($pose['ket'],2);
		$desmin = fetch($koneksi, 'deskripsi_3', ['kodek' => $posisin,'mapel' => $mapel['kode'],'kelas' =>$klas]);	
		 
 
							 $no++;
		?>
		
                                <tr>
                                     <td> <?= $no ?></td>
                  <td><?= $mapel['namamapel'] ?> </td>
				  <td><center><?= $mapel['kkm'] ?></center> </td>
				  <td><center><?= round($rerata) ?></center> </td>
				  <td><center><?= $predikat ?></center></td>
				  <td>Memiliki kemampuan <?= $edis ?> dalam <?= $desmax['deskripsi'] ?>,perlu dimaksimalkan kemampuan dalam <?= $desmin['deskripsi'] ?></td>
				  </tr>
				
						<?php } } }}?>	
                        
                   
                </tbody>
            </table>
            <br>
      
      <b>C. KETERAMPILAN</b>
			
            <table style="margin-left: 10px;margin-right:10px;" border ="1" width="100%">
                <thead>
                    <tr>
                       <th width="2%"><center>No</center></th>
                        <th width="32%"><center>Mata Pelajaran</center></th>
                       <th width="2%"><center>KKM</center></th>
					   <th width="2%"><center>Nilai</center></th>
					   <th width="2%"><center>Pred</center></th>
					   <th width="60%"><center>Deskripsi</center></th>
                    </tr>
                </thead>
                <tbody>
                    
                        <?php
                       $q1 = mysqli_query($koneksi, "SELECT * FROM mapel_rapor WHERE kelas_r='$klas' group by kelompok order by kelompok");
                        
                        $no = 0;
                        while ($kelompok = mysqli_fetch_array($q1)) {

                            $query = mysqli_query($koneksi, "SELECT * FROM mapel_rapor where kelompok='$kelompok[kelompok]'  AND kelas_r='$klas' order by urut ");
                        
                        ?>
                            <tr>
                                <td colspan="6"><?= $kelompok['kelompok'] ?></td>
                            </tr>
                           
							<?php
							while ($mapel = mysqli_fetch_array($query)) {
	$rentang=round(100-$mapel['kkm'])/3;		
    $predD=round($mapel['kkm']-1);
   $nilC1=round($mapel['kkm']);
	$nilC2=round($rentang)+($mapel['kkm']);				 
	$nilB1=round($nilC2+1);
	$nilB2=round($nilC2)+round($rentang);
	$nilA1=round($nilB2+1);
	$nilA2=round($nilB2)+round($rentang);			
								
					$n1 = mysqli_query($koneksi, "SELECT AVG(nilai) AS rata FROM nilai_kh 
					JOIN mapel_rapor ON mapel_rapor.kode=nilai_kh.mapel WHERE  mapel_rapor.kelas_r='$klas' AND nilai_kh.mapel= '$mapel[kode]' AND nilai_kh.nis='$siswa[nis]' AND nilai_kh.nilai>'0'  ");
                        while ($kl = mysqli_fetch_array($n1)) {
						$rerata=$kl['rata'];
if($rerata<=$predD){
{$predikat="D";}
}elseif($rerata>=$nilC1 && $rerata<=$nilC2){
{$predikat="C";}
}elseif($rerata>=$nilB1 && $rerata<=$nilB2){
{$predikat="B";}
}elseif($rerata>=$nilA1 && $rerata<=$nilA2){
{$predikat="A";}
}	
		if($predikat=='A'){
{$edis="sangat Baik";}
}elseif($predikat=='B'){
{$edis="baik";}
}elseif($predikat=='C'){
{$edis="cukup";}
}elseif($predikat=='D'){
{$edis="kurang";}
}		
			
			$queryx = mysqli_query($koneksi, "select mapel,nis,MIN(nilai) as mini,MAX(nilai) as mak
				 from nilai_kh WHERE nis='$ids' AND nilai>'0'  AND ket<>'PTS'  AND ket<>'PAT' AND mapel= '$mapel[kode]'");				
				while ($ade = mysqli_fetch_array($queryx)) {			
  
$max   = $ade['mak'];
$min   = $ade['mini'];		

	$pos = fetch($koneksi, 'nilai_kh', ['nilai' => $max,'mapel' => $mapel['kode'],'nis' =>$ids]);	
	$posisi=substr($pos['ket'],2);
		$desmax = fetch($koneksi, 'deskripsi_4', ['kodek' => $posisi,'mapel' => $mapel['kode'],'kelas' =>$klas]);	
		
		$pose = fetch($koneksi, 'nilai_kh', ['nilai' => $min,'mapel' => $mapel['kode'],'nis' =>$ids]);	
	$posisin=substr($pose['ket'],2);
		$desmin = fetch($koneksi, 'deskripsi_4', ['kodek' => $posisin,'mapel' => $mapel['kode'],'kelas' =>$klas]);	
		 
 
							 $no++;
							 
			  ?>
                                <tr>
                                     <td> <?= $no ?> </td>
                  <td><?= $mapel['namamapel'] ?> </td>
				  <td><center><?= $mapel['kkm'] ?></center> </td>
				  <td><center><?= round($rerata) ?></center> </td>
				  <td><center><?= $predikat ?></center></td>
				  <td>Memiliki keterampilan <?= $edis2 ?> dalam <?= $desmax['deskripsi'] ?>, perlu dimaksimalkan keterampilan dalam <?= $desmin['deskripsi'] ?></td>
				  </tr>
				
					<?php } }} }  ?>	
                </tbody>
            </table>
            <br>
			<b>D. EKSTRAKURIKULER</b>
			
            <table style="margin-left: 10px;margin-right:10px;" border ="1" width="100%">
                <thead>
                    <tr>
                       <th width="2%"><center>No</center></th>
                        <th width="36%"><center>Kegiatan Ekstrakurikuler</center></th>
                       <th width="2%"><center>Nilai</center></th>
					   <th width="57%"><center>Keterangan</center></th>
					
                    </tr>
                </thead>
                <tbody>
				<?php
							$no=0;
							 $queryx = mysqli_query($koneksi, "select * from eskul WHERE nis='$ids'");
                                 while ($esk = mysqli_fetch_array($queryx)) {
									 $no++;
									 ?>
				<tr>
				<td><?= $no ?> </td>
				<td><?= $esk['ekstra'] ?> </td>
				<td><center><?= $esk['nilai'] ?></center></td>
				<td><?= $esk['ket'] ?>  </td>
				</tr>
				<?php } ?>
				</tr>
				
				<tr>
				<td>-</td>
				<td>-</td>
				<td>-</td>
				<td>-</td>
				</tr>
	</tbody>
            </table>
            <br>
			<b>E. PRESTASI</b>
			
            <table style="margin-left: 10px;margin-right:10px;" border ="1" width="100%">
                <thead>
                    <tr>
                       <th width="2%"><center>No</center></th>
                        <th width="42%"><center>Jenis Prestasi</center></th>
                       <th width="56%"><center>Keterangan</center></th>
					  
                    </tr>
                </thead>
                <tbody>
				<?php
							$no=0;
							 $queryx = mysqli_query($koneksi, "select * from prestasi WHERE nis='$ids'");
                                 while ($pres = mysqli_fetch_array($queryx)) {
									 $no++;
									 ?>
				<tr>
				<td><?= $no ?> </td>
				<td><?= $pres['pres'] ?> </td>
				<td> <?= $pres['ket'] ?></td>
				
				</tr>
				<?php } ?>
				<tr>
				<td>-</td>
				<td>-</td>
				<td>-</td>
				
				</tr>
	</tbody>
            </table>
            <br>
<b>F. KETIDAKHADIRAN</b>
			
            <table style="margin-left: 10px;margin-right:10px;" border ="1" width="70%">
                
				<tr>
				<td width="50%">Sakit </td>
				<td> <?= $siswa['sakit'] ?></td>
				</tr>
				<tr>
				<td>Izin </td>
				<td> <?= $siswa['izin'] ?></td>
				</tr>
				<tr>
				<td>Tanpa Keterangan </td>
				<td> <?= $siswa['alpha'] ?></td>
				</tr>
	
            </table>
            <br>
			 
			<b>G. CATATAN WALI KELAS</b>
			
            <table style="margin-left: 10px;margin-right:10px;" border ="1" width="100%">
                
				<tr>
				<td height="40"><?= $siswa['catatan'] ?></td>
				
				</tr>
				
            </table>
            <br>
			
			<b>H. TANGGAPAN ORANG TUA / WALI</b>
			
            <table style="margin-left: 10px;margin-right:10px;" border ="1" width="100%">
                
				<tr>
				<td height="60"></td>
				
				</tr>
				
            </table>
            <br>
			<?php if($rapor['semester']==2){ ?>
       <table style="margin-left: 10px;margin-right:10px;" border ="1" width="50%">
                
				<tr>
				<td height="30">Berdasarkan pencapaian kompetensi pada semester ke-1<br>
				         dan ke-2, peserta didik ditetapkan *)<br>naik ke kelas <b><?= $siswa['kelas'] + 1 ?></b>
						 <br><s><b>tinggal di kelas  <?= $siswa['kelas'] ?></b></s><br>*)Coret yang tidak perlu.					
                     </td>
				</tr>
            </table>
			
		<br>
		<?php } ?>
       <table width="100%">
		<tr>
               <td style="text-align: center" width="33%"></td>
                 <td style="text-align: center" width="33%"></td>
                <td style="text-align: center"><?= $setting['kecamatan'] ?>, <?= $rapor['tanggal'] ?></td>
            </tr>
			</table>
			<table width="100%">
            <tr style="text-align: center">
                <td>Mengetahui  :</td>
			<td>Mengetahui  :</td>
				 <td>Wali Kelas <?= $siswa['kelas'] ?></td>
            </tr>
			
		<tr>
               <td style="text-align: center" width="33.3%">Orang Tua/Wali</td>
                 <td style="text-align: center" width="33.3%"> Kepala Sekolah</td>
                <td style="text-align: center" width="33.3%"></td>
            </tr>
			</table>
			
			<br><br><br>
			
			<table width="100%">
		<tr>
               <td style="text-align: center" width="33.3%">______________</td>
                 <td style="text-align: center" width="33.3%"> <?= $setting['kepsek'] ?></td>
                <td style="text-align: center" width="33.3%"><?= $user['nama'] ?></td>
            </tr>
			<tr>
               <td style="text-align: center" width="33.3%"></td>
                 <td style="text-align: center" width="33.3%"> NIP. <?= $setting['nip'] ?></td>
				 
                <td style="text-align: center" width="33.3%">NIP. <?= $user['nip'] ?></td>
				 
            </tr>
			
			</table>
    </div>
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