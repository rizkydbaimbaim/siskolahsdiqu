<?php defined('BASEPATH') or die("ip anda sudah tercatat oleh sistem kami") ?>
<?php if ($ac == '') { ?>
<div class="section-header">
    <div class='row'>
        <div class='col-md-12'>
            <div class='box box-solid'>
                <div class='box-header with-border '>
                    <h3 class='box-title'><i class="fas fa-edit fa-fw   "></i> DATA ABSENSI MAPEL</h3>
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
                                <th>Kelas</th>
                               <th>Mapel</th>
							   <th>Guru Mapel</th>
							
							<th width="5%">Absen Mapel</th>
							
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $query = mysqli_query($koneksi, "select * FROM jadwal_mapel ");
                            $no = 0;
                            while ($walas = mysqli_fetch_array($query)) {
							$guru=fetch($koneksi,'pengawas',['id_pengawas' =>$walas['guru']]);
                                $no++;
                            ?>
                                <tr>
                                    <td><?= $no; ?></td>
									<td><?= $walas['kelas'] ?></td>
									<td><?= $walas['mapel'] ?></td>
									<td><?= $guru['nama'] ?></td>
                                    <td>
                                       <a href="?pg=datamplab&ac=cetak&id=<?= $walas['id_jadwal'] ?>" class="btn btn-sm btn-danger btn-rounded">
                                          <i class="fas fa-print"></i></button></a>                                        
										   </td>
										   
							   </tr>
								
                            <?php }
                            ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php } elseif ($ac == 'cetak') { ?>
    <?php 
	$id = $_GET['id'];
    $jadwal=fetch($koneksi,'jadwal_mapel',['id_jadwal'=>$id]);
	$kelas=$jadwal['kelas'];
	$kode=$jadwal['kode'];
	$guru=$jadwal['guru'];
	?>
	
	<div class='row'>
        <div class='col-md-12'>
            <div class='box box-solid'>
                <div class='box-header with-border '>
                    <h3 class='box-title'><i class="fas fa-print fa-fw"></i> Absen Kelas <?= $jadwal['kelas'] ?> Mapel <?= $jadwal['kode'] ?></h3>
                     <div class='box-tools pull-right'>
				   <button class='btn btn-sm btn-flat btn-primary' onclick="frames['frameresult'].print()"><i class='fa fa-print'></i> Rekap Absen</button>
                    <a href='?pg=datamplab' class='btn btn-sm bg-maroon' title='Batal'><i class='fa fa-times'></i></a>
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
		$hadir= mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM absen_mapel WHERE siswa='$siswa[id_siswa]' AND ket='H' AND mapel='$kode' GROUP BY mapel AND guru"));
         $sakit= mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM absen_mapel WHERE siswa='$siswa[id_siswa]' AND ket='S' AND mapel='$kode' GROUP BY mapel AND guru"));
		 $izin= mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM absen_mapel WHERE siswa='$siswa[id_siswa]' AND ket='I' AND mapel='$kode' GROUP BY mapel AND guru"));
         $alpha= mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM absen_mapel WHERE siswa='$siswa[id_siswa]' AND ket='A' AND mapel='$kode' GROUP BY mapel AND guru"));
			  $no++;
			?>
			
							<tr>
                                    <td><?= $no; ?></td>
                                    <td><?= ucwords(strtolower($siswa['nama'])) ?></td>
									
				<?php 
				
				$tanggal = cal_days_in_month(CAL_GREGORIAN, $bulan, $tahun);
                    for ($i = 1; $i < $tanggal + 1; $i++) { ?>
                        <?php $tanggalbaru = date('Y-m-d', mktime(0, 0, 0, $bulan, $i, $tahun));
                        $cekabsen = fetch($koneksi, 'absen_mapel', ['tgl_absen' => $tanggalbaru, 'siswa' => $siswa['id_siswa'],'mapel'=>$kode, 'guru' =>$guru, 'kelas' =>$kelas]);
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
	
	
	<iframe id='loadframe' name='frameresult' src='mod_admin/cetakrekapabsen.php?id=<?= $id ?>' style='display:none'></iframe>
<?php } ?>