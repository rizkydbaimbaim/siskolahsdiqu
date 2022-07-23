<?php
defined('APLIKASI') or exit('Anda tidak dizinkan mengakses langsung script ini!');
?>



<?php if ($ac == '') { ?>
<?php
function getRomawi($bln){
                switch ($bln){
                    case 1: 
                        return "I";
                        break;
                    case 2:
                        return "II";
                        break;
                    case 3:
                        return "III";
                        break;
                    case 4:
                        return "IV";
                        break;
                    case 5:
                        return "V";
                        break;
                    case 6:
                        return "VI";
                        break;
                    case 7:
                        return "VII";
                        break;
                    case 8:
                        return "VIII";
                        break;
                    case 9:
                        return "IX";
                        break;
                    case 10:
                        return "X";
                        break;
                    case 11:
                        return "XI";
                        break;
                    case 12:
                        return "XII";
                        break;
                }
}
$bulan = date('n');
$romawi = getRomawi($bulan);
$tahun = date ('Y');
$nomor = "/SM/".$romawi."/".$tahun;

$query = "SELECT max(id_surat) as maxKode FROM surat_masuk WHERE month(tgl_diterima)='$bulan'";
$hasil = mysqli_query($koneksi,$query);
$data  = mysqli_fetch_array($hasil);
$no= $data['maxKode'];
$noUrut= $no + 1;

$kode =  sprintf("%02s", $noUrut);
$nomorbaru = $kode.$nomor;


?>
    <div class='row'>
        <div class='col-md-12'>
            <div class='box box-solid'>
                <div class='box-header with-border '>
                    <h3 class='box-title'><i class="fas fa-book fa-fw   "></i>Input Surat Masuk</h3>
                    <div class='box-tools pull-right'>
				<a href="?pg=surat_masuk&ac=lihat" class="btn btn-sm btn-primary" ><i class='fa fa-search'></i> Buka Surat</button></a>
                    </div>
                </div><!-- /.box-header -->
                <div class='box-body'>
                   <form method="post" action="" enctype="multipart/form-data">
                    <div class='modal-body'>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Nomor Agenda</label>
                                    <input type="text"  class="form-control" value="<?= $kode ?>" disabled>
                                </div>
                            </div>
							<div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Kode Surat</label>
                                    <input type="text"  class="form-control" value="<?= $nomorbaru ?>" disabled>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class='form-group'>
                                    <label>Pilih Lemari</label>
                                  <select name='lemari' class='form-control' required='true'>
									
                                            <?php
                                            $lemariQ = mysqli_query($koneksi, "SELECT * FROM lemari WHERE untuk='3' ");
                                            while ($lemari = mysqli_fetch_array($lemariQ)) {
                                                echo "<option value='$lemari[id_lemari]'>$lemari[nama_lemari]</option>";
                                            }
                                            ?>
                                        </select>
                                </div>
                            </div>
                       
                        
                            <div class="col-md-6">
                                <div class="form-group">
								 <label>Pilih Map</label>
                                <select name='map' class='form-control' required='true'>
									
                                            <?php
                                            $mapQ = mysqli_query($koneksi, "SELECT * FROM map WHERE untuk='3' ");
                                            while ($map = mysqli_fetch_array($mapQ)) {
                                                echo "<option value='$map[id_map]'>$map[nama_map]</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                
								 </div>
								 <div class="col-md-6">
                                <div class="form-group">
								 <label>Nomor Surat</label>
                                <input type="text" name="nosurat" class="form-control" autocomplete="off" required >
                                    </div>
								 </div>
								 <div class="col-md-6">
                                <div class="form-group">
								 <label>Asal Surat</label>
                                <input type="text" name="asalsurat" class="form-control" required >
                                    </div>
								 </div>
								 <div class="col-md-12">
                                <div class="form-group">
								 <label>Ringkasan Surat</label>
                                <textarea name="isisurat" class="form-control" style='height:100px' required ></textarea>
                                    </div>
								 </div>
								  <div class="col-md-6">
                                <div class="form-group">
								 <label>Tanggal Surat</label>
                                <input type='text' name='tgl_surat' class='tgl form-control' autocomplete='off' required='true' />
                                    </div>
								 </div>
								   <div class="col-md-6">
                                <div class="form-group">
								 <label>Tanggal diterima</label>
                                <input type='text' name='tgl_terima' class='tgl form-control' autocomplete='off' required='true' />
                                    </div>
								 </div>
									  
                                  <div class="col-md-12">
                                <div class="form-group">
								 <label>Upload File <small>(Upload File Jika Ada)</small></label>
                                <input name="gb1" class="form-control" type="file" >
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

   <?php } elseif ($ac == 'lihat') { ?>
 
        <div class='col-md-12'>
           <div class='box box-solid'>
                <div class='box-header with-border '>
                    <h3 class='box-title'><i class="fas fa-book fa-fw   "></i>Lemari Arsip Surat Masuk</h3>
                    <div class='box-tools pull-right'>
				
                    </div>
                </div><!-- /.box-header -->
                <div class='box-body'>
                  

                <?php
				$bl=date('m');
				$th=date('Y');
                $guruQ = mysqli_query($koneksi, "SELECT * FROM surat_masuk WHERE bln='$bl' AND thn='$th'");
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
                                             <?= $guru['kode'] ?>
                                            </b></span>
                                    </div>
                                      <?php
				
              $arsipQ = mysqli_query($koneksi, "SELECT * FROM surat_masuk WHERE kode='$guru[kode]' AND bln='$bl' AND thn='$th'");
              while ($arsip = mysqli_fetch_array($arsipQ)){
			
			$lemari = fetch($koneksi,'lemari',['id_lemari' =>$arsip['idlemari']]);
			$map = fetch($koneksi,'map',['id_map' =>$arsip['idmap']]);
			
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
                                                <a href="?pg=surat_masuk&ac=lihatarsip&ids=<?= $arsip['id_surat'] ?>" title="Detail Data">
                                                    <i class='fas fa-envelope'></i> Buka Arsip
                                                    <span class="pull-right badge bg-maroon"><?= $arsip['asal_surat'] ?></span>
                                                </a>
                                            </li>
                                                     
                                        </ul>
                                     
                                    </div>
									
				                 <?php } ?>
                                </div>
                            </div>
							 <?php } ?>
  <?php } elseif ($ac == 'lihatarsip') { ?>
  <?php $surat = fetch($koneksi,'surat_masuk',['id_surat' =>$_GET['ids']]); ?>
    <div class='row'>
        <div class='col-md-12'>
            <div class='box box-solid'>
                <div class='box-header with-border '>
                    <h3 class='box-title'> Asal Surat : <b><?= $surat['asal_surat'] ?></b></h3>
						  <div class='box-tools pull-right '>
                        
                    </div>
                </div>
              
                      <div id='tabelarsip' class='table-responsive'>
                        <table id="tabelarsip" class='table table-bordered table-striped  table-hover'>
                            <thead>
                                <tr>
                                    <th width='5%'>#</th>
									<th width="10%">Tanggal</th>
                                    <th>Ringkasan Surat</th>
									 <th width="25%">File</th>
                                    <th width="10%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
							       <?php     
								$no=0;
                              $materiQ = mysqli_query($koneksi, "SELECT * FROM surat_masuk WHERE id_surat='$_GET[ids]'");
                              while ($dokumen = mysqli_fetch_array($materiQ)){
								
                              $no++;
                                ?>
								<tr>
                                        <td><?= $no ?></td>
										<td><?= $dokumen['tgl_surat'] ?> </td>
									   <td><?= $dokumen['isi'] ?> </td>
									   <td> 
									   <?php if($dokumen['file']<>''){ ?>
									   <?= $dokumen['file'] ?>
									   <?php }else{ ?>
									   Tidak ada File
									   <?php } ?>
									   </td>
									   <td style="text-align: center;">
									   <?php if($dokumen['file']<>''){ ?>
									   <a href="mod_arsip/masuk.php?file=<?= $dokumen['file'] ?>"  class="btn btn-primary btn-sm"><i class="fas fa-download"></i></a>
									   <?php }else{ ?>
									   <button class="btn btn-warning btn-sm" disabled><i class="fas fa-download" ></i></button>
									   <?php } ?>
										 <button data-id='<?= $dokumen['id_surat'] ?>' class="hapus btn btn-danger btn-sm" title="Hapus"><i class="fas fa-trash-alt"></i></button>
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
		$kodeQ = $nomorbaru;
		$agenda = $kode;
		$idlemari=$_POST['lemari'];
		$idmap=$_POST['map'];
	    $nosurat=$_POST['nosurat'];
		$asalsurat=$_POST['asalsurat'];
		$isisurat=$_POST['isisurat'];
		$tgl_surat=$_POST['tgl_surat'];
		$tgl_terima=$_POST['tgl_terima'];
		$file = $_FILES['gb1']['name'];
		$tanggal=date('d-m-Y H:i:s');
		$input=$_SESSION['id_pengawas'];
		$bulane=date('m');
		$tahune=date('Y');
		
	   $tmp = $_FILES['file']['tmp_name'];
	   move_uploaded_file($_FILES["gb1"]["tmp_name"],"../arsip/surat_masuk/".$_FILES["gb1"]["name"]);
	   
	  $exec = mysqli_query($koneksi, "INSERT INTO surat_masuk(idlemari,idmap,no_agenda,nomor_surat,asal_surat,isi,kode,tgl_surat,tgl_diterima,file,user,bln,thn) VALUES
		 ('$idlemari','$idmap','$agenda','$nosurat','$asalsurat','$isisurat','$kodeQ','$tgl_surat','$tgl_terima','$file','$input','$bulane','$tahune')");		   
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
			window.location.replace('?pg=surat_masuk');
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
			window.location.replace('?pg=surat_masuk');
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
                    url: 'mod_arsip/hapus_masuk.php',
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