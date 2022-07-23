<?php defined('BASEPATH') or die("ip anda sudah tercatat oleh sistem kami") ?>

<div class="section-header">
   
</div>

 <div class='row'>
        <div class='col-md-12'>
            <div class='box box-solid'>
                <div class='box-header with-border '>
                    <h3 class='box-title'><i class="fas fa-user-friends fa-fw   "></i> CETAK RAPOR</h3>
                    <div class='box-tools pull-right'>
					 <a href="?pg=raporadmin" class="btn btn-sm btn-primary btn-rounded" >
                                          <i class="fas fa-home"></i> Kembali</button></a>				
		  </div>	
 </div>
            <div class='box-body'>
                    <div class='table-responsive'>
                      <table id='tabelabsen' class='table table-bordered table-striped'>
                            <thead>
                            <tr>
                                <th width="5%" class="text-center">
                                    #
                                </th>
                                <th width="20%">Nis</th>
                                <th>Nama Siswa</th>
								<th width="5%">Cover</th>
								<th width="5%">Biodata</th>
								<th width="5%">Nilai</th>
							
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $query = mysqli_query($koneksi, "select * from siswa WHERE id_kelas='$_GET[kelas]' order by id_siswa ASC");
                            $no = 0;
                            while ($siswa = mysqli_fetch_array($query)) {
                                $no++;
                            ?>
                                <tr>
                                    <td><?= $no; ?></td>
                                    <td><?= $siswa['nis'] ?></td>
                                    <td><?= $siswa['nama'] ?></td>
									 <td>
										   <a target="_blank" href="mod_admin/print_cover.php?nis=<?= $siswa['nis'] ?>" class="btn btn-sm btn-success btn-rounded">
                                          <i class="fas fa-print"></i></button></a>                                        
										   </td>
									<td>
										   <a target="_blank" href="mod_admin/print_biodata.php?nis=<?= $siswa['nis'] ?>" class="btn btn-sm btn-primary btn-rounded">
                                          <i class="fas fa-print"></i></button></a>                                        
										   </td>
                                         <td>
										   <a target="_blank" href="mod_admin/print_raport.php?nis=<?= $siswa['nis'] ?>" class="btn btn-sm btn-danger btn-rounded">
                                          <i class="fas fa-print"></i></button></a>                                        
										   </td>
<?php
                                    }
                                    ?>
                                </tr>
                        </tbody>
                    </table>
                </div>
            </div>
       </div>
	
           