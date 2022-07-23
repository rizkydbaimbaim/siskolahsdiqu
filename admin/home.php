<?php
$testongoing = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM nilai WHERE ujian_mulai!='' AND ujian_selesai=''"));
$testdone = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM nilai WHERE ujian_mulai!='' AND ujian_selesai!=''"));
if ($siswa <> 0) {
    $testongoing_per = (1000 / $siswa) * $testongoing;
    $testongoing_per = number_format($testongoing_per, 2, '.', '');
    $testongoing_per = str_replace('.00', '', $testongoing_per);
    $testdone_per = (1000 / $siswa) * $testdone;
    $testdone_per = number_format($testdone_per, 2, '.', '');
    $testdone_per = str_replace('.00', '', $testdone_per);
} else {
    $testongoing_per = $testdone_per = 0;
}
$nilai = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM nilai"));
$soal = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM mapel"));
$siswa = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM siswa"));
$ruang = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM ruang"));
$kelas = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM kelas"));
$mapel = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM mata_pelajaran"));
$online = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM jawaban"));
$ujian = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM ujian where status='1'"));
$tugas = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM tugas"));
$jawaban = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM jawaban"));
?>
<?php if ($pengawas['level'] == 'admin') : ?>
    <div class='row'>


		
		<script type="text/javascript" src="../chartjs/Chart.js"></script>
		<style type="text/css">
	body{
		font-family: roboto;
	}

	table{
		margin: 0px auto;
	}
	</style>
