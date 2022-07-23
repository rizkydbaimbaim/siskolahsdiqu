<?php
defined('APLIKASI') or exit('Anda tidak dizinkan mengakses langsung script ini!');
?>
<?php if ($ac == '') { ?>
    <div class='row'>
        <div class='col-md-4'>
            <div class='box box-solid'>
                <div class='box-header with-border '>
                    <h3 class='box-title'><i class="fas fa-book fa-fw   "></i>Input Arsip Guru</h3>
                    <div class='box-tools pull-right'>
				
                    </div>
                </div><!-- /.box-header -->
                <div class='box-body'>
                   <form method="post" action="" enctype="multipart/form-data">
                    <div class='modal-body'>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Pilih Guru</label>
                                    <select name='guru' class='form-control' required='true'>
									<option value=''></option>
                                            <?php
                                            $guruQ = mysqli_query($koneksi, "SELECT * FROM pengawas WHERE level='guru'");
                                            while ($guru = mysqli_fetch_array($guruQ)) {
                                                echo "<option value='$guru[id_pengawas]'>$guru[nama]</option>";
                                            }
                                            ?>
                                        </select>
                                </div>
                            </div>
							
                            <div class="col-md-12">
                                <div class='form-group'>
                                    <label>Pilih Lemari</label>
                                  <select name='lemari' class='form-control' required='true'>
									
                                            <?php
                                            $lemariQ = mysqli_query($koneksi, "SELECT * FROM lemari WHERE untuk='2' ");
                                            while ($lemari = mysqli_fetch_array($lemariQ)) {
                                                echo "<option value='$lemari[id_lemari]'>$lemari[nama_lemari]</option>";
                                            }
                                            ?>
                                        </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
								 <label>Pilih Map</label>
                                <select name='map' class='form-control' required='true'>
									
                                            <?php
                                            $mapQ = mysqli_query($koneksi, "SELECT * FROM map WHERE untuk='2' ");
                                            while ($map = mysqli_fetch_array($mapQ)) {
                                                echo "<option value='$map[id_map]'>$map[nama_map]</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                
								 </div>
									  <div class="col-md-12">
                                <div class="form-group">
								 <label>Nama File</label>
                                <input type="text" name="namafile" class="form-control" required >
                                    </div>
								 </div>
                                  <div class="col-md-12">
                                <div class="form-group">
								 <label>Upload File</label>
                                <input name="gb1" class="form-control" type="file" required>
                                    </div>
								 </div>
                        </div>
                    </div>
                    <div class='modal-footer'>
                        <button type='submit' name='submit' class='btn btn-sm btn-flat btn-primary'><i class='fa fa-check'></i> Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

        <div class='col-md-8'>
            <div class='box box-solid'>
                <div class='box-header with-border '>
                    <h3 class='box-title'><i class="fas fa-book fa-fw   "></i>Lemari Arsip</h3>
                    <div class='box-tools pull-right'>
				
                    </div>
                </div><!-- /.box-header -->
                <div class='box-body'>
                   

                <?php
                $hariQ = mysqli_query($koneksi, "SELECT * FROM lemari WHERE untuk='2' ");
              while ($hari = mysqli_fetch_array($hariQ)){
                ?>
                            <div class="col-md-6">
                                <div class="box box-widget widget-user-2">
                                    <!-- Add the bg color to the header using any of the bg-* classes -->
                                    <div class="widget-user-header bg-maroon" style="padding: 6px">
                                        <div class="widget-user-image">
                                            <img src="../dist/img/arsip/lemari.png" alt="">
                                        </div>
                                        <!-- /.widget-user-image -->
                                        <span style="font-size: 20px"> <b>
                                             <?= $hari['kode'] ?>
                                            </b></span>
                                    </div>
                                      <?php
				$jumlah = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM map WHERE untuk='2' "));
                $mapelQ = mysqli_query($koneksi, "SELECT * FROM lemari WHERE untuk='2' ");
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
                                                     <i class='fas fa-home'></i> Lemari
                                                    <span class="pull-right"><?= $mapel['nama_lemari'] ?></span>
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
											
										<li>
                                                <a href="?pg=arsipguru&ac=lihat" title="Lihat Data">
                                                    <i class='fas fa-envelope'></i> Jumlah Map
                                                    <span class="pull-right badge bg-maroon"><?= $jumlah ?></span>
                                                </a>
                                            </li>
                                                     
                                        </ul>
                                     
                                    </div>
									
									 <?php } ?>
                                </div>
                            </div>
                       
                 
			  <?php } ?>
			   
                <?php
                $mplQ = mysqli_query($koneksi, "SELECT * FROM map WHERE untuk='2' ");
              while ($mpl = mysqli_fetch_array($mplQ)){
                ?>
                            <div class="col-md-6">
                                <div class="box box-widget widget-user-2">
                                    <!-- Add the bg color to the header using any of the bg-* classes -->
                                    <div class="widget-user-header bg-green" style="padding: 6px">
                                        <div class="widget-user-image">
                                            <img src="../dist/img/arsip/map.png" alt="">
                                        </div>
                                        <!-- /.widget-user-image -->
                                        <span style="font-size: 20px"> <b>
                                             <?= $mpl['kode'] ?>
                                            </b></span>
                                    </div>
                                      <?php
				$jumlahfile = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM arsipguru"));
                $mapQ = mysqli_query($koneksi, "SELECT * FROM map WHERE untuk='2' ");
              while ($map = mysqli_fetch_array($mapQ)){
				  $user = fetch($koneksi,'pengawas',['id_pengawas' =>$map['dibuat']]);
				 
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
                                                     <i class='fas fa-home'></i> Map
                                                    <span class="pull-right"><?= $map['nama_map'] ?></span>
                                                    </a>
                                                
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <i class='fas fa-clock'></i> Waktu
                                                    <span class="pull-right"><?= $map['tanggal'] ?> </span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <i class='fas fa-user'></i> Dibuat Oleh
                                                    <span class="pull-right"><?= $user['nama'] ?></span>
                                                </a>
                                            </li>
											
										<li>
                                                <a href="?pg=arsipguru&ac=lihat" title="Lihat Data">
                                                    <i class='fas fa-envelope'></i> Jumlah Data
                                                    <span class="pull-right badge bg-blue"><?= $jumlahfile ?></span>
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
	<?php } elseif ($ac == 'lihat') { ?>
 
        <div class='col-md-12'>
           <div class='box box-solid'>
                <div class='box-header with-border '>
                    <h3 class='box-title'><i class="fas fa-book fa-fw   "></i>Lemari Arsip</h3>
                    <div class='box-tools pull-right'>
				
                    </div>
                </div><!-- /.box-header -->
                <div class='box-body'>
                  

                <?php
                $guruQ = mysqli_query($koneksi, "SELECT * FROM pengawas WHERE level='guru'");
                 while ($guru = mysqli_fetch_array($guruQ)){
                ?>
                            <div class="col-md-4">
                                <div class="box box-widget widget-user-2">
                                    <!-- Add the bg color to the header using any of the bg-* classes -->
                                    <div class="widget-user-header bg-black" style="padding: 4px">
                                        <div class="widget-user-image">
                                            <img src="../dist/img/arsip/map.png" alt="">
                                        </div>
                                        <!-- /.widget-user-image -->
                                        <span style="font-size: 20px"> <b>
                                             <?= $guru['nama'] ?>
                                            </b></span>
                                    </div>
                                      <?php
				
                $arsipQ = mysqli_query($koneksi, "SELECT * FROM arsipguru WHERE idguru='$guru[id_pengawas]' GROUP BY idguru");
              while ($arsip = mysqli_fetch_array($arsipQ)){
			$user = fetch($koneksi,'pengawas',['id_pengawas' =>$arsip['input']]);
			$lemari = fetch($koneksi,'lemari',['id_lemari' =>$arsip['idlemari']]);
			$map = fetch($koneksi,'map',['id_map' =>$arsip['idmap']]);
			$jumlah = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM arsipguru WHERE idguru='$arsip[idguru]' "));
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
                                                     <i class='fas fa-home'></i> Lemari
                                                    <span class="pull-right"><?= $lemari['nama_lemari'] ?></span>
                                                    </a>
                                                
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <i class='fas fa-book'></i> Map
                                                    <span class="pull-right"><?= $map['nama_map'] ?> </span>
                                                </a>
                                            </li>

											
										<li>
                                                <a href="?pg=arsipguru&ac=lihatarsip&idg=<?= $arsip['idguru'] ?>" title="Detail Data">
                                                    <i class='fas fa-envelope'></i> Jumlah Data
                                                    <span class="pull-right badge bg-maroon"><?= $jumlah ?></span>
                                                </a>
                                            </li>
                                                     
                                        </ul>
                                     
                                    </div>
									
				                 <?php } ?>
                                </div>
                            </div>
							 <?php } ?>
  <?php } elseif ($ac == 'lihatarsip') { ?>
  <?php $guru = fetch($koneksi,'pengawas',['id_pengawas' =>$_GET['idg']]); ?>
    <div class='row'>
        <div class='col-md-12'>
            <div class='box box-solid'>
                <div class='box-header with-border '>
                    <h3 class='box-title'> Daftar Arsip <b><?= $guru['nama'] ?></b></h3>
						  <div class='box-tools pull-right '>
                        
                    </div>
                </div>
              
                      <div id='tabelarsip' class='table-responsive'>
                        <table id="tabelarsip" class='table table-bordered table-striped  table-hover'>
                            <thead>
                                <tr>
                                    <th width='5%'>#</th>
                                    <th>Nama File</th>
									 <th width="25%">File</th>
                                    <th width="10%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
							       <?php     
								$no=0;
                              $materiQ = mysqli_query($koneksi, "SELECT * FROM arsipguru WHERE idguru='$_GET[idg]'");
                              while ($dokumen = mysqli_fetch_array($materiQ)){
								
                              $no++;
                                ?>
								<tr>
                                        <td><?= $no ?></td>
									   <td><?= $dokumen['namafile'] ?> </td>
									   <td> <?= $dokumen['dok'] ?>
									   
									   <td style="text-align: center;">
									   <a href="mod_arsip/download.php?file=<?= $dokumen['dok'] ?>"  class="btn btn-primary btn-sm"><i class="fas fa-download"></i></a>
								         <button data-id='<?= $dokumen['id'] ?>' class="hapus btn btn-danger btn-sm" title="Hapus"><i class="fas fa-trash-alt"></i></button>
										</td>
								</tr>
							<?php } ?>
					</tbody>
                        </table>		
                </div>
            </div>
        </div>
    </div>
	     
	
	
	<?php } ?>
	<?php
            
            if (isset($_POST['submit'])) {
		$gb1 = $_FILES['gb1']['name'];
		$idg=$_POST['guru'];
		$idlemari=$_POST['lemari'];
		$idmap=$_POST['map'];
		$namafile=$_POST['namafile'];
		$tanggal=date('d-m-Y H:i:s');
		$input=$_SESSION['id_pengawas'];
		
		
	   $tmp = $_FILES['file']['tmp_name'];
	   move_uploaded_file($_FILES["gb1"]["tmp_name"],"../arsip/arsipguru/".$_FILES["gb1"]["name"]);
	   
	  $exec = mysqli_query($koneksi, "INSERT INTO arsipguru(idguru,idlemari,idmap,namafile,dok,tanggal,input) VALUES
		 ('$idg','$idlemari','$idmap','$namafile','$gb1','$tanggal','$input')");			   
	if($exec){
	echo "
	  <script type='text/javascript'>
		setTimeout(function () { 	
			swal({
				title: 'Sukses !!!',
				text:  'Dokumen Berhasil disimpan',
				type: 'success',
				timer: 2000,
				showConfirmButton: true
			});		
		},10);	
		window.setTimeout(function(){ 
			window.location.replace('?pg=arsipguru');
		} ,2000);	
	  </script>";
	
	}else{		
	echo "
	  <script type='text/javascript'>
		setTimeout(function () { 	
			swal({
				title: 'Gagal !!!',
				text:  'Dokumen Gagal disimpan, data sudah tercatat',
				type: 'error',
				timer: 2000,
				showConfirmButton: true
			});		
		},10);	
		window.setTimeout(function(){ 
			window.location.replace('?pg=dokumen');
		} ,2000);	
	  </script>";
            }
			}
            ?>
			
			<script>
			 $('#tabelarsip').on('click', '.hapus', function() {
        var id = $(this).data('id');
        console.log(id);
        swal({
            title: 'Apa anda yakin?',
            text: "akan menghapus data ini!",

            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes!'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: 'mod_arsip/hapus_arsipguru.php',
                    method: "POST",
                    data: 'id=' + id,
                    success: function(data) {
                        toastr.success('data berhasil dihapus');
                        setTimeout(function() {
                            window.location.reload();
                        }, 2000);
                    }
                });
            }
        })

    });
	</script>