
    <div class='col-md-12'>
        <div class='box box-solid'>
            <div class='box-header with-border'>
                <h3 class='box-title'><i class="fas fa-users    "></i> VISI MISI KANDIDAT</h3>
            </div><!-- /.box-header -->
            <div class='box-body'>

                <?php
                $hariQ = mysqli_query($koneksi, "SELECT * FROM kandidat");
              while ($hari = mysqli_fetch_array($hariQ)){
				   $siswa = fetch($koneksi,'siswa',['id_siswa' =>$hari['idsiswa']]);
                ?>
                            <div class="col-md-4">
                                <div class="box box-widget widget-user-2">
                                    <!-- Add the bg color to the header using any of the bg-* classes -->
                                    <div class="widget-user-header bg-aqua" style="padding: 6px">
                                        <div class="widget-user-image">
                                            <img src="dist/img/soal.png" alt="">
                                        </div>
                                        <!-- /.widget-user-image -->
                                        <span style="font-size: 20px"> <b>
                                             <?= $siswa['nama'] ?>
                                            </b></span>
                                    </div>
                                      <?php
                $mapelQ = mysqli_query($koneksi, "SELECT * FROM kandidat");
              $k = mysqli_fetch_array($mapelQ);
				  
                ?>
                                    <div class="box-footer no-padding">
                                        <ul class="nav nav-stacked">
                                            <li>
                                               
                                                  <img src="berkas/<?= $hari['gambar'] ?>" width="100">
                                                
                                            </li>
											<li>
                                               
                                                    <a href="#">
                                                     <i class='fas fa-book'></i> VISI
                                                    <span class="pull-right"><?= $k['visi'] ?></span>
                                                    </a>
                                                
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <i class='fas fa-book'></i> MISI
                                                    <span class="pull-right"><?= $k['misi'] ?></span>
                                                </a>
                                            </li>
                                           
                                        </ul>
                                     
                                    </div>
									
                                </div>
                                <!-- /.widget-user -->
                            </div>
                       
                 
			  <?php } ?>

            </div>
        </div>
    </div>
