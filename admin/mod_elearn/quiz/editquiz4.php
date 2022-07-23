<?php
$idbank=$_GET['idbank'];
$soalQ = mysqli_query($koneksi, "SELECT * FROM soal_quiz WHERE id_bank='$idbank'");
$soal = mysqli_fetch_array($soalQ);
$checked = explode(', ', $soal['jawaban']); 
$idmateri=$soal['idmateri'];
?>

<div class='row'>
	<div class='col-md-12'>
		<form method="post" action="" enctype="multipart/form-data">
		<div class='box box-solid'>
				<div class='box-header with-border bg-blue'>

					<div class='btn-group' style='margin-top:-5px'>
						
						<a class='btn btn-sm btn-danger'>No Soal : <?= $nomor ?></a>
					</div>
					<div class='box-tools pull-right btn-group'>

						<button type='submit' name='simpaneditbs' onclick="tinyMCE.triggerSave(true,true);" class='btn btn-sm btn-primary'><i class='fa fa-check'></i> Simpan</button>
						<a href="?pg=quizbank&id=<?= $materi['id_materi'] ?>" class='btn btn-sm btn-danger'><i class='fa fa-times'></i></a>

					</div>
				</div><!-- /.box-header -->
                                    <div class="modal-body">
                                         <input type="hidden" class="form-control" name="idbank" value="<?= $soal['id_bank'] ?>">
										<div class='col-md-6'>
                                            <textarea id='editor2' name='isi_soal' class='editor1' rows='20' cols='80' style='width:100%;'><?= $soal['soal'] ?></textarea>
                                        </div>
                                       </div>
										<div class='col-md-6'>
								<div class='box-group' id='accordion'>
									<div class='panel box box-solid'>
										<div class='box-header with-border'>
											<h4 class='box-title'>
												<a data-toggle='collapse' data-parent='#accordion' href='#collapseOne' aria-expanded='false' class='collapsed'>
													PERNYATAAN A
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
													PERNYATAAN B
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

													<textarea name='pilB' class='editor1 pilihan form-control'><?= $soal['pilB'] ?></textarea>
												</div>
													</div>
													</div>
													 </div>  
													 <div class='panel box box-solid'>
										<div class='box-header with-border'>
											<h4 class='box-title'>
												<a data-toggle='collapse' data-parent='#accordion' href='#collapseC' aria-expanded='false' class='collapsed'>
													PERNYATAAN C
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

													<textarea name='pilC' class='editor1 pilihan form-control'><?= $soal['pilC'] ?></textarea>
												</div>
													</div>
													</div>
													 </div>  
													  <div class='panel box box-solid'>
										<div class='box-header with-border'>
											<h4 class='box-title'>
												<a data-toggle='collapse' data-parent='#accordion' href='#collapseD' aria-expanded='false' class='collapsed'>
													PERNYATAAN D
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

													<textarea name='pilD' class='editor1 pilihan form-control'><?= $soal['pilD'] ?></textarea>
												</div>
													</div>
													</div>
													 </div>
													 <?php if($setting['jenjang']=='SMK'){ ?>
													  <div class='panel box box-solid'>
										<div class='box-header with-border'>
											<h4 class='box-title'>
												<a data-toggle='collapse' data-parent='#accordion' href='#collapseE' aria-expanded='false' class='collapsed'>
													PERNYATAAN E
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

													<textarea name='pilE' class='editor1 pilihan form-control'><?= $soal['pilE'] ?></textarea>
												</div>
													</div>
													</div>
													 </div>
													 <?php } ?>
												    </div>
													</div>
                                    <div class="modal-footer">
                                      
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
				<?php
                if (isset($_POST['simpaneditbs'])) {
	             $id_materi=$_POST['id_materi'];
				 $nomor=$_POST['nomor'];
				 $soal=$_POST['isi_soal'];
				 $pilA=$_POST['pilA'];
				  $pilB=$_POST['pilB'];
				   $pilC=$_POST['pilC'];
				    $pilD=$_POST['pilD'];
					 $pilE=$_POST['pilE'];
					 if($setting['jenjang']=='SMK'){
					 $jawaban = $_POST['jawabana'].', '.$_POST['jawabanb'].', '.$_POST['jawabanc'].', '.$_POST['jawaband'].', '.$_POST['jawabane'];
			mysqli_query($koneksi, "UPDATE soal_quiz SET soal='$soal',pilA='$pilA',pilB='$pilB',pilC='$pilC',pilD='$pilD',pilE='$pilE',jawaban='$jawaban' WHERE id_bank='$idbank' ");
			
                     echo "
	   <script type='text/javascript'>
		setTimeout(function () { 	
			swal({
				title: 'Sukses !!!',
				text:  'Soal  berhasil di ubah',
				type: 'success',
				timer: 2000,
				showConfirmButton: true
			});		
		},10);	
		window.setTimeout(function(){ 
			window.location.replace('?pg=quizbank&id=$idmateri');
		} ,2000);	
	  </script>";
				
				}else{
					 $jawaban = $_POST['jawabana'].', '.$_POST['jawabanb'].', '.$_POST['jawabanc'].', '.$_POST['jawaband'];
			mysqli_query($koneksi, "UPDATE soal_quiz SET soal='$soal',pilA='$pilA',pilB='$pilB',pilC='$pilC',pilD='$pilD',jawaban='$jawaban' WHERE id_bank='$idbank' ");
			
                     echo "
	   <script type='text/javascript'>
		setTimeout(function () { 	
			swal({
				title: 'Sukses !!!',
				text:  'Soal  berhasil di ubah',
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