<?php
defined('APLIKASI') or exit('Anda tidak dizinkan mengakses langsung script ini!');
?>
<?php if ($ac == '') { ?>
    <div class='row'>
        <div class='col-md-4'>
            <div class='box box-solid'>
                <div class='box-header with-border '>
                    <h3 class='box-title'><i class="fas fa-book fa-fw   "></i>Input Arsip Kelas</h3>
                    <div class='box-tools pull-right'>
				
                    </div>
                </div><!-- /.box-header -->
                <div class='box-body'>
                   <form method="post" action="?pg=dokumen&ac=lihat">
                    <div class='modal-body'>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Pilih Kelas</label>
                                    <select name='kelas' class='form-control' required='true'>
									<option value=''></option>
                                            <?php
                                            $kelasQ = mysqli_query($koneksi, "SELECT * FROM siswa GROUP BY id_kelas");
                                            while ($kelas = mysqli_fetch_array($kelasQ)) {
                                                echo "<option value='$kelas[id_kelas]'>$kelas[id_kelas]</option>";
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
                                            $lemariQ = mysqli_query($koneksi, "SELECT * FROM lemari WHERE untuk='1' ");
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
                                            $mapQ = mysqli_query($koneksi, "SELECT * FROM map WHERE untuk='1' ");
                                            while ($map = mysqli_fetch_array($mapQ)) {
                                                echo "<option value='$map[id_map]'>$map[nama_map]</option>";
                                            }
                                            ?>
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

        <div class='col-md-8'>
            <div class='box box-solid'>
                <div class='box-header with-border '>
                    <h3 class='box-title'><i class="fas fa-book fa-fw   "></i>Lemari Arsip</h3>
                    <div class='box-tools pull-right'>
				
                    </div>
                </div><!-- /.box-header -->
                <div class='box-body'>
                   

                <?php
                $hariQ = mysqli_query($koneksi, "SELECT * FROM lemari WHERE untuk='1' ");
              while ($hari = mysqli_fetch_array($hariQ)){
                ?>
                            <div class="col-md-6">
                                <div class="box box-widget widget-user-2">
                                    <!-- Add the bg color to the header using any of the bg-* classes -->
                                    <div class="widget-user-header bg-aqua" style="padding: 6px">
                                        <div class="widget-user-image">
                                            <img src="../dist/img/arsip/lemari.png" alt="">
                                        </div>
                                        <!-- /.widget-user-image -->
                                        <span style="font-size: 20px"> <b>
                                             <?= $hari['kode'] ?>
                                            </b></span>
                                    </div>
                                      <?php
				$jumlah = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM map WHERE untuk='1' "));
                $mapelQ = mysqli_query($koneksi, "SELECT * FROM lemari WHERE untuk='1' ");
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
                                               <a href="?pg=dokumen&ac=lihatarsip" title="Lihat Data">
                                                    <i class='fas fa-envelope'></i> Jumlah Map
                                                    <span class="pull-right badge bg-red" ><?= $jumlah ?></span>
                                                </a>
                                            </li>
                                                     
                                        </ul>
                                     
                                    </div>
									
									 <?php } ?>
                                </div>
                            </div>
                       
                 
			  <?php } ?>
			   
                <?php
                $mplQ = mysqli_query($koneksi, "SELECT * FROM map WHERE untuk='1' ");
              while ($mpl = mysqli_fetch_array($mplQ)){
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
                                             <?= $mpl['kode'] ?>
                                            </b></span>
                                    </div>
                                      <?php
				$jumlahfile = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM arsip"));
                $mapQ = mysqli_query($koneksi, "SELECT * FROM map WHERE untuk='1' ");
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
                                                <a href="?pg=dokumen&ac=lihatarsip" title="Lihat Data">
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
    <?php 
	$kelas= $_POST['kelas'];
	$idlemari= $_POST['lemari'];
	$idmap= $_POST['map'];
	?>
    <div class='row'>
        <div class='col-md-12'>
            <div class='box box-solid'>
                <div class='box-header with-border '>
                    <h3 class='box-title'> Daftar Arsip Siswa</h3>
						  <div class='box-tools pull-right '>
                        
                    </div>
                </div>
              
                      <div id='tablekomentar' class='table-responsive'>
                        <table id="tabelkomen" class='table table-bordered table-striped  table-hover'>
                            <thead>
                                <tr>
                                    <th width='5%'>#</th>
                                    <th>Nama Siswa</th>
                                    <th width="5%">SKHUN</th>
                                    <th width="5%">Ijazah</th>
                                    <th width="5%">KK</th>
                                    <th width="5%">KTP Ayah</th>
									 <th width="5%">KTP Ibu</th>
									 <th width="5%">KIP/KPS</th>
                                    <th width='5%'>Input</th>
                                </tr>
                            </thead>
                            <tbody>
							       <?php     
								$no=0;
                              $materiQ = mysqli_query($koneksi, "SELECT * FROM siswa WHERE id_kelas='$kelas'");
                              while ($siswa = mysqli_fetch_array($materiQ)){
								$dok=fetch($koneksi,'arsip',['idsiswa'=>$siswa['id_siswa']]);
                              $no++;
                                ?>
								<tr>
                                        <td><?= $no ?></td>
									   <td><?= $siswa['nama'] ?> </td>
									   <td> 
									   <?php if($dok['skhun']=='1') { ?>
									   Ada
									   <?php }else{ ?>
									   <?php } ?>
									   </td>
									  <td> 
									   <?php if($dok['ijazah']=='1') { ?>
									   Ada
									   <?php }else{ ?>
									   <?php } ?>
									   </td>
									    <td> 
									   <?php if($dok['kk']=='1') { ?>
									   Ada
									   <?php }else{ ?>
									   <?php } ?>
									   </td>
									    <td> 
									   <?php if($dok['ktp_ayah']=='1') { ?>
									   Ada
									   <?php }else{ ?>
									   <?php } ?>
									   </td>
									    <td> 
									   <?php if($dok['ktp_ibu']=='1') { ?>
									   Ada
									   <?php }else{ ?>
									   <?php } ?>
									   </td>
									    <td> 
									   <?php if($dok['kip']=='1') { ?>
									   Ada
									   <?php }else{ ?>
									   <?php } ?>
									   </td>
									   <td>
									   <a href="?pg=dokumen&ac=input&idlemari=<?= $idlemari ?>&idmap=<?= $idmap ?>&ids=<?= $siswa['id_siswa'] ?>" class="btn btn-success btn-sm"><i class="fas fa-plus"></i></a>
								        </td>
								</tr>
							<?php } ?>
					</tbody>
                        </table>		
                </div>
            </div>
        </div>
    </div>
	<?php } elseif ($ac == 'lihatarsip') { ?>
  
    <div class='row'>
        <div class='col-md-12'>
            <div class='box box-solid'>
                <div class='box-header with-border '>
                    <h3 class='box-title'> Daftar Arsip Siswa</h3>
						  <div class='box-tools pull-right '>
                        
                    </div>
                </div>
              
                      <div id='tablekomentar' class='table-responsive'>
                        <table id="tabelkomen" class='table table-bordered table-striped  table-hover'>
                            <thead>
                                <tr >
                                    <th width='3%'>#</th>
                                    <th>Nama</th>
									<th width="5%" style="text-align: center;">Kelas</th>
									<th width="10%" style="text-align: center;">SKHUN</th>
                                    <th width="10%" style="text-align: center;">Ijazah</th>
                                    <th width="10%" style="text-align: center;">KK</th>
                                    <th width="10%" style="text-align: center;">KTP Ayah</th>
									 <th width="10%" style="text-align: center;">KTP Ibu</th>
									 <th width="10%" style="text-align: center;">KIP/KPS</th>
									 <th width="5%" style="text-align: center;">Thn Masuk</th>
									 <th width="5%" style="text-align: center;">Thn Keluar</th>
									 <th width="5%" style="text-align: center;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
							       <?php     
								$no=0;
                              $dokQ = mysqli_query($koneksi, "SELECT * FROM arsip WHERE keluar=''");
                              while ($dokumen = mysqli_fetch_array($dokQ)){
								$siswa=fetch($koneksi,'siswa',['id_siswa'=>$dokumen['idsiswa']]);
                              $no++;
                                ?>
								<tr>
                                        <td><?= $no ?></td>
										<td><?= $siswa['nama'] ?></td>
										<td style="text-align: center;"><?= $siswa['id_kelas'] ?></td>
									   <td style="text-align: center;">
									   <?php if($dokumen['gb_skhun']<>''){ ?>
									   <a href="mod_arsip/downloadarsip.php?file=<?= $dokumen['gb_skhun'] ?>"  class="btn btn-primary btn-sm"><i class="fas fa-download"></i></a>
								       <?php }else{ ?>
									  <font style="color:red;">Tidak Ada File</font>
									   <?php } ?>
									   </td>
									   <td style="text-align: center;">
									   <?php if($dokumen['gb_ijazah']<>''){ ?>
									   <a href="mod_arsip/downloadarsip.php?file=<?= $dokumen['gb_ijazah'] ?>"  class="btn btn-primary btn-sm"><i class="fas fa-download"></i></a>
								       <?php }else{ ?>
									   <font style="color:red;">Tidak Ada File</font>
									   <?php } ?>
									   </td>
									   <td style="text-align: center;">
									   <?php if($dokumen['gb_kk']<>''){ ?>
									   <a href="mod_arsip/downloadarsip.php?file=<?= $dokumen['gb_kk'] ?>"  class="btn btn-primary btn-sm"><i class="fas fa-download"></i></a>
								       <?php }else{ ?>
									   <font style="color:red;">Tidak Ada File</font>
									   <?php } ?>
									   </td>
									   <td style="text-align: center;">
									   <?php if($dokumen['gb_ktpayah']<>''){ ?>
									   <a href="mod_arsip/downloadarsip.php?file=<?= $dokumen['gb_ktpayah'] ?>"  class="btn btn-primary btn-sm"><i class="fas fa-download"></i></a>
								       <?php }else{ ?>
									   <font style="color:red;">Tidak Ada File</font>
									   <?php } ?>
									   </td>
									   <td style="text-align: center;">
									   <?php if($dokumen['gb_ktpibu']<>''){ ?>
									   <a href="mod_arsip/downloadarsip.php?file=<?= $dokumen['gb_ktpibu'] ?>"  class="btn btn-primary btn-sm"><i class="fas fa-download"></i></a>
								       <?php }else{ ?>
									   <font style="color:red;">Tidak Ada File</font>
									   <?php } ?>
									   </td>
									   <td style="text-align: center;">
									   <?php if($dokumen['gb_kip']<>''){ ?>
									   <a href="mod_arsip/downloadarsip.php?file=<?= $dokumen['gb_kip'] ?>"  class="btn btn-primary btn-sm"><i class="fas fa-download"></i></a>
								       <?php }else{ ?>
									   <font style="color:red;">Tidak Ada File</font>
									   <?php } ?>
									   </td>
									   <td style="text-align: center;"><?= $dokumen['masuk'] ?></td>
									   <td style="text-align: center;"><?= $dokumen['keluar'] ?></td>
									   <td>
									   <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modaledit<?= $no ?>" title="Edit">
                                                    <i class="fas fa-edit    "></i>
                                                </button>
												</td>
												<div class="modal fade" id="modaledit<?= $no ?>" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                                        <div class="modal-dialog modal-md" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header bg-blue">

                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form id="formeditmateri<?= $no ?>">
                                                    <div class="modal-body">
                                                        <input type="hidden" name='id' value="<?= $dokumen['id_arsip'] ?>" >
                                                        <div class="form-group">
														<label>Pilih Kelulusan</label><br>      
														<select name='tindakan' class='form-control' style='width:100%' required>
                                                             <option value="1">Lulus</option>
															 <option value="0">Tidak Lulus</option>
                                                            </select>
                                                        </div>
														
                                                        <div class="form-group">
                                                         <label>Tahun Lulus</label><br>
                                                            <input type="text" class="form-control" name="keluar"  required>
                                                        </div>
														
                                                                </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Save</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
								</tr>
								
							<?php } ?>
							<script>
                                        $('#formeditmateri<?= $no ?>').submit(function(e) {
                                             e.preventDefault();
											$.ajax({
											type: 'POST',
											url: 'mod_arsip/edit_arsip.php',
										data: $(this).serialize(),
										success: function(data) {
									iziToast.success({
								title: 'Sukses!',
							message: 'Data Berhasil disimpan',
						position: 'topRight'
                });
                setTimeout(function() {
                    window.location.reload();
                }, 2000);
                $('#tambahdata').modal('hide');
                //$('#bodyreset').load(location.href + ' #bodyreset');
            }
        });
        return false;
    });
                                    </script>
					</tbody>
                        </table>		
                </div>
            </div>
        </div>
    </div>
	     
	<?php } elseif ($ac == 'input') { ?>
     <?php 
	  $ids = $_GET['ids']; 
	  $idlemari = $_GET['idlemari']; 
	  $idmap = $_GET['idmap'];
	 $siswa = mysqli_fetch_array(mysqli_query($koneksi,"SELECT * FROM siswa WHERE id_siswa='$ids' "));
	 $lemari = mysqli_fetch_array(mysqli_query($koneksi,"SELECT * FROM siswa WHERE id_lemari='$idlemari' "));
	 $map = mysqli_fetch_array(mysqli_query($koneksi,"SELECT * FROM siswa WHERE id_siswa='$idmap' "));
	 ?>
    <div class='row'>
        <div class='col-md-12'>
            <div class='box box-solid'>
                <div class='box-header with-border '>
				 <form method="post" action="" enctype="multipart/form-data">
                    <h3 class='box-title'> Input Arsip</h3>
						  <div class='box-tools pull-right '>
                        <button type='submit' name='simpan' class='btn btn-sm btn-flat btn-success'><i class='fa fa-check'></i> Simpan</button>
                   
                    </div>
                </div>
             
                    <div class='modal-body'>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Nama</label>
                                    <input type="text" name="nama" value="<?= $siswa['nama'] ?>" class="form-control" disabled>
									<input type="hidden" name="ids" value="<?= $ids ?>" class="form-control" >
									<input type="hidden" name="idlemari" value="<?= $idlemari ?>" class="form-control" >
									<input type="hidden" name="idmap" value="<?= $idmap ?>" class="form-control" >
									<input type="hidden" name="kelas" value="<?= $siswa['id_kelas'] ?>" class="form-control" >
                                </div>
                            </div>
							<div class="col-md-6">
                                <div class='form-group'>
                                    <label>Lemari</label>
                                  <select name='lemari' class='form-control' required='true' disabled>
                                            <?php
                                            $lemariQ = mysqli_query($koneksi, "SELECT * FROM lemari WHERE id_lemari='$idlemari' ");
                                            while ($lemari = mysqli_fetch_array($lemariQ)) {
                                                echo "<option value='$lemari[id_lemari]'>$lemari[nama_lemari]</option>";
                                            }
                                            ?>
                                        </select>
                                </div>
                            </div>
								<div class="col-md-6">
                                <div class='form-group'>
                                    <label>Map</label>
                                  <select name='map' class='form-control' required='true' disabled>
									
                                            <?php
                                            $mapQ = mysqli_query($koneksi, "SELECT * FROM map WHERE id_map='$idmap' ");
                                            while ($map = mysqli_fetch_array($mapQ)) {
                                                echo "<option value='$map[id_map]'>$map[nama_map]</option>";
                                            }
                                            ?>
                                        </select>
                                </div>
                            </div>
					       <div class="col-md-12">
                                <div class="form-group">
                                    <label for="" style="color: blue;">Tahun Masuk <b>( <?= $siswa['nama'] ?> )</b></label>
                                    <input type="number" name="masuk"  class="form-control" required>
                                </div>
                            </div>
                                <div class="col-md-6">
                                <div class='form-group'>
                                    <label>SKHUN</label>
                                  <select name='skhun' class='form-control' required='true'>
									<option value=''></option>
                                     <option value='1'>Ada</option>
									 <option value='0'>Tidak Ada</option>
                                        </select>
                                </div>
                            </div>
                              <div class='col-md-6'>
								<div class='form-group'>
                                    <label>Upload SKHUN <small>(jika ada)</small></label>
                                    <input name="gb1" class="form-control" type="file" >
                                </div>
                            </div>
					 
								<div class="col-md-6">
                                <div class='form-group'>
                                    <label>Ijazah</label>
                                  <select name='ijazah' class='form-control' required='true'>
									<option value=''></option>
                                      <option value='1'>Ada</option>
									 <option value='0'>Tidak Ada</option>
                                        </select>
                                </div>
                            </div>
                               <div class='col-md-6'>
								<div class='form-group'>                              
                                    <label>Upload Ijazah <small>(jika ada)</small></label>
                                   <input name="gb2" class="form-control" type="file" >
                                </div>
                            </div>
					 
					            <div class="col-md-6">
                                <div class='form-group'>
                                    <label>Kartu Keluarga</label>
                                  <select name='kk' class='form-control' required='true'>
									<option value=''></option>
                                      <option value='1'>Ada</option>
									 <option value='0'>Tidak Ada</option>
                                        </select>
                                </div>
                            </div>
                                 <div class='col-md-6'>
								<div class='form-group'>
                                    <label>Upload Kartu Keluarga <small>(jika ada)</small></label>
                                    <input type="file" name="gb3" class="form-control" >
                                </div>
                            </div>
					 
					          <div class="col-md-6">
                                <div class='form-group'>
                                    <label>KTP Ayah</label>
                                  <select name='ayah' class='form-control' required='true'>
									<option value=''></option>
                                      <option value='1'>Ada</option>
									 <option value='0'>Tidak Ada</option>
                                        </select>
                                </div>
                            </div>
                              <div class='col-md-6'>
								<div class='form-group'>                                
                                    <label>Upload KTP Ayah <small>(jika ada)</small></label>
                                    <input type="file" name="gb4" class="form-control" >
                                </div>
                            </div>
					 
					        <div class="col-md-6">
                                <div class='form-group'>
                                    <label>KTP Ibu</label>
                                  <select name='ibu' class='form-control' required='true'>
									<option value=''></option>
                                      <option value='1'>Ada</option>
									 <option value='0'>Tidak Ada</option>
                                        </select>
                                </div>
                            </div>
                                   <div class='col-md-6'>
								<div class='form-group'>                               
                                    <label>Upload KTP Ibu <small>(jika ada)</small></label>
                                    <input type="file" name="gb5" class="form-control" >
                                </div>
                            </div>
					  <div class="col-md-6">
                                <div class='form-group'>
                                    <label>KIP / KPS</label>
                                  <select name='ibu' class='form-control' required='true'>
									<option value=''></option>
                                      <option value='1'>Ada</option>
									 <option value='0'>Tidak Ada</option>
                                        </select>
                                </div>
                            </div>
                                   <div class='col-md-6'>
								<div class='form-group'>                               
                                    <label>Upload KIP / KPS <small>(jika ada)</small></label>
                                    <input type="file" name="gb6" class="form-control" >
                                </div>
                            </div>
					    </form>
                </div>
            </div>
        </div>
    </div>
	<?php
            
            if (isset($_POST['simpan'])) {
		$ids=$_POST['ids'];
		$idlemari=$_POST['idlemari'];
		$idmap=$_POST['idmap'];
		$masuk=$_POST['masuk'];
		$kelas=$_POST['kelas'];
		$skhun=$_POST['skhun'];
		$ijazah=$_POST['ijazah'];
		$kk=$_POST['kk'];
		$ayah=$_POST['ayah'];
		$ibu=$_POST['ibu'];
		$kip=$_POST['kip'];
		$tanggal=date('d-m-Y H:i:s');
		$gb1 = $_FILES['gb1']['name'];
		$gb2 = $_FILES['gb2']['name'];
		$gb3 = $_FILES['gb3']['name'];
		$gb4 = $_FILES['gb4']['name'];
		$gb5 = $_FILES['gb5']['name'];
		$gb6 = $_FILES['gb6']['name'];
	   $tmp = $_FILES['file']['tmp_name'];
	   move_uploaded_file($_FILES["gb1"]["tmp_name"],"../arsip/".$_FILES["gb1"]["name"]);
	   move_uploaded_file($_FILES["gb2"]["tmp_name"],"../arsip/".$_FILES["gb2"]["name"]);
        move_uploaded_file($_FILES["gb3"]["tmp_name"],"../arsip/".$_FILES["gb3"]["name"]);
	   move_uploaded_file($_FILES["gb4"]["tmp_name"],"../arsip/".$_FILES["gb4"]["name"]);
	    move_uploaded_file($_FILES["gb5"]["tmp_name"],"../arsip/".$_FILES["gb5"]["name"]);
	   move_uploaded_file($_FILES["gb6"]["tmp_name"],"../arsip/".$_FILES["gb6"]["name"]);
	  $exec = mysqli_query($koneksi, "INSERT INTO arsip(idlemari,idmap,idsiswa,skhun,ijazah,kk,ktp_ayah,ktp_ibu,kip,gb_skhun,gb_ijazah,gb_kk,gb_ktpayah,gb_ktpibu,gb_kip,masuk,tanggal) VALUES
		 ('$idlemari','$idmap','$ids','$skhun','$ijazah','$kk','$ayah','$ibu','$kip','$gb1','$gb2','$gb3','$gb4','$gb5','$gb6','$masuk','$tanggal')");			   
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
			window.location.replace('?pg=dokumen');
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
	
	
	<?php } ?>
	