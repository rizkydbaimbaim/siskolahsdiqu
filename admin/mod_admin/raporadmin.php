<?php defined('BASEPATH') or die("ip anda sudah tercatat oleh sistem kami") ?>
<?php if ($ac == '') { ?>
<div class="section-header">
    <div class='row'>
        <div class='col-md-12'>
            <div class='box box-solid'>
                <div class='box-header with-border '>
                    <h3 class='box-title'><i class="fas fa-edit fa-fw   "></i> MENU WALI KELAS</h3>
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
                                <th width="5%">Kelas</th>
                                <th>Wali Kelas</th>
							<th width="5%">Leger KI-1</th>
							<th width="5%">Leger KI-2</th>
							<th width="5%">Leger KI-3</th>
							<th width="5%">Leger KI-4</th>
							<th width="5%">Cetak Rapor</th>
							
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $query = mysqli_query($koneksi, "select * FROM siswa GROUP BY id_kelas");
                            $no = 0;
                            while ($walas = mysqli_fetch_array($query)) {
							$user=fetch($koneksi,'pengawas',['jabatan' =>$walas['id_kelas']]);
                                $no++;
                            ?>
                                <tr>
                                    <td><?= $no; ?></td>
									<td><?= $walas['id_kelas'] ?></td>
									<td><?= $user['nama'] ?></td>
                                    <td>
                                       <a href="?pg=raporadmin&ac=cetak_ki1&kelas=<?= $walas['id_kelas'] ?>" class="btn btn-sm btn-danger btn-rounded">
                                          <i class="fas fa-print"></i></button></a>                                        
										   </td>
										    <td>
                                       <a href="?pg=raporadmin&ac=cetak_ki2&kelas=<?= $walas['id_kelas'] ?>" class="btn btn-sm btn-warning btn-rounded">
                                          <i class="fas fa-print"></i></button></a>                                        
										   </td>
										   <td>
                                       <a href="?pg=raporadmin&ac=cetak_ki3&kelas=<?= $walas['id_kelas'] ?>" class="btn btn-sm btn-success btn-rounded">
                                          <i class="fas fa-print"></i></button></a>                                        
										   </td>
										   <td>
										   <a href="?pg=raporadmin&ac=cetak_ki4&kelas=<?= $walas['id_kelas'] ?>" class="btn btn-sm btn-primary btn-rounded">
                                          <i class="fas fa-print"></i></button></a>                                        
										   </td>
										   <td>
                                       <a href="?pg=datasiswaadmin&kelas=<?= $walas['id_kelas'] ?>" class="btn btn-sm btn-info btn-rounded">
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
<?php } elseif ($ac == 'cetak_ki1') { ?>
    <?php $kelas = $_GET['kelas']; ?>
	<div class='row'>
        <div class='col-md-12'>
            <div class='box box-solid'>
                <div class='box-header with-border '>
                    <h3 class='box-title'><i class="fas fa-print fa-fw"></i> Leger KI-1 Kelas <?= $kelas ?> </h3>
                     <div class='box-tools pull-right'>
				   <button class='btn btn-sm btn-flat btn-primary' onclick="frames['frameresultSP'].print()"><i class='fa fa-print'></i> Leger KI-1</button>
                    <a href='?pg=raporadmin' class='btn btn-sm bg-maroon' title='Batal'><i class='fa fa-times'></i></a>
		  </div>
         </div>
                <div class='box-body'>
                      <div class="table-responsive">
                    <table style="font-size: 12px" class="table table-striped table-sm">
					<thead>
					<tr style="text-align: center">
			<th width="3%" rowspan='2' >No</th>
			<th width="8%" rowspan='2'>NIS</th>
			<th rowspan='2'>NAMA LENGKAP</th>
			<th width="3%" rowspan='2'>JK</th>
			<th colspan='2'> SIKAP SPIRITUAL (KI-1)</th>
			<th width="5%"  rowspan='2'>PRED</th>
			</tr>
			<tr style="text-align: center">
			<th>Selalu dilakukan</th>
			<th>Sedang berkembang</th>
			</tr>
			 </thead>
					 <?php
               $query = mysqli_query($koneksi, "select * from siswa_rapor WHERE kelas='$kelas' ");
                            $no = 0;
                            while ($siswa = mysqli_fetch_array($query)) {
				            $spiritual=fetch($koneksi,'spiritual',['niss' => $siswa['nis']]);
                                $no++;
                            ?>
							 <tbody>
							<tr>
                                    <td style="text-align: center"><?= $no; ?></td>
                                    <td style="text-align: center"><?= $siswa['nis'] ?></td>
                                    <td>&nbsp;<?= $siswa['nama'] ?></td>
			                      <td style="text-align: center"><?= substr($siswa['jk'],0,1) ?></td>
                                        <td>&nbsp;<?= $spiritual['keter'] ?></td>
										<td>&nbsp;<?= $spiritual['keter2'] ?></td>
                                  <td style="text-align: center"><?= $spiritual['pred'] ?></td>
							</tr>
			<?php } ?>
			</tbody>
	</table>
					</div>
                     </div>
            </div>
        </div>
  </div>
	<iframe id='loadframe' name='frameresultSP' src="mod_admin/spiritual.php?kelas=<?= $_GET['kelas'] ?>" style='display:none'></iframe>
	
	
	
	<?php } elseif ($ac == 'cetak_ki2') { ?>
    <?php $kelas = $_GET['kelas']; ?>
	<div class='row'>
        <div class='col-md-12'>
            <div class='box box-solid'>
                <div class='box-header with-border '>
                    <h3 class='box-title'><i class="fas fa-print fa-fw"></i> Leger KI-2 Kelas <?= $kelas ?> </h3>
                     <div class='box-tools pull-right'>
				   <button class='btn btn-sm btn-flat btn-primary' onclick="frames['frameresultSOS'].print()"><i class='fa fa-print'></i> Leger KI-2</button>
                    <a href='?pg=raporadmin' class='btn btn-sm bg-maroon' title='Batal'><i class='fa fa-times'></i></a>
		  </div>
         </div>
                <div class='box-body'>
                      <div class="table-responsive">
                    <table style="font-size: 12px" class="table table-striped table-sm">
					<thead>
					<tr style="text-align: center">
			<th width="3%" rowspan='2' >No</th>
			<th width="8%" rowspan='2'>NIS</th>
			<th rowspan='2'>NAMA LENGKAP</th>
			<th width="3%" rowspan='2'>JK</th>
			<th colspan='2'> SIKAP SOSIAL (KI-2)</th>
			<th width="5%"  rowspan='2'>PRED</th>
			</tr>
			<tr style="text-align: center">
			<th>Selalu dilakukan</th>
			<th>Sedang berkembang</th>
			</tr>
			 </thead>
					 <?php
               $query = mysqli_query($koneksi, "select * from siswa_rapor WHERE kelas='$kelas' ");
                            $no = 0;
                            while ($siswa = mysqli_fetch_array($query)) {
				            $sosial=fetch($koneksi,'sosial',['niss' => $siswa['nis']]);
                                $no++;
                            ?>
							 <tbody>
							<tr>
                                    <td style="text-align: center"><?= $no; ?></td>
                                    <td style="text-align: center"><?= $siswa['nis'] ?></td>
                                    <td>&nbsp;<?= $siswa['nama'] ?></td>
			                      <td style="text-align: center"><?= substr($siswa['jk'],0,1) ?></td>
                                        <td>&nbsp;<?= $sosial['keter'] ?></td>
										<td>&nbsp;<?= $sosial['keter2'] ?></td>
                                  <td style="text-align: center"><?= $sosial['pred'] ?></td>
							</tr>
			<?php } ?>
			</tbody>
	</table>
					</div>
                     </div>
            </div>
        </div>
  </div>
  <iframe id='loadframe' name='frameresultSOS' src="mod_admin/sosial.php?kelas=<?= $_GET['kelas'] ?>" style='display:none'></iframe>
	
  
  
 <?php } elseif ($ac == 'cetak_ki3') { ?>
    <?php 
	$kelas=$_GET['kelas'];
$kelas=$_GET['kelas'];
$jmpl = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM jadwal_mapel WHERE kelas='$kelas' "));
$bl = date('m');
$bulane = fetch ($koneksi, 'bulan', ['bln' =>$bl]);
$user=fetch($koneksi,'pengawas',['jabatan'=>$kelas]); 
	?>
	<div class='row'>
        <div class='col-md-12'>
            <div class='box box-solid'>
                <div class='box-header with-border '>
                    <h3 class='box-title'><i class="fas fa-print fa-fw"></i> Leger KI-3 Kelas <?= $kelas ?> </h3>
                     <div class='box-tools pull-right'>
				   <button class='btn btn-sm btn-flat btn-primary' onclick="frames['frameresultKI3'].print()"><i class='fa fa-print'></i> Leger KI-3</button>
                    <a href='?pg=raporadmin' class='btn btn-sm bg-maroon' title='Batal'><i class='fa fa-times'></i></a>
		  </div>
         </div>
                <div class='box-body'>
                      <div class="table-responsive">
                    <table style="font-size: 12px" class="table table-striped table-sm">
					<thead> 
						<th width="3%" rowspan='2' >No</th>
			<th width="8%" rowspan='2'>NIS</th>
			<th rowspan='2'>NAMA LENGKAP</th>
			<th width="3%" rowspan='2'>JK</th>
			<th colspan='<?= $jmpl ?>'>PENGETAHUAN (KI-3)</th>
			<th width="5%"  rowspan='2'>JML NILAI</th>
			</tr>
			<tr style="text-align: center">
			<?php
             $queryx = mysqli_query($koneksi, "select * from jadwal_mapel WHERE kelas='$kelas' order by urut");
              while ($mapel = mysqli_fetch_array($queryx)) { ?>
                 <th width="4%"><?= $mapel['kode'] ?></th>
                                <?php } ?>
			
			</tr>
                 </thead> 
			<?php
               $query = mysqli_query($koneksi, "select * from siswa_rapor where kelas='$kelas' ");
                            $no = 0;
                            while ($siswa = mysqli_fetch_array($query)) {
                                $no++;
                            ?>
					<tbody>
					 <tr>
                                    <td style="text-align: center"><?= $no; ?></td>
                                    <td style="text-align: center"><?= $siswa['nis'] ?></td>
                                    <td>&nbsp;<?= ucwords(strtolower($siswa['nama'])) ?></td>
			                      <td style="text-align: center"><?= substr($siswa['jk'],0,1) ?></td>
								  <?php
                                    $queryx = mysqli_query($koneksi, "select * from jadwal_mapel WHERE kelas='$kelas' order by urut");
                                    while ($mapel = mysqli_fetch_array($queryx)) {
                                       $n1 = mysqli_query($koneksi, "SELECT AVG(nilai) AS rata FROM nilai_ph WHERE mapel='$mapel[kode]' AND nis='$siswa[nis]' AND nilai>0");
                                    while ($kl = mysqli_fetch_array($n1)) {
						           $rerata=$kl['rata'];
								  
								   ?>
                                  <td style="text-align: center"><?= round($rerata) ?></td>
								   <?php } }?>
									<?php
									 $n2 = mysqli_query($koneksi, "SELECT SUM(nilai) AS ratax,COUNT(nilai) AS bagi FROM nilai_ph WHERE nis='$siswa[nis]' AND nilai>0");
                                    while ($kl2 = mysqli_fetch_array($n2)) {
										$n3 = mysqli_query($koneksi, "SELECT COUNT(jadwal_mapel.kode) AS kali FROM jadwal_mapel WHERE EXISTS(SELECT mapel FROM nilai_ph
										WHERE jadwal_mapel.kode=nilai_ph.mapel AND jadwal_mapel.kelas='$kelas')");
										 $kl3 = mysqli_fetch_array($n3);
										$jumlah=($kl2['ratax']/$kl2['bagi'])*$kl3['kali'];
									
										 ?>
		                            <td style="text-align: center"><?= round($jumlah,0) ?></td>   
									<?php } ?>
							</tr>
		              	<?php } ?>
						</tbody>
					</table>
						</div>
                     </div>
            </div>
        </div>
  </div>
  <iframe id='loadframe' name='frameresultKI3' src="mod_admin/legerP.php?kelas=<?= $_GET['kelas'] ?>" style='display:none'></iframe>
	
  
   <?php } elseif ($ac == 'cetak_ki4') { ?>
    <?php 
	$kelas=$_GET['kelas'];
$kelas=$_GET['kelas'];
$jmpl = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM jadwal_mapel WHERE kelas='$kelas' "));
$bl = date('m');
$bulane = fetch ($koneksi, 'bulan', ['bln' =>$bl]);
$user=fetch($koneksi,'pengawas',['jabatan'=>$kelas]); 
	?>
	<div class='row'>
        <div class='col-md-12'>
            <div class='box box-solid'>
                <div class='box-header with-border '>
                    <h3 class='box-title'><i class="fas fa-print fa-fw"></i> Leger KI-4 Kelas <?= $kelas ?> </h3>
                     <div class='box-tools pull-right'>
				   <button class='btn btn-sm btn-flat btn-primary' onclick="frames['frameresultKI4'].print()"><i class='fa fa-print'></i> Leger KI-4</button>
                    <a href='?pg=raporadmin' class='btn btn-sm bg-maroon' title='Batal'><i class='fa fa-times'></i></a>
		  </div>
         </div>
                <div class='box-body'>
                      <div class="table-responsive">
                    <table style="font-size: 12px" class="table table-striped table-sm">
					<thead> 
						<th width="3%" rowspan='2' >No</th>
			<th width="8%" rowspan='2'>NIS</th>
			<th rowspan='2'>NAMA LENGKAP</th>
			<th width="3%" rowspan='2'>JK</th>
			<th colspan='<?= $jmpl ?>'>PENGETAHUAN (KI-3)</th>
			<th width="5%"  rowspan='2'>JML NILAI</th>
			</tr>
			<tr style="text-align: center">
			<?php
             $queryx = mysqli_query($koneksi, "select * from jadwal_mapel WHERE kelas='$kelas' order by urut");
              while ($mapel = mysqli_fetch_array($queryx)) { ?>
                 <th width="4%"><?= $mapel['kode'] ?></th>
                                <?php } ?>
			
			</tr>
                 </thead> 
			<?php
               $query = mysqli_query($koneksi, "select * from siswa_rapor where kelas='$kelas' ");
                            $no = 0;
                            while ($siswa = mysqli_fetch_array($query)) {
                                $no++;
                            ?>
					<tbody>
						 <tr>
                                    <td style="text-align: center"><?= $no; ?></td>
                                    <td style="text-align: center"><?= $siswa['nis'] ?></td>
                                    <td>&nbsp;<?= ucwords(strtolower($siswa['nama'])) ?></td>
			                      <td style="text-align: center"><?= substr($siswa['jk'],0,1) ?></td>
								  <?php
                                    $queryx = mysqli_query($koneksi, "select * from jadwal_mapel WHERE kelas='$kelas' order by urut");
                                    while ($mapel = mysqli_fetch_array($queryx)) {
                                       $n1 = mysqli_query($koneksi, "SELECT AVG(nilai) AS rata FROM nilai_kh WHERE mapel='$mapel[kode]' AND nis='$siswa[nis]' AND nilai>0");
                                    while ($kl = mysqli_fetch_array($n1)) {
						           $rerata=$kl['rata'];
								  
								   ?>
                                        <td style="text-align: center"><?= round($rerata) ?></td>
										
                                    <?php } }?>
									<?php
									 $n2 = mysqli_query($koneksi, "SELECT SUM(nilai) AS ratax,COUNT(nilai) AS bagi FROM nilai_kh WHERE nis='$siswa[nis]' AND nilai>0");
                                    while ($kl2 = mysqli_fetch_array($n2)) {
										$n3 = mysqli_query($koneksi, "SELECT COUNT(jadwal_mapel.kode) AS kali FROM jadwal_mapel WHERE EXISTS(SELECT mapel FROM nilai_kh
										WHERE jadwal_mapel.kode=nilai_kh.mapel AND jadwal_mapel.kelas='$kelas')");
										 $kl3 = mysqli_fetch_array($n3);
										$jumlah=($kl2['ratax']/$kl2['bagi'])*$kl3['kali'];
									
										 ?>
		                            <td style="text-align: center"><?= round($jumlah,0) ?></td>   
									<?php } ?>
							</tr>
							<?php } ?>
            </tbody>
					</table>
						</div>
                     </div>
            </div>
        </div>
  </div>
  <iframe id='loadframe' name='frameresultKI4' src="mod_admin/legerK.php?kelas=<?= $_GET['kelas'] ?>" style='display:none'></iframe>
	
	<?php } ?>