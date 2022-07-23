                          <?php
                            $query = mysqli_query($koneksi, "select * from kode WHERE guru='$_SESSION[id_pengawas]'  ORDER BY id DESC LIMIT 1");
                            $kodeQ = mysqli_fetch_array($query);
							if($kodeQ['ket']==1){
							{$grade="KI3";}
                             }elseif($kodeQ['ket']==2){
							{$grade="KI4";}
							 }
							?>
      <div class='row'>
        <div class='col-md-12'>
            <div class='box box-solid'>
                <div class='box-header with-border '>
                <h3 class='box-title'><i class="fas fa-edit fa-fw   "> </i><?= $grade ?> <?= $kodeQ['mapel'] ?>
				(Penilaian <?= $kodeQ['jtes'] ?>)</h3>
                  
         </div>
            
              <form action='' method='post'>
				<div class="card-body">
				<div class="modal-footer">
                  <button type="submit" name="submit" class="btn btn-primary">Save</button>
                </div>
                    <table style="font-size: 12px" class="table table-striped table-sm">
                        <thead>
                            <tr>
                                <th class="text-center" width="5px">
                                    #
                                </th>
                                <th>Nama</th>
								<th width="10%">Kelas</th>
                              <th width="25%">Nilai</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                              $querys = mysqli_query($koneksi, "select * from siswa WHERE id_kelas='$kodeQ[kelas]' ");
                            $no = 0;
                            while ($siswa = mysqli_fetch_array($querys)) {
                                $no++;
                            ?>
                                <tr>
                                    <td><?= $no; ?></td>
                                    <td><?= $siswa['nama'] ?></td>
									 <td><?= $kodeQ['kelas'] ?></td>
                                    <td>
									<input type="hidden" name="ki[]" value="<?= $grade ?>" class="form-control" required>
									<input type="hidden" name="kd[]" value="<?= $kodeQ['kd'] ?>" class="form-control" required>
									<input type="hidden" name="mapel[]" value="<?= $kodeQ['mapel'] ?>" class="form-control" required>
									<input type="hidden" name="ket[]" value="<?= $kodeQ['jtes'] ?>" class="form-control" required>
									<input type="hidden" name="idsiswa[]" value="<?= $siswa['id_siswa'] ?>" class="form-control" required>
									<input type="number" name="nilai[]" class="form-control" value="0" required>
									</td>
                                </tr>
							<?php } ?>


                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php    
            if (isset($_POST['submit'])) {
				
	$idsiswa=$_POST['idsiswa'];
	$ki=$_POST['ki'];
	$kd=$_POST['kd'];
	$ket=$_POST['ket'];
	$mapel=$_POST['mapel'];
	$nilai=$_POST['nilai'];
	
$query = "INSERT INTO nilai_harian VALUES";
$index = 0; 
foreach($idsiswa as $datasiswa){
	$query .= "('','".$datasiswa."','".$mapel[$index]."','".$ki[$index]."','".$kd[$index]."','".$nilai[$index]."','".$ket[$index]."'),";
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
			window.location.replace('?pg=nh');
		} ,2000);	
	  </script>";
}
?>