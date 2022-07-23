<?php defined('APLIKASI') or exit('Anda tidak dizinkan mengakses langsung script ini!'); ?>
<?php if ($ac == '') { ?>
    <div class='row'>
        <div class='col-md-12'>
            <div class='box box-solid'>
                <div class='box-header with-border '>
                    <h3 class='box-title'> Daftar materi</h3>
                    <div class='box-tools pull-right '>

                    </div>
                </div><!-- /.box-header -->
                <div class='box-body'>
                    <!-- Button trigger modal -->
                    <div class="form-group">
                       
                    </div>
                    <!-- Modal -->
                    <div class="modal fade" id="modalmateri" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                        
						<div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header bg-blue">
								
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
								
                                <form id="formmateri">
                                    <div class="modal-body">

                                        <input type="hidden" class="form-control" name="id_mapel" value="<?= $id_mapel ?>">
                                        <div class="form-group">

                                            <select name='mapel' class='form-control' style='width:100%' required>
                                                <option value=''>Pilih Mata Pelajaran</option>
                                                <?php $que = mysqli_query($koneksi, "SELECT * FROM jadwal_mapel WHERE guru='$_SESSION[id_pengawas]' GROUP BY kode"); ?>
                                                <?php while ($mapel = mysqli_fetch_array($que)) : ?>

                                                    <option value="<?= $mapel['kode'] ?>"><?= $mapel['mapel'] ?></option>"

                                                <?php endwhile ?>
                                            </select>
                                        </div>
                                        <div class="form-group">

                                            <input type="text" class="form-control" name="judul" aria-describedby="helpId" placeholder="Judul materi" required>

                                        </div>
										<div class="form-group">
                        <label>Jenis Kompetensi</label>
						<select id="kategori" name="kategori" onchange="tampilkan()" class="form-control" style="width: 100%" required>
                          <option value="">--Pilih Kompetensi--</option>
						 <option value="KI3">Pengetahuan</option>
                        <option value="KI4">Keterampilan</option>
                              </select>
                       <br/>
                        <label>Pilih KD</label> 
						<select id="tampil" name="tampil" class="form-control" style="width: 100%">
                           </select>
						 </div>
										<div class="form-group">
                                            <select name='quiz' class='form-control' style='width:100%' required>
                                                <option value=''>Quiz</option>
												 <option value="Ya">Ya</option>
                                                 <option value="Tidak">Tidak</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <textarea name='isimateri' class='editor1' rows='10' cols='80' style='width:100%;'></textarea>
                                        </div>
                                        <div class='form-group'>
                                            <div class='row'>
                                                <div class='col-md-4'>
                                                    <label>Pilih Kelas</label><br>
                                                    <select name='kelas[]' class='form-control select2' style='width:100%' multiple required='true'>
                                                        <option value=''></option>
                                                        <?php $lev = mysqli_query($koneksi, "SELECT * FROM jadwal_mapel WHERE guru='$_SESSION[id_pengawas]' GROUP BY kelas"); ?>
                                                        <?php while ($kelas = mysqli_fetch_array($lev)) : ?>

                                                            <option value="<?= $kelas['kelas'] ?>"><?= $kelas['kelas'] ?></option>

                                                        <?php endwhile ?>
                                                    </select>
                                                </div>
                                                <div class='col-md-4'>
                                                    <label>Tanggal Publish</label>
                                                    <input type='text' name='tgl_mulai' class='tgl form-control' autocomplete='off' required='true' />
                                                </div>
                                                <div class='col-md-4'>
                                                    <label>Link Youtube</label>
                                                    <input type='text' name='youtube' class='form-control' autocomplete='off' />
                                                </div>
												<div class='col-md-12'>
												<br>
                                                 <label>Cara memasukan Link Youtube  Contoh Link : <b>https://youtu.be/42cqGZY9VTc</b> maka yang dimasukan adalah :<b>42cqGZY9VTc</b></label>
                                            </div>
                                        </div>
										</div>
                                        <div class="form-group">
                                            <label for="file">File Pendukung</label>
                                            <input type="file" class="form-control-file" name="file" placeholder="" aria-describedby="fileHelpId">
                                            <small id="fileHelpId" class="form-text text-muted">format file (doc/docx/xls/xlsx/pdf)</small>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Save</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
					
                    <div id='tablemateri' class='table-responsive'>
                        <table id="example1" class='table table-bordered table-striped  table-hover'>
                            <thead>
                                <tr>
                                    <th width='5px'>#</th>
                                    <th>Mata Pelajaran</th>
                                    <th>KD</th>
                                    <th>Judul materi</th>
                                    <th>Tgl Publish</th>
                                    <th>Kelas</th>
                                    <th>File</th>
                                    <th style="text-align:center">Quiz</th>
									<th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if ($pengawas['level'] == 'guru') {
                                    $materiQ = mysqli_query($koneksi, "SELECT * FROM materi where id_guru='$_SESSION[id_pengawas]'");
                                } else {
                                    $materiQ = mysqli_query($koneksi, "SELECT * FROM materi ");
                                }
                                ?>
                                <?php while ($materi = mysqli_fetch_array($materiQ)) : ?>
                                    <?php
                                    $guru = mysqli_fetch_array(mysqli_query($koneksi, "select * from pengawas where id_pengawas='$materi[id_guru]'"));
                                    $no++
                                    ?>
                                    <tr>
                                        <td><?= $no ?></td>
                                        <td>
                                            <?= $materi['mapel'] ?>
                                        </td>
                                        <td>
                                            <?= $materi['kd'] ?>
                                        </td>
                                        <td>
                                            <?= $materi['judul'] ?>
                                        </td>

                                        <td style="text-align:center">
                                            <?= $materi['tgl_mulai'] ?>
                                        </td>
                                        <td style="text-align:center">
                                            <?php $kelas = unserialize($materi['kelas']);
                                            foreach ($kelas as $kelas) {
                                                echo $kelas . " ";
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <?php if ($materi['file'] <> null) { ?>
                                                <a href="../berkas/<?= $materi['file'] ?>" target="_blank">Lihat</a>
                                            <?php } ?>
                                        </td>
										<td style="text-align:center">
										<?php if($materi['quiz']=='Ya'){ ?>
										<a href="?pg=quizbank&id=<?= $materi[id_materi] ?>" class='btn btn-sm btn-warning' title="Soal" disabled><i class='fas fa-plus'></i></a>
										<?php }else{ ?>
                                            <label class='btn btn-sm btn-danger'><?= $materi['quiz'] ?></label>
										<?php } ?>
                                        </td>
                                        <td style="text-align:center">
                                            <div class=''>
											<a href='?pg=materiadmin&ac=absen&id=<?= $materi['id_materi'] ?>' class='btn btn-sm btn-warning ' title="Absen"><i class='fas fa-user'></i></a>
											<a href='?pg=materiadmin&ac=nilai&id=<?= $materi['id_materi'] ?>' class='btn btn-sm btn-info ' title="Nilai"><i class='fas fa-book'></i></a>
                                                <a href='?pg=materiadmin&ac=lihat&id=<?= $materi['id_materi'] ?>' class='btn btn-sm btn-success ' title="Komen"><i class='fas fa-comment'></i></a>
                                                
                                            </div>
                                        </td>
                                    </tr>
                                    <!-- Modal -->
                                    <div class="modal fade" id="modaledit<?= $materi['id_materi'] ?>" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                                        <div class="modal-dialog modal-lg" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">

                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form id="formeditmateri<?= $materi['id_materi'] ?>">
                                                    <div class="modal-body">
                                                        <input type="hidden" value="<?= $materi['id_materi'] ?>" name='id'>
                                                        <div class="form-group">
														<label>Mata Pelajaran</label><br>
                                                            <select name='mapel' class='form-control' style='width:100%' required>
                                                                <option value='<?= $materi['mapel'] ?>' selected><?= $materi['mapel'] ?></option>
                                                                 <?php $que = mysqli_query($koneksi, "SELECT * FROM jadwal_mapel WHERE guru='$_SESSION[id_pengawas]' GROUP BY kode"); ?>
                                                                <?php while ($mapel = mysqli_fetch_array($que)) : ?>

                                                                    <option value="<?= $mapel['kode'] ?>"><?= $mapel['mapel'] ?></option>"

                                                                <?php endwhile ?>
                                                            </select>
                                                        </div>
														
                                                        <div class="form-group">
                                                         <label>Judul Materi</label><br>
                                                            <input type="text" class="form-control" name="judul" aria-describedby="helpId" placeholder="Judul materi" value="<?= $materi['judul'] ?>" required>

                                                        </div>
														
														<div class="form-group">
														<label>Quiz</label><br>
                                            <select name='quiz' class='form-control' style='width:100%' required>
											 <option value='<?= $materi['quiz'] ?>' selected><?= $materi['quiz'] ?></option>
                                                <option value=''>Quiz</option>
												 <option value="Ya">Ya</option>
                                                 <option value="Tidak">Tidak</option>
                                            </select>
                                        </div>
                                                        <div class="form-group">
                                                            <textarea name='isimateri' class='editor1' rows='10' cols='80' style='width:100%;'><?= $materi['materi'] ?></textarea>
                                                        </div>
                                                        <div class='form-group'>
                                                            <div class='row'>
                                                                <div class='col-md-4'>
                                                                    <label>Pilih Kelas</label><br>
                                                                    <select name='kelas[]' class='form-control select2' style='width:100%' multiple required='true'>
                                                                        <option value=''></option>
                                                                       <?php $lev = mysqli_query($koneksi, "SELECT * FROM jadwal_mapel WHERE guru='$_SESSION[id_pengawas]' GROUP BY kelas"); ?>
                                                                        <?php while ($kelas = mysqli_fetch_array($lev)) : ?>
                                                                            <?php if (in_array($kelas['kelas'], unserialize($materi['kelas']))) : ?>
                                                                                <option value="<?= $kelas['kelas'] ?>" selected><?= $kelas['kelas'] ?></option>
                                                                            <?php else : ?>
                                                                                <option value="<?= $kelas['kelas'] ?>"><?= $kelas['kelas'] ?></option>
                                                                            <?php endif; ?>
                                                                        <?php endwhile ?>
                                                                    </select>
                                                                </div>
                                                                <div class='col-md-4'>
                                                                    <label>Tanggal Publish</label>
                                                                    <input type='text' name='tgl_mulai' class='tgl form-control' autocomplete='off' required='true' value="<?= $materi['tgl_mulai'] ?>" />
                                                                </div>
                                                                <div class='col-md-4'>
                                                                    <label>Video Youtube</label>
                                                                    <input type='text' name='youtube' class='form-control' autocomplete='off'  value="<?= $materi['youtube'] ?>" />
                                                                </div>

                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="file">File Pendukung</label>
                                                            <input type="file" class="form-control-file" name="file" id="file" placeholder="" aria-describedby="fileHelpId">
                                                            <small id="fileHelpId" class="form-text text-muted">format file (doc/docx/xls/xlsx/pdf)</small>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Save</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <script>
                                        $('#formeditmateri<?= $materi['id_materi'] ?>').submit(function(e) {
                                            e.preventDefault();
                                            var data = new FormData(this);
                                            $.ajax({
                                                type: 'POST',
                                                url: 'mod_elearn/materi/edit_materi.php',
                                                enctype: 'multipart/form-data',
                                                data: data,
                                                cache: false,
                                                contentType: false,
                                                processData: false,
                                                success: function(data) {
                                                    //toastr.error(data);
                                                    if (data == "ok") {
                                                        toastr.success("materi berhasil dirubah");
                                                    } else {
                                                        toastr.error(data);
                                                    }
                                                    $('#modaledit<?= $materi['id_materi'] ?>').modal('hide');
                                                    setTimeout(function() {
                                                        location.reload();
                                                    }, 2000);

                                                }
                                            });
                                            return false;
                                        });
                                    </script>
                                <?php endwhile ?>
                            </tbody>
                        </table>
                    </div>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>
    </div>
	
<?php } elseif ($ac == 'lihat') { ?>
    <?php $id = $_GET['id']; ?>
    <div class='row'>
        <div class='col-md-12'>
            <div class='box box-solid'>
                <div class='box-header with-border '>
                    <h3 class='box-title'> Daftar Komentar Siswa</h3>
						  <div class='box-tools pull-right '>
                        <a href="?pg=materiadmin" class="btn btn-primary mb-5" >
                            <i class="fas fa-angle-double-left fa-fw"></i> Kembali
                        </button></a>
                    </div>
                </div>
              
                      <div id='tablekomentar' class='table-responsive'>
                        <table id="tabelkomen" class='table table-bordered table-striped  table-hover'>
                            <thead>
                                <tr>
                                    <th width='5px'>#</th>
                                    <th width="10%">Mata Pelajaran</th>
                                    <th>Judul materi</th>
                                    <th width="15%">Tgl Publish</th>
                                    <th>Nama Siswa</th>
                                    <th>Komentar</th>
									 <th width="15%">Dikirim</th>

                                </tr>
                            </thead>
                            <tbody>
							       <?php     
								$no=0;
                              $materiQ = mysqli_query($koneksi, "SELECT * FROM komentar");
                            while ($komentar = mysqli_fetch_array($materiQ)){
								$siswa=fetch($koneksi,'siswa',['id_siswa' => $komentar['id_user']]);
								$materi=fetch($koneksi,'materi',['id_materi' => $komentar['id_materi']]);
                              $no++;
                                ?>
								<tr>
                                        <td><?= $no ?></td>
                                        <td><?= $materi['mapel'] ?> </td>
                                            <td><?= $materi['judul'] ?> </td>
                                       <td><?= $materi['tgl'] ?> </td>
									   <td><?= $siswa['nama'] ?> </td>
									   <td><?= $komentar['komentar'] ?> </td>
									   <td><?= $komentar['tgl'] ?> </td>
									   
								</tr>
							<?php } ?>
					</tbody>
                        </table>		
                </div>
            </div>
        </div>
    </div>



<?php } elseif ($ac == 'nilai') { ?>
    <?php $id = $_GET['id']; ?>
    <div class='row'>
        <div class='col-md-12'>
            <div class='box box-solid'>
                <div class='box-header with-border '>
                    <h3 class='box-title'> Daftar Nilai Quiz</h3>
					<div class='box-tools pull-right '>
                        <a href="?pg=materiadmin" class="btn btn-primary mb-5" >
                            <i class="fas fa-angle-double-left fa-fw"></i> Kembali
                        </button></a>
						
                    </div>
                </div><!-- /.box-header -->
              
                      <div id='tabelnile' class='table-responsive'>
                        <table id="tabelnila" class='table table-bordered table-striped  table-hover'>
                            <thead>
                                <tr>
                                    <th width='5px'>#</th>
                                    <th width="10%">Mata Pelajaran</th>
                                    <th>Judul materi</th>
                                    <th width="15%">Tgl Publish</th>
                                    <th>Nama Siswa</th>
                                    <th width="5%">Nilai</th>
									 <th width="10%">Dikerjakan</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
							       <?php     
								$no=0;
                              $nilaiQ = mysqli_query($koneksi, "SELECT * FROM nilaiquiz WHERE idmateri='$_GET[id]'");
                            while ($nilai = mysqli_fetch_array($nilaiQ)){
								$siswa=fetch($koneksi,'siswa',['id_siswa' => $nilai['idsiswa']]);
								$materi=fetch($koneksi,'materi',['id_materi' => $nilai['idmateri']]);
                              $no++;
                                ?>
								<tr>
                                        <td><?= $no ?></td>
                                        <td><?= $materi['mapel'] ?> </td>
                                            <td><?= $materi['judul'] ?> </td>
                                       <td><?= $materi['tgl'] ?> </td>
									   <td><?= $siswa['nama'] ?> </td>
									   <td><?= $nilai['nilai'] ?> </td>
									   <td><?= $nilai['tgl'] ?> </td>
									   
								</tr>
							<?php } ?>
					</tbody>
                        </table>		
                </div>
            </div>
        </div>
    </div>
	
	<?php } elseif ($ac == 'absen') { ?>
    <?php $id = $_GET['id']; ?>
    <div class='row'>
        <div class='col-md-12'>
            <div class='box box-solid'>
                <div class='box-header with-border '>
                    <h3 class='box-title'> Daftar Download/Menonton Video Materi</h3>
					<div class='box-tools pull-right '>
                        <a href="?pg=materiadmin" class="btn btn-primary mb-5" >
                            <i class="fas fa-angle-double-left fa-fw"></i> Kembali
                        </button></a>
					 
                    </div>
                </div><!-- /.box-header -->
              
                      <div id='tablekomentar' class='table-responsive'>
                        <table id="tabelnilai" class='table table-bordered table-striped  table-hover'>
                            <thead>
                                <tr>
                                    <th width='5px'>#</th>
                                    <th width="10%">Mata Pelajaran</th>
                                    <th>Judul materi</th>
                                    <th width="15%">Tgl Publish</th>
                                    <th>Nama Siswa</th>
                                    <th width="5%">Absen</th>
									 <th width="15%">Tgl Absen</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
							       <?php     
								$no=0;
                              $nilaiQ = mysqli_query($koneksi, "SELECT * FROM absen_daringmapel WHERE idmateri='$_GET[id]'");
                            while ($nilai = mysqli_fetch_array($nilaiQ)){
								$siswa=fetch($koneksi,'siswa',['id_siswa' => $nilai['idsiswa']]);
								$materi=fetch($koneksi,'materi',['id_materi' => $nilai['idmateri']]);
                              $no++;
                                ?>
								<tr>
                                        <td><?= $no ?></td>
                                        <td><?= $materi['mapel'] ?> </td>
                                            <td><?= $materi['judul'] ?> </td>
                                       <td><?= $materi['tgl'] ?> </td>
									   <td><?= $siswa['nama'] ?> </td>
									   <td><?= $nilai['ket'] ?> </td>
									   <td><?= $nilai['tanggal'] ?> <?= $nilai['jam'] ?></td>
									  
								</tr>
							<?php } ?>
					</tbody>
                        </table>		
                </div>
            </div>
        </div>
    </div>

<?php } ?>
<script>
function tampilkan(){
  var nama_kota=document.getElementById("formmateri").kategori.value;
  if (nama_kota=="KI3")
    {
        document.getElementById("tampil").innerHTML=
		"<option value='3.1'>3.1</option><option value='3.2'>3.2</option><option value='3.3'>3.3</option><option value='3.4'>3.4</option><option value='3.5'>3.5</option><option value='3.6'>3.6</option><option value='3.7'>3.7</option><option value='3.8'>3.8</option><option value='3.9'>3.9</option><option value='3.10'>3.10</option><option value='3.11'>3.11</option><option value='3.12'>3.12</option>";
    }
  else if (nama_kota=="KI4")
    {
        document.getElementById("tampil").innerHTML="<option value='4.1'>4.1</option><option value='4.2'>4.2</option><option value='4.3'>4.3</option><option value='4.4'>4.4</option><option value='4.5'>4.5</option><option value='4.6'>4.6</option><option value='4.7'>4.7</option><option value='4.8'>4.8</option><option value='4.9'>4.9</option><option value='4.10'>4.10</option><option value='4.11'>4.11</option><option value='4.12'>4.12</option>";
    }
}
</script>
<script>
    $('#formmateri').submit(function(e) {
        e.preventDefault();
        var data = new FormData(this);
        //console.log(data);
        $.ajax({
            type: 'POST',
            url: 'mod_elearn/materi/buat_materi.php',
            enctype: 'multipart/form-data',
            data: data,
            cache: false,
            contentType: false,
            processData: false,
            success: function(data) {
                $('#modalmateri').modal('hide');
                if (data = 'ok') {
                    toastr.success(data);
                    setTimeout(function() {
                        window.location.reload();
                    }, 2000);
                } else {
                    toastr.error(data);
                }
                //toastr.error(data);


            }
        });
        return false;
    });
    $('#tablemateri').on('click', '.hapus', function() {
        var id = $(this).data('id');
        console.log(id);
        swal({
            title: 'Apa anda yakin?',
            text: "akan menghapus materi ini!",

            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes!'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: 'mod_elearn/materi/hapus_materi.php',
                    method: "POST",
                    data: 'id=' + id,
                    success: function(data) {
                        toastr.success('materi berhasil dihapus');
                        setTimeout(function() {
                            window.location.reload();
                        }, 2000);
                    }
                });
            }
        })

    });
	 $('#tabelkomen').on('click', '.hapus', function() {
        var id = $(this).data('id');
        console.log(id);
        swal({
            title: 'Apa anda yakin?',
            text: "akan menghapus materi ini!",

            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes!'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: 'mod_elearn/materi/hapus_komen.php',
                    method: "POST",
                    data: 'id=' + id,
                    success: function(data) {
                        toastr.success('komentar berhasil dihapus');
                        setTimeout(function() {
                            window.location.reload();
                        }, 2000);
                    }
                });
            }
        })

    });
	 $('#tabelnila').on('click', '.hapus', function() {
        var id = $(this).data('id');
        console.log(id);
        swal({
            title: 'Apa anda yakin?',
            text: "akan menghapus materi ini!",

            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes!'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: 'mod_elearn/materi/hapus_nilaiquiz.php',
                    method: "POST",
                    data: 'id=' + id,
                    success: function(data) {
                        toastr.success('materi berhasil dihapus');
                        setTimeout(function() {
                            window.location.reload();
                        }, 2000);
                    }
                });
            }
        })

    });
    $('#tablejawaban').on('click', '.hapus', function() {
        var id = $(this).data('id');
        console.log(id);
        swal({
            title: 'Apa anda yakin?',
            text: "akan menghapus nilai ini!",

            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes!'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: 'mod_elearn/materi/hapus_nilai.php',
                    method: "POST",
                    data: 'id=' + id,
                    success: function(data) {
                        toastr.success('materi berhasil dihapus');
                        setTimeout(function() {
                            window.location.reload();
                        }, 2000);
                    }
                });
            }
        })

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
