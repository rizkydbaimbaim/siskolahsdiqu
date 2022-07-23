<?php
defined('APLIKASI') or exit('Anda tidak dizinkan mengakses langsung script ini!');
?>
<?php if ($ac == '') : ?>
    <div class='row'>
        <div class='col-md-12'>
            <div class='box box-solid'>
                <div class='box-header with-border '>
                    <h3 class='box-title'><i class="fas fa-user-friends fa-fw   "></i> Kandidat Ketua Osis</h3>
                    <div class='box-tools pull-right'>
                        <a href="?pg=hasil" class="btn btn-info" ><i class="fas fa-users "></i> Hasil
                        </button></a>
                                <a data-toggle='modal' data-backdrop="static" data-target='#tambahsiswa' class='btn btn-sm btn-primary'><i class='glyphicon glyphicon-plus'></i> <span class='hidden-xs'>Tambah</span></a>
                            
                    </div>
                </div><!-- /.box-header -->
                <div class='box-body'>
                    <div class='table-responsive'>
                        <table style="font-size: 11px" id='tabelsiswa' class='table table-bordered table-striped'>
                            <thead>
                                <tr>
                                    <th width='3%'>#</th>
                                    <th width='15%'>Nama Kandidat</th>
                                    <th width='5%'>No Urut </th>
                                    <th>Visi</th>
                                    <th>Misi</th>
                                     <th width='10%'> Photo</th>
                                     <th width='5%'>Hapus</th>
                                       
                                </tr>
                            </thead>
							 <tbody>
                            <?php
							$no=0;
							$query = mysqli_query($koneksi, "select * FROM kandidat");
							 while ($kandidat = mysqli_fetch_array($query)) {
							$siswa=fetch($koneksi,'siswa',['id_siswa'=>$kandidat['idsiswa']]);
							 $no++;
                            ?>
                                <tr>
                                    <td><?= $no; ?></td>
                                    <td><?= $siswa['nama'] ?></td>
                                    <td><?= $kandidat['nomor'] ?></td>
								<td><?= $kandidat['visi'] ?></td>
                                    <td><?= $kandidat['misi'] ?></td>
							<td><center><img src='../berkas/<?= $kandidat['gambar'] ?>' width="50"></center></td>
							<td>
							
                                <a class="btn btn-flat btn-xs bg-maroon hapus" data-id="<?= $kandidat['id'] ?>" ><i class="fa fa-trash"></i></a>
                           </td>
						   <?php } ?>
                            


                        </tbody>
                        </table>
                    </div>
					
					
                    <div class='modal fade' id='tambahsiswa' style='display: none;'>
                        <div class='modal-dialog'>
                            <div class='modal-content'>
                                <div class='modal-header bg-blue'>
                                    <button class='close' data-dismiss='modal'><span aria-hidden='true'><i class='glyphicon glyphicon-remove'></i></span></button>
                                    <h4 class='modal-title'></h4>
                                </div>
                                <div class='modal-body'>
                                   <form method="post" action="" enctype="multipart/form-data">
                                        <div class='form-group'>
                                            <label>Nama Kandidat</label>
                                           <select name='nama' class='form-control' required='true'>
                                                        <option value='' selected>--Pilih Kandidat--</option>
                                                        <?php
                                                        $kelasQ = mysqli_query($koneksi, "SELECT * FROM siswa ORDER BY id_kelas ASC");
                                                        while ($kelas = mysqli_fetch_array($kelasQ)) {
                                                            echo "<option value='$kelas[id_siswa]'>Kelas $kelas[id_kelas] | $kelas[nama]</option>";
                                                        }
                                                        ?>
                                                    </select>
                                        </div>
                                        <div class='form-group'>
                                            <div class='row'>
                                                <div class='col-md-12'>
                                                    <label>No Urut Kandidat</label>
                                                    <select name='nomor' class='form-control' required='true'>
                                                        <option value=''>--Pilih No Urut--</option>
                                                       <option value='1'>1</option>
													   <option value='2'>2</option>
													    <option value='3'>3</option>
													    <option value='4'>4</option>
													    <option value='5'>5</option>
													    <option value='6'>6</option>
														 <option value='7'>7</option>
														  <option value='8'>8</option>
														   <option value='9'>9</option>
														    <option value='10'>10</option>
                                                    </select>
                                                </div>
                                               </div>
											    </div>
                                        <div class='row'>
                                            <div class='col-md-12'>
                                                <div class='form-group'>
                                                    <label>Photo</label>
                                                    <input type='file' name='file' class='form-control'  required />
                                                </div>
                                            </div>
                                             </div>
                                                
                                        <div class='row'>
                                            <div class='col-md-12'>
                                                <div class='form-group'>
                                                    <label>Visi</label>
                                                    <input type='text' name='visi' class='form-control' autocomplete="off" required />
                                                </div>
                                            </div>
                                             </div>
                                        <div class='form-group'>
                                            <div class='row'>
                                                <div class='col-md-12'>
                                                    <label>Misi</label>
                                                    <input type='text' name='misi' class='form-control' autocomplete="off" required />
                                              
                                        <div class='modal-footer'>
                                            <div class='box-tools pull-right btn-group'>
                                                <button type='submit' name='submit' class='btn btn-sm btn-primary'><i class='fa fa-check'></i> Simpan</button>
                                                <button type='button' class='btn btn-default btn-sm pull-left' data-dismiss='modal'>Close</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>
    </div>
	  <?php            
            if (isset($_POST['submit'])) {
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
	$path = "../berkas/".$fotobaru;
    $ids = $_POST['nama'];
	$nomor = $_POST['nomor'];
	$misi = $_POST['misi'];
	$visi = $_POST['visi'];
	$query = "SELECT * FROM kandidat WHERE idsiswa='".$ids."'";
		$sql = mysqli_query($koneksi, $query); 
		$data = mysqli_fetch_array($sql);

		if(is_file("../berkas/".$data['gambar'])) 
			unlink("../berkas/".$data['gambar']); 
		 $compressedImage = compressImage($tmp, $path, 32);
	mysqli_query($koneksi,"INSERT INTO kandidat(idsiswa,nomor,visi,misi,gambar) VALUES('$ids','$nomor','$visi','$misi','$fotobaru')");
	echo "
	  <script type='text/javascript'>
		setTimeout(function () { 	
			swal({
				title: 'Sukses !!!',
				text:  'Kandidat berhasil disimpan',
				type: 'success',
				timer: 2000,
				showConfirmButton: true
			});		
		},10);	
		window.setTimeout(function(){ 
			window.location.replace('?pg=vote');
		} ,2000);	
	  </script>";
	
			}
            ?>
