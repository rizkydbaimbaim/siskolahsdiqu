<?php
defined('APLIKASI') or exit('Anda tidak dizinkan mengakses langsung script ini!');
?>
    <div class='row'>
        <div class='col-md-12'>
            <div class='box box-solid'>
                <div class='box-header with-border '>
                    <h3 class='box-title'><i class="fas fa-user-friends fa-fw   "></i> Data Siswa</h3>
                    <div class='box-tools pull-right'>
                    </div>
                </div><!-- /.box-header -->
                <div class='box-body'>
                    <div class='table-responsive'>
                        <table style="font-size: 11px" id='tabelsiswa' class='table table-bordered table-striped'>
                            <thead>
                                <tr>
                                    <th width='3px'></th>
                                    <th>NIS</th>
                                    <th>NISN</th>
                                    <th>Nama</th>
                                    <th>Kelas</th>
                                    <th>Tempat, Tgl Lahir</th>
                                    <th>JK</th>
                                    <th>Agama</th>
                                    <th>Photo</th>
									<th>Upload</th>
                                </tr>
                            </thead>
							  </thead>
							
							<tbody>
							
                                <?php
								$no = 0;
								 $query = mysqli_query($koneksi, "select * from siswa_rapor");
                            while ($siswa = mysqli_fetch_array($query)) {
                                $no++;
                            ?>
							 <tr>
                                    <td><?= $no; ?></td>
                                    <td><?= $siswa['nis'] ?></td>
							        <td><?= $siswa['nisn'] ?></td>
                                    <td><?= $siswa['nama'] ?></td>
                                     <td><?= $siswa['kelas'] ?></td>
                                     <td><?= $siswa['tempat'] ?>, <?= $siswa['tgl_lahir'] ?></td>
                                     <td><?= $siswa['jk'] ?></td>
								     <td><?= $siswa['agama'] ?></td>
									
                                     <td>
									  <?php if($siswa['photo']==''){ ?>
									 <img src="../dist/img/avatar.png" width="42">
									 <?php }else{ ?>
									 <img src="../foto/fotosiswa/<?= $siswa['photo'] ?>" width="42">
									 <?php } ?>
									 </td>
								  <td>
                                     <a href="?pg=ubahphoto&id=<?= $siswa['id'] ?>" class="btn btn-sm btn-primary">
                                            <i class="fas fa-edit"></i> 
                                        </button>  
                                    </td>									
							</tr>
                    
                            <?php } ?>
                        </tbody>
                        </table>
                    </div>
                    
            </div><!-- /.box -->
        </div>
    </div>
