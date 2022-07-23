<?php
defined('APLIKASI') or exit('Anda tidak dizinkan mengakses langsung script ini!');
?>
    <div class='row'>
        <div class='col-md-12'>
            <div class='box box-solid'>
                <div class='box-header with-border '>
                    <h3 class='box-title'><i class="fas fa-user fa-fw   "></i> Data Wali Kelas</h3>
                    <div class='box-tools pull-right'>
					 <a data-toggle='modal' data-backdrop="static" data-target='#tambahwalas' class='btn btn-sm btn-primary'><i class='glyphicon glyphicon-plus'></i> <span class='hidden-xs'>Tambah</span></a>
                    </div>
                </div><!-- /.box-header -->
                <div class='box-body'>
                    <div class='table-responsive'>
                        <table style="font-size: 11px" id='tabelwali' class='table table-bordered table-striped'>
                            <thead>
                                <tr>
                                    <th width='3px'></th>
									  <th>Kelas</th>
                                    <th>Nama</th>
                                    <th>NIP</th>                                
									<th width='5px'>#</th>
                                </tr>
                            </thead>
							  </thead>
							
							<tbody>
							
                                <?php
								$no = 0;
								 $query = mysqli_query($koneksi, "select * from walas
								 JOIN pengawas ON pengawas.id_pengawas=walas.id_walas");
                            while ($wali = mysqli_fetch_array($query)) {
                                $no++;
                            ?>
							 <tr>
                                    <td><?= $no; ?></td>
									 <td><?= $wali['kelas'] ?></td>
                                    <td><?= $wali['nama'] ?></td>
							        <td><?= $wali['nip'] ?></td>
                                   <td>
                                        <button data-id="<?= $wali['id'] ?>" class="hapus btn-sm btn btn-danger"><i class="fas fa-trash    "></i></button>
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
                                    <h4 class='modal-title'><i class="fas fa-user-friends fa-fw   "></i> Tambah Wali Kelas</h4>
                                </div>
                                <div class='modal-body'>
                                    <form id='form-tambah' action=''>
                                        <div class='form-group'>
                                                   <label>Nama</label>
                                                    <select name='id_walas' class='form-control' required='true'>
                                                        <option value=''></option>
                                                        <?php
                                                        $kelasQ = mysqli_query($koneksi, "SELECT * FROM pengawas WHERE level='guru'");
                                                        while ($wali = mysqli_fetch_array($kelasQ)) {
                                                            echo "<option value='$wali[id_pengawas]'>$wali[nama]</option>";
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                               
                                        <div class='form-group'>                                                
                                                    <label>Kelas</label>
                                                    <select name='kelas' class='form-control' required='true'>
                                                        <option value=''></option>
                                                        <?php
                                                        $kelasQ = mysqli_query($koneksi, "SELECT * FROM siswa_rapor GROUP BY kelas");
                                                        while ($kelas = mysqli_fetch_array($kelasQ)) {
                                                            echo "<option value='$kelas[kelas]'>$kelas[kelas]</option>";
                                                        }
                                                        ?>
                                                    </select>
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
            url: 'mod_rapor/crud_rapor.php?pg=tambah_walas',
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
	 $('#tabelwali').on('click', '.hapus', function() {
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
                    url: 'mod_rapor/crud_rapor.php?pg=hapus_walas',
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