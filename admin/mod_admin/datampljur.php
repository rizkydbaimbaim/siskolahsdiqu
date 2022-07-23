<?php defined('BASEPATH') or die("ip anda sudah tercatat oleh sistem kami") ?>
<?php if ($ac == '') { ?>
<div class="section-header">
    <div class='row'>
        <div class='col-md-12'>
            <div class='box box-solid'>
                <div class='box-header with-border '>
                    <h3 class='box-title'><i class="fas fa-edit fa-fw   "></i> DATA JURNAL GURU MAPEL</h3>
                    <div class='box-tools pull-right'>
				   
		  </div>
         </div>
            <div class='box-body'>
                   <div class='table-responsive'>
                        <table style="font-size: 11px" id='tabelekstra' class='table table-bordered table-striped'>
                            <thead>
                            <tr>
                             <th width="3%" class="text-center">
                                    #
                                </th>
                                <th width="5%">Kelas</th>
                               <th>Mapel</th>
							   <th>Guru Mapel</th>
							
							<th width="5%">Jurnal</th>
							
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $query = mysqli_query($koneksi, "select * FROM jadwal_mapel");
                            $no = 0;
                            while ($walas = mysqli_fetch_array($query)) {
							$guru=fetch($koneksi,'pengawas',['id_pengawas' =>$walas['guru']]);
                                $no++;
                            ?>
                                <tr>
                                    <td><?= $no; ?></td>
									<td><?= $walas['kelas'] ?></td>
									<td><?= $walas['mapel'] ?></td>
									<td><?= $guru['nama'] ?></td>
                                    <td>
                                       <a href="?pg=datampljur&ac=cetak&id=<?= $walas['id_jadwal'] ?>" class="btn btn-sm btn-danger btn-rounded">
                                          <i class="fas fa-print"></i></button></a>                                        
										   </td>
										   
							   </tr>
								
                            <?php }
                            ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php } elseif ($ac == 'cetak') { ?>
    <?php 
	$id = $_GET['id'];
    $jadwalQ=fetch($koneksi,'jadwal_mapel',['id_jadwal'=>$id]);
	$kelas=$jadwalQ['kelas'];
	$kode=$jadwalQ['kode'];
	$guru=$jadwalQ['guru'];
	$user=fetch($koneksi,'pengawas',['id_pengawas' =>$jadwalQ['guru']]);
$jurnalQ = fetch($koneksi, 'jurnal', ['kelas' => $kelas, 'mapel' => $mapel, 'guru' =>$guru]);
$absen = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM absen_mapel WHERE tgl_absen='$agenda[tanggal]' 
AND guru='$guru' AND mapel='$mapel' AND kelas='$kelas' "));
$jumlah = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM siswa WHERE id_kelas='$kelas' "));
	?>
	<div class='row'>
        <div class='col-md-12'>
            <div class='box box-solid'>
                <div class='box-header with-border '>
                    <h3 class='box-title'><i class="fas fa-print fa-fw"></i> Jurnal Kelas <?= $jadwalQ['kelas'] ?> Mapel <?= $jadwalQ['kode'] ?></h3>
                     <div class='box-tools pull-right'>
				   <button class='btn btn-sm btn-flat btn-primary' onclick="frames['frameresult'].print()"><i class='fa fa-print'></i> Rekap Jurnal</button>
                    <a href='?pg=datampljur' class='btn btn-sm bg-maroon' title='Batal'><i class='fa fa-times'></i></a>
		  </div>
         </div>
                <div class='box-body'>
                      <div class="table-responsive">
                    <table style="font-size: 12px" class="table table-striped table-sm">
	                       <thead>
						     <tr>
	<th width='2%' style="text-align: center;">No</th>
	<th width='15%' style="text-align: center;">Hari, Tanggal</th>
	<th width='10%' style="text-align: center;">Jam Ke</th>
	<th style="text-align: center;">Bahasan Materi</th>
	<th style="text-align: center;">Hambatan</th>
	<th style="text-align: center;">Pemecahan</th>
	<th width='5%' style="text-align: center;">Kehadiran Siswa</th>
	</tr>
	 </thead>
	 <?php
	  $query = mysqli_query($koneksi, "select * from jurnal 
	 JOIN m_hari ON m_hari.inggris=jurnal.harix WHERE mapel='$kode' AND kelas='$kelas' AND guru='$guru' ORDER BY jurnal.id ASC");
      $no = 0;
       while ($jurnal = mysqli_fetch_array($query)) {
	  $tanggalmu=date('d-m-Y',strtotime($jurnal['tanggal']));
	  $hadir = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM absen_mapel WHERE mapel='$jurnal[mapel]' AND tgl_absen='$jurnal[tanggal]' 
	  AND guru='$jurnal[guru]' AND kelas='$jurnal[kelas]' AND ket='H'"));
	  $bagi=100/$jumlah;
	  $prosen=$bagi * $hadir;
       $no++;
	   
	   
	 ?>
     <tbody>
	 <tr>
	 <td style="text-align: center;"><?= $no ?></td>
	 <td style="text-align: center;"><?= $jurnal['hari'] ?>, <?= $tanggalmu ?></td>
	 <td style="text-align: center;"><?= $jurnal['ke'] ?></td>
	 <td><?= $jurnal['materi'] ?></td>
	 <td><?= $jurnal['hambatan'] ?></td>
	  <td><?= $jurnal['pemecahan'] ?></td>
	 <td style="text-align: center;"><?= round($prosen); ?>%</td>
	 
	 </tr>
	   <?php } ?>
	 </tbody>
	</table>
	</div>
                     </div>
            </div>
        </div>
  </div>
	
	
	<iframe id='loadframe' name='frameresult' src='mod_admin/cetakjurnal.php?id=<?= $id ?>' style='display:none'></iframe>
<?php } ?>