<?php defined('BASEPATH') or die("ip anda sudah tercatat oleh sistem kami") ?>

<div class="section-header">
    <div class='row'>
        <div class='col-md-12'>
            <div class='box box-solid'>
                <div class='box-header with-border '>
                    <h3 class='box-title'><i class="fas fa-edit fa-fw   "></i> MENU WALI KELAS</h3>
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
                                <th>Kelas</th>
                           <th width="5%">Eskul</th>
							<th width="5%">Absen</th>
							<th width="5%">Prestasi</th>
							<th width="5%">Catatan</th>
							<th width="5%"></th>
							<th width="5%">Leger KI-1</th>
							<th width="5%">Leger KI-2</th>
							<th width="5%">Leger KI-3</th>
							<th width="5%">Leger KI-4</th>
							<th width="5%">Cetak Rapor</th>
							
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $query = mysqli_query($koneksi, "select * FROM pengawas
							
							WHERE id_pengawas='$_SESSION[id_pengawas]'");
                            $no = 0;
                            while ($walas = mysqli_fetch_array($query)) {
							
                                $no++;
                            ?>
                                <tr>
                                    <td><?= $no; ?></td>
									<td><?= $walas['jabatan'] ?></td>
									<td>
                                       <a href="?pg=eskuler&kelas=<?= $walas['jabatan'] ?>" class="btn btn-sm btn-warning btn-rounded">
                                          <i class="fas fa-user"></i></button></a>                                        
										   </td>
										 <td>
                                       <a href="?pg=absenrapor&kelas=<?= $walas['jabatan'] ?>" class="btn btn-sm btn-success btn-rounded">
                                          <i class="fas fa-user"></i></button></a>                                        
										   </td>
										    <td>
                                       <a href="?pg=prestasi&kelas=<?= $walas['jabatan'] ?>" class="btn btn-sm btn-primary btn-rounded">
                                          <i class="fas fa-user"></i></button></a>                                        
										   </td>
										   <td>
                                       <a href="?pg=catat&kelas=<?= $walas['jabatan'] ?>" class="btn btn-sm btn-info btn-rounded">
                                          <i class="fas fa-edit"></i></button></a>                                        
										   </td>
                                            <td> </td>
                                    <td>
                                       <a target="_blank" href="mod_walas/spiritual.php?kelas=<?= $walas['jabatan'] ?>" class="btn btn-sm btn-danger btn-rounded">
                                          <i class="fas fa-print"></i></button></a>                                        
										   </td>
										    <td>
                                       <a target="_blank" href="mod_walas/sosial.php?kelas=<?= $walas['jabatan'] ?>" class="btn btn-sm btn-danger btn-rounded">
                                          <i class="fas fa-print"></i></button></a>                                        
										   </td>
										   <td>
                                       <a target="_blank" href="mod_walas/legerP.php?kelas=<?= $walas['jabatan'] ?>" class="btn btn-sm btn-danger btn-rounded">
                                          <i class="fas fa-print"></i></button></a>                                        
										   </td>
										   <td>
										   <a target="_blank" href="mod_walas/legerK.php?kelas=<?= $walas['jabatan'] ?>" class="btn btn-sm btn-danger btn-rounded">
                                          <i class="fas fa-print"></i></button></a>                                        
										   </td>
										   <td>
                                       <a href="?pg=datasiswa&kelas=<?= $walas['jabatan'] ?>" class="btn btn-sm btn-danger btn-rounded">
                                          <i class="fas fa-print"></i></button></a>                                        
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
                                                            <h5 class="modal-title"> DESKRIPSI (KI-3)</h5>
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