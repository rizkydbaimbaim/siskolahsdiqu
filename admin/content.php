<?php if ($pg == '') : ?>
    <?php include 'home.php'; ?>
<?php elseif ($pg == 'dataserver') : ?>
    <?php include 'mod_master/server.php'; ?>
<?php elseif ($pg == 'sinkron') : ?>
    <?php cek_session_admin(); ?>
    <?php include 'mod_sinkron/sinkronisasi.php'; ?>
<?php elseif ($pg == 'kirimdata') : ?>
    <?php cek_session_admin(); ?>
    <?php include 'mod_sinkron/dataujian.php'; ?>
   <?php elseif ($pg == 'kirimbank') : ?>
    <?php cek_session_admin(); ?>
    <?php include 'mod_sinkron/databanksoal.php'; ?>	
	<?php elseif ($pg == 'kirimsoal') : ?>
    <?php cek_session_admin(); ?>
    <?php include 'mod_sinkron/datasoal.php'; ?>	
	<?php elseif ($pg == 'setting_semester') : ?>
    <?php cek_session_admin(); ?>
    <?php include 'mod_rapor/setting_semester.php'; ?>
	<?php elseif ($pg == 'imporsiswa') : ?>
    <?php cek_session_admin(); ?>
    <?php include 'mod_rapor/imporsiswa.php'; ?>
	<?php elseif ($pg == 'siswar') : ?>
    <?php cek_session_admin(); ?>
    <?php include 'mod_rapor/siswar.php'; ?>
	<?php elseif ($pg == 'walas') : ?>
    <?php cek_session_admin(); ?>
    <?php include 'mod_rapor/datawalas.php'; ?>
	<?php elseif ($pg == 'eskul') : ?>
    <?php cek_session_admin(); ?>
    <?php include 'mod_rapor/eskul.php'; ?>
	<?php elseif ($pg == 'mapelr') : ?>
    <?php cek_session_admin(); ?>
    <?php include 'mod_rapor/mapelr.php'; ?>
	 <?php elseif ($pg == 'deskrip3') : ?>
    <?php include 'mod_deskrip3/deskrip3.php'; ?>
	<?php elseif ($pg == 'deskrip4') : ?>
    <?php include 'mod_deskrip4/deskrip4.php'; ?>
	<?php elseif ($pg == 'view4') : ?>
    <?php include 'mod_deskrip4/view4.php'; ?>
	<?php elseif ($pg == 'view3') : ?>
    <?php include 'mod_deskrip3/view3.php'; ?>
	<?php elseif ($pg == 'nk3') : ?>
    <?php include 'mod_ki3/nk3.php'; ?>
	<?php elseif ($pg == 'viewnilai3') : ?>
    <?php include 'mod_ki3/viewnilai3.php'; ?>
	<?php elseif ($pg == 'nk4') : ?>
    <?php include 'mod_ki4/nk4.php'; ?>
	<?php elseif ($pg == 'viewnilai4') : ?>
    <?php include 'mod_ki4/viewnilai4.php'; ?>
	<?php elseif ($pg == 'hapus_nilai4') : ?>
     <?php $mapel=$_GET['idmap'];
	$kelas=$_GET['kelas'];
	$exec =  delete($koneksi, 'nilai_kh', ['mapel' => $mapel, 'kelas' => $kelas]);
	if($exec){
	echo "
	  <script type='text/javascript'>
		setTimeout(function () { 	
			swal({
				title: 'Sukses',
				text:  'Nilai Berhasil dihapus',
				type: 'success',
				timer: 1000,
				showConfirmButton: true
			});		
		},10);	
		window.setTimeout(function(){ 
			window.location.replace('?pg=nk4');
		} ,1000);	
	  </script>";
	}	
	
?>
<?php elseif ($pg == 'hapus_nilai3') : ?>
     <?php $mapel=$_GET['idmap'];
	$kelas=$_GET['kelas'];
	$exec =  delete($koneksi, 'nilai_ph', ['mapel' => $mapel, 'kelas' => $kelas]);
	if($exec){
	echo "
	  <script type='text/javascript'>
		setTimeout(function () { 	
			swal({
				title: 'Sukses',
				text:  'Nilai Berhasil dihapus',
				type: 'success',
				timer: 1000,
				showConfirmButton: true
			});		
		},10);	
		window.setTimeout(function(){ 
			window.location.replace('?pg=nk3');
		} ,1000);	
	  </script>";
	}	
	
