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
$agendax = fetch($koneksi, 'agenda', ['kelas' => $kelas, 'mapel' => $mapel, 'guru'=>$guru]);
$jadwal=fetch($koneksi,'jadwal_mapel',['kelas' => $kelas, 'kode' => $mapel, 'guru'=>$guru]);
$absen = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM absen_mapel WHERE tgl_absen='$agendax[tanggal]' 
AND guru='$guru' AND mapel='$mapel' AND kelas='$kelas' "));
$jumlah = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM siswa WHERE id_kelas='$kelas' "));
?>

<div class='row'>
  
  <div class='col-md-12'>
            <div class='box box-solid'>
                <div class='box-header with-border '>
                    <h3 class='box-title'><i class="fas fa-print fa-fw   "></i> Agenda <?= $mapel ?> Kelas <?= $kelas ?></h3>
                    <div class='box-tools pull-right'>
				   <button class='btn btn-sm btn-flat btn-primary' onclick="frames['frameresult'].print()"><i class='fa fa-print'></i> Rekap Agenda</button>
                    <a href='?pg=agenda' class='btn btn-sm bg-maroon' title='Batal'><i class='fa fa-times'></i></a>
		  </div>
         </div>
           <div class='box-body'>
                      <div class="table-responsive">
                    <table style="font-size: 12px" class="table table-striped table-sm">
                     
          <thead class="thead-dark">
      <tr>
	<th width='2%' >No</th>
	<th width='15%' >Hari, Tanggal</th>
	<th width='10%' >Jam Pelajaran</th>
	<th width='5%' >Pertemuan Ke</th>
	<th width='5%' >Nomor KI/KD</th>
	<th>Materi</th>
	<th >Indikator</th>
	<th width='10%' >Pencapaian</th>
	<th width='5%' >Kehadiran Siswa</th>
	</tr>
	 </thead>
	 <?php
	  $query = mysqli_query($koneksi, "select * from agenda 
	 JOIN m_hari ON m_hari.inggris=agenda.harix WHERE agenda.mapel='$mapel' AND agenda.kelas='$kelas' ORDER BY agenda.id ASC");
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
	 <td ><?= $no ?></td>
	 <td ><?= $agenda['hari'] ?>, <?= $tanggalmu ?></td>
	 <td ><?= $jadwal['dari'] ?> - <?= $jadwal['sampai'] ?></td>
	 <td ><?= $agenda['ke'] ?></td>
	 <td ><?= $agenda['kikd'] ?></td>
	 <td><?= $agenda['materi'] ?></td>
	 <td><?= $agenda['indikator'] ?></td>
	 <td >
	 <?php if($prosen>=50){ ?>
	 Tercapai
	 <?php } ?>
	  <?php if($prosen<50){ ?>
	 Tidak Tercapai
	 <?php } ?>
	 </td>
	 <td ><?= round($prosen); ?>%</td>
	 
	 </tr>
	   <?php } ?>
	 </tbody>
	</table>
                                    </div>
									</div>
									 </div>
									 </div>
                                      </div>

<iframe id='loadframe' name='frameresult' src='mod_cetak/cetakagenda.php?id=<?= $id ?>&kelas=<?= $kelas ?>' style='display:none'></iframe>