
<?php
$id=$_GET['id'];
$materi=fetch($koneksi,'materi',['id_materi' =>$_GET['id']]);
$idmateri=$materi['idmateri'];
$nom = mysqli_fetch_array(mysqli_query($koneksi, "SELECT max(nomor) AS nomer FROM soal_quiz WHERE idmateri='$_GET[id]'"));
if($nom['nomer']==''){
$nomor = 1;
}else{
$nomor =$nom['nomer'] + 1;
}
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

						<button type='submit' name='simpanpg' onclick="tinyMCE.triggerSave(true,true);" class='btn btn-sm btn-primary'><i class='fa fa-check'></i> Simpan</button>
						<a href="?pg=quizbank&id=<?= $materi['id_materi'] ?>" class='btn btn-sm btn-danger'><i class='fa fa-times'></i></a>

					</div>
				</div><!-- /.box-header -->
                                    <div class="modal-body">
                                        <input type="hidden" class="form-control" name="id_materi" value="<?= $_GET['id'] ?>">
										 <input type="hidden" class="form-control" name="nomor" value="<?= $nomor ?>">
										<div class='col-md-6'>
                                            <textarea id='editor2' name='isi_soal' class='editor1' rows='20' cols='80' style='width:100%;'></textarea>
                                        </div>
                                       </div>
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
												<label><input type='radio' name='jawaban' value='A' /> Pilihan A</label>
											</div>
										</div>
										<div id='collapseOne' class='panel-collapse collapse' aria-expanded='false' style='height: 0px;'>
											<div class='box-body'>
												<div class='form-group'>
													<textarea name='pilA' class='editor1 pilihan form-control'></textarea>
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
												<label><input type='radio' name='jawaban' value='B'  /> Pilihan B</label>
											</div>
										</div>
										<div id='collapseB' class='panel-collapse collapse' aria-expanded='false' style='height: 0px;'>
											<div class='box-body'>
												<div class='form-group'>

													<textarea name='pilB' class='editor1 pilihan form-control'></textarea>
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
												<label><input type='radio' name='jawaban' value='C'  /> Pilihan C</label>
											</div>
										</div>
										<div id='collapseC' class='panel-collapse collapse' aria-expanded='false' style='height: 0px;'>
											<div class='box-body'>
												<div class='form-group'>

													<textarea name='pilC' class='editor1 pilihan form-control'></textarea>
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
												<label><input type='radio' name='jawaban' value='D'  /> Pilihan D</label>
											</div>
										</div>
										<div id='collapseD' class='panel-collapse collapse' aria-expanded='false' style='height: 0px;'>
											<div class='box-body'>
												<div class='form-group'>

													<textarea name='pilD' class='editor1 pilihan form-control'></textarea>
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
												<label><input type='radio' name='jawaban' value='E'  /> Pilihan E</label>
											</div>
										</div>
										<div id='collapseE' class='panel-collapse collapse' aria-expanded='false' style='height: 0px;'>
											<div class='box-body'>
												<div class='form-group'>

													<textarea name='pilE' class='editor1 pilihan form-control'></textarea>
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
                if (isset($_POST['simpanpg'])) {
	             $id_materi=$_POST['id_materi'];
				 $nomor=$_POST['nomor'];
				 $soal=$_POST['isi_soal'];
				 $pilA=$_POST['pilA'];
				  $pilB=$_POST['pilB'];
				   $pilC=$_POST['pilC'];
				    $pilD=$_POST['pilD'];
					 $pilE=$_POST['pilE'];
					 $jawaban=$_POST['jawaban'];
			mysqli_query($koneksi, "INSERT INTO soal_quiz (idmateri,nomor,kode,soal,pilA,pilB,pilC,pilD,pilE,jawaban) VALUES ('$id_materi','$nomor','1','$soal','$pilA','$pilB','$pilC','$pilD','$pilE','$jawaban')");
				
                     echo "
	  <script type='text/javascript'>
		setTimeout(function () { 	
			swal({
				title: 'Sukses !!!',
				text:  'Soal .$nomor. berhasil di simpan',
				type: 'success',
				timer: 2000,
				showConfirmButton: true
			});		
		},10);	
		window.setTimeout(function(){ 
			window.location.replace('?pg=quizbank&id=$id');
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