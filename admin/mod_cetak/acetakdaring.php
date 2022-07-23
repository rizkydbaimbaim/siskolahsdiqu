<?php
defined('APLIKASI') or exit('Anda tidak dizinkan mengakses langsung script ini!');
$kelas=$_GET['kelas'];
?>
    <div class='row'>
        <div class='col-md-12'>
            <div class='box box-solid'>
                <div class='box-header with-border '>
                    <h3 class='box-title'><i class="fas fa-print fa-fw"></i> Absen Daring Kelas <?= $_GET['kelas'] ?></h3>
                     <div class='box-tools pull-right'>
				   <button class='btn btn-sm btn-flat btn-primary' onclick="frames['frameresultQ'].print()"><i class='fa fa-print'></i> Rekap Absen</button>
                    <a href='?pg=absendaringkelas' class='btn btn-sm bg-maroon' title='Batal'><i class='fa fa-times'></i></a>
		  </div>
         </div>
                <div class='box-body'>
                      <div class="table-responsive">
                    <table style="font-size: 12px" class="table table-striped table-sm">
                     
          <thead class="thead-dark">
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
		$hadir= mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM absen_daring WHERE idsiswa='$siswa[id_siswa]' AND ket='H'"));
         $sakit= mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM absen_daring WHERE idsiswa='$siswa[id_siswa]' AND ket='S' "));
		 $izin= mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM absen_daring WHERE idsiswa='$siswa[id_siswa]' AND ket='I' "));
         $alpha= mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM absen_daring WHERE idsiswa='$siswa[id_siswa]' AND ket='A' "));
			  $no++;
			?>
			
							<tr>
                                    <td><?= $no; ?></td>
                                    <td><?=  ucwords(strtolower($siswa['nama'])) ?></td>
									
				<?php 
				
				$tanggal = cal_days_in_month(CAL_GREGORIAN, $bulan, $tahun);
                    for ($i = 1; $i < $tanggal + 1; $i++) { ?>
                        <?php $tanggalbaru = date('Y-m-d', mktime(0, 0, 0, $bulan, $i, $tahun));
                        $cekabsen = fetch($koneksi, 'absen_daring', ['tanggal' => $tanggalbaru, 'idsiswa' => $siswa['id_siswa']]);
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
<iframe id='loadframe' name='frameresultQ' src="mod_cetak/daring.php?kelas=<?php echo $kelas; ?>" style='display:none'></iframe>