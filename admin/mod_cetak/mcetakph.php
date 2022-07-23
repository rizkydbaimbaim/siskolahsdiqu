<?php
defined('APLIKASI') or exit('Anda tidak dizinkan mengakses langsung script ini!');
$ket = $_POST['ki'];
$id = $_POST['mapel'];
$jadwal=fetch($koneksi,'jadwal_mapel',['id_jadwal' =>$id]);
$mapel=$jadwal['kode'];
$kelas= $_POST['kelas'];
$guru=$jadwal['guru'];
if($ket=='1'){
{$grade="KI3";}
}elseif($ket=='2'){
{$grade="KI4";}
}


$rapor=fetch($koneksi,'setting_rapor',['id' => 1]);
$user=fetch($koneksi,'pengawas',['id_pengawas' =>$_SESSION['id_pengawas']]);
$bl = date('m');
$bulane = fetch ($koneksi, 'bulan', ['bln' =>$bl]);

?>

<div class='row'>
    <div class='col-md-12'></div>
  <div class='col-md-12'>
            <div class='box box-solid'>
                <div class='box-header with-border '>
                    <h3 class='box-title'><i class="fas fa-print fa-fw   "></i> Penilaian Harian <?= $mapel ?> (<?= $grade ?>) Kelas <?= $kelas ?></h3>
                    <div class='box-tools pull-right'>
				   <button class='btn btn-sm btn-flat btn-primary' onclick="frames['frameresult'].print()"><i class='fa fa-print'></i> Rekap PH</button>
                    <a href='?pg=dataph' class='btn btn-sm bg-maroon' title='Batal'><i class='fa fa-times'></i></a>
		  </div>
         </div>
            <div class='box-body'>
                <div class="table-responsive">
                    <table style="font-size: 12px" class="table table-striped table-sm">
                     
	 <thead>
      <tr>
	<th width='2%' style="text-align: center;">No</th>
	<th>Nama Siswa</th>
	 <?php
			$querys = mysqli_query($koneksi,"select * from kode WHERE ket='$ket' AND mapel='$mapel' GROUP BY kd");
              while ($kd = mysqli_fetch_array($querys)) {
			?>
			<th width='5%' style="text-align: center;"><?= $kd['kd'] ?></th>
			  <?php } ?>
			  <th width='5%' style="text-align: center;">NR</th>
	</tr>
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
			WHERE idsiswa='$siswa[id_siswa]'  AND kode.ket='1' AND nilai_harian.mapel='$mapel' GROUP  BY nilai_harian.idsiswa ");
              while ($rata = mysqli_fetch_array($queryxr)) {
		 
			?>
			 <td style="text-align: center;"><?= round($rata['rata'],0) ?></td>
			  <?php }   ?>
	 </tr>
	   <?php } ?>
	 </tbody>
	</table>
        </div>
		</div>
			</div>
				</div>
                    </div>

<iframe id='loadframe' name='frameresult' src='mod_cetak/cetakrekapph.php?id=<?= $id ?>&kelas=<?= $kelas ?>&ki=<?= $ket?>' style='display:none'></iframe>