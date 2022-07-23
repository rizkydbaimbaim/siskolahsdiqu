<?php defined('BASEPATH') or die("ip anda sudah tercatat oleh sistem kami") ?>
<div class='row'>
        <div class='col-md-12'>
            <div class='box box-solid'>
                <div class='box-header with-border '>
                    <h3 class='box-title'><i class="fas fa-edit fa-fw   "></i> QR CODE</h3>
                    <div class='box-tools pull-right'>
				   
		  </div>
         </div>
            <div class='box-body'>
            
                <div class="table-responsive">
                    <table class="table table-striped" id="table-1">
                        <thead>
                            <tr>
                                <th class="text-center" width="5%">
                                    #
                                </th>
                                <th width="10%">QR Code</th>
                                <th>Keterangan</th>
                            
                                <th width="10%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $query = mysqli_query($koneksi, "select * from setting");
                            $no = 0;
                            while ($qr = mysqli_fetch_array($query)) {
                                $no++;
                            ?>
                                <tr>
                                    <td><?= $no; ?></td>
                                    <td>  <img class="img" src="../temp/<?= $qr['qrkode'] ?>.png" height="50"> <?= $qr['kode'] ?></td>
                                    <td><?= $qr['qrkode'] ?></td>
                                   
                                    <td>
                                      
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-edit<?= $no ?>">
                                           <i class="fas fa-edit"></i>
                                        </button>
                                         <a target="_blank" href="mod_mbs/cetakqr.php?kode=<?= $qr['qrkode'] ?>" class="btn btn-danger">
                                           <i class="fas fa-print"></i>
                                        </button></a>
                                       
                                        <div class="modal fade" id="modal-edit<?= $no ?>" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                                            <div class="modal-dialog modal-md" role="document">
                                                <div class="modal-content">
                                                    <form id="form-edit<?= $no ?>">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Edit Data</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                           
                                                            <div class="form-group">
                                                                <label>Kode QR</label>
                                                                <input type="text" name="kode" value="<?= $qr['qrkode'] ?>" class="form-control" autocomplete="off" required="">
                                                            </div>
                                                           
                                                            
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-md btn-rounded btn-secondary" data-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-md btn-rounded btn-primary">Save</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <script>
                                    $('#form-edit<?= $no ?>').submit(function(e) {
                                        e.preventDefault();
                                        $.ajax({
                                            type: 'POST',
                                            url: 'mod_qr/crud_qr.php?pg=ubah',
                                            data: $(this).serialize(),
                                            success: function(data) {

                                                iziToast.success({
                                                    title: 'OKee!',
                                                    message: 'Data Berhasil diubah',
                                                    position: 'topRight'
                                                });
                                                setTimeout(function() {
                                                    window.location.reload();
                                                }, 2000);
                                                $('#modal-edit<?= $no ?>').modal('hide');
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
