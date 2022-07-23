  <div class='row'>
        <div class='col-md-12'>
            <div class='box box-solid'>
                <div class='box-header with-border '>
                    <h3 class='box-title'><i class="fas fa-graduation-cap fa-fw   "></i> Biodata Siswa</h3>
                    <div class='box-tools pull-right'>
				  
		  </div>
         </div>
           
           <div class='box-body'>
                    <div class='table-responsive'>
                        <table style="font-size: 11px" id='example1' class='table table-bordered table-striped'>
                            <thead>
                            <tr>
                                <tr>
                                    <th width='3px'></th>
                                    <th>NIS</th>
                                    <th>NISN</th>
                                    <th>Nama</th>
                                    <th>Tmp Lahir</th>
                                    <th>Tgl Lahir</th>
                                    <th>Kelamin</th>
									 <th>Kelas</th>
									 <th>Photo</th>
									 <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $query = mysqli_query($koneksi, "select * from siswa_rapor ");
                            $no = 0;
                            while ($siswa = mysqli_fetch_array($query)) {
							
                                $no++;
                              
                            ?>
                                <tr>
                                    <td><?= $no; ?></td>
                                    <td><?= $siswa['nis'] ?></td>
									 <td><?= $siswa['nisn'] ?></td>
                                    <td><?= $siswa['nama'] ?></td>
                                    <td><?= $siswa['tempat'] ?></td>
									<td><?= $siswa['tgl_lahir'] ?></td>
									<td><?= $siswa['jk'] ?></td>
									<td><?= $siswa['kelas'] ?></td>
                                    <td>
									<?php if($siswa['photo']<>''){ ?>
									<img src="../foto/<?= $siswa['photo'] ?>" width="50" >
									<?php }else{ ?>
									<img src="../dist/img/avatar.png" width="50" >
									<?php } ?>
									</td>
									<td>
									<center>
									 <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modaledit<?= $siswa['id_tugas'] ?>" title='Ubah Photo' >
                                                    <i class="fas fa-edit    "></i>
                                                </button></center>
									</td>
									<div class="modal fade" id="modaledit<?= $siswa['id_tugas'] ?>" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                                        <div class="modal-dialog modal-md" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">

                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form method="post" action="" enctype="multipart/form-data">
                                                    <div class="modal-body">
                                                        <input type="hidden" value="<?= $siswa['id'] ?>" name='id'>
                                                        
                                                        <div class="form-group">
														 <label>Nama</label>
                                                            <input type="text" class="form-control" value="<?= $siswa['nama'] ?>" readonly>
                                                        </div>
                                                        <div class="form-group">
														 <label>NIS</label>
                                                             <input type="text" class="form-control" value="<?= $siswa['nis'] ?>" readonly>
                                                        </div>
                                                        <div class='form-group'>
															 <label>Kelas</label>                                                             
                                                                      <input type="text" class="form-control" value="<?= $siswa['kelas'] ?>" readonly>
                                                                </div>
                                                                <div class='form-group'>
                                                                    <label>Kelamin</label>
                                                                   <input type="text" class="form-control" value="<?= $siswa['jk'] ?>" readonly>
                                                                </div>
                                                      
                                                        <div class="form-group">
                                                            <label for="file">Upload Photo</label>
                                                           <input name="MAX_FILE_SIZE" type="hidden" value="3000000" />  
	                                                       <input name="file" class="form-control" type="file" accept="image/*" capture / required>
                                                        </div>
                                                    </div>
                                                    <div class='modal-footer'>
                       <div class='box-tools pull-right btn-group'>
                          <button type='submit'  name="gantiphoto" class='btn btn-sm btn-primary'><i class='fa fa-check'></i> Simpan</button>
                              <button type='button' class='btn btn-default btn-sm pull-left' data-dismiss='modal'>Close</button>
                                </div>
                                 </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
									
									
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
 <?php            
            if (isset($_POST['gantiphoto'])) {
				function compressImage($source, $destination, $quality) { 
   
    $imgInfo = getimagesize($source); 
    $mime = $imgInfo['mime']; 
  
    switch($mime){ 
        case 'image/jpeg': 
            $image = imagecreatefromjpeg($source); 
            break; 
        case 'image/png': 
            $image = imagecreatefrompng($source); 
            break; 
        case 'image/gif': 
            $image = imagecreatefromgif($source); 
            break; 
        default: 
            $image = imagecreatefromjpeg($source); 
    } 
	 imagejpeg($image, $destination, $quality); 
     
   
    return $destination; 
} 
				$foto = $_FILES['file']['name'];
	$tmp = $_FILES['file']['tmp_name'];
	$fotobaru = date('dmYHis').$foto;
	$path = "../foto/".$fotobaru;
      $id = $_POST['id'];
				
	$query = "SELECT * FROM siswa_rapor WHERE id='".$id."'";
		$sql = mysqli_query($koneksi, $query); 
		$data = mysqli_fetch_array($sql);

		if(is_file("../foto/".$data['photo'])) 
			unlink("../foto/".$data['photo']); 
		 $compressedImage = compressImage($tmp, $path, 32);
	mysqli_query($koneksi,"UPDATE siswa_rapor SET photo='$fotobaru' WHERE id='$id'");
	echo "
	  <script type='text/javascript'>
		setTimeout(function () { 	
			swal({
				title: 'Sukses !!!',
				text:  'Photo Profil Berhasil diubah',
				type: 'success',
				timer: 2000,
				showConfirmButton: true
			});		
		},10);	
		window.setTimeout(function(){ 
			window.location.replace('?pg=biodata');
		} ,2000);	
	  </script>";
	
			}
            ?>