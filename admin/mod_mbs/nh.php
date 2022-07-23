<?php $rapor = fetch($koneksi, 'setting_rapor', ['id' => 1]); ?>
<div class='row'>
        <div class='col-md-6'>
            <div class='box box-solid'>
                <div class='box-header with-border '>
                    <h3 class='box-title'><i class="fas fa-edit fa-fw   "></i> NILAI HARIAN KI-3</h3>
                    <div class='box-tools pull-right'>
				   
		  </div>
         </div>
            <form action='' method='post'>
            <div class="card-body">
				
				  <input type="hidden" name="guru" value="<?= $_SESSION['id_pengawas'] ?>" class="form-control" required>
                  
                   <div class='modal-body'>
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                   <label>Mapel</label>
                                   <select name='mapel' class='form-control' style='width:100%' required>
                                                <option value=''>Pilih Mata Pelajaran</option>
                                                <?php $que = mysqli_query($koneksi, "SELECT * FROM jadwal_mapel WHERE guru='$_SESSION[id_pengawas]' GROUP BY kode"); ?>
                                                <?php while ($mapel = mysqli_fetch_array($que)) : ?>

                                                    <option value="<?= $mapel['kode'] ?>"><?= $mapel['mapel'] ?></option>"

                                                <?php endwhile ?>
                                            </select>
                    </div>
                        </div>
						
                    <div class="col-md-4">
                       <div class='form-group'>
                        <label>Kelas</label>
                        <select name='kelas' class='form-control ' style='width:100%' required>
                                                        <option value=''>Pilih Kelas</option>
                                                        <?php $lev = mysqli_query($koneksi, "SELECT * FROM jadwal_mapel WHERE guru='$_SESSION[id_pengawas]' GROUP BY kelas"); ?>
                                                        <?php while ($kelas = mysqli_fetch_array($lev)) : ?>

                                                            <option value="<?= $kelas['kelas'] ?>"><?= $kelas['kelas'] ?></option>

                                                        <?php endwhile ?>
                                                    </select>
                    </div>
					</div>
					
					<div class="col-md-4">
                       <div class='form-group'>
                        <label>Tanggal</label>
                        <input type="text" class="form-control datepicker" name="tgl" id="tgl" autocomplete="off" required>
                    </div>
					</div>
					
					 <div class="col-md-4">
                       <div class='form-group'>
                        <label>No KI/KD</label>
                       <select class="form-control" style="width: 100%" name="kd" id="kd" required>
                                <option value="">--Pilih KD--</option>
                                 <option value="3.1">3.1</option>
								 <option value="3.2">3.2</option>
								 <option value="3.3">3.3</option>
								 <option value="3.4">3.4</option>
								 <option value="3.5">3.5</option>
								 <option value="3.6">3.6</option>
								 <option value="3.7">3.7</option>
								 <option value="3.8">3.8</option>
								 <option value="3.9">3.9</option>
								 <option value="3.10">3.10</option>
								 <option value="3.11">3.11</option>
								 <option value="3.12">3.12</option>
								  </select>
                    </div>
					</div>
					 <div class="col-md-4">
                       <div class='form-group'>
                        <label>Ulangan Ke</label>
                        <input type="number" name="ke" class="form-control" autocomplete='off' required>
                    </div>
					</div>
					
					<div class="col-md-12">
                       <div class='form-group'>
                        <label>Jenis Tes</label>
                        <select class="form-control" style="width: 100%" name="jtes" id="jtes" required>
                                <option value="">--Pilih Jenis Tes--</option>
                                 <option value="Tertulis">Tes Tertulis</option>
								 <option value="Lisan">Tes Lisan</option>
								 <option value="Penugasan">Penugasan</option>
								  </select>
                    </div>
					</div>
					</div>
                <div class="modal-footer">
                   
                  <button type="submit" name="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
