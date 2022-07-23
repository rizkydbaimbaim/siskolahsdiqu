<?php
defined('APLIKASI') or exit('Anda tidak dizinkan mengakses langsung script ini!');

$pesan = '';
$value = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM mapel WHERE id_mapel='$id'"));
$tgl_ujian = explode(' ', $value['tgl_ujian']);
if ($ac == '') :
?>
    <div class='row'>
        <div class='col-md-12'><?= $pesan ?>
            <div class='box box-solid '>
                <div class='box-header with-border '>
                    <h3 class='box-title'><i class='fa fa-briefcase'></i> Data Kisi-kisi</h3>
                    <div class='box-tools pull-right '>
                        <?php if ($setting['server'] == 'pusat') : ?>
                            <button id='btnhapusbank' class='btn btn-sm btn-danger'><i class='fa fa-trash'></i> <span class='hidden-xs'>Hapus</span></button>
                            <button class='btn btn-sm btn-flat btn-success' data-toggle='modal' data-target='#tambahbanksoal'><i class='glyphicon glyphicon-plus'></i> <span class='hidden-xs'>Tambah Kisi Soal</span></button>
                        <?php endif ?>
                    </div>
                </div><!-- /.box-header -->
                <div class='box-body'>
                    <div id='tablereset' class='table-responsive'>
                        <table id='example1' class='table table-bordered table-striped'>
                            <thead>
                                <tr>
                                    <th width='5px'><input type='checkbox' id='ceksemua'></th>
                                    <th width='5px'>No</th>
                                    <th>Mata Pelajaran</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if ($pengawas['level'] == 'admin') :
                                    $mapelQ = mysqli_query($koneksi, "SELECT * FROM mapel_kisi ORDER BY date ASC");
                                elseif ($pengawas['level'] == 'guru') :
                                    $mapelQ = mysqli_query($koneksi, "SELECT * FROM mapel_kisi WHERE idguru='$pengawas[id_pengawas]' ORDER BY date ASC");
                                endif;
                                ?>
                                <?php while ($mapel = mysqli_fetch_array($mapelQ)) : ?>
                                    <?php
                                    $cek = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM mapel_kisi WHERE id_mapel='$mapel[id_mapel]'"));
                                    $no++;
                                    ?>
                                    <tr>
                                        <td><input type='checkbox' name='cekpilih[]' class='cekpilih' id='cekpilih-$no' value="<?= $mapel['id_mapel'] ?>"></td>
                                        <td><small class='label label-primary'><?= $no ?></small></td>
                                        <td>
                                            <?php

                                            if ($cek <> 0) {
                                                if ($mapel['status'] == '0') :
                                                    $status = '<label class="label label-danger">non aktif</label>';
                                                else :
                                                    $status = '<label class="label label-success"> aktif </label>';
                                                endif;
                                            } else {
                                                $status = '<label class="label label-warning"> Soal Kosong </label>';
                                            }
                                            $guruku = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM pengawas WHERE id_pengawas = '$mapel[idguru]'"));
                                            ?>
                                            <img src="../dist/img/soal.png" width=45 alt="">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree<?= $no ?>" class="" aria-expanded="true">
                                                <span style="font-size:15px"><?= $mapel['kode'] ?> </span>
                                                <smal>[<?= $mapel['nama'] ?>]</smal> <?= $status ?>
                                            </a>
                                            <div id="collapseThree<?= $no ?>" class="panel-collapse collapse" aria-expanded="true">
                                                <div class="box-body">
                                                    <p>Level :<small class='label label-primary'><?= $mapel['level'] ?></small>
                                                        Jurusan : <?php
                                                                    $dataArray = unserialize($mapel['idpk']);
                                                                    foreach ($dataArray as $key => $value) :
                                                                        echo "<small class='label label-success'>$value </small>&nbsp;";
                                                                    endforeach;
                                                                    ?></p>
                                                    
                                                        Kelas : <?php
                                                                $dataArray = unserialize($mapel['kelas']);
                                                                foreach ($dataArray as $key => $value) :
                                                                    echo "<small class='label label-success'>$value </small>&nbsp;";
                                                                endforeach;
                                                                ?></p>

                                                    <p> Guru : <small class='label label-primary'><?= $guruku['nama'] ?></small></p>
                                                    
                                                    <?php if ($setting['server'] == 'pusat') : ?>

                                                        <div class=''>
                                                            <a href='?pg=<?= $pg ?>&ac=lihat&id=<?= $mapel['id_mapel'] ?>'><button class='btn  btn-success btn-sm'><i class='fa fa-search'></i> Kisi-kisi</button></a>
                                                            <a href='?pg=<?= $pg ?>&ac=importsoal&id=<?= $mapel['id_mapel'] ?>'><button class='btn btn-info btn-sm'><i class='fa fa-upload'></i> Import</button></a>
                                                            <a><button class='btn btn-warning btn-sm' data-toggle='modal' data-target='#editbanksoal<?= $mapel['id_mapel'] ?>'><i class='fa fa-edit'></i> Edit</button></a>
                                                         
                                                        </div>

                                                    <?php endif ?>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>

                                    <div class="modal fade" id="copybanksoal<?= $mapel['id_mapel'] ?>" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Copy Bank Soal</h5>

                                                </div>
                                                <form id="formcopybank<?= $mapel['id_mapel'] ?>">
                                                    <div class="modal-body">
                                                        <input type='hidden' name='idm' value='<?= $mapel['id_mapel'] ?>' />
                                                        <div class="form-group">
                                                            <label for="">Kode Bank Soal</label>
                                                            <input type="text" class="form-control" name="kodebank" aria-describedby="helpId" placeholder="">
                                                            <small id="helpId" class="form-text text-muted">isi kode bank soal baru</small>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                        <button type="submit" class="btn btn-primary">Copy Bank Soal</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <script>
                                        $('#formcopybank<?= $mapel['id_mapel'] ?>').submit(function(e) {
                                            e.preventDefault();
                                            $.ajax({
                                                type: 'POST',
                                                url: 'mod_kisi/crud_banksoal.php?pg=copy_bank',
                                                data: $(this).serialize(),
                                                success: function(data) {
                                                    if (data == "OK") {
                                                        toastr.success("bank soal berhasil digandakan");
                                                    } else {
                                                        toastr.error(data);
                                                    }
                                                    $('#copybanksoal<?= $mapel['id_mapel'] ?>').modal('hide');
                                                    setTimeout(function() {
                                                        location.reload();
                                                    }, 2000);

                                                }
                                            });
                                            return false;
                                        });
                                    </script>
                                    <div class='modal fade' id='editbanksoal<?= $mapel['id_mapel'] ?>' style='display: none;'>
                                        <div class='modal-dialog'>
                                            <div class='modal-content'>
                                                <div class='modal-header bg-blue'>
                                                    <button class='close' data-dismiss='modal'><span aria-hidden='true'><i class='glyphicon glyphicon-remove'></i></span></button>
                                                    <h3 class='modal-title'>Edit Bank Soal</h3>
                                                </div>
                                                <form id="formeditbank<?= $mapel['id_mapel'] ?>">
                                                    <div class='modal-body'>
                                                        <input type='hidden' name='idm' value='<?= $mapel['id_mapel'] ?>' />
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="">Kode Bank Soal</label>
                                                                    <input type="text" class="form-control" name="kode" value="<?= $mapel['kode'] ?>" required>

                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class='form-group'>
                                                                    <label>Mata Pelajaran</label>
                                                                    <select name='nama' class='form-control' required='true'>
                                                                        <option value=''></option>
                                                                        <?php
                                                                        $pkQ = mysqli_query($koneksi, "SELECT * FROM mata_pelajaran ORDER BY nama_mapel ASC");
                                                                        while ($pk = mysqli_fetch_array($pkQ)) : ($pk['kode_mapel'] == $mapel['nama']) ? $s = 'selected' : $s = '';
                                                                            echo "<option value='$pk[kode_mapel]' $s>$pk[nama_mapel]</option>";
                                                                        endwhile;
                                                                        ?>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <?php if ($setting['jenjang'] == 'SMK') : ?>
                                                            <div class='form-group'>
                                                                <label>Program Keahlian</label>
                                                                <select name='id_pk[]' class='select2 form-control' required='true' multiple='multiple' style="width: 100%">
                                                                    <option value='semua'>Semua</option>
                                                                    <?php
                                                                    $pkQ = mysqli_query($koneksi, "SELECT * FROM pk ORDER BY program_keahlian ASC");
                                                                    while ($pk = mysqli_fetch_array($pkQ)) :
                                                                        if (in_array($pk['id_pk'], unserialize($mapel['idpk']))) : ?>
                                                                            <option value="<?= $pk['id_pk'] ?>" selected><?= $pk['id_pk'] ?></option>"
                                                                        <?php else : ?>
                                                                            <option value="<?= $pk['id_pk'] ?>"><?= $pk['id_pk'] ?></option>"
                                                                        <?php endif; ?>
                                                                    <?php endwhile;
                                                                    ?>
                                                                </select>
                                                            </div>
                                                        <?php endif; ?>
                                                        <div class='form-group'>
                                                            <div class='row'>
                                                                <div class='col-md-6'>
                                                                    <label>Pilih Level</label>
                                                                    <select name='level' class='form-control' required='true'>
                                                                        <option value='semua'>Semua Level</option>
                                                                        <?php
                                                                        $lev = mysqli_query($koneksi, "SELECT * FROM level");
                                                                        while ($level = mysqli_fetch_array($lev)) : ($level['kode_level'] == $mapel['level']) ? $s = 'selected' : $s = '';
                                                                            echo "<option value='$level[kode_level]' $s>$level[kode_level]</option>";
                                                                        endwhile;
                                                                        ?>
                                                                    </select>
                                                                </div>
                                                                <div class='col-md-6'>
                                                                    <label>Pilih Kelas</label><br>
                                                                    <select name='kelas[]' class='form-control select2' style='width:100%' multiple required='true'>
                                                                        <option value='semua'>Semua Kelas</option>
                                                                        <?php $lev = mysqli_query($koneksi, "SELECT * FROM kelas"); ?>
                                                                        <?php while ($kelas = mysqli_fetch_array($lev)) : ?>
                                                                            <?php if (in_array($kelas['id_kelas'], unserialize($mapel['kelas']))) : ?>
                                                                                <option value="<?= $kelas['id_kelas'] ?>" selected><?= $kelas['id_kelas'] ?></option>"
                                                                            <?php else : ?>
                                                                                <option value="<?= $kelas['id_kelas'] ?>"><?= $kelas['id_kelas'] ?></option>"
                                                                            <?php endif; ?>
                                                                        <?php endwhile ?>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class='form-group'>
                                                            <div class='row'>
                                                                <div class='col-md-3'>
                                                                    <label>Jumlah Soal PG</label>
                                                                    <input type='number' name='jml_soal' class='form-control' value="<?= $mapel['jml_soal'] ?>" required='true' />
                                                                </div>
                                                                <div class='col-md-3'>
                                                                    <label>Bobot Soal PG %</label>
                                                                    <input type='number' name='bobot_pg' class='form-control' value="<?= $mapel['bobot_pg'] ?>" required='true' />
                                                                </div>
                                                                <div class='col-md-3'>
                                                                    <label>Soal Tampil</label>
                                                                    <input type='number' name='tampil_pg' class='form-control' value="<?= $mapel['tampil_pg'] ?>" required='true' />
                                                                </div>
                                                                <div class='col-md-3'>
                                                                    <label>Opsi</label>
                                                                    <select name='opsi' class='form-control'>
                                                                        <?php
                                                                        $opsi = array("3", "4", "5");
                                                                        for ($x = 0; $x < count($opsi); $x++) {
                                                                            if ($mapel['opsi'] == $opsi[$x]) :
                                                                                echo "<option value='$opsi[$x]' selected>$opsi[$x]</option>";
                                                                            else :
                                                                                echo "<option value='$opsi[$x]'>$opsi[$x]</option>";
                                                                            endif;
                                                                        }
                                                                        ?>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class='form-group'>
                                                            <div class='row'>
                                                                <div class='col-md-3'>
                                                                    <label>Jumlah Soal Essai</label>
                                                                    <input type='number' name='jml_esai' class='form-control' value="<?= $mapel['jml_esai'] ?>" required='true' />
                                                                </div>
                                                                <div class='col-md-3'>
                                                                    <label>Bobot Soal Essai %</label>
                                                                    <input type='number' name='bobot_esai' class='form-control' value="<?= $mapel['bobot_esai'] ?>" required='true' />
                                                                </div>
                                                                <div class='col-md-3'>
                                                                    <label>Soal Tampil</label>
                                                                    <input type='number' name='tampil_esai' class='form-control' value="<?= $mapel['tampil_esai'] ?>" required='true' />
                                                                </div>
                                                                <div class='col-md-3'>
                                                                    <label>KKM</label>
                                                                    <input type='number' name='kkm' class='form-control' value="<?= $mapel['kkm'] ?>" required='true' />
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class='form-group'>
                                                            <div class='row'>
                                                                <?php if ($pengawas['level'] == 'admin') : ?>
                                                                    <div class='col-md-4'>
                                                                        <label>Guru Pengampu</label>
                                                                        <select name='guru' class='form-control' required='true'>
                                                                            <?php
                                                                            $guruku = mysqli_query($koneksi, "SELECT * FROM pengawas where level='guru' order by nama asc");
                                                                            while ($guru = mysqli_fetch_array($guruku)) {
                                                                                ($guru['id_pengawas'] == $mapel['idguru']) ? $s = 'selected' : $s = '';
                                                                                echo "<option value='$guru[id_pengawas]' $s>$guru[nama]</option>";
                                                                            }
                                                                            ?>
                                                                        </select>
                                                                    </div>
                                                                <?php endif; ?>
                                                                <div class='col-md-4'>
                                                                    <label>Soal Agama</label>
                                                                    <select name='agama' class='form-control'>
                                                                        <option value=''>Bukan Soal Agama</option>
                                                                        <?php
                                                                        $agam = mysqli_query($koneksi, "SELECT * FROM siswa group by agama");
                                                                        while ($agama = mysqli_fetch_array($agam)) : ($agama['agama'] == $mapel['soal_agama']) ? $s = 'selected' : $s = '';
                                                                            echo "<option value='" . $agama['agama'] . "' $s>$agama[agama]</option>";
                                                                        endwhile;
                                                                        ?>
                                                                    </select>
                                                                </div>
                                                                <div class='col-md-4'>
                                                                    <label>Status Soal</label>
                                                                    <select name='status' class='form-control' required='true'>
                                                                        <option value='1'>Aktif</option>
                                                                        <option value='0'>Non Aktif</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class='modal-footer'>
                                                        <button type='submit' name='editbanksoal' class='btn btn-sm btn-flat btn-success'><i class='fa fa-check'></i> Simpan</button>

                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <script>
                                        $('#formeditbank<?= $mapel['id_mapel'] ?>').submit(function(e) {
                                            e.preventDefault();
                                            $.ajax({
                                                type: 'POST',
                                                url: 'mod_kisi/crud_banksoal.php?pg=ubah',
                                                data: $(this).serialize(),
                                                success: function(data) {

                                                    if (data == "OK") {
                                                        toastr.success("bank soal berhasil dirubah");
                                                    } else {
                                                        toastr.error(data);
                                                    }
                                                    $('#editbanksoal<?= $mapel['id_mapel'] ?>').modal('hide');
                                                    setTimeout(function() {
                                                        location.reload();
                                                    }, 2000);

                                                }
                                            });
                                            return false;
                                        });
                                    </script>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>
    </div>
    <div class='modal fade' id='tambahbanksoal' style='display: none;'>
        <div class='modal-dialog'>
            <div class='modal-content'>
                <div class='modal-header bg-blue'>
                    <button class='close' data-dismiss='modal'><span aria-hidden='true'><i class='glyphicon glyphicon-remove'></i></span></button>
                    <h3 class='modal-title'>Tambah Kisi-kisi Soal</h3>
                </div>
                <form id="formtambahbank">
                    <div class='modal-body'>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Kode Mapel</label>
                                    <input type="text" class="form-control" name="kode" placeholder="Masukan Kode Mapel Kelas" required>

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class='form-group'>
                                    <label>Mata Pelajaran</label>
                                    <select name='nama' class='form-control' required='true'>
                                        <option value=''></option>";
                                        <?php
                                        $pkQ = mysqli_query($koneksi, "SELECT * FROM mata_pelajaran ORDER BY nama_mapel ASC");
                                        while ($pk = mysqli_fetch_array($pkQ)) {
                                            echo "<option value='$pk[kode_mapel]'>$pk[nama_mapel]</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>


                        <?php if ($setting['jenjang'] == 'SMK') : ?>
                            <div class='form-group'>
                                <label>Program Keahlian</label>
                                <select name='id_pk[]' class='form-control select2' multiple="multiple" style='width:100%' required='true'>
                                    <option value='semua'>Semua</option>
                                    <?php
                                    $pkQ = mysqli_query($koneksi, "SELECT * FROM pk ORDER BY program_keahlian ASC");
                                    while ($pk = mysqli_fetch_array($pkQ)) :
                                        echo "<option value='$pk[id_pk]'>$pk[program_keahlian]</option>";
                                    endwhile;
                                    ?>
                                </select>
                            </div>
                        <?php endif; ?>
                        <div class='form-group'>
                            <div class='row'>
                                <div class='col-md-6'>
                                    <label>Level Kisi</label>
                                    <select name='level' id='soallevel' class='form-control' required='true'>
                                        <option value=''></option>
                                        <option value='semua'>Semua</option>
                                        <?php
                                        $lev = mysqli_query($koneksi, "SELECT * FROM level");
                                        while ($level = mysqli_fetch_array($lev)) {
                                            echo "<option value='$level[kode_level]'>$level[kode_level]</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class='col-md-6'>
                                    <label>Pilih Kelas</label><br>
                                    <select name='kelas[]' id='soalkelas' class='form-control select2' multiple='multiple' style='width:100%' required='true'>
                                    </select>
                                </div>
                            </div>
                        </div>
                        
                        <div class='form-group'>
                            <div class='row'>
                                <?php if ($pengawas['level'] == 'admin') : ?>
                                    <div class='col-md-6'>
                                        <label>Guru Pengampu</label>
                                        <select name='guru' class='form-control' required='true'>
                                            <?php
                                            $guruku = mysqli_query($koneksi, "SELECT * FROM pengawas where level='guru' order by nama asc");
                                            while ($guru = mysqli_fetch_array($guruku)) {
                                                echo "<option value='$guru[id_pengawas]'>$guru[nama]</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                <?php endif; ?>
                                
                                <div class='col-md-6'>
                                    <label>Status Kisi</label>
                                    <select name='status' class='form-control' required='true'>
                                        <option value='1'>Aktif</option>
                                        <option value='0'>Non Aktif</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class='modal-footer'>
                        <button type='submit' name='tambahsoal' class='btn btn-sm btn-flat btn-success'><i class='fa fa-check'></i> Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php elseif ($ac == 'input') : ?>
    <?php include 'mod_kisi/input_soal.php'; ?>
<?php elseif ($ac == 'lihat') : ?>
    <?php
    $id_mapel = $_GET['id'];
   
    ?>

    <div class='row'>
        <div class='col-md-12'>
            <div class='box box-solid'>
                <div class='box-header with-border '>
                    <h3 class='box-title'>Daftar Kisi-kisi <?= $namamapel['nama'] ?></h3>
                    <div class='box-tools pull-right '>
                        
                        <iframe name='frameresult' src='mod_kisi/cetaksoal.php?id=<?= $id_mapel ?>' style='border:none;width:1px;height:1px;'></iframe>
                    </div>
                </div><!-- /.box-header -->
                <div class='box-body'>
                    <div class='nav-tabs-custom'>
                        <ul class='nav nav-tabs'>
                            <li class='active'><a aria-expanded='true' href='#detail' data-toggle='tab'><i class='fa fa-envelope-open'></i> Daftar Kisi-kisi</a></li>

                        </ul>
                        <div class='tab-content'>
                            <div class='tab-pane active' id='detail'>
                                <div class='table-responsive'>
                                    <b>Kisi-kisi Soal</b>
                                    <table class='table table-bordered table-striped'>
                                        <tbody>
										<tr><th>No KD</th>
												 <th>KOMPETENSI DASAR</th>
												 <th>MATERI ESENSIAL</th>
												  <th>INDIKATOR</th>
                                                </tr>
                                            <?php $soalq = mysqli_query($koneksi, "SELECT * FROM kisi"); ?>
                                            <?php while ($soal = mysqli_fetch_array($soalq)) : ?>
                                                 
                                                 <tr>
													 <td><?= $soal['nokd'] ?></td>
													  <td><?= $soal['kd'] ?></td>
													  <td><?= $soal['materi'] ?></td>
													    <td> <a href='?pg=<?= $pg ?>&ac=lihat2&id=<?= $soal['id_mapel'] ?>&nkd=<?= $soal['nokd'] ?>'><button class='btn  btn-success btn-sm'><i class='fa fa-search'></i> Indikator</button></a>
													   </td>
													   </tr>
                                                                    </div>
                                                                    
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endwhile; ?>
                                        </tbody>
                                    </table>
                                   
          <?php elseif ($ac == 'lihat2') : ?>
    <?php
    $id_mapel = $_GET['id'];
   $nkd = $_GET['nkd'];
   
   $edit=$koneksi->query("select * from kisi WHERE id_mapel='$id_mapel' AND nokd='$nkd'");
$edi=mysqli_fetch_array($edit);
    ?>

    <div class='row'>
        <div class='col-md-12'>
            <div class='box box-solid'>
                <div class='box-header with-border '>
                    <h3 class='box-title'> <?= $id_mapel ?></h3>
                    <div class='box-tools pull-right '>
                         <a href='?pg=kisi&ac=lihat&id=<?php echo $edi['id'] ?>' class='btn btn-sm btn-flat btn-primary <?= $hidex ?>'><i class='fa fa-refresh'></i><span class='hidden-xs'> Kembali</span> </a>

                        <iframe name='frameresult' src='mod_kisi/cetaksoal.php?id=<?= $id_mapel ?>' style='border:none;width:1px;height:1px;'></iframe>
                    </div>
                </div><!-- /.box-header -->
                <div class='box-body'>
                    <div class='nav-tabs-custom'>
                        <ul class='nav nav-tabs'>
                            <li class='active'><a aria-expanded='true' href='#detail' data-toggle='tab'><i class='fa fa-envelope-open'></i> Daftar Kisi-kisi</a></li>

                        </ul>
                        <div class='tab-content'>
                            <div class='tab-pane active' id='detail'>
                                <div class='table-responsive'>
                                    <b>KD <?= $nkd ?> : <?= $edi['kd'] ?></b>
                                    <table class='table table-bordered'>
                                        <tbody>
										<tr><th rowspan='2'>KD</th>
												 <th rowspan='2'>INDIKATOR</th>
												 <th colspan='3'>LEVEL KOGNITIF</th>
												  <th rowspan='2'>JENIS</th>
												   <th rowspan='2'>SKOR</th>
												   </tr>
												   <tr>
												   <th>1</th>
												   <th>2</th>
												   <th>3</th>
                                                </tr>
                                            <?php $soalqu = mysqli_query($koneksi, "SELECT * FROM kisi2 WHERE id_mapel='$id_mapel' AND nkd='$nkd'"); ?>
                                            <?php while ($soalu = mysqli_fetch_array($soalqu)) : ?>
                                                 
                                                 <tr>
													 <td><?= $soalu['nkd'] ?></td>
													  <td><?= $soalu['indikator'] ?></td>
													  <td><?= $soalu['kog1'] ?></td>
													  <td><?= $soalu['kog2'] ?></td>
													  <td><?= $soalu['kog3'] ?></td>
													  <td><?= $soalu['jenis'] ?></td>
													  <td><?= $soalu['skor'] ?></td>
													   
													   </tr>
                                                                    </div>
                                                                    
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endwhile; ?>
                                        </tbody>
                                    </table>                               
                                </div>
                            </div>

                        </div>
                    </div>

                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>
    </div>
<?php elseif ($ac == 'hapusfile') : ?>
    <?php
    $jenis = $_GET['jenis'];
    $id = $_GET['id'];
    $file = $_GET['file'];
    $soal = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM soal WHERE id_soal='$id'"));
    (file_exists("../files/" . $soal[$file])) ? unlink("../files/" . $soal[$file]) : null;
    mysqli_query($koneksi, "UPDATE soal SET $file='' WHERE id_soal='$id'");
    jump("?pg=$pg&ac=input&paket=$soal[paket]&id=$soal[id_mapel]&no=$soal[nomor]&jenis=$jenis");
    ?>
<?php elseif ($ac == 'importsoal') : ?>
    <?php include "import_soal.php"; ?>
<?php endif; ?>
<script>
    $(function() {
        $("#btnhapusbank").click(function() {
            i = 0;
            id_array = new Array();
            $("input.cekpilih:checked").each(function() {
                id_array[i] = $(this).val();
                i++;
            });
            swal({
                title: 'Kisi-kisi Soal Terpilih ' + i,
                text: 'Apakah kamu yakin akan menghapus data kisi-kisi soal yang sudah dipilih  ini ??',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Hapus!'
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: 'mod_kisi/crud_banksoal.php?pg=hapus',
                        data: "kode=" + id_array,
                        type: "POST",
                        success: function(respon) {
                            console.log(respon);
                            if (respon == 1) {
                                $("input.cekpilih:checked").each(function() {
                                    $(this).parent().parent().remove('.cekpilih').animate({
                                        opacity: "hide"
                                    }, "slow");
                                })
                            }
                        }
                    })
                }
            });
            return false;
        })
    });
    $("#btnkosongsoal").click(function() {
        var id = $(this).data('id');
        swal({
            title: 'Konfirmasi ',
            text: 'Apakah kamu yakin akan menghapus semua soal ??',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Hapus!'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: 'mod_kisi/crud_banksoal.php?pg=kosongsoal',
                    data: "id=" + id,
                    type: "POST",
                    success: function(respon) {
                        toastr.success('soal berhasil dihapus');
                        setTimeout(function() {
                            location.reload();
                        }, 2000);
                    }
                })
            }
        });
        return false;
    })
    $('#formsoal').submit(function(e) {
        e.preventDefault();
        var data = new FormData(this);
        $.ajax({
            type: 'POST',
            url: 'mod_kisi/crud_banksoal.php?pg=simpan_soal',
            enctype: 'multipart/form-data',
            data: data,
            cache: false,
            contentType: false,
            processData: false,
            beforeSend: function() {},
            success: function(data) {
                toastr.success('soal berhasil disimpan');
            }
        })
        return false;
    });
    $('#formtambahbank').submit(function(e) {
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: 'mod_kisi/crud_banksoal.php?pg=tambah',
            data: $(this).serialize(),
            success: function(data) {
                console.log(data);
                if (data == "OK") {
                    toastr.success("bank soal berhasil dibuat");
                } else {
                    toastr.error(data);
                }
                $('#tambahbanksoal').modal('hide');
                setTimeout(function() {
                    location.reload();
                }, 2000);

            }
        });
        return false;
    });
    $("#soallevel").change(function() {
        var level = $(this).val();
        console.log(level);
        $.ajax({
            type: "POST", // Method pengiriman data bisa dengan GET atau POST
            url: "mod_kisi/crud_banksoal.php?pg=ambil_kelas", // Isi dengan url/path file php yang dituju
            data: "level=" + level, // data yang akan dikirim ke file yang dituju
            success: function(response) { // Ketika proses pengiriman berhasil
                $("#soalkelas").html(response);
            }
        });
    });
</script>
<script>
    tinymce.init({
        selector: '.editor1',
        plugins: [
            'advlist autolink lists link image charmap print preview hr anchor pagebreak',
            'searchreplace wordcount visualblocks visualchars code fullscreen',
            'insertdatetime media nonbreaking save table contextmenu directionality',
            'emoticons template paste textcolor colorpicker textpattern imagetools uploadimage paste formula'
        ],

        toolbar: 'bold italic fontselect fontsizeselect | alignleft aligncenter alignright bullist numlist  backcolor forecolor | formula code | imagetools link image paste ',
        fontsize_formats: '8pt 10pt 12pt 14pt 18pt 24pt 36pt',
        paste_data_images: true,

        images_upload_handler: function(blobInfo, success, failure) {
            success('data:' + blobInfo.blob().type + ';base64,' + blobInfo.base64());
        },
        image_class_list: [{
            title: 'Responsive',
            value: 'img-responsive'
        }],
        setup: function(editor) {
            editor.on('change', function() {
                tinymce.triggerSave();
            });
        }
    });
</script>