<?php if ($ac == '') : ?>
    <div class='row'>
        <div class='col-md-12'>

            <div class='box box-solid'>
                <div class='box-header with-border'>
                    <h3 class='box-title'>Status Peserta </h3>
                    <div class='box-tools pull-right '>
                    </div>
                </div><!-- /.box-header -->
                <div class='box-body'>
                    <div class='alert alert-info'>
                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
                        <i class='icon fa fa-info'></i>
                        Status peserta akan muncul saat ujian berlangsung dan refresh setiap 5 detik..
                    </div>

                    <div class='table-responsive'>
                        <table id='tablestatus' class='table table-bordered table-striped'>
                            <thead>
                                <tr>
                                    <th width='5px'>#</th>
                                    <th>NIS</th>
                                    <th>Nama</th>
                                    <th>Kelas</th>
                                    <th>Mapel</th>
                                    <th>Lama Ujian</th>
                                    <th>Jawaban</th>
                                    <th>Nilai</th>
                                    <th>Ip Address</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody id='divstatus'>
                            </tbody>
                        </table>
                    </div>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>
    </div>
<?php endif ?>
<script>
    var autoRefresh = setInterval(
        function() {
            $('#divstatus').load("mod_status/statusall.php");
        }, 5000
    );
</script>