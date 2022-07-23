
    <div class='col-md-12'>
        <div class='box box-solid'>
            <div class='box-header with-border'>
                <h3 class='box-title'><i class="fas fa-edit    "></i> JADWAL PELAJARAN</h3>
            </div><!-- /.box-header -->
            <div class='box-body'>

                <?php
                $hariQ = mysqli_query($koneksi, "SELECT * FROM m_hari");
              while ($hari = mysqli_fetch_array($hariQ)){
                ?>
                            <div class="col-md-4">
                                <div class="box box-widget widget-user-2">
                                    <!-- Add the bg color to the header using any of the bg-* classes -->
                                    <div class="widget-user-header bg-maroon" style="padding: 6px">
                                        <div class="widget-user-image">
                                            <img src="dist/img/soal.png" alt="">
                                        </div>
                                        <!-- /.widget-user-image -->
                                        <span style="font-size: 20px"> <b>
                                             Hari  <?= $hari['hari'] ?>
                                            </b></span>
                                    </div>
                                      <?php
                $mapelQ = mysqli_query($koneksi, "SELECT * FROM mapel_rapor WHERE hari='$hari[inggris]' ORDER BY jam_ke ASC");
              while ($mapel = mysqli_fetch_array($mapelQ)){
				  $user = fetch($koneksi,'pengawas',['id_pengawas' =>$mapel['guru']]);
                ?>
                                    <div class="box-footer no-padding">
                                        <ul class="nav nav-stacked">
                                            <li>
                                               
                                                    <a href="#">
                                                     <i class='fas fa-clock'></i> Mata Pelajaran
                                                    <span class="pull-right badge bg-green"><?= $mapel['namamapel'] ?></span>
                                                    </a>
                                                
                                            </li>
											<li>
                                               
                                                    <a href="#">
                                                     <i class='fas fa-clock'></i> Kelas
                                                    <span class="pull-right badge bg-green"><?= $mapel['kelas_r'] ?></span>
                                                    </a>
                                                
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <i class='fas fa-clock'></i> Waktu
                                                    <span class="pull-right badge bg-green"><?= $mapel['dari'] ?> - <?= $mapel['sampai'] ?></span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <i class='fas fa-clock'></i> Nama Guru
                                                    <span class="pull-right badge bg-red"><?= $user['nama'] ?></span>
                                                </a>
                                            </li>

                                        </ul>
                                     
                                    </div>
									 <?php } ?>
                                </div>
                                <!-- /.widget-user -->
                            </div>
                       
                 
			  <?php } ?>

            </div>
        </div>
    </div>
