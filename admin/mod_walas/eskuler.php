<?php defined('BASEPATH') or die("ip anda sudah tercatat oleh sistem kami") ?>
<div class="section-header">
   


</div>

 <div class='row'>
        <div class='col-md-12'>
            <div class='box box-solid'>
                <div class='box-header with-border '>
                    <h3 class='box-title'><i class="fas fa-user-friends fa-fw   "></i> Ekstrakurikuler</h3>
                    <div class='box-tools pull-right'>
					  <a href="?pg=datawalas" class="btn btn-sm btn-primary btn-rounded" >
                                          <i class="fas fa-home"></i> Kembali</button></a>		
		  </div>
			
 </div>
            <div class='box-body'>
                    <div class='table-responsive'>
                      <table id='tabelwalas' class='table table-bordered table-striped'>
                            <thead>
                            <tr>
                                <th width="2%" class="text-center">
                                    #
                                </th>
                                <th width="7%">Nis</th>
                                <th width="10%">Nama Siswa</th>
								<th>Kegiatan Ekstrakurikuler</th>
								<th>Keterangan</th>
								<th width="4%">Nilai</th>
							<th width="10%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $query = mysqli_query($koneksi, "select * from siswa WHERE id_kelas='$_GET[kelas]' order by id_siswa ASC");
                            $no = 0;
                            while ($siswa = mysqli_fetch_array($query)) {
							$eskul=fetch($koneksi,'eskul',['nis' =>$siswa['nis']]);
                                $no++;
                            ?>
                                <tr>
                                    <td><?= $no; ?></td>
                                    <td><?= $siswa['nis'] ?></td>
                                    <td><?= $siswa['nama'] ?></td>
									<td><?= $eskul['ekstra'] ?> </td>
									<td><?= $eskul['ket'] ?></td>
									<td><?= $eskul['nilai'] ?></td>
                                     <td>
										<button type="button" class="btn btn-sm btn-primary btn-rounded" data-toggle="modal" data-target="#modal-des<?= $no ?>">
                                              <i class="fas fa-edit"></i>
                                        </button>
										 <button data-id="<?= $eskul['id'] ?>" class="hapus btn-sm btn-rounded btn btn-danger"> <i class="fas fa-trash"></i></button>

										</td>
									
 <div class="modal fade" id="modal-des<?= $no ?>" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <form id="form-des<?= $no ?>">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title"> EKSTRAKURIKULER</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
														 <form role="form"  method="POST">
                                                        <div class="modal-body">
														
                                                            <input type="hidden" value="<?= $eskul['id'] ?>" name="idd" class="form-control" >
                                                            <div class="form-group">
                                                                <label><b>Nama Siswa</b></label>
                                                               <input type="hidden" name="nis" value="<?= $siswa['nis'] ?>"> <input type="text" name="nama" value="<?= $siswa['nama'] ?>" class="form-control" readonly="">
                                                            </div>
                                                            <div class="form-group">
                                                                <label><b>Pilihan Ekstrakurikuler </b></label>
                                                                <select name='ekstra' class="form-control" style="width: 100%; height:36px;" required>
                                             <option value=''></option>
                                           <?php

                                           $edi=$koneksi->query("SELECT * FROM m_eskul ORDER BY id ASC");
                                            while($p=mysqli_fetch_assoc($edi)){
                                            echo "<option value='$p[ekstra]'>$p[ekstra]</option>";
                                                 }
                                                    ?>
												</select>
                                                            </div>
                                                            
															 <div class="form-group">
                                                                <label><b>Nilai</b></label>
                                                                <select name='nilai' class="form-control" style="width: 100%; height:36px;" required>
                                         
                                           <option value=''></option>
                                           <option value='A'>Sangat Baik</option>
									<option value='B'>Baik</option>
									<option value='C'>Cukup</option>
									
												</select>
                                                            </div>
															 <div class="form-group">
                                                                <label><b>Keterangan</b></label>
                                                        <input type="text" name="ket"  class="form-control" >         
                                                            </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                            <button type="submit" name="simpan" class="btn btn-primary">Save</button>
                                                        </div>
                                                   </form>
												   
 </div>
  </div>
													<script>
        $('#form-des<?= $no ?>').submit(function(e) {
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: 'mod_walas/crud_walas.php?pg=tambaheskul',
            data: $(this).serialize(),
            success: function(data) {
                if (data == 'OK') {
                    iziToast.success({
                        title: 'Mantap!',
                        message: 'Data Berhasil ditambahkan',
                        position: 'topRight'
                    });
                    setTimeout(function() {
                        window.location.reload();
                    }, 2000);
                    $('#editdata').modal('hide');
                } else {
                    iziToast.error({
                        title: 'Maaf!',
                        message: 'Data Gagal disimpan',
                        position: 'topRight'
                    });
                }
                //$('#bodyreset').load(location.href + ' #bodyreset');
            }
        });
        return false;
    });
	
	 $('#tabelwalas').on('click', '.hapus', function() {
        var id = $(this).data('id');
        console.log(id);
        swal({
            title: 'Are you sure?',
            text: 'Akan menghapus data ini!',
            icon: 'warning',
            buttons: true,
            dangerMode: true,
        }).then((result) => {
            if (result) {
                $.ajax({
                    url: 'mod_walas/crud_walas.php?pg=hapuseskul',
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
        })

    });
	
	
</script>
                 
				<?php
                                    }
                                    ?>
                                </tr>
                        </tbody>
                    </table>
					</div>
					
		
	   </div>
		  <div class="modal fade" id="modal-eskul" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <form id="form-eskul">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">TAMBAH DATA EKSTRAKURIKULER</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
														 <form role="form"  method="POST">
                                                        <div class="modal-body">
														
                                                            
															 <div class="form-group">
                                                                <label><b>Nama Ekstrakurikuler</b></label>
                                                        <input type="text" name="ekstra"  class="form-control" >         
                                                            </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                            <button type="submit" name="simpan" class="btn btn-primary">Save</button>
                                                        </div>
                                                   </form>
          </div>
		 </div>
		  </div>
		   <script>
		    $('#form-eskul').submit(function(e) {
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: 'mod_sikap/crud_sikap.php?pg=tambahdataeskul',
            data: $(this).serialize(),
            success: function(data) {
                if (data == 'OK') {
                    iziToast.success({
                        title: 'Mantap!',
                        message: 'Data Berhasil ditambahkan',
                        position: 'topRight'
                    });
                    setTimeout(function() {
                        window.location.reload();
                    }, 2000);
                    $('#tambahdata').modal('hide');
                } else {
                    iziToast.error({
                        title: 'Maaf!',
                        message: 'Data Gagal ditambahkan',
                        position: 'topRight'
                    });
                }
                //$('#bodyreset').load(location.href + ' #bodyreset');
            }
        });
        return false;
    });
	
	
</script>