?>
    <?php elseif ($pg == 'setting_arsip') : ?>
    <?php include 'mod_arsip/setting_arsip.php'; ?>
    <?php elseif ($pg == 'lemari') : ?>
    <?php include 'mod_arsip/lemari.php'; ?>
	<?php elseif ($pg == 'map') : ?>
    <?php include 'mod_arsip/map.php'; ?>
	<?php elseif ($pg == 'dokumen') : ?>
    <?php include 'mod_arsip/dokumen.php'; ?>
	<?php elseif ($pg == 'arsipguru') : ?>
    <?php include 'mod_arsip/arsipguru.php'; ?>
	<?php elseif ($pg == 'surat_masuk') : ?>
    <?php include 'mod_arsip/surat_masuk.php'; ?>
	<?php elseif ($pg == 'surat_keluar') : ?>
    <?php include 'mod_arsip/surat_keluar.php'; ?>
	<?php elseif ($pg == 'meeting') : ?>
    <?php include 'mod_arsip/vc.php'; ?>
     <?php elseif ($pg == 'hasil') : ?>
    <?php include 'mod_vote/hasil.php'; ?>
	<?php elseif ($pg == 'vote') : ?>
    <?php include 'mod_vote/kandidat.php'; ?>
	<?php elseif ($pg == 'voting') : ?>
    <?php include 'mod_vote/voting.php'; ?>
	<?php elseif ($pg == 'mcetakabsen') : ?>
    <?php include 'mod_cetak/mcetakabsen.php'; ?>
	<?php elseif ($pg == 'mcetakagenda') : ?>
    <?php include 'mod_cetak/mcetakagenda.php'; ?>
	<?php elseif ($pg == 'mcetakjurnal') : ?>
    <?php include 'mod_cetak/mcetakjurnal.php'; ?>
	<?php elseif ($pg == 'mcetakph') : ?>
    <?php include 'mod_cetak/mcetakph.php'; ?>
	<?php elseif ($pg == 'mcetakdaring') : ?>
    <?php include 'mod_cetak/mcetakdaring.php'; ?>
	<?php elseif ($pg == 'acetakdaring') : ?>
    <?php include 'mod_cetak/acetakdaring.php'; ?>
	<?php elseif ($pg == 'mbs_cetakph') : ?>
    <?php include 'mod_mbs/mbs_cetakph.php'; ?>
	<?php elseif ($pg == 'banksoalguru') : ?>
    <?php include 'mod_banksoal/banksoalguru.php'; ?>
	<?php elseif ($pg == 'nisn') : ?>
    <?php include 'mod_kartu/nisn.php'; ?>
	<?php elseif ($pg == 'biodata') : ?>
    <?php include 'mod_mbs/biodata.php'; ?>
	<?php elseif ($pg == 'voters') : ?>
	
	<?php

	$tipe	="Guru";
	$pemilih=$_SESSION['id_pengawas'];
	$kandidat=$_GET['id'];
	$sql="INSERT INTO datapemilihan SET tipe='$tipe', idpemilih='$pemilih', idkandidat='$kandidat'";
	$simpan=mysqli_query($koneksi,$sql);
	if($simpan){
		
		$edit="UPDATE kandidat SET suara=suara+1 WHERE id='$kandidat'";
		$update=mysqli_query($koneksi,$edit);
		echo "
	  <script type='text/javascript'>
		setTimeout(function () { 	
			swal({
				title: 'Sukses',
				text:  'Voting berhasil disimpan',
				type: 'success',
				timer: 2000,
				showConfirmButton: true
			});		
		},10);	
		window.setTimeout(function(){ 
			window.location.replace('?pg=voting');
		} ,2000);	
	  </script>";
	}		
	?>
   <?php elseif ($pg == 'pengumuman2') : ?>
    <?php include 'pengumumanguru.php'; ?>	
   <?php elseif ($pg == 'nilaisosial') : ?>
    <?php include 'mod_sikap/sos.php'; ?>	
	<?php elseif ($pg == 'nilaispiritual') : ?>
    <?php include 'mod_sikap/spi.php'; ?>	
	<?php elseif ($pg == 'materi_file') : ?>
    <?php include 'materi/materi_file.php'; ?>	
	<?php elseif ($pg == 'tugas_file') : ?>
    <?php include 'mod_tugas/tugas_file.php'; ?>	
	<?php elseif ($pg == 'datawalas') : ?>
    <?php include 'mod_walas/datawalas.php'; ?>	
	<?php elseif ($pg == 'absenrapor') : ?>
    <?php include 'mod_walas/absen.php'; ?>
	<?php elseif ($pg == 'prestasi') : ?>
    <?php include 'mod_walas/prestasi.php'; ?>
	<?php elseif ($pg == 'eskul') : ?>
    <?php include 'mod_walas/eskul.php'; ?>
	<?php elseif ($pg == 'catat') : ?>
    <?php include 'mod_walas/catat.php'; ?>
	<?php elseif ($pg == 'eskuler') : ?>
    <?php include 'mod_walas/eskuler.php'; ?>
	<?php elseif ($pg == 'datasiswa') : ?>
    <?php include 'mod_walas/datasiswa.php'; ?>	
	<?php elseif ($pg == 'inputabsen') : ?>
    <?php include 'mod_mbs/inputabsen.php'; ?>
	<?php elseif ($pg == 'inputabsenmapel') : ?>
    <?php include 'mod_mbs/inputabsenmapel.php'; ?>
	<?php elseif ($pg == 'jurnal') : ?>
    <?php include 'mod_mbs/jurnal.php'; ?>
	<?php elseif ($pg == 'agenda') : ?>
    <?php include 'mod_mbs/agenda.php'; ?>
	<?php elseif ($pg == 'nh') : ?>
    <?php include 'mod_mbs/nh.php'; ?>
	<?php elseif ($pg == 'dataph') : ?>
    <?php include 'mod_mbs/dataph.php'; ?>
	<?php elseif ($pg == 'datakh') : ?>
    <?php include 'mod_mbs/datakh.php'; ?>
	<?php elseif ($pg == 'inputph') : ?>
    <?php include 'mod_mbs/inputph.php'; ?>
	<?php elseif ($pg == 'ubahphoto') : ?>
    <?php include 'mod_rapor/ubahphoto.php'; ?>
	<?php elseif ($pg == 'raporadmin') : ?>
    <?php include 'mod_admin/raporadmin.php'; ?>
	<?php elseif ($pg == 'datasiswaadmin') : ?>
    <?php include 'mod_admin/datasiswaadmin.php'; ?>
	<?php elseif ($pg == 'datamplab') : ?>
    <?php include 'mod_admin/datamplab.php'; ?>
	<?php elseif ($pg == 'datamplag') : ?>
    <?php include 'mod_admin/datamplag.php'; ?>
	<?php elseif ($pg == 'datampljur') : ?>
    <?php include 'mod_admin/datampljur.php'; ?>
	<?php elseif ($pg == 'jadwalmapel') : ?>
    <?php include 'mod_mbs/mod_jadwal/jadwalmapel.php'; ?>
	<?php elseif ($pg == 'tugas') : ?>
    <?php include 'mod_elearn/tugas/tugas.php'; ?>
    <?php elseif ($pg == 'materi') : ?>
    <?php include 'mod_elearn/materi/materi.php'; ?>
	<?php elseif ($pg == 'absendaring') : ?>
    <?php include 'mod_elearn/tugas/absendaring.php'; ?>
	<?php elseif ($pg == 'absendaringmapel') : ?>
    <?php include 'mod_elearn/absendaringmapel.php'; ?>
	<?php elseif ($pg == 'absendaringkelas') : ?>
    <?php include 'mod_admin/absendaringkelas.php'; ?>
	<?php elseif ($pg == 'quizbank') : ?>
    <?php include 'mod_elearn/quiz/quizbank.php'; ?>
	<?php elseif ($pg == 'editquiz1') : ?>
    <?php include 'mod_elearn/quiz/editquiz1.php'; ?>	
	<?php elseif ($pg == 'editquiz2') : ?>
    <?php include 'mod_elearn/quiz/editquiz2.php'; ?>	
	<?php elseif ($pg == 'editquiz3') : ?>
    <?php include 'mod_elearn/quiz/editquiz3.php'; ?>	
	<?php elseif ($pg == 'editquiz4') : ?>
    <?php include 'mod_elearn/quiz/editquiz4.php'; ?>
	<?php elseif ($pg == 'editquiz5') : ?>
    <?php include 'mod_elearn/quiz/editquiz5.php'; ?>
	<?php elseif ($pg == 'inputquiz1') : ?>
    <?php include 'mod_elearn/quiz/inputquiz1.php'; ?>	
	<?php elseif ($pg == 'inputquiz2') : ?>
    <?php include 'mod_elearn/quiz/inputquiz2.php'; ?>	
	<?php elseif ($pg == 'inputquiz3') : ?>
    <?php include 'mod_elearn/quiz/inputquiz3.php'; ?>	
	<?php elseif ($pg == 'inputquiz4') : ?>
    <?php include 'mod_elearn/quiz/inputquiz4.php'; ?>	
	<?php elseif ($pg == 'inputquiz5') : ?>
    <?php include 'mod_elearn/quiz/inputquiz5.php'; ?>	
	<?php elseif ($pg == 'setting_mbs') : ?>
    <?php include 'mod_mbs/setting_mbs.php'; ?>
	<?php elseif ($pg == 'ks_absenQR') : ?>
    <?php include 'mod_ks/ks_absenQR.php'; ?>
	<?php elseif ($pg == 'setting_learn') : ?>
    <?php include 'mod_elearn/setting_learn.php'; ?>
	<?php elseif ($pg == 'dataabkelas') : ?>
    <?php include 'mod_admin/dataabkelas.php'; ?>
	<?php elseif ($pg == 'tugasadmin') : ?>
    <?php include 'mod_admin/tugas.php'; ?>
	<?php elseif ($pg == 'materiadmin') : ?>
    <?php include 'mod_admin/materi.php'; ?>
	<?php elseif ($pg == 'updatesiswa') : ?>
    <?php include 'mod_admin/updatesiswa.php'; ?>
	<?php elseif ($pg == 'skkb') : ?>
    <?php include 'staff/skkb.php'; ?>
	<?php elseif ($pg == 'dtpindah') : ?>
    <?php include 'staff/dtmutasi.php'; ?>
	<?php elseif ($pg == 'rpp') : ?>
    <?php include 'staff/rpp.php'; ?>
	
	<?php elseif ($pg == 'logine') : ?>
	<?php
	 $guru=$_SESSION['id_pengawas'];
