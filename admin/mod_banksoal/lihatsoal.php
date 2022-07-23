<?php
defined('APLIKASI') or exit('Anda tidak dizinkan mengakses langsung script ini!');


$namamapel = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM mapel WHERE id_mapel='$_GET[id]'"));
$tgl_ujian = explode(' ', $value['tgl_ujian']);

?>
   
    <div class='row'>
    <div class='col-md-12'>
        <div class="box box-solid">
            
            <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-th-large fa-2x fa-fw"></i> Group Soal <?= $namamapel['groupsoal'] ?></h3>
            </div>
            <div class="box-body no-padding ">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true"><i class="fa fa-th-large"></i> Soal Pilihan Ganda</a></li>
                        <li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="false">Soal Benar Salah</a></li>
                        <li class=""><a href="#tab_3" data-toggle="tab" aria-expanded="false">Soal Pilihan Ganda Kompleks</a></li>
                        <li class=""><a href="#tab_4" data-toggle="tab" aria-expanded="false">Soal Mengurutkan</a></li>

                    </ul>
                     <div class="tab-content">
                      <div class="tab-content">
                        <div class="tab-pane active" id="tab_1">
                            <div class='box-header with-border '>
                    <h3 class='box-title'><i class="fas fa-edit fa-fw   "></i><?= $namamapel['nama'] ?> (PG)</h3>
                    <div class='box-tools pull-right'>
                      
                                <a href='?pg=tambahpg&id=<?= $namamapel[id_mapel] ?>' class='btn btn-sm btn-primary'><i class='glyphicon glyphicon-plus'></i> <span class='hidden-xs'>Tambah</span></a>
                           
                    </div>
                </div>
                                
                                   <div class='box-body'>
                    <div class='table-responsive'>
                        <table style="font-size: 11px" id='tabelsiswa' class='table table-bordered table-striped'>
                            <thead>
                                <tr>
                                    <th width='3px'>No</th>
                                    <th>Soal</th>
                                    <th>Pembahasan</th>
                                    <th>Jawaban</th>
                                    <th>Action</th>
                                   
									 </tr>
                            </thead>
<tbody>

    </tbody>
    </table>
                     
                    </div>
                      </div>
                        </div>
					    
						  
                        <div class="tab-pane" id="tab_2">
                         
                      <div class='box-header with-border '>
                    <h3 class='box-title'><i class="fas fa-edit fa-fw   "></i> <?= $namamapel['nama'] ?> (Benar Salah)</h3>
                    <div class='box-tools pull-right'>
                      
                                <a data-toggle='modal' data-backdrop="static" data-target='#tambahsiswa' class='btn btn-sm btn-primary'><i class='glyphicon glyphicon-plus'></i> <span class='hidden-xs'>Tambah</span></a>
                            <a href='mod_siswa/ekspor_siswa.php' class='btn btn-sm btn-success'><i class='fa fa-download'></i> <span class='hidden-xs'>Download Data</span></a>
                      
                    </div>
                </div>
                                
                                   <div class='box-body'>
                    <div class='table-responsive'>
                        <table style="font-size: 11px" id='tabelsiswa' class='table table-bordered table-striped'>
                            <thead>
                                <tr>
                                    <th width='3px'>No</th>
                                    <th>Soal</th>
                                    <th>Pembahasan</th>
                                    <th>Jawaban</th>
                                    <th>Action</th>
                                   
									 </tr>
                            </thead>
<tbody>

    </tbody>
    </table>
                     
                    </div>
                      </div>
                        </div>
					   
                        <div class="tab-pane" id="tab_3">
                            <div class='box-header with-border '>
                    <h3 class='box-title'><i class="fas fa-edit fa-fw   "></i> Soal  <?= $namamapel['nama'] ?></h3>
                    <div class='box-tools pull-right'>
                      
                                <a data-toggle='modal' data-backdrop="static" data-target='#tambahsiswa' class='btn btn-sm btn-primary'><i class='glyphicon glyphicon-plus'></i> <span class='hidden-xs'>Tambah</span></a>
                            <a href='mod_siswa/ekspor_siswa.php' class='btn btn-sm btn-success'><i class='fa fa-download'></i> <span class='hidden-xs'>Download Data</span></a>
                      
                    </div>
                </div>
                                
                                   <div class='box-body'>
                    <div class='table-responsive'>
                        <table style="font-size: 11px" id='tabelsiswa' class='table table-bordered table-striped'>
                            <thead>
                                <tr>
                                    <th width='3px'>No</th>
                                    <th>Soal</th>
                                    <th>Pembahasan</th>
                                    <th>Jawaban</th>
                                    <th>Action</th>
                                   
									 </tr>
                            </thead>
<tbody>

    </tbody>
    </table>
                     
                    </div>
                      </div>
                        </div>
						
						
                        <div class="tab-pane" id="tab_4">
                            <div class='box-header with-border '>
                    <h3 class='box-title'><i class="fas fa-edit fa-fw   "></i> Soal  <?= $namamapel['nama'] ?></h3>
                    <div class='box-tools pull-right'>
                      
                                <a data-toggle='modal' data-backdrop="static" data-target='#tambahsiswa' class='btn btn-sm btn-primary'><i class='glyphicon glyphicon-plus'></i> <span class='hidden-xs'>Tambah</span></a>
                            <a href='mod_siswa/ekspor_siswa.php' class='btn btn-sm btn-success'><i class='fa fa-download'></i> <span class='hidden-xs'>Download Data</span></a>
                      
                    </div>
                </div>
                                
                                   <div class='box-body'>
                    <div class='table-responsive'>
                        <table style="font-size: 11px" id='tabelsiswa' class='table table-bordered table-striped'>
                            <thead>
                                <tr>
                                    <th width='3px'>No</th>
                                    <th>Soal</th>
                                    <th>Pembahasan</th>
                                    <th>Jawaban</th>
                                    <th>Action</th>
                                   
									 </tr>
                            </thead>
<tbody>

    </tbody>
    </table>
                     
                    </div>
                      </div>
                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                 