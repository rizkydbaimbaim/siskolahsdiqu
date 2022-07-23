<?php
defined('APLIKASI') or exit('Anda tidak dizinkan mengakses langsung script ini!');
?>
    <div class='row'>
        <div class='col-md-12'>
            <div class='box box-solid'>
                <div class='box-header with-border '>
                    <h3 class='box-title'><i class="fas fa-user fa-fw   "></i>Jadwal Mapel Kelas</h3>
                    <div class='box-tools pull-right'>
				 <a data-toggle='modal' data-backdrop="static" data-target='#tambahwalas' class='btn btn-sm btn-primary'><i class='glyphicon glyphicon-plus'></i> <span class='hidden-xs'>Tambah</span></a>
                    </div>
                </div><!-- /.box-header -->
                <div class='box-body'>
                    <div class='table-responsive'>
                        <table style="font-size: 11px" id='tabelmapel' class='table table-bordered table-striped'>
                            <thead>
                                <tr>
                                    <th width='3px'>No</th>
									  <th width='5%'>Kelas</th>
                                    <th>Nama Mapel</th>  
                                     <th>Guru Mapel</th> 	
									 <th width='5%'>Hari</th>
                                     <th width='5%'>Jam Ke</th>
                                      <th width='5%'>Mulai Jam</th>
                                        <th width='5%'>Sampai Jam</th>									  
									<th width='10%'>Action</th>
                                </tr>
                            </thead>
							  </thead>
							
							<tbody>
							
                                <?php
								$no = 0;
								 $query = mysqli_query($koneksi, "select * from jadwal_mapel
								 JOIN pengawas ON pengawas.id_pengawas=jadwal_mapel.guru");
                            while ($mapel = mysqli_fetch_array($query)) {
								$hari=fetch($koneksi,'m_hari',['inggris' =>$mapel['hari']]);
                                $no++;
                            ?>
							 <tr>
                                    <td><?= $no; ?></td>
									 <td><?= $mapel['kelas'] ?></td>
							        <td><?= $mapel['mapel'] ?></td>
									<td><?= $mapel['nama'] ?></td>
									<td><?= $hari['hari'] ?></td>
									<td><?= $mapel['ke'] ?></td>
									<td><?= $mapel['dari'] ?></td>
									<td><?= $mapel['sampai'] ?></td>
                                   <td>
                                       <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modaledit<?= $no ?>">
                                                    <i class="fas fa-edit    "></i>
                                                </button>
										 <button data-id="<?= $mapel['id_jadwal'] ?>" class="hapus btn-sm btn btn-danger"><i class="fas fa-trash    "></i></button>
                                   
								   <div class="modal fade" id="modaledit<?= $no ?>" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                                        <div class="modal-dialog modal-md" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header bg-blue">

                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form id="formedit<?= $no ?>">
												<input type="hidden" name="idj" value="<?= $mapel['id_jadwal'] ?>" >
                                       <div class='modal-body'>
									<div class="col-md-6">
                                        <div class='form-group'>
                                                   <label>Kelas</label>
                                                    <select name='kelas' class='form-control' required='true'>
                                                        <option value='<?= $mapel[kelas] ?>' ><?= $mapel['kelas'] ?></option>
                                                        <?php
                                                        $kelasQ = mysqli_query($koneksi, "SELECT * FROM siswa GROUP BY id_kelas");
                                                        while ($kelas = mysqli_fetch_array($kelasQ)) {
                                                            echo "<option value='$kelas[id_kelas]'>$kelas[id_kelas]</option>";
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
												</div>
												<div class="col-md-6">
                                          <div class='form-group'>
                                                   <label>Kode Mapel</label>
                                                    <select name='kode' class='form-control' required='true'>
                                                        <option value='<?= $mapel['kode'] ?>'><?= $mapel['kode'] ?></option>
                                                        <?php
                                                        $mapelQ = mysqli_query($koneksi, "SELECT * FROM mata_pelajaran");
                                                        while ($mapelx = mysqli_fetch_array($mapelQ)) {
                                                            echo "<option value='$mapelx[kode_mapel]'>$mapelx[kode_mapel]</option>";
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
												</div>
												<div class="col-md-12">
                                          <div class='form-group'>
                                                   <label>Nama Mapel</label>
                                                    <select name='mapel' class='form-control' required='true'>
                                                        <option value='<?= $mapel['mapel'] ?>'><?= $mapel['mapel'] ?></option>
                                                        <?php
                                                        $mapelX = mysqli_query($koneksi, "SELECT * FROM mata_pelajaran");
                                                        while ($mapelM = mysqli_fetch_array($mapelX)) {
                                                            echo "<option value='$mapelM[nama_mapel]'>$mapelM[nama_mapel]</option>";
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
												</div>
												
												
                                                         <div class="col-md-6">
                                                             <div class="form-group">
                                                            <label>Jam Ke</label>
															<select name='ke' class='form-control' style='width:100%' required>
                                                                <option value='<?= $mapel['ke'] ?>' ><?= $mapel['ke'] ?></option>
                                                                <option value='1' >1</option>
																<option value='2' >2</option>
																<option value='3' >3</option>
																<option value='4' >4</option>
																<option value='5' >5</option>
																<option value='6' >6</option>
																<option value='7' >7</option>
																<option value='8' >8</option>
																<option value='9' >9</option>
																<option value='10' >10</option>
																<option value='11' >11</option>
																<option value='12' >12</option>
																
                                                            </select>
                                                        </div>
														</div>
                                                       <div class="col-md-6">
                                                             <div class="form-group">
                                                        <label>Hari</label>
														<?php $poe=fetch($koneksi,'m_hari',['inggris'=>$mapel['hari']]); ?>
															<select name='hari' class='form-control' style='width:100%' required>
                                                                <option value="<?= $mapel[hari] ?>" ><?= $poe['hari'] ?></option>
                                                                <?php
														$queryh = mysqli_query($koneksi, "select * from m_hari");
														while ($hari = mysqli_fetch_array($queryh)) {
																					?>
															<option value="<?= $hari['inggris'] ?>"><?= $hari['hari'] ?></option>
														<?php } ?>
															</select>
                                                        </div>
                                                        </div>
														<div class="col-md-6">
                                                             <div class="form-group">
														  <label>Dari Jam</label>
														<input type="text"  name="dari" class="form-control" value="<?= $mapel['dari'] ?>" required>
														 </div>   
														</div> 
														
															<div class="col-md-6">
                                                             <div class="form-group">
														  <label>Sampai Jam</label>
														<input type="text"  name="sampai" class="form-control" value="<?= $mapel['sampai'] ?>" required>
														 </div>
                                                      </div>
													 
												<div class="col-md-12">
											   <div class='form-group'>
                                                   <label>Guru Mapel</label>
												  <?php $user=fetch($koneksi,'pengawas',['id_pengawas'=>$mapel['guru']]); ?>
                                                    <select name='guru' class='form-control' required='true'>
                                                        <option value="<?= $mapel[guru] ?>"><?= $user['nama'] ?></option>
                                                        <?php
                                                        $kelasQ = mysqli_query($koneksi, "SELECT * FROM pengawas WHERE level='guru'");
                                                        while ($ekstra = mysqli_fetch_array($kelasQ)) {
                                                            echo "<option value='$ekstra[id_pengawas]'>$ekstra[nama]</option>";
                                                        }
                                                        ?>
                                                    </select>
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
                        $("#formedit<?= $no ?>").submit(function(e) {
                            e.preventDefault();
                            $.ajax({
                                type: 'POST',
                                url: 'mod_mbs/mod_jadwal/crud_jadwal.php?pg=editjadwal',
                                data: $(this).serialize(),
                                success: function(data) {
                                    iziToast.success({
                                        title: 'Data berhail diubah!',
                                        message: data,
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
                               </td>			
							       </tr>
                            <?php } ?>
                        </tbody>
                        </table>
                    </div>
                    </div>
</div>
                      <div class='modal fade' id='tambahwalas' style='display: none;'>
                        <div class='modal-dialog'>
                            <div class='modal-content'>
                                <div class='modal-header bg-blue'>
                                    <button class='close' data-dismiss='modal'><span aria-hidden='true'><i class='glyphicon glyphicon-remove'></i></span></button>
                                    <h4 class='modal-title'></h4>
                                </div>
                                
                                     <form action='' method='post'>
									 <div class='modal-body'>
									 <div class='row'>
									<div class="col-md-6">
                                        <div class='form-group'>
                                                   <label>Kelas</label>
                                                    <select name='kelas' class='form-control' required='true'>
                                                        <option value=''></option>
                                                        <?php
                                                        $kelasQ = mysqli_query($koneksi, "SELECT * FROM siswa GROUP BY id_kelas");
                                                        while ($kelas = mysqli_fetch_array($kelasQ)) {
                                                            echo "<option value='$kelas[id_kelas]'>$kelas[id_kelas]</option>";
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
												</div>
												<div class="col-md-6">
                                          <div class='form-group'>
                                                   <label>Kode Mapel</label>
                                                    <select name='kode' class='form-control' required='true'>
                                                        <option value=''></option>
                                                        <?php
                                                        $mapelQ = mysqli_query($koneksi, "SELECT * FROM mata_pelajaran");
                                                        while ($mapel = mysqli_fetch_array($mapelQ)) {
                                                            echo "<option value='$mapel[kode_mapel]'>$mapel[kode_mapel]</option>";
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
												</div>
												<div class="col-md-12">
                                          <div class='form-group'>
                                                   <label>Nama Mapel</label>
                                                    <select name='mapel' class='form-control' required='true'>
                                                        <option value=''></option>
                                                        <?php
                                                        $mapelQ = mysqli_query($koneksi, "SELECT * FROM mata_pelajaran");
                                                        while ($mapel = mysqli_fetch_array($mapelQ)) {
                                                            echo "<option value='$mapel[nama_mapel]'>$mapel[nama_mapel]</option>";
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
												</div>
												
												
                                                         <div class="col-md-6">
                                                             <div class="form-group">
                                                            <label>Jam Ke</label>
															<select name='ke' class='form-control' style='width:100%' required>
                                                                <option value='' >--Pilih Jam Ke--</option>
                                                                <option value='1' >1</option>
																<option value='2' >2</option>
																<option value='3' >3</option>
																<option value='4' >4</option>
																<option value='5' >5</option>
																<option value='6' >6</option>
																<option value='7' >7</option>
																<option value='8' >8</option>
																<option value='9' >9</option>
																<option value='10' >10</option>
																<option value='11' >11</option>
																<option value='12' >12</option>
																
                                                            </select>
                                                        </div>
														</div>
                                                       <div class="col-md-6">
                                                             <div class="form-group">
                                                        <label>Hari</label>
															<select name='hari' class='form-control' style='width:100%' required>
                                                                <option value='' >--Pilih Hari--</option>
                                                                <?php
														$queryh = mysqli_query($koneksi, "select * from m_hari");
														while ($hari = mysqli_fetch_array($queryh)) {
																					?>
															<option value="<?= $hari['inggris'] ?>"><?= $hari['hari'] ?></option>
														<?php } ?>
															</select>
                                                        </div>
                                                        </div>
														<div class="col-md-6">
                                                             <div class="form-group">
														  <label>Dari Jam</label>
														<input type="text"  name="dari" class="form-control" required>
														 </div>   
														</div> 
														
															<div class="col-md-6">
                                                             <div class="form-group">
														  <label>Sampai Jam</label>
														<input type="text"  name="sampai" class="form-control" required>
														 </div>
                                                      </div>
													 
												<div class="col-md-12">
											   <div class='form-group'>
                                                   <label>Guru Mapel</label>
                                                    <select name='guru' class='form-control' required='true'>
                                                        <option value=''></option>
                                                        <?php
                                                        $kelasQ = mysqli_query($koneksi, "SELECT * FROM pengawas WHERE level='guru'");
                                                        while ($ekstra = mysqli_fetch_array($kelasQ)) {
                                                            echo "<option value='$ekstra[id_pengawas]'>$ekstra[nama]</option>";
                                                        }
                                                        ?>
                                                    </select>
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
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>
    </div>
 <?php
            
            if (isset($_POST['submit'])) {
                $kelas = $_POST['kelas'];
				$kode = $_POST['kode'];
                $mapel = $_POST['mapel'];
				$ke = $_POST['ke'];
                $hari = $_POST['hari'];
                $dari = $_POST['dari'];
                $sampai = $_POST['sampai'];
				$guru = $_POST['guru'];
                if ($dari <> '' and $sampai <> '') {
                    if ($dari == $sampai) {
                       echo "
	  <script type='text/javascript'>
		setTimeout(function () { 	
			swal({
				title: 'Gagal !!!',
				text:  'Data Gagal di simpan',
				type: 'error',
				timer: 2000,
				showConfirmButton: true
			});		
		},50);	
		window.setTimeout(function(){ 
			window.location.replace('?pg=mapelr');
		} ,2000);	
	  </script>";
                    
					} else {   
		 $exec = mysqli_query($koneksi, "INSERT INTO jadwal_mapel(kelas,kode,mapel,ke,guru,hari,dari,sampai) VALUES
		 ('$kelas','$kode','$mapel','$ke','$guru','$hari','$dari','$sampai')");			   
                   echo "
	  <script type='text/javascript'>
		setTimeout(function () { 	
			swal({
				title: 'Sukses !!!',
				text:  'Data berhasil di simpan',
				type: 'success',
				timer: 2000,
				showConfirmButton: true
			});		
		},10);	
		window.setTimeout(function(){ 
			window.location.replace('?pg=jadwalmapel');
		} ,2000);	
	  </script>";
				   }
                }
            }
            ?>
	
	<script>
	
	 $('#tabelmapel').on('click', '.hapus', function() {
        var id = $(this).data('id');
        console.log(id);
        swal({
            title: 'Are you sure?',
            text: 'Akan menghapus data ini!',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'iya, hapus'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: 'mod_mbs/mod_jadwal/crud_jadwal.php?pg=hapus_jadwal',
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
            return false;
        })

    });
	</script>