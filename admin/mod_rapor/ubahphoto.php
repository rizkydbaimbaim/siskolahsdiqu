<?php
$id= $_GET['id'];
$gambar = fetch($koneksi, 'siswa_rapor', ['id' => $id]);
?>

<div class='row'>
        <div class='col-md-12'>
            <div class='box box-solid'>
                <div class='box-header with-border '>
                    <h3 class='box-title'><i class="fas fa-user-friends fa-fw   "></i> Data Siswa</h3>
                    <div class='box-tools pull-right'>
                    </div>
                </div><!-- /.box-header -->
                <div class='box-body'>
			<form method="post" action="" enctype="multipart/form-data">
                        <input type="hidden" name="id" value='<?= $gambar['id'] ?>' class="form-control" required>
                  
				 <div class='modal-body'>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                   <label>Nama</label>
                                        <input type="text" name="nama" value='<?= $gambar['nama'] ?>' class="form-control" readonly>
                    </div>
                        </div>
						
                    <div class="col-md-6">
                       <div class='form-group'>
                        <label>Kelas</label>
                         <input type="text" name="ket" value='<?= $gambar['kelas'] ?>' class="form-control" readonly>
                    </div>
					</div>
					
					<div class="col-md-6">
                       <div class='form-group'>
                        <label></label>
						<?php if($gambar['photo']==''){ ?>
						<img src="../dist/img/avatar.png" width="100">
						<?php }else{ ?>
                        <img src="../photo/<?= $gambar['photo'] ?>" width="100">
						<?php } ?>
                    </div>
					</div>
					<div class="col-md-6">
                       <div class='form-group'>
                        <label>Photo</label>
					 <input type="file" name="file" class="form-control" required>
					 </div>
					</div>
					</div>
						
                <div class="modal-footer">
                  <input type="submit" name="simpan" class="btn btn-primary" value="Simpan">
                </div>
            </form>
        </div>
    </div>
</div>

   <?php
if(isset($_POST['simpan'])){ 
	$id = $_POST['id'];
  
	$foto = $_FILES['file']['name'];
	$tmp = $_FILES['file']['tmp_name'];
	$fotobaru = date('dmYHis').$foto;
	$path = "../foto/fotosiswa/".$fotobaru;

	if(move_uploaded_file($tmp, $path)){ 
		$query = "SELECT * FROM siswa_rapor WHERE id='".$id."'";
		$sql = mysqli_query($koneksi, $query); 
		$data = mysqli_fetch_array($sql);

		if(is_file("../foto/fotosiswa/".$data['foto'])) 
			unlink("../foto/fotosiswa/".$data['foto']); 
		
		$query = "UPDATE siswa_rapor SET  photo='".$fotobaru."' WHERE id='".$id."'";
		$sql = mysqli_query($koneksi, $query); 

		if($sql){ 
			echo "
	
	  <script type='text/javascript'>
		setTimeout(function () { 	
			swal({
				title: 'Berhasil !!!',
				text:  'Data berhasil di ubah',
				type: 'success',
				timer: 2000,
				showConfirmButton: true
			});		
		},10);	
		window.setTimeout(function(){ 
			window.location.replace('?pg=siswar');
		} ,2000);	
	  </script>";
		
		}else{
			echo "
	  <script type='text/javascript'>
		setTimeout(function () { 	
			swal({
				title: 'Gagal !!!',
				text:  'Data gagal di ubah',
				type: 'error',
				timer: 2000,
				showConfirmButton: true
			});		
		},10);	
		window.setTimeout(function(){ 
			window.location.replace('?pg=siswar');
		} ,2000);	
	  </script>";
		}
	
	}

}
?>