<?php elseif ($ac == 'edit') : ?>
    <?php
    $id = $_GET['id'];
    $siswa = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM kandidat WHERE id='$id'"));
    ?>
    <div class='row'>
        <div class='col-md-2'></div>
        <div class='col-md-7'>
            <form id="form-edit" method='post'>
                <div class='box box-success'>
                    <div class='box-header with-border'>
                        <h3 class='box-title'>Edit</h3>
                        <div class='box-tools pull-right btn-group'>
                            <button type='submit' name='submit' class='btn btn-sm btn-success'><i class='fa fa-check'></i> Simpan</button>
                            <a href='?pg=<?= $pg ?>' class='btn btn-sm btn-danger' title='Batal'><i class='fa fa-times'></i></a>
                        </div>
                    </div><!-- /.box-header -->
                    <div class='box-body'>
                        <input type='hidden' name='idu' value="<?= $siswa['id'] ?>" />
                        
                        <div class='form-group'>
                            <label>Nama</label>
                            <input type='text' name='nama' class='form-control' value="<?= $siswa['nama'] ?>" required='true' />
                        </div>
                     
                            
                       <div class='row'>
                            <div class='col-md-12'>
                                <div class='form-group'>
                                    <label>Visi</label>
                                    <input type='text' name='visi' class='form-control' value="<?= $siswa['visi'] ?>" required='true' />
                                </div>
                            </div>
  </div>
                        <div class='row'>
                            <div class='col-md-12'>
                                <div class='form-group'>
                                    <label>Misi</label>
                                    <input type='text' name='misi' class='form-control' value="<?= $siswa['misi'] ?>" required='true' />
                                </div>
                            </div>

                      
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

<?php endif ?>

<script>
   
    $('#tabelsiswa').on('click', '.hapus', function() {
        var id = $(this).data('id');
        console.log(id);
        swal({
            title: 'Are you sure?',
            text: 'Akan menghapus data ini!',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'iya, hapus'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: 'mod_vote/crud_vote.php?pg=hapus',
                    method: "POST",
                    data: 'id=' + id,
                    success: function(data) {
                        iziToast.error({
                            title: 'Horee!',
                            message: 'Data Berhasil dihapus',
                            position: 'topRight'
                        });
                        setTimeout(function() {
                            window.location.reload();
                        }, 2000);
                    }
                });
            }
            return false;
        })

    });
</script>