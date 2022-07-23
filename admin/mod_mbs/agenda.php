<?php $rapor = fetch($koneksi, 'setting_rapor', ['id' => 1]); ?>
 <div class="modal fade" id="tambahdata" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form id="form-tambah">
                <div class="modal-header bg-blue">
                    <h5 class="modal-title"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                         <input type="hidden" name="guru" value="<?= $_SESSION['id_pengawas'] ?>" class="form-control" required>
                  
				 <div class='modal-body'>
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                   <label>Mapel</label>
                                         <select name='mapel' class='form-control' style='width:100%' required>
                                                <option value=''>Pilih Mata Pelajaran</option>
                                                <?php $que = mysqli_query($koneksi, "SELECT * FROM jadwal_mapel WHERE guru='$_SESSION[id_pengawas]' GROUP BY kode"); ?>
                                                <?php while ($mapel = mysqli_fetch_array($que)) : ?>

                                                    <option value="<?= $mapel['kode'] ?>"><?= $mapel['mapel'] ?></option>"

                                                <?php endwhile ?>
                                            </select>
										</div>
										</div>
						
													<div class="col-md-4">
													<div class='form-group'>
												
													<label>Pilih Kelas</label>
                                                    <select name='kelas' class='form-control ' style='width:100%' required>
                                                        <option value=''>Pilih Kelas</option>
                                                        <?php $lev = mysqli_query($koneksi, "SELECT * FROM jadwal_mapel WHERE guru='$_SESSION[id_pengawas]' GROUP BY kelas"); ?>
                                                        <?php while ($kelas = mysqli_fetch_array($lev)) : ?>

                                                            <option value="<?= $kelas['kelas'] ?>"><?= $kelas['kelas'] ?></option>

                                                        <?php endwhile ?>
                                                    </select>
														</div>
															</div>
					
					<div class="col-md-4">
                       <div class='form-group'>
                        <label>Tanggal</label>
                        <input type="text" class="form-control datepicker" name="tgl" id="tgl" autocomplete="off" required>
                    </div>
					</div>
					
					 <div class="col-md-4">
                       <div class='form-group'>
                        <label>No KI/KD</label>
                        <input type="text" name="kd"  class="form-control" autocomplete='off' required>
                    </div>
					</div>
					 <div class="col-md-4">
                       <div class='form-group'>
                        <label>Pertemuan Ke</label>
                        <input type="number" name="ke" class="form-control" autocomplete='off' required>
                    </div>
					</div>
					<div class="col-md-12">
                       <div class='form-group'>
                        <label>Materi</label>
                        <textarea id='editor2' name='materi' class='form-control' rows='2' cols='80' style='width:100%;' required></textarea>
                    </div>
					</div>
					<div class="col-md-12">
                       <div class='form-group'>
                        <label>Indikator</label>
                         <textarea id='editor2' name='indikator' class='form-control' rows='2' cols='80' style='width:100%;' required></textarea>
                    </div>
					</div>
					</div>
						</div>
                    <div class='modal-footer'>
                       <div class='box-tools pull-right btn-group'>
                          <button type='submit' name='submit' class='btn btn-sm btn-primary'><i class='fa fa-check'></i> Simpan</button>
                              <button type='button' class='btn btn-default btn-sm pull-left' data-dismiss='modal'>Close</button>
                                </div>
                                 </div>
								</form>
									</div>
										</div>
											</div>


 <div class='row'>
        <div class='col-md-12'>
            <div class='box box-solid'>
                <div class='box-header with-border '>
                    <h3 class='box-title'><i class="fas fa-edit fa-fw   "></i> AGENDA</h3>
                    <div class='box-tools pull-right'>
				   <button type="button" class="btn btn-icon icon-left btn-danger" data-toggle="modal" data-target="#cetakdata">
        <i class="fa fa-print"></i> Cetak
    </button>
				
                   <button type="button" class="btn btn-icon icon-left btn-primary" data-toggle="modal" data-target="#tambahdata">
        <i class="fa fa-plus"></i> Agenda
    </button>
		  </div>
         </div>
           
            <div class="card-body">
                <div class="table-responsive">
                    <table style="font-size: 12px" class="table table-striped table-sm" id="table-1">
                        <thead>
                            <tr>
                                <th class="text-center">
                                    #
                                </th>
                                <th>Mapel</th>
								<th>Kelas</th>
                                <th>Hari, Tanggal</th>
                                <th> Ke</th>
								 <th> No. KD</th>
								 <th> Materi</th>
                                <th>Indikator</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $query = mysqli_query($koneksi, "select * from agenda 
							JOIN m_hari ON m_hari.inggris=agenda.harix WHERE guru='$_SESSION[id_pengawas]' ORDER BY agenda.id DESC");
                            $no = 0;
                            while ($agenda = mysqli_fetch_array($query)) {
								$tanggal=date('d-m-Y',strtotime($agenda['tanggal']));
                                $no++;
                              
                            ?>
                                <tr>
                                    <td><?= $no; ?></td>
                                    <td><?= $agenda['mapel'] ?></td>
									 <td><?= $agenda['kelas'] ?></td>
                                    <td><?= $agenda['hari'] ?>, <?= $tanggal ?></td>
                                    <td><?= $agenda['ke'] ?></td>
                                    <td><?= $agenda['kikd'] ?></td>
									<td><?= $agenda['materi'] ?></td>
									<td><?= $agenda['indikator'] ?></td>
                                    <td>
                                       
                                        <button data-id="<?= $agenda['id'] ?>" class="hapus btn-sm btn btn-danger"><i class="fas fa-trash    "></i></button>
                                        </td>
										</tr>
                            <?php }
                            ?>


                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
 <div class="modal fade" id="cetakdata" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
			 <div class="modal-header bg-blue">
                    <h5 class="modal-title"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form name="form-cetak" method="POST" action="?pg=mcetakagenda" >
                   <input type="hidden" name="guru" value='<?= $_SESSION['id_pengawas'] ?>' class="form-control" required>
                  
				 <div class='modal-body'>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                   <label>Mapel</label>
                                     <select name='mapel' class='form-control' style='width:100%' required>
                                                <option value=''>Pilih Mata Pelajaran</option>
                                                <?php $que = mysqli_query($koneksi, "SELECT * FROM jadwal_mapel WHERE guru='$_SESSION[id_pengawas]' GROUP BY kode"); ?>
                                                <?php while ($mapel = mysqli_fetch_array($que)) : ?>

                                                    <option value="<?= $mapel['id_jadwal'] ?>"><?= $mapel['mapel'] ?></option>

                                                <?php endwhile ?>
                                            </select>
											</div>
												</div>
						
                    <div class="col-md-6">
                       <div class='form-group'>
                        <label>Kelas</label>
                          <select name='kelas' class='form-control ' style='width:100%' required>
                               <option value=''>Pilih Kelas</option>
                                  <?php $lev = mysqli_query($koneksi, "SELECT * FROM jadwal_mapel WHERE guru='$_SESSION[id_pengawas]' GROUP BY kelas"); ?>
                                       <?php while ($kelas = mysqli_fetch_array($lev)) : ?>
                                          <option value="<?= $kelas['kelas'] ?>"><?= $kelas['kelas'] ?></option>
                                                        <?php endwhile ?>
                                                    </select>
														</div>
															</div>
					
					 <div class="col-md-6">
                       <div class='form-group'>
                        <label>Semester</label>
                        <input type="text" name="smt" value="<?= $rapor['semester'] ?>" class="form-control" autocomplete='off' disabled>
                    </div>
					</div>
					 <div class="col-md-6">
                       <div class='form-group'>
                        <label>Tahun Pelajaran</label>
                       <input type="text" name="tp" value="<?= $rapor['tp'] ?>" class="form-control" autocomplete='off' disabled>
                   
					</div>
						</div>
                    </div>
						</div>
               <div class='modal-footer'>
               <div class='box-tools pull-right btn-group'>
                 <button type='submit' name='submit' class='btn btn-sm btn-primary'><i class='fa fa-search'></i> Cari</button>
                   <button type='button' class='btn btn-default btn-sm pull-left' data-dismiss='modal'>Close</button>
                       </div>
                 </div>
            </form>
        </div>
    </div>
</div>


<script>
   $('#form-tambah').submit(function(e) {
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: 'mod_mbs/crud_agenda.php?pg=tambah',
            data: $(this).serialize(),
            success: function(data) {

                iziToast.success({
                    title: 'Mantap!',
                    message: 'Data Berhasil ditambahkan',
                    position: 'topRight'
                });
                setTimeout(function() {
                    window.location.reload();
                }, 2000);
                $('#tambahdata').modal('hide');
                //$('#bodyreset').load(location.href + ' #bodyreset');
            }
        });
        return false;
    });

    $('#table-1').on('click', '.hapus', function() {
        var id = $(this).data('id');
        console.log(id);
        swal({
            title: 'Are you sure?',
            text: 'Akan menghapus data ini!',
            icon: 'warning',
            buttons: true,
            dangerMode: true,
        }).then((result) => {
            if (result) {
                $.ajax({
                    url: 'mod_mbs/crud_agenda.php?pg=hapus',
                    method: "POST",
                    data: 'id=' + id,
                    success: function(data) {
                        iziToast.error({
                            title: 'Horee!',
                            message: 'Data Berhasil dihapus',
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
<script>
$(function(){
    $("#datepicker").datepicker({
        dateFormat: "D,Y-m-d"
    });
});
</script>