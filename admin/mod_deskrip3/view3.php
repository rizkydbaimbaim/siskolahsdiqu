<?php defined('BASEPATH') or die("ip anda sudah tercatat oleh sistem kami") ?>
<?php
$mapel=$_GET['mapel'];
$kelas=$_GET['kelas'];
?>
<div class="section-header">
    <div class='row'>
        <div class='col-md-12'>
            <div class='box box-solid'>
                <div class='box-header with-border '>
                    <h3 class='box-title' style="color: red"> <?= $mapel ?> (KI-3)</h3>
                    <div class='box-tools pull-right'>
				   <a href="?pg=deskrip3" class="btn btn-sm btn-primary btn-rounded" >
                                          <i class="fas fa-home"></i> Kembali</button></a>
		  </div>
         </div>
            <div class='box-body'>
                   <div class='table-responsive'>
                        <table style="font-size: 11px" id='tabeldeskrip' class='table table-bordered table-striped'>
                            <thead>
                            <tr>
                             <th width="5%" class="text-center">
                                    #
                                </th>
                                <th>Deskripsi</th>
							<th width="5%">Edit</th>
							<th width="5%">Hapus</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $query = mysqli_query($koneksi, "select * FROM deskripsi_3  WHERE mapel='$mapel' AND kelas='$kelas'");
                            $no = 0;
                            while ($des = mysqli_fetch_array($query)) {
                                $no++;
                            ?>
                                <tr>
                                    <td><?= $no; ?></td>
                                    <td><?= $des['deskripsi'] ?></td>
                                    <td>
                                       <button type="button" class="btn btn-sm btn-primary btn-rounded" data-toggle="modal" data-target="#modal-des<?= $no ?>">
                                          <i class="fas fa-edit"></i>
                                        </button>
										   </td>
                                    <td>
									 <button data-id="<?= $des['id'] ?>" class="hapus btn-sm btn btn-danger"><i class="fas fa-trash    "></i></button>
										</td>
										   
                                </tr>
								
							<div class="modal fade" id="modal-des<?= $no ?>" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    
                                                        <div class="modal-header bg-blue">
                                                            <h5 class="modal-title"></h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
														<form id="form-des<?= $no ?>" >
                                                        <div class="modal-body">
                                                            <input type="hidden" value="<?= $des['id'] ?>" name="id" class="form-control" >
                                                            <div class="form-group">
                                                                <label>Deskripsi</label>
                                                                <textarea name='deskripsi' style='height:300px' class='form-control' required><?= $des['deskripsi'] ?></textarea>
                                                            </div>
                                                            
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                                        </div>
                                                    </form>	
								  </div>
								    </div>
									  </div>
                                <script>
                                    $('#form-des<?= $no ?>').submit(function(e) {
                                        e.preventDefault();
                                        $.ajax({
                                            type: 'POST',
                                            url: 'mod_deskrip3/crud_deskripsi.php?pg=ubah',
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
                                                    $('#modal-edit<?= $no ?>').modal('hide');
                                                } else {
                                                    iziToast.error({
                                                        title: 'Maaf!',
                                                        message: 'Data Gagal diperbarui',
                                                        position: 'topRight'
                                                    });
                                                }
                                                //$('#bodyreset').load(location.href + ' #bodyreset');
                                            }
                                        });
                                        return false;
                                    });
                                </script>
                            <?php }
                            ?>


                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $('#tabeldeskrip').on('click', '.hapus', function() {
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
                    url: 'mod_deskrip3/crud_deskripsi.php?pg=hapus',
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