<?php
defined('APLIKASI') or exit('Anda tidak dizinkan mengakses langsung script ini!');
?>
    <div class='row'>
        <div class='col-md-12'>
            <div class='box box-solid'>
                <div class='box-header with-border '>
                    <h3 class='box-title'><i class="fas fa-user fa-fw   "></i> DATA GURU</h3>
                    <div class='box-tools pull-right'>
					 
                    </div>
                </div><!-- /.box-header -->
                <div class='box-body'>
                    <div class='table-responsive'>
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
                <th>Hadir</th>
                
            </tr>
        </thead>
       
							 <tbody>
							
            <?php
			$query = mysqli_query($koneksi,"select * from pengawas WHERE level<>'admin' ");
             $no = 0;
              while ($siswa = mysqli_fetch_array($query)) {
		$hadir= mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM absen_guru WHERE guru='$siswa[id_pengawas]' AND ket='H' "));
      
			  $no++;
			?>
			
							<tr>
                                    <td><?= $no; ?></td>
                                    <td><?= $siswa['nama'] ?></td>
									
				<?php 
				
				$tanggal = cal_days_in_month(CAL_GREGORIAN, $bulan, $tahun);
                    for ($i = 1; $i < $tanggal + 1; $i++) { ?>
                        <?php $tanggalbaru = date('Y-m-d', mktime(0, 0, 0, $bulan, $i, $tahun));
                        $cekabsen = fetch($koneksi, 'absen_guru', ['tanggal' => $tanggalbaru, 'guru' => $siswa['id_pengawas']]);
                       if ($cekabsen) { ?>
					 
                            <td><b><?= $cekabsen['masuk'] ?></b></td>
                        <?php } else { ?>
                            <td></td>
                        <?php } ?>
                    <?php } ?>
					
							  <td><?= $hadir; ?></td>
							 
							  
									 </tr>   
			  <?php } ?>
         
			 
        </tbody>
    </table>
                    </div>
                     </div>
                     </div>
	                    </div>
	