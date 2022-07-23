<?php
defined('APLIKASI') or exit('Anda tidak dizinkan mengakses langsung script ini!');
?>
<?php $namamu = fetch($koneksi,'siswa',['id_siswa' => $_SESSION['id_siswa']]); ?>
    <div class='col-md-6'>
        <div class='box box-solid'>
            <div class='box-header with-border'>
                <h3 class='box-title'><i class="fas fa-edit    "></i> INFORMASI</h3>
            </div><!-- /.box-header -->
            <div class='box-body'>
	<form id="form-profil">
            <div class="card-body">
                    <div class="row">
						<div class="col-md-12">
                                <div class="form-group">
								 
								 <b>Tugas Yang Belum Dikerjakan Ananda <?= $namamu['nama'] ?></b>
								<?php
								$no=0;
								
                            $query = mysqli_query($koneksi, "select * FROM tugas");  
                            while ($tugas = mysqli_fetch_array($query)){
                             $info=fetch($koneksi,'jawaban_tugas',['id_tugas'=>$tugas['id_tugas']]);
							 $mapel=fetch($koneksi,'mata_pelajaran',['kode_mapel' => $tugas['mapel']]);
							 $siswa=fetch($koneksi,'siswa',['id_siswa'=>$info['id_siswa'],'id_siswa'=>$_SESSION['id_siswa']]);
							 $no++;
                            ?>
							<?php if($siswa['id_siswa']<>$info['id_siswa']){ ?>
							<audio src='ujian.mp3' autoplay='autoplay'></audio>;
					        <h3><?= $no ?>. <?= $mapel['nama_mapel'] ?></h3>
							<?php } } ?>
                    </div>
					</div>
					
            </div>
              
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
