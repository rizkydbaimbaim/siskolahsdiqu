<?php
defined('APLIKASI') or exit('Anda tidak dizinkan mengakses langsung script ini!');
?>
    <div class='row'>
        <div class='col-md-12'>
            <div class='box box-solid'>
                <div class='box-header with-border '>
                    <h3 class='box-title'><i class="fas fa-user fa-fw   "></i>Jadwal Mapel Kelas</h3>
                    <div class='box-tools pull-right'>
				
                    </div>
                </div><!-- /.box-header -->
                <div class='box-body'>
                    <div class='table-responsive'>
                        <table style="font-size: 11px" id='tabelmapel' class='table table-bordered table-striped'>
                            <thead>
                                <tr>
                                    <th width='3px'></th>
									  <th width='5%'>Kelas</th>
                                    <th>Nama Mapel</th>  
                                     <th>Guru Mapel</th> 	
									 <th width='5%'>Hari</th>
                                     <th width='5%'>Jam Ke</th>
                                      <th width='5%'>Mulai Jam</th>
                                        <th width='5%'>Sampai Jam</th>									  
									<th width='5p%'>#</th>
                                </tr>
                            </thead>
							  </thead>
							
							<tbody>
							
                                <?php
								$no = 0;
								 $query = mysqli_query($koneksi, "select * from mapel_rapor
								 JOIN pengawas ON pengawas.id_pengawas=mapel_rapor.guru");
                            while ($mapel = mysqli_fetch_array($query)) {
								$hari=fetch($koneksi,'m_hari',['inggris' =>$mapel['hari']]);
                                $no++;
                            ?>
							 <tr>
                                    <td><?= $no; ?></td>
									 <td><?= $mapel['kelas_r'] ?></td>
							        <td><?= $mapel['namamapel'] ?></td>
									<td><?= $mapel['nama'] ?></td>
									<td><?= $hari['hari'] ?></td>
									<td><?= $mapel['jam_ke'] ?></td>
									<td><?= $mapel['dari'] ?></td>
									<td><?= $mapel['sampai'] ?></td>
                                   <td>
                                       <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modaledit<?= $mapel['id'] ?>">
                                                    <i class="fas fa-edit    "></i>
                                                </button>
										
                    <div class="modal fade" id="modaledit<?= $mapel['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                                        <div class="modal-dialog modal-md" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header bg-blue">

                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form id="formedit<?= $mapel['id'] ?>">
                                                    <div class="modal-body">
                                                        <input type="hidden" value="<?= $mapel['id'] ?>" name='id'>
														<div class="row">
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
														<input type="text"  name="dari" class="form-control">
														 </div>   
														</div> 
														
															<div class="col-md-6">
                                                             <div class="form-group">
														  <label>Sampai Jam</label>
														<input type="text"  name="sampai" class="form-control">
														 </div>
                                                      </div>
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
                        $("#formedit<?= $mapel['id'] ?>").submit(function(e) {
                            e.preventDefault();
                            $.ajax({
                                type: 'POST',
                                url: 'mod_mbs/crud_jadwal.php?pg=editjadwal',
                                data: $(this).serialize(),
                                success: function(data) {
                                    iziToast.success({
                                        title: 'Mantap!',
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