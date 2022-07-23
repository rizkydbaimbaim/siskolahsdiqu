<?php defined('BASEPATH') or die("ip anda sudah tercatat oleh sistem kami") ?>
<?php if ($ac == '') { ?>
    <div class='col-md-12'>
        <div class='box box-solid' style='background-color:aqua'>
            <div class='box-header with-border'>
                <h3 class='box-title'><i class="fas fa-university "></i> PENILAIAN HARIAN KELAS</h3>
            </div><!-- /.box-header -->
            <div class='box-body' style='background-color:#000'>

                <?php
                $kelasQ = mysqli_query($koneksi, "SELECT * FROM siswa GROUP BY id_kelas");
              while ($kelas = mysqli_fetch_array($kelasQ)){
			   $wali = fetch($koneksi,'pengawas',['jabatan' => $kelas['id_kelas']]);
			   
                ?>
                            <div class="col-md-4">
                                <div class="box box-widget widget-user-2">
                                    <!-- Add the bg color to the header using any of the bg-* classes -->
                                    <div class="widget-user-header bg-aqua" style="padding: 6px">
                                        <div class="widget-user-image">
                                            <img src="../dist/img/avatar-6.png" alt="">
                                        </div>
                                        
                                        <span style="font-size: 20px"> <b>
                                             KELAS  <?= $kelas['id_kelas'] ?>
                                            </b></span>
                                    </div>
                                                                            <?php
                $mapelQ = mysqli_query($koneksi, "SELECT * FROM jadwal_mapel WHERE kelas='$kelas[id_kelas]' ORDER BY urut ASC");
              while ($mapel = mysqli_fetch_array($mapelQ)){
				  $user = fetch($koneksi,'pengawas',['id_pengawas' =>$mapel['guru']]);
				   ?>
                                    <div class="box-footer no-padding">
									<ul class="nav nav-stacked">
                                            
                                        <li>
                                               
                                                    <a href="#">
                                                     <i class='fas fa-user'></i> Nama Guru
                                                    <span class="pull-right badge bg-black"><?= $user['nama'] ?></span>
                                                    </a>
                                                
                                            </li>
                                            <li>                                        
                                                    <a href="?pg=mbs_cetakph&ac=cetak3&id=<?= $mapel['id_jadwal'] ?>">
                                                     <i class='fas fa-print'></i><b style="color:blue;"> CETAK PENILAIAN KI-3</b>
                                                    <span class="pull-right badge bg-blue">Mapel <?= $mapel['kode'] ?></span>
                                                    </a>                                                
                                            </li>
											<li>                                        
                                                    <a href="?pg=mbs_cetakph&ac=cetak4&id=<?= $mapel['id_jadwal'] ?>">
                                                     <i class='fas fa-print'></i><b style="color:red;"> CETAK PENILAIAN KI-4</b>
                                                    <span class="pull-right badge bg-red">Mapel <?= $mapel['kode'] ?></span>
                                                    </a>                                                
                                            </li>
                                        </ul>
                                     
                                    </div>
										 <?php } ?>
                                </div>
                               
                            </div>
                       
                 
			  <?php } ?>

            </div>
        </div>
    </div>
<?php } elseif ($ac == 'cetak3') { ?>
    <?php 
	$id = $_GET['id'];
$jadwal=fetch($koneksi,'jadwal_mapel',['id_jadwal' =>$id]);
$mapel=$jadwal['kode'];
$guru = $jadwal['guru'];
$kelas= $jadwal['kelas'];
   
	?>
	
	<div class='row'>
        <div class='col-md-12'>
            <div class='box box-solid'>
                <div class='box-header with-border '>
                    <h3 class='box-title'><i class="fas fa-print fa-fw"></i> Nilai (KI-3) <?= $mapel ?> Kelas <?= $kelas ?> </h3>
                     <div class='box-tools pull-right'>
				   <button class='btn btn-sm btn-flat btn-primary' onclick="frames['frameresultKI3'].print()"><i class='fa fa-print'></i> Cetak Nilai</button>
                    <a href='?pg=mbs_cetakph' class='btn btn-sm bg-maroon' title='Batal'><i class='fa fa-times'></i></a>
		  </div>
         </div>
                <div class='box-body'>
                      <div class="table-responsive">
                   <table class="table table-sm table-bordered">
	
	 <thead>
      <tr>
	<th width='2%' style="text-align: center;">No</th>
	<th style="text-align: center;">Nama Siswa</th>
	 <?php
			$querys = mysqli_query($koneksi,"select * from kode WHERE ket='1' AND mapel='$mapel' GROUP BY kd");
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
			WHERE idsiswa='$siswa[id_siswa]' AND ki='KI3' AND nilai_harian.mapel='$mapel' GROUP  BY kode.kd ");
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
			  <?php }  } ?>
	 </tr>
	  
	 </tbody>
	</table>
	   </div>
                     </div>
            </div>
        </div>
  </div>
	
	