<?php if($setting['menu_akm']==1){ ?>
        <div class="col-lg-8" >
            <div class="box box-solid" >
                
                <div class="box-body">
                <div style="width: auto;margin: 0px auto;" >
		<canvas id="myChart"></canvas>
	</div>
             </div> 
            </div>
        </div>
		<script>
		var ctx = document.getElementById("myChart").getContext('2d');
		var myChart = new Chart(ctx, {
			type: 'bar',
			data: {
				labels: ["PG", "Multi Coice", "Benar Salah", "Menjodohkan", "Uraian Singkat"],
				datasets: [{
					label: '',
					data: [
					<?php 
					$jumlah1 = mysqli_query($koneksi,"select * from soal where jenis='1'");
					echo mysqli_num_rows($jumlah1);
					?>, 
					<?php 
					$jumlah3 = mysqli_query($koneksi,"select * from soal where jenis='3'");
					echo mysqli_num_rows($jumlah3);
					?>, 
					<?php 
					$jumlah4 = mysqli_query($koneksi,"select * from soal where jenis='4'");
					echo mysqli_num_rows($jumlah4);
					?>, 
					<?php 
					$jumlah5 = mysqli_query($koneksi,"select * from soal where jenis='5'");
					echo mysqli_num_rows($jumlah5);
					?>,
					<?php 
					$jumlah2 = mysqli_query($koneksi,"select * from soal where jenis='2'");
					echo mysqli_num_rows($jumlah2);
					?>
					],
					backgroundColor: [
					'rgba(63, 255, 0, 0.2)',
					'rgba(54, 162, 235, 0.2)',
					'rgba(255, 206, 86, 0.2)',
					'rgba(253, 215, 3, 0.2)',
					'rgba(128, 4, 0, 0.2)'
					],
					borderColor: [
					'rgba(63, 255, 0,1)',
					'rgba(54, 162, 235, 1)',
					'rgba(255, 206, 86, 1)',
					'rgba(253, 215, 3, 1)',
					'rgba(128, 4, 0, 1)'
					],
					borderWidth: 1
				}]
			},
			options: {
				scales: {
					yAxes: [{
						ticks: {
							beginAtZero:true
						}
					}]
				}
			}
		});
	</script>

	<div class='row'>
                <div class="col-lg-2">
                    <div class="small-box bg-aqua">
                        <div class="inner">
                            <h3><?= $siswa ?></h3>Data Peserta
                        </div>
                        <div class="icon">
                            <i class="fa fa-users"></i>
                        </div>
                        <a href="?pg=siswa" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
				
                <div class="col-lg-2">
                    <div class="small-box bg-purple">
                        <div class="inner">
                            <h3><?= $soal ?></h3>Data Bank Soal
                        </div>
                        <div class="icon">
                            <i class="fa fa-file"></i>
                        </div>
                        <a href="?pg=banksoal" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="small-box bg-yellow">
                        <div class="inner">
                            <h3><?= $ujian ?></h3>Data Ujian
                        </div>
                        <div class="icon">
                            <i class="fa fa-edit"></i>
                        </div>
                        <a href="?pg=jadwal" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="small-box bg-maroon">
                        <div class="inner">
                            <h3><?= $nilai ?></h3>Data Nilai
                        </div>
                        <div class="icon">
                            <i class="fa fa-file-signature"></i>
                        </div>
                        <a href="?pg=nilaiujian" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="small-box bg-green">
                        <div class="inner">
                            <h3><?= $jawaban ?></h3>Data Jawaban
                        </div>
                        <div class="icon">
                            <i class="fa fa-envelope"></i>
                        </div>
                        <a href="#" id="btnhapusjawaban" class="small-box-footer">Hapus Data <i class="fa fa-arrow-circle-right"></i></a>
                        <!-- Button trigger modal -->
                         

                    </div>
                </div>
				
                <div class="col-lg-2">
                    <div class="small-box bg-blue">
                        <div class="inner">
                            <h3><?= $mapel ?></h3>Mata Pelajaran
                        </div>
                        <div class="icon">
                            <i class="fa fa-envelope-open-text"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>
		<?php } ?>
        <div class='animated flipInX col-md-8'>
            <div class="row">
                <?php if ($setting['server'] == 'lokal') : ?>
                    <div class="col-lg-12">
                        <div class="small-box ">
                            <div class="inner">
                                <img id='loading-image' src='../dist/img/ajax-loader.gif' style='display:none; width:50px;' />
                                <p id='statusserver'></p>
                                <p>Status Server</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-desktop"></i>
                            </div>
                            <a href="?pg=sinkronset" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <script>
                        $.ajax({
                            type: 'POST',
                            url: 'mod_sinkron/statusserver.php',
                            beforeSend: function() {
                                $('#loading-image').show();
                            },
                            success: function(response) {
                                $('#statusserver').html(response);
                                $('#loading-image').hide();

                            }
                        });
                    </script>
                <?php endif; ?>
				
				<?php if($setting['menu_akm']==1){ ?>
        <div class='col-md-12'>
            <div class='box box-solid direct-chat direct-chat-warning'>
                <div class='box-header with-border' style="background-color: #800000">
                    <h3 class='box-title'>
					<?php echo $setting['aplikasi'] ?>
                    </h3>
                    <div class='box-tools pull-right'></div>
					<h3 class='box-title' >
					
					<marquee><font color="#FFFFFF">SELAMAT DATANG DI APLIKASI (SIKOLAH) SISTEM INFORMASI SEKOLAH <?= strtoupper($setting['sekolah']); ?></font></marquee>
                    </h3>
					
                </div>
				</div>
				</div>
					<?php } ?>
                <div class="col-md-12">
                    <div class='box box-solid direct-chat direct-chat-warning'>
                        <div class='box-header with-border'>
                            <h3 class='box-title'><i class='fas fa-bullhorn fa-fw'></i>
                                Pengumuman
                            </h3>
                            <div class='box-tools pull-right'>

                                <a href='?pg=<?= $pg ?>&ac=clearpengumuman' class='btn btn-default' title='Bersihkan Pengumuman'><i class='fa fa-trash'></i></a>
                            </div>
                        </div>
                        <div class='box-body'>
                            <div id='pengumuman'>
                                <p class='text-center'>
                                    <br /><i class='fa fa-spin fa-circle-o-notch'></i> Loading....
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div class='animated flipInX col-md-4'>
            <div class='box box-solid direct-chat direct-chat-warning'>
                <div class='box-header with-border'>
                    <h3 class='box-title'><i class='fa fa-history'></i> Log Aktifitas</h3>
                    <div class='box-tools pull-right'>
                        <a href='?pg=<?= $pg ?>&ac=clearlog' class='btn btn-default' title='Bersihkan Log'><i class='fa fa-trash'></i></a>
                    </div>
                </div>
				
                <div class='box-body'>
                    <div id='log-list'>
                        <p class='text-center'>
                            <br /><i class='fa fa-spin fa-circle-o-notch'></i> Loading....
                        </p>
                    </div>
                </div>
            </div>
        </div>

    </div>
	
