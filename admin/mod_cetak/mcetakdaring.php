<?php
defined('APLIKASI') or exit('Anda tidak dizinkan mengakses langsung script ini!');

$id = $_GET['id'];
$jadwal=fetch($koneksi,'jadwal_mapel',['id_jadwal' =>$id]);
$mapel=$jadwal['kode'];
$kelas= $jadwal['kelas'];
$guru=$jadwal['guru'];
$bl = date('m');
$bulane = fetch ($koneksi, 'bulan', ['bln' =>$bl]);
$rapor=fetch($koneksi,'setting_rapor',['id' => 1]);
$user=fetch($koneksi,'pengawas',['id_pengawas' =>$guru]);
?>

<div class='row'>
  <div class='col-md-12'>
            <div class='box box-solid'>
                <div class='box-header with-border '>
                    <h3 class='box-title'><i class="fas fa-print fa-fw   "></i> Absensi Daring <?= $mapel ?> Kelas <?= $kelas ?></h3>
                    <div class='box-tools pull-right'>
				   <button class='btn btn-sm btn-flat btn-primary' onclick="frames['frameresult'].print()"><i class='fa fa-print'></i> Rekap Absen</button>
                    <a href='?pg=absendaringmapel' class='btn btn-sm bg-maroon' title='Batal'><i class='fa fa-times'></i></a>
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
		$hadir= mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM absen_daringmapel WHERE idsiswa='$siswa[id_siswa]' AND ket='H' AND mapel='$mapel'"));
         $sakit= mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM absen_daringmapel WHERE idsiswa='$siswa[id_siswa]' AND ket='S' AND mapel='$mapel'"));
		 $izin= mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM absen_daringmapel WHERE idsiswa='$siswa[id_siswa]' AND ket='I' AND mapel='$mapel'"));
         $alpha= mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM absen_daringmapel WHERE idsiswa='$siswa[id_siswa]' AND ket='A' AND mapel='$mapel'"));
			  $no++;
			?>
			
							<tr>
                                    <td><?= $no; ?></td>
                                    <td><?= ucwords(strtolower($siswa['nama'])) ?></td>
									
				<?php 
				
				$tanggal = cal_days_in_month(CAL_GREGORIAN, $bulan, $tahun);
                    for ($i = 1; $i < $tanggal + 1; $i++) { ?>
                        <?php $tanggalbaru = date('Y-m-d', mktime(0, 0, 0, $bulan, $i, $tahun));
                        $cekabsen = fetch($koneksi, 'absen_daringmapel', ['tanggal' => $tanggalbaru, 'idsiswa' => $siswa['id_siswa'],'mapel'=>$mapel,'guru'=>$guru]);
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

<iframe id='loadframe' name='frameresult' src='mod_cetak/cetakdaring.php?id=<?= $_GET['id'] ?>' style='display:none'></iframe>