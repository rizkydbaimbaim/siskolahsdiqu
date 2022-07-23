<?php defined('BASEPATH') or die("ip anda sudah tercatat oleh sistem kami") ?>
<?php if ($ac == '') { ?>
    <div class='col-md-12'>
        <div class='box box-solid' style='background-color:aqua'>
            <div class='box-header with-border'>
                <h3 class='box-title'><i class="fas fa-university "></i> DATA KELAS</h3>
            </div><!-- /.box-header -->
            <div class='box-body' style='background-color:#000'>

                <?php
                $kelasQ = mysqli_query($koneksi, "SELECT * FROM siswa GROUP BY id_kelas");
              while ($kelas = mysqli_fetch_array($kelasQ)){
                ?>
                            <div class="col-md-4">
                                <div class="box box-widget widget-user-2">
                                    <!-- Add the bg color to the header using any of the bg-* classes -->
                                    <div class="widget-user-header bg-aqua" style="padding: 6px">
                                        <div class="widget-user-image">
                                            <img src="../dist/img/avatar5.png" alt="">
                                        </div>
                                        <!-- /.widget-user-image -->
                                        <span style="font-size: 20px"> <b>
                                             KELAS  <?= $kelas['id_kelas'] ?>
                                            </b></span>
                                    </div>
                                      
                                    <div class="box-footer no-padding">
                                        <ul class="nav nav-stacked">
                                            <li>
                                               
                                                    <a href="?pg=nisn&ac=cetak&kelas=<?= $kelas['id_kelas'] ?>">
                                                     <i class='fas fa-clock'></i> CETAK NISN
                                                    <span class="pull-right badge bg-green"><?= $kelas['id_kelas'] ?></span>
                                                    </a>
                                                
                                            </li>
											
                                        </ul>
                                     
                                    </div>
									
                                </div>
                                <!-- /.widget-user -->
                            </div>
                       
                 
			  <?php } ?>

            </div>
        </div>
    </div>
<?php } elseif ($ac == 'cetak') { ?>
    <?php 
	$kelas = $_GET['kelas'];
   
	?>
	
	<div class='row'>
        <div class='col-md-12'>
            <div class='box box-solid'>
                <div class='box-header with-border '>
                    <h3 class='box-title'><i class="fas fa-print fa-fw"></i> Data NISN Kelas <?= $kelas ?> </h3>
                     <div class='box-tools pull-right'>
				   
		  </div>
         </div>
                <div class='box-body'>
                     <div class='table-responsive'>
                        <table style="font-size: 11px" id='tabelekstra' class='table table-bordered table-striped'>
                            <thead>
                            <tr>
                       <th width='3px'></th>
                                    <th>NISN</th>
                                    <th>Nama</th>
                                    <th>Tanggal Lahir</th>
                                    <th>Tempat Lahir</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Cetak</th>
                            </thead>
                            <tbody>
							 <?php
                               $no = 0;
								 $query = mysqli_query($koneksi, "select * from siswa_rapor WHERE kelas='$kelas' ");
                            while ($nisn = mysqli_fetch_array($query)) {
								
                                $no++;
                            ?>
							 <tr>
                                    <td><?= $no; ?></td>
									 <td><?= $nisn['nisn'] ?></td>
							        <td><?= $nisn['nama'] ?></td>
									<td><?= $nisn['tgl_lahir'] ?></td>
									<td><?= $nisn['tempat'] ?></td>
									<td><?= $nisn['jk'] ?></td>
								<td align="center"><a class='btn btn-success btn-sm' data-toggle='tooltip' title='Print Kartu' href='?pg=nisn&ac=siswa&id=<?= $nisn['id'] ?>'><span class='fa fa-print'></span></a></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                        </table>
        
	                </div>
                     </div>
            </div>
        </div>
  </div>

  <?php } elseif ($ac == 'siswa') { ?>
  
 <div class='row'>
        <div class='col-md-12'>
            <div class='box box-solid'>
                <div class='box-header with-border '>
                    <h3 class='box-title'><i class="fas fa-print fa-fw"></i> Data Kartu Pelajar</h3>
                     <div class='box-tools pull-right'>
				    <button class='btn btn-sm btn-flat btn-success' onclick="frames['frameresult'].print()"><i class='fa fa-print'></i> Print</button>
                    
		  </div>
         </div>
                <div class='box-body'>
    <?php
        $i=mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM setting WHERE id_setting = '1'"));
        $r=mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM siswa_rapor where id='$_GET[id]'"));$t = date("d - m - Y", strtotime($r['tgl_lahir']));
    ?>
<div style="width: 750px;height: 243px;margin: 30px;background-image: url('../dist/img/kpel.png');">
    <img style="position: absolute;padding-left: 12px;padding-top: 10px;" class="img-responsive img" alt="Responsive image" src="../<?php echo "$i[logo]";?>" width="55px">
    <img style="position: absolute;margin-left: 312px;padding-top: 7px;" class="img-responsive img" alt="Responsive image" src="../dist/img/logoaplikasi.png" width="45px">
    <p style="position: absolute; font-family: arial; font-size: 10px; color: #fff; padding-left: 85px;margin-top:10px;text-transform: uppercase; text-align: center;"> Pemerintah Kabupaten <?php echo $i["kota"];?><br>Dinas Pendidikan<br><b style="font-size: 12px"><?php echo $i["sekolah"];?></b></p>
    <p style="padding-left: 123px;padding-top: 70px; "><b>KARTU PELAJAR</b></p>
   <?php if($r['photo']==''){ ?>
   <img style="border: 1px solid #ffffff;position: absolute;margin-left: 20px;margin-top: -20px;" src="../dist/img/avatar.png" width="80px">
   <?php }else{ ?>
 <img style="border: 1px solid #ffffff;position: absolute;margin-left: 20px;margin-top: -20px;" src="../foto/<?= $r['photo'] ?>" width="80px">
   <?php } ?>   
		<table style="margin-top: -10px;margin-left: 110px; position: relative;font-family: arial;font-size: 11px;">
            <tr>
                <td>Nama</td>
                <td>:</td>
                <td><?php echo "$r[nama]";?></td>
            </tr><tr>
                <td>NIS/NISN</td>
                <td>:</td>
               <td><?php echo "$r[nis]";?>/<?php echo "$r[nisn]";?></td>
            </tr>
            </tr><tr>
                <td>Tempat Lahir</td>
                <td>:</td>
                <td><?php echo "$r[tempat]";?></td>
            </tr>
            <tr>
                <td>Tanggal Lahir</td>
                <td>:</td>
               <td><?php echo "$r[tgl_lahir]";?></td>
            </tr>
            <tr>
                <td>Jenis Kelamin</td>
                <td>:</td>
                <td><?php echo "$r[jk]";?></td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td>:</td>
                <td><?php echo "$r[alamat]";?></td>
            </tr>
            <tr>
                <td>Berlaku</td>
                <td>:</td>
                <td>Selama Menjadi Siswa/i</td>
            </tr>
        </table>
		<br>
        <p style="padding-left: 10px;font-size: 8px; font-family: arial;position: absolute;">Alamat: Jl. <?php echo "$i[alamat]";?>  Kec. <?php echo "$i[kecamatan]";?> - Kab <?php echo "$i[kota]";?><br> Email: <?php echo "$i[email]";?> | Telp. <?php echo "$i[telp]";?> | Website: <?php echo "$i[web]";?></p>
        <p style="margin-top: -200px;padding-left: 480px;padding-top: 1px;"><b>TATA TERTIB SEKOLAH</b><br>
<ol style="padding-left: 400px;color: #FFFFFF; font-family: arial;font-size: 10px;text-align: justify;padding-right: 10px">
                      <li>Bertakqwa kepada Tuhan Yang Maha Esa</a></li>
                      <li>Menggalang kesatuan kerukunan pelajar</li>
                      <li>Belajar hidup berorganisasi untuk menyiapkan diri dalam mental, moral budi pekerti yang luhur, meningkatkan kecerdasan dan keterampilan</li>
                      <li>Dapat menduduki fungsinya sebagai pewaris, penerus perjuangan bangsa dan pancasila yang penuh dengan kratif, aktif dan disiplin Nasional demi suksesnya program pendidikan sekolah</li>
                    </ol>
        </p><br>
        <p style="position: absolute;padding-left: 550px;margin-top: -17px;font-size: 10px; font-family: arial;">
           <?php echo "$i[kota]";?>, <?php
                $tanggal = date ("j");
                $bulan = array(1=>"Januari","Februari","Maret", "April", "Mei", "Juni","Juli","Agustus","September","Oktober", "November","Desember");
                $bulan = $bulan[date("n")];
                $tahun = date("Y");
                echo $tanggal ." ". $bulan ." ". $tahun;
            ?>
        </p>
        <?php
            $t=mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM ttangan WHERE id = '1'"));
        ?><p>
        <p style="position: absolute;padding-left: 550px;margin-top: -10px;font-size: 10px; font-family: arial;">Mengetahui, <br>Kepala Sekolah</p>
        
        <br><img style="position: absolute;padding-left: 530px;margin-top: -20px;" class="img-responsive img" alt="Responsive image" src="../dist/img/ttd.png" width="50px">
        <p style="position: absolute;padding-left: 550px;margin-top: 20px;font-size: 10px; font-family: arial;"><b><u><?php echo "$i[kepsek]";?></u></b><br>NIP. <?php echo "$i[nip]";?></p>
</div>

 </div>
        </div>
  </div>
  <iframe id='loadframe' name='frameresult' src='mod_kartu/print_nisn.php?id=<?= $_GET[id] ?>' style='display:none'></iframe>
  
  
  
<?php } ?>