<?php endif ?>
<?php
if ($ac == 'clearlog') {
    mysqli_query($koneksi, "TRUNCATE log");
    jump('?');
}
if ($ac == 'clearpengumuman') {
    mysqli_query($koneksi, "TRUNCATE pengumuman");
    jump('?');
}
?>
<?php if ($pengawas['level'] == 'guru' or $pengawas['level'] == 'pengawas' or $pengawas['level'] == 'kepala' or $pengawas['level'] == 'staff') : ?>

    <div class='row'>
        <div class='col-md-12'>
            <div class='box box-solid direct-chat direct-chat-warning'>
                <div class='box-header with-border'>
                    <h3 class='box-title'><i class='fa fa-bullhorn'></i> Pengumuman
                    </h3>
                    <div class='box-tools pull-right'></div>
                </div><!-- /.box-header -->
                <div class='box-body'>
                    <div id='pengumuman'>
                        <p class='text-center'>
                            <br /><i class='fa fa-spin fa-circle-o-notch'></i> Loading....
                        </p>
                    </div>
                </div>
            </div>
        </div>
		<?php if($setting['absen']=='QR Code'){ ?>
		<link rel="stylesheet" href="<?= $homeurl ?>/plugins/style.css">
		  <div class='col-md-8'>
            <div class='box box-solid direct-chat direct-chat-warning'>
                <div class='box-header with-border'>
                    <h3 class='box-title'><i class='fa fa-camera'></i>ABSEN QR CODE
                    </h3>
                    <div class='box-tools pull-right'></div>
                </div>
				<form method="post" action="" enctype="multipart/form-data">
				<?php
								$tgl=date('Y-m-d');
                            $query = mysqli_query($koneksi, "select * FROM absen_guru WHERE guru='$_SESSION[id_pengawas]' AND tanggal='$tgl' ORDER BY id DESC ");  
                            $absen = (mysqli_fetch_array($query));
                               
                            ?>
				<?php if($absen['guru']<>'' AND $absen['tanggal']==$tgl AND $absen['keluar']==''){ ?>
							 <center> <label>Silahkan Lakukan Absen Lagi Saat Pulang</label></center><br>
                      <center><h3>ABSEN MASUK TERCATAT</h3></center>
					  <?php } ?>
					  <?php if($absen['guru']<>'' AND $absen['tanggal']==$tgl AND $absen['keluar']<>''){ ?>
							 <center> <label>Terima Kasih Anda telah bekerja penuh</label></center><br>
                      <center><h3>ABSEN PULANG TERCATAT</h3></center>
					  <?php } ?>
					  <?php if($absen['guru']=='' AND $absen['tanggal']<>$tgl){ ?>
                     <center><h3>BELUM ABSEN</h3></center>
					  <?php } ?>
                <div class='box-body'>
                   
                      <div class="col-md-12">
				
                         <center> <select class="form-control" id="camera-select"></select></center>
					</div>
					</div>
					<div class="panel-body text-center">
                      <div class="col-md-12">
                          <div class="well" style="position: middle;">
                              <canvas width="315" height="315" name='qrcode' id="webcodecam-canvas"></canvas>
                              <div class="scanner-laser laser-rightBottom" style="opacity: 0.5;"></div>
                              <div class="scanner-laser laser-rightTop" style="opacity: 0.5;"></div>
                              <div class="scanner-laser laser-leftBottom" style="opacity: 0.5;"></div>
                              <div class="scanner-laser laser-leftTop" style="opacity: 0.5;"></div>
                         </div>
					 </div>
                    </form>
					 </div>
            </div>
        </div>
		 <script type="text/javascript" src="<?= $homeurl ?>/plugins/jquery.min.js"></script>
               <script src="<?= $homeurl ?>/plugins/qrcodelib.js"></script>
                  <script src="<?= $homeurl ?>/plugins/webcodecamjquery.js"></script>
                  <script src="<?= $homeurl ?>/plugins/scan.js"></script>
		<?php } ?>
		
		
		<?php if($setting['absen']=='Photo'){ ?>
		  <div class='col-md-8'>
            <div class='box box-solid direct-chat direct-chat-warning'>
                <div class='box-header with-border'>
                    <h3 class='box-title'><i class='fa fa-camera'></i>ABSEN PHOTO
                    </h3>
                    <div class='box-tools pull-right'></div>
                </div>
				<form method="post" action="" enctype="multipart/form-data">
				<?php
								$tgl=date('Y-m-d');
                            $query = mysqli_query($koneksi, "select * FROM absen_guru WHERE guru='$_SESSION[id_pengawas]' AND tanggal='$tgl' ORDER BY id DESC ");  
                            $absen = (mysqli_fetch_array($query));
                               
                            ?>
				<?php if($absen['guru']<>'' AND $absen['tanggal']==$tgl AND $absen['gambar']<>''){ ?>
							 <center> <label>Silahkan Lakukan Absen Lagi Saat Pulang</label></center><br>
                      <center><img src="../berkas/<?= $absen['gambar'] ?>" width="200"></center>
					  <?php } ?>
					  <?php if($absen['gambar']==''){ ?>
                       
                      <center><img src="../dist/img/avatar.png" width="200"></center>
					  <?php } ?>
                <div class='box-body'>
                   
                      <div class="col-md-12">
				
                        <label>Ambil Photo</label>
                      <input name="MAX_FILE_SIZE" type="hidden" value="3000000" />  
	              <input name="file" class="form-control" type="file" accept="image/*" capture / required>
                    
					</div>
					</div>
					<div class="modal-footer">
                  <button type="submit" name="submit" class="btn btn-primary">Kirim Absen</button>
                </div>
                    </form>
					<?php            
            if (isset($_POST['submit'])) {
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
				$tgl = date('Y-m-d');
                
				$masuk=date('H:i:s');

$cekdata = "SELECT * FROM absen_guru WHERE tanggal='$tgl' AND status='1'  AND guru='$guru'";
$jikaada = mysqli_query($koneksi,$cekdata);
if(mysqli_num_rows($jikaada)>0){
	$query = "SELECT * FROM absen_guru WHERE guru='".$guru."'";
		$sql = mysqli_query($koneksi, $query); 
		$data = mysqli_fetch_array($sql);

		if(is_file("../berkas/".$data['gambar'])) 
			unlink("../berkas/".$data['gambar']); 
	mysqli_query($koneksi,"UPDATE absen_guru SET keluar='$masuk', status='1',gambar='' WHERE guru='$guru'");
	echo "
	  <script type='text/javascript'>
		setTimeout(function () { 	
			swal({
				title: 'Sukses !!!',
				text:  'Absen Pulang Sudah Tercatat',
				type: 'success',
				timer: 2000,
				showConfirmButton: true
			});		
		},10);	
		window.setTimeout(function(){ 
			window.location.replace('?pg=abmanual');
		} ,2000);	
	  </script>";
		
	}else{
   

	 $compressedImage = compressImage($tmp, $path, 32);
	
mysqli_query($koneksi,"INSERT INTO absen_guru(guru,tanggal,masuk,status,idqr,ket,gambar) values('$guru','$tgl','$masuk','1','1','H','$fotobaru')");
if($koneksi){
echo"

	  <script type='text/javascript'>
		setTimeout(function () { 	
			swal({
				title: 'Sukses !!!',
				text:  'Absen Masuk Sudah Tercatat',
				type: 'success',
				timer: 2000,
				showConfirmButton: true
			});		
		},10);	
		window.setTimeout(function(){ 
			window.location.replace('?pg=abmanual');
		} ,2000);	
	  </script>";
                }
            }
			}
			
            ?>
                
            </div>
        </div>
		<?php } ?>
		
        <div class='col-md-4'>
            <div class='box box-solid '>
                <div class='box-body'>
                    <strong><i class='fa fa-building-o'></i> <?= $setting['sekolah'] ?></strong><br />
                    <?= $setting['alamat'] ?><br /><br />
                    <strong><i class='fa fa-phone'></i> Telepon</strong><br />
                    <?= $setting['telp'] ?><br /><br />
                    <strong><i class='fa fa-fax'></i> Fax</strong><br />
                    <?= $setting['fax'] ?><br /><br />
                    <strong><i class='fa fa-globe'></i> Website</strong><br />
                    <?= $setting['web'] ?><br /><br />
                    <strong><i class='fa fa-at'></i> E-mail</strong><br />
                    <?= $setting['email'] ?><br />
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>
    
	<?php if($setting['menu_mbs']==1 AND $setting['jadwal']=='Guru' OR $setting['jadwal']=='Semua'){ ?>
<?php include"mod_mbs/jadwalmengajar.php" ?>
<?php } ?>
<?php endif ?>