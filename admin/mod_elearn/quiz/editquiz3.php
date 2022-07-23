<?php
$idbank=$_GET['idbank'];
$soalQ = mysqli_query($koneksi, "SELECT * FROM soal_quiz WHERE id_bank='$idbank'");
$soal = mysqli_fetch_array($soalQ);

$idmateri=$soal['idmateri'];
?>
<div class='row'>
	<div class='col-md-12'>
		<form method="post" action="" enctype="multipart/form-data">
		<div class='box box-solid'>
				<div class='box-header with-border bg-blue'>

					<div class='btn-group' style='margin-top:-5px'>
						
						<a class='btn btn-sm btn-danger'>No Soal : <?= $soal['nomor'] ?></a>
					</div>
					<div class='box-tools pull-right btn-group'>

						<button type='submit' name='simpaneditesay' onclick="tinyMCE.triggerSave(true,true);" class='btn btn-sm btn-primary'><i class='fa fa-check'></i> Simpan</button>
						<a href="?pg=quizbank&id=<?= $soal['idmateri'] ?>" class='btn btn-sm btn-danger'><i class='fa fa-times'></i></a>

					</div>
				</div><!-- /.box-header -->
                                    <div class="modal-body">
                                        <input type="hidden" class="form-control" name="idbank" value="<?= $soal['id_bank'] ?>">
										
										<div class='col-md-6'>
                                            <textarea id='editor2' name='isi_soal' class='editor1' rows='10' cols='80' style='width:100%;'><?= $soal['soal'] ?></textarea>
                                        </div>
                                       </div>
										<div class='col-md-6'>
								<div class='box-group' id='accordion'>
									<div class='panel box box-solid'>
										<div class='box-header with-border'>
											<h4 class='box-title'>
												<a data-toggle='collapse' data-parent='#accordion' href='#collapse<?= $soal['id_bank'] ?>' aria-expanded='false' class='collapsed'>
													Kunci Jawaban
												</a>
											</h4>
											
										</div>
										<div id='collapse<?= $soal['id_bank'] ?>' class='panel-collapse collapse' aria-expanded='false' style='height: 0px;'>
											<div class='box-body'>
												<div class='form-group'>
													<textarea name='jawaban' rows='10' cols='80'><?= $soal['jawaban'] ?></textarea>
												</div>                  
                                                  </div>  
												    </div>
													 </div>  
												   
										
												    </div>
													</div>
                                    <div class="modal-footer">
                                      
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
				<?php
                if (isset($_POST['simpaneditesay'])) {
	             $id_materi=$_POST['id_materi'];
				 $nomor=$_POST['nomor'];
				 $soal=$_POST['isi_soal'];
				
					 $jawaban=$_POST['jawaban'];
			       mysqli_query($koneksi, "UPDATE soal_quiz SET soal='$soal',jawaban='$jawaban' WHERE id_bank='$idbank' ");
					
                     echo "
	  <script type='text/javascript'>
		setTimeout(function () { 	
			swal({
				title: 'Sukses !!!',
				text:  'Soal berhasil di ubah',
				type: 'success',
				timer: 2000,
				showConfirmButton: true
			});		
		},10);	
		window.setTimeout(function(){ 
			window.location.replace('?pg=quizbank&id=$idmateri');
		} ,2000);	
	  </script>";
				
				}
				?>
				
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