<?php
$id_mapel = $_GET['id'];
$mapelQ = mysqli_query($koneksi, "SELECT * FROM mapel_kisi where id_mapel='$id_mapel'");
$mapel = mysqli_fetch_array($mapelQ);
$cekmapel = mysqli_num_rows($mapelQ);
?>
<div class='row'>
    <div id="boxpesan"></div>
    <div class='col-md-12'>

        <div class='box box-solid'>
            <div class='box-header with-border'>
                <h3 class='box-title'>Import Kisi-kisi</h3>
                <div class='box-tools pull-right '>

                    <a href='?pg=<?= $pg ?>' class='btn btn-sm bg-maroon' title='Batal'><i class='fa fa-times'></i></a>
                </div>
            </div><!-- /.box-header -->
            <div class='box-body'>
                <div class='col-md-6'>
                    <form id="formsoalcandy" method='post' enctype='multipart/form-data'>
                        <div class='box box-solid'>
                            <div class='box-header with-border'>
                                <h3 class='box-title'>Import Kisi-kisi</h3>
                                <div class='box-tools pull-right '>
                                    <button type='submit' name='submit' class='btn btn-sm btn-flat btn-success'><i class='fa fa-check'></i> Import</button>
                                    <a href='?pg=<?= $pg ?>' class='btn btn-sm bg-maroon' title='Batal'><i class='fa fa-times'></i></a>
                                </div>
                            </div><!-- /.box-header -->
                            <div class='box-body'>
                                <?= $info ?>
                                <div class='form-group'>
                                    <label>Mata Pelajaran</label>
                                    <input type='hidden' name='id_mapel' class='form-control' value="<?= $mapel['kode'] ?>" />
                                    <input type='text' name='mapel' class='form-control' value="<?= $mapel['nama'] ?>" disabled />
                                </div>
                                <div class='form-group'>
                                    <label>Pilih File</label>
                                    <input type='file' name='file' class='form-control' required='true' />
                                </div>
                                <p>
                                    Sebelum meng-import pastikan file yang akan anda import sudah dalam bentuk Ms. Excel 97-2003 Workbook (.xls) dan format penulisan harus sesuai dengan yang telah ditentukan. <br />
                                </p>
                            </div><!-- /.box-body -->
                            <div class='box-footer'>
                                <a href='template/KISI-KISI.xls'><i class='fa fa-file-excel-o'></i> Download Format</a>
                            </div>

                        </div><!-- /.box -->
                    </form>
                </div>
               
                
                            </div><!-- /.box-body -->
                        </div><!-- /.box -->
                    </form>
                </div>
               
            </div><!-- /.box-body -->

        </div><!-- /.box -->

    </div>


</div>


<script>
    function notify(pesan) {
        toastr.success(pesan);
    }

    function notifygagal(pesan) {
        toastr.error(pesan);
    }
    //IMPORT FILE PENDUKUNG 
    $('#formfilesoal').on('submit', function(e) {
        e.preventDefault();
        $.ajax({
            type: 'post',
            url: 'mod_kisi/crud_soal.php?pg=import_file',
            data: new FormData(this),
            processData: false,
            contentType: false,
            cache: false,
            beforeSend: function() {
                $('.loader').css('display', 'block');
            },
            success: function(response) {
                $('.loader').css('display', 'none');
                $('#boxpesan').html(response);
                if (response == 'OK') {
                    notify('berhasil');
                } else {
                    notifygagal('gagal menyimpan');
                }

            }
        });
    });

    //IMPORT FILE PENDUKUNG 
    $('#formsoalcandy').on('submit', function(e) {
        e.preventDefault();
        $.ajax({
            type: 'post',
            url: 'mod_kisi/crud_soal.php?pg=import_candy',
            data: new FormData(this),
            processData: false,
            contentType: false,
            cache: false,
            beforeSend: function() {
                $('.loader').css('display', 'block');
            },
            success: function(response) {
                $('.loader').css('display', 'none');
                $('#boxpesan').html(response);
                notify(response);
            }
        });
    });

    //IMPORT SOAL BEE
    $('#formsoalbee').on('submit', function(e) {
        e.preventDefault();
        $.ajax({
            type: 'post',
            url: 'mod_kisi/crud_soal.php?pg=import_bee',
            data: new FormData(this),
            processData: false,
            contentType: false,
            cache: false,
            beforeSend: function() {
                $('.loader').css('display', 'block');
            },
            success: function(response) {
                $('.loader').css('display', 'none');
                $('#boxpesan').html(response);
                notify(response);
            }
        });
    });
</script>