<?php
defined('APLIKASI') or exit('Anda tidak dizinkan mengakses langsung script ini!');
$ac = dekripsi($ac);
echo $ac;
$materi = mysqli_fetch_array(mysqli_query($koneksi, "select * from materi where id_materi='$ac'"));
$nilai = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM nilaiquiz WHERE idmateri='$materi[id_materi]' AND idsiswa='$_SESSION[id_siswa]' "));
function youtube($url)
{
    $link = str_replace('http://www.youtube.com/watch?v=', '', $url);
    $link = str_replace('https://www.youtube.com/watch?v=', '', $link);
    $data = '<iframe width="100%" height="315" src="https://www.youtube.com/embed/' . $link . '" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
    return $data;
}

?>

 <?php
$tanggal=date('Y-m-d');
$jam=date('H:i:s');

$cekdata = "SELECT * FROM absen_daringmapel WHERE idsiswa='$_SESSION[id_siswa]'  AND mapel='$materi[mapel]' AND tanggal='$tanggal'";
$jikaada = mysqli_query($koneksi,$cekdata);
if(mysqli_num_rows($jikaada)==0){
mysqli_query($koneksi,"INSERT INTO absen_daringmapel VALUES('','$materi[id_materi]','$materi[mapel]','$_SESSION[id_siswa]','$tanggal','$jam','H','$materi[id_guru]')");

}

?>

<div class='row'>
    <div class='col-md-6'>
        <div class='box box-solid'>
            <div class='box-header with-border'>

                <h3 class='box-title'><i class="fas fa-file-signature    "></i> Detail materi Siswa</h3>
            </div><!-- /.box-header -->
            <div class='box-body'>
                <table class='table table-bordered table-striped'>
                    <tr>
                        <th width='150'>Mata Pelajaran</th>
                        <td width='10'>:</td>
                        <td><?= $materi['mapel'] ?></td>

                    </tr>

                    <tr>
                        <th>Tgl Pembelajaran</th>
                        <td width='10'>:</td>
                        <td><?= $materi['tgl_mulai'] ?></td>
                    </tr>
                    <?php if($materi['quiz']=='Ya' AND $nilai==0){ ?>
					 <tr>
                        <th>Quiz</th>
                        <td width='10'>:</td>
                        <td> <a href="<?= $homeurl . '/soalquiz/' . $materi['id_materi'] ?>" class="btn btn-sm btn-primary">Kerjakan Quiz</a></td>
                    </tr>
					<?php } ?>
					<?php if($materi['file']<>''){ ?>
					 <tr>
                        <th>Download</th>
                        <td width='10'>:</td>
                        <td> <a href="<?= $homeurl . '/berkas/' . $materi['file'] ?>" class="btn btn-sm btn-danger"><i class="fas fa-download fa-fw"></i> Download Materi</a></td>
                    </tr>
					<?php } ?>
                </table>
                <!-- <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true">Materi & Soal</a></li>

                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_1"> -->
                
					<?php 
                    if(!empty($materi['file'])){
						$pecah=explode('.',$materi['file']);
						$ekstensi=$pecah[1];
					?>
					<?php if($ekstensi=='mp4'){ ?>
					<video src="<?= $homeurl ?>/berkas/<?= $materi['file'] ?>" controls autoplay width="100%" height="315"></video>
					 <?php } ?>
					 <?php if($ekstensi=='jpg' OR $ekstensi=='png'){ ?>
					<img src="<?= $homeurl ?>/berkas/<?= $materi['file'] ?>" controls autoplay width="100%" height="315">
					 <?php } ?>
					 <?php if($ekstensi=='pdf'){ ?>
					<iframe  src="<?= $homeurl ?>/berkas/<?= $materi['file'] ?>" controls autoplay width="100%" height="315"></iframe>
					 <?php } ?>
					  <?php } ?>
                    <center>
                        <div class="callout">
                            <strong>
                                <h3><?= $materi['judul'] ?></h3>
                            </strong>
                        </div>
                    </center>
                    <?php if ($materi['youtube'] <> null) {  ?>
                        <div class="col-md-3"></div>
                        <div class="callout col-md-6">
                            <?= youtube($materi['youtube']) ?>
                        </div>
                        <div class="col-md-3"></div>
                    <?php } ?>
                    <div class="col-md-12">
                        <?= $materi['materi'] ?>
                    </div>
            </div>
</div>
        </div>
   
  <div class='col-md-6'>
        <div class='box box-solid'>
            <div class='box-header with-border'>

                <h3 class='box-title'><i class="fas fa-file-signature    "></i> Komentar Siswa</h3>
            </div><!-- /.box-header -->
            <div class='box-body'>
                <table class='table table-bordered table-striped'>
                    <tr>
                        <th width='150'>Mata Pelajaran</th>
                        <td width='10'>:</td>
                        <td><?= $materi['mapel'] ?></td>

                    </tr>

                    <tr>
                        <th>Tgl Pembelajaran</th>
                        <td width='10'>:</td>
                        <td><?= $materi['tgl_mulai'] ?></td>
                    </tr>

                </table>
                <form method="post" action="" enctype="multipart/form-data">
										
				<input type='hidden' name='id_materi' value="<?= $materi['id_materi'] ?>" >
				<input type='hidden' name='guru' value="<?= $materi['id_guru'] ?>" >
				<font> Silahkan kirim pesan jika materi pembelajaran kurang dimengerti </font>
				<textarea id='editor2' name='komentar' class='editor1' rows='8' cols='80' style='width:100%;'></textarea>
				<div class="modal-footer">
                  <button type="submit" name="submit" class="btn btn-danger">Kirim Pesan</button>
                </div>
					</form>
                
                    </div>
            </div>
        </div>
    </div>
</div>
<?php            
            if (isset($_POST['submit'])) {
           $id_siswa=$_SESSION['id_siswa'];
		   $guru=$_POST['guru'];
		   $tgl=date('Y-m-d H:i:s');
		   $id_materi=$_POST['id_materi'];
		   $komentar=$_POST['komentar'];
			mysqli_query($koneksi,"INSERT INTO komentar(id_user,id_materi,komentar,jenis,tgl,guru) VALUES('$id_siswa','$id_materi','$komentar','1','$tgl','$guru')");
	echo "
	  <script type='text/javascript'>
		setTimeout(function () { 	
			swal({
				title: 'Sukses !!!',
				text:  'Komentar Berhasil dikirim',
				type: 'success',
				timer: 2000,
				showConfirmButton: true
			});		
		},10);	
		window.setTimeout(function(){ 
			window.location.replace();
		} ,2000);	
	  </script>";
	
			}
            ?>