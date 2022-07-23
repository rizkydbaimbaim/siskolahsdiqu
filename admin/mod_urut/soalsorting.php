<?php
$data = mysqli_query($mysqli,
"select gs.idgurumapel, u.iduser
from groupsoal as gs
inner join gurumapel as gm
on gm.idgurumapel = gs.idgurumapel
inner join user as u
on u.iduser = gm.iduser
where gs.idgroup  = '$idgroup'");
$d = mysqli_fetch_array($data);
if($_SESSION['iduser'] == $d['iduser']){
?>
 <a href="index.php?tambahsoalsorting&idgroup=<?php echo $idgroup; ?>" title="Tambah Soal" class="btn btn-sm btn-info">Tambah</a>
 <button type="reset" class="btn btn-sm btn-success" title="Import Soal" onclick="$('#modal-import-soalsorting').modal('show');">Import dari Excel</button>
                <div class="modal fade" id="modal-import-soalsorting" role="dialog">
                    <div class="modal-dialog">

                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header text-center">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                                <h3 class="modal-title"></i>Import Soal</h3>
                            </div>
                            <!-- END Modal Header -->

                            <!-- Modal Body -->
                            <div class="modal-body">
                                <form action="detailsoal/import.php" method="post" enctype="multipart/form-data" class="form-horizontal form-bordered">
                                <input type="hidden" value="<?php echo $idgroup; ?>" name="idgroup">
                                <input type="hidden" value="sorting" name="jenissoal">
                                <div class="form-group">
                                    <label class="col-md-3 control-label" for="example-hf-email">Import Soal</label>
                                    <div class="col-md-9">
                                        <input type="file" name="import"> 
                                    </div>
                                </div>
                                <div class="form-group form-actions">
                                    <div class="col-md-9 col-md-offset-3">
                                        <button type="submit" name="upload" value="import" class="btn btn-sm btn-primary">Import Data</button>
                                    </div>
                                </div>
                                </form>
                            </div>
                            <!-- END Modal Body -->
                        </div>
                    </div>
                </div>           
<?php  } ?>
            <a title="Export Soal" href="detailsoal/eksportexcel.php?idgroup=<?php echo $idgroup; ?>&jenissoal=sorting" class="btn btn-sm btn-success">Export Ke Excel</a>
            <br>
            <br>
<div class="table-responsive">
    <table id="example-datatable" class="table table-striped">
        <thead>
            <tr>
                <th class="text-center">No</th>
                <th class="text-center"></th>
                <th class="">Soal</th>
                <th width="300" class="">pembahasan</th>
                <th width="150" class="text-center">Jawaban Benar</th>
                <th class="text-center">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            $tampil = mysqli_query($mysqli, "select * from soal where jenissoal='sorting' and idgroup=$idgroup");
            while ($hasil = mysqli_fetch_array($tampil)) { ?>
            <tr>
                <td class="text-center"><?php echo $no++; ?></td>
                <td class="text-center"></td>
                <td><?php echo $hasil['soal']; ?></td>
                <td width="300" ><?php if($hasil['pembahasan']==''){echo 'tidak ada pembahasan untuk soal ini';}else{echo $hasil['pembahasan'];} ?></td>
                <td width="150" class="text-center"><?php echo $hasil['pilihanbenar']; ?></td>
                
                
                <?php if($_SESSION['iduser']==$d['iduser']){?>
                    <td class="text-center">
                    <a title="Edit" href="index.php?editsoalpilihanganda&idgroup=<?php echo $idgroup; ?>&idsoal=<?php echo $hasil['idsoal']; ?>" class="btn btn-sm btn-info"><i class="fa fa-edit"></i></a>
                    <a title="Delete" onclick="return confirm('apakah anda yakin ingin menghapus data? ');" href="detailsoal/soalpilihanganda/proseshapus.php?idsoal=<?php echo $hasil['idsoal']; ?>&idgroup=<?php echo $hasil['idgroup']; ?>" title="Delete" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a
                </td>
    <?php }else{?>
        <td class="text-center">
            <span class="label label-danger">You Are Not Author</span>
        </td>
    <?php }?>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
<script src="js/pages/datatablesoalsorting.js"></script>

