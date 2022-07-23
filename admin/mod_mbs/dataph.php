 <div class='row'>
        <div class='col-md-6'>
            <div class='box box-solid'>
                <div class='box-header with-border '>
                    <h3 class='box-title'><i class="fas fa-edit fa-fw   "></i> PENILAIAN HARIAN</h3>
                    <div class='box-tools pull-right'>
				  
		  </div>
         </div>
           
            <div class="card-body">
			 <form name="form-cetak" method="POST" action="?pg=mcetakph" >
			 <div class="col-md-12">
                       <div class='form-group'>
					   <label>Mapel</label>
			         <select name='mapel' class='form-control' style='width:100%' required>
                       <option value=''>Pilih Mata Pelajaran</option>
                          <?php $que = mysqli_query($koneksi, "SELECT * FROM jadwal_mapel WHERE guru='$_SESSION[id_pengawas]' GROUP BY kode"); ?>
                               <?php while ($mapel = mysqli_fetch_array($que)) : ?>
                                      <option value="<?= $mapel['id_jadwal'] ?>"><?= $mapel['mapel'] ?></option>
                                                <?php endwhile ?>
                                            </select>
						</div>
						
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
															
						 <div class='form-group'>
						 <label>Kompetensi</label>
			<select class="form-control" style="width: 100%" name="ki" id="ki" required>
			 <option value="">Pilih Kompetensi</option>
              <option value="1">Pengetahuan (KI-3)</option>
			  <option value="2">Keterampilan(KI-4)</option>
                                
                        </select>
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
															</div>
																</div>
	  
