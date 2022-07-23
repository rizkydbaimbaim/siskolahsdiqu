<?php defined('APLIKASI') or exit('Anda tidak dizinkan mengakses langsung script ini!'); ?>

<?php
$id=$_GET['id'];
$materi=fetch($koneksi,'materi',['id_materi' =>$_GET['id']]);
?>
   	       
		<div class='row'>
        <div class='col-md-12'>
            <div class='box box-solid'>
                <div class='box-header with-border '>
                    <h3 class='box-title'> DAFTAR QUIZ <?= $materi['mapel'] ?></h3>
                    <div class='box-tools pull-right '>

                    </div>
                </div><!-- /.box-header -->
                <div class='box-body'>
                    <!-- Button trigger modal -->
                    <div class="form-group">
                        <a href="?pg=inputquiz1&id=<?= $materi['id_materi'] ?>" class="btn btn-primary mb-5"><i class="fas fa-plus-circle    "></i> Quiz PG </button></a>
                         <a href="?pg=inputquiz2&id=<?= $materi['id_materi'] ?>" class="btn btn-info mb-5"><i class="fas fa-plus-circle    "></i> Quiz Multi </button></a>
                        <a href="?pg=inputquiz3&id=<?= $materi['id_materi'] ?>" class="btn btn-success mb-5"><i class="fas fa-plus-circle    "></i> Quiz Essay </button></a>
						 <a href="?pg=inputquiz4&id=<?= $materi['id_materi'] ?>" class="btn btn-warning mb-5"><i class="fas fa-plus-circle    "></i> Quiz False True </button></a>
                     </div>
					<div class='table-responsive'>
							
						 <b>Soal</b>
									<br><br>
                                    <table class='table table-bordered table-striped'>
                                        <tbody>
                                            <?php $soalq = mysqli_query($koneksi, "SELECT * FROM soal_quiz where idmateri='$id'  order by nomor "); ?>
                                            <?php while ($soal = mysqli_fetch_array($soalq)) : ?>

                                                <tr>
                                                    <td style='width:30px'>
                                                        <?= $soal['nomor'] ?>
                                                    </td>
                                                    <td style="text-align:justify">
               
                                                        <?= $soal['soal']; ?>
                                                       
														<?php if ($soal['kode'] <> '3') : ?>
                                                        <table width=100%>
                                                            <tr>
                                                                <td style="padding: 3px;width: 2%; vertical-align: text-top;">A.</td>
                                                                <td style="padding: 3px;width: 31%; vertical-align: text-top;">
                                                                    <?php
                                                                    if ($soal['pilA'] <> '') {
                                                                        echo "$soal[pilA] ";
                                                                    }

                                                                    if ($soal['fileA'] <> '') {
                                                                        $audio = array('mp3', 'wav', 'ogg', 'MP3', 'WAV', 'OGG');
                                                                        $image = array('jpg', 'jpeg', 'png', 'gif', 'bmp', 'JPG', 'JPEG', 'PNG', 'GIF', 'BMP');
                                                                        $ext = explode(".", $soal['fileA']);
                                                                        $ext = end($ext);
                                                                        if (in_array($ext, $image)) {
                                                                            echo "<img src='$homeurl/files/$soal[fileA]' style='max-width:100px;'/>";
                                                                        } elseif (in_array($ext, $audio)) {
                                                                            echo "<audio controls><source src='$homeurl/files/$soal[fileA]' type='audio/$ext'>Your browser does not support the audio tag.</audio>";
                                                                        } else {
                                                                            echo "File tidak didukung!";
                                                                        }
                                                                    }
                                                                    ?>
                                                                </td>
                                                                <td style="padding: 3px;width: 2%; vertical-align: text-top;">C.</td>
                                                                <td style="padding: 3px;width: 31%; vertical-align: text-top;">
                                                                    <?php
                                                                    if (!$soal['pilC'] == "") {
                                                                        echo "$soal[pilC] ";
                                                                    }

                                                                    if ($soal['fileC'] <> '') {
                                                                        $audio = array('mp3', 'wav', 'ogg', 'MP3', 'WAV', 'OGG');
                                                                        $image = array('jpg', 'jpeg', 'png', 'gif', 'bmp', 'JPG', 'JPEG', 'PNG', 'GIF', 'BMP');
                                                                        $ext = explode(".", $soal['fileC']);
                                                                        $ext = end($ext);
                                                                        if (in_array($ext, $image)) {
                                                                            echo "<img src='$homeurl/files/$soal[fileC]' style='max-width:100px;' />";
                                                                        } elseif (in_array($ext, $audio)) {
                                                                            echo "<audio controls><source src='$homeurl/files/$soal[fileC]' type='audio/$ext'>Your browser does not support the audio tag.</audio>";
                                                                        } else {
                                                                            echo "File tidak didukung!";
                                                                        }
                                                                    }
                                                                    ?>
                                                                </td>
                                                                <?php if ($setting['jenjang'] == 'SMK') : ?>
                                                                    <td style="padding: 3px;width: 2%; vertical-align: text-top;">E.</td>
                                                                    <td style="padding: 3px; vertical-align: text-top;">
                                                                        <?php
                                                                        if (!$soal['pilE'] == "") {
                                                                            echo "$soal[pilE] ";
                                                                        }

                                                                        if ($soal['fileE'] <> '') {
                                                                            $audio = array('mp3', 'wav', 'ogg', 'MP3', 'WAV', 'OGG');
                                                                            $image = array('jpg', 'jpeg', 'png', 'gif', 'bmp', 'JPG', 'JPEG', 'PNG', 'GIF', 'BMP');
                                                                            $ext = explode(".", $soal['fileE']);
                                                                            $ext = end($ext);
                                                                            if (in_array($ext, $image)) {
                                                                                echo "<img src='$homeurl/files/$soal[fileE]' style='max-width:100px;' />";
                                                                            } elseif (in_array($ext, $audio)) {
                                                                                echo "<audio controls><source src='$homeurl/files/$soal[fileE]' type='audio/$ext'>Your browser does not support the audio tag.</audio>";
                                                                            } else {
                                                                                echo "File tidak didukung!";
                                                                            }
                                                                        }
                                                                        ?>
                                                                    </td>
                                                                <?php endif; ?>

                                                            </tr>

                                                            <tr>
                                                                <td style="padding: 3px;width: 2%; vertical-align: text-top;">B.</td>
                                                                <td style="padding: 3px;width: 31%; vertical-align: text-top;">
                                                                    <?php
                                                                    if (!$soal['pilB'] == "") {
                                                                        echo "$soal[pilB] ";
                                                                    }

                                                                    if ($soal['fileB'] <> '') {
                                                                        $audio = array('mp3', 'wav', 'ogg', 'MP3', 'WAV', 'OGG');
                                                                        $image = array('jpg', 'jpeg', 'png', 'gif', 'bmp', 'JPG', 'JPEG', 'PNG', 'GIF', 'BMP');
                                                                        $ext = explode(".", $soal['fileB']);
                                                                        $ext = end($ext);
                                                                        if (in_array($ext, $image)) {
                                                                            echo "<img src='$homeurl/files/$soal[fileB]' style='max-width:100px;' />";
                                                                        } elseif (in_array($ext, $audio)) {
                                                                            echo "<audio controls><source src='$homeurl/files/$soal[fileB]' type='audio/$ext'>Your browser does not support the audio tag.</audio>";
                                                                        } else {
                                                                            echo "File tidak didukung!";
                                                                        }
                                                                    }
                                                                    ?>
                                                                </td>
                                                                <?php if ($namamapel['opsi'] <> 3) : ?>
                                                                    <td style="padding: 3px;width: 2%; vertical-align: text-top;">D.</td>
                                                                    <td style="padding: 3px;width: 31%; vertical-align: text-top;">
                                                                        <?php
                                                                        if (!$soal['pilD'] == "") {
                                                                            echo "$soal[pilD] ";
                                                                        }

                                                                        if ($soal['fileD'] <> '') {
                                                                            $audio = array('mp3', 'wav', 'ogg', 'MP3', 'WAV', 'OGG');
                                                                            $image = array('jpg', 'jpeg', 'png', 'gif', 'bmp', 'JPG', 'JPEG', 'PNG', 'GIF', 'BMP');
                                                                            $ext = explode(".", $soal['fileD']);
                                                                            $ext = end($ext);
                                                                            if (in_array($ext, $image)) {
                                                                                echo "<img src='$homeurl/files/$soal[fileD]' style='max-width:100px;' />";
                                                                            } elseif (in_array($ext, $audio)) {
                                                                                echo "<audio controls><source src='$homeurl/files/$soal[fileD]' type='audio/$ext'>Your browser does not support the audio tag.</audio>";
                                                                            } else {
                                                                                echo "File tidak didukung!";
                                                                            }
                                                                        }
                                                                        ?>
                                                                    </td>

                                                                <?php endif; ?>

                                                            </tr>

                                                        </table>
														 <?php endif; ?>
                                                        <b> Kunci : <?= $soal['jawaban'] ?> </b>
                                                    </td>
                                                    <td style='width:30px'>
                                                        <a><button class='btn bg-maroon btn-sm' data-toggle='modal' data-target="#hapus<?= $soal['id_bank'] ?>"><i class='fa fa-trash'></i></button></a>
                                                   
												    <?php if($soal['kode']==1){ ?>
												  <a href="?pg=editquiz1&idbank=<?= $soal['id_bank'] ?>" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></button></a>                                               
												   <?php } ?>
												   <?php if($soal['kode']==2){ ?>
												   <a href="?pg=editquiz2&idbank=<?= $soal['id_bank'] ?>" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></button></a>                        
												   <?php } ?>
												    <?php if($soal['kode']==3){ ?>
												    <a href="?pg=editquiz3&idbank=<?= $soal['id_bank'] ?>" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></button></a>                                               
												   <?php } ?>
												 <?php if($soal['kode']==4){ ?>
												    <a href="?pg=editquiz4&idbank=<?= $soal['id_bank'] ?>" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></button></a>                                               
												   <?php } ?>
												   
												   <?php if($soal['kode']==5){ ?>
												   <a href="?pg=editquiz5&id_bank=<?php echo $soal['id_bank'] ?>" class="btn btn-sm btn-primary"><i class='fa fa-edit'></i></button></a>
												   <?php } ?>
												  </td>

                                                </tr>
                                                <?php
                                                $info = info("Anda yakin akan menghapus soal ini ?");
                                                if (isset($_POST['hapus'])) {
                                                    $exec = mysqli_query($koneksi, "DELETE FROM soal_quiz WHERE id_bank = '$_REQUEST[idu]'");
                                                    echo "
	  <script type='text/javascript'>
		setTimeout(function () { 	
			swal({
				title: 'Sukses !!!',
				text:  'Soal berhasil di hapus',
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
                                                <div class='modal fade' id="hapus<?= $soal['id_bank'] ?>" style='display: none;'>
                                                    <div class='modal-dialog'>
                                                        <div class='modal-content'>
                                                            <div class='modal-header bg-maroon'>
                                                                <button class='close' data-dismiss='modal'><span aria-hidden='true'><i class='glyphicon glyphicon-remove'></i></span></button>
                                                                <h3 class='modal-title'>Hapus Soal</h3>
                                                            </div>
                                                            <div class='modal-body'>
                                                                <form action='' method='post'>
                                                                    <input type='hidden' id='idu' name='idu' value="<?= $soal['id_bank'] ?>" />
                                                                    <div class='callout '>
                                                                        <h4><?= $info ?></h4>
                                                                    </div>
                                                                    <div class='modal-footer'>
                                                                        <div class='box-tools pull-right '>
                                                                            <button type='submit' name='hapus' class='btn btn-sm bg-maroon'><i class='fa fa-trash-o'></i> Hapus</button>
                                                                            <button type='button' class='btn btn-default btn-sm pull-left' data-dismiss='modal'>Close</button>
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endwhile; ?>
                                        </tbody>
                                    </table>
                        </div>
                    </div>
						


	
	
	
	


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

