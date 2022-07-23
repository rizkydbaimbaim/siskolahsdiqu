<?php
defined('APLIKASI') or exit('Anda tidak dizinkan mengakses langsung script ini!');
?>
<div class='row'>
    <div class='col-md-12'>

        <div class='box box-solid'>
            <div class='box-header with-border '>
                <h3 class='box-title'><i class='fa fa-folder'></i> Data Bank Soal </h3>
                <div class='box-tools pull-right btn-group'>
                </div>
            </div><!-- /.box-header -->
            <div class='box-body'>
                <div id="hasilkirim"></div>
                <div class=''>

                    <div id='tabledatamapel' class='table-responsive'>
                        <table class='table table-bordered table-striped  table-hover'>
                            <thead>
                                <tr>
                                    <th width='5px'>#</th>
                                    <th>Mata Pelajaran</th>
                                    <th>Group Soal</th>
                                  
                                    <th width="10%">Terkirim</th>
                                    <!-- <th>Temp</th> -->

                                    <th width="10%">Aksi</th>

                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                if ($pengawas['level'] == 'guru') {
                                    $mapelQ = mysqli_query($koneksi, "SELECT * FROM mapel where idguru='$id_pengawas' group by id_mapel");
                                } else {
                                    $mapelQ = mysqli_query($koneksi, "SELECT * FROM mapel  group by id_mapel");
                                }
                                while ($mapel = mysqli_fetch_array($mapelQ)) {
                                    $terkirim = mysqli_num_rows(mysqli_query($koneksi, "select * from mapel where id_mapel='$mapel[id_mapel]' and sts='1'"));
                                    $cek = mysqli_num_rows(mysqli_query($koneksi, "select * from mapel where id_mapel='$mapel[id_mapel]' AND sts='1'"));
                                    
                                    if ($cek <> 0) {
                                        $dis = 'disabled';
                                    } else {
                                        $dis = '';
                                    }

                                    $no++;
                                    $tempjawaban = mysqli_num_rows(mysqli_query($koneksi, "select * from mapel where id_mapel='$mapel[id_mapel]'"));
                              
                                    echo "
                                <tr>

                                    <td>$no</td>
                                    
                                    <td>$mapel[nama]</td>
                                    <td>$mapel[groupsoal]</td>
                                    
                                    <td>$mapel[sts]</td>
                                    <!--<td>$tempjawaban</td>-->
                                  
                                    <td>
									
                                    <button class='kirimbank btn btn-success btn-sm' data-id='$mapel[id_mapel]' $dis><i class='fa fa-check'></i> Kirim Bank Soal</button>
                                    <!--<button data-id='$mapel[id_mapel]' class='pindahjwbn btn btn-sm btn-primary' $dis><i class='fa fa-refresh'></i> pindah Jawaban</button>-->
									
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
                $(document).on('click', '.kirimbank', function() {

                    var idmapel = $(this).data('id');
                    console.log(idmapel);
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
                                url: 'mod_sinkron/kirimbank.php',
                                data: 'id=' + idmapel,
                                beforeSend: function() {
                                    $('.loader').css('display', 'block');

                                },
                                success: function(response) {

                                    $('.loader').css('display', 'none');
                                    $('#hasilkirim').html(response);
                                    $("#tabledatamapel").load(window.location + " #tabledatamapel");

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
                        text: "aksi ini akan menghapus data NILAI dan JAWABAN pada mapel ini!",

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
                                    $("#tabledatamapel").load(window.location + " #tabledatamapel");
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
                //         text: "aksi ini akan menghapus data jawaban pada mapel ini!",

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
                //                     $("#tabledatamapel").load(window.location + " #tabledatamapel");
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
                //                     $("#tabledatamapel").load(window.location + " #tabledatamapel");
                //                 }
                //             });
                //         }
                //     })

                // });
            });
        </script>