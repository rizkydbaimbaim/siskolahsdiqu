<?php
defined('APLIKASI') or exit('Anda tidak dizinkan mengakses langsung script ini!');
?>
<?php if ($ac == '') { ?>
    <div class='col-md-12'>
        <div class='box box-solid' style='background-color:aqua'>
            <div class='box-header with-border'>
                <h3 class='box-title'><i class="fas fa-file-pdf"></i> Mata Pelajaran</h3>
            </div><!-- /.box-header -->
            <div class='box-body' style='background-color:#000'>

                <?php
                $kelasQ = mysqli_query($koneksi, "SELECT * FROM siswa GROUP BY id_kelas");
              while ($kelas = mysqli_fetch_array($kelasQ)){
                ?>
                            <div class="col-md-4">
                                <div class="box box-widget widget-user-2">
                                    <!-- Add the bg color to the header using any of the bg-* classes -->
                                    <div class="widget-user-header bg-blue" style="padding: 6px">
                                        <div class="widget-user-image">
                                            <img src="../dist/img/soal.png" alt="">
                                        </div>
                                        <!-- /.widget-user-image -->
                                        <span style="font-size: 20px"> <b>
                                             Kelas  <?= $kelas['id_kelas'] ?>
                                            </b></span>
                                    </div>
                                      <?php
                $mapelQ = mysqli_query($koneksi, "SELECT * FROM jadwal_mapel WHERE kelas='$kelas[id_kelas]' AND guru='$_SESSION[id_pengawas]'");
              while ($mapel = mysqli_fetch_array($mapelQ)){
				  $user = fetch($koneksi,'pengawas',['id_pengawas' =>$mapel['guru']]);
                ?>
                                    <div class="box-footer no-padding">
                                        <ul class="nav nav-stacked">
                                            <li>
                                               
                                                    <a href="#">
                                                     <i class='fas fa-book'></i> Mata Pelajaran
                                                    <span class="pull-right badge bg-aqua"><?= $mapel['kode'] ?></span>
                                                    </a>
                                                
                                            </li>
											<li>
                                               
                                                    <a href="#">
                                                     <i class='fas fa-home'></i> Kelas
                                                    <span class="pull-right badge bg-yellow"><?= $mapel['kelas'] ?></span>
                                                    </a>
                                                
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <i class='fas fa-clock'></i> Waktu
                                                    <span class="pull-right badge bg-green"><?= $mapel['dari'] ?> - <?= $mapel['sampai'] ?></span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <i class='fas fa-user'></i> Nama Guru
                                                    <span class="pull-right badge bg-red"><?= $user['nama'] ?></span>
                                                </a>
                                            </li>
												 <li>
                                                <a href="?pg=rpp&ac=buatrpp&id=<?= $mapel['id_jadwal'] ?>">
                                                    <i class='fas fa-file-pdf'></i> <b style="color:red;"> Buat Rpp</b>
                                                    <span class="pull-right badge bg-red"><?= $mapel['kode'] ?></span>
                                                </a>
                                            </li>
                                        </ul>
                                    
                                    </div>
									
									 <?php } ?>
                                </div>
                                <!-- /.widget-user -->
                            </div>
                       
                 
			  <?php } ?>

            </div>
        </div>
    </div>
	
	<div class='row'>
        <div class='col-md-12'>
            <div class='box box-solid'>
                <div class='box-header with-border '>
                    <h3 class='box-title'> Daftar RPP Satu Lembar</b></h3>
						  <div class='box-tools pull-right '>
                        
                    </div>
                </div>
              
                      <div class='box-body'>
                    <div class='table-responsive'>
                        <table style="font-size: 12px" id='tablemateri' class='table table-bordered table-striped'>
                            <thead>
                                <tr>
                                    <th width='5%'>#</th>
									<th width="30%">Mapel</th>
									<th width="5%">Kelas</th>
									<th width="20%">Alokasi</th>
									<th>Materi</th>
                                    <th width="25%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
							       <?php     
								$no=0;
                              $rppQ = mysqli_query($koneksi, "SELECT * FROM jadwal_mapel JOIN rpp ON rpp.idmapel=jadwal_mapel.id_jadwal WHERE jadwal_mapel.guru='$_SESSION[id_pengawas]'");
                              while ($rpp = mysqli_fetch_array($rppQ)){
								
                              $no++;
                                ?>
								<tr>
                                        <td><?= $no ?></td>
										<td><?= $rpp['mapel'] ?> </td>
										<td><?= $rpp['kelas'] ?> </td>
									   <td><?= $rpp['alokasi'] ?> </td>
									   <td><?= $rpp['materi'] ?> </td>
									
									  <td>
									  <a href="?pg=rpp&ac=lihat3&id=<?= $rpp['id_rpp'] ?>" class='btn btn-sm bg-aqua' title="RPP Model 3"><i class='fa fa-print'></i></button></a>
									  <a href="?pg=rpp&ac=lihat2&id=<?= $rpp['id_rpp'] ?>" class='btn btn-sm bg-yellow' title="RPP Model 2"><i class='fa fa-print'></i></button></a>
									   <a href="?pg=rpp&ac=lihat&id=<?= $rpp['id_rpp'] ?>" class='btn btn-sm bg-green' title="RPP Model 1"><i class='fa fa-print'></i></button></a>
								   <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modaledit<?= $rpp['id_rpp'] ?>" title="Edit">
                                                    <i class="fas fa-edit    "></i>
                                                </button>
								   <button data-id='<?= $rpp['id_rpp'] ?>' class="hapus btn btn-danger btn-sm" title="Hapus"><i class="fas fa-trash-alt"></i></button>
								   </td>
                                    </tr>
                                     <div class="modal fade" id="modaledit<?= $rpp['id_rpp'] ?>" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                                        <div class="modal-dialog modal-lg" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header bg-blue">

                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form id="formeditmateri<?= $rpp['id_rpp'] ?>">
                                                    <div class="modal-body">
                                                        <input type="hidden" value="<?= $rpp['id_rpp'] ?>" name='id'>
														
                        <div class="row">
						   <div class="col-md-7">
                                <div class="form-group">
                                    <label>Mata Pelajaran </label>
                                   	<input type="text" class="form-control" value="<?= $rpp['mapel'] ?>" disabled>
                                </div>
                            </div>
							<div class="col-md-2">
                                <div class="form-group">
                                    <label>Kelas </label>
                                   	<input type="text"  class="form-control" value="<?= $rpp['kelas'] ?>" disabled>
                                </div>
                            </div>
							<?php $rapor=fetch($koneksi,'setting_rapor',['id'=>1]); ?>
							<div class="col-md-3">
                                <div class="form-group">
                                    <label>Semester </label>
                                   	<input type="text"  class="form-control" value="<?= $rapor['semester'] ?> - <?= $rapor['tp'] ?>" disabled>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Materi / Sub Materi </label>
                                   	<input type="text" name="materi" class="form-control" value="<?= $rpp['materi'] ?>" autocomplete="off" required>
                                </div>
                            </div>
							<div class="col-md-12">
                                <div class="form-group">
                                    <label>Alokasi Waktu</label>
										<input type="text" name="waktu" class="form-control" value="<?= $rpp['alokasi'] ?>" required>
                                </div>
                            </div>
                            
								 <div class="col-md-12">
                                <div class="form-group">
								 <label>Sisipan Materi Pokok</label>
                                	<input type="text" name="sisipan" class="form-control" value="<?= $rpp['sisipan'] ?>" autocomplete="off" required>
                                    </div>
								 </div>
								 <div class="col-md-12">
                                <div class="form-group">
								 <label>Tanggal RPP</label>
								 <input type="text" class="form-control datepicker" name="tgl" id="tgl" value="<?= $rpp['tanggal'] ?>" autocomplete="off" required>
                        </div>
                    </div>
                    </div>
				</div>
				<div class='modal-footer'>
                       <div class='box-tools pull-right btn-group'>
                          <button type='submit'  class='btn btn-sm btn-primary'><i class='fa fa-check'></i> Simpan</button>
                              <button type='button' class='btn btn-default btn-sm pull-left' data-dismiss='modal'>Close</button>
                                </div>
                                 </div>
                </form>
							  <script>
                                        $('#formeditmateri<?= $rpp['id_rpp'] ?>').submit(function(e) {
                                            e.preventDefault();
                                            var data = new FormData(this);
                                            $.ajax({
                                                type: 'POST',
                                                url: 'staff/edit_rpp.php',
                                                enctype: 'multipart/form-data',
                                                data: data,
                                                cache: false,
                                                contentType: false,
                                                processData: false,
                                                success: function(data) {
                                                    //toastr.error(data);
                                                    if (data == "ok") {
                                                        toastr.success("materi RPP berhasil dirubah");
                                                    } else {
                                                        toastr.error(data);
                                                    }
                                                    $('#modaledit<?= $rpp['id_rpp'] ?>').modal('hide');
                                                    setTimeout(function() {
                                                        location.reload();
                                                    }, 2000);

                                                }
                                            });
                                            return false;
                                        });
                                    </script>
							  <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
		</div>
	
	
	
	
	
<?php } elseif ($ac == 'buatrpp') { ?>
  <?php 
  $id=$_GET['id']; 
  $mapel=fetch($koneksi,'jadwal_mapel',['id_jadwal'=>$id]);
 $rapor=fetch($koneksi,'setting_rapor',['id'=>1]);
  ?>
	
	<div class='row'>
        <div class='col-md-8'>
            <div class='box box-solid' >
                <div class='box-header with-border '>
                    <h3 class='box-title'><i class="fas fa-book fa-fw   "></i>Input Pembuatan Rpp</h3>
                   
                </div>
               
                   <form method="post" action="" enctype="multipart/form-data">
				 <div class='modal-footer'>
               <div class='box-tools pull-right btn-group'>
                 <button type='submit' name='submit' class='btn btn-sm btn-primary'><i class='fa fa-check'></i> Simpan</button>
                  
                       </div>
                 </div>
                    <div class='modal-body' >
                        <div class="row">
						   <div class="col-md-7">
                                <div class="form-group">
                                    <label>Mata Pelajaran </label>
                                   	<input type="text" class="form-control" value="<?= $mapel['mapel'] ?>" disabled>
                                </div>
                            </div>
							<div class="col-md-2">
                                <div class="form-group">
                                    <label>Kelas </label>
                                   	<input type="text"  class="form-control" value="<?= $mapel['kelas'] ?>" disabled>
                                </div>
                            </div>
							<div class="col-md-3">
                                <div class="form-group">
                                    <label>Semester </label>
                                   	<input type="text"  class="form-control" value="<?= $rapor['semester'] ?> - <?= $rapor['tp'] ?>" disabled>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Materi / Sub Materi <small style="color:red;"> (* Jangan terlalu panjang, karena berpengaruh pada cetak)</small></label>
                                   	<input type="text" name="materi" class="form-control" placeholder="Contoh : Perbandingan trigonometri di segitiga siku-siku 1" autocomplete="off" required>
                                </div>
                            </div>
							<div class="col-md-12">
                                <div class="form-group">
                                    <label>Alokasi Waktu <small style="color:red;"> (* SD-35 menit, SLTP-40 menit, SLTA-45 menit)</small></label>
										<input type="text" name="waktu" class="form-control" placeholder="Contoh : 4 x JP @40 menit" required>
                                </div>
                            </div>
                            
								 <div class="col-md-12">
                                <div class="form-group">
								 <label>Sisipan Materi Pokok</label>
                                	<input type="text" name="sisipan" class="form-control" placeholder="Contoh : perbandingan trigonometri di segitiga siku-siku 1" autocomplete="off" required>
                                    </div>
								 </div>
								 <div class="col-md-12">
                                <div class="form-group">
								 <label>Tanggal RPP</label>
								 <input type="text" class="form-control datepicker" name="tgl" id="tgl" autocomplete="off" required>
                        </div>
                    </div>
                    </div>
				</div>
                </form>
            </div>
        </div>
    </div>
	<?php
            
            if (isset($_POST['submit'])) {
		$materi=$_POST['materi'];
		$waktu=$_POST['waktu'];
	    $sisipan=$_POST['sisipan'];
		 $tgl=$_POST['tgl'];
		$id=$_GET['id'];
	  $exec = mysqli_query($koneksi, "INSERT INTO rpp(idmapel,tanggal,materi,alokasi,sisipan) VALUES('$id', '$tgl', '$materi', '$waktu', '$sisipan')");		   
	if($exec){
	echo "
	  <script type='text/javascript'>
		setTimeout(function () { 	
			swal({
				title: 'Sukses !!!',
				text:  'Data Berhasil disimpan',
				type: 'success',
				timer: 1000,
				showConfirmButton: true
			});		
		},10);	
		window.setTimeout(function(){ 
			window.location.replace('?pg=rpp');
		} ,1000);	
	  </script>";
	
	}
			}
            ?>
	
<?php } elseif ($ac == 'lihat') { ?>
  <?php 
  $id = $_GET['id'];
$rpp=fetch($koneksi,'rpp',['id_rpp' => $id]);
$t=explode("-", $rpp['tanggal']);
$tanggal=$t[2];
$mapel=fetch($koneksi,'jadwal_mapel',['id_jadwal' => $rpp['idmapel']]);
$bl =$t[1];
$th=$t[0];
$bulane = fetch ($koneksi, 'bulan', ['bln' =>$bl]);
$rapor=fetch($koneksi,'setting_rapor',['id'=>1]);
$user=fetch($koneksi,'pengawas',['id_pengawas'=>$_SESSION['id_pengawas']]);
  ?>	
	<div class='row'>
        <div class='col-md-12'>
            <div class='box box-solid'>
                <div class='box-header with-border '>
                    <h3 class='box-title'>RPP Satu Lembar <b><?= $mapel['kode'] ?> Model 1</b></h3>
						  <div class='box-tools pull-right '>
                         <button class='btn btn-sm btn-flat btn-primary' onclick="frames['frameresultRPP'].print()"><i class='fa fa-print'></i> Cetak </button>
              <?php if($pengawas['level']=='guru'){ ?>
				 <a href='?pg=rpp' class='btn btn-sm bg-maroon' title='Batal'><i class='fa fa-times'></i></a>
			  <?php }else{ ?>
			   <a href='?pg=rpp&ac=adminrpp' class='btn btn-sm bg-maroon' title='Batal'><i class='fa fa-times'></i></a>
			    <?php } ?>
                    </div>
                </div>
	 
   <center><h5>RENCANA PELAKSANAAN PEMBELAJARAN (RPP)</h5></center>
   <br>
   
  <div class='box-body'>
                    <div class='table-responsive'>
   <table style="font-size: 12px" class='table'>
	<tbody>
          
			 <tr>
                <td width="130px">Nama Sekolah</td>
				<td width="10px">:</td>
				<td><?= $setting['sekolah'] ?></td>
            </tr>
                <tr>
                <td>Mata Pelajaran</td>
				<td>:</td>
				<td><?= $mapel['mapel'] ?></td>
            </tr>
                <tr>
                <td>Kelas / Semester</td>
				<td>:</td>
				<td><?= $mapel['kelas'] ?> / <?= $rapor['semester'] ?></td>
            </tr>
			<tr>
                <td>Materi Pokok</td>
				<td>:</td>
				<td><?= $rpp['materi'] ?></td>
            </tr>		
                <tr>
                <td>Tahun Pelajaran</td>
				<td>:</td>
				<td><?= $rapor['tp'] ?></td>
            </tr>
			<tr>
                <td>Alokasi Waktu</td>
				<td>:</td>
				<td><?= $rpp['alokasi'] ?></td>
            </tr>
			</tbody>
    </table>
	<div>
	<p>
	<div style="padding-left:5px;" class="col-md-12">
   <table>
	<tr>
	<b>1. TUJUAN PEMBELAJARAN</b>
    <td style="text-align: justify;">Setelah mengikuti proses pembelajaran, peserta didik diharapkan memahami konsep / menganalisa / menyelesaikan masalah kontekstual yang berkaitan dengan <?= $rpp['sisipan'] ?></td>
	</tr>
	</table>
	<p>
	<table>
	<tr>
	<b>2. MEDIA/ALAT, BAHAN DAN SUMBER BELAJAR</b>
	<td width="130px"><li> Media</td>
	<td>:</td>
	<td>Worksheet atau lembar kerja (peserta didik), Lembar penilaian</td>
	</tr>
	<tr>
	<td><li> Alat/Bahan</td>
	<td>:</td>
	<td>Spidol, papan tulis, laptop dan infocus</td>
	</tr>
	<tr>
	<td><li> Sumber belajar</td>
	<td>:</td>
	<td>Buku mapel <?= $mapel['mapel'] ?> Kelas <?= $mapel['kelas'] ?> / <?= $rapor['semester'] ?> Kemdikbud</td>
	</tr>
	</table>
	<p>
	<table>
	<tr>
	<b>3. KEGIATAN PEMBELAJARAN</b>
	<td><b>a. Kegiatan Pendahuluan</b></td>
	 </tr>
	 <tr>
	<td style="text-align: justify;"><li> Guru mengucapkan salam, memimpin doa, absensi, mengisi jurnal dan mengecek kesiapan peserta didik dilanjutkan Apersepsi dengan
	bercerita / menampilkan gambar / memutar video, menyampaikan tujuan dan manfaat materi <?= $rpp['sisipan'] ?>, cakupan materi,
	langkah pembelajaran dan tekhnik penilaian.</td>
	</tr>
	<tr>
	<td><b>b. Kegiatan Inti</b></td>
	 </tr>
	 <tr>
	<td style="text-align: justify;"><li> Peserta didik mengetahui tujuan pembelajaran dan manfaat apa yang dipelajari.</td>
	</tr>
	<tr>
	<td style="text-align: justify;"><li> Peserta didik diminta menghubungkan pelajaran sebelumnya dengan pembelajaran yang akan dipelajari yaitu tentang <?= $rpp['sisipan'] ?>.</td>
	</tr>
	<tr>
	<td style="text-align: justify;"><li> Peserta didik diminta mengamati gambar atau video maupun membaca materi tentang <?= $rpp['sisipan'] ?>.</td>
	</tr>
	<tr>
	<td style="text-align: justify;"><li> Guru memberikan keseempatan untuk mengidentifikasi sebanyak mungkin hal yang belum dipahami, dimulai dari
	pertanyaan faktual sampai ke pertanyaan yang bersifat hipotetik berkaitan dengan materi <?= $rpp['sisipan'] ?>.</td>
	</tr>
	<tr>
	<td style="text-align: justify;"><li> Peserta didik dibimbing membentuk kelompok.</td>
	</tr>
	<tr>
	<td style="text-align: justify;"><li> Peserta didik secara berkelompok berdiskusi dan mengerjakan Lembar Kerja Peserta Didik (LKPD) yang berisi tentang <?= $rpp['sisipan'] ?>.</td>
	</tr>
	<tr>
	<td style="text-align: justify;"><li> Peserta didik mempresentasikan hasil kerja kelompoknya di depan kelas terkait materi <?= $rpp['sisipan'] ?>. Kelompok yang lain menanggapi.</td>
	</tr>
	<tr>
	<td><b>c. Kegiatan Penutup</b></td>
	</tr>
	<tr>
	<td style="text-align: justify;"><li> Guru bersama peserta didik membuat rangkuman/kesimpulan pelajaran tentang point-point penting yang muncul dalam kegiatan pembelajaran
    yang baru dilakukan terkait <?= $rpp['sisipan'] ?>.</td>
	</tr>
	<tr>
	<td style="text-align: justify;"><li> Guru memberikan penguatan terhadap materi yang sudah dipelajari dengan memberikan penugasan dan menyampaikan rencana pembelajaran selanjutnya, serta di akhiri salam penutup.</td>
	</tr>
	</table>
	<p>
	<table>
	<tr>
	<b>4. PENILAIAN (ASSESMENT)</b>
	<td style="text-align: justify;"><b>Penilaian Pengetahuan :</b> berupa tes tertulis pilihan ganda & tertulis uraian, tes lisan / observasi terhadap diskusi tanya jawab dan percakapan serta penugasan.</td>
	 </tr>
	<tr>
	<td style="text-align: justify;"><b>Penilaian Keterampilan :</b> berupa penilaian unjuk kerja, penilaian proyek, penilaian produk dan penilaian portopolio.</td>
	 </tr>
	</table>
	</div>
	<p>
	<?php if($pengawas['level']=='guru'){ ?>
   <table border='0' style="margin-left: 30px;width:700">
					<tr>
						<td>
							Mengetahui, <br/>
							Kepala Sekolah <br/>
							<br/>
							<br/>
							<br/>
							<u><?= $setting['kepsek'] ?></u><br/>
							NIP. <?= $setting['nip'] ?>
						</td>
						<td width='600px'></td>
						<td>
							<?= $setting['kecamatan'] ?>, <?= $tanggal ?> <?= $bulane['ket'] ?> <?= $th ?><br/>
							Guru Mata Pelajaran<br/>
							<br/>
							<br/>
							<br/>
							<u><?= $user['nama'] ?></u><br/>
							NIP. <?= $user['nip'] ?>
						</td>
					</tr>
				</table>
	<?php } ?>
    </div>
	</div>
	</div>
	<iframe id='loadframe' name='frameresultRPP' src='staff/cetakrpp.php?id=<?= $id ?>' style='display:none'></iframe>
	
	
	<?php } elseif ($ac == 'lihat2') { ?>
  <?php 
  $id = $_GET['id'];
$rpp=fetch($koneksi,'rpp',['id_rpp' => $id]);
$t=explode("-", $rpp['tanggal']);
$tanggal=$t[2];
$mapel=fetch($koneksi,'jadwal_mapel',['id_jadwal' => $rpp['idmapel']]);
$bl =$t[1];
$th=$t[0];
$bulane = fetch ($koneksi, 'bulan', ['bln' =>$bl]);
$rapor=fetch($koneksi,'setting_rapor',['id'=>1]);
$user=fetch($koneksi,'pengawas',['id_pengawas'=>$_SESSION['id_pengawas']]);
  ?>	
	<div class='row'>
        <div class='col-md-12'>
            <div class='box box-solid'>
                <div class='box-header with-border '>
                    <h3 class='box-title'>RPP Satu Lembar <b><?= $mapel['kode'] ?> Model 2</b></h3>
						  <div class='box-tools pull-right '>
                         <button class='btn btn-sm btn-flat btn-primary' onclick="frames['frameresultRPP2'].print()"><i class='fa fa-print'></i> Cetak </button>
              <?php if($pengawas['level']=='guru'){ ?>
				 <a href='?pg=rpp' class='btn btn-sm bg-maroon' title='Batal'><i class='fa fa-times'></i></a>
			  <?php }else{ ?>
			   <a href='?pg=rpp&ac=adminrpp' class='btn btn-sm bg-maroon' title='Batal'><i class='fa fa-times'></i></a>
			    <?php } ?>
                    </div>
                </div>
	 
   
   <center><h5>RENCANA PELAKSANAAN PEMBELAJARAN (RPP)</h5></center>
   <br>
   <div class='box-body'>
   <div class='table-responsive'>
   <table style="font-size: 12px" class='table'>
  
	<tbody>
          
			 <tr>
                <td width="130px">Nama Sekolah</td>
				<td width="10px">:</td>
				<td><?= $setting['sekolah'] ?></td>
            </tr>
                <tr>
                <td>Mata Pelajaran</td>
				<td>:</td>
				<td><?= $mapel['mapel'] ?></td>
            </tr>
                <tr>
                <td>Kelas / Semester</td>
				<td>:</td>
				<td><?= $mapel['kelas'] ?> / <?= $rapor['semester'] ?></td>
            </tr>
			<tr>
                <td>Materi Pokok</td>
				<td>:</td>
				<td><?= $rpp['materi'] ?></td>
            </tr>		
                <tr>
                <td>Tahun Pelajaran</td>
				<td>:</td>
				<td><?= $rapor['tp'] ?></td>
            </tr>
			<tr>
                <td>Alokasi Waktu</td>
				<td>:</td>
				<td><?= $rpp['alokasi'] ?></td>
            </tr>
			</tbody>
    </table>
	<div>
	<p>
	<div style="padding-left:5px;" class="col-md-12">
   <table>
	<tr>
	<b>1. TUJUAN PEMBELAJARAN</b>
    <td style="text-align: justify;">Setelah mengikuti proses pembelajaran, peserta didik diharapkan memahami konsep / menganalisa / menyelesaikan masalah kontekstual yang berkaitan dengan <?= $rpp['sisipan'] ?></td>
	</tr>
	</table>
	
	<table>
	<tr>
	<b>2. MEDIA/ALAT, BAHAN DAN SUMBER BELAJAR</b>
	<td width="130px"><li> Media</td>
	<td>:</td>
	<td>Worksheet atau lembar kerja (peserta didik), Lembar penilaian</td>
	</tr>
	<tr>
	<td><li> Alat/Bahan</td>
	<td>:</td>
	<td>Spidol, papan tulis, laptop dan infocus</td>
	</tr>
	<tr>
	<td><li> Sumber belajar</td>
	<td>:</td>
	<td>Buku mapel <?= $mapel['mapel'] ?> Kelas <?= $mapel['kelas'] ?> / <?= $rapor['semester'] ?> Kemdikbud</td>
	</tr>
	</table>
	
	<table>
	<tr>
	<b>3. KEGIATAN PEMBELAJARAN</b>
	<td><b>a. Kegiatan Pendahuluan</b></td>
	 </tr>
	 <tr>
	<td style="text-align: justify;"><li> Melakukan pembukaan dengan salam pembuka dan berdoa untuk memulai pembelajaran, memeriksa kehadiran peserta didik sebagai sikap disiplin.</td>
	</tr>
	<tr>
	<td style="text-align: justify;"><li> Mengaitkn materi/tema/kegiatan pembelajaran yang akan dilakukan dengan pengalaman peserta didik dengan materi/tema/kegiatan sebelumnya serta mengajukan pertanyaan untuk mengingat dan menghubungkan dengan materi selanjutnya.</td>
	</tr>
	<tr>
	<td style="text-align: justify;"><li> Menyampaikan motivasi tentang apa yang dapat diperoleh (tujuan & manfaat) dengan mempelajari materi <?= $rpp['sisipan'] ?>.</td>
	</tr>
	<tr>
	<td style="text-align: justify;"><li> Menjelaskan hal-hal yang akan dipelajari, kompetensi yang akan dicapai, serta metode belajar yang akan ditempuh.</td>
	</tr>
	<tr>
	<td><b>b. Kegiatan Inti</b></td>
	 </tr>
	 </table>
	 <table border='1'>
	 <tr>
	<td width="130px"><b>&nbsp;Kegiatan Literasi</b></td> <td>Peserta didik diberi motivasi dan panduan untuk melihat, mengamati, membaca dan menuiskannya kembali. Mereka diberi tayangan dan bahan bacaan terkait materi <?= $rpp['sisipan'] ?>.</td>
	</tr>
	<tr>
	<td width="130px"><b>&nbsp;Critical Thinking</b></td> <td>Guru memberikan keseempatan untuk mengidentifikasi sebanyak mungkin hal yang belum dipahami, dimulai dari
	pertanyaan faktual sampai ke pertanyaan yang bersifat hipotetik berkaitan dengan materi <?= $rpp['sisipan'] ?>.</td>
	</tr>
	<tr>
	<td width="130px"><b>&nbsp;Collaboration</b></td> <td> Peserta didik dibentuk dalam beberapa kelompok untuk mendiskusikan, mengumpulkan informasi, mempresentasikan ulang, dan saling bertukar informasi mengenai <?= $rpp['sisipan'] ?>.</td>
	</tr>
	<tr>
	<td width="130px"><b>&nbsp;Communication</b></td> <td> Peserta didik mempresentasikan hasil kerja kelompok atau individu secara klasikal, mengemukakan pendapat atas presentasi yang dilakukan, kemudian  ditanggapi kembali oleh kelompok atau individu yang mempresentasikan.</td>
	</tr>
	<tr>
	<td width="130px"><b>&nbsp;Creativity</b></td> <td> Guru dan peserta didik membuat kesimpulan tentang hal-hal yang telah dipelajari yang muncul dalam kegiatan pembelajaran terkait <?= $rpp['sisipan'] ?>. Peserta didik kemudian diberi kesempatan untuk menanyakan kembali hal-hal yang belum dipahami.</td>
	</tr>
	</table>
	<table>
	<tr>
	<td><b>c. Kegiatan Penutup</b></td>
	</tr>
	<tr>
	<td style="text-align: justify;"><li> Guru bersama peserta didik membuat rangkuman/kesimpulan pelajaran tentang point-point penting yang muncul dalam kegiatan pembelajaran
    yang baru dilakukan terkait <?= $rpp['sisipan'] ?>.</td>
	</tr>
	<tr>
	<td style="text-align: justify;"><li> Guru memberikan penguatan terhadap materi yang sudah dipelajari dengan memberikan penugasan dan menyampaikan rencana pembelajaran selanjutnya, serta di akhiri salam penutup.</td>
	</tr>
	</table>
	
	<table>
	<tr>
	<b>4. PENILAIAN (ASSESMENT)</b>
	<td style="text-align: justify;"><b>Penilaian Pengetahuan :</b> berupa tes tertulis pilihan ganda & tertulis uraian, tes lisan / observasi terhadap diskusi tanya jawab dan percakapan serta penugasan.</td>
	 </tr>
	<tr>
	<td style="text-align: justify;"><b>Penilaian Keterampilan :</b> berupa penilaian unjuk kerja, penilaian proyek, penilaian produk dan penilaian portopolio.</td>
	 </tr>
	</table>
	</div>
	<p>
	<?php if($pengawas['level']=='guru'){ ?>
   <table border='0' style="margin-left: 30px;width:700">
					<tr>
						<td>
							Mengetahui, <br/>
							Kepala Sekolah <br/>
							<br/>
							<br/>
							<br/>
							<u><?= $setting['kepsek'] ?></u><br/>
							NIP. <?= $setting['nip'] ?>
						</td>
						<td width='600px'></td>
						<td>
							<?= $setting['kecamatan'] ?>, <?= $tanggal ?> <?= $bulane['ket'] ?> <?= $th ?><br/>
							Guru Mata Pelajaran<br/>
							<br/>
							<br/>
							<br/>
							<u><?= $user['nama'] ?></u><br/>
							NIP. <?= $user['nip'] ?>
						</td>
					</tr>
				</table>
	<?php } ?>
    </div>
	</div>
	</div>
	<iframe id='loadframe' name='frameresultRPP2' src='staff/cetakrpp2.php?id=<?= $id ?>' style='display:none'></iframe>
	
		<?php } elseif ($ac == 'lihat3') { ?>
  <?php 
  $id = $_GET['id'];
$rpp=fetch($koneksi,'rpp',['id_rpp' => $id]);
$t=explode("-", $rpp['tanggal']);
$tanggal=$t[2];
$mapel=fetch($koneksi,'jadwal_mapel',['id_jadwal' => $rpp['idmapel']]);
$bl =$t[1];
$th=$t[0];
$bulane = fetch ($koneksi, 'bulan', ['bln' =>$bl]);
$rapor=fetch($koneksi,'setting_rapor',['id'=>1]);
$user=fetch($koneksi,'pengawas',['id_pengawas'=>$_SESSION['id_pengawas']]);
  ?>	
	<div class='row'>
        <div class='col-md-12'>
            <div class='box box-solid'>
                <div class='box-header with-border '>
                    <h3 class='box-title'>RPP Satu Lembar <b><?= $mapel['kode'] ?> Model 3</b></h3>
						  <div class='box-tools pull-right '>
                         <button class='btn btn-sm btn-flat btn-primary' onclick="frames['frameresultRPP3'].print()"><i class='fa fa-print'></i> Cetak </button>
              <?php if($pengawas['level']=='guru'){ ?>
				 <a href='?pg=rpp' class='btn btn-sm bg-maroon' title='Batal'><i class='fa fa-times'></i></a>
			  <?php }else{ ?>
			   <a href='?pg=rpp&ac=adminrpp' class='btn btn-sm bg-maroon' title='Batal'><i class='fa fa-times'></i></a>
			    <?php } ?>
                    </div>
                </div>
	 
   
   <center><h5>RENCANA PELAKSANAAN PEMBELAJARAN (RPP)</h5></center>
   <br>
   <div class='box-body'>
   <div class='table-responsive'>
   <table style="font-size: 12px" class='table'>
  
	<tbody>
          
			 <tr>
                <td width="130px">Nama Sekolah</td>
				<td width="10px">:</td>
				<td><?= $setting['sekolah'] ?></td>
            </tr>
                <tr>
                <td>Mata Pelajaran</td>
				<td>:</td>
				<td><?= $mapel['mapel'] ?></td>
            </tr>
                <tr>
                <td>Kelas / Semester</td>
				<td>:</td>
				<td><?= $mapel['kelas'] ?> / <?= $rapor['semester'] ?></td>
            </tr>
			<tr>
                <td>Materi Pokok</td>
				<td>:</td>
				<td><?= $rpp['materi'] ?></td>
            </tr>		
                <tr>
                <td>Tahun Pelajaran</td>
				<td>:</td>
				<td><?= $rapor['tp'] ?></td>
            </tr>
			<tr>
                <td>Alokasi Waktu</td>
				<td>:</td>
				<td><?= $rpp['alokasi'] ?></td>
            </tr>
			</tbody>
    </table>
	<div>
	<p>
	<div style="padding-left:5px;" class="col-md-12">
   <table>
	<tr>
	<b>A. TUJUAN PEMBELAJARAN</b>
    <td style="text-align: justify;">Setelah melaksanakan kegiatan melalui model based learning, siswa mampu menerapkan <?= $rpp['sisipan'] ?> dalam menyelesaikan masalah, mencari data/bahan/alat 
	yang diperlukan untuk menyelesaikan masalah, melakukan penyelidikan untuk bahan diskusi kelompok, melakukan diskusi untuk menghasilkan solusi pemecahan masalah, mempresentasikan hasil diskusi, 
	membuat kesimpulan, memiliki karakter (religiositas, integritas, nasionalisme, gotong royong, dan kemandirian) dan memiliki kemampuan literasi 
	(baca tulis, numerasi, sains, digital, financial, budaya dan kewargaan) untuk membiasakan siswa dalam berfikir kritis, kreativitas, komunikasi dan kolaborasi.</td>
	</tr>
	</table>
	<p>
	<table>
	<tr>
	<b>B. KEGIATAN PEMBELAJARAN</b>
	<td><b>a. Kegiatan Pendahuluan</b></td>
	 </tr>
	 <tr>
	<td> Sebelumnya, siswa diarahkan literasi sebelum pembelajaran. Untuk menguatkan karakter, guru mengucapkan salam dan membiasakan siswa untuk berdoa, cek kebersihan kelas, menanamkan rasa cinta tanah air dan kejujuran dilanjutkan apersepsi tentang <?= $rpp['sisipan'] ?> dalam menyelesaikan masalah dengan memberikan stimulus melalui media pembelajaran (PPT) serta menyampaikan tujuan pembelajaran.</td>
	</tr>
	
	<tr>
	<td><b>b. Kegiatan Inti</b></td>
	 </tr>
	 </table>
	 <table>
	 <tr>
	<td>1. Menyampaikan masalah yang akan dipecahkan secara kelompok dan tiap kelompok mengamati dan memahami masalah yang disampaikan guru atau yang diperoleh dari bahan bacaan yang disarankan.</td>
	</tr>
	<tr>
	<td>2. Peserta berdiskusi dan membagi tugas untuk mencari data/bahan/alat yang diperlukan untuk menyelesaikan masalah dan guru memastikan setiap anggota memahami tugas masing-masing.</td>
	</tr>
	<tr>
	<td>3. Peserta melakukan penyelidikan untuk bahan diskusi kelompok dan guru memantau keterlibatan peserta didik selama proses penyelidikan (membimbing penyelidikan individu maupun kelompok).</td>
	</tr>
	<tr>
	<td>4. Kelompok melakukan diskusi untuk menghasilkan solusi pemecahan masalah dan hasilnya dipresentasikan, sedangkan guru memantau diskusi dan membimbing pembuatan laporan sehingga tiap kelompok siap untuk dipresentasikan.</td>
	</tr>
	<tr>
	<td>5. Setiap kelompok melakukan presentasi, guru membimbing presentasi dan mendorong kelompok lain memberikan apresiasi serta masukan pada kelompok lain.</td>
	</tr>
	</table>
	<table>
	<tr>
	<td><b>c. Kegiatan Penutup</b></td>
	</tr>
	<tr>
	<td>Membuat simpulan, refleksi umpan balik, penugasan, pesan-pesan moral, dan menyampaikan informasi kegiatan pembelajaran yang akan datang dan berdoa.</td>
	</tr>
	
	</table>
	<p>
	<table>
	<tr>
	<b>C. PENILAIAN (ASSESMENT)</b>
	<td>Penilaian sikap (jurnal perkembangan sikap), penilaian pengetahuan (tes tulis, lisan, penugasan) dan penilaian keterampilan (penilaian unjuk kerja, penilaian proyek, dan penilaian portopolio).</td>
	 </tr>
	<tr>
	<td>Pembelajaran remedial dan pengayaan.</td>
	 </tr>
	</table>
	</div>
	<p>
	<?php if($pengawas['level']=='guru'){ ?>
   <table border='0' style="margin-left: 30px;width:700">
					<tr>
						<td>
							Mengetahui, <br/>
							Kepala Sekolah <br/>
							<br/>
							<br/>
							<br/>
							<u><?= $setting['kepsek'] ?></u><br/>
							NIP. <?= $setting['nip'] ?>
						</td>
						<td width='600px'></td>
						<td>
							<?= $setting['kecamatan'] ?>, <?= $tanggal ?> <?= $bulane['ket'] ?> <?= $th ?><br/>
							Guru Mata Pelajaran<br/>
							<br/>
							<br/>
							<br/>
							<u><?= $user['nama'] ?></u><br/>
							NIP. <?= $user['nip'] ?>
						</td>
					</tr>
				</table>
	<?php } ?>
    </div>
	</div>
	</div>
	<iframe id='loadframe' name='frameresultRPP3' src='staff/cetakrpp3.php?id=<?= $id ?>' style='display:none'></iframe>
	
	
	<?php } elseif ($ac == 'adminrpp') { ?>
	<div class='row'>
        <div class='col-md-12'>
            <div class='box box-solid'>
                <div class='box-header with-border '>
                    <h3 class='box-title'> Daftar RPP Satu Lembar</b></h3>
						  <div class='box-tools pull-right '>
                        
                    </div>
                </div>
              
                      <div class='box-body'>
                    <div class='table-responsive'>
                        <table style="font-size: 12px" id='tablemateri' class='table table-bordered table-striped'>
                            <thead>
                                <tr>
                                    <th width='5%'>#</th>
									<th width="30%">Mapel</th>
									<th width="5%">Kelas</th>
									<th width="20%">Alokasi</th>
									<th>Materi</th>
                                    <th width="25%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
							       <?php     
								$no=0;
                              $rppQ = mysqli_query($koneksi, "SELECT * FROM jadwal_mapel JOIN rpp ON rpp.idmapel=jadwal_mapel.id_jadwal");
                              while ($rpp = mysqli_fetch_array($rppQ)){
								
                              $no++;
                                ?>
								<tr>
                                        <td><?= $no ?></td>
										<td><?= $rpp['mapel'] ?> </td>
										<td><?= $rpp['kelas'] ?> </td>
									   <td><?= $rpp['alokasi'] ?> </td>
									   <td><?= $rpp['materi'] ?> </td>
									
									  <td>
									    <a href="?pg=rpp&ac=lihat3&id=<?= $rpp['id_rpp'] ?>" class='btn btn-sm bg-aqua' title="RPP Model 3"><i class='fa fa-print'></i></button></a>
									  <a href="?pg=rpp&ac=lihat2&id=<?= $rpp['id_rpp'] ?>" class='btn btn-sm bg-yellow' title="RPP Model 2"><i class='fa fa-print'></i></button></a>
									   <a href="?pg=rpp&ac=lihat&id=<?= $rpp['id_rpp'] ?>" class='btn btn-sm bg-green' title="RPP Model 1"><i class='fa fa-print'></i></button></a>
								   <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modaledit<?= $rpp['id_rpp'] ?>" title="Edit">
                                                    <i class="fas fa-edit    "></i>
                                                </button>
								   <button data-id='<?= $rpp['id_rpp'] ?>' class="hapus btn btn-danger btn-sm" title="Hapus"><i class="fas fa-trash-alt"></i></button>
								   </td>
                                    </tr>
                                     <div class="modal fade" id="modaledit<?= $rpp['id_rpp'] ?>" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                                        <div class="modal-dialog modal-lg" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header bg-blue">

                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form id="formeditmateri<?= $rpp['id_rpp'] ?>">
                                                    <div class="modal-body">
                                                        <input type="hidden" value="<?= $rpp['id_rpp'] ?>" name='id'>
														
                        <div class="row">
						   <div class="col-md-7">
                                <div class="form-group">
                                    <label>Mata Pelajaran </label>
                                   	<input type="text" class="form-control" value="<?= $rpp['mapel'] ?>" disabled>
                                </div>
                            </div>
							<div class="col-md-2">
                                <div class="form-group">
                                    <label>Kelas </label>
                                   	<input type="text"  class="form-control" value="<?= $rpp['kelas'] ?>" disabled>
                                </div>
                            </div>
							<?php $rapor=fetch($koneksi,'setting_rapor',['id'=>1]); ?>
							<div class="col-md-3">
                                <div class="form-group">
                                    <label>Semester </label>
                                   	<input type="text"  class="form-control" value="<?= $rapor['semester'] ?> - <?= $rapor['tp'] ?>" disabled>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Materi / Sub Materi </label>
                                   	<input type="text" name="materi" class="form-control" value="<?= $rpp['materi'] ?>" autocomplete="off" required>
                                </div>
                            </div>
							<div class="col-md-12">
                                <div class="form-group">
                                    <label>Alokasi Waktu</label>
										<input type="text" name="waktu" class="form-control" value="<?= $rpp['alokasi'] ?>" required>
                                </div>
                            </div>
                            
								 <div class="col-md-12">
                                <div class="form-group">
								 <label>Sisipan Materi Pokok</label>
                                	<input type="text" name="sisipan" class="form-control" value="<?= $rpp['sisipan'] ?>" autocomplete="off" required>
                                    </div>
								 </div>
								 <div class="col-md-12">
                                <div class="form-group">
								 <label>Tanggal RPP</label>
								 <input type="text" class="form-control datepicker" name="tgl" id="tgl" value="<?= $rpp['tanggal'] ?>" autocomplete="off" required>
                        </div>
                    </div>
                    </div>
				</div>
				<div class='modal-footer'>
                       <div class='box-tools pull-right btn-group'>
                          <button type='submit'  class='btn btn-sm btn-primary'><i class='fa fa-check'></i> Simpan</button>
                              <button type='button' class='btn btn-default btn-sm pull-left' data-dismiss='modal'>Close</button>
                                </div>
                                 </div>
                </form>
							  <script>
                                        $('#formeditmateri<?= $rpp['id_rpp'] ?>').submit(function(e) {
                                            e.preventDefault();
                                            var data = new FormData(this);
                                            $.ajax({
                                                type: 'POST',
                                                url: 'staff/edit_rpp.php',
                                                enctype: 'multipart/form-data',
                                                data: data,
                                                cache: false,
                                                contentType: false,
                                                processData: false,
                                                success: function(data) {
                                                    //toastr.error(data);
                                                    if (data == "ok") {
                                                        toastr.success("materi RPP berhasil dirubah");
                                                    } else {
                                                        toastr.error(data);
                                                    }
                                                    $('#modaledit<?= $rpp['id_rpp'] ?>').modal('hide');
                                                    setTimeout(function() {
                                                        location.reload();
                                                    }, 2000);

                                                }
                                            });
                                            return false;
                                        });
                                    </script>
							  <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
		</div>
	
	
	
	
<?php } ?>

<script>
 $('#tablemateri').on('click', '.hapus', function() {
        var id = $(this).data('id');
        console.log(id);
        swal({
            title: 'Apa anda yakin?',
            text: "akan menghapus materi ini!",

            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes!'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: 'staff/hapus_rpp.php',
                    method: "POST",
                    data: 'id=' + id,
                    success: function(data) {
                        toastr.success('materi RPP berhasil dihapus');
                        setTimeout(function() {
                            window.location.reload();
                        }, 2000);
                    }
                });
            }
        })

    });
	</script>