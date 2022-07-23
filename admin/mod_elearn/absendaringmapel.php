
    <div class='col-md-12'>
        <div class='box box-solid'>
            <div class='box-header with-border'>
                <h3 class='box-title'><i class="fas fa-edit    "></i> Absen Daring Materi Belajar</h3>
				
            </div>
			
            <div class='box-body'>

                <?php
                $kelasQ = mysqli_query($koneksi, "SELECT * FROM jadwal_mapel WHERE guru='$_SESSION[id_pengawas]' GROUP BY kelas");
              while ($kelas = mysqli_fetch_array($kelasQ)){
				  $jumlah = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM siswa WHERE id_kelas='$kelas[kelas]'"));
                ?>
                            <div class="col-md-4">
                                <div class="box box-widget widget-user-2">
                                    <!-- Add the bg color to the header using any of the bg-* classes -->
                                    <div class="widget-user-header bg-aqua" style="padding: 6px">
                                        <div class="widget-user-image">
                                            <img src="../dist/img/avatar5.png" alt="">
                                        </div>
                                        <!-- /.widget-user-image -->
                                        <span style="font-size: 20px"> <b>
                                             KELAS  <?= $kelas['kelas'] ?>
                                            </b></span>
                                    </div>
                                      
                                   <?php
                $mapelQ = mysqli_query($koneksi, "SELECT * FROM jadwal_mapel WHERE guru='$_SESSION[id_pengawas]' AND kelas='$kelas[kelas]' ");
              while ($mapel = mysqli_fetch_array($mapelQ)){
                ?>
                                    <div class="box-footer no-padding">
                                        <ul class="nav nav-stacked">
										  <li>
                                               <a href="#">
                                                     <i class='fas fa'></i> 
                                                    <span class="pull-right"></span>
                                                    </a>
                                                
                                            </li>
                                            <li>
                                               
                                                    <a href="#">
                                                     <i class='fas fa-book'></i> Mata Pelajaran
                                                    <span class="pull-right badge bg-aqua"><?= $mapel['kode'] ?></span>
                                                    </a>
                                                
                                            </li>
											<li>
                                               
                                                    <a href="?pg=mcetakdaring&id=<?= $mapel['id_jadwal'] ?>">
                                                     <i class='fas fa-print'></i> <b style="color:red;">Cetak Absen Daring</b>
                                                    <span class="pull-right badge bg-maroon"><?= $mapel['kode'] ?></span>
                                                    </a>
                                                
                                            </li>
                                        </ul>
                                   
                                    </div>
									 <?php } ?>
                                </div>                               
                            </div>               
			  <?php } ?>

            </div>
        </div>
    </div>
