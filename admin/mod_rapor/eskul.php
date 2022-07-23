<?php
defined('APLIKASI') or exit('Anda tidak dizinkan mengakses langsung script ini!');
?>
    <div class='row'>
        <div class='col-md-12'>
            <div class='box box-solid'>
                <div class='box-header with-border '>
                    <h3 class='box-title'><i class="fas fa-user fa-fw   "></i> Data Ekstrakurikuler</h3>
                    <div class='box-tools pull-right'>
					 <a data-toggle='modal' data-backdrop="static" data-target='#tambahwalas' class='btn btn-sm btn-primary'><i class='glyphicon glyphicon-plus'></i> <span class='hidden-xs'>Tambah</span></a>
                    </div>
                </div><!-- /.box-header -->
                <div class='box-body'>
                    <div class='table-responsive'>
                        <table style="font-size: 11px" id='tabelekstra' class='table table-bordered table-striped'>
                            <thead>
                                <tr>
                                    <th width='3px'></th>
									  <th>Nama Eskul</th>
                                                               
									<th width='5px'>#</th>
                                </tr>
                            </thead>
							  </thead>
							
							<tbody>
							
                                <?php
								$no = 0;
								 $query = mysqli_query($koneksi, "select * from m_eskul");
                            while ($ekstra = mysqli_fetch_array($query)) {
                                $no++;
                            ?>
							 <tr>
                                    <td><?= $no; ?></td>
									 <td><?= $ekstra['ekstra'] ?></td>
                                   
                                   <td>
                                        <button data-id="<?= $ekstra['id'] ?>" class="hapus btn-sm btn btn-danger"><i class="fas fa-trash    "></i></button>
										</td>			
							       </tr>
                    
                            <?php } ?>
                        </tbody>
                        </table>
                    </div>
                    
          <div class='modal fade' id='tambahwalas' style='display: none;'>
                        <div class='modal-dialog'>
                            <div class='modal-content'>
                                <div class='modal-header bg-blue'>
                                    <button class='close' data-dismiss='modal'><span aria-hidden='true'><i class='glyphicon glyphicon-remove'></i></span></button>
                                    <h4 class='modal-title'><i class="fas fa-user-friends fa-fw   "></i> Tambah ekstra Kelas</h4>
                                </div>
                                <div class='modal-body'>
                                    <form id='form-tambah' action=''>
									     
                                        <div class='form-group'>                                                
                                                    <label>Eskul</label>
                                                   <input type="text" name="eskul" class="form-control" required>
                                                </div>
                                       
                                          
                                               </div>
											  
                                        <div class='modal-footer'>
                                            <div class='box-tools pull-right btn-group'>
                                                <button type='submit' name='tambahsiswa' class='btn btn-sm btn-primary'><i class='fa fa-check'></i> Simpan</button>
                                                <button type='button' class='btn btn-default btn-sm pull-left' data-dismiss='modal'>Close</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>
    </div>

	
	<script>
	$('#form-tambah').submit(function(e) {
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: 'mod_rapor/crud_rapor.php?pg=tambah_eskul',
            data: $(this).serialize(),
            beforeSend: function() {
                $('form button').on("click", function(e) {
                    e.preventDefault();
                });
            },
            success: function(data) {
                console.log(data);
                if (data == 'OK') {
                    iziToast.success({
                        title: 'Mantap!',
                        message: 'data berhasil disimpan',
                        position: 'topRight'
                    });
                    setTimeout(function() {
                        window.location.reload();
                    }, 2000);
                } else {
                    iziToast.error({
                        title: 'Maaf!',
                        message: data,
                        position: 'topRight'
                    });
                }

            }
        });
        return false;
    });
	 $('#tabelekstra').on('click', '.hapus', function() {
        var id = $(this).data('id');
        console.log(id);
        swal({
            title: 'Are you sure?',
            text: 'Akan menghapus data ini!',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'iya, hapus'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: 'mod_rapor/crud_rapor.php?pg=hapus_eskul',
                    method: "POST",
                    data: 'id=' + id,
                    success: function(data) {
                        iziToast.error({
                            title: 'Horee!',
                            message: 'Data Berhasil dihapus',
                            position: 'topRight'
                        });
                        setTimeout(function() {
                            window.location.reload();
                        }, 2000);
                    }
                });
            }
            return false;
        })

    });
	</script>