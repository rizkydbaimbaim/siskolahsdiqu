<?php
defined('APLIKASI') or exit('Anda tidak dizinkan mengakses langsung script ini!');
?>
<?php if ($ac == '') : ?>
    <?php

    if (empty($_GET['kelas'])) {
        $id_kelas = "";
        $sqlkelas = "";
    } else {
        $id_kelas = $_GET['kelas'];
        $sqlkelas = " and a.id_kelas ='" . $_GET['kelas'] . "'";
    }
    if (empty($_GET['id'])) {
        $id_mapel = "";
    } else {
        $id_mapel = $_GET['id'];
    }
    $mapel = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM mapel where id_mapel='$id_mapel' "));

    ?>
    <div class='row'>
        <div class='col-md-12'>
            <div class='box box-solid'>
                <div class='box-header with-border'>
                    <h3 class='box-title'> NILAI <?= $mapel['nama'] ?></h3>
                    <div class='box-tools pull-right btn-grou'>
                        <button class='btn btn-sm btn-primary' onclick="frames['frameresult'].print()"><i class='fa fa-print'></i> Print</button>
                        <iframe name='frameresult' src='mod_nilai/report.php?m=<?= $id_mapel ?>&k=<?= $id_kelas ?>' style='display:none'></iframe>
                        <a class='btn btn-sm btn-success' href='mod_nilai/report_excel.php?m=<?= $id_mapel ?>'><i class='fa fa-download'></i> Download Excel</a>
                        <a class='btn btn-sm btn-danger' href='?pg=jadwal'><i class='fa fa-times'></i></a>
                    </div>
                </div><!-- /.box-header -->
                <div class='box-body'>
                    <div class="row" style="padding-bottom: 10px;">
                        <!-- mryes -->
                        <div class="col-md-3">

                            <select class="form-control select2 kelas">
                                <?php $kelas = mysqli_query($koneksi, "select * from siswa a join nilai b on a.id_siswa=b.id_siswa group by a.id_kelas"); ?>
                                <option value=''> Pilih Kelas</option>
                                <?php while ($kls = mysqli_fetch_array($kelas)) : ?>
                                    <option <?php if ($id_kelas == $kls['id_kelas']) {
                                                echo "selected";
                                            } else {
                                            } ?> value="<?= $kls['id_kelas'] ?>"><?= $kls['id_kelas'] ?></option>
                                <?php endwhile; ?>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <select class="form-control select2 ujian">
                                <?php $ujian = mysqli_query($koneksi, "select * from mapel a join nilai b ON a.id_mapel=b.id_mapel group by a.id_mapel"); ?>
                                <option> Pilih Mata Pelajaran</option>
                                <?php while ($uj = mysqli_fetch_array($ujian)) : ?>
                                    <option <?php if ($id_mapel == $uj['id_mapel']) {
                                                echo "selected";
                                            } else {
                                            } ?> value="<?= $uj['id_mapel'] ?>"><?= $uj['kode'] ?> - <?= $uj['nama'] ?></option>
                                <?php endwhile; ?>
                            </select>
                        </div>
                        <div class="col-md-3">

                            <button id="cari_nilai" class="btn btn-primary">Cari Nilai</button>
                            <script type="text/javascript">
                                $('#cari_nilai').click(function() {
                                    var kelas = $('.kelas').val();
                                    var ujian = $('.ujian').val();
                                    location.replace("?pg=nilaiujian&kelas=" + kelas + "&id=" + ujian);
                                }); //ke url
                            </script>

                        </div>
                        <!-- mryes -->
                    </div>
                    <div id="tablenilai" class='table-responsive'>
                        <table id="tablenilaix" class='table table-bordered table-striped'>
                            <thead>
                                <tr>
                                    <th width='5px'>#</th>
                                  
                                    <th>Nama</th>
                                    <th>Kelas</th>
                                    <th>Lama Ujian</th>
                                    <th>Nilai PG</th>
									<th>Kompleks</th>
									<th>Benar Salah</th>
									<th>Sorting</th>
                                    <th>Essai</th>
                                    <th>Total</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $siswaQ = mysqli_query($koneksi, "SELECT * FROM siswa a join nilai b on a.id_siswa=b.id_siswa where b.id_mapel='$id_mapel'" . $sqlkelas); ?>
                                <?php while ($siswa = mysqli_fetch_array($siswaQ)) : ?>
                                    <?php
                                    $no++;
                                    $ket = '';
                                    
                                    $selisih = 0;
                                    //$kelas = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM kelas WHERE id_kelas='$id_kelas'"));
                                    $nilaiQ = mysqli_query($koneksi, "SELECT * FROM nilai WHERE id_mapel='$id_mapel' AND id_siswa='$siswa[id_siswa]'");
                                    $nilaiC = mysqli_num_rows($nilaiQ);
                                    $nilai = mysqli_fetch_array($nilaiQ);
                                    if ($nilaiC <> 0) :
                                        $selisih = '';
                                        if ($nilai['ujian_mulai'] <> '' and $nilai['ujian_selesai'] <> '') :
                                            $selisih = strtotime($nilai['ujian_selesai']) - strtotime($nilai['ujian_mulai']);

                                            $esai = number_format($nilai['skor_esai'], 2, '.', '');
                                             $bs = number_format($nilai['skor_bs'], 2, '.', '');
											 $multi = number_format($nilai['skor_multi'], 2, '.', '');
											 $urut = number_format($nilai['skor_urut'], 2, '.', '');
                                            $skor = number_format($nilai['skor'], 2, '.', '');
                                            $total = number_format($nilai['total'], 2, '.', '') ;
                                            $ket = "";
                                        elseif ($nilai['ujian_mulai'] <> '' and $nilai['ujian_selesai'] == '') :
                                            $selisih = strtotime($nilai['ujian_berlangsung']) - strtotime($nilai['ujian_mulai']);

                                            $ket = "<i class='fa fa-spin fa-spinner' title='Sedang ujian'></i>";
                                            $skor = $total = '--';
                                        endif;
                                    endif;
                                    ?>
                                    <tr>
                                        <td><?= $no ?></td>
                                       
                                        <td><?= $siswa['nama'] ?></td>
                                        <td><?= $siswa['id_kelas'] ?></td>
                                        <td><?= $ket . " " . lamaujian($selisih) ?></td>
                                        <td><?= $skor ?></td>
										<td><?= $multi ?></td>
										<td><?= $bs ?></td>
										<td><?= $urut ?></td>
                                        <td><?= $esai ?></td>
                                        <td><?= $total ?></td>
                                        <td>
                                            <?php if ($nilai['skor'] <> "") : ?>
                                                <?php

                                                if ($nilai['jawaban'] <> "") :
                                                    $ket = '';
                                                    $link = "?pg=" . $pg . "&ac=esai&id=" . $_GET['id'] . "&ids=" . $siswa['id_siswa'];
                                                    $link2 = "?pg=" . $pg . "&ac=jawaban&id=" . $_GET['id'] .  "&ids=" . $siswa['id_siswa'];
                                                else :
                                                    $ket = 'style="display:none"';
                                                    $link = '#';
                                                    $link2 = '#';
                                                endif;
                                                ?>
                                                <!-- <a href='<?= $link ?>' class='btn btn-xs btn-success' <?= $ket ?>><i class='fa fa-pencil-square-o'></i>input esai</a> -->
                                                <a href='<?= $link2 ?>' class='btn btn-sm btn-success' <?= $ket ?>><i class='fa fa-eye'></i> lihat</a>
                                                <button class='ulangnilai btn btn-sm btn-danger' data-id="<?= $nilai['id_nilai'] ?>" <?= $ket ?>><i class='fa fa-recycle'></i> Ulang</button>
                                                <!-- Button trigger modal -->
                                               

                                                    <!-- Modal -->
                                                    <div class="modal fade" id="modelId<?= $nilai['id_nilai'] ?>" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">JAWABAN ESAI</h5>

                                                                </div>
                                                                <div class="modal-body">
                                                                    <form id='formnesai<?= $nilai['id_nilai'] ?>'>
                                                                        <table class='table table-bordered table-striped'>

                                                                            <tbody>
                                                                                <?php $noX = 0;
                                                                                $jawabanesai = unserialize($nilai['jawaban_esai']);
                                                                                $nesai = unserialize($nilai['nilai_esai2']); ?>
                                                                                <?php foreach ($jawabanesai as $key2 => $value2) : ?>
                                                                                    <?php
                                                                                    $noX++;
                                                                                    $soal = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM soal WHERE id_soal='$key2'"));

                                                                                    ?>
                                                                                    <tr>
                                                                                        <td><?= $noX ?></td>
                                                                                        <td><?= $soal['soal'] ?>
                                                                                            <p><b>JAWAB :</b> <?= $value2 ?></p>
                                                                                        </td>
                                                                                        <td>
                                                                                            <input type="hidden" class="form-control" name="id" value="<?= $nilai['id_nilai'] ?>">
                                                                                            <input style="width: 50px" type="text" class="form-control" name="nesai<?= $nilai['id_nilai'] ?>[<?= $key2 ?>]" value="<?= $nesai[$key2] ?>">
                                                                                        </td>
                                                                                    </tr>
                                                                                <?php endforeach; ?>
                                                                            </tbody>
                                                                        </table>


                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                    <button type="submit" id="simpanesai<?= $nilai['id_nilai'] ?>" class="btn btn-primary">Save</button>
                                                                </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <script>
                                                        $("#formnesai<?= $nilai['id_nilai'] ?>").submit(function(e) {
                                                            e.preventDefault();
                                                            var id = '<?= $nilai['id_nilai'] ?>';
                                                            $.ajax({
                                                                type: "POST",
                                                                url: "mod_nilai/simpanesai.php",
                                                                data: $(this).serialize(),
                                                                success: function(result) {
                                                                    toastr.success(result);
                                                                    setTimeout(function() {
                                                                        location.reload();
                                                                    }, 2000);
                                                                }
                                                            });
                                                        });
                                                    </script>
                                               
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>

                    </div>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>
    </div>

