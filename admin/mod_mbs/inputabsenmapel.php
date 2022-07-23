<?php
$id=$_GET['id'];
$mapelQ=fetch($koneksi,'jadwal_mapel',['id_jadwal' => $id]);
$mapel=$mapelQ['kode'];
$kelas = $mapelQ['kelas'];
$tanggale=date('Y-m-d');
$rapor=fetch($koneksi,'setting_rapor',['id'=>1]);
?>
<div class="section-header">
    <div class='row'>
        <div class='col-md-12'>
            <div class='box box-solid'>
                <div class='box-header with-border '>
                    <h3 class='box-title'><i class="fas fa-edit fa-fw   "></i> <?= $mapelQ['mapel'] ?></h3>
                   <form action='' method='post'>
				   <div class='box-tools pull-right'>
				       <button type='submit' name='submit' class='btn btn-sm btn-primary'><i class='fa fa-check'></i> Simpan</button>
		  </div>
         </div>
		 <input type="hidden" name="mapelmu" value="<?php echo $mapel ?>">
			<input type="hidden" name="gurumu" value="<?php echo $_SESSION['id_pengawas'] ?>">
            <div class='box-body'>
                   <div class='table-responsive'>
                        <table style="font-size: 11px" id='tabelekstra' class='table table-bordered table-striped'>
                            <thead>
                            <tr>
                             <th width="5%" class="text-center">
                                    #
                                </th>
                                <th width="5%">Kelas</th>
                                 <th>Nama Mapel</th>
								 <th width="15%">Pilih</th>
							
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            $query = mysqli_query($koneksi, "select * FROM siswa WHERE id_kelas='$kelas'");
                            $no = 0;
                            while ($siswa = mysqli_fetch_array($query)) {
								
                                $no++;
                            ?>
                                <tr>
                                    <td><?= $no; ?></td>
									<td><?= $siswa['id_kelas'] ?></td>
									<td><?= $siswa['nama'] ?>
									<input type="hidden" name="siswa[]" value="<?php echo $siswa['id_siswa'] ?>">
									<input type="hidden" name="guru[]" value="<?php echo $_SESSION['id_pengawas'] ?>">
									<input type="hidden" name="kelasQ[]" value="<?php echo $kelas ?>">
									<input type="hidden" name="mapel[]" value="<?php echo $mapel ?>">
									<input type="hidden" name="smt[]" value="<?php echo $rapor['semester'] ?>">
									<input type="hidden" name="tp[]" value="<?php echo $rapor['tp'] ?>">
									<input type="hidden" name="tgl[]" value="<?php echo date('Y-m-d') ?>">
									<input type="hidden" name="bln[]" value="<?php echo date('m') ?>">
									</td>
									 <td>                                        
                                       <select class="form-control" name="ket[]" required>
						              <option value="H">Hadir</option>
						              <option value="S">Sakit</option>
									   <option value="I">Izin</option>
									    <option value="A">Alpha</option>
						             </select>
                                    </td>
									</tr>
							<?php } ?>
                    </table>
                </div>
            </div>
			</form>
        </div>
    </div>
   </div>
    </div>
 <?php
            if (isset($_POST['submit'])) {
				
	 $mapelmu = $_POST['mapelmu'];
	   $gurumu = $_POST['gurumu'];
	 $tgl_absen = $_POST['tgl'];
	  $mapel = $_POST['mapel'];
	   $guru = $_POST['guru'];
		$kelasQ = $_POST['kelasQ'];
		$siswa = $_POST['siswa'];
		$ket = $_POST['ket'];
	    $smt = $_POST['smt'];
		$tp = $_POST['tp'];
		$bln= $_POST['bln'];
$cekdata = "SELECT * FROM absen_mapel WHERE tgl_absen='$tanggale' AND mapel='$mapelmu' AND kelas='$kelas'";
$jikaada = mysqli_query($koneksi,$cekdata);
if(mysqli_num_rows($jikaada)>0){
	 echo "
	  <script type='text/javascript'>
		setTimeout(function () { 	
			swal({
				title: 'Gagal !!!',
				text:  'Data Gagal di simpan',
				type: 'error',
				timer: 2000,
				showConfirmButton: true
			});		
		},10);	
		window.setTimeout(function(){ 
			window.location.replace('?pg=inputabsen');
		} ,2000);	
	  </script>";
	  }else{
$query = "INSERT INTO absen_mapel VALUES";
$index = 0; 
foreach($siswa as $datasiswa){
	$query .= "('','".$datasiswa."','".$tgl_absen[$index]."','".$mapel[$index]."','".$kelasQ[$index]."','".$guru[$index]."','".$ket[$index]."','".$smt[$index]."','".$tp[$index]."','".$bln[$index]."'),";
	$index++;
}
$query = substr($query, 0, strlen($query) - 1).";";
mysqli_query($koneksi, $query);
echo "
	  <script type='text/javascript'>
		setTimeout(function () { 	
			swal({
				title: 'Sukses !!!',
				text:  'Data berhasil di simpan',
				type: 'success',
				timer: 2000,
				showConfirmButton: true
			});		
		},10);	
		window.setTimeout(function(){ 
			window.location.replace('?pg=inputabsen');
		} ,2000);	
	  </script>";
}
}

?>