<?php ob_start();
error_reporting(0);
require("../../config/config.database.php");
require("../../config/config.function.php");
require("../../config/functions.crud.php");

session_start();
if (!isset($_SESSION['id_pengawas'])) {
    die('Anda tidak diijinkan mengakses langsung');
}
$id = $_GET['id'];

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>

    <title>Kartu Pelajar</title>

</head>

<body style="font-family: arial;font-size: 12px;position:absolute;">

    <?php
        $i=mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM setting WHERE id_setting = '1'"));
        $r=mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM siswa_rapor where id='$_GET[id]'"));$t = date("d - m - Y", strtotime($r['tgl_lahir']));
    ?>
<div style="width: 750px;height: 243px;margin: 30px;background-image: url('../dist/img/kapel.jpg');">
<img style="position: absolute;padding-left: 5px;padding-top: 5px;" class="img-responsive img" alt="Responsive image" src="../../dist/img/kpel.png">
    <img style="position: absolute;padding-left: 12px;padding-top: 12px;" class="img-responsive img" alt="Responsive image" src="../../<?php echo "$i[logo]";?>" width="45px">
    <img style="position: absolute;margin-left: 312px;padding-top: 12px;" class="img-responsive img" alt="Responsive image" src="../../dist/img/logoaplikasi.png" width="45px">
    <p style="position: absolute; font-family: arial; font-size: 10px; color: #000; padding-left: 85px;margin-top:18px;text-transform: uppercase; text-align: center;"> Pemerintah Kabupaten <?php echo $i["kota"];?><br>Dinas Pendidikan<br><b style="font-size: 12px"><?php echo $i["sekolah"];?></b></p>
    <p style="padding-left: 123px;padding-top: 70px;color: #000; "><b>KARTU PELAJAR</b></p>
    <?php if($r['photo']==''){ ?>
   <img style="border: 1px solid #ffffff;position: absolute;margin-left: 20px;margin-top: -20px;" src="../../dist/img/avatar.png" width="80px">
   <?php }else{ ?>
 <img style="border: 1px solid #ffffff;position: absolute;margin-left: 20px;margin-top: -20px;" src="../../foto/<?= $r['photo'] ?>" width="80px">
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
		
        <p style="padding-left: 20px;font-size: 8px; font-family: arial;position: absolute;">Alamat: Jl. <?php echo "$i[alamat]";?>  Kec. <?php echo "$i[kecamatan]";?> - Kab <?php echo "$i[kota]";?><br> Email: <?php echo "$i[email]";?> | Telp. <?php echo "$i[telp]";?> | Website: <?php echo "$i[web]";?></p>
       <br><br>
	   <p style="margin-top: -200px;padding-left: 480px;padding-top: 1px;"><b>TATA TERTIB SEKOLAH</b><br>
<ol style="padding-left: 400px; font-family: arial;font-size: 10px;text-align: justify;padding-right: 10px">
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
        
        <br><img style="position: absolute;padding-left: 550px;margin-top: 1px;" class="img-responsive img" alt="Responsive image" src="../../dist/img/ttd.png" width="60px">
        <p style="position: absolute;padding-left: 550px;margin-top: 20px;font-size: 10px; font-family: arial;"><b><u><?php echo "$i[kepsek]";?></u></b><br>NIP. <?php echo "$i[nip]";?></p>
</div>


</body>
</html>
