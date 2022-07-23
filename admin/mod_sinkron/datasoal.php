<?php
defined('APLIKASI') or exit('Anda tidak dizinkan mengakses langsung script ini!');
?>
<div class='row'>
    <div class='col-md-12'>

        <div class='box box-solid'>
            <div class='box-header with-border '>
                <h3 class='box-title'><i class='fa fa-folder'></i> Data Soal </h3>
                <div class='box-tools pull-right btn-group'>
                </div>
            </div><!-- /.box-header -->
            <div class='box-body'>
                <div id="hasilkirim"></div>
                <div class=''>

                    <div id='tabledatasoal' class='table-responsive'>
                        <table class='table table-bordered table-striped  table-hover'>
                            <thead>
                                <tr>
                                    <th width='5px'>#</th>
                                    <th>Mata Pelajaran</th>
                                    <th>Group Soal</th>
                                  <th width='5px'>Jml</th>
                                    <th width="10%">Terkirim</th>
                                    <th width="10%">Aksi</th>

                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                if ($pengawas['level'] == 'guru') {
                                    $soalQ = mysqli_query($koneksi, "SELECT * FROM soal JOIN mapel ON mapel.id_mapel=soal.id_mapel where mapel.idguru='$id_pengawas' group by mapel.id_mapel");
                                } else {
                                    $soalQ = mysqli_query($koneksi, "SELECT * FROM soal JOIN mapel ON mapel.id_mapel=soal.id_mapel group by mapel.id_mapel");
                                }
                                while ($soal = mysqli_fetch_array($soalQ)) {
                                    $terkirim = mysqli_num_rows(mysqli_query($koneksi, "select * from soal where id_soal='$soal[id_mapel]' and sts='1'"));
                                    $cek = mysqli_num_rows(mysqli_query($koneksi, "select * from soal where id_mapel='$soal[id_mapel]' AND sts='1'"));
                                    $jumsoal = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM soal WHERE id_mapel='$soal[id_mapel]'"));
                                    if ($cek <> 0) {
                                        $dis = 'disabled';
                                    } else {
                                        $dis = '';
                                    }

                                    $no++;
                                    $tempjawaban = mysqli_num_rows(mysqli_query($koneksi, "select * from soal where id_soal='$soal[id_soal]'"));
                              
                                    echo "
                                <tr>

                                    <td>$no</td>
                                    
                                    <td>$soal[nama]</td>
                                    <td>$soal[groupsoal]</td>
                                     <td>$jumsoal</td>
                                    <td>$soal[sts]</td>
                                    <!--<td>$tempjawaban</td>-->
                                  
                                    <td>
									
                                    <button class='kirimsoal btn btn-info btn-sm' data-id='$soal[id_soal]' $dis><i class='fa fa-check'></i> Kirim Soal</button>
                                    <!--<button data-id='$soal[id_soal]' class='pindahjwbn btn btn-sm btn-primary' $dis><i class='fa fa-refresh'></i> pindah Jawaban</button>-->
									
                                    </td>
								 
                                </tr>
                                ";

								}
                                ?>

                            </tbody>
                        </table>
                    </div>

                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>
        <script>
            $(document).ready(function() {
                $(document).on('click', '.kirimsoal', function() {

                    var idsoal = $(this).data('id');
                    console.log(idsoal);
                    swal({
                        title: 'Are you sure?',
                        text: 'Fungsi ini akan mengirim data ke server pusat',
                        type: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Ya, Kirim!'
                    }).then((result) => {
                        if (result.value) {
                            $.ajax({
                                type: 'POST',
                                url: 'mod_sinkron/kirimsoal.php',
                                data: 'id=' + idsoal,
                                beforeSend: function() {
                                    $('.loader').css('display', 'block');

                                },
                                success: function(response) {

                                    $('.loader').css('display', 'none');
                                    $('#hasilkirim').html(response);
                                    $("#tabledatasoal").load(window.location + " #tabledatasoal");

                                }
                            });

                        }
                    })

                });
                $.ajax({
                    type: 'POST',
                    url: 'mod_sinkron/statusserver.php',
                    beforeSend: function() {
                        $('#loading-image').show();
                    },
                    success: function(response) {
                        $('#statusserver').html(response);
                        $('#loading-image').hide();

                    }
                });
                $(document).on('click', '.hapusnilai', function() {
                    var id = $(this).data('id');
                    console.log(id);
                    swal({
                        title: 'Apa anda yakin?',
                        text: "aksi ini akan menghapus data NILAI dan JAWABAN pada soal ini!",

                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes!'
                    }).then((result) => {
                        if (result.value) {
                            $.ajax({
                                url: 'mod_sinkron/hapusnilai.php',
                                method: "POST",
                                data: 'id=' + id,
                                success: function(data) {
                                    swal({
                                        position: 'top-end',
                                        type: 'success',
                                        title: 'Data berhasil dihapus',
                                        showConfirmButton: false,
                                        timer: 1500
                                    });
                                    $("#tabledatasoal").load(window.location + " #tabledatasoal");
                                }
                            });
                        }
                    })

                });
                // $(document).on('click', '.hapusjwbn', function() {
                //     var id = $(this).data('id');
                //     console.log(id);
                //     swal({
                //         title: 'Apa anda yakin?',
                //         text: "aksi ini akan menghapus data jawaban pada soal ini!",

                //         showCancelButton: true,
                //         confirmButtonColor: '#3085d6',
                //         cancelButtonColor: '#d33',
                //         confirmButtonText: 'Yes!'
                //     }).then((result) => {
                //         if (result.value) {
                //             $.ajax({
                //                 url: 'hapusjawaban.php',
                //                 method: "POST",
                //                 data: 'id=' + id,
                //                 success: function(data) {
                //                     swal({
                //                         position: 'top-end',
                //                         type: 'success',
                //                         title: 'Data berhasil dihapus',
                //                         showConfirmButton: false,
                //                         timer: 1500
                //                     });
                //                     $("#tabledatasoal").load(window.location + " #tabledatasoal");
                //                 }
                //             });
                //         }
                //     })

                // });
                // $(document).on('click', '.pindahjwbn', function() {
                //     var id = $(this).data('id');
                //     console.log(id);
                //     swal({
                //         title: 'Apa anda yakin?',
                //         text: "aksi ini akan memindahkan dari temp_jawaban ke jawaban!",

                //         showCancelButton: true,
                //         confirmButtonColor: '#3085d6',
                //         cancelButtonColor: '#d33',
                //         confirmButtonText: 'Yes!'
                //     }).then((result) => {
                //         if (result.value) {
                //             $.ajax({
                //                 url: 'mod_sinkron/ambiljawaban.php',
                //                 method: "POST",
                //                 data: 'id=' + id,
                //                 beforeSend: function() {
                //                     $('.loader').css('display', 'block');

                //                 },
                //                 success: function(data) {
                //                     console.log(data);
                //                     $('.loader').css('display', 'none');
                //                     swal({
                //                         position: 'top-end',
                //                         type: 'success',
                //                         title: 'Data berhasil dipindahkan',
                //                         showConfirmButton: false,
                //                         timer: 1500
                //                     });
                //                     $("#tabledatasoal").load(window.location + " #tabledatasoal");
                //                 }
                //             });
                //         }
                //     })

                // });
            });
        </script>