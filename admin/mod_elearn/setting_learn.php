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
                <h3 class="box-title"><i class="fas fa-tools fa-2x fa-fw"></i> Absen & Undian</h3>
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
                                            <label for="smt" class="col-sm-2">Absensi Daring</label>
                                            <div class="col-sm-10">
                                                <select name="nilai" id="nilai" class="form-control" style="width: 100%;" required>
                                                        <option value="<?= $setting['absendaring']  ?>"><?= $setting['absendaring']  ?></option>
                                                       
														 <option value="Tanpa Photo">Tanpa Photo</option>
														 <option value="Gunakan Photo">Gunakan Photo</option>
														
                                                </select>
                                            </div>
                                        </div>
										<div class="panel-body">
                                            <label for="smt" class="col-sm-2">Tampil Undian</label>
                                            <div class="col-sm-10">
                                                <select name="undian" id="undian" class="form-control" style="width: 100%;" required>
                                                        <option value="<?= $setting['undian']  ?>"><?= $setting['undian']  ?></option>
                                                       
														<option value="Ya">Ya</option>
														 <option value="Tidak">Tidak</option>
														 
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
                       
				
                        <div class="tab-pane" id="tab_2">
                            <form id='formhapusdata' action='' method='post'>
                                <div class='box-body'>
                                    <?= $info4 ?>

                                    <div class='form-group'>
                                        <label>Pilih Data</label>
                                        <div class='row'>
                                            <div class='col-md-5'>
                                                <div class='checkbox'>
                                                    
                                                    <small class='label label-info'>Pilih Data E-Learn</small><br />
                                                    <label><input type='checkbox' name='data[]' value='tugas' /> Data Tugas</label><br />
													 <label><input type='checkbox' name='data[]' value='tugas_file' /> Data Tugas File</label><br />
                                                    <label><input type='checkbox' name='data[]' value='jawaban_tugas' /> Data Jawaban Tugas</label><br />
                                                      <label><input type='checkbox' name='data[]' value='materi' /> Materi Belajar</label><br />
													   <label><input type='checkbox' name='data[]' value='materi_file' /> Data Materi File</label><br />
													  <label><input type='checkbox' name='data[]' value='absen_daring' /> Absen Daring Photo</label><br />
													   <label><input type='checkbox' name='data[]' value='absen_harian' /> Absen Daring Tanpa Photo</label><br />
													   <label><input type='checkbox' name='data[]' value='komentar' /> Komentar</label><br />
													    <label><input type='checkbox' name='data[]' value='soal_quiz' /> Soal Quiz</label><br />
														 <label><input type='checkbox' name='data[]' value='jawaban_quiz' /> Jawaban Quis</label><br />
														  <label><input type='checkbox' name='data[]' value='nilaiquiz' /> Nilai Quiz</label><br />
														  <label><input type='checkbox' name='data[]' value='absen_daringmapel' /> Download Materi</label><br />
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
            url: 'mod_mbs/crud_setting.php?pg=setting_nilai',
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