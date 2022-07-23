 
<div class="section-header">
 <div class='row'>
        <div class='col-md-5'>
            <div class='box box-solid'>
                <div class='box-header with-border '>
                    <h3 class='box-title'><i class="fas fa-edit fa-fw   "></i> INPUT ABSEN GURU</h3>
                    <div class='box-tools pull-right'>
				  
		  </div>
         </div>
           <br>
            <div class="card-body">
			 <form method="POST" action="" >
			                <div class="col-md-12">
                       <div class='form-group'>
					   <label>Pilih Guru</label>
			<select class="form-control" style="width: 100%" name="guru" id="guru" required>
			 <option value="">--Pilih Guru--</option>
                            <?php
                            $query = mysqli_query($koneksi, "select * from jadwal_mapel");
                            while ($tutor = mysqli_fetch_array($query)) {
								$guru = fetch($koneksi,'pengawas',['id_pengawas' =>$tutor['guru']]);
                            ?>
                                <option value="<?= $tutor['guru'] ?>"><?= $guru['nama'] ?></option>
                            <?php } ?>
                        </select>
						</div>
						</div>
						<div class="col-md-12">
                       <div class='form-group'>
                        <label>Tanggal</label>
                        <input type="text" class="form-control datepicker" name="tgl" autocomplete="off" required>
                    </div>
					</div>
					    <div class="col-md-12">
                       <div class='form-group'>
					   <label>Kehadiran</label>
			<select class="form-control" style="width: 100%" name="hadir" id="hadir" required>
			 <option value="">--Pilih Kehadiran--</option>
                                <option value="H">Hadir</option>
								<option value="I">Izin</option>
                                <option value="S">Sakit</option>
								<option value="A">Tanpa Keterangan</option>
                        </select>
						</div>
						</div>
					 </div>
					
						<div class="modal-footer">
						
				  <button type="submit" name="submit" class="btn btn-primary">Simpan</button>
				 
                </div>
			 </form>
		</div>
	</div>
			
	
        <div class='col-md-7'>
            <div class='box box-solid'>
                <div class='box-header with-border '>
                    <h3 class='box-title'><i class="fas fa-edit fa-fw   "></i>Absensi Tanggal <?= date('d-m-Y') ?></h3>
                    <div class='box-tools pull-right'>
				   
		  </div>
         </div>
            <div class='box-body'>
                   <div class='table-responsive'>
                        <table style="font-size: 12px" id='tabelekstra' class='table table-bordered table-striped'>
                        <thead>
                            <tr>
                                <th class="text-center">
                                    #
                                </th>
                                <th>Nama</th>
                                <th>Tanggal</th>
                                <th> Keterangan</th>
								
                            </tr>
                        </thead>
                        <tbody>
                            <?php
							$tanggale=date('Y-m-d');
                            $query = mysqli_query($koneksi, "select * from absen_guru WHERE tanggal='$tanggale'");
                            $no = 0;
                            while ($absen = mysqli_fetch_array($query)) {
								$nama=fetch($koneksi,'pengawas',['id_pengawas' =>$absen['guru']]);
							$tanggal=date('d-m-Y',strtotime($absen['tanggal']));
                                $no++;
                              
                            ?>
                                <tr>
                                    <td><?= $no; ?></td>
                                    <td><?= $nama['nama'] ?></td>
                                    <td><?= $tanggal ?></td>
                                    <td><label class="btn btn-sm btn-success">Hadir Jam : <?= $absen['masuk'] ?></label>
                                    <label class="btn btn-sm btn-danger">Pulang Jam : <?= $absen['keluar'] ?></label></td>
									
										</tr>
                            <?php }
                            ?>
			               </tbody>
                    </table>
					</div>
				</div>
			

<?php            
            if (isset($_POST['submit'])) {
                $guru = $_POST['guru'];
				$tgl = $_POST['tgl'];
                $hadir = $_POST['hadir'];
				$bulan=date('m');
				$tahun=date('Y');
				$masuk=date('H:i:s');

$cekdata = "SELECT * FROM absen_guru WHERE tanggal='$tgl' AND status='1'  AND guru='$guru'";
$jikaada = mysqli_query($koneksi,$cekdata);
if(mysqli_num_rows($jikaada)>0){
	mysqli_query($koneksi,"UPDATE absen_guru SET keluar='$masuk', status='1' WHERE guru='$guru'");
	echo "
	  <script type='text/javascript'>
		setTimeout(function () { 	
			swal({
				title: 'Sukses !!!',
				text:  'Absen Pulang Sudah Tercatat',
				type: 'success',
				timer: 2000,
				showConfirmButton: true
			});		
		},10);	
		window.setTimeout(function(){ 
			window.location.replace('?pg=abmanual');
		} ,2000);	
	  </script>";
		
	}else{

mysqli_query($koneksi,"INSERT INTO absen_guru(guru,tanggal,masuk,status,idqr,ket) values('$guru','$tgl','$masuk','1','1','$hadir')");
if($koneksi){
echo"

	  <script type='text/javascript'>
		setTimeout(function () { 	
			swal({
				title: 'Sukses !!!',
				text:  'Absen Masuk Sudah Tercatat',
				type: 'success',
				timer: 2000,
				showConfirmButton: true
			});		
		},10);	
		window.setTimeout(function(){ 
			window.location.replace('?pg=abmanual');
		} ,2000);	
	  </script>";
                }
            }
			}
            ?>