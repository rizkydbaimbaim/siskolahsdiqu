 <style>
 /* custom radio */
.radio {
    display: block;
    position: relative;
    padding-left: 35px;
    margin-bottom: 12px;
    cursor: pointer;
    font-size: 22px;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
}
 
/* hide the browser's default radio button */
.radio input {
    position: absolute;
    opacity: 0;
    cursor: pointer;
}
 
/* create custom radio */
.radio .check {
    position: absolute;
    top: 0;
    left: 0;
    height: 35px;
    width: 35px;
    background-color: #eee;
    border: 1px solid #ccc;
    border-radius: 50%;
}
 
/* on mouse-over, add border color */
.radio:hover input ~ .check {
    border: 2px solid #2489C5;
}
 
/* add background color when the radio is checked */
.radio input:checked ~ .check {
    background-color: #2489C5;
    border:none;
}
 
/* create the radio and hide when not checked */
.radio .check:after {
    content: "";
    position: absolute;
    display: none;
}
 
/* show the radio when checked */
.radio input:checked ~ .check:after {
    display: block;
}
 
/* radio style */
.radio .check:after {
    top: 9px;
    left: 9px;
    width: 8px;
    height: 8px;
    border-radius: 50%;
    background: white;
}
/* custom checkbox */
.checkbox {
    display: block;
    position: relative;
    padding-left: 35px;
    margin-bottom: 12px;
    cursor: pointer;
    font-size: 22px;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
}
 
/* hide the browser's default checkbox */
.checkbox input {
    position: absolute;
    opacity: 0;
    cursor: pointer;
}
 
/* create custom checkbox */
.check {
    position: absolute;
    top: 0;
    left: 0;
    height: 25px;
    width: 25px;
    background-color: #eee;
    border: 1px solid #ccc;
}
 
/* on mouse-over, add border color */
.checkbox:hover input ~ .check {
    border: 2px solid #2489C5;
}
 
/* add background color when the checkbox is checked */
.checkbox input:checked ~ .check {
    background-color: #2489C5;
    border:none;
}
 
/* create the checkmark and hide when not checked */
.check:after {
    content: "";
    position: absolute;
    display: none;
}
 
/* show the checkmark when checked */
.checkbox input:checked ~ .check:after {
    display: block;
}
 
/* checkmark style */
.checkbox .check:after {
    left: 9px;
    top: 5px;
    width: 5px;
    height: 10px;
    border: solid white;
    border-width: 0 3px 3px 0;
    -webkit-transform: rotate(45deg);
    -ms-transform: rotate(45deg);
    transform: rotate(45deg);
}
</style>
  <style>
    #sortable { list-style-type: none; margin: 0; padding: 0; width: 60%; }
    #sortable li { margin: 0 3px 3px 3px; padding: 0.4em; padding-left: 1.5em; height: 30px; }
    #sortable li span { position: absolute; margin-left: -1.3em; }
</style>
 <?php
 $ac = $ac;
 $materi=fetch($koneksi,'materi',['id_materi'=>$ac]);
