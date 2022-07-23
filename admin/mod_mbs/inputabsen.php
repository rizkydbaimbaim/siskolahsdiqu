
<div class="section-header">
    <div class='row'>
        <div class='col-md-6'>
            <div class='box box-solid'>
                <div class='box-header with-border '>
                    <h3 class='box-title'><i class="fas fa-calendar fa-fw   "></i> INPUT ABSEN MAPEL</h3>
                    <div class='box-tools pull-right'>
				   
		  </div>
         </div>
            <div class='box-body'>
                   <div class='table-responsive'>
                        <table style="font-size: 11px" id='tabelekstra' class='table table-bordered table-striped'>
                            <thead>
                            <tr>
                             <th width="5%" class="text-center">
                                    #
                                </th>
                                <th width="5%">Kelas</th>
                                 <th>Nama Mapel</th>
								 <th width="5%">Pilih</th>
							 <th width="5%">Cetak</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            $query = mysqli_query($koneksi, "select * FROM jadwal_mapel
							
							WHERE guru='$_SESSION[id_pengawas]'");
                            $no = 0;
                            while ($mapel = mysqli_fetch_array($query)) {
								
                                $no++;
                            ?>
                                <tr>
                                    <td><?= $no; ?></td>
									<td><?= $mapel['kelas'] ?></td>
									<td><?= $mapel['mapel'] ?></td>
									<td>
									<a href="?pg=inputabsenmapel&id=<?= $mapel['id_jadwal'] ?>" class="btn btn-sm btn-primary">
									<i class="fas fa-search"></i></button></a>
									</td>
									<td>
									<a href="?pg=mcetakabsen&id=<?= $mapel['id_jadwal'] ?>" class="btn btn-sm btn-danger">
									<i class="fas fa-print"></i></button></a>
									</td>
									</tr>
							<?php } ?>
                    </table>
                </div>
            </div>
			</form>
        </div>
    </div>
	
    <div class='col-md-6'>
        <div class='box box-solid'>
            <div class='box-header with-border'>
                <h3 class='box-title'><i class="fas fa-calendar"></i> Rekap Tanggal <?= date('d-m-Y') ?></h3>
            </div><!-- /.box-header -->
            <div class='box-body'>

                
                            <div class="col-md-6">
                                <div class="box box-widget widget-user-2">
                                    <!-- Add the bg color to the header using any of the bg-* classes -->
                                    <div class="widget-user-header bg-maroon" style="padding: 6px">
                                        <div class="widget-user-image">
                                            <img src="../dist/img/avatar5.png" alt="">
                                        </div>
                                        <span style="font-size: 20px"> <b>
                                             HADIR
                                            </b></span>
                                    </div>
									<?php
									$tgle=date('Y-m-d');
									$hadir = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM absen_mapel WHERE guru='$_SESSION[id_pengawas]' AND tgl_absen='$tgle' AND ket='H'"));
                                    $sakit = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM absen_mapel WHERE guru='$_SESSION[id_pengawas]' AND tgl_absen='$tgle' AND ket='S'"));  
									$izin = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM absen_mapel WHERE guru='$_SESSION[id_pengawas]' AND tgl_absen='$tgle' AND ket='I'"));
									$alpha = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM absen_mapel WHERE guru='$_SESSION[id_pengawas]' AND tgl_absen='$tgle' AND ket='A'"));
									  ?>
									   <ul class="nav nav-stacked">
                                            <li>
                                                    <a href="#">
                                                     <i class='fas fa-clock'></i> Siswa Hadir
                                                    <span class="pull-right badge bg-green"><?= $hadir ?></span>
                                                    </a>
                                            </li>
								  	 </ul>
								</div>	
							</div>           
								<div class="col-md-6">
                                <div class="box box-widget widget-user-2">
                                    <!-- Add the bg color to the header using any of the bg-* classes -->
                                    <div class="widget-user-header bg-maroon" style="padding: 6px">
                                        <div class="widget-user-image">
                                            <img src="../dist/img/avatar-6.png" alt="">
                                        </div>
                                        <span style="font-size: 20px"> <b>
                                             SAKIT
                                            </b></span>
                                    </div>
									 <ul class="nav nav-stacked">
                                            <li>
                                                    <a href="#">
                                                     <i class='fas fa-clock'></i> Siswa Sakit
                                                    <span class="pull-right badge bg-red"><?= $sakit ?></span>
                                                    </a>
                                            </li>
								  	 </ul>
								</div>	
							</div>          
							<div class="col-md-6">
                                <div class="box box-widget widget-user-2">
                                    <!-- Add the bg color to the header using any of the bg-* classes -->
                                    <div class="widget-user-header bg-maroon" style="padding: 6px">
                                        <div class="widget-user-image">
                                            <img src="../dist/img/avatar_default.png" alt="">
                                        </div>
                                        <span style="font-size: 20px"> <b>
                                             IZIN
                                            </b></span>
                                    </div>
									 <ul class="nav nav-stacked">
                                            <li>
                                                    <a href="#">
                                                     <i class='fas fa-clock'></i> Siswa Izin
                                                    <span class="pull-right badge bg-yellow"><?= $izin ?></span>
                                                    </a>
                                            </li>
								  	 </ul>
								</div>	
							</div>          
							<div class="col-md-6">
                                <div class="box box-widget widget-user-2">
                                    <!-- Add the bg color to the header using any of the bg-* classes -->
                                    <div class="widget-user-header bg-maroon" style="padding: 6px">
                                        <div class="widget-user-image">
                                            <img src="../dist/img/ddd.png" alt="">
                                        </div>
                                        <span style="font-size: 20px"> <b>
                                             ALPHA
                                            </b></span>
                                    </div>
									 <ul class="nav nav-stacked">
                                            <li>
                                                    <a href="#">
                                                     <i class='fas fa-clock'></i> Siswa Alpha
                                                    <span class="pull-right badge bg-black"><?= $alpha ?></span>
                                                    </a>
                                            </li>
								  	 </ul>
								</div>	
							</div>          
            </div>
        </div>
    </div>
      


<script>
   $('#form-tambah').submit(function(e) {
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: 'mod_absen/crud_absen.php?pg=tambah',
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
	</script>