$tanggal=date('Y-m-d');
$bulan=date('m');
$tahun=date('Y');
$masuk=date('H:i:s');

$cekdata = "SELECT * FROM absen_guru WHERE tanggal='$tanggal' AND status='1'  AND guru='$guru'";
$jikaada = mysqli_query($koneksi,$cekdata);
if(mysqli_num_rows($jikaada)>0){
	mysqli_query($koneksi,"UPDATE absen_guru SET keluar='$masuk', status='1' WHERE guru='$guru'");
	echo "
	<audio src='shutter.mp3' autoplay='autoplay'></audio>;
	  <script type='text/javascript'>
		setTimeout(function () { 	
			swal({
				title: 'Berhasil di Simpan !!!',
				text:  'Absen Pulang Sudah Tercatat',
				type: 'success',
				timer: 2000,
				showConfirmButton: true
			});		
		},10);	
		window.setTimeout(function(){ 
			window.location.replace('index.php');
		} ,2000);	
	  </script>";
		
	}else{

mysqli_query($koneksi,"INSERT INTO absen_guru(guru,tanggal,masuk,status,idqr,ket) values('$guru','$tanggal','$masuk','1','1','H')");
if($koneksi){
echo"
<audio src='shutter.mp3' autoplay='autoplay'></audio>;
	  <script type='text/javascript'>
		setTimeout(function () { 	
			swal({
				title: 'Berhasil di Simpan !!!',
				text:  'Absen Masuk Sudah Tercatat',
				type: 'success',
				timer: 2000,
				showConfirmButton: true
			});		
		},10);	
		window.setTimeout(function(){ 
			window.location.replace('index.php');
		} ,2000);	
	  </script>";
}
	}
	?>

	<?php elseif ($pg == 'abqr') : ?>
    <?php cek_session_admin(); ?>
    <?php include 'mod_qr/kode.php'; ?>
	<?php elseif ($pg == 'abmanual') : ?>
    <?php cek_session_admin(); ?>
    <?php include 'mod_mbs/abmanual.php'; ?>
	<?php elseif ($pg == 'dataabsenguru') : ?>
    <?php cek_session_admin(); ?>
    <?php include 'mod_admin/dataabsen.php'; ?>
	
	<?php elseif ($pg == 'gantiphoto') : ?>
        <div class="modal-dialog" role="document">
            <div class="modal-content">
             
                <div class="modal-header bg-blue">
                    <h5 class="modal-title">Ubah Photo Profil</h5>
                    
                </div>
				<form method="post" action="" enctype="multipart/form-data">
				 <div class='modal-body'>
				    <label>Ambil Photo</label>
                      <input name="MAX_FILE_SIZE" type="hidden" value="3000000" />  
	              <input name="file" class="form-control" type="file" accept="image/*" capture / required>
		  </div>
		  <div class="modal-footer">
                  <button type="submit" name="gantiphoto" class="btn btn-primary">Simpan</button>
                </div>
         </div>           
	</div>
        <?php            
            if (isset($_POST['gantiphoto'])) {
				function compressImage($source, $destination, $quality) { 
   
    $imgInfo = getimagesize($source); 
    $mime = $imgInfo['mime']; 
  
    switch($mime){ 
        case 'image/jpeg': 
            $image = imagecreatefromjpeg($source); 
            break; 
        case 'image/png': 
            $image = imagecreatefrompng($source); 
            break; 
        case 'image/gif': 
            $image = imagecreatefromgif($source); 
            break; 
        default: 
            $image = imagecreatefromjpeg($source); 
    } 
	 imagejpeg($image, $destination, $quality); 
     
   
    return $destination; 
} 
				$foto = $_FILES['file']['name'];
	$tmp = $_FILES['file']['tmp_name'];
	$fotobaru = date('dmYHis').$foto;
	$path = "../berkas/".$fotobaru;
      $guru = $_SESSION['id_pengawas'];
				
	$query = "SELECT * FROM pengawas WHERE id_pengawas='".$guru."'";
		$sql = mysqli_query($koneksi, $query); 
		$data = mysqli_fetch_array($sql);

		if(is_file("../berkas/".$data['foto'])) 
			unlink("../berkas/".$data['foto']); 
		 $compressedImage = compressImage($tmp, $path, 32);
	mysqli_query($koneksi,"UPDATE pengawas SET foto='$fotobaru' WHERE id_pengawas='$guru'");
	echo "
	  <script type='text/javascript'>
		setTimeout(function () { 	
			swal({
				title: 'Sukses !!!',
				text:  'Photo Profil Berhasil diubah',
				type: 'success',
				timer: 2000,
				showConfirmButton: true
			});		
		},10);	
		window.setTimeout(function(){ 
			window.location.replace('?pg=');
		} ,2000);	
	  </script>";
	
			}
            ?>