<iframe id='loadframe' name='frameresultKI3' src='mod_mbs/cetakrekapph.php?id=<?= $id ?>' style='display:none'></iframe>


<?php } elseif ($ac == 'cetak4') { ?>
    <?php 
	$id = $_GET['id'];
$jadwal=fetch($koneksi,'jadwal_mapel',['id_jadwal' =>$id]);
$mapel=$jadwal['kode'];
$guru = $jadwal['guru'];
$kelas= $jadwal['kelas'];
   
	?>
	
	<div class='row'>
        <div class='col-md-12'>
            <div class='box box-solid'>
                <div class='box-header with-border '>
                    <h3 class='box-title'><i class="fas fa-print fa-fw"></i> Nilai (KI-4) <?= $mapel ?>  Kelas <?= $kelas ?> </h3>
                     <div class='box-tools pull-right'>
				   <button class='btn btn-sm btn-flat btn-primary' onclick="frames['frameresultKI4'].print()"><i class='fa fa-print'></i> Cetak Nilai</button>
                    <a href='?pg=mbs_cetakph' class='btn btn-sm bg-maroon' title='Batal'><i class='fa fa-times'></i></a>
		  </div>
         </div>
                <div class='box-body'>
                      <div class="table-responsive">
                   <table class="table table-sm table-bordered">
	
	 <thead>
      <tr>
	<th width='2%' style="text-align: center;">No</th>
	<th style="text-align: center;">Nama Siswa</th>
	 <?php
			$querys = mysqli_query($koneksi,"select * from kode WHERE ket='2' AND mapel='$mapel' GROUP BY kd");
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
			WHERE idsiswa='$siswa[id_siswa]' AND ki='KI4' AND nilai_harian.mapel='$mapel' GROUP  BY kode.kd ");
              while ($nilai = mysqli_fetch_array($queryxx)) {
		 
			?>
	
     	<td style="text-align: center;"><?= round($nilai['nkd'],2) ?></td>
			 <?php } ?>
			  <?php
			$queryxr = mysqli_query($koneksi,"select AVG(nilai) AS rata from nilai_harian 
			JOIN kode ON kode.kd=nilai_harian.kd
			WHERE idsiswa='$siswa[id_siswa]'  AND kode.ket='2' AND nilai_harian.mapel='$mapel' GROUP  BY nilai_harian.idsiswa ");
              while ($rata = mysqli_fetch_array($queryxr)) {
		 
			?>
			 <td style="text-align: center;"><?= round($rata['rata'],0) ?></td>
			  <?php }  } ?>
	 </tr>
	  
	 </tbody>
	</table>
	   </div>
                     </div>
            </div>
        </div>
  </div>
	<iframe id='loadframe' name='frameresultKI4' src='mod_mbs/cetakrekapkh.php?id=<?= $id ?>' style='display:none'></iframe>
<?php } ?>