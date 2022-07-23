<?php defined('BASEPATH') or die("ip anda sudah tercatat oleh sistem kami") ?>
<div class='row'>
        <div class='col-md-12'>
            <div class='box box-solid'>
                <div class='box-header with-border '>
                    <h3 class='box-title'><i class="fas fa-user-friends fa-fw   "></i> Nilai Sikap Spiritual</h3>
                    <div class='box-tools pull-right'>
				<a href="?pg=nk3" class="btn btn-sm btn-primary btn-rounded" >
                                          <i class="fas fa-home"></i> Kembali</button></a>
		  </div>
  </div>
            <div class='box-body'>
                    <div class='table-responsive'>
                      <table id='tabelsikap' class='table table-bordered table-striped'>
                            <thead>
                            <tr>
                                <th width="2%" class="text-center">
                                    #
                                </th>
                                <th width="7%">Nis</th>
                                <th width="10%">Nama Siswa</th>
								<th>Selalu Dilakukan</th>
								<th>Mulai Berkembang</th>
								<th width="4%">Pred</th>
							<th width="15%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $query = mysqli_query($koneksi, "select * from siswa WHERE id_kelas='$_GET[kelas]' ");
                            $no = 0;
                            while ($siswa = mysqli_fetch_array($query)) {
							$spi=fetch($koneksi,'spiritual',['niss' =>$siswa['nis']]);
                                $no++;
                            ?>
                                <tr>
                                    <td><?= $no; ?></td>
                                    <td><?= $siswa['nis'] ?></td>
                                    <td><?= $siswa['nama'] ?></td>
									<td><?= $spi['keter'] ?> </td>
									<td><?= $spi['keter2'] ?></td>
									<td><?= $spi['pred'] ?></td>
                                     <td>
									 <?php if($spi['niss']<>''){ ?>
										<button type="button" class="btn btn-sm btn-warning btn-rounded" data-toggle="modal" data-target="#modal-des<?= $no ?>" disabled>
                                             Input Nilai
                                        </button>
									 <?php }else{ ?>
									 <button type="button" class="btn btn-sm btn-primary btn-rounded" data-toggle="modal" data-target="#modal-des<?= $no ?>" >
                                             Input Nilai
                                        </button>
									 <?php } ?>
										 <button data-id="<?= $spi['ids'] ?>" class="hapus btn-sm btn-rounded btn btn-danger">Hapus</button>
										</td>
									
                                         <div class="modal fade" id="modal-des<?= $no ?>" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                   
                                                        <div class="modal-header bg-green">
                                                            <h5 class="modal-title"> SIKAP SPIRITUAL</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
														 <form action='' method='post'>
														  <input type="hidden" name="kelas" value="<?= $_GET['kelas'] ?>"> 
														   <input type="hidden" name="id" value="<?= $siswa['ids'] ?>"> 
                                                        <div class="modal-body">
                                                            <div class="form-group">
                                                                <label><b>Nama Siswa</b></label>
                                                               <input type="hidden" name="nis" value="<?= $siswa['nis'] ?>"> <input type="text" name="nama" value="<?= $siswa['nama'] ?>" class="form-control" readonly="">
                                                            </div>
                                                            <div class="form-group">
                                                                <label><b>Yang selalu dilakukan </b></label>
                                                                <select name='ket1' class="form-control" style="width: 100%; height:36px;" required>
                                             <option value=''></option>
                                           <?php

                                           $edi=$koneksi->query("SELECT * FROM m_spiritual ORDER BY id ASC");
                                            while($p=mysqli_fetch_assoc($edi)){
                                            echo "<option value='$p[ket]'>$p[ket]</option>";
                                                 }
                                                    ?>
												</select>
                                                            </div>
                                                            
															 <div class="form-group">
                                                                <label><b>Sedang Berkembang</b></label>
                                                                <select name='ket2' class="form-control" style="width: 100%; height:36px;" required>
                                             <option value=''></option>
                                           <?php

                                           $edi3=$koneksi->query("SELECT * FROM m_spiritual ORDER BY id DESC");
                                            while($p3=mysqli_fetch_assoc($edi3)){
                                            echo "<option value='$p3[ket]'>$p3[ket]</option>";
                                                 }
                                                    ?>
												</select>
                                                            </div>
															 <div class="form-group">
                                                                <label><b>Predikat</b></label>
                                                                <select name='pred' class="form-control" style="width: 100%; height:36px;" required>
                                         
                                           <option value=''></option>
                                           <option value='A'>A</option>
									<option value='B'>B</option>
									<option value='C'>C</option>
									<option value='D'>D</option>
												</select>
                                                            </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                            <button type="submit" name="simpan" class="btn btn-primary">Save</button>
                                                        </div>
                                                   </form>
				<?php
                                    }
                                    ?>
                                </tr>
                        </tbody>
                    </table>
					</div>
           </div>
		   </div>
		   </div>
		   
		   <?php
            
            if (isset($_POST['simpan'])) {
				$kelas=$_POST['kelas'];
                $nis = $_POST['nis'];
                $ket1 = $_POST['ket1'];
               $ket2 = $_POST['ket2'];
                $pred = $_POST['pred'];
               
                if ($ket1 <> '' and $ket2 <> '') {
                    if ($ket1 == $ket2) {
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
			window.location.replace('?pg=nilaispiritual&kelas=$kelas');
		} ,2000);	
	  </script>";
                    
					} else {   
		 $exec = mysqli_query($koneksi, "INSERT INTO spiritual VALUES('','$nis','$ket1','$ket2','$pred')");			   
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
			window.location.replace('?pg=nilaispiritual&kelas=$kelas');
		} ,2000);	
	  </script>";
				   }
                }
            }
            ?>
	
		   
		   
		   
		   
		   
		   
		   
	   <script>
  $('#tabelsikap').on('click', '.hapus', function() {
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
                    url: 'mod_sikap/crud_sikap.php?pg=hapusspi',
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
          