</div>
<?php    
            if (isset($_POST['submit'])) {
           $data = [
        'guru' => $_POST['guru'],
        'mapel' => $_POST['mapel'],
        'kelas' => $_POST['kelas'],
	    'tanggal' => $_POST['tgl'],
        'ke' => $_POST['ke'],
         'kd' => $_POST['kd'],
		 'jtes' => $_POST['jtes'],
		 'ket' => 1,
		  'smt' => $rapor['semester'],
		 'tp' => $rapor['tp']
		];
		  
	  $exec = insert($koneksi, 'kode', $data);
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
			window.location.replace('?pg=inputph');
		} ,2000);	
	  </script>";
			}
			?>


  <div class='col-md-6'>
            <div class='box box-solid'>
                <div class='box-header with-border '>
                    <h3 class='box-title'><i class="fas fa-edit fa-fw   "></i> NILAI HARIAN KI-4</h3>
                    <div class='box-tools pull-right'>
				   
		  </div>
         </div>
           
            <div class="card-body">
				<form action='' method='post'>
				  <input type="hidden" name="guru" value="<?= $_SESSION['id_pengawas'] ?>" class="form-control" required>
                  
                   <div class='modal-body'>
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                   <label>Mapel</label>
                                    <select name='mapel' class='form-control' style='width:100%' required>
                                                <option value=''>Pilih Mata Pelajaran</option>
                                                <?php $que = mysqli_query($koneksi, "SELECT * FROM jadwal_mapel WHERE guru='$_SESSION[id_pengawas]' GROUP BY kode"); ?>
                                                <?php while ($mapel = mysqli_fetch_array($que)) : ?>

                                                    <option value="<?= $mapel['kode'] ?>"><?= $mapel['mapel'] ?></option>"

                                                <?php endwhile ?>
                                            </select>
                    </div>
                        </div>
						
                    <div class="col-md-4">
                       <div class='form-group'>
                        <label>Kelas</label>
                        <select name='kelas' class='form-control ' style='width:100%' required>
                                                        <option value=''>Pilih Kelas</option>
                                                        <?php $lev = mysqli_query($koneksi, "SELECT * FROM jadwal_mapel WHERE guru='$_SESSION[id_pengawas]' GROUP BY kelas"); ?>
                                                        <?php while ($kelas = mysqli_fetch_array($lev)) : ?>

                                                            <option value="<?= $kelas['kelas'] ?>"><?= $kelas['kelas'] ?></option>

                                                        <?php endwhile ?>
                                                    </select>
                    </div>
					</div>
					
					<div class="col-md-4">
                       <div class='form-group'>
                        <label>Tanggal</label>
                        <input type="text" class="form-control datepicker" name="tgl" id="tgl" autocomplete="off" required>
                    </div>
					</div>
					
					 <div class="col-md-4">
                       <div class='form-group'>
                        <label>No KI/KD</label>
                        <select class="form-control" style="width: 100%" name="kd" id="kd" required>
                                <option value="">--Pilih KD--</option>
                                 <option value="4.1">4.1</option>
								 <option value="4.2">4.2</option>
								 <option value="4.3">4.3</option>
								 <option value="4.4">4.4</option>
								 <option value="4.5">4.5</option>
								 <option value="4.6">4.6</option>
								 <option value="4.7">4.7</option>
								 <option value="4.8">4.8</option>
								 <option value="4.9">4.9</option>
								 <option value="4.10">4.10</option>
								 <option value="4.11">4.11</option>
								 <option value="4.12">4.12</option>
								  </select>
                    </div>
					</div>
					 <div class="col-md-4">
                       <div class='form-group'>
                        <label>Penilaian Ke</label>
                        <input type="number" name="ke" class="form-control" autocomplete='off' required>
                    </div>
					</div>
					
					<div class="col-md-12">
                       <div class='form-group'>
                        <label>Jenis Penilaian</label>
                        <select class="form-control" style="width: 100%" name="jtes" id="jtes" required>
                                <option value="">--Pilih Jenis Penilaian--</option>
                                 <option value="Kinerja">Penilaian Kinerja</option>
								 <option value="Proyek">Penilaian Proyek</option>
								 <option value="Portofolio">Portofolio</option>
								  </select>
                    </div>
					</div>
					</div>
					
                <div class="modal-footer">
                   
                  <button type="submit" name="simpan" class="btn btn-info">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
 </div>
 </div>

<?php    
            if (isset($_POST['simpan'])) {
           $data = [
        'guru' => $_POST['guru'],
        'mapel' => $_POST['mapel'],
        'kelas' => $_POST['kelas'],
	    'tanggal' => $_POST['tgl'],
        'ke' => $_POST['ke'],
         'kd' => $_POST['kd'],
		 'jtes' => $_POST['jtes'],
		 'ket' => 2,
		  'smt' => $rapor['semester'],
		 'tp' => $rapor['tp']
		];
		  
	  $exec = insert($koneksi, 'kode', $data);
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
			window.location.replace('?pg=inputph');
		} ,2000);	
	  </script>";
			}
			?>