<?php
$format = 'mod_admin/importsiswa.xlsx';

?>
<div class='row'>
    <div class='col-md-12'>
        <div class='box box-solid'>
            <div class='box-header with-border '>
                <h3 class='box-title'>Import Biodata Siswa</h3>
                <div class='box-tools pull-right '>
                    <a href='<?= $format ?>' class='btn btn-sm btn-flat btn-success'><i class='fa fa-file-excel-o'></i> Download Format</a>
                    <a href='?pg=updatesiswa' class='btn btn-sm btn-flat btn-success' title='Batal'><i class='fa fa-times'></i></a>
                </div>
            </div><!-- /.box-header -->
            <div class='box-body'>

                <div class='box box-solid'>
                    <div class='box-body'>
                        <div class='form-group'>
                            <div class='row'>
                                <form id='formsiswa' enctype='multipart/form-data'>
                                    <div class='col-md-4'>
                                        <label>Pilih File</label>
                                        <input type='file' name='file' class='form-control' required='true' />
                                    </div>
                                    <div class='col-md-4'>
                                        <label>&nbsp;</label><br>
                                        <button type='submit' name='submit' class='btn btn-flat btn-success'><i class='fa fa-check'></i> Import Data</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <span class="label label-primary">Import bukan ajax (harus xlx)</span>
                        <div class='form-group'>
                            <div class='row'>
                                <form action="" method="post" enctype='multipart/form-data'>
                                    <div class='col-md-4'>
                                        <label>Pilih File</label>
                                        <input type='file' name='file' class='form-control' required='true' disabled />
                                    </div>
                                    <div class='col-md-4'>
                                        <label>&nbsp;</label><br>
                                        <button type='submit' name='importsiswa' class='btn btn-flat btn-success' disabled><i class='fa fa-check'></i> Import Data</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <?= $info ?>
                        <p>Menu ini berfungsi untuk import data Master</p>
                        <p><strong>*Import Data Siswa, Jurusan, Kelas, Ruangan, Sesi dan Level</strong></p>
                       
                        <div id='progressbox'></div>
                        <div id='hasilimport'></div>
                    </div>
                </div>
            </div><!-- /.box-body -->
            <div class='box-footer'></div>
        </div><!-- /.box -->
    </div>
</div>
<script>
    $('#formsiswa').on('submit', function(e) {
        e.preventDefault();
        $.ajax({
            type: 'post',
            url: 'mod_admin/import_master.php',
            data: new FormData(this),
            processData: false,
            contentType: false,
            cache: false,
            beforeSend: function() {
                $('#progressbox').html('<div class="progress"><div class="progress-bar progress-bar-success progress-bar-striped active" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div></div>');
                $('.progress-bar').animate({
                    width: "30%"
                }, 100);
            },
            success: function(response) {
                setTimeout(function() {
                    $('.progress-bar').css({
                        width: "100%"
                    });
                    setTimeout(function() {
                        $('#hasilimport').html(response);
                    }, 100);
                }, 500);
            }
        });
    });
</script>