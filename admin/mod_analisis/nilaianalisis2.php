<?php
defined('APLIKASI') or exit('Anda tidak dizinkan mengakses langsung script ini!');
?>
<?php if ($ac == '') : ?>
    <?php

    if (empty($_GET['kelas'])) {
        $id_kelas = "";
        $sqlkelas = "";
    } else {
        $id_kelas = $_GET['kelas'];
        $sqlkelas = " and a.id_kelas ='" . $_GET['kelas'] . "'";
    }
    if (empty($_GET['id'])) {
        $id_mapel = "";
    } else {
        $id_mapel = $_GET['id'];
    }
    $mapel = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM mapel where id_mapel='$id_mapel' "));

    ?>
    <div class='row'>
        <div class='col-md-12'>
            <div class='box box-solid'>
                <div class='box-header with-border'>
                    <h3 class='box-title'> ANALISIS BUTIR SOAL <?= $mapel['nama'] ?></h3>
                    <div class='box-tools pull-right btn-grou'>
                        
                    </div>
                </div><!-- /.box-header -->
                <div class='box-body'>
                    <div class="row" style="padding-bottom: 10px;">
                        <!-- mryes -->
                        <div class="col-md-3">

                            <select class="form-control select2 kelas">
                                <?php $kelas = mysqli_query($koneksi, "select * from siswa a join nilai b on a.id_siswa=b.id_siswa group by a.id_kelas"); ?>
                                <option value=''> Pilih Kelas</option>
                                <?php while ($kls = mysqli_fetch_array($kelas)) : ?>
                                    <option <?php if ($id_kelas == $kls['id_kelas']) {
                                                echo "selected";
                                            } else {
                                            } ?> value="<?= $kls['id_kelas'] ?>"><?= $kls['id_kelas'] ?></option>
                                <?php endwhile; ?>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <select class="form-control select2 ujian">
                                <?php $ujian = mysqli_query($koneksi, "select * from mapel a join nilai b ON a.id_mapel=b.id_mapel group by a.id_mapel"); ?>
                                <option> Pilih Mata Pelajaran</option>
                                <?php while ($uj = mysqli_fetch_array($ujian)) : ?>
                                    <option <?php if ($id_mapel == $uj['id_mapel']) {
                                                echo "selected";
                                            } else {
                                            } ?> value="<?= $uj['id_mapel'] ?>"><?= $uj['kode'] ?> - <?= $uj['nama'] ?></option>
                                <?php endwhile; ?>
                            </select>
                        </div>
						<div class="col-md-3">
						</div>
                        <div class="col-md-3">

                            <button id="cari_nilai" class="btn btn-success">Cari Analisis</button>
							<a target="_blank" href="../files/Analisis Soal.pdf" class="btn btn-danger"> Rumus Analisis</button></a>
                            <script type="text/javascript">
                                $('#cari_nilai').click(function() {
                                    var kelas = $('.kelas').val();
                                    var ujian = $('.ujian').val();
                                    location.replace("?pg=analisis&kelas=" + kelas + "&id=" + ujian);
                                }); //ke url
                            </script>

                        </div>
                        <!-- mryes -->
                    </div>
                    
    <?php
    

    
    $nilai = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM nilai WHERE id_mapel='$_GET[id]'"));
    $mapel = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM mapel where id_mapel='$id_mapel'"));
   
    ?>
    <div class='row'>
        <div class='col-md-12'>
            <div class='box box-solid'>
                <div class='box-header with-border '>
                    <h3 class='box-title'>Analisi Butir Soal</h3>
                    <div class='box-tools pull-right btn-group'>
                        <!-- <button class='btn btn-sm btn-primary' onclick="frames['framejawab'].print()"><i class='fa fa-print'></i> Print</button> -->
                        <!-- <i class='btn btn-sm btn-danger' href='?pg=nilai&ac=lihat&id=<?= $idmapel ?>'><i class='fa fa-times'></i></a> -->
                        <!-- <iframe name='framejawab' src='printjawab.php?m=<?= $idmapel ?>&s=<?= $id_siswa ?>' style='display:none;'></iframe> -->
                    </div>
                </div><!-- /.box-header -->
				
				 <?php 
				
				 $jumlah_siswa = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM siswa WHERE id_kelas='$id_kelas'"));
				 ?>
				 <?php 
				 $jsiswas = $koneksi->query("SELECT COUNT(ids) AS jm FROM nilai2 WHERE id_kelas='$id_kelas' GROUP BY ids"); 
				 $jsis = mysqli_fetch_array($jsiswas);
				 ?>
				  <?php 
				 $jumlah_soal = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM soal WHERE id_mapel='$id_mapel'"));
				 ?>
                <div class='box-body'>
				  
                    <table  class='table table-bordered table-striped'>
                        <tr>
                            <th>Kelas</th>
                            <td width='10'>:</td>
                            <td><?= $id_kelas ?></td>
                             <td width='50'></td>
                            <th>Jml Siswa</th>
                            <td width='10'></td>
                            <td><?= $jumlah_siswa ?></td>
                        </tr>
                        <tr>
                            <th>Mata Pelajaran</th>
                            <td width='10'>:</td>
                            <td><?= $mapel['kode'] ?></td>
                           <td width='50'></td>
                            <th>Kelompok Soal</th>
                            <td width='10'>:</td>
                            <td><?= $mapel['groupsoal'] ?></td>
                        </tr>
						 <tr>
                            <th>Jumlah Soal</th>
                            <td width='10'>:</td>
                            <td><?= $jumlah_soal ?></td>
							<td width='50'></td>
							<td></td>
							<td></td>
							<td></td>
                        </tr>
                    </table>
					<br>
                     <h4>Soal Pilihan Ganda</h4>
                    <div class='table-responsive'>
                        <table class='table table-bordered'>
                            <thead>
							<tr>
							<th width="5%">No Soal</th>
							<th width="5%">Kunci Jawaban</th>
							<th width="5%">Jawab A</th>
							<th width="5%">Jawab B</th>
							<th width="5%">Jawab C</th>
							<th width="5%">Jawab D</th>
							<th width="5%">Jawab E</th>
							<th width="5%">Jml Benar</th>
                                  <th width="5%">Jml Salah</th>
								   <th width="5%">Tidak Jawab</th>
								   <th>Daya Pembeda</th>
								   <th width="5%">Efektifitas Option</th>
								   <th>Status Soal</th>
                                </tr>
								
                            </thead>
							 	
							 <?php
							 
							        
                                    $queryx = mysqli_query($koneksi, "select * FROM soal WHERE id_mapel='$id_mapel' AND jenis='1'");
                                    while ($mp = mysqli_fetch_array($queryx)) {
										$jawab=$mp['jawaban'];
								$benar=mysqli_num_rows(mysqli_query($koneksi, "select * FROM jawaban 
								WHERE jawaban='$jawab' AND jenis='1' AND id_mapel='$mp[id_mapel]' AND id_soal='$mp[id_soal]'"));
							   $salah=mysqli_num_rows(mysqli_query($koneksi, "select * FROM jawaban 
								WHERE jawaban<>'$jawab' AND jenis='1' AND id_mapel='$mp[id_mapel]' AND id_soal='$mp[id_soal]'"));
								$tidakjawab=$jumlah_siswa - ($benar+$salah);
								$A=mysqli_num_rows(mysqli_query($koneksi, "select * FROM jawaban 
								WHERE jawaban='A' AND jenis='1' AND id_mapel='$mp[id_mapel]' AND id_soal='$mp[id_soal]'"));
								$B=mysqli_num_rows(mysqli_query($koneksi, "select * FROM jawaban 
								WHERE jawaban='B' AND jenis='1' AND id_mapel='$mp[id_mapel]' AND id_soal='$mp[id_soal]'"));
								$C=mysqli_num_rows(mysqli_query($koneksi, "select * FROM jawaban 
								WHERE jawaban='C' AND jenis='1' AND id_mapel='$mp[id_mapel]' AND id_soal='$mp[id_soal]'"));
								$D=mysqli_num_rows(mysqli_query($koneksi, "select * FROM jawaban 
								WHERE jawaban='D' AND jenis='1' AND id_mapel='$mp[id_mapel]' AND id_soal='$mp[id_soal]'"));
								$E=mysqli_num_rows(mysqli_query($koneksi, "select * FROM jawaban 
								WHERE jawaban='E' AND jenis='1' AND id_mapel='$mp[id_mapel]' AND id_soal='$mp[id_soal]'"));
                                   $rumus=($jumlah_siswa * 27) / 100;
								   $bagi=$rumus*2;
                                   $sulit=$benar / $bagi;
if($sulit < 0.30){
{$status="Soal Sukar";}
}elseif($sulit >= 0.30 && $sulit <= 0.70){
{$status="Soal Sedang";}
}elseif($sulit >= 0.70){
{$status="Soal Mudah";}
}	
if($sulit < 0.30){
{$dp="Jelek, soal dirombak ";}
}elseif($sulit >= 0.30 && $sulit <= 0.50){
{$dp="Kurang baik (perlu direvisi)";}
}elseif($sulit >= 0.51 && $sulit <= 0.69){
{$dp="Kurang baik (perlu direvisi)";}
}elseif($sulit >= 0.70){
{$dp="Baik";}
}	
if($benar > $salah){
{$kecoh="Efektif";}
}elseif($benar < $salah){
{$kecoh="Menyesatkan";}
}elseif($benar = $salah){
{$kecoh="Tidak efektif";}
}
							   ?>
								
                            <tbody>
							<tr>
                                        <td><?= $mp['nomor'] ?> </td>
                                        
                                        <td> <?= $mp['jawaban'] ?> </td>
										 <td> <?= $A ?> </td>
										  <td> <?= $B ?> </td>
										   <td> <?= $C ?> </td>
										    <td> <?= $D ?> </td>
											 <td> <?= $E ?> </td>
									  <td> <?= $benar ?> </td>
                                       <td> <?= $salah ?> </td>
                                       <td> <?= $tidakjawab ?> </td>
									  <td> <?= $dp ?> </td>
									 <td> <?= $kecoh ?> </td>
									 <td> <?= $status ?> </td>
									 
                                    <?php } ?>	
									</tr>	
										
                            </tbody>
                        </table>
						
						<br>
                     <h4>Soal PG Komplek (Multi Coice)</h4>
                    <div class='table-responsive'>
                        <table class='table table-bordered'>
                            <thead>
							<tr>
							<th width="5%">No Soal</th>
							<th width="5%">Kunci Jawaban</th>
							<th width="5%">Jml Benar</th>
                                  <th width="5%">Jml Salah</th>
								   <th width="5%">Tidak Jawab</th>
								   <th>Daya Pembeda</th>
								   <th width="5%">Efektifitas Option</th>
								   <th>Status Soal</th>
                                </tr>
                            </thead>
							 <?php
                                    $queryx = mysqli_query($koneksi, "select * FROM soal WHERE id_mapel='$id_mapel' AND jenis='3'");
                                    while ($mp = mysqli_fetch_array($queryx)) {
										$jawab=$mp['jawaban'];
								$benar=mysqli_num_rows(mysqli_query($koneksi, "select * FROM jawaban 
								WHERE jawabmulti='$jawab' AND jenis='3' AND id_mapel='$mp[id_mapel]' AND id_soal='$mp[id_soal]'"));
							   $salah=mysqli_num_rows(mysqli_query($koneksi, "select * FROM jawaban 
								WHERE jawabmulti<>'$jawab' AND jenis='3' AND id_mapel='$mp[id_mapel]' AND id_soal='$mp[id_soal]'"));
								$tidakjawab=$jumlah_siswa - ($benar+$salah);
								
                                   $rumus=($jumlah_siswa * 27) / 100;
								   $bagi=$rumus*2;
                                   $sulit=$benar / $bagi;
if($sulit < 0.30){
{$status="Soal Sukar";}
}elseif($sulit >= 0.30 && $sulit <= 0.70){
{$status="Soal Sedang";}
}elseif($sulit >= 0.70){
{$status="Soal Mudah";}
}	
if($sulit < 0.30){
{$dp="Jelek, soal dirombak ";}
}elseif($sulit >= 0.30 && $sulit <= 0.50){
{$dp="Kurang baik (perlu direvisi)";}
}elseif($sulit >= 0.51 && $sulit <= 0.69){
{$dp="Kurang baik (perlu direvisi)";}
}elseif($sulit >= 0.70){
{$dp="Baik";}
}	
if($benar > $salah){
{$kecoh="Efektif";}
}elseif($benar < $salah){
{$kecoh="Menyesatkan";}
}elseif($benar = $salah){
{$kecoh="Tidak efektif";}
}
							   ?>
								
                            <tbody>
							<tr>
                                        <td><?= $mp['nomor'] ?> </td>
                                        <td> <?= $mp['jawaban'] ?> </td>
									  <td> <?= $benar ?> </td>
                                       <td> <?= $salah ?> </td>
                                       <td> <?= $tidakjawab ?> </td>
									 	 <td> <?= $dp ?> </td>
									 <td> <?= $kecoh ?> </td>
									  <td> <?= $status ?> </td>
                                    <?php } ?>	
									</tr>	
										
                            </tbody>
                        </table>
						<br>
                     <h4>Soal PG Komplek (Benar Salah)</h4>
                    <div class='table-responsive'>
                        <table class='table table-bordered'>
                            <thead>
							<tr>
							<th width="5%">No Soal</th>
							<th width="5%">Kunci Jawaban</th>
							
							<th width="5%">Jml Benar</th>
                                  <th width="5%">Jml Salah</th>
								   <th width="5%">Tidak Jawab</th>
								   <th>Daya Pembeda</th>
								   <th width="5%">Efektifitas Option</th>
								   <th>Status Soal</th>
                                </tr>
								
                            </thead>
							 	
							 <?php
							 
							        
                                    $queryx = mysqli_query($koneksi, "select * FROM soal WHERE id_mapel='$id_mapel' AND jenis='4'");
                                    while ($mp = mysqli_fetch_array($queryx)) {
										$jawab=$mp['jawaban'];
								$benar=mysqli_num_rows(mysqli_query($koneksi, "select * FROM jawaban 
								WHERE jawabbs='$jawab' AND jenis='4' AND id_mapel='$mp[id_mapel]' AND id_soal='$mp[id_soal]'"));
							   $salah=mysqli_num_rows(mysqli_query($koneksi, "select * FROM jawaban 
								WHERE jawabbs<>'$jawab' AND jenis='4' AND id_mapel='$mp[id_mapel]' AND id_soal='$mp[id_soal]'"));
								$tidakjawab=$jumlah_siswa - ($benar+$salah);
								$A=mysqli_num_rows(mysqli_query($koneksi, "select * FROM jawaban 
								WHERE jawabbs='A' AND jenis='4' AND id_mapel='$mp[id_mapel]' AND id_soal='$mp[id_soal]'"));
								$B=mysqli_num_rows(mysqli_query($koneksi, "select * FROM jawaban 
								WHERE jawabbs='B' AND jenis='4' AND id_mapel='$mp[id_mapel]' AND id_soal='$mp[id_soal]'"));
								
                                   $rumus=($jumlah_siswa * 27) / 100;
								   $bagi=$rumus*2;
                                   $sulit=$benar / $bagi;
if($sulit < 0.30){
{$status="Soal Sukar";}
}elseif($sulit >= 0.30 && $sulit <= 0.70){
{$status="Soal Sedang";}
}elseif($sulit >= 0.70){
{$status="Soal Mudah";}
}	
if($sulit < 0.30){
{$dp="Jelek, soal dirombak ";}
}elseif($sulit >= 0.30 && $sulit <= 0.50){
{$dp="Kurang baik (perlu direvisi)";}
}elseif($sulit >= 0.51 && $sulit <= 0.69){
{$dp="Kurang baik (perlu direvisi)";}
}elseif($sulit >= 0.70){
{$dp="Baik";}
}	
if($benar > $salah){
{$kecoh="Efektif";}
}elseif($benar < $salah){
{$kecoh="Menyesatkan";}
}elseif($benar = $salah){
{$kecoh="Tidak efektif";}
}
							   ?>
								
                            <tbody>
							<tr>
                                        <td><?= $mp['nomor'] ?> </td>
                                        
                                        <td> <?= $mp['jawaban'] ?> </td>
										 
									  <td> <?= $benar ?> </td>
                                       <td> <?= $salah ?> </td>
                                       <td> <?= $tidakjawab ?> </td>
									 <td> <?= $dp ?> </td>
									 <td> <?= $kecoh ?> </td>
									  <td> <?= $status ?> </td>
									 
                                    <?php } ?>	
									</tr>	
										
                            </tbody>
                        </table>
						<br>
                     <h4>Soal Mengurutkan</h4>
                    <div class='table-responsive'>
                        <table class='table table-bordered'>
                            <thead>
							<tr>
							<th width="5%">No Soal</th>
							<th width="5%">Kunci Jawaban</th>
							<th width="5%">Jml Benar</th>
                                  <th width="5%">Jml Salah</th>
								   <th width="5%">Tidak Jawab</th>
								   <th>Daya Pembeda</th>
								   <th width="5%">Efektifitas Option</th>
								   <th>Status Soal</th>
                                </tr>
                            </thead>
							 <?php
                                    $queryx = mysqli_query($koneksi, "select * FROM soal WHERE id_mapel='$id_mapel' AND jenis='5'");
                                    while ($mp = mysqli_fetch_array($queryx)) {
										$jawab=$mp['jawaban'];
								$benar=mysqli_num_rows(mysqli_query($koneksi, "select * FROM jawaban 
								WHERE jawaburut='$jawab' AND jenis='5' AND id_mapel='$mp[id_mapel]' AND id_soal='$mp[id_soal]'"));
							   $salah=mysqli_num_rows(mysqli_query($koneksi, "select * FROM jawaban 
								WHERE jawaburut<>'$jawab' AND jenis='5' AND id_mapel='$mp[id_mapel]' AND id_soal='$mp[id_soal]'"));
								$tidakjawab=$jumlah_siswa - ($benar+$salah);
								
                                   $rumus=($jumlah_siswa * 27) / 100;
								   $bagi=$rumus*2;
                                   $sulit=$benar / $bagi;
if($sulit < 0.30){
{$status="Soal Sukar";}
}elseif($sulit >= 0.30 && $sulit <= 0.70){
{$status="Soal Sedang";}
}elseif($sulit >= 0.70){
{$status="Soal Mudah";}
}	
if($sulit < 0.30){
{$dp="Jelek, soal dirombak ";}
}elseif($sulit >= 0.30 && $sulit <= 0.50){
{$dp="Kurang baik (perlu direvisi)";}
}elseif($sulit >= 0.51 && $sulit <= 0.69){
{$dp="Kurang baik (perlu direvisi)";}
}elseif($sulit >= 0.70){
{$dp="Baik";}
}	
if($benar > $salah){
{$kecoh="Efektif";}
}elseif($benar < $salah){
{$kecoh="Menyesatkan";}
}elseif($benar = $salah){
{$kecoh="Tidak efektif";}
}
							   ?>
								
                            <tbody>
							<tr>
                                        <td><?= $mp['nomor'] ?> </td>
                                        <td> <?= $mp['jawaban'] ?> </td>
									  <td> <?= $benar ?> </td>
                                       <td> <?= $salah ?> </td>
                                       <td> <?= $tidakjawab ?> </td>
									   <td> <?= $dp ?> </td>
									 <td> <?= $kecoh ?> </td>
									 <td> <?= $status ?> </td>
									
                                    <?php } ?>	
									</tr>	
                            </tbody>
                        </table>
						<br>
                     <h4>Soal Uraian Singkat</h4>
                    <div class='table-responsive'>
                        <table class='table table-bordered'>
                            <thead>
							<tr>
							<th width="5%">No Soal</th>
							<th width="5%">Kunci Jawaban</th>
							<th width="5%">Jml Benar</th>
                                  <th width="5%">Jml Salah</th>
								   <th width="5%">Tidak Jawab</th>
								   <th>Daya Pembeda</th>
								  
								   <th>Status Soal</th>
                                </tr>
                            </thead>
							 <?php
                                    $queryx = mysqli_query($koneksi, "select * FROM soal WHERE id_mapel='$id_mapel' AND jenis='2'");
                                    while ($mp = mysqli_fetch_array($queryx)) {
										$jawab=$mp['jawaban'];
								$benar=mysqli_num_rows(mysqli_query($koneksi, "select * FROM jawaban 
								WHERE esai='$jawab' AND jenis='2' AND id_mapel='$mp[id_mapel]' AND id_soal='$mp[id_soal]'"));
							   $salah=mysqli_num_rows(mysqli_query($koneksi, "select * FROM jawaban 
								WHERE esai<>'$jawab' AND jenis='2' AND id_mapel='$mp[id_mapel]' AND id_soal='$mp[id_soal]'"));
								$tidakjawab=$jumlah_siswa - ($benar+$salah);
								
                                   $rumus=($jumlah_siswa * 27) / 100;
								   $bagi=$rumus*2;
                                   $sulit=$benar / $bagi;
if($sulit < 0.30){
{$status="Soal Sukar";}
}elseif($sulit >= 0.30 && $sulit <= 0.70){
{$status="Soal Sedang";}
}elseif($sulit >= 0.70){
{$status="Soal Mudah";}
}	
if($sulit < 0.30){
{$dp="Jelek, soal dirombak ";}
}elseif($sulit >= 0.30 && $sulit <= 0.50){
{$dp="Kurang baik (perlu direvisi)";}
}elseif($sulit >= 0.51 && $sulit <= 0.69){
{$dp="Kurang baik (perlu direvisi)";}
}elseif($sulit >= 0.70){
{$dp="Baik";}
}	

							   ?>
								
                            <tbody>
							<tr>
                                        <td><?= $mp['nomor'] ?> </td>
                                        <td> <?= $mp['jawaban'] ?> </td>
									  <td> <?= $benar ?> </td>
                                       <td> <?= $salah ?> </td>
                                       <td> <?= $tidakjawab ?> </td>
									   <td> <?= $dp ?> </td>
									  <td> <?= $status ?> </td>
                                    <?php } ?>	
									</tr>	
										
                            </tbody>
                        </table>
						
					</div>
					</div>
				</div>
            </div>
        </div>
    </div>
	
	
	 
<?php endif; ?>
<script>
    $('#tablenilaix').dataTable();
    $(document).on('click', '.ulangnilai', function() {
        var id = $(this).data('id');
        console.log(id);
        swal({
            title: 'Apa anda yakin?',
            text: " Akan Mengulang Ujian Ini ??",
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes!'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: 'mod_nilai/ulangujian.php',
                    method: "POST",
                    data: 'id=' + id,
                    success: function(data) {
                        iziToast.success({
                            title: 'Mantap!',
                            message: 'Data berhasil diulang',
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