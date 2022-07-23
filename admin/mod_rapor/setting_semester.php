<?php
cek_session_admin();
$info1 = $info2 = $info3 = $info4 = '';
$admin = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM pengawas WHERE level='admin' AND id_pengawas='1'"));
$rapor = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM setting_rapor WHERE id='1'"));

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
                        <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true">Pengaturan</a></li>
                        <li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="false">Hapus Data</a></li>
                      

                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_1">
                             <div class="row">
                                <div class='col-md-12 notif_mapel'></div>
                                <div class='col-md-12'>
                                    <form id='formmenu' action='' method='post'>
								   <div class="panel panel-default">
                                        <div class="panel-body">
                                            <label for="smt" class="col-sm-2">Semester</label>
                                            <div class="col-sm-10">
                                                <select name="semester" id="semester" class="form-control select2" style="width: 100%;" required>
                                                        <option value="<?= $rapor['semester']  ?>">Semester <?= $rapor['semester']  ?></option>
                                                        <option value="">--Pilih Semester--</option>
														 <option value="1">Semester 1</option>
														 <option value="2">Semester 2</option>
                                                </select>
                                            </div>
                                        </div>
										<div class="panel panel-default">
                                        <div class="panel-body">
                                            <label for="mapel" class="col-sm-2">Tahun Pelajaran</label>
                                            <div class="col-sm-10">
                                                <input type="text" name="tp" value="<?= $rapor['tp']  ?>" class="form-control" required>
                                            </div>
                                        </div>
										<div class="panel panel-default">
                                        <div class="panel-body">
                                            <label for="mapel" class="col-sm-2">Tanggal Rapor</label>
                                            <div class="col-sm-10">
                                                <input type="text" name="tanggal" value="<?= $rapor['tanggal']  ?>" class="form-control" required>
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
                        </div>
					</div>
				</div>
                        <!-- /.tab-pane -->
                        <div class="tab-pane" id="tab_2">
                            <form id='formhapusdata' action='' method='post'>
                                <div class='box-body'>
                                    <?= $info4 ?>

                                    <div class='form-group'>
                                        <label>Pilih Data</label>
                                        <div class='row'>
                                            <div class='col-md-5'>
                                                <div class='checkbox'>
                                                    <small class='label bg-purple'>Pilih Data Nilai</small><br />
                                                    <label><input type='checkbox' name='data[]' value='spiritual' /> Data Nilai KI-1</label><br />
                                                      <label><input type='checkbox' name='data[]' value='sosial' /> Data Nilai KI-2</label><br />
													   <label><input type='checkbox' name='data[]' value='nilai_ph' /> Data Nilai KI-3</label><br />
													    <label><input type='checkbox' name='data[]' value='nilai_kh' /> Data Nilai KI-4</label><br />
                                                    <label><input type='checkbox' name='data[]' value='eskul' /> Data Nilai Eskul</label><br />
													 <label><input type='checkbox' name='data[]' value='prestasi' /> Data Prestasi</label><br />
                                                    <label><input type='checkbox' name='data[]' value='deskripsi_3' /> Deskripsi KI-3</label><br />
													<label><input type='checkbox' name='data[]' value='deskripsi_4' /> Deskripsi KI-4</label><br />													
                                                    <label><input type='checkbox' name='data[]' value='m_eskul' /> Data Eskul</label><br />
                                                    <label><input type='checkbox' name='data[]' value='siswa_rapor' /> Biodata Rapor</label><br />
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
                        <!-- /.tab-pane -->
                        <div class="tab-pane" id="tab_3">
                            <div class='col-md-12 notif'></div>
                            <div class='col-md-6'>
                                <div class='box box-solid'>
                                    <div class='box-header '>
                                        <h3 class='box-title'>Backup Data</h3>
                                    </div><!-- /.box-header -->
                                    <div class='box-body'>
                                        <p>Klik Tombol dibawah ini untuk membackup database </p>
                                        <button id='btnbackup' class='btn btn-flat btn-success'><i class='fa fa-database'></i> Backup Data</button>
                                    </div><!-- /.box-body -->
                                </div><!-- /.box -->
                            </div>
                            <div class='col-md-6'>
                                <div class='box box-solid'>
                                    <div class='box-header '>
                                        <h3 class='box-title'>Restore Data</h3>
                                    </div><!-- /.box-header -->
                                    <div class='box-body'>
                                        <form id='formrestore'>
                                            <p>Klik Tombol dibawah ini untuk merestore database </p>
                                            <div class='col-md-8'>
                                                <input class='form-control' name='datafile' type='file' required />
                                            </div>
                                            <button name='restore' class='btn btn-flat btn-success'><i class='fa fa-database'></i> Restore Data</button>
                                        </form>
                                    </div><!-- /.box-body -->
                                </div><!-- /.box -->
                            </div>
                        </div>
						

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $('#formhapusdata').submit(function(e) {
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: 'mod_rapor/crud_setting.php?pg=setting_clear',
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
            url: 'mod_rapor/crud_setting.php?pg=setting_menu',
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