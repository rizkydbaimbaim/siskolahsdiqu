<?php
cek_session_admin();
$info1 = $info2 = $info3 = $info4 = '';
$admin = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM pengawas WHERE level='admin' AND id_pengawas='1'"));
$setting = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM setting WHERE id_setting='1'"));

?>
<div class='row'>
    <div class='col-md-12'>
        <div class="box box-solid">
            <!-- Add the bg color to the header using any of the bg-* classes -->
            <div class="box-header with-border">
                <h3 class="box-title"><i class="fas fa-tools fa-2x fa-fw"></i> Pengaturan Rapor</h3>
            </div>
            <div class="box-body no-padding ">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        
                        <li class="active"><a href="#tab_2" data-toggle="tab" aria-expanded="false">Hapus Data</a></li>
                      

                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane" id="tab_1">
                             <div class="row">
                                <div class='col-md-12 notif_mapel'></div>
                                <div class='col-md-12'>
                                    <form id='formmenu' action='' method='post'>
								   <div class="panel panel-default">
                                        <div class="panel-body">
                                            <label for="smt" class="col-sm-2">Absensi Guru</label>
                                            <div class="col-sm-10">
                                                <select name="absen" id="absen" class="form-control" style="width: 100%;" required>
                                                        <option value="<?= $setting['absen']  ?>"><?= $setting['absen']  ?></option>
                                                       
														 <option value="Manual">Manual</option>
														 <option value="QR Code">QR Code</option>
														 <option value="Photo">Photo</option>
                                                </select>
                                            </div>
                                        </div>
										<div class="panel-body">
                                            <label for="smt" class="col-sm-2">Tampil Jadwal</label>
                                            <div class="col-sm-10">
                                                <select name="jadwal" id="jadwal" class="form-control" style="width: 100%;" required>
                                                        <option value="<?= $setting['jadwal']  ?>"><?= $setting['jadwal']  ?></option>
                                                       
														<option value="Tidak">Tidak Tampil</option>
														 <option value="Guru">Guru</option>
														
                                                </select>
                                            </div>
                                        </div>
                                            </div>
                                        <div class="panel-footer clearfix">
                                            <div class="pull-right">
                                                <button class='btn btn-flat btn-primary'><i class='fa fa-check'></i> Simpan</button>
                                            </div>
                                        </div>
                                    </div>
									</form>
                                </div>
                            </div>
                       
				
                        <div class="tab-pane active" id="tab_2">
                            <form id='formhapusdata' action='' method='post'>
                                <div class='box-body'>
                                    <?= $info4 ?>

                                    <div class='form-group'>
                                        <label>Pilih Data</label>
                                        <div class='row'>
                                            <div class='col-md-5'>
                                                <div class='checkbox'>
                                                    
                                                   <small class='label label-success'>Pilih Data Arsip</small><br />
                                                   <label><input type='checkbox' name='data[]' value='lemari' /> Data Lemari</label><br />
                                                      <label><input type='checkbox' name='data[]' value='map' /> Map Arsip</label><br />
													   <label><input type='checkbox' name='data[]' value='arsip' /> Dokumen Siswa</label><br />
													   <label><input type='checkbox' name='data[]' value='arsipguru' /> Dokumen Guru</label><br />
													   <label><input type='checkbox' name='data[]' value='surat_masuk' /> Arsip Surat Masuk</label><br />
													   <label><input type='checkbox' name='data[]' value='surat_keluar' /> Arsip Surat Keluar</label><br />
                                                </div>
                                            </div>
                                            <div class='col-md-7'>
                                                <button type='submit' name='submit3' class='btn btn-sm bg-maroon'><i class='fa fa-trash-o'></i> Kosongkan</button>
                                                <div class='form-group'>
                                                    <label>Password Admin</label>
                                                    <input type='password' name='password' class='form-control' required='true' />
                                                </div>

                                                <p class='text-danger'><i class='fa fa-warning'></i> <strong>Mohon di ingat!</strong> Data yang telah dikosongkan tidak dapat dikembalikan.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- /.box-body -->
                            </form>
                        </div>
                       

<script>
    $('#formhapusdata').submit(function(e) {
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: 'mod_mbs/crud_setting.php?pg=setting_clear',
            data: $(this).serialize(),
            success: function(data) {
                console.log(data);
                if (data == "ok") {
                    iziToast.success({
                        title: 'Mantap!',
                        message: 'data berhasil dikosongkan',
                        position: 'topRight'
                    });
                } else {
                    iziToast.error({
                        title: 'Gagal!',
                        message: data,
                        position: 'topRight'
                    });
                }

            }
        });
        return false;
    });
	 $('#formmenu').submit(function(e) {
        e.preventDefault();
        var data = new FormData(this);
        //console.log(data);
        $.ajax({
            type: 'POST',
            url: 'mod_mbs/crud_setting.php?pg=setting_menu',
            enctype: 'multipart/form-data',
            data: data,
            cache: false,
            contentType: false,
            processData: false,
            success: function(data) {
                iziToast.success({
                    title: 'Mantap!',
                    message: 'data berhasil diperbarui',
                    position: 'topRight'
                });
                setTimeout(function() {
                    window.location.reload();
                }, 2000);

            }
        });
        return false;
    });
</script>