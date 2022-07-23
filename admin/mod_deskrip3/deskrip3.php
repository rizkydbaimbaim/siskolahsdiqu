<?php defined('BASEPATH') or die("ip anda sudah tercatat oleh sistem kami") ?>
<?php
$jumlah = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM jadwal_mapel WHERE guru='$_SESSION[id_pengawas]'"));
$cekdata = "SELECT * FROM jadwal_mapel WHERE guru='$_SESSION[id_pengawas]' AND kkm >0 ";
$jikaada = mysqli_query($koneksi,$cekdata);
if(mysqli_num_rows($jikaada) < $jumlah ){
	echo "
	
	  <script type='text/javascript'>
		setTimeout(function () { 	
			swal({
				title: 'Gagal!!!',
				text:  'KKM masih 0 , Silahkan Hubungi Admin agar diisi',
				type: 'success',
				timer: 5000,
				showConfirmButton: true
			});		
		},10);	
		window.setTimeout(function(){ 
			window.location.replace('?pg=');
		} ,5000);	
	  </script>";
		
	}else{

?>

<div class="section-header">
    <div class='row'>
        <div class='col-md-12'>
            <div class='box box-solid'>
                <div class='box-header with-border '>
                    <h3 class='box-title'><i class="fas fa-edit fa-fw   "></i> DESKRIPSI PENGETAHUAN (KI-3)</h3>
                    <div class='box-tools pull-right'>
				   
		  </div>
         </div>
            <div class='box-body'>
                   <div class='table-responsive'>
                        <table style="font-size: 11px" id='tabelekstra' class='table table-bordered table-striped'>
                            <thead>
                            <tr>
                             <th width="5%" class="text-center">
                                    #
                                </th>
                                <th width="5%">Kelas</th>
                                 <th>Nama Mapel</th>
								 <th width="15%">Informasi</th>
							<th width="5%">Download</th>
							<th width="5%">Upload</th>
							<th width="5%">View</th>
							
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $query = mysqli_query($koneksi, "select * FROM jadwal_mapel 
							
							WHERE guru='$_SESSION[id_pengawas]'");
                            $no = 0;
                            while ($mapel = mysqli_fetch_array($query)) {
								$jumlah = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM deskripsi_3 WHERE mapel='$mapel[kode]' AND kelas='$mapel[kelas]'"));
                                $no++;
                            ?>
                                <tr>
                                    <td><?= $no; ?></td>
									<td><?= $mapel['kelas'] ?></td>
                                    <td><?= $mapel['mapel'] ?></td>
                                   <?php if($jumlah==0){ ?>
                                     <td><span class="btn btn-sm btn-danger">Belum diupload</span></td>
									<?php }else{ ?>
									<td><span class="btn btn-sm btn-success">Sudah diupload</span></td>
									<?php } ?>
                                    <td>
									<a href="mod_deskrip3/prosesd3.php?id=<?= $mapel['id_jadwal'] ?>" class="btn btn-sm btn-warning btn-rounded" >
                                          <i class="fas fa-download"></i></button></a>
										</td>
										 <td>
                                        <?php if($jumlah==0){ ?>
                                       <button type="button" class="btn btn-sm btn-success btn-rounded" data-toggle="modal" data-target="#modal-des">
                                          <i class="fas fa-upload"></i>
                                        </button>
										<?php }else{ ?>
										 <button type="button" class="btn btn-sm btn-danger btn-rounded" data-toggle="modal" data-target="#modal-des" disabled>
                                          <i class="fas fa-upload"></i>
                                        </button>
										<?php } ?>
										   </td>
										    <td>
									<a href="?pg=view3&mapel=<?= $mapel['kode'] ?>&kelas=<?= $mapel['kelas'] ?>" class="btn btn-sm btn-info btn-rounded" >
                                          <i class="fas fa-search"></i></button></a>
										</td>
										   
                                </tr>
								
                            <?php }
                            ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modal-des" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    
                                                        <div class="modal-header bg-blue">
                                                            <h5 class="modal-title"> </h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
														<form id="form-import" action=''>
                                                        <div class="modal-body">
                                                            
                                                            <div class="form-group">
                                                                <label>File xlsx</label>
                                                               <input type="file" class="form-control" name="file" id="file" placeholder="" aria-describedby="helpfile" required>
                                                             <small id="helpfile" class="form-text text-muted">File harus .xlsx</small>
                                                            </div>
                                                            
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                                        </div>
                                                    </form>	
								  </div>
								    </div>
									  </div>
<script>
    //IMPORT FILE PENDUKUNG 
    $('#form-import').on('submit', function(e) {
        e.preventDefault();
        $.ajax({
            type: 'post',
            url: 'mod_deskrip3/crud_deskrip.php',
            data: new FormData(this),
            processData: false,
            contentType: false,
            cache: false,
            beforeSend: function() {
                $('form button').on("click", function(e) {
                    e.preventDefault();
                });
            },
            success: function(data) {

                $('#importdata').modal('hide');
                iziToast.success({
                    title: 'Mantap!',
                    message: data,
                    position: 'topRight'
                });
                setTimeout(function() {
                    window.location.reload();
                }, 2000);


            }
        });
    });
   
</script>
<?php } ?>