<?php
defined('APLIKASI') or exit('Anda tidak dizinkan mengakses langsung script ini!');
?>
<?php if ($ac == '') { ?>
    <div class='row'>
        <div class='col-md-12'>
            <div class='box box-solid'>
                <div class='box-header with-border '>
                    <h3 class='box-title'><i class="fas fa-user fa-fw   "></i> DATA GURU</h3>
                    <div class='box-tools pull-right'>
					  <a href="?pg=dataabsenguru&ac=cetakrekap" class="hapus btn-sm btn btn-danger">
										<i class="fas fa-print"></i> Cetak Rekap</button></a>
                    </div>
                </div><!-- /.box-header -->
                <div class='box-body'>
                    <div class='table-responsive'>
                        <table style="font-size: 11px" id='tabelwali' class='table table-bordered table-striped'>
                            <thead>
                                <tr>
                                    <th width='3px'></th>
                                    <th>Nama</th>
                                    <th>NIP</th>                                
									<th width='5px'>Cetak</th>
                                </tr>
                            </thead>
							  </thead>
							
							<tbody>
							
                                <?php
								$no = 0;
								 $query = mysqli_query($koneksi, "select * from jadwal_mapel GROUP BY guru");
                            while ($guru = mysqli_fetch_array($query)) {
								$nama=fetch($koneksi,'pengawas',['id_pengawas'=>$guru['guru']]);
                                $no++;
                            ?>
							 <tr>
                                    <td><?= $no; ?></td>
									 <td><?= $nama['nama'] ?></td>
                                    <td><?= $nama['nip'] ?></td>
							       
                                   <td>
                                        <a href="?pg=dataabsenguru&ac=cetak&id=<?= $nama['id_pengawas'] ?>" class="hapus btn-sm btn btn-success">
										<i class="fas fa-print"></i></button></a>
										</td>			
							       </tr>
                    
                            <?php } ?>
                        </tbody>
                        </table>
                    </div>
                     </div>
                     </div>
	                    </div>
		
		<?php } elseif ($ac == 'cetak') { ?>
		 <?php 
	$id = $_GET['id'];
   
	?>
		<div class='row'>
        <div class='col-md-12'>
            <div class='box box-solid'>
                <div class='box-header with-border '>
                    <h3 class='box-title'><i class="fas fa-print fa-fw"></i>Absen Guru</h3>
                     <div class='box-tools pull-right'>
				   <button class='btn btn-sm btn-flat btn-primary' onclick="frames['frameresultQ'].print()"><i class='fa fa-print'></i> Cetak Absen</button>
                    <a href='?pg=dataabsenguru' class='btn btn-sm bg-maroon' title='Batal'><i class='fa fa-times'></i></a>
		  </div>
         </div>
                <div class='box-body'>
                      <div class="table-responsive">
                    <table style="font-size: 12px" class="table table-striped table-sm">
		<thead class="thead-dark">
            <tr>
                <th>No</th>
                <th>Nama </th>
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
			$query = mysqli_query($koneksi,"select * from pengawas WHERE id_pengawas='$id'");
             $no = 0;
              while ($siswa = mysqli_fetch_array($query)) {
		$hadir= mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM absen_guru WHERE guru='$id' AND ket='H' "));
         $sakit= mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM absen_guru WHERE guru='$id' AND ket='S' "));
		 $izin= mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM absen_guru WHERE guru='$id' AND ket='I' "));
         $alpha= mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM absen_guru WHERE guru='$id' AND ket='A' "));
			  $no++;
			?>
			
							<tr>
                                    <td><?= $no; ?></td>
                                    <td><?= $siswa['nama'] ?></td>
									
				<?php 
				
				$tanggal = cal_days_in_month(CAL_GREGORIAN, $bulan, $tahun);
                    for ($i = 1; $i < $tanggal + 1; $i++) { ?>
                        <?php $tanggalbaru = date('Y-m-d', mktime(0, 0, 0, $bulan, $i, $tahun));
                        $cekabsen = fetch($koneksi, 'absen_guru', ['tanggal' => $tanggalbaru, 'guru' => $id]);
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
<iframe id='loadframe' name='frameresultQ' src='mod_admin/cetakabsenguru.php?id=<?= $id ?>' style='display:none'></iframe>
		
		
		<?php } elseif ($ac == 'cetakrekap') { ?>
		<div class='row'>
        <div class='col-md-12'>
            <div class='box box-solid'>
                <div class='box-header with-border '>
                    <h3 class='box-title'><i class="fas fa-print fa-fw"></i> Rekap Absen Guru</h3>
                     <div class='box-tools pull-right'>
				   <button class='btn btn-sm btn-flat btn-primary' onclick="frames['frameresult'].print()"><i class='fa fa-print'></i> Rekap Absen</button>
                    <a href='?pg=dataabsenguru' class='btn btn-sm bg-maroon' title='Batal'><i class='fa fa-times'></i></a>
		  </div>
         </div>
                <div class='box-body'>
                      <div class="table-responsive">
                    <table style="font-size: 12px" class="table table-striped table-sm">
		<thead class="thead-dark">
            <tr>
                <th>No</th>
                <th>Nama </th>
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
			$query = mysqli_query($koneksi,"select * from pengawas WHERE level='guru'");
             $no = 0;
              while ($guru = mysqli_fetch_array($query)) {
		$hadir= mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM absen_guru WHERE guru='$guru[id_pengawas]' AND ket='H' "));
         $sakit= mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM absen_guru WHERE guru='$guru[id_pengawas]' AND ket='S' "));
		 $izin= mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM absen_guru WHERE guru='$guru[id_pengawas]' AND ket='I' "));
         $alpha= mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM absen_guru WHERE guru='$guru[id_pengawas]' AND ket='A' "));
			  $no++;
			?>
			
							<tr>
                                    <td><?= $no; ?></td>
                                    <td><?= $guru['nama'] ?></td>
									
				<?php 
				
				$tanggal = cal_days_in_month(CAL_GREGORIAN, $bulan, $tahun);
                    for ($i = 1; $i < $tanggal + 1; $i++) { ?>
                        <?php $tanggalbaru = date('Y-m-d', mktime(0, 0, 0, $bulan, $i, $tahun));
                        $cekabsen = fetch($koneksi, 'absen_guru', ['tanggal' => $tanggalbaru, 'guru' => $guru['id_pengawas']]);
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
		<iframe id='loadframe' name='frameresult' src='mod_admin/rekapabsenguru.php' style='display:none'></iframe>
		 <?php } ?>
	