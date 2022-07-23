<?php
defined('APLIKASI') or exit('Anda tidak dizinkan mengakses langsung script ini!');
?>
    <div class='row'>
        <div class='col-md-4'>
            <div class='box box-solid'>
                <div class='box-header with-border '>
                    <h3 class='box-title'><i class="fas fa-book fa-fw   "></i>Map Arsip</h3>
                    <div class='box-tools pull-right'>
				
                    </div>
                </div><!-- /.box-header -->
                <div class='box-body'>
                   <form method="post" action="" enctype="multipart/form-data">
                    <div class='modal-body'>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Kode Map</label>
                                    <input type="text" class="form-control" name="kode" autocomplete="off" required>

                                </div>
                            </div>
							
                            <div class="col-md-12">
                                <div class='form-group'>
                                    <label>Nama Map</label>
                                    <input type="text" class="form-control" name="nama" autocomplete="off" required>
                                </div>
                            </div>
                        <div class='col-md-12'>
								<div class='form-group'>
                                    <label>Map Untuk</label>
                                    <select name='untuk' class='form-control' required='true'>
									    <option value=''></option>   
                                        <option value='1'>Siswa</option>   
										<option value='2'>Guru</option>   
										<option value='3'>Tata Usaha</option>  
                                    </select>
                                </div>
                            </div>
							</div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                <?php if ($pengawas['level'] == 'admin') : ?>
                                   
                                        <label>Dibuat Oleh</label></br>
                                        <select name='guru' class='form-control' required='true'>
                                            <?php
                                            $guruku = mysqli_query($koneksi, "SELECT * FROM pengawas where level='admin' order by nama asc");
                                            while ($guru = mysqli_fetch_array($guruku)) {
                                                echo "<option value='$guru[id_pengawas]'>$guru[nama]</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                <?php endif; ?>
								<?php if ($pengawas['level'] == 'staff') : ?>
                                   
                                        <label>Dibuat Oleh</label></br>
                                        <select name='guru' class='form-control' required='true'>
                                            <?php
                                            $guruku = mysqli_query($koneksi, "SELECT * FROM pengawas where level='staff' order by nama asc");
                                            while ($guru = mysqli_fetch_array($guruku)) {
                                                echo "<option value='$guru[id_pengawas]'>$guru[nama]</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                <?php endif; ?>
								 </div>

                                 <div class='form-group'>
                                <div class='col-md-12'>

                                    <label>Status </label>
                                    <select name='status' class='form-control' required='true'>
                                        <option value='1'>Aktif</option>
                                       
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class='modal-footer'>
                        <button type='submit' name='submit' class='btn btn-sm btn-flat btn-success'><i class='fa fa-check'></i> Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
	
   <?php
            
            if (isset($_POST['submit'])) {
                $tanggal = date('d-m-Y H:i:s');
				$kode = $_POST['kode'];
                $nama = $_POST['nama'];
				$guru = $_POST['guru'];
				$untuk = $_POST['untuk'];
                if ($kode <> '' and $nama <> '') {
                    if ($kode== $nama) {
                       echo "
	  <script type='text/javascript'>
		setTimeout(function () { 	
			swal({
				title: 'Gagal !!!',
				text:  'Data Gagal di simpan',
				type: 'error',
				timer: 2000,
				showConfirmButton: true
			});		
		},10);	
		window.setTimeout(function(){ 
			window.location.replace('?pg=lemari');
		} ,2000);	
	  </script>";
                    
					} else {   
		 $exec = mysqli_query($koneksi, "INSERT INTO map(kode,nama_map,dibuat,tanggal,untuk) VALUES('$kode','$nama','$guru','$tanggal','$untuk')");			   
                   echo "
	  <script type='text/javascript'>
		setTimeout(function () { 	
			swal({
				title: 'Sukses !!!',
				text:  'Data berhasil di simpan',
				type: 'success',
				timer: 2000,
				showConfirmButton: true
			});		
		},10);	
		window.setTimeout(function(){ 
			window.location.replace('?pg=map');
		} ,2000);	
	  </script>";
				   }
                }
            }
            ?>
        <div class='col-md-8'>
            <div class='box box-solid'>
                <div class='box-header with-border '>
                    <h3 class='box-title'><i class="fas fa-book fa-fw   "></i>Map Arsip</h3>
                    <div class='box-tools pull-right'>
				
                    </div>
                </div><!-- /.box-header -->
                <div class='box-body'>
                   

                <?php
                $mapQ = mysqli_query($koneksi, "SELECT * FROM map");
              while ($map = mysqli_fetch_array($mapQ)){
                ?>
                            <div class="col-md-6">
                                <div class="box box-widget widget-user-2">
                                    <!-- Add the bg color to the header using any of the bg-* classes -->
                                    <div class="widget-user-header bg-yellow" style="padding: 6px">
                                        <div class="widget-user-image">
                                            <img src="../dist/img/arsip/map.png" alt="">
                                        </div>
                                        <!-- /.widget-user-image -->
                                        <span style="font-size: 20px"> <b>
                                             <?= $map['kode'] ?>
                                            </b></span>
                                    </div>
                                      <?php
                $mapelQ = mysqli_query($koneksi, "SELECT * FROM map WHERE kode='$map[kode]' ");
              while ($mapel = mysqli_fetch_array($mapelQ)){
				  $user = fetch($koneksi,'pengawas',['id_pengawas' =>$mapel['dibuat']]);
                ?>
                                    <div class="box-footer no-padding">
                                        <ul class="nav nav-stacked">
                                            <li>
                                               
                                                    <a href="#">
                                                     <i class='fas fa'></i> 
                                                    <span class="pull-right badge bg-aqua"></span>
                                                    </a>
                                                
                                            </li>
											<li>
                                               
                                                    <a href="#">
                                                     <i class='fas fa-home'></i> Nama Map
                                                    <span class="pull-right"><?= $mapel['nama_map'] ?></span>
                                                    </a>
                                                
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <i class='fas fa-clock'></i> Waktu
                                                    <span class="pull-right"><?= $mapel['tanggal'] ?> </span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <i class='fas fa-user'></i> Dibuat Oleh
                                                    <span class="pull-right"><?= $user['nama'] ?></span>
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