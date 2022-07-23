<?php defined('BASEPATH') or die("ip anda sudah tercatat oleh sistem kami") ?>
<?php if ($ac == '') { ?>
<div class="section-header">
    <div class='row'>
        <div class='col-md-12'>
            <div class='box box-solid'>
                <div class='box-header with-border '>
                    <h3 class='box-title'><i class="fas fa-edit fa-fw   "></i> DATA AGENDA GURU MAPEL</h3>
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
							
							<th width="5%">Agenda</th>
							
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $query = mysqli_query($koneksi, "select * FROM jadwal_mapel");
                            $no = 0;
                            while ($jadwal = mysqli_fetch_array($query)) {
							$guru=fetch($koneksi,'pengawas',['id_pengawas' =>$jadwal['guru']]);
                                $no++;
                            ?>
                                <tr>
                                    <td><?= $no; ?></td>
									<td><?= $jadwal['kelas'] ?></td>
									<td><?= $jadwal['mapel'] ?></td>
									<td><?= $guru['nama'] ?></td>
                                    <td>
                                       <a href="?pg=datamplag&ac=cetak&id=<?= $jadwal['id_jadwal'] ?>" class="btn btn-sm btn-danger btn-rounded">
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
$agendaQ = fetch($koneksi, 'agenda', ['kelas' => $kelas, 'mapel' => $mapel, 'guru' =>$guru]);
$absen = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM absen_mapel WHERE tgl_absen='$agendaQ[tanggal]' 
AND guru='$guru' AND mapel='$mapel' AND kelas='$kelas' "));
$jumlah = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM siswa WHERE id_kelas='$kelas' "));
	?>
	<div class='row'>
        <div class='col-md-12'>
            <div class='box box-solid'>
                <div class='box-header with-border '>
                    <h3 class='box-title'><i class="fas fa-print fa-fw"></i> Agenda Kelas <?= $jadwalQ['kelas'] ?> Mapel <?= $jadwalQ['kode'] ?></h3>
                     <div class='box-tools pull-right'>
				   <button class='btn btn-sm btn-flat btn-primary' onclick="frames['frameresult'].print()"><i class='fa fa-print'></i> Rekap Agenda</button>
                    <a href='?pg=datamplag' class='btn btn-sm bg-maroon' title='Batal'><i class='fa fa-times'></i></a>
		  </div>
         </div>
                <div class='box-body'>
                      <div class="table-responsive">
                    <table style="font-size: 12px" class="table table-striped table-sm">
	                       <thead>
      <tr>
	<th width='2%' style="text-align: center;">No</th>
	<th width='15%' style="text-align: center;">Hari, Tanggal</th>
	<th width='10%' style="text-align: center;">Jam Pelajaran</th>
	<th width='5%' style="text-align: center;">Pertemuan Ke</th>
	<th width='5%' style="text-align: center;">Nomor KI/KD</th>
	<th style="text-align: center;">Materi</th>
	<th style="text-align: center;">Indikator</th>
	<th width='10%' style="text-align: center;">Pencapaian</th>
	<th width='5%' style="text-align: center;">Kehadiran Siswa</th>
	</tr>
	 </thead>
	 <?php
	  $query = mysqli_query($koneksi, "select * from agenda 
	 JOIN m_hari ON m_hari.inggris=agenda.harix WHERE mapel='$kode' AND kelas='$kelas' AND guru='$guru' ORDER BY agenda.id ASC");
      $no = 0;
       while ($agenda = mysqli_fetch_array($query)) {
	  $tanggalmu=date('d-m-Y',strtotime($agenda['tanggal']));
	  $hadir = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM absen_mapel WHERE mapel='$agenda[mapel]' AND tgl_absen='$agenda[tanggal]' 
	  AND guru='$agenda[guru]' AND kelas='$agenda[kelas]' AND ket='H'"));
	  $bagi=100/$jumlah;
	  $prosen=$bagi * $hadir;
       $no++;
	   
	   
	 ?>
     <tbody>
	 <tr>
	 <td style="text-align: center;"><?= $no ?></td>
	 <td style="text-align: center;"><?= $agenda['hari'] ?>, <?= $tanggalmu ?></td>
	 <td style="text-align: center;"><?= $jadwalQ['dari'] ?> - <?= $jadwalQ['sampai'] ?></td>
	 <td style="text-align: center;"><?= $agenda['ke'] ?></td>
	 <td style="text-align: center;"><?= $agenda['kikd'] ?></td>
	 <td><?= $agenda['materi'] ?></td>
	 <td><?= $agenda['indikator'] ?></td>
	 <td style="text-align: center;">
	 <?php if($prosen>=50){ ?>
	 Tercapai
	 <?php } ?>
	  <?php if($prosen<50){ ?>
	 Tidak Tercapai
	 <?php } ?>
	 </td>
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
	
	
	<iframe id='loadframe' name='frameresult' src='mod_admin/cetakagenda.php?id=<?= $id ?>' style='display:none'></iframe>
<?php } ?>