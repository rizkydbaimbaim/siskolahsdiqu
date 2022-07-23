<?php defined('BASEPATH') or die("ip anda sudah tercatat oleh sistem kami") ?>
<div class="section-header">
   


</div>

 <div class='row'>
        <div class='col-md-12'>
            <div class='box box-solid'>
                <div class='box-header with-border '>
                    <h3 class='box-title'><i class="fas fa-user-friends fa-fw   "></i> Catatan</h3>
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
                                <th width="5%" class="text-center">
                                    #
                                </th>
                                <th width="20%">Nis</th>
                                <th>Nama Siswa</th>
								<th width="50%">Catatan Wali Kelas</th>
								
							<th width="5%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $query = mysqli_query($koneksi, "select * from siswa WHERE id_kelas='$_GET[kelas]' order by id_siswa ASC");
                            $no = 0;
                            while ($siswa = mysqli_fetch_array($query)) {
                                $no++;
                            ?>
                                <tr>
                                    <td><?= $no; ?></td>
                                    <td><?= $siswa['nis'] ?></td>
                                    <td><?= $siswa['nama'] ?></td>
									<td><?= $siswa['catatan'] ?></td>
									
                                     <td>
										<button type="button" class="btn btn-sm btn-danger btn-rounded" data-toggle="modal" data-target="#modal-des<?= $no ?>">
                                            <i class="fas fa-edit"></i>
                                        </button>
										</td>
									
                                  <div class="modal fade" id="modal-des<?= $no ?>" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <form id="form-des<?= $no ?>">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Catatan <?= $siswa['nama'] ?></h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <input type="hidden" value="<?= $siswa['id_siswa'] ?>" name="idd" class="form-control" >
                                                            <div class="form-group">
                                                                <label>Nama Siswa</label>
                                                                <input type="text" name="nama" value="<?= $siswa['nama'] ?>" class="form-control" readonly="">
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Catatan</label>
                                                                <input type="text" name="catat" value="<?= $siswa['catatan'] ?>" class="form-control" >
                                                            </div>
                                                            
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-primary">Save</button>
                                                        </div>
                                                    </form>
                                           

<script>
  $('#form-des<?= $no ?>').submit(function(e) {
                                        e.preventDefault();
                                        $.ajax({
                                            type: 'POST',
                                            url: 'mod_walas/crud_walas.php?pg=catat',
                                            data: $(this).serialize(),
                                            success: function(data) {
                                                if (data == 'OK') {
                                                    iziToast.success({
                                                        title: 'OKee!',
                                                        message: 'Data Berhasil diubah',
                                                        position: 'topRight'
                                                    });
                                                    setTimeout(function() {
                                                        window.location.reload();
                                                    }, 2000);
                                                    $('#modal-des<?= $no ?>').modal('hide');
                                                } else {
                                                    iziToast.error({
                                                        title: 'Maaf!',
                                                        message: 'Data Gagal diubah',
                                                        position: 'topRight'
                                                    });
                                                }

                                                //$('#bodyreset').load(location.href + ' #bodyreset');
                                            }
                                        });
                                        return false;
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
       </div>
	   </div>
				
	
		