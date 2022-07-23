<?php
defined('APLIKASI') or exit('Anda tidak dizinkan mengakses langsung script ini!');
?>

    <div class='col-md-6'>
        <div class='box box-solid'>
            <div class='box-header with-border'>
                <h3 class='box-title'><i class="fas fa-edit    "></i> Absen Daring</h3>
            </div><!-- /.box-header -->
            <div class='box-body'>
	<form id="form-profil">
            <div class="card-body">
                    <div class="row">
						<div class="col-md-6">
                                <div class="form-group">
								<?php
								$tgl=date('Y-m-d');
                            $query = mysqli_query($koneksi, "select * FROM absen_daring WHERE idsiswa='$_SESSION[id_siswa]' AND tanggal='$tgl' ORDER BY id DESC ");  
                            $absen = (mysqli_fetch_array($query));
                               
                            ?>
							<?php if($absen['idsiswa']<>'' AND $absen['tanggal']==$tgl){ ?>
							 <center> <label><h3>Sudah Absen</h3></label></center><br>
                      <center><img src="tugas/<?= $absen['gambar'] ?>" width="200"></center>
					  <?php } ?>
					  <?php if($absen['idsiswa']=='' AND $absen['tanggal']<>$tgl){ ?>
                       <center> <label><h3>Belum Absen</h3></label></center><br>
                      <center><img src="dist/img/avatar.png" width="200"></center>
					  <?php } ?>
						
                    </div>
					</div>
					<div class="col-md-6">
					<div class="form-group">
                        <label>Ambil Photo</label>
                      <input name="MAX_FILE_SIZE" type="hidden" value="3000000" />  
	                                  <input name="file" class="form-control" type="file" accept="image/*" capture / required>
                    </div>
					</div>
					</div>
					<div class="modal-footer">
                  <button type="submit" class="btn btn-primary">Kirim Absen</button>
                </div>
                    </form>
            </div>
              </div>
            </div>
        </div>
 
<script>
   $('#form-profil').submit(function(e) {
        e.preventDefault();
        var data = new FormData(this);
        var homeurl = '<?= $homeurl ?>';

        $.ajax({
            type: 'POST',
            url: homeurl + '/simpanabsen.php',
            enctype: 'multipart/form-data',
            data: data,
            cache: false,
            contentType: false,
            processData: false,
            success: function(data) {

                if (data = 'ok') {
                    toastr.success("absen berhasil dikirim");
setTimeout(function() {
                                        window.location.reload();
                                    }, 2000);
                                
                } else {
                    toastr.error("absen gagal dikirim");
                }


            }
        });
        return false;
    });
</script>