$tes = 1; 
$page = isset($_GET['tes']) ? $_GET['tes'] : 1;
$mulai = ($page > 1) ? ($page * $tes) - $tes : 0;
if(($page < 1) && (empty($page))){
    $page = 1;
}
$tampiljawab = mysqli_query($koneksi,"SELECT * FROM jawaban_quiz WHERE materi='$ac' AND iduser='$_SESSION[id_siswa]'");
$jumlahjawab= mysqli_num_rows($tampiljawab);
$tampil = mysqli_query($koneksi,"SELECT * FROM soal_quiz WHERE idmateri='$ac'");
$jumlah_data = mysqli_num_rows($tampil);
$jumlah_halaman = ceil($jumlah_data/$tes);
$no = $mulai + 1;
$hasil = mysqli_query($koneksi,"SELECT 
* FROM soal_quiz WHERE idmateri='$ac'
    limit ".$mulai." , ".$tes
);
while ($soal = mysqli_fetch_array($hasil)){
   $jawab = fetch($koneksi, 'jawaban_quiz', array('iduser' => $_SESSION['id_siswa'], 'idsoal' => $soal['id_bank'], 'materi' => $ac));
?>

          <div class='row'>
    <div class='col-md-12'>
        <div class='box box-solid'>
            <div class='soaltanya animated fadeIn'></div>
			 <div class='callout soal'>
			  <h3><strong>Soal ke <?php echo $no++; ?> dari <?php echo $jumlah_halaman?> </strong></h3>
                            <div class='soaltanya animated fadeIn'><?= $soal['soal'] ?></div>
                        </div>
						<div class='box-body'>
                        <div class='col-md-12'>
                            <?php
                           
                            ?>
                        </div>
                    </div>
					  <form id='myForm'  method='POST' action='<?= $homeurl ?>/prosesquiz.php'>
                <input type="hidden" name="idsoal" value="<?php echo $soal['id_bank']; ?>">
                <input type="hidden" name="jumlah" value="<?php echo $jumlah_data; ?>">
				<input type="hidden" name="ids" value="<?php echo $_SESSION['id_siswa']; ?>">
					<input type="hidden" name="idm" value="<?php echo $soal['idmateri']; ?>">
					<input type="hidden" name="kode" value="<?php echo $soal['kode']; ?>">
					<input type="hidden" name="nomor" value="<?php echo $no-1; ?>">
                  <div class='box-body'>
                    <?php if ($soal['kode'] == 1) { ?>
					<?php
					           $a = ($jawab['jawaban'] == 'A') ? 'checked' : '';
                                $b = ($jawab['jawaban'] == 'B') ? 'checked' : '';
                                $c = ($jawab['jawaban'] == 'C') ? 'checked' : '';
								$d = ($jawab['jawaban'] == 'D') ? 'checked' : '';
                                $e = ($jawab['jawaban'] == 'E') ? 'checked' : '';
								?>
                       
                      <div class='col-md-12'>
                                <table width='100%' class='table table-striped table-hover'>
                                    <tr>
                                        <td width='60'>
                                            <input class='hidden radio-label' type='radio' name='jawab' id='A' value='A' <?= $a ?> />
                                                <label class='button-label' for='A'>
                                                    <h1>A</h1>
                                                </label>
                                        </td>
                                        <td style='vertical-align:middle;'>
                                            <span class='soal'><?= $soal['pilA'] ?></span>
                                            <?php
                                            if ($soal['fileA'] <> '') {
                                                $ext = explode(".", $soal['fileA']);
                                                $ext = end($ext);
                                                if (in_array($ext, $image)) {
                                                    echo "<img src='$homeurl/files/$soal[fileA]' class='img-responsive' style='max-width:300px;'/>";
                                                } elseif (in_array($ext, $audio)) {
                                                    echo "<audio controls='controls'><source src='$homeurl/files/$soal[fileA]' type='audio/$ext' style='width:100%;'/>Your browser does not support the audio tag.</audio>";
                                                } else {
                                                    echo "File tidak didukung!";
                                                }
                                            }
                                            ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <input class='hidden radio-label' type='radio' name='jawab' id='B' value='B' <?= $b ?> />
                                                <label class='button-label' for='B'>
                                                    <h1>B</h1>
                                                </label>
                                        </td>
                                        <td style='vertical-align:middle;'>
                                            <span class='soal'><?= $soal['pilB'] ?></span>
                                            <?php
                                            if ($soal['fileB'] <> '') {
                                                $ext = explode(".", $soal['fileB']);
                                                $ext = end($ext);
                                                if (in_array($ext, $image)) {
                                                    echo "<img src='$homeurl/files/$soal[fileB]' class='img-responsive' style='max-width:300px;'/>";
                                                } elseif (in_array($ext, $audio)) {
                                                    echo "<audio controls='controls' ><source src='$homeurl/files/$soal[fileB]' type='audio/$ext' style='width:100%;'/>Your browser does not support the audio tag.</audio>";
                                                } else {
                                                    echo "File tidak didukung!";
                                                }
                                            }
                                            ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                           <input class='hidden radio-label' type='radio' name='jawab' id='C' value='C' <?= $c ?> />
                                                <label class='button-label' for='C'>
                                                    <h1>C</h1>
                                                </label>
                                        </td>
                                        <td style='vertical-align:middle;'>
                                            <span class='soal'><?= $soal['pilC'] ?></span>
                                            <?php
                                            if ($soal['fileC'] <> '') {
                                                $ext = explode(".", $soal['fileC']);
                                                $ext = end($ext);
                                                if (in_array($ext, $image)) {
                                                    echo "<img src='$homeurl/files/$soal[fileC]' class='img-responsive' style='max-width:300px;'/>";
                                                } elseif (in_array($ext, $audio)) {
                                                    echo "<audio controls='controls' ><source src='$homeurl/files/$soal[fileC]' type='audio/$ext' style='width:100%;'/>Your browser does not support the audio tag.</audio>";
                                                } else {
                                                    echo "File tidak didukung!";
                                                }
                                            }
                                            ?>
                                        </td>
                                    </tr>
                                    
                                        <tr>
                                            <td>
                                               <input class='hidden radio-label' type='radio' name='jawab' id='D' value='D' <?= $d ?> />
                                                <label class='button-label' for='D'>
                                                    <h1>D</h1>
                                                </label>
                                            </td>
                                            <td style='vertical-align:middle;'>
                                                <span class='soal'><?= $soal['pilD'] ?></span>
                                                <?php
                                                if ($soal['fileD'] <> '') {
                                                    $ext = explode(".", $soal['fileD']);
                                                    $ext = end($ext);
                                                    if (in_array($ext, $image)) {
                                                        echo "<img src='$homeurl/files/$soal[fileD]' class='img-responsive' style='max-width:300px;'/>";
                                                    } elseif (in_array($ext, $audio)) {
                                                        echo "<audio controls='controls' ><source src='$homeurl/files/$soal[fileD]' type='audio/$ext' style='width:100%;'/>Your browser does not support the audio tag.</audio>";
                                                    } else {
                                                        echo "File tidak didukung!";
                                                    }
                                                }
                                                ?>
                                            </td>
                                        </tr>
                                    
                                    <?php if ($setting['jenjang'] == 'SMK') { ?>
                                        <tr>
                                            <td>
                                               <input class='hidden radio-label' type='radio' name='jawab' id='E' value='E' <?= $e ?> />
                                                <label class='button-label' for='E'>
                                                    <h1>E</h1>
                                                </label>
                                            </td>
                                            <td style='vertical-align:middle;'>
                                                <span class='soal'><?= $soal['pilE'] ?></span>
                                                <?php
                                                if ($soal['fileE'] <> '') {

                                                    $ext = explode(".", $soal['fileE']);
                                                    $ext = end($ext);
                                                    if (in_array($ext, $image)) {
                                                        echo "<img src='$homeurl/files/$soal[fileE]' class='img-responsive' style='max-width:300px;'/>";
                                                    } elseif (in_array($ext, $audio)) {
                                                        echo "<audio controls='controls' ><source src='$homeurl/files/$soal[fileE]' type='audio/$ext' style='width:100%;'/>Your browser does not support the audio tag.</audio>";
                                                    } else {
                                                        echo "File tidak didukung!";
                                                    }
                                                }
                                                ?>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </table>
								 </div>
					<?php } ?>
					
                  <?php if ($soal['kode'] == 2) { ?>
				   <?php $checked = explode(', ',$jawab['jawaban']); ?>
                      <div class='col-md-12'>
                                <table width='100%' class='table table-striped table-hover'>
                                    <tr>
                                        <td width='60'>
                                            <label class="checkbox"><input type="checkbox"  name="jawab[]" value="A" <?php in_array ('A', $checked) ? print 'checked' : ''; ?> />
                                           <span class="check"></span>
                                               </label>
                                        </td>
                                        <td style='vertical-align:middle;'>
                                            <span class='soal'><?= $soal['pilA'] ?></span>
                                            <?php
                                            if ($soal['fileA'] <> '') {
                                                $ext = explode(".", $soal['fileA']);
                                                $ext = end($ext);
                                                if (in_array($ext, $image)) {
                                                    echo "<img src='$homeurl/files/$soal[fileA]' class='img-responsive' style='max-width:300px;'/>";
                                                } elseif (in_array($ext, $audio)) {
                                                    echo "<audio controls='controls'><source src='$homeurl/files/$soal[fileA]' type='audio/$ext' style='width:100%;'/>Your browser does not support the audio tag.</audio>";
                                                } else {
                                                    echo "File tidak didukung!";
                                                }
                                            }
                                            ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label class="checkbox"><input type="checkbox"  name="jawab[]" value="B" <?php in_array ('B', $checked) ? print 'checked' : ''; ?> />
                                           <span class="check"></span>
                                               </label>
                                        </td>
                                        <td style='vertical-align:middle;'>
                                            <span class='soal'><?= $soal['pilB'] ?></span>
                                            <?php
                                            if ($soal['fileB'] <> '') {
                                                $ext = explode(".", $soal['fileB']);
                                                $ext = end($ext);
                                                if (in_array($ext, $image)) {
                                                    echo "<img src='$homeurl/files/$soal[fileB]' class='img-responsive' style='max-width:300px;'/>";
                                                } elseif (in_array($ext, $audio)) {
                                                    echo "<audio controls='controls' ><source src='$homeurl/files/$soal[fileB]' type='audio/$ext' style='width:100%;'/>Your browser does not support the audio tag.</audio>";
                                                } else {
                                                    echo "File tidak didukung!";
                                                }
                                            }
                                            ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label class="checkbox"><input type="checkbox"  name="jawab[]" value="C" <?php in_array ('C', $checked) ? print 'checked' : ''; ?> />
                                           <span class="check"></span>
                                               </label>
                                        </td>
                                        <td style='vertical-align:middle;'>
                                            <span class='soal'><?= $soal['pilC'] ?></span>
                                            <?php
                                            if ($soal['fileC'] <> '') {
                                                $ext = explode(".", $soal['fileC']);
                                                $ext = end($ext);
                                                if (in_array($ext, $image)) {
                                                    echo "<img src='$homeurl/files/$soal[fileC]' class='img-responsive' style='max-width:300px;'/>";
                                                } elseif (in_array($ext, $audio)) {
                                                    echo "<audio controls='controls' ><source src='$homeurl/files/$soal[fileC]' type='audio/$ext' style='width:100%;'/>Your browser does not support the audio tag.</audio>";
                                                } else {
                                                    echo "File tidak didukung!";
                                                }
                                            }
                                            ?>
                                        </td>
                                    </tr>
                                   
                                        <tr>
                                            <td>
                                               <label class="checkbox"><input type="checkbox"  name="jawab[]" value="D" <?php in_array ('D', $checked) ? print 'checked' : ''; ?> />
                                           <span class="check"></span>
                                               </label>
                                            </td>
                                            <td style='vertical-align:middle;'>
                                                <span class='soal'><?= $soal['pilD'] ?></span>
                                                <?php
                                                if ($soal['fileD'] <> '') {
                                                    $ext = explode(".", $soal['fileD']);
                                                    $ext = end($ext);
                                                    if (in_array($ext, $image)) {
                                                        echo "<img src='$homeurl/files/$soal[fileD]' class='img-responsive' style='max-width:300px;'/>";
                                                    } elseif (in_array($ext, $audio)) {
                                                        echo "<audio controls='controls' ><source src='$homeurl/files/$soal[fileD]' type='audio/$ext' style='width:100%;'/>Your browser does not support the audio tag.</audio>";
                                                    } else {
                                                        echo "File tidak didukung!";
                                                    }
                                                }
                                                ?>
                                            </td>
                                        </tr>
                                    
                                    <?php if ($setting['jenjang'] == 'SMK') { ?>
                                        <tr>
                                            <td>
                                                <label class="checkbox"><input type="checkbox"  name="jawab[]" value="E" <?php in_array ('E', $checked) ? print 'checked' : ''; ?> />
                                           <span class="check"></span>
                                               </label>
                                            </td>
                                            <td style='vertical-align:middle;'>
                                                <span class='soal'><?= $soal['pilE'] ?></span>
                                                <?php
                                                if ($soal['fileE'] <> '') {

                                                    $ext = explode(".", $soal['fileE']);
                                                    $ext = end($ext);
                                                    if (in_array($ext, $image)) {
                                                        echo "<img src='$homeurl/files/$soal[fileE]' class='img-responsive' style='max-width:300px;'/>";
                                                    } elseif (in_array($ext, $audio)) {
                                                        echo "<audio controls='controls' ><source src='$homeurl/files/$soal[fileE]' type='audio/$ext' style='width:100%;'/>Your browser does not support the audio tag.</audio>";
                                                    } else {
                                                        echo "File tidak didukung!";
                                                    }
                                                }
                                                ?>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </table>
                        </div>
					<?php } ?>
					  <?php if ($soal['kode'] == 3) { ?>
                        <div class='col-md-12'>
                            <textarea id='jawabesai' name='jawab' style='height:100px' class='form-control'><?= $jawab['jawaban'] ?></textarea>
						   <br>
                         </div>
                    <?php } ?>	
					 <?php if ($soal['kode'] == 4) { ?>
					 <?php  $checked = explode(', ',$jawab['jawaban']); ?>
					      
                      <div class='col-md-12'>
                                <table width='100%' class='table table-striped table-hover'>
                                    <tr>
                                        <td width='60'>
                                         
												<label class="radio"><input type="radio" name="jawabana" value="B" <?php if($checked[0]=='B'){echo "checked"; } ?>><h5>Benar</h5><span class="check"></span></label>
											   <br><label class="radio"><input type="radio" name="jawabana" value="S" <?php if($checked[0]=='S'){echo "checked"; } ?>><h5>Salah</h5><span class="check"></span></label>
                                       
                                        </td>
                                        <td style='vertical-align:middle;'>
                                            <span class='soal'><?= $soal['pilA'] ?></span>
                                            <?php
                                            if ($soal['fileA'] <> '') {
                                                $ext = explode(".", $soal['fileA']);
                                                $ext = end($ext);
                                                if (in_array($ext, $image)) {
                                                    echo "<img src='$homeurl/files/$soal[fileA]' class='img-responsive' style='max-width:300px;'/>";
                                                } elseif (in_array($ext, $audio)) {
                                                    echo "<audio controls='controls'><source src='$homeurl/files/$soal[fileA]' type='audio/$ext' style='width:100%;'/>Your browser does not support the audio tag.</audio>";
                                                } else {
                                                    echo "File tidak didukung!";
                                                }
                                            }
                                            ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label class="radio"><input type="radio" name="jawabanb" value="B" <?php if($checked[1]=='B'){echo "checked"; } ?>><h5>Benar</h5><span class="check"></span></label>
											   <br><label class="radio"><input type="radio" name="jawabanb" value="S" <?php if($checked[1]=='S'){echo "checked"; } ?>><h5>Salah</h5><span class="check"></span></label>
                                       
                                        </td>
                                        <td style='vertical-align:middle;'>
                                            <span class='soal'><?= $soal['pilB'] ?></span>
                                            <?php
                                            if ($soal['fileB'] <> '') {
                                                $ext = explode(".", $soal['fileB']);
                                                $ext = end($ext);
                                                if (in_array($ext, $image)) {
                                                    echo "<img src='$homeurl/files/$soal[fileB]' class='img-responsive' style='max-width:300px;'/>";
                                                } elseif (in_array($ext, $audio)) {
                                                    echo "<audio controls='controls' ><source src='$homeurl/files/$soal[fileB]' type='audio/$ext' style='width:100%;'/>Your browser does not support the audio tag.</audio>";
                                                } else {
                                                    echo "File tidak didukung!";
                                                }
                                            }
                                            ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                          <label class="radio"><input type="radio" name="jawabanc" value="B" <?php if($checked[2]=='B'){echo "checked"; } ?>><h5>Benar</h5><span class="check"></span></label>
											   <br><label class="radio"><input type="radio" name="jawabanc" value="S" <?php if($checked[2]=='S'){echo "checked"; } ?>><h5>Salah</h5><span class="check"></span></label>
                                       
                                        </td>
                                        <td style='vertical-align:middle;'>
                                            <span class='soal'><?= $soal['pilC'] ?></span>
                                            <?php
                                            if ($soal['fileC'] <> '') {
                                                $ext = explode(".", $soal['fileC']);
                                                $ext = end($ext);
                                                if (in_array($ext, $image)) {
                                                    echo "<img src='$homeurl/files/$soal[fileC]' class='img-responsive' style='max-width:300px;'/>";
                                                } elseif (in_array($ext, $audio)) {
                                                    echo "<audio controls='controls' ><source src='$homeurl/files/$soal[fileC]' type='audio/$ext' style='width:100%;'/>Your browser does not support the audio tag.</audio>";
                                                } else {
                                                    echo "File tidak didukung!";
                                                }
                                            }
                                            ?>
                                        </td>
                                    </tr>
                                    
                                        <tr>
                                            <td>
                                              <label class="radio"><input type="radio" name="jawaband" value="B" <?php if($checked[3]=='B'){echo "checked"; } ?>><h5>Benar</h5><span class="check"></span></label>
											   <br><label class="radio"><input type="radio" name="jawaband" value="S" <?php if($checked[3]=='S'){echo "checked"; } ?>><h5>Salah</h5><span class="check"></span></label>
                                       
                                            </td>
                                            <td style='vertical-align:middle;'>
                                                <span class='soal'><?= $soal['pilD'] ?></span>
                                                <?php
                                                if ($soal['fileD'] <> '') {
                                                    $ext = explode(".", $soal['fileD']);
                                                    $ext = end($ext);
                                                    if (in_array($ext, $image)) {
                                                        echo "<img src='$homeurl/files/$soal[fileD]' class='img-responsive' style='max-width:300px;'/>";
                                                    } elseif (in_array($ext, $audio)) {
                                                        echo "<audio controls='controls' ><source src='$homeurl/files/$soal[fileD]' type='audio/$ext' style='width:100%;'/>Your browser does not support the audio tag.</audio>";
                                                    } else {
                                                        echo "File tidak didukung!";
                                                    }
                                                }
                                                ?>
                                            </td>
                                        </tr>
                                    
                                    <?php if ($setting['jenjang'] == 'SMK') { ?>
                                        <tr>
                                            <td>
                                               <label class="radio"><input type="radio" name="jawabane" value="B" <?php if($checked[4]=='B'){echo "checked"; } ?>><h5>Benar</h5><span class="check"></span></label>
											   <br><label class="radio"><input type="radio" name="jawabane" value="S" <?php if($checked[4]=='S'){echo "checked"; } ?>><h5>Salah</h5><span class="check"></span></label>
                                       
                                            </td>
                                            <td style='vertical-align:middle;'>
                                                <span class='soal'><?= $soal['pilE'] ?></span>
                                                <?php
                                                if ($soal['fileE'] <> '') {

                                                    $ext = explode(".", $soal['fileE']);
                                                    $ext = end($ext);
                                                    if (in_array($ext, $image)) {
                                                        echo "<img src='$homeurl/files/$soal[fileE]' class='img-responsive' style='max-width:300px;'/>";
                                                    } elseif (in_array($ext, $audio)) {
                                                        echo "<audio controls='controls' ><source src='$homeurl/files/$soal[fileE]' type='audio/$ext' style='width:100%;'/>Your browser does not support the audio tag.</audio>";
                                                    } else {
                                                        echo "File tidak didukung!";
                                                    }
                                                }
                                                ?>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </table>
								 </div>
					<?php } ?>
					
			
				<?php } ?>
  
  
  </div>
   <div class='box-footer navbar-bottom' style='background-color:#2c94de;'>
    <table width='100%'>
                    <tr>
                        <td style="text-align:center">
		<button type="submit" name="sub" id='sub' class="btn btn-success" >Jawab</button> 
            </form>
			
            <?php

                if($jumlah_halaman == $page){
            ?>
			<form method="post" action="" enctype="multipart/form-data">
			<br>
                    <button type='submit' name='submit' id='submit' 
                                class='done-btn btn btn-danger'><i class="fas fa-flag-checkered    "></i> <span class='hidden-xs'>TEST </span>SELESAI</button>
               
                    </form>
                    <?php           
					
 if (isset($_POST['submit'])) {
if($jumlah_data<>$jumlahjawab){
	 echo "
	  <script type='text/javascript'>
		setTimeout(function () { 	
			swal({
				title: 'Gagal!!!',
				text:  'Masih ada soal yang belum dikerjakan',
				type: 'error',
				timer: 2000,
				showConfirmButton: true
			});		
		},10);	
		window.setTimeout(function(){ 
			window.location.replace();
		} ,2000);	
	  </script>";

 }else{
	 
	 $materix=$materi['id_materi'];
	 $iduser=$_SESSION['id_siswa'];
	 $jmlsoal=$jumlah_data;
	$skor=100/$jmlsoal;
	 $tgl=date('Y-m-d');
$benar= mysqli_query($koneksi,"SELECT * FROM jawaban_quiz
JOIN soal_quiz ON soal_quiz.id_bank=jawaban_quiz.idsoal
WHERE jawaban_quiz.jawaban=soal_quiz.jawaban AND jawaban_quiz.iduser='$_SESSION[id_siswa]' AND jawaban_quiz.materi='$materi[id_materi]' ");
$jumlah_benar = mysqli_num_rows($benar);	 

$nilai=$jumlah_benar*$skor;
mysqli_query($koneksi,"INSERT INTO nilaiquiz VALUES('','$iduser','$materix','$nilai','$tgl')");
mysqli_query($koneksi,"INSERT INTO nilai_harian VALUES('','$iduser','$materi[mapel]','$materi[ki]','$materi[kd]','$nilai','Quiz')");
echo "
	  <script type='text/javascript'>
		setTimeout(function () { 	
			swal({
				title: 'Sukses !!!',
				text:  'Nilai telah disimpan',
				type: 'success',
				timer: 2000,
				showConfirmButton: true
			});		
		},10);	
		window.setTimeout(function(){ 
			window.location.replace('$homeurl/hasil');
		} ,2000);	
	  </script>";
 }
 }
 ?>
                                <!-- END Modal Body -->
                            </div>
                        </div>
                    </div>
            <?php    
            }
           
            ?>

            <br>
            
            <div class="text-center">
                <ul class="pagination">
                    <?php if($page == 1){ ?>
                        <li class="disabled"><a href="#">FIRST</a></li>
                        <li class="disabled"><a href="#"><i class="fa fa-angle-left"></i></a></li> 
                    <?php }elseif($page > 1){
                        $link_prev = ($page > 1)? $page - 1 : 1;
                    ?>
                    <li><a href="?pg=soalquiz&tes=1">FIRST</a></li>
                    <li><a href="?pg=soalquiz&tes=<?php echo $link_prev; ?>"><i class="fa fa-angle-left"></i></a></li> 
                    <?php } ?>

                    <?php
                    //buat query untuk menghiung jumlah data
                    $sql2 = mysqli_query($mysqli,"SELECT COUNT(*) AS jumlah FROM soal_quiz where idmateri='$ac'");
                    $get_jumlah = mysqli_fetch_array($sql2);
                    //$jumlah_page = ceil($get_jumlah['jumlah']/$tes);
                    $jumlah_number = 2;
                    $start_number = ($page > $jumlah_number)? $page - $jumlah_number : 1;
                    $end_number = ($page < ($jumlah_halaman - $jumlah_number))? $page + $jumlah_number : $jumlah_halaman;
                    for($i = $start_number; $i <= $end_number; $i++){
                        $link_active = ($page == $i)? ' class="active"' : '';
                    ?>
                        <li<?php echo $link_active; ?>><a href="?pg=soalquiz&tes=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                        <?php
        }
        ?>

<?php
        // Jika page sama dengan jumlah page, maka disable link NEXT nya
        // Artinya page tersebut adalah page terakhir 
        if($page == $jumlah_halaman){ // Jika page terakhir
        ?>
          <li class="disabled"><a href="#"><i class="fa fa-angle-right"></i></a></li>
          <li class="disabled"><a href="#">LAST</a></li>
        <?php
        }else{ // Jika Bukan page terakhir
          $link_next = ($page < $jumlah_halaman)? $page + 1 : $jumlah_halaman;
        ?>
          <li><a href="?pg=soalquiz&tes=<?php echo $link_next; ?>"><i class="fa fa-angle-right"></i></a></li>
          <li><a href="?pg=soalquiz&tes=<?php echo $jumlah_halaman; ?>">LAST</a></li>
        <?php
        }
        ?>

                    
            <?php //} ?>
                </ul>
            </div>
			 </td>
                    </tr>
                </table>
    <!-- END Update Status Form -->
</div>


								  <script>
        $(document).ready(function() {
            $('#zoom').zoom();
            $('#zoom1').zoom();
            $('.lup').zoom();
            $('.soal img')
                .wrap('<span style="display:inline-block"></span>')
                .css('display', 'block')
                .parent()
                .zoom();
        });
    </script>
	<script>
$("#sub").click(function() {
	$.post($("#myForm").attr("action"), $("#myForm :input").serializeArray(), function(info) { $("#result").html(info); });
	clearInput();
});
 
$("#myForm").submit(function(){
	return false;
});
 
function clearInput(){
	$("#myForm :input").each(function(){
		$(this).val('');
	});
};
</script>