<?php
defined('APLIKASI') or exit('Anda tidak dizinkan mengakses langsung script ini!');
?>

<?php
				$bl = date('m');
                $bulane = fetch ($koneksi, 'bulan', ['bln' =>$bl]);
				?>

<?php if ($ac == '') { ?>
<?php

$skkb=fetch($koneksi,'skkb',['id'=>1]);
?>
    <div class='row'>
        <div class='col-md-12'>
            <div class='box box-solid'>
                <div class='box-header with-border '>
                    <h3 class='box-title'><i class="fas fa-book fa-fw   "></i>TAMPLETE SKKB</h3>
                    <div class='box-tools pull-right'>
				
                    </div>
                </div><!-- /.box-header -->
                <div class='box-body'>
                   <form method="post" action="" enctype="multipart/form-data">
				   <div class='modal-footer'>
				   <a href="?pg=skkb&ac=lihat" class="btn btn-sm btn-success" ><i class='fa fa-plus'></i> Buat Surat</button></a>
                        <button type='submit' name='submit' class='btn btn-sm btn-flat btn-primary'><i class='fa fa-check'></i> Simpan</button>
                    </div>
                    <div class='modal-body'>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Header</label>
                                   
										<textarea id='editor2' name='header' class='form-control' rows='1' cols='80' style='width:100%;'><?= $skkb['header'] ?></textarea>
									
                                </div>
                            </div>
							<div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Isi</label>
                                    
										<textarea id='editor2' name='isi' class='editor1' rows='5' cols='80' style='width:100%;'><?= $skkb['isi'] ?></textarea>
									
                                </div>
                            </div>
                            
								 <div class="col-md-12">
                                <div class="form-group">
								 <label>Foter</label>
                                
										<textarea id='editor2' name='foter' class='editor1' rows='5' cols='80' style='width:100%;'><?= $skkb['foter'] ?></textarea>
									
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
		$header=$_POST['header'];
		$isi=$_POST['isi'];
	    $foter=$_POST['foter'];
		
	  $exec = mysqli_query($koneksi, "UPDATE skkb SET header='$header',isi='$isi',foter='$foter' WHERE id='1' ");		   
	if($exec){
	echo "
	  <script type='text/javascript'>
		setTimeout(function () { 	
			swal({
				title: 'Sukses !!!',
				text:  'Tamplete Berhasil diubah',
				type: 'success',
				timer: 1000,
				showConfirmButton: true
			});		
		},10);	
		window.setTimeout(function(){ 
			window.location.replace('?pg=skkb');
		} ,1000);	
	  </script>";
	
	}
			}
            ?>
   <?php } elseif ($ac == 'lihat') { ?>
 
         <div class='col-md-12'>
        <div class='box box-solid'>
            <div class='box-header with-border'>
                <h3 class='box-title'><i class="fas fa-school "></i> Pilih Kelas</h3>
            </div><!-- /.box-header -->
            <div class='box-body' style='background-color:#000'>

                <?php
              
                $kelasQ = mysqli_query($koneksi, "SELECT * FROM siswa_rapor GROUP BY kelas");
              while ($kelas = mysqli_fetch_array($kelasQ)){
			$jumlahP = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM siswa_rapor WHERE kelas='$kelas[kelas]' AND jk='Perempuan' "));
			$jumlahL = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM siswa_rapor WHERE kelas='$kelas[kelas]' AND jk='Laki-laki' "));
			  $jumlah = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM siswa_rapor WHERE kelas='$kelas[kelas]' "));
                ?>
                            <div class="col-md-4">
                                <div class="box box-widget widget-user-2">
                                    <!-- Add the bg color to the header using any of the bg-* classes -->
                                    <div class="widget-user-header bg-aqua" style="padding: 6px">
                                        <div class="widget-user-image">
                                            <img src="../dist/img/arsip/siswa.png" alt="">
                                        </div>
                                        <!-- /.widget-user-image -->
                                        <span style="font-size: 20px"> <b>
                                             KELAS  <?= $kelas['kelas'] ?>
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
                                                    <a href="?pg=skkb&ac=cetak&kelas=<?= $kelas['kelas'] ?>">
                                                     <i class='fas fa-print'></i> <b style="color:red;">Cetak SKKB Kelas</b>
                                                    <span class="pull-right badge bg-green"><?= $kelas['kelas'] ?></span>
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
  <?php } elseif ($ac == 'cetak') { ?>
  <?php $kelas=$_GET['kelas']; ?>
    <div class='row'>
        <div class='col-md-12'>
            <div class='box box-solid'>
                <div class='box-header with-border '>
                    <h3 class='box-title'> Cetak SKKB</b></h3>
						  <div class='box-tools pull-right '>
                        
                    </div>
                </div>
              
                      <div id='tabelarsip' class='table-responsive'>
                        <table id="tabelarsip" class='table table-bordered table-striped  table-hover'>
                            <thead>
                                <tr>
                                    <th width='5%'>#</th>
									<th width="20%">Nama</th>
									<th width="10%">NIS</th>
									<th width="10%">NISN</th>
									
                                    <th>Ringkasan Surat</th>
                                    <th width="5%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
							       <?php     
								$no=0;
                              $siswaQ = mysqli_query($koneksi, "SELECT * FROM siswa_rapor WHERE kelas='$kelas'");
                              while ($siswa = mysqli_fetch_array($siswaQ)){
								$skb=fetch($koneksi,'skkb',['id'=>'1']);
                              $no++;
                                ?>
								<tr>
                                        <td><?= $no ?></td>
										<td><?= $siswa['nama'] ?> </td>
									   <td><?= $siswa['nis'] ?> </td>
									   <td><?= $siswa['nisn'] ?> </td>
									  <td><?= $skb['isi'] ?> </td>
									  <td>
									  <a href='?pg=skkb&ac=cetakskkb&id=<?= $siswa[id] ?>' class='btn btn-sm bg-maroon' title='Cetak'><i class='fa fa-print'></i></a>
								   </td>
								</tr>
							<?php } ?>
					</tbody>
                        </table>		
                </div>
            </div>
        </div>
    </div>
	
	<?php } elseif ($ac == 'cetakskkb') { ?>
  <?php 
  $id=$_GET['id']; 
  $siswa=fetch($koneksi,'siswa_rapor',['id'=>$id]);
  $kls=$siswa['kelas'];
  $skb=fetch($koneksi,'skkb',['id'=>1]);
  ?>
	 <div class='row'>
        <div class='col-md-12'>
            <div class='box box-solid'>
                <div class='box-header with-border '>
                    <h3 class='box-title'><i class="fas fa-envelope fa-fw   "></i> Cetak SKKB <?= $siswa['nama'] ?></h3>
                    <div class='box-tools pull-right'>
				
                    </div>
                </div><!-- /.box-header -->
                <div class='box-body'>
                
				   <div class='modal-footer'>
                        <button class='btn btn-sm btn-flat btn-primary' onclick="frames['frameresult'].print()"><i class='fa fa-print'></i> Cetak </button>
                    <a href='?pg=skkb&ac=cetak&kelas=<?= $kls ?>' class='btn btn-sm bg-maroon' title='Batal'><i class='fa fa-times'></i></a>
                    </div>
                    <div class='modal-body'>
                       <center><h4><?= strtoupper($skb['header']) ?><br>
  <?= strtoupper($setting['sekolah']) ?></h4></center>
	<center> Alamat : <?= $setting['alamat']; ?> Kec. <?= $setting['kecamatan']; ?> Kab. <?= $setting['kota']; ?></center>
	  <hr>
   <img src="../<?= $setting['logo'] ?>" style="margin-left:20px ;margin-top:-155px ;width: 80px;">
    
   <center><h5>SURAT KETERANGAN KELAKUAN BAIK</h5></center>
   <br>
   <div style="padding-left:20px;margin-right:10px ;" class="col-md-12">
   <p>Yang bertanda tangan dibawah ini :</p>
    <table>
	<tbody>
          
			 <tr>
                <td width="130px">Nama</td>
				<td width="10px">:</td>
				<td><?= $setting['kepsek'] ?></td>
            </tr>
                <tr>
                <td>NIP</td>
				<td>:</td>
				<td><?= $setting['nip'] ?></td>
            </tr>
			</tr>
                <tr>
                <td>Jabatan</td>
				<td>:</td>
				<td>Kepala <?= $setting['sekolah'] ?></td>
            </tr>
			</tbody>
    </table>
	<br/>
   <p>Menerangkan bahwa :</p>
    <table>
	<tbody>
          
			 <tr>
                <td width="130px">Nama</td>
				<td width="10px">:</td>
				<td><?= $siswa['nama'] ?></td>
            </tr>
                <tr>
                <td>NIS / NISN</td>
				<td>:</td>
				<td><?= $siswa['nis'] ?> / <?= $siswa['nisn'] ?></td>
            </tr>
			</tr>
                <tr>
                <td>Tempat, Tgl Lahir</td>
				<td>:</td>
				<td><?= $siswa['tempat'] ?>, <?= $siswa['tgl_lahir'] ?></td>
            </tr>
			</tr>
                <tr>
                <td>Jenis Kelamin</td>
				<td>:</td>
				<td><?= $siswa['jk'] ?></td>
            </tr>
			</tr>
                <tr>
                <td>Agama</td>
				<td>:</td>
				<td><?= $siswa['agama'] ?></td>
            </tr>
			</tr>
                <tr>
                <td>Alamat</td>
				<td>:</td>
				<td><?= $siswa['alamat'] ?></td>
            </tr>
			</tr>
                <tr>
                <td>Desa/Kelurahan</td>
				<td>:</td>
				<td><?= $siswa['desa'] ?></td>
            </tr>
			</tr>
                <tr>
                <td>Kecamatan</td>
				<td>:</td>
				<td><?= $siswa['kec'] ?></td>
            </tr>
			</tr>
                <tr>
                <td>Kabupaten</td>
				<td>:</td>
				<td><?= $siswa['kab'] ?></td>
            </tr>
			</tbody>
    </table>
	<br/>
	<p><?= $skb['isi'] ?> </p>
	<p><?= $skb['foter'] ?> </p>
	
	</div>
     <br>
    
	<table border='0' style="margin-left: 80px;width:850">
					<tr>
					
						<td width='150px'>
							<br/>
							 <br/>
							<br/>
							<br/>
							<br/>
							
							<br/>
							
						</td>
						<td width='400px'></td>
						<td>
							<?= $setting['kecamatan'] ?>, <?php echo date('d'); ?> <?= $bulane['ket'] ?> <?= date('Y') ?><br/>
							Yang Membuat Pernyataan<br/>
							<br/>
							<br/>
							<br/>
							
							<u><?= $setting['kepsek'] ?></u><br/>
							NIP. <?= $setting['nip'] ?>
						</td>
					</tr>
				</table>
        </div>
    </div>
	<iframe id='loadframe' name='frameresult' src='staff/cetakskkb.php?id=<?= $id ?>' style='display:none'></iframe>
	
	<?php } elseif ($ac == 'rekap') { ?>
	
	
	<div class='col-md-12'>
            <div class='box box-solid'>
                <div class='box-header with-border '>
                    <h3 class='box-title'> Rekap Keadaan Siswa Bulan <?= $bulane['ket'] ?></b></h3>
						  <div class='box-tools pull-right '>
                         <button class='btn btn-sm btn-flat btn-primary' onclick="frames['frameresultCRS'].print()"><i class='fa fa-print'></i> Cetak </button>
                    <a href='?pg=skkb&ac=rekap' class='btn btn-sm bg-maroon' title='Batal'><i class='fa fa-times'></i></a>
                    </div>
                </div>
              
                      <div class='box-body'>
                    <div class='table-responsive'>
                        <table style="font-size: 11px"  class='table table-bordered table-striped'>
                            <thead>
                                <tr>
								    <th colspan="5" style="text-align: center;">Masuk</th>
									  <th colspan="5" style="text-align: center;">Keluar</th>
									  </tr>
									  <tr>
                                    <th width='3%'>No</th>
									<th>Nama</th>
									<th width="5%">Kelas</th>
									<th width="10%">NISN</th>
									<th width="10%">Sekolah Asal</th>
                                    <th width='3%'>No</th>
									<th>Nama</th>
									<th width="5%">Kelas</th>
									<th width="10%">NISN</th>
									<th width="10%">Keterangan</th>
                                </tr>
                            </thead>
                            <tbody>
							       <?php     
								$no=0;
                              $siswaQ = mysqli_query($koneksi, "SELECT * FROM siswa_rapor JOIN mutasi ON mutasi.nisn=siswa_rapor.nisn WHERE  mutasi='1'");
                              while ($siswa = mysqli_fetch_array($siswaQ)){
								
                              $no++;
                                ?>
								<tr>
                                        <td><?= $no ?></td>
										<td><?= $siswa['nama'] ?> </td>
										<td><?= $siswa['kelas'] ?> </td>
									   <td><?= $siswa['nisn'] ?> </td>
									   <td><?= $siswa['asal_sek'] ?> </td>
                                    
                                          <?php     
								$no=0;
                              $siswaQ = mysqli_query($koneksi, "SELECT * FROM siswa_rapor JOIN mutasi ON mutasi.nisn=siswa_rapor.nisn WHERE  mutasi='2'");
                              while ($siswa = mysqli_fetch_array($siswaQ)){
								
                              $no++;
                                ?>
								
                                        <td><?= $no ?></td>
										<td><?= $siswa['nama'] ?> </td>
										<td><?= $siswa['kelas'] ?> </td>
									   <td><?= $siswa['nisn'] ?> </td>
									   <td><?= $siswa['alasan'] ?> </td>
                                    </tr>
							  <?php }} ?>
                            </tbody>
                        </table>
						</div>
                    </div>
						   <div class='box-body'>
                    <div class='table-responsive'>
                        <table style="font-size: 11px"  class='table table-bordered table-striped'>
                            <thead>
                                <tr >
								    <th rowspan="2" style="text-align: center;">Kelas</th>
									  <th colspan="3" style="text-align: center;">Awal Bulan</th>
									 <th colspan="3" style="text-align: center;">Masuk</th>
									  <th colspan="3" style="text-align: center;">Keluar</th>
									   <th colspan="3" style="text-align: center;">Akhir Bulan</th>
									    <th rowspan="2" style="text-align: center;">Keterangan</th>
										</tr>
										<tr>
                                    <th width='5%'>L</th>
									<th width='5%'>P</th>
									<th width="5%">JML</th>
									<th width='5%'>L</th>
									<th width='5%'>P</th>
									<th width="5%">JML</th>
									<th width='5%'>L</th>
									<th width='5%'>P</th>
									<th width="5%">JML</th>
									<th width='5%'>L</th>
									<th width='5%'>P</th>
									<th width="5%">JML</th>
                                </tr>
                            </thead>
                            <tbody>
							       <?php     
								
                              $kelasQ = mysqli_query($koneksi, "SELECT * FROM siswa_rapor GROUP BY kelas");
                              while ($kelas = mysqli_fetch_array($kelasQ)){
								$jumlahL = mysqli_num_rows(mysqli_query($koneksi,"SELECT * FROM siswa_rapor WHERE kelas='$kelas[kelas]' AND jk='Laki-laki' AND mutasi='0' "));
                                $jumlahP = mysqli_num_rows(mysqli_query($koneksi,"SELECT * FROM siswa_rapor WHERE kelas='$kelas[kelas]' AND jk='Perempuan' AND mutasi='0' "));
                                $jumlahA = mysqli_num_rows(mysqli_query($koneksi,"SELECT * FROM siswa_rapor WHERE kelas='$kelas[kelas]' AND mutasi='0' "));
                                $jumlahLM = mysqli_num_rows(mysqli_query($koneksi,"SELECT * FROM siswa_rapor WHERE kelas='$kelas[kelas]' AND jk='Laki-laki' AND mutasi='1' "));
                                $jumlahPM = mysqli_num_rows(mysqli_query($koneksi,"SELECT * FROM siswa_rapor WHERE kelas='$kelas[kelas]' AND jk='Perempuan' AND mutasi='1' "));
                                $jumlahAM = mysqli_num_rows(mysqli_query($koneksi,"SELECT * FROM siswa_rapor WHERE kelas='$kelas[kelas]' AND mutasi='1' "));
                                $jumlahLK = mysqli_num_rows(mysqli_query($koneksi,"SELECT * FROM siswa_rapor WHERE kelas='$kelas[kelas]' AND jk='Laki-laki' AND mutasi='2' "));
                                $jumlahPK = mysqli_num_rows(mysqli_query($koneksi,"SELECT * FROM siswa_rapor WHERE kelas='$kelas[kelas]' AND jk='Perempuan' AND mutasi='2' "));
                                $jumlahAK = mysqli_num_rows(mysqli_query($koneksi,"SELECT * FROM siswa_rapor WHERE kelas='$kelas[kelas]' AND mutasi='2' "));
							  
							    $jumlahLA = ($jumlahL + $jumlahLM)- $jumlahLK;
                                $jumlahPA = ($jumlahP + $jumlahPM)- $jumlahPK;
                                $jumlahAA = $jumlahLA + $jumlahPA;
							  
                                ?>
								<tr>
                                        <td><?= $kelas['kelas'] ?></td>
										<td><?= $jumlahL ?> </td>
										<td><?= $jumlahP ?> </td>
									   <td><?= $jumlahA ?> </td>
									   <td><?= $jumlahLM ?> </td>
										<td><?= $jumlahPM ?> </td>
									   <td><?= $jumlahAM ?> </td>
                                        <td><?= $jumlahLK ?> </td>
										<td><?= $jumlahPK ?> </td>
									   <td><?= $jumlahAK ?> </td>
									   <td><?= $jumlahLA ?> </td>
										<td><?= $jumlahPA ?> </td>
									   <td><?= $jumlahAA ?> </td>
									    <td>-</td>
                                         </tr>
										 
							  <?php } ?>
							   <?php     
							   $totL = mysqli_num_rows(mysqli_query($koneksi,"SELECT * FROM siswa_rapor WHERE  jk='Laki-laki' AND mutasi='0' "));
							    $totP = mysqli_num_rows(mysqli_query($koneksi,"SELECT * FROM siswa_rapor WHERE  jk='Perempuan' AND mutasi='0' "));
							    $totA = mysqli_num_rows(mysqli_query($koneksi,"SELECT * FROM siswa_rapor WHERE  mutasi='0' "));
								$totLM = mysqli_num_rows(mysqli_query($koneksi,"SELECT * FROM siswa_rapor WHERE  jk='Laki-laki' AND mutasi='1' "));
							    $totPM = mysqli_num_rows(mysqli_query($koneksi,"SELECT * FROM siswa_rapor WHERE  jk='Perempuan' AND mutasi='1' "));
							    $totAM = mysqli_num_rows(mysqli_query($koneksi,"SELECT * FROM siswa_rapor WHERE  mutasi='1' "));
								$totLK = mysqli_num_rows(mysqli_query($koneksi,"SELECT * FROM siswa_rapor WHERE  jk='Laki-laki' AND mutasi='2' "));
							    $totPK = mysqli_num_rows(mysqli_query($koneksi,"SELECT * FROM siswa_rapor WHERE  jk='Perempuan' AND mutasi='2' "));
							    $totAK = mysqli_num_rows(mysqli_query($koneksi,"SELECT * FROM siswa_rapor WHERE  mutasi='2' "));
								$totLA = ($totL + $totLM)- $totLK;
                                $totPA = ($totP + $totPM)- $totPK;
                                $totAA = $totLA + $totPA;
								?>
							  <tr>
							  <td><b>Jumlah</b></td>
							  <td><b><?= $totL ?></b> </td>
							  <td><b><?= $totP ?></b> </td>
							  <td><b><?= $totA ?></b> </td>
							  <td><b><?= $totLM ?></b> </td>
							  <td><b><?= $totPM ?></b> </td>
							  <td><b><?= $totAM ?></b> </td>
							  <td><b><?= $totLK ?></b> </td>
							  <td><b><?= $totPK ?></b> </td>
							  <td><b><?= $totAK ?></b> </td>
							  <td><b><?= $totLA ?></b> </td>
							  <td><b><?= $totPA ?></b> </td>
							  <td><b><?= $totAA ?></b> </td>
							  </tr>
                            </tbody>
                        </table>
                    </div>
                
                </div>
            </div>
        </div>
    </div>
	
	<iframe id='loadframe' name='frameresultCRS' src='staff/crs.php' style='display:none'></iframe>
	
	
	
	
	
	
	
	<?php } ?>

			
		
	<script>
	tinymce.init({
		selector: '.editor1',
		
		plugins: [
			'advlist autolink lists link image charmap print preview hr anchor pagebreak',
			'searchreplace wordcount visualblocks visualchars code fullscreen',
			'insertdatetime media nonbreaking save table contextmenu directionality',
			'emoticons template paste textcolor colorpicker textpattern imagetools uploadimage paste formula'
		],

		toolbar: 'bold italic fontselect fontsizeselect | alignleft aligncenter alignright bullist numlist  backcolor forecolor | formula code | imagetools link image paste ',
		fontsize_formats: '8pt 10pt 12pt 14pt 18pt 24pt 36pt',
		paste_data_images: true,

		images_upload_handler: function(blobInfo, success, failure) {
			success('data:' + blobInfo.blob().type + ';base64,' + blobInfo.base64());
		},
		image_class_list: [{
			title: 'Responsive',
			value: 'img-responsive'
		}],
	});
</script>