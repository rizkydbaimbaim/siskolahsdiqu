<?php
if (!isset($_GET['id_soal'])) :
	die("Anda tidak dizinkan mengakses langsung script ini!");
endif;

$id_soal = $_GET['id_soal'];

$nomor = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM soal WHERE id_soal='$id_soal'"));

$mapel = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM mapel WHERE id_mapel='$nomor[id_mapel]'"));
$idmap=$mapel['kode'];
$jumsoal = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM soal WHERE id_mapel='$mapel[id_mapel]' AND  nomor='$nomor[nomor]' AND jenis='3'"));
$soalQ = mysqli_query($koneksi, "SELECT * FROM soal WHERE id_soal='$id_soal' ");
$soal = mysqli_fetch_array($soalQ);
  $checked = explode(', ', $soal['jawaban']); 

?>
<div class='row'>
	<div class='col-md-12'>
		<form id='formsoal2' action='' method='post' enctype='multipart/form-data'>
			<div class='box box-solid'>
				<div class='box-header with-border bg-blue'>

					<div class='btn-group' style='margin-top:-5px'>
						<a class='btn btn-sm btn-primary'>Nama Mapel </a>
						<a class='btn btn-sm btn-success'><?= $mapel['nama'] ?> </a>
						<a class='btn btn-sm btn-danger'>No Soal : <?= $nomor['nomor'] ?></a>
					</div>
					<div class='box-tools pull-right btn-group'>

						<button type='submit' name='simpansoal' onclick="tinyMCE.triggerSave(true,true);" class='btn btn-sm btn-primary'><i class='fa fa-check'></i> Simpan</button>
						<a href='?pg=banksoal&ac=lihat&id=<?= $mapel['id_mapel'] ?>' class='btn btn-sm btn-danger'><i class='fa fa-times'></i></a>

					</div>
				</div><!-- /.box-header -->

				<div class='box-body'>
					<input type='hidden' name='idsoal' value='<?= $_GET['id_soal'] ?>'>
					<input type='hidden' name='mapel' value='<?= $nomor['id_mapel'] ?>'>
					<input type='hidden' name='jenis' value='<?= $nomor['jenis'] ?>'>
					<input type='hidden' name='nomor' value='<?= $nomor['nomor'] ?>'>
					
					<div class='form-group'>

						<div class='btn-group'>
							<?php
							if ($soal['jenis'] == '4') {
								for ($i = 1; $i <= $mapel['jml_soal']; $i++) {
									$ceksoal = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM soal WHERE id_soal='$id_soal'"));
									($ceksoal <> 0) ? $a = 'success' : $a = 'default';
									($i == $nomor) ? $a = 'danger' : null;
									echo "<a href='?pg=$pg&ac=$ac&id=$id_mapel&no=$i&jenis=pg' class='btn btn-xs btn-$a'>$i</a>";
								}
							} else {
								
							}
							?>
						</div>
					</div>
                                      
							
					<div class='row'>
						<div class='col-md-6'>
						
								<div class='box-body pad'>
								
									<form>
										<textarea id='editor2' name='isi_soal' class='editor1' rows='10' cols='80' style='width:100%;'><?= $soal['soal'] ?></textarea>
									</form>
								</div>
							</div>
							
						
						<?php
						if ($soal['jenis'] == '4') {
						?>
							<div class='col-md-6'>
								<div class='box-group' id='accordion'>
									<div class='panel box box-solid'>
										<div class='box-header with-border'>
											<h4 class='box-title'>
												<a data-toggle='collapse' data-parent='#accordion' href='#collapseOne' aria-expanded='false' class='collapsed'>
													PILIHAN JAWABAN A
												</a>
											</h4>
											<div class='box-tools pull-right'>
												<label><input type='radio' name='jawabana' <?php if($checked[0]=='B'){echo "checked"; } ?>  value='B' required='true' /> Benar</label>
												<label><input type='radio' name='jawabana'  <?php if($checked[0]=='S'){echo "checked"; } ?>  value='S' required='true' /> Salah</label>
											</div>
										</div>
										<div id='collapseOne' class='panel-collapse collapse' aria-expanded='false' style='height: 0px;'>
											<div class='box-body'>
												<div class='form-group'>
													<textarea name='pilA' class='editor1 pilihan form-control'><?= $soal['pilA'] ?></textarea>
												</div>
											</div>
										</div>
									</div>
									<div class='panel box box-solid'>
										<div class='box-header with-border'>
											<h4 class='box-title'>
												<a data-toggle='collapse' data-parent='#accordion' href='#collapseB' aria-expanded='false' class='collapsed'>
													PILIHAN JAWABAN B
												</a>
											</h4>
											<div class='box-tools pull-right'>
												<label><input type='radio' name='jawabanb' <?php if($checked[1]=='B'){echo "checked"; } ?>  value='B' required='true'  /> Benar</label>
												<label><input type='radio' name='jawabanb' <?php if($checked[1]=='S'){echo "checked"; } ?>  value='S' required='true' /> Salah</label>
											</div>
										</div>
										<div id='collapseB' class='panel-collapse collapse' aria-expanded='false' style='height: 0px;'>
											<div class='box-body'>
												<div class='form-group'>

													<textarea name='pilB' class='editor1 pilihan form-control'><?= $soal[pilB] ?></textarea>
												</div>
											</div>
										</div>
									</div>
									<div class='panel box box-solid'>
										<div class='box-header with-border'>
											<h4 class='box-title'>
												<a data-toggle='collapse' data-parent='#accordion' href='#collapseC' aria-expanded='false' class='collapsed'>
													PILIHAN JAWABAN C
												</a>
											</h4>
											<div class='box-tools pull-right'>
												<label><input type='radio' name='jawabanc' <?php if($checked[2]=='B'){echo "checked"; } ?>  value='B' required='true'  /> Benar</label>
												<label><input type='radio' name='jawabanc' <?php if($checked[2]=='S'){echo "checked"; } ?>  value='S' required='true' /> Salah</label>
											</div>
										</div>
										<div id='collapseC' class='panel-collapse collapse' aria-expanded='false' style='height: 0px;'>
											<div class='box-body'>
												<div class='form-group'>

													<textarea name='pilC' class='editor1 pilihan form-control'><?= $soal[pilC] ?></textarea>
												</div>
											</div>
										</div>
									</div>
			                        <div class='panel box box-solid'>
										<div class='box-header with-border'>
											<h4 class='box-title'>
												<a data-toggle='collapse' data-parent='#accordion' href='#collapseD' aria-expanded='false' class='collapsed'>
													PILIHAN JAWABAN D
												</a>
											</h4>
											<div class='box-tools pull-right'>
												<label><input type='radio' name='jawaband' <?php if($checked[3]=='B'){echo "checked"; } ?>  value='B' required='true'  /> Benar</label>
												<label><input type='radio' name='jawaband' <?php if($checked[3]=='S'){echo "checked"; } ?>  value='S' required='true' /> Salah</label>
											</div>
										</div>
										<div id='collapseD' class='panel-collapse collapse' aria-expanded='false' style='height: 0px;'>
											<div class='box-body'>
												<div class='form-group'>

													<textarea name='pilD' class='editor1 pilihan form-control'><?= $soal[pilD] ?></textarea>
												</div>
											</div>
										</div>
									</div>
									
									
									<?php if($setting['jenjang']=='SMK'){ ?>
								 <div class='panel box box-solid'>
										<div class='box-header with-border'>
											<h4 class='box-title'>
												<a data-toggle='collapse' data-parent='#accordion' href='#collapseE' aria-expanded='false' class='collapsed'>
													PILIHAN JAWABAN E
												</a>
											</h4>
											<div class='box-tools pull-right'>
												<label><input type='radio' name='jawabane' <?php if($checked[4]=='B'){echo "checked"; } ?>  value='B' required='true'  /> Benar</label>
												<label><input type='radio' name='jawabane' <?php if($checked[4]=='S'){echo "checked"; } ?>  value='S' required='true' /> Salah</label>
											</div>
										</div>
										<div id='collapseE' class='panel-collapse collapse' aria-expanded='false' style='height: 0px;'>
											<div class='box-body'>
												<div class='form-group'>

													<textarea name='pilE' class='editor1 pilihan form-control'><?= $soal[pilE] ?></textarea>
												</div>
											</div>
										</div>
									</div>	
															<?php } ?>
		</form>
	</div>
</div>
						<?php } ?>
						
