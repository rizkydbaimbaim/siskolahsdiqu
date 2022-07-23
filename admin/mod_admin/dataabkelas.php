<?php defined('BASEPATH') or die("ip anda sudah tercatat oleh sistem kami") ?>
<?php if ($ac == '') { ?>
    <div class='col-md-12'>
        <div class='box box-solid' style='background-color:aqua'>
            <div class='box-header with-border'>
                <h3 class='box-title'><i class="fas fa-university "></i> DATA KELAS</h3>
            </div><!-- /.box-header -->
            <div class='box-body' style='background-color:#000'>

                <?php
                $kelasQ = mysqli_query($koneksi, "SELECT * FROM siswa GROUP BY id_kelas");
              while ($kelas = mysqli_fetch_array($kelasQ)){
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
                                               
                                                    <a href="?pg=dataabkelas&ac=cetak&kelas=<?= $kelas['id_kelas'] ?>">
                                                     <i class='fas fa-clock'></i> CETAK ABSEN
                                                    <span class="pull-right badge bg-green"><?= $kelas['id_kelas'] ?></span>
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
<?php } elseif ($ac == 'cetak') { ?>
    <?php 
	$kelas = $_GET['kelas'];
   
	?>
	
	<div class='row'>
        <div class='col-md-12'>
            <div class='box box-solid'>
                <div class='box-header with-border '>
                    <h3 class='box-title'><i class="fas fa-print fa-fw"></i> Absen Kelas <?= $kelas ?> </h3>
                     <div class='box-tools pull-right'>
				   <button class='btn btn-sm btn-flat btn-primary' onclick="frames['frameresultQ'].print()"><i class='fa fa-print'></i> Rekap Absen</button>
                    <a href='?pg=dataabkelas' class='btn btn-sm bg-maroon' title='Batal'><i class='fa fa-times'></i></a>
		  </div>
         </div>
                <div class='box-body'>
                      <div class="table-responsive">
                    <table style="font-size: 12px" class="table table-striped table-sm">
                     
          <thead class="thead-dark">
            <tr>
	<tr>
                <th>NO</th>
                <th>Nama Siswa</th>
                <?php
				$bulan= date('m');
				$tahun=date('Y');
                	$tanggal = cal_days_in_month(CAL_GREGORIAN, $bulan, $tahun);
                    for ($i = 1; $i < $tanggal + 1; $i++) { ?>
                    <th><?= $i ?></th>
                <?php } ?>
                <th>H</th>
                <th>S</th>
                <th>I</th>
                <th>A</th>
            </tr>
        </thead>
       
							 <tbody>
							
            <?php
			$query = mysqli_query($koneksi,"select * from siswa WHERE id_kelas='$kelas'");
             $no = 0;
              while ($siswa = mysqli_fetch_array($query)) {
		$hadir= mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM absen_mapel WHERE siswa='$siswa[id_siswa]' AND ket='H' AND kelas='$kelas' GROUP BY kelas"));
         $sakit= mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM absen_mapel WHERE siswa='$siswa[id_siswa]' AND ket='S' AND kelas='$kelas' GROUP BY kelas"));
		 $izin= mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM absen_mapel WHERE siswa='$siswa[id_siswa]' AND ket='I' AND mapel='$kelas' GROUP BY kelas"));
         $alpha= mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM absen_mapel WHERE siswa='$siswa[id_siswa]' AND ket='A' AND mapel='$kelas' GROUP BY kelas"));
			  $no++;
			?>
			
							<tr>
                                    <td><?= $no; ?></td>
                                    <td><?= ucwords(strtolower($siswa['nama'])) ?></td>
									
				<?php 
				
				$tanggal = cal_days_in_month(CAL_GREGORIAN, $bulan, $tahun);
                    for ($i = 1; $i < $tanggal + 1; $i++) { ?>
                        <?php $tanggalbaru = date('Y-m-d', mktime(0, 0, 0, $bulan, $i, $tahun));
                        $cekabsen = fetch($koneksi, 'absen_mapel', ['tgl_absen' => $tanggalbaru, 'siswa' => $siswa['id_siswa'], 'kelas' =>$kelas]);
                       if ($cekabsen) { ?>
					 
                            <td><?= $cekabsen['ket'] ?></td>
                        <?php } else { ?>
                            <td></td>
                        <?php } ?>
                    <?php } ?>
					
							  <td><?= $hadir; ?></td>
							  <td><?= $sakit; ?></td>
							 <td><?= $izin; ?></td>
							  <td><?= $alpha; ?></td>
							  
									 </tr>   
			  <?php } ?>
         
			 
        </tbody>
    </table>
	   </div>
                     </div>
            </div>
        </div>
  </div>
	
	
<iframe id='loadframe' name='frameresultQ' src='mod_admin/cetakabsenkelas.php?kelas=<?= $kelas ?>' style='display:none'></iframe>
<?php } ?>