<?php elseif ($pg == 'sinkronset') : ?>
    <?php cek_session_admin(); ?>
    <?php include 'mod_sinkron/sinkronsetting.php'; ?>
<?php elseif ($pg == 'informasi') : ?>
    <?php include 'informasi.php'; ?>
<?php elseif ($pg == 'dataujian') : ?>
    <?php include 'mod_sinkron/dataujian.php'; ?>
<?php elseif ($pg == 'pengumuman') : ?>
    <?php include 'pengumuman.php'; ?>
<?php elseif ($pg == 'guru') : ?>
    <?php cek_session_admin(); ?>
    <?php include 'mod_guru/guru.php'; ?>
	<?php elseif ($pg == 'ks') : ?>
    <?php cek_session_admin(); ?>
    <?php include 'mod_guru/ks.php'; ?>
	<?php elseif ($pg == 'staff') : ?>
    <?php cek_session_admin(); ?>
    <?php include 'mod_guru/staff.php'; ?>
<?php elseif ($pg == 'beritaacara') : ?>
    <?php include 'mod_berita/prev_berita.php'; ?>
<?php elseif ($pg == 'berita') : ?>
    <?php include 'mod_berita/berita.php'; ?>
<?php elseif ($pg == 'jadwal') : ?>
    <?php cek_session_admin(); ?>
    <?php include "mod_jadwal/jadwal.php"; ?>
