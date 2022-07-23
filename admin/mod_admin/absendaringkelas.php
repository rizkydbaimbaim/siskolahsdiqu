
    <div class='col-md-12'>
        <div class='box box-solid' style='background-color:aqua'>
            <div class='box-header with-border'>
                <h3 class='box-title'><i class="fas fa-school"></i> Absen Daring Materi Belajar</h3>
				
              </div>
           
            <div class='box-body' style='background-color:#000'>

                <?php
                $kelasQ = mysqli_query($koneksi, "SELECT * FROM siswa GROUP BY id_kelas");
              while ($kelas = mysqli_fetch_array($kelasQ)){
				  $jumlah = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM siswa WHERE id_kelas='$kelas[id_kelas]'"));
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
                                             KELAS  <?= $kelas['id_kelas'] ?>
                                            </b></span>
                                    </div>
                                      
                                    <div class="box-footer no-padding">
                                        <ul class="nav nav-stacked">
										 <li>
                                               
                                                    <a href="#">
                                                     <i class='fas fa-clock'></i> Jumlah Siswa
                                                    <span class="pull-right badge bg-green"><?= $jumlah ?></span>
                                                    </a>
                                                
                                            </li>
											
                                             <li>                                              
                                                    <a href="?pg=acetakdaring&kelas=<?= $kelas['id_kelas'] ?>">
                                                     <i class='fas fa-print'></i> <b style="color:red;">Cetak Absen Daring</b>
                                                    <span class="pull-right badge bg-red">  KELAS  <?= $kelas['id_kelas'] ?></span>
                                                    </a>
                                                
                                            </li>
                                        </ul>
                                     
                                    </div>
									
                                </div>
                                
                            </div>
                       
                 
			  <?php } ?>

            </div>
        </div>
    </div>
