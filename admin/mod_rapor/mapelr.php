<?php
defined('APLIKASI') or exit('Anda tidak dizinkan mengakses langsung script ini!');
?>
    <div class='row'>
        <div class='col-md-12'>
            <div class='box box-solid'>
                <div class='box-header with-border '>
                    <h3 class='box-title'><i class="fas fa-book fa-fw   "></i> KKM Mapel Kelas</h3>
                    <div class='box-tools pull-right'>
					
                    </div>
                </div><!-- /.box-header -->
                <div class='box-body'>
                    <div class='table-responsive'>
                        <table style="font-size: 11px" id='tabelmapel' class='table table-bordered table-striped'>
                            <thead>
                                <tr>
                                    <th width='3px'>No</th>
									  <th width='5%'>Kelas</th>
                                    <th width='5%'>No Urut</th>
                                    <th>Nama Mapel</th>  
                                     <th width='10%'>Kelompok</th> 
									 <th width='5%'>KKM</th>
                                     <th>Guru Mapel</th> 									 
									<th width='5%'>Edit</th>
                                </tr>
                            </thead>
							  </thead>
							
							<tbody>
							
                                <?php
								$no = 0;
								 $query = mysqli_query($koneksi, "select * from jadwal_mapel
								 JOIN pengawas ON pengawas.id_pengawas=jadwal_mapel.guru ORDER BY kelas ASC");
                            while ($mapel = mysqli_fetch_array($query)) {
                                $no++;
                            ?>
							 <tr>
                                    <td><?= $no; ?></td>
									 <td><?= $mapel['kelas'] ?></td>
                                    <td><?= $mapel['urut'] ?></td>
							        <td><?= $mapel['mapel'] ?></td>
									<td><?= $mapel['kelompok'] ?></td>
									<td><?= $mapel['kkm'] ?></td>
									<td><?= $mapel['nama'] ?></td>
                                   <td>
                                       <button type="button" class="btn btn-sm btn-primary btn-rounded" data-toggle="modal" data-target="#modal<?= $no ?>">
                                          <i class="fas fa-edit"></i>
                                        </button>
										<div class="modal fade" id="modal<?= $no ?>" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                                             <div class='modal-dialog'>
                            <div class='modal-content'>
                                <div class='modal-header bg-blue'>
                                    <button class='close' data-dismiss='modal'><span aria-hidden='true'><i class='glyphicon glyphicon-remove'></i></span></button>
                                    <h4 class='modal-title'> </h4>
                                </div>
                                <div class='modal-body'>
                                     <form action='' method='post'>
									 <input type="hidden" name="idj" value="<?= $mapel['id_jadwal'] ?>" class="form-control" >
									<div class="col-md-6">
                                        <div class='form-group'>
                                                   <label>Kelas</label>
                                                    <select name='kelas' class='form-control' required='true' disabled>
                                                        <option value="<?= $mapel['kelas'] ?>"><?= $mapel['kelas'] ?></option>
                                                        
                                                    </select>
                                                </div>
												</div>
												<div class="col-md-6">
                                          <div class='form-group'>
                                                   <label>Kode Mapel</label>
                                                    <select name='kode' class='form-control' required='true' disabled>
                                                        <option value="<?= $mapel['kelas'] ?>"><?= $mapel['kode'] ?></option>
                                                       
                                                    </select>
                                                </div>
												</div>
												<div class="col-md-12">
                                          <div class='form-group'>
                                                   <label>Nama Mapel</label>
                                                    <select name='mapel' class='form-control' required='true' disabled>
                                                        <option value="<?= $mapel['kelas'] ?>"><?= $mapel['mapel'] ?></option>
                                                       
                                                    </select>
                                                </div>
												</div>
												<div class="col-md-6">
                                        <div class='form-group'>
                                                   <label>Apakah Mapel Agama ?</label>
                                                    <select name='agama' class='form-control' required='true'>
                                                        <option value='0'>Bukan</option>
                                                        <option value='1'>Ya </option>
                                                    </select>
                                                </div>
												</div>
												<div class="col-md-6">
												<div class='form-group'>
                                                   <label>Apakah Mapel PPKn ?</label>
                                                    <select name='ppkn' class='form-control' required='true'>
                                                        <option value='2'>Bukan</option>
                                                        <option value='1'>Ya </option>
                                                    </select>
                                                </div>
												</div>
												<div class="col-md-6">
												 <div class='form-group'>
                                                   <label>No Urut Mapel</label>
                                                    <select name='urut' class='form-control' required='true'>
													    <option value="<?= $mapel['urut'] ?>"><?= $mapel['urut'] ?></option>
														<?php if($setting['jenjang']=='SMK'){ ?>
                                                        <option value='1'>1</option>
                                                         <option value='2'>2</option>
														  <option value='3'>3</option>
														   <option value='4'>4</option>
														    <option value='5'>5</option>
															 <option value='6'>6</option>
															  <option value='7'>7</option>
															   <option value='8'>8</option>
															    <option value='9'>9</option>
																 <option value='10'>10</option>
																  <option value='11'>11</option>
																   <option value='12'>12</option>
																    <option value='13'>13</option>
														            <option value='14'>14</option>
																	 <option value='15'>15</option>
																	  <option value='16'>16</option>
																	   <option value='17'>17</option>
																	    <option value='18'>18</option>
																		 <option value='19'>19</option>
																		  <option value='20'>20</option>
																		   <option value='21'>21</option>
																		    <option value='22'>22</option>
																			 <option value='23'>23</option>
																			  <option value='24'>24</option>
                                                                                     <?php }else{ ?>
																					  <option value='1'>1</option>
                                                         <option value='2'>2</option>
														  <option value='3'>3</option>
														   <option value='4'>4</option>
														    <option value='5'>5</option>
															 <option value='6'>6</option>
															  <option value='7'>7</option>
															   <option value='8'>8</option>
															    <option value='9'>9</option>
																 <option value='10'>10</option>
																  <option value='11'>11</option>
																   <option value='12'>12</option>
																    <option value='13'>13</option>
																	<?php } ?>
																   </select>
                                                                          </div>
												                           </div>
												<div class="col-md-6">
												 <div class='form-group'>
                                                   <label>Kelompok</label>
                                                    <select name='kelompok' class='form-control' required='true'>
													
													    <option value="<?= $mapel['kelompok'] ?>"><?= $mapel['kelompok'] ?></option>
														<?php if($setting['jenjang']=='SMK'){ ?>
                                                        <option value='Muatan Nasional'>Muatan Nasional</option>
                                                         <option value='Muatan Kewilayahan'>Muatan Kewilayahan</option>
														  <option value='Muatan Peminatan dan Kejuruan'>Muatan Peminatan dan Kejuruan</option>
														<?php }else{ ?>
												       <option value='Kelompok A'>A</option>
                                                         <option value='Kelompok B'>B</option>
														  <option value='Kelompok C'>C</option>
														<?php } ?>
														  </select>
                                               </div>
											   </div>
											   <div class="col-md-6">
											   <div class='form-group'>
                                                   <label>KKM</label>
                                                    <input type="number" name="kkm" class="form-control" value="<?= $mapel['kkm'] ?>" required='true'>
                                                </div>
												</div>
												<div class="col-md-6">
											   <div class='form-group'>
                                                   <label>Guru Mapel</label>
                                                    <select name='guru' class='form-control' required='true' disabled>
                                                         <option value="<?= $mapel['nama'] ?>"><?= $mapel['nama'] ?></option>
                                                    </select>
                                                </div>
												</div>
                                        <div class='modal-footer'>
                                            <div class='box-tools pull-right btn-group'>
                                                <button type='submit' name='submit' class='btn btn-sm btn-primary'><i class='fa fa-check'></i> Simpan</button>
                                                <button type='button' class='btn btn-default btn-sm pull-left' data-dismiss='modal'>Close</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
										</td>			
							       </tr>
                    
                            <?php } ?>
                        </tbody>
                        </table>
                    </div>
                     </div>
                            </div>
                        </div>
                    </div>
         
 <?php
            
            if (isset($_POST['submit'])) {
                $idj = $_POST['idj'];
				
               $agama = $_POST['agama'];
                $ppkn = $_POST['ppkn'];
                $urut = $_POST['urut'];
                $kelompok = $_POST['kelompok'];
                $kkm = $_POST['kkm'];
				
                if ($agama <> '' and $ppkn <> '') {
                    if ($agama == $ppkn) {
                       echo "
	  <script type='text/javascript'>
		setTimeout(function () { 	
			swal({
				title: 'Gagal !!!',
				text:  'Data Gagal di simpan',
				type: 'error',
				timer: 2000,
				showConfirmButton: true
			});		
		},10);	
		window.setTimeout(function(){ 
			window.location.replace('?pg=mapelr');
		} ,2000);	
	  </script>";
                    
					} else {   
		 $exec = mysqli_query($koneksi, "UPDATE jadwal_mapel SET urut='$urut' ,kelompok='$kelompok',kkm='$kkm',agama='$agama',ppkn='$ppkn' WHERE id_jadwal='$idj' ");			   
                   echo "
	  <script type='text/javascript'>
		setTimeout(function () { 	
			swal({
				title: 'Sukses !!!',
				text:  'Data berhasil di simpan',
				type: 'success',
				timer: 2000,
				showConfirmButton: true
			});		
		},10);	
		window.setTimeout(function(){ 
			window.location.replace('?pg=mapelr');
		} ,2000);	
	  </script>";
				   }
                }
            }
            ?>
	
	