<?php elseif ($pg == 'ujianguru') : ?>
    <?php cek_session_guru();
    include "ujian_guru.php"; ?>

<?php elseif ($pg == 'nilaiujian') : ?>
    <?php include 'mod_nilai/nilaiujian2.php'; ?>
<?php elseif ($pg == 'nilai') : ?>
    <?php include 'mod_nilai/nilai.php'; ?>
    <?php elseif ($pg == 'analisis') : ?>
    <?php include 'mod_analisis/nilaianalisis2.php'; ?>
	<?php elseif ($pg == 'nilai2') : ?>
    <?php include 'mod_analisis/nilai2.php'; ?>
   <?php elseif ($pg == 'lihatsoal') : ?>
    <?php include "mod_banksoal/lihatsoal.php"; ?>	
	<?php elseif ($pg == 'tambahpg') : ?>
    <?php include "mod_banksoal/tambahpg.php"; ?>	
	<?php elseif ($pg == 'editsoal3') : ?>
    <?php include "mod_banksoal/editsoal3.php"; ?>	
	<?php elseif ($pg == 'editsoal1') : ?>
    <?php include "mod_banksoal/editsoal1.php"; ?>	
	<?php elseif ($pg == 'editsoal2') : ?>
    <?php include "mod_banksoal/editsoal2.php"; ?>	
	<?php elseif ($pg == 'editsoal4') : ?>
    <?php include "mod_banksoal/editsoal4.php"; ?>	
	<?php elseif ($pg == 'editsoal5') : ?>
    <?php include "mod_banksoal/editsoal5.php"; ?>	
    <?php elseif ($pg == 'semuanilai') : ?>
    <?php include 'mod_nilai/semuanilai.php'; ?>
   <?php elseif ($pg == 'reset') : ?>
    <?php include 'mod_status/reset.php'; ?>
    <?php elseif ($pg == 'status') : ?>
    <?php cek_session_admin(); ?>
    <?php include "mod_status/status_peserta.php"; ?>
   <?php elseif ($pg == 'kartu') : ?>
    <?php include 'mod_kartu/kartu.php'; ?>
   <?php elseif ($pg == 'absen') : ?>
    <?php include 'mod_absen/absen.php'; ?>
   <?php elseif ($pg == 'siswa') : ?>
    <?php include 'mod_siswa/siswa.php'; ?>
    <?php elseif ($pg == 'uplfotosiswa') : ?>
    <?php cek_session_admin(); ?>
    <?php include 'mod_siswa/uploadfoto.php'; ?>
     <?php elseif ($pg == 'importmaster') : ?>
    <?php cek_session_admin(); ?>
    <?php include 'mod_master/import.php'; ?>
    <?php elseif ($pg == 'importguru') : ?>
    <?php
    cek_session_admin(); ?>
    <?php include 'mod_guru/import.php'; ?>
    <?php elseif ($pg == 'filependukung') : ?>
    <div class='box box-solid'>
        <div class='box-header with-border'>
            <h3 class='box-title'>Data File Pendukung</h3>
            <div class='box-tools pull-right '>
                <button id="btnhapusfile" class='btn btn-sm btn-flat btn-success'><i class='fas fa-trash'></i> Hapus</button>

            </div>
        </div><!-- /.box-header -->
        <div class='box-body'>
            <div id='tablereset'>
                <table id='example1' class="table table-striped table-inverse table-responsive">
                    <thead class="thead-inverse">
                        <tr>
                            <th width='5px'><input type='checkbox' id='ceksemua'></th>
                            <th width='10'>No</th>
                            <th>Nama File</th>
                            <th>Kode Bank Soal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $query = mysqli_query($koneksi, "SELECT * FROM file_pendukung");
                        $no = 1;
                        while ($file = mysqli_fetch_array($query)) {
                            $mapel = fetch($koneksi, 'mapel', ['id_mapel' => $file['id_mapel']]);
                            if ($mapel['kode'] == '') {
                                $status = "<span style='color:red'>Soal Sudah Dihapus</span>";
                            } else {
                                $status = $mapel['kode'];
                            }
                        ?>
                            <tr>
                                <td><input type='checkbox' name='cekpilih[]' class='cekpilih' id='cekpilih-<?= $no ?>' value="<?= $file['id_file'] ?>"></td>
                                <td scope="row"><?= $no++ ?></td>
                                <td><?= "<img src='../files/" . $file['nama_file'] . "' width='50'>" ?></td>
                                <td><?= $status ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div><!-- /.box-body -->

    </div><!-- /.box -->
    <script>
        $(function() {
            $("#btnhapusfile").click(function() {
                id_array = new Array();
                i = 0;
                $("input.cekpilih:checked").each(function() {
                    id_array[i] = $(this).val();
                    i++;
                });
                $.ajax({
                    url: "hapusfile.php",
                    data: "kode=" + id_array,
                    type: "POST",
                    success: function(respon) {
                        if (respon == 1) {
                            $("input.cekpilih:checked").each(function() {
                                $(this).parent().parent().remove('.cekpilih').animate({
                                    opacity: "hide"
                                }, "slow");
                            })
                        }
                    }
                });
                return false;
            })
        });
    </script>
<?php elseif ($pg == 'user') : ?>
    <?php cek_session_admin(); ?>
    <div class='row'>
        <div class='col-md-8'>
            <div class='box box-solid'>
                <div class='box-header with-border'>
                    <h3 class='box-title'><i class="fas fa-users-cog    "></i> Manajemen Pengawas</h3>
                </div><!-- /.box-header -->
                <div class='box-body'>
                    <div class='table-responsive'>
                        <table id='example1' class='table table-bordered table-striped'>
                            <thead>
                                <tr>
                                    <th width='5px'>#</th>
                                    <th>NIP</th>
                                    <th>Nama</th>
                                    <th>Username</th>
                                    <th>Level</th>
                                    <th>Ruang</th>
                                    <th width=60px></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $pengawasQ = mysqli_query($koneksi, "SELECT * FROM pengawas where level='pengawas' ORDER BY nama ASC"); ?>
                                <?php while ($pengawas = mysqli_fetch_array($pengawasQ)) : ?>
                                    <?php $no++; ?>
                                    <tr>
                                        <td><?= $no ?></td>
                                        <td><?= $pengawas['nip'] ?></td>
                                        <td><?= $pengawas['nama'] ?></td>
                                        <td><?= $pengawas['username'] ?></td>
                                        <td><?= $pengawas['level'] ?></td>
                                        <td><?= $pengawas['ruang'] ?></td>
                                        <td style="text-align:center">
                                            <div class=''>
                                                <a href="?pg=<?= $pg ?>&ac=edit&id=<?= $pengawas['id_pengawas'] ?>"> <button class='btn btn-flat btn-xs btn-warning'><i class='fa fa-edit'></i></button></a>
                                                <a href="?pg=<?= $pg ?>&ac=hapus&id=<?= $pengawas['id_pengawas'] ?>"> <button class='btn btn-flat btn-xs bg-maroon'><i class='fa fa-trash'></i></button></a>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>
        <div class='col-md-4'>
            <?php if ($ac == '') : ?>
                <?php
                if (isset($_POST['submit'])) :
                    $nip = $_POST['nip'];
                    $nama = $_POST['nama'];
                    $nama = str_replace("'", "&#39;", $nama);
                    $username = $_POST['username'];
                    $pass1 = $_POST['pass1'];
                    $pass2 = $_POST['pass2'];
                    $ruang = $_POST['ruang'];

                    $cekuser = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM pengawas WHERE username='$username'"));
                    if ($cekuser > 0) {
                        $info = info("Username $username sudah ada!", "NO");
                    } else {
                        if ($pass1 <> $pass2) :
                            $info = info("Password tidak cocok!", "NO");
                        else :
                            $password = password_hash($pass1, PASSWORD_BCRYPT);
                            $exec = mysqli_query($koneksi, "INSERT INTO pengawas (nip,nama,username,password,level,ruang) VALUES ('$nip','$nama','$username','$password','pengawas','$ruang')");
                            (!$exec) ? $info = info("Gagal menyimpan!", "NO") : jump("?pg=$pg");
                        endif;
                    }
                endif;
                ?>
                <form action='' method='post'>
                    <div class='box box-solid'>
                        <div class='box-header with-border'>
                            <h3 class='box-title'>Tambah</h3>
                            <div class='box-tools pull-right '>
                                <button type='submit' name='submit' class='btn btn-sm btn-flat btn-success'><i class='fa fa-check'></i> Simpan</button>
                            </div>
                        </div><!-- /.box-header -->
                        <div class='box-body'>
                            <?= $info ?>
                            <div class='form-group'>
                                <label>NIP</label>
                                <input type='text' name='nip' class='form-control' required='true' />
                            </div>
                            <div class='form-group'>
                                <label>Nama</label>
                                <input type='text' name='nama' class='form-control' required='true' />
                            </div>
                            <div class='form-group'>
                                <label>Username</label>
                                <input type='text' name='username' class='form-control' required='true' />
                            </div>
                            <div class='form-group'>
                                <label>Ruang</label>
                                <input type='text' name='ruang' class='form-control' required='true' />
                            </div>
                            <div class='form-group'>
                                <div class='row'>
                                    <div class='col-md-6'>
                                        <label>Password</label>
                                        <input type='password' name='pass1' class='form-control' required='true' />
                                    </div>
                                    <div class='col-md-6'>
                                        <label>Ulang Password</label>
                                        <input type='password' name='pass2' class='form-control' required='true' />
                                    </div>
                                </div>
                            </div>
                        </div><!-- /.box-body -->
                    </div><!-- /.box -->
                </form>
            <?php elseif ($ac == 'edit') : ?>
                <?php
                $id = $_GET['id'];
                $value = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM pengawas WHERE id_pengawas='$id'"));
                if (isset($_POST['submit'])) :
                    $nip = $_POST['nip'];
                    $nama = $_POST['nama'];
                    $nama = str_replace("'", "&#39;", $nama);
                    $username = $_POST['username'];
                    $pass1 = $_POST['pass1'];
                    $pass2 = $_POST['pass2'];
                    $ruang = $_POST['ruang'];
                    if ($pass1 <> '' and $pass2 <> '') {
                        if ($pass1 <> $pass2) :
                            $info = info("Password tidak cocok!", "NO");
                        else :
                            $password = password_hash($pass1, PASSWORD_BCRYPT);
                            $exec = mysqli_query($koneksi, "UPDATE pengawas SET nip='$nip',nama='$nama',username='$username',password='$password',ruang='$ruang' WHERE id_pengawas='$id'");
                        endif;
                    } else {
                        $exec = mysqli_query($koneksi, "UPDATE pengawas SET nip='$nip',nama='$nama',username='$username',ruang='$ruang' WHERE id_pengawas='$id'");
                    }
                    (!$exec) ? $info = info("Gagal menyimpan!", "NO") : jump("?pg=$pg");
                endif;
                ?>
                <form action='' method='post'>
                    <div class='box box-solid'>
                        <div class='box-header with-border'>
                            <h3 class='box-title'>Edit</h3>
                            <div class='box-tools pull-right '>
                                <button type='submit' name='submit' class='btn btn-sm btn-flat btn-success'><i class='fa fa-check'></i> Simpan</button>
                                <a href='?pg=<?= $pg ?>' class='btn btn-sm bg-maroon' title='Batal'><i class='fa fa-times'></i></a>
                            </div>
                        </div><!-- /.box-header -->
                        <div class='box-body'>
                            <?= $info ?>
                            <div class='form-group'>
                                <label>NIP</label>
                                <input type='text' name='nip' value="<?= $value['nip'] ?>" class='form-control' required='true' />
                            </div>
                            <div class='form-group'>
                                <label>Nama</label>
                                <input type='text' name='nama' value="<?= $value['nama'] ?>" class='form-control' required='true' />
                            </div>
                            <div class='form-group'>
                                <label>Username</label>
                                <input type='text' name='username' value="<?= $value['username'] ?>" class='form-control' required='true' />
                            </div>
                            <div class='form-group'>
                                <label>Ruang</label>
                                <input type='text' name='ruang' value="<?= $value['ruang'] ?>" class='form-control' required='true' />
                            </div>
                            <div class='form-group'>
                                <div class='row'>
                                    <div class='col-md-6'>
                                        <label>Password</label>
                                        <input type='password' name='pass1' class='form-control' />
                                    </div>
                                    <div class='col-md-6'>
                                        <label>Ulang Password</label>
                                        <input type='password' name='pass2' class='form-control' />
                                    </div>
                                </div>
                            </div>
                        </div><!-- /.box-body -->
                    </div><!-- /.box -->
                </form>
            <?php elseif ($ac == 'hapus') : ?>
                <?php
                $id = $_GET['id'];
                $info = info("Anda yakin akan menghapus pengawas ini?");
                if (isset($_POST['submit'])) {
                    $exec = mysqli_query($koneksi, "DELETE FROM pengawas WHERE id_pengawas='$id'");
                    (!$exec) ? $info = info("Gagal menghapus!", "NO") : jump("?pg=$pg");
                }
                ?>
                <form action='' method='post'>
                    <div class='box box-danger'>
                        <div class='box-header with-border'>
                            <h3 class='box-title'>Hapus</h3>
                            <div class='box-tools pull-right '>
                                <button type='submit' name='submit' class='btn btn-sm bg-maroon'><i class='fa fa-trash'></i> Hapus</button>
                                <a href='?pg=<?= $pg ?>' class='btn btn-sm btn-default' title='Batal'><i class='fa fa-times'></i></a>
                            </div>
                        </div><!-- /.box-header -->
                        <div class='box-body'>
                            <?= $info ?>
                        </div><!-- /.box-body -->
                    </div><!-- /.box -->
                </form>
            <?php endif; ?>
        </div>
    </div>
<?php elseif ($pg == 'pengawas') : ?>
    <?php cek_session_admin(); ?>
    <?php include 'mod_user/user.php'; ?>
    <!-- DATA MASTER -->
<?php elseif ($pg == 'matapelajaran') : ?>
    <?php cek_session_admin(); ?>
    <?php include 'mod_master/mapel.php'; ?>
<?php elseif ($pg == 'pk') : ?>
    <?php cek_session_admin(); ?>
    <?php include 'mod_master/jurusan.php'; ?>
<?php elseif ($pg == 'jenisujian') : ?>
    <?php cek_session_admin(); ?>
    <?php include 'mod_master/jenis.php'; ?>
<?php elseif ($pg == 'ruang') : ?>
    <?php cek_session_admin(); ?>
    <?php include 'mod_master/ruang.php'; ?>
<?php elseif ($pg == 'level') : ?>
    <?php cek_session_admin(); ?>
    <?php include 'mod_master/level.php'; ?>
<?php elseif ($pg == 'sesi') : ?>
    <?php cek_session_admin(); ?>
    <?php include 'mod_master/sesi.php'; ?>
<?php elseif ($pg == 'kelas') : ?>
    <?php cek_session_admin(); ?>
    <?php include 'mod_master/kelas.php'; ?>
<?php elseif ($pg == 'banksoal') : ?>
    <?php include "mod_banksoal/banksoal.php"; ?>
	<?php elseif ($pg == 'kisi') : ?>
    <?php include "mod_kisi/kisi.php"; ?>
<?php elseif ($pg == 'editguru') : ?>


    <?php
    if (isset($_POST['submit'])) :
        $username = $_POST['username'];
        $nip = $_POST['nip'];
        $nama = $_POST['nama'];
        $nama = str_replace("'", "&#39;", $nama);
        $exec = mysqli_query($koneksi, "UPDATE pengawas SET username='$username', nama='$nama',nip='$nip',password='$_POST[password]' WHERE id_pengawas='$id_pengawas'");
    endif;
    ?>
    <?php if ($ac == '') : ?>
        <?php
        $guru = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM pengawas WHERE id_pengawas='$pengawas[id_pengawas]'"));
        ?>
        <div class='row'>
            <div class='col-md-3'>
                <div class='box box-solid'>
                    <div class='box-body box-profile'>
					<?php if ($pengawas['foto'] == '') { ?>
                        <img class='profile-user-img img-responsive img-circle' alt='User profile picture' src='<?= $homeurl ?>/dist/img/avatar-6.png'>
					<?php }else{ ?>
					 <img class='profile-user-img img-responsive img-circle' alt='User profile picture' src='<?= $homeurl ?>/berkas/<?= $pengawas['foto'] ?>'>
					<?php } ?>
						<h3 class='profile-username text-center'><?= $guru['nama'] ?></h3>
                    </div>
                </div>
            </div>
            <div class='col-md-9'>
                <div class='nav-tabs-custom'>
                    <ul class='nav nav-tabs'>
                        <li class='active'><a aria-expanded='true' href='#detail' data-toggle='tab'><i class='fa fa-user'></i> Detail Profile</a></li>
                    </ul>
                    <div class='tab-content'>
                        <div class='tab-pane active' id='detail'>
                            <div class='row margin-bottom'>
                                <form action='' method='post'>
                                    <div class='col-sm-12'>
                                        <table class='table table-striped table-bordered'>
                                            <tbody>
                                                <tr>
                                                    <th scope='row'>Nama Lengkap</th>
                                                    <td><input class='form-control' name='nama' value="<?= $guru['nama'] ?>" /></td>
                                                </tr>
                                                <tr>
                                                    <th scope='row'>Nip</th>
                                                    <td><input class='form-control' name='nip' value="<?= $guru['nip'] ?>" /></td>
                                                </tr>
                                                <tr>
                                                    <th scope='row'>Username</th>
                                                    <td><input class='form-control' name='username' value="<?= $guru['username'] ?>" /></td>
                                                </tr>
                                                <tr>
                                                    <th scope='row'>Password</th>
                                                    <td><input class='form-control' name='password' value="<?= $guru['password'] ?>" /></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <button name='submit' class='btn btn-sm btn-flat btn-success pull-right'>Perbarui Data </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class='tab-pane' id='alamat'>
                            <div class='row margin-bottom'>
                                <div class='col-sm-12'>
                                    <table class='table  table-striped no-margin'>
                                        <tbody>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class='tab-pane' id='kesehatan'>
                            <div class='row margin-bottom'>
                                <div class='col-sm-12'>
                                    <table class='table  table-striped no-margin'>
                                        <tbody>


                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.tab-content -->
                </div>
            </div>
        </div>
    <?php endif; ?>
<?php elseif ($pg == 'pengaturan') : ?>
    <?php include "mod_setting/setting.php"; ?>
<?php elseif ($pg == 'statusall') : ?>
    <?php cek_session_admin(); ?>
    <?php include "mod_status/status_peserta.php"; ?>
<?php elseif ($pg == 'statussiswa') : ?>
    <?php if ($ac == '') : ?>
        <div class='row'>
            <div class='col-md-12'>
                <div class='alert alert-warning alert-dismissible'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
                    <i class='icon fa fa-info'></i>
                    Status peserta akan muncul saat ujian berlangsung ..
                </div>
                <div class='box box-solid'>
                    <div class='box-header with-border'>
                        <h3 class='box-title'>Status Peserta </h3>
                        <div class='box-tools pull-right '>
                        </div>
                    </div><!-- /.box-header -->
                    <div class='box-body'>
                        <div class='table-responsive'>
                            <table id='tablestatus' class='table table-bordered table-striped'>
                                <thead>
                                    <tr>
                                        <th width='5px'>#</th>
                                        <th>NIS</th>
                                        <th>Nama</th>
                                        <th>Kelas</th>
                                        <th>Mapel</th>
                                        <th>Lama Ujian</th>
                                        <th>Jawaban</th>
                                        <th>Nilai</th>
                                        <th>Ip Address</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody id='divstatussiswa'>
                                </tbody>
                            </table>
                        </div>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div>
        </div>
    <?php endif ?>
<?php else : ?>
    <div class='error-page'>
        <h2 class='headline text-yellow'> 404</h2>
        <div class='error-content'>
            <br />
            <h3><i class='fa fa-warning text-yellow'></i> Upss! Halaman tidak ditemukan.</h3>
            <p>
                Halaman yang anda inginkan saat ini tidak tersedia.<br />
                Silahkan kembali ke <a href='?'><strong>dashboard</strong></a> dan coba lagi.<br />
                Hubungi petugas <strong><i>Developer</i></strong> jika ini adalah sebuah masalah.
            </p>
        </div><!-- /.error-content -->
    </div><!-- /.error-page -->
<?php endif ?>
