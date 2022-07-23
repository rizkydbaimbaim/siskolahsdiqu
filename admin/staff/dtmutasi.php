<?php
defined('APLIKASI') or exit('Anda tidak dizinkan mengakses langsung script ini!');
?>
 

<?php if ($ac == '') { ?>
<?php
				$bl = date('m');
                $bulane = fetch ($koneksi, 'bulan', ['bln' =>$bl]);
				?>
         <div class='col-md-12'>
        <div class='box box-solid'>
            <div class='box-header with-border'>
                <h3 class='box-title'><i class="fas fa-edit    "></i> Keadaan Siswa Bulan <?= $bulane['ket'] ?></h3>
            </div><!-- /.box-header -->
            <div class='box-body' style='background-color:#000'>

                <?php
				$bl = date('m');
                $bulane = fetch ($koneksi, 'bulan', ['bln' =>$bl]);
                $kelasQ = mysqli_query($koneksi, "SELECT * FROM siswa_rapor GROUP BY kelas");
              while ($kelas = mysqli_fetch_array($kelasQ)){
			$jumlahP = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM siswa_rapor WHERE kelas='$kelas[kelas]' AND jk='Perempuan' "));
			$jumlahL = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM siswa_rapor WHERE kelas='$kelas[kelas]' AND jk='Laki-laki' "));
			  $jumlah = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM siswa_rapor WHERE kelas='$kelas[kelas]' "));
                ?>
                            <div class="col-md-4">
                                <div class="box box-widget widget-user-2">
                                    <!-- Add the bg color to the header using any of the bg-* classes -->
                                    <div class="widget-user-header bg-maroon" style="padding: 6px">
                                        <div class="widget-user-image">
                                            <img src="../dist/img/arsip/siswa.png" alt="">
                                        </div>
                                        <!-- /.widget-user-image -->
                                        <span style="font-size: 20px"> <b>
                                             &nbsp;KELAS  <?= $kelas['kelas'] ?>
                                            </b></span>
                                    </div>
                                      
                                    <div class="box-footer no-padding">
                                        <ul class="nav nav-stacked">
                                            <li>
                                               
                                                    <a href="#">
                                                     <i class='fas fa-users'></i> Total Siswa
                                                    <span class="pull-right badge bg-green"><?= $jumlah ?></span>
                                                    </a>
                                                
                                            </li>
											<li>                                  
                                                    <a href="#">
                                                     <i class='fas fa-user'></i> Jml Siswa Perempuan
                                                    <span class="pull-right badge bg-orange"><?= $jumlahP ?></span>
                                                    </a>                                               
                                            </li>
											<li>                                  
                                                    <a href="#">
                                                     <i class='fas fa-user'></i> Jml Siswa Laki-laki
                                                    <span class="pull-right badge bg-blue"><?= $jumlahL ?></span>
                                                    </a>                                               
                                            </li>
											<li>
                                                    <a href="?pg=dtpindah&ac=cari&kelas=<?= $kelas['kelas'] ?>">
                                                     <i class='fas fa-print'></i> <b style="color:red;">Cari siswa Kelas</b>
                                                    <span class="pull-right badge bg-red"><?= $kelas['kelas'] ?></span>
                                                    </a>                                               
                                            </li>
                                        </ul>
                                     
                                    </div>
									
                                </div>
                                <!-- /.widget-user -->
                            </div>
                       
                 
			  <?php } ?>

            </div>
        </div>
    </div>
	<?php     
	 $m=date('m');
	 $data=[
	 mutasi =>0
	 ];
	$jm = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM mutasi WHERE bulan<>'$m'"));		
    if($jm > 0){
   $exec =  delete($koneksi, 'siswa_rapor', ['mutasi' => 2]);
   $ubah= update($koneksi, 'siswa_rapor', $data, ['mutasi' => 1]);
	if($exec){
	$hapus = delete($koneksi, 'mutasi', ['ket' => 2]);
	$hapuse = delete($koneksi, 'mutasi', ['ket' => 1]);
	}	
	}
      ?>
	  <div class='col-md-12'>
            <div class='box box-solid'>
                <div class='box-header with-border '>
                    <h3 class='box-title'> Mutasi Keluar Bulan <?= $bulane['ket'] ?></b></h3>
						  <div class='box-tools pull-right '>
                        
                    </div>
                </div>
              
                      <div class='box-body'>
                    <div class='table-responsive'>
                        <table style="font-size: 11px" id='example1' class='table table-bordered table-striped'>
                            <thead>
                                <tr>
                                    <th width='5%'>#</th>
									<th>Nama</th>
									<th width="5%">Kelas</th>
									<th width="10%">NIS</th>
									<th width="10%">NISN</th>
                                    <th width="25%">Keterangan</th>
                                </tr>
                            </thead>
                            <tbody>
							       <?php     
								$no=0;
                              $siswaQ = mysqli_query($koneksi, "SELECT * FROM siswa_rapor JOIN mutasi ON mutasi.nisn=siswa_rapor.nisn WHERE  mutasi='2'");
                              while ($siswa = mysqli_fetch_array($siswaQ)){
								
                              $no++;
                                ?>
								<tr>
                                        <td><?= $no ?></td>
										<td><?= $siswa['nama'] ?> </td>
										<td><?= $siswa['kelas'] ?> </td>
									   <td><?= $siswa['nis'] ?> </td>
									   <td><?= $siswa['nisn'] ?> </td>
									   <td><?= $siswa['alasan'] ?> </td>
                                    </tr>
                                    
							  <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>
    </div>
	
	
	
  <?php } elseif ($ac == 'cari') { ?>
  <?php $kelas=$_GET['kelas']; ?>
    <div class='row'>
        <div class='col-md-12'>
            <div class='box box-solid'>
                <div class='box-header with-border '>
                    <h3 class='box-title'> Pilih Siswa Mutasi Keluar</b></h3>
						  <div class='box-tools pull-right '>
                        
                    </div>
                </div>
              
                      <div class='box-body'>
                    <div class='table-responsive'>
                        <table style="font-size: 11px" id='example1' class='table table-bordered table-striped'>
                            <thead>
                                <tr>
                                    <th width='5%'>#</th>
									<th>Nama</th>
									<th width="5%">Kelas</th>
									<th width="10%">NIS</th>
									<th width="10%">NISN</th>
                                    <th width="5%">Pilih</th>
                                </tr>
                            </thead>
                            <tbody>
							       <?php     
								$no=0;
                              $siswaQ = mysqli_query($koneksi, "SELECT * FROM siswa_rapor WHERE kelas='$kelas' AND mutasi='0'");
                              while ($siswa = mysqli_fetch_array($siswaQ)){
								$skb=fetch($koneksi,'skkb',['id'=>'1']);
                              $no++;
                                ?>
								<tr>
                                        <td><?= $no ?></td>
										<td><?= $siswa['nama'] ?> </td>
										<td><?= $siswa['kelas'] ?> </td>
									   <td><?= $siswa['nis'] ?> </td>
									   <td><?= $siswa['nisn'] ?> </td>
									
									  <td>
									   <a href="?pg=dtpindah&ac=lihat&id=<?= $siswa['id'] ?>" class='btn btn-sm bg-blue'><i class='fa fa-check'></i></button></a>
								   </td>
                                    </tr>
                                    
							  <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>
    </div>
	<?php } elseif ($ac == 'lihat') { ?>
  <?php 
  $id=$_GET['id']; 
  $siswa=fetch($koneksi,'siswa_rapor',['id'=>$id]);
  $kls=$siswa['kelas'];
  
  ?>
	 <div class='row'>
        <div class='col-md-5'>
            <div class='box box-solid'>
                <div class='box-header with-border '>
                    <h3 class='box-title'><i class="fas fa-envelope fa-fw   "></i> Mutasi <?= $siswa['nama'] ?></h3>
                    <div class='box-tools pull-right'>
				
                    </div>
                </div><!-- /.box-header -->
               <form name="form-cetak" method="POST" action="" >
                   <input type="hidden" name="nisn" value='<?= $siswa['nisn'] ?>' class="form-control" required>
                  
				 <div class='modal-body'>
                        <div class="row">
					 <div class="col-md-12">
                       <div class='form-group'>
                        <label>Nama</label>
                        <input type="text" name="smt" value="<?= $siswa['nama'] ?>" class="form-control" disabled>
                    </div>
					</div>
					 <div class="col-md-12">
                       <div class='form-group'>
                        <label>Kelas</label>
                       <input type="text" name="tp" value="<?= $siswa['kelas'] ?>" class="form-control"  disabled>
					</div>
						</div>
						<div class="col-md-12">
                       <div class='form-group'>
                        <label>NIS</label>
                       <input type="text" name="tp" value="<?= $siswa['nis'] ?>" class="form-control"  disabled>
					</div>
						</div>
						<div class="col-md-12">
					<div class="form-group">
					<label>Keterangan Mutasi</label><br>
                     <select name='alasan' id="alasan" onChange="if (this.value=='Pindah'){document.getElementById('tujuan').style.display= 'inline' } else {document.getElementById('tujuan').style.display = 'none'};"  class='form-control' style='width:100%' required>
                                                <option value=''></option>
												 <option value="Lulus">Lulus</option>
                                                 <option value="Pindah">Pindah Sekolah</option>
												 <option value="Lainnya">Lainnya</option>
                                            </select>
                                        </div>
										 </div>
										<div class="col-md-12">
										<div class="form-group">
                                            <label></label><br>
                                               <input type="text" name="tujuan" id="tujuan" class="form-control" placeholder="Isi Tujan Sekolah" style="display:none;">
                                                </div>     
											</div>
										</div>
									</div>
               <div class='modal-footer'>
               <div class='box-tools pull-right btn-group'>
                 <button type='submit' name='submit' class='btn btn-sm btn-primary'><i class='fa fa-search'></i> Simpan</button>
                   <a href="?pg=dtpindah" class='btn btn-default btn-sm pull-left' >Close</button></a>
                       </div>
                 </div>
            </form>
        </div>
    </div>
</div>

			<?php
            
            if (isset($_POST['submit'])) {
		$id=$_POST['nisn'];
		$tujuan=$_POST['tujuan'];
	    $alasan=$_POST['alasan'];
		$tanggal=date('Y-m-d');
		$bulan=date('m');
		$tahun=date('Y');
		
	  $exec = mysqli_query($koneksi, "INSERT INTO mutasi(nisn,alasan,tanggal,bulan,tahun,tujuan,ket) VALUES('$id','$alasan','$tanggal','$bulan','$tahun','$tujuan','2')");		   
	if($exec){
		mysqli_query($koneksi,"UPDATE siswa_rapor SET mutasi='2' WHERE nisn='$id' ");
	echo "
	  <script type='text/javascript'>
		setTimeout(function () { 	
			swal({
				title: 'Sukses !!!',
				text:  'Berhasil ditambahkan ke daftar mutasi',
				type: 'success',
				timer: 1000,
				showConfirmButton: true
			});		
		},10);	
		window.setTimeout(function(){ 
			window.location.replace('?pg=dtpindah');
		} ,1000);	
	  </script>";
	
	}
			}
            ?>


 <?php } elseif ($ac == 'msuk') { ?>
 <?php
				$bl = date('m');
                $bulane = fetch ($koneksi, 'bulan', ['bln' =>$bl]);
				?>
    <div class='row'>
        <div class='col-md-12'>
            <div class='box box-solid'>
                <div class='box-header with-border '>
                    <h3 class='box-title'> Mutasi Masuk Bulan <?= $bulane['ket'] ?></b></h3>
						  <div class='box-tools pull-right '>
                        <button type="button" class="btn btn-icon icon-left btn-primary" data-toggle="modal" data-target="#tambahdata">
        <i class="fa fa-plus"></i> Mutasi
    </button>
                    </div>
                </div>
              
                      <div class='box-body'>
                    <div class='table-responsive'>
                        <table style="font-size: 11px" id='example1' class='table table-bordered table-striped'>
                            <thead>
                                <tr>
                                    <th width='5%'>#</th>
									<th>Nama</th>
									<th width="5%">Kelas</th>
									<th width="10%">NIS</th>
									<th width="10%">NISN</th>
                                    <th width="25%">Asal Sekolah</th>
                                </tr>
                            </thead>
                            <tbody>
							       <?php     
								$no=0;
                              $siswaQ = mysqli_query($koneksi, "SELECT * FROM siswa_rapor WHERE  mutasi='1'");
                              while ($siswa = mysqli_fetch_array($siswaQ)){
								
                              $no++;
                                ?>
								<tr>
                                        <td><?= $no ?></td>
										<td><?= $siswa['nama'] ?> </td>
										<td><?= $siswa['kelas'] ?> </td>
									   <td><?= $siswa['nis'] ?> </td>
									   <td><?= $siswa['nisn'] ?> </td>
									   <td><?= $siswa['asal_sek'] ?> </td>
                                    </tr>
                                    
							  <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>
    </div>

 <div class="modal fade" id="tambahdata" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                 <form name="form-tambah" method="POST" action="" >
                <div class="modal-header bg-blue">
                    <h5 class="modal-title"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                         
				 <div class='modal-body'>
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                   <label>Nama</label>
                                         <input type="text" name="nama" class="form-control" autocomplete="off" required>
										</div>
										</div>
						                        <div class="col-md-4">
													<div class='form-group'>
													<label>Jenis Kelamin</label>
                                                    <select name='jk' class='form-control ' style='width:100%' required>
                                                        <option value=''></option>
                                                        <option value='Laki-laki'>Laki-laki</option>
														<option value='Perempuan'>Perempuan</option>
                                                    </select>
														</div>
															</div>
															 <div class="col-md-8">
                                <div class="form-group">
                                   <label>Tempat Lahir</label>
                                         <input type="text" name="tempat" class="form-control" autocomplete="off" required>
										</div>
										</div>
										<div class="col-md-4">
                       <div class='form-group'>
                        <label>Tanggal Lahir</label>
                        <input type="text" class="form-control datepicker" name="tgl_lahir" id="tgl_lahir" autocomplete="off" required>
                    </div>
					</div>
															<div class="col-md-8">
													<div class='form-group'>
													<label>Agama</label>
                                                    <select name='agama' class='form-control ' style='width:100%' required>
                                                        <option value=''></option>
                                                        <option value='Islam'>Islam</option>
														<option value='Kristen'>Kristen</option>
														<option value='Khatolik'>Khatolik</option>
														<option value='Hindu'>Hindu</option>
														<option value='Budha'>Budha</option>
														<option value='Konghucu'>Konghucu</option>
                                                    </select>
														</div>
															</div>
													<div class="col-md-4">
													<div class='form-group'>
												
													<label>Pilih Kelas</label>
                                                    <select name='kelas' class='form-control ' style='width:100%' required>
                                                        <option value=''></option>
                                                        <?php $lev = mysqli_query($koneksi, "SELECT * FROM siswa_rapor GROUP BY kelas"); ?>
                                                        <?php while ($kelas = mysqli_fetch_array($lev)) : ?>

                                                            <option value="<?= $kelas['kelas'] ?>"><?= $kelas['kelas'] ?></option>

                                                        <?php endwhile ?>
                                                    </select>
														</div>
															</div>
					 <div class="col-md-8">
                       <div class='form-group'>
                        <label>Sekolah Asal</label>
                        <input type="text" name="dari"  class="form-control" autocomplete='off' required>
                    </div>
					</div>
					<div class="col-md-4">
                       <div class='form-group'>
                        <label>Tanggal diterima</label>
                        <input type="text" class="form-control datepicker" name="tgl" id="tgl" autocomplete="off" required>
                    </div>
					</div>
					 <div class="col-md-6">
                       <div class='form-group'>
                        <label>NIS</label>
                        <input type="number" name="nis" class="form-control" autocomplete='off' required>
                    </div>
					</div>
					<div class="col-md-6">
                       <div class='form-group'>
                        <label>NISN</label>
                        <input type="number" name="nisn" class="form-control" autocomplete='off' required>
                    </div>
					</div>
					<div class="col-md-6">
                       <div class='form-group'>
                        <label>Nama Ayah</label>
                        <input type="text" name="ayah" class="form-control" autocomplete='off' required>
                    </div>
					</div>
					<div class="col-md-6">
                       <div class='form-group'>
                        <label>Nama Ibu</label>
                        <input type="text" name="ibu" class="form-control" autocomplete='off' required>
                    </div>
					</div>
					<div class="col-md-6">
                       <div class='form-group'>
                        <label>Pekerjaan Ayah</label>
                        <input type="text" name="pek_ayah" class="form-control" autocomplete='off' required>
                    </div>
					</div>
					<div class="col-md-6">
                       <div class='form-group'>
                        <label>Pekerjaan Ibu</label>
                        <input type="text" name="pek_ibu" class="form-control" autocomplete='off' required>
                    </div>
					</div>
					<div class="col-md-6">
                       <div class='form-group'>
                        <label>Alamat<small> * Jalan/Kampung/RT-RW</small></label>
                        <input type="text" name="alamat" class="form-control" autocomplete='off' required>
                    </div>
					</div>
					
					<div class="col-md-6">
                       <div class='form-group'>
                        <label>Desa/Kelurahan</label>
                        <input type="text" name="desa" class="form-control" autocomplete='off' required>
                    </div>
					</div>
					<div class="col-md-6">
                       <div class='form-group'>
                        <label>Kecamatan</label>
                        <input type="text" name="kec" class="form-control" autocomplete='off' required>
                    </div>
					</div>
					<div class="col-md-6">
                       <div class='form-group'>
                        <label>Kabupaten</label>
                        <input type="text" name="kab" class="form-control" autocomplete='off' required>
                    </div>
					</div>
					<div class="col-md-12">
                       <div class='form-group'>
                        <label>Propinsi</label>
                        <input type="text" name="prop" class="form-control" autocomplete='off' required>
                    </div>
					</div>
					
					</div>
						</div>
                    <div class='modal-footer'>
                       <div class='box-tools pull-right btn-group'>
                          <button type='submit' name='simpan' class='btn btn-sm btn-primary'><i class='fa fa-check'></i> Simpan</button>
                              <button type='button' class='btn btn-default btn-sm pull-left' data-dismiss='modal'>Close</button>
                                </div>
                                 </div>
								</form>
									</div>
										</div>
											</div>

		<?php
            
            if (isset($_POST['simpan'])) {
		$nama=$_POST['nama'];
		$jk=$_POST['jk'];
	    $agama=$_POST['agama'];
		$tempat=$_POST['tempat'];
		$tgl_lahir=$_POST['tgl_lahir'];
		$pecah=explode("-", $tgl_lahir);
		$t=$pecah[2];
		$bl = $pecah[1];
        $bulane = fetch ($koneksi, 'bulan', ['bln' =>$bl]);
		$bln=$bulane['ket'];
		$th=$pecah[0];
		$kelas=$_POST['kelas'];
		$dari=$_POST['dari'];
		$tgl=$_POST['tgl'];
		$nis=$_POST['nis'];
		$nisn=$_POST['nisn'];
		$ayah=$_POST['ayah'];
		$ibu=$_POST['ibu'];
		$pek_ayah=$_POST['pek_ayah'];
		$pek_ibu=$_POST['pek_ibu'];
		$alamat=$_POST['alamat'];
		$desa=$_POST['desa'];
		$kec=$_POST['kec'];
		$kab=$_POST['kab'];
		$prop=$_POST['prop'];
		
		$bulan=date('m');
		$tahun=date('Y');
		
	  $exec = mysqli_query($koneksi, "INSERT INTO mutasi(nisn,tanggal,bulan,tahun,dari,ket) VALUES('$nisn','$tgl','$bulan','$tahun','$dari','1')");		   
	if($exec){
		mysqli_query($koneksi,"INSERT INTO siswa_rapor(nama,kelas,nis,nisn,tempat,tgl_lahir,jk,agama,alamat,ayah,ibu,pek_ayah,pek_ibu,jalan,desa,kec,kab,prov,asal_sek,mutasi) VALUES
	('$nama', '$kelas', '$nis', '$nisn', '$tempat', '$t $bln $th', '$jk', '$agama', '$alamat', '$ayah', '$ibu', '$pek_ayah', '$pek_ibu', '$alamat', '$desa', '$kec', '$kab', '$prop', '$dari','1')");
	echo "
	  <script type='text/javascript'>
		setTimeout(function () { 	
			swal({
				title: 'Sukses !!!',
				text:  'Berhasil ditambahkan ke daftar mutasi',
				type: 'success',
				timer: 1000,
				showConfirmButton: true
			});		
		},10);	
		window.setTimeout(function(){ 
			window.location.replace('?pg=dtpindah&ac=msuk');
		} ,1000);	
	  </script>";
	
	}
			}
            ?>
	<?php } ?>

			