<?php elseif ($ac == 'jawaban') : ?>
    <?php
    $idmapel = $_GET['id'];

    $id_siswa = $_GET['ids'];
    $nilai = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM nilai WHERE id_siswa='$id_siswa' and id_mapel='$idmapel'"));
    $mapel = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM mapel where id_mapel='$idmapel'"));
    $siswa = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM siswa WHERE id_siswa='$id_siswa'"));
    ?>
    <div class='row'>
        <div class='col-md-12'>
            <div class='box box-solid'>
                <div class='box-header with-border '>
                    <h3 class='box-title'>Data Hasil Ujian</h3>
                    <div class='box-tools pull-right btn-group'>
                        <!-- <button class='btn btn-sm btn-primary' onclick="frames['framejawab'].print()"><i class='fa fa-print'></i> Print</button> -->
                        <!-- <i class='btn btn-sm btn-danger' href='?pg=nilai&ac=lihat&id=<?= $idmapel ?>'><i class='fa fa-times'></i></a> -->
                        <!-- <iframe name='framejawab' src='printjawab.php?m=<?= $idmapel ?>&s=<?= $id_siswa ?>' style='display:none;'></iframe> -->
                    </div>
                </div><!-- /.box-header -->
                <div class='box-body'>
                    <table class='table table-bordered table-striped'>
                        <tr>
                            <th width='150'>No Induk</th>
                            <td width='10'>:</td>
                            <td><?= $siswa['nis'] ?></td>
                            <td style="text-align:center; width:150">Nilai PG</td>
							<td style="text-align:center; width:150">Nilai PG Kompleks</td>
							<td style="text-align:center; width:150">Nilai Benar Salah</td>
							<td style="text-align:center; width:150">Nilai Mengurutkan</td>
                            <td style="text-align:center; width:150">Nilai Esai</td>
                            <td style="text-align:center; width:150">Total Nilai</td>
                        </tr>
                        <tr>
                            <th>Nama</th>
                            <td width='10'>:</td>
                            <td><?= $siswa['nama'] ?></td>
                            <td rowspan='3' style='font-size:30px; text-align:center; width:150'><?= $nilai['skor'] ?></td>
							<td rowspan='3' style='font-size:30px; text-align:center; width:150'><?= $nilai['skor_multi'] ?></td>
							<td rowspan='3' style='font-size:30px; text-align:center; width:150'><?= $nilai['skor_bs'] ?></td>
							<td rowspan='3' style='font-size:30px; text-align:center; width:150'><?= $nilai['skor_urut'] ?></td>
                            <td rowspan='3' style='font-size:30px; text-align:center; width:150'><?= $nilai['skor_esai'] ?></td>
                            <td rowspan='3' style='font-size:30px; color:blue; text-align:center; width:150'><?= $nilai['total'] ?></td>
                        </tr>
                        <tr>
                            <th>Kelas</th>
                            <td width='10'>:</td>
                            <td><?= $siswa['id_kelas'] ?></td>
                        </tr>
                        <tr>
                            <th>Mata Pelajaran</th>
                            <td width='10'>:</td>
                            <td><?= $mapel['kode'] ?></td>
                        </tr>
						 <tr>
                            <th>Kelompok Soal</th>
                            <td width='10'>:</td>
                            <td><b><?= $mapel['groupsoal'] ?></b></td>
                        </tr>
                    </table>
					<br>
                 
                    <div class='table-responsive'>
                        <table class='table table-bordered table-striped'>
                            <thead>
                                <tr>
                                    <th width='5px'>#</th>
                                    <th>Soal PG</th>
                                    <th style='text-align:center'>Jawab</th>
                                    <th style='text-align:center'>Hasil</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $jawaban = unserialize($nilai['jawaban']); ?>
                                <?php foreach ($jawaban as $key => $value) : ?>
                                    <?php
                                    $no++;
                                    $soal = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM soal WHERE id_soal='$key'"));
                                    if ($value == $soal['jawaban']) :
                                        $status = "<span class='text-green'><i class='fa fa-check'></i></span>";
                                    else :
                                        $status = "<span class='text-red'><i class='fa fa-times'></i></span>";
                                    endif;
                                    ?>
                                    <tr>
                                        <td><?= $no ?></td>
                                        <td><?= $soal['soal'] ?></td>
                                        <td style='text-align:center'><?= $value ?></td>
                                        <td style='text-align:center'><?= $status ?></td>
										
										<input type="hidden" name="jwb[]" value="<?= $value ?>">
										<input type="hidden" name="nomer[]" value="<?= $soal['nomor'] ?>">
										<input type="hidden" name="ids[]" value="<?= $id_siswa ?>">
										<input type="hidden" name="idmap[]" value="<?= $idmapel ?>">
										<input type="hidden" name="kelas[]" value="<?= $siswa['id_kelas'] ?>">
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
						
                    <div class='table-responsive'>
                        <table class='table table-bordered table-striped'>
                            <thead>
                                <tr>
                                    <th width='5px'>#</th>
                                    <th>Soal PG Kompleks</th>
                                    <th style='text-align:center'>Jawab</th>
                                    <th style='text-align:center'>Hasil</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $jawaban = unserialize($nilai['jawaban_multi']); ?>
                                <?php foreach ($jawaban as $key => $value) : ?>
                                    <?php
                                    $no++;
                                    $soal = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM soal WHERE id_soal='$key'"));
                                    if ($value == $soal['jawaban']) :
                                        $status = "<span class='text-green'><i class='fa fa-check'></i></span>";
                                    else :
                                        $status = "<span class='text-red'><i class='fa fa-times'></i></span>";
                                    endif;
                                    ?>
                                    <tr>
                                        <td><?= $no ?></td>
                                        <td><?= $soal['soal'] ?></td>
                                        <td style='text-align:center'><?= $value ?></td>
                                        <td style='text-align:center'><?= $status ?></td>
										
										<input type="hidden" name="jwb[]" value="<?= $value ?>">
										<input type="hidden" name="nomer[]" value="<?= $soal['nomor'] ?>">
										<input type="hidden" name="ids[]" value="<?= $id_siswa ?>">
										<input type="hidden" name="idmap[]" value="<?= $idmapel ?>">
										<input type="hidden" name="kelas[]" value="<?= $siswa['id_kelas'] ?>">
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
						
						 <br>
                    <div class='table-responsive'>
                        <table class='table table-bordered table-striped'>
                            <thead>
                                <tr>
                                    <th width='5px'>#</th>
                                    <th>Soal Benar Salah</th>
                                    <th style='text-align:center'>Jawab</th>
                                    <th style='text-align:center'>Hasil</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $jawaban = unserialize($nilai['jawaban_bs']); ?>
                                <?php foreach ($jawaban as $key => $value) : ?>
                                    <?php
                                    $no++;
                                    $soal = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM soal WHERE id_soal='$key'"));
                                    if ($value == $soal['jawaban']) :
                                        $status = "<span class='text-green'><i class='fa fa-check'></i></span>";
                                    else :
                                        $status = "<span class='text-red'><i class='fa fa-times'></i></span>";
                                    endif;
                                    ?>
                                    <tr>
                                        <td><?= $no ?></td>
                                        <td><?= $soal['soal'] ?></td>
                                        <td style='text-align:center'><?= $value ?></td>
                                        <td style='text-align:center'><?= $status ?></td>
										
										<input type="hidden" name="jwb[]" value="<?= $value ?>">
										<input type="hidden" name="nomer[]" value="<?= $soal['nomor'] ?>">
										<input type="hidden" name="ids[]" value="<?= $id_siswa ?>">
										<input type="hidden" name="idmap[]" value="<?= $idmapel ?>">
										<input type="hidden" name="kelas[]" value="<?= $siswa['id_kelas'] ?>">
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
						
						 <br>
                    <div class='table-responsive'>
                        <table class='table table-bordered table-striped'>
                            <thead>
                                <tr>
                                    <th width='5px'>#</th>
                                    <th>Soal Megurutkan</th>
                                    <th style='text-align:center'>Jawab</th>
                                    <th style='text-align:center'>Hasil</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $jawaban = unserialize($nilai['jawaban_urut']); ?>
                                <?php foreach ($jawaban as $key => $value) : ?>
                                    <?php
                                    $no++;
                                    $soal = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM soal WHERE id_soal='$key'"));
                                    if ($value == $soal['jawaban']) :
                                        $status = "<span class='text-green'><i class='fa fa-check'></i></span>";
                                    else :
                                        $status = "<span class='text-red'><i class='fa fa-times'></i></span>";
                                    endif;
                                    ?>
                                    <tr>
                                        <td><?= $no ?></td>
                                        <td><?= $soal['soal'] ?></td>
                                        <td style='text-align:center'><?= $value ?></td>
                                        <td style='text-align:center'><?= $status ?></td>
										
										<input type="hidden" name="jwb[]" value="<?= $value ?>">
										<input type="hidden" name="nomer[]" value="<?= $soal['nomor'] ?>">
										<input type="hidden" name="ids[]" value="<?= $id_siswa ?>">
										<input type="hidden" name="idmap[]" value="<?= $idmapel ?>">
										<input type="hidden" name="kelas[]" value="<?= $siswa['id_kelas'] ?>">
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
						
                        <?php if ($nilai['jawaban_esai'] <> null) { ?>
                            <table class='table table-bordered table-striped'>
                                <thead>
                                    <tr>
                                        <th width='5px'>#</th>
                                        <th>Soal ESAI</th>
                                        <th style='text-align:center'>Jawab</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $noX = 0;
                                    $jawabanesai = unserialize($nilai['jawaban_esai']); ?>

                                    <?php foreach ($jawabanesai as $key2 => $value2) : ?>
                                        <?php
                                        $noX++;
                                        $soal = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM soal WHERE id_soal='$key2'"));

                                        ?>
                                        <tr>
                                            <td><?= $noX ?></td>
                                            <td><?= $soal['soal'] ?></td>
                                            <td><?= $value2 ?></td>

                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        <?php } ?>
                        <br>
                        <!-- <table class='table table-bordered table-striped'>
							<thead>
								<tr>
									<th width='5px'>#</th>
									<th>Soal Esai</th>
									<th style='text-align:center'>Hasil</th>
								</tr>
							</thead>
							<tbody>
								<?php $nilaiex = mysqli_query($koneksi, "SELECT * FROM hasil_jawaban WHERE id_siswa='$id_siswa' and id_mapel='$idmapel' and jenis='2' and id_ujian='$nilai[id_ujian]' ");
                                $nox = 0; ?>
								<?php while ($jawabane = mysqli_fetch_array($nilaiex)) : ?>
									<?php
                                    $soal = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM soal WHERE id_soal='$jawabane[id_soal]'"));
                                    $nox++;
                                    ?>
									<tr>
										<td><?= $nox ?></td>
										<td><?= $soal['soal'] ?>
											<p><b>jawab : </b><?= $jawabane['esai'] ?></p>
										</td>
										<td style='text-align:center'><?= $jawabane['nilai_esai'] ?></td>
									</tr>
								<?php endwhile; ?>
							</tbody>
						</table> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>
<script>
    $('#tablenilaix').dataTable();
    $(document).on('click', '.ulangnilai', function() {
        var id = $(this).data('id');
        console.log(id);
        swal({
            title: 'Apa anda yakin?',
            text: " Akan Mengulang Ujian Ini ??",
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes!'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: 'mod_nilai/ulangujian.php',
                    method: "POST",
                    data: 'id=' + id,
                    success: function(data) {
                        iziToast.success({
                            title: 'Mantap!',
                            message: 'Data berhasil diulang',
                            position: 'topRight'
                        });
                        setTimeout(function() {
                            window.location.reload();
                        }, 2000);
                    }
                });
            }
        })
    });
</script>