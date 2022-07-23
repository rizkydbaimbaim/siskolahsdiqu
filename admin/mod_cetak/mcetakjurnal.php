<?php
defined('APLIKASI') or exit('Anda tidak dizinkan mengakses langsung script ini!');
$id = $_POST['mapel'];
$jadwalQ=fetch($koneksi,'jadwal_mapel',['id_jadwal' =>$id]);
$mapel=$jadwalQ['kode'];
$kelas= $_POST['kelas'];
$guru=$jadwalQ['guru'];
$rapor=fetch($koneksi,'setting_rapor',['id' => 1]);
$user=fetch($koneksi,'pengawas',['id_pengawas' =>$_SESSION['id_pengawas']]);
$bl = date('m');
$bulane = fetch ($koneksi, 'bulan', ['bln' =>$bl]);
$jurnalx = fetch($koneksi, 'jurnal', ['kelas' => $kelas, 'mapel' => $mapel, 'guru'=>$guru]);
$jadwal=fetch($koneksi,'jadwal_mapel',['kelas' => $kelas, 'kode' => $mapel, 'guru'=>$guru]);
$absen = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM absen_mapel WHERE tgl_absen='$jurnalx[tanggal]' 
AND guru='$guru' AND mapel='$mapel' AND kelas='$kelas' "));
$jumlah = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM siswa WHERE id_kelas='$kelas' "));
?>

<div class='row'>
    
  <div class='col-md-12'>
            <div class='box box-solid'>
                <div class='box-header with-border '>
                    <h3 class='box-title'><i class="fas fa-print fa-fw   "></i> Jurnal <?= $mapel ?> Kelas <?= $kelas ?></h3>
                    <div class='box-tools pull-right'>
				   <button class='btn btn-sm btn-flat btn-primary' onclick="frames['frameresult'].print()"><i class='fa fa-print'></i> Rekap Jurnal</button>
                    <a href='?pg=jurnal' class='btn btn-sm bg-maroon' title='Batal'><i class='fa fa-times'></i></a>
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
	<th>Materi</th>
	<th >Indikator</th>
	<th width='10%' style="text-align: center;">Pencapaian</th>
	<th width='5%' style="text-align: center;">Kehadiran Siswa</th>
	</tr>
	 </thead>
	 <?php
	  $query = mysqli_query($koneksi, "select * from jurnal 
	 JOIN m_hari ON m_hari.inggris=jurnal.harix WHERE jurnal.mapel='$mapel' ORDER BY jurnal.id ASC");
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
	 <td style="text-align: center;"><?= $jadwal['dari'] ?> - <?= $jadwal['sampai'] ?></td>
	 <td style="text-align: center;"><?= $jurnal['ke'] ?></td>
	 <td style="text-align: center;"><?= $jurnal['kikd'] ?></td>
	 <td><?= $jurnal['materi'] ?></td>
	 <td><?= $jurnal['indikator'] ?></td>
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

<iframe id='loadframe' name='frameresult' src='mod_cetak/cetakjurnal.php?id=<?= $id ?>&kelas=<?= $kelas ?>' style='display:none'></iframe>