<script>
	tinymce.init({
		selector: '.editor1',
		
		plugins: [
			'advlist autolink lists link image charmap print preview hr anchor pagebreak',
			'searchreplace wordcount visualblocks visualchars code fullscreen',
			'insertdatetime media nonbreaking save table contextmenu directionality',
			'emoticons template paste textcolor colorpicker textpattern imagetools uploadimage paste formula'
		],

		toolbar: 'bold italic fontselect fontsizeselect | alignleft aligncenter alignright bullist numlist  backcolor forecolor | formula code | imagetools link image paste ',
		fontsize_formats: '8pt 10pt 12pt 14pt 18pt 24pt 36pt',
		paste_data_images: true,

		images_upload_handler: function(blobInfo, success, failure) {
			success('data:' + blobInfo.blob().type + ';base64,' + blobInfo.base64());
		},
		image_class_list: [{
			title: 'Responsive',
			value: 'img-responsive'
		}],
	});
</script>
<script>
$('#formsoal2').submit(function(e) {
        e.preventDefault();
        var data = new FormData(this);
        $.ajax({
            type: 'POST',
            url: 'mod_banksoal/crud_banksoal2.php?pg=simpan_soal',
            enctype: 'multipart/form-data',
            data: data,
            cache: false,
            contentType: false,
            processData: false,
            beforeSend: function() {},
            success: function(data) {
                toastr.success('soal berhasil disimpan');
				 setTimeout(function() {
                            location.reload();
                        }, 2000);
            }
        })
        return false;
    });
	</script>
	



