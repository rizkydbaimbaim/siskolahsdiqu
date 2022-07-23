<?php defined('BASEPATH') or die("ip anda sudah tercatat oleh sistem kami") ?>
<?php
$id=$_GET['id'];
$jadwal=fetch($koneksi,'jadwal_mapel',['id_jadwal' =>$id]);
$mapel=$jadwal['mapel'];
$kode=$jadwal['kode'];
$klas=$jadwal['kelas'];
?>
<div class="section-header">
    <div class='row'>
        <div class='col-md-12'>
            <div class='box box-solid'>
                <div class='box-header with-border '>
                    <h3 class='box-title' style="color: red">NILAI <?= strtoupper($mapel) ?> (KI-3)</h3>
                    <div class='box-tools pull-right'>
				      <a href="?pg=hapus_nilai3&idmap=<?php echo $kode ?>&kelas=<?php echo $klas ?>"  class='btn btn-sm btn-danger'><i class='glyphicon glyphicon-trash'></i></i> <span class='hidden-xs'>Reset Nilai</span></a>
					  <a target="_blank" href="mod_ki3/cetaknilai3.php?idmap=<?php echo $id ?>&kelas=<?php echo $klas ?>"  class='btn btn-sm btn-success'><i class='glyphicon glyphicon-print'></i></i> <span class='hidden-xs'>Cetak</span></a>
		   <a href="?pg=nk3" class="btn btn-sm btn-primary btn-rounded" >
                                          <i class="fas fa-home"></i> Kembali</button></a>
		  </div>
         </div>
            <div class='box-body'>
                   <div class='table-responsive'>
                        <table style="font-size: 11px" id='tabeldeskrip' class='table table-bordered table-striped'>
                            <thead>
                            <tr>
                             <th width="5%" class="text-center">
                                    #
                                </th>
                                <th width="20%">NIS</th>
							<th>Nama</th>
							<th width="5%">Kelas</th>
							<th width="5%">KKM</th>
							<th width="5%">NR</th>
							<th width="5%">Pred</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                           $query = mysqli_query($koneksi, "select  AVG(nilai_ph.nilai) as rata,siswa.nis,siswa.nama,siswa.id_kelas from nilai_ph
			               LEFT JOIN siswa ON siswa.nis=nilai_ph.nis
                           WHERE nilai_ph.nilai>'0' AND nilai_ph.mapel='$kode' AND nilai_ph.kelas='$klas' GROUP BY nilai_ph.nis");
                            $no = 0;
                            while ($siswa = mysqli_fetch_array($query)) {
								$rata=round($siswa['rata']);
							$rentang=round(100-$jadwal['kkm'])/3;		
							$predD=round($jadwal['kkm']-1);
                            $nilC1=round($jadwal['kkm']);
							 $nilC2=round($rentang+$jadwal['kkm']);
							 
							$nilB1=round($nilC2+1);
							$nilB2=round($nilC2+$rentang);
			
							$nilA1=round($nilB2+1);
							$nilA2=round($nilB2+$rentang);
							
							
if($rata<=$predD){
{$grade="D";}
}elseif($rata>=$nilC1 && $rata<=$nilC2){
{$grade="C";}
}elseif($rata>=$nilB1 && $rata<=$nilB2){
{$grade="B";}
}elseif($rata>=$nilA1 && $rata<=$nilA2){
{$grade="A";}
}	
								
								
                                $no++;
                            ?>
                                <tr>
                                    <td><?= $no; ?></td>
                                    <td><?= $siswa['nis'] ?></td>
                                    <td><?= $siswa['nama'] ?></td>
									<td><?= $siswa['id_kelas'] ?></td>
									<td><?= $jadwal['kkm'] ?></td>
									<td><?= round($siswa['rata'] )?></td>
									<td><?= $grade ?></td>
							
                                </tr>
								
							
                            <?php }
                            ?>



                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $('#tabeldeskrip').on('click', '.hapus', function() {
       var id = $(this).data('id');
        console.log(id);
        swal({
            title: 'Are you sure?',
            text: 'Akan menghapus data ini!',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'iya, hapus'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: 'mod_deskrip3/crud_deskripsi.php?pg=hapus',
                    method: "POST",
                    data: 'id=' + id,
                    success: function(data) {
                        iziToast.error({
                            title: 'Horee!',
                            message: 'Data Berhasil dihapus',
                            position: 'topRight'
                        });
                        setTimeout(function() {
                            window.location.reload();
                        }, 2000);
                    }
                });
            }
        })

    });
   
</script>