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
$rpp=fetch($koneksi,'rpp',['id_rpp' => $id]);
$t=explode("-", $rpp['tanggal']);
$tanggal=$t[2];
$mapel=fetch($koneksi,'jadwal_mapel',['id_jadwal' => $rpp['idmapel']]);
$bl =$t[1];
$th=$t[0];
$bulane = fetch ($koneksi, 'bulan', ['bln' =>$bl]);
$rapor=fetch($koneksi,'setting_rapor',['id'=>1]);
if($pengawas['level']=='guru'){ 
$user=fetch($koneksi,'pengawas',['id_pengawas'=>$_SESSION['id_pengawas']]);
}else{
$user=fetch($koneksi,'pengawas',['id_pengawas'=>$mapel['guru']]);
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>

    <title>RPP<?= $mapel['kode'] ?></title>

   <link rel="stylesheet" href="../../plugins/bootstrap/dist/css/bootstrap.min.css">


</head>

<body style="font-size: 13px;">

   <center><h5>RENCANA PELAKSANAAN PEMBELAJARAN (RPP)</h5></center>
   <br>
   <div style="padding-left:25px;margin-right:10px ;" class="col-md-12">
  
    <table>
	<tbody>
          
			 <tr>
                <td width="130px">Nama Sekolah</td>
				<td width="10px">:</td>
				<td><?= $setting['sekolah'] ?></td>
            </tr>
                <tr>
                <td>Mata Pelajaran</td>
				<td>:</td>
				<td><?= $mapel['mapel'] ?></td>
            </tr>
                <tr>
                <td>Kelas / Semester</td>
				<td>:</td>
				<td><?= $mapel['kelas'] ?> / <?= $rapor['semester'] ?></td>
            </tr>
			<tr>
                <td>Materi Pokok</td>
				<td>:</td>
				<td><?= $rpp['materi'] ?></td>
            </tr>		
                <tr>
                <td>Tahun Pelajaran</td>
				<td>:</td>
				<td><?= $rapor['tp'] ?></td>
            </tr>
			<tr>
                <td>Alokasi Waktu</td>
				<td>:</td>
				<td><?= $rpp['alokasi'] ?></td>
            </tr>
			</tbody>
    </table>
	<div>
	<p>
	<div style="padding-left:5px;" class="col-md-12">
   <table>
	<tr>
	<b>A. TUJUAN PEMBELAJARAN</b>
    <td style="text-align: justify;">Setelah melaksanakan kegiatan melalui model based learning, siswa mampu menerapkan <?= $rpp['sisipan'] ?> dalam menyelesaikan masalah, mencari data/bahan/alat 
	yang diperlukan untuk menyelesaikan masalah, melakukan penyelidikan untuk bahan diskusi kelompok, melakukan diskusi untuk menghasilkan solusi pemecahan masalah, mempresentasikan hasil diskusi, 
	membuat kesimpulan, memiliki karakter (religiositas, integritas, nasionalisme, gotong royong, dan kemandirian) dan memiliki kemampuan literasi 
	(baca tulis, numerasi, sains, digital, financial, budaya dan kewargaan) untuk membiasakan siswa dalam berfikir kritis, kreativitas, komunikasi dan kolaborasi.</td>
	</tr>
	</table>
	<p>
	<table>
	<tr>
	<b>B. KEGIATAN PEMBELAJARAN</b>
	<td><b>a. Kegiatan Pendahuluan</b></td>
	 </tr>
	 <tr>
	<td> Sebelumnya, siswa diarahkan literasi sebelum pembelajaran. Untuk menguatkan karakter, guru mengucapkan salam dan membiasakan siswa untuk berdoa, cek kebersihan kelas, menanamkan rasa cinta tanah air dan kejujuran dilanjutkan apersepsi tentang <?= $rpp['sisipan'] ?> dalam menyelesaikan masalah dengan memberikan stimulus melalui media pembelajaran (PPT) serta menyampaikan tujuan pembelajaran.</td>
	</tr>
	
	<tr>
	<td><b>b. Kegiatan Inti</b></td>
	 </tr>
	 </table>
	 <table>
	 <tr>
	<td>1. Menyampaikan masalah yang akan dipecahkan secara kelompok dan tiap kelompok mengamati dan memahami masalah yang disampaikan guru atau yang diperoleh dari bahan bacaan yang disarankan.</td>
	</tr>
	<tr>
	<td>2. Peserta berdiskusi dan membagi tugas untuk mencari data/bahan/alat yang diperlukan untuk menyelesaikan masalah dan guru memastikan setiap anggota memahami tugas masing-masing.</td>
	</tr>
	<tr>
	<td>3. Peserta melakukan penyelidikan untuk bahan diskusi kelompok dan guru memantau keterlibatan peserta didik selama proses penyelidikan (membimbing penyelidikan individu maupun kelompok).</td>
	</tr>
	<tr>
	<td>4. Kelompok melakukan diskusi untuk menghasilkan solusi pemecahan masalah dan hasilnya dipresentasikan, sedangkan guru memantau diskusi dan membimbing pembuatan laporan sehingga tiap kelompok siap untuk dipresentasikan.</td>
	</tr>
	<tr>
	<td>5. Setiap kelompok melakukan presentasi, guru membimbing presentasi dan mendorong kelompok lain memberikan apresiasi serta masukan pada kelompok lain.</td>
	</tr>
	</table>
	<table>
	<tr>
	<td><b>c. Kegiatan Penutup</b></td>
	</tr>
	<tr>
	<td>Membuat simpulan, refleksi umpan balik, penugasan, pesan-pesan moral, dan menyampaikan informasi kegiatan pembelajaran yang akan datang dan berdoa.</td>
	</tr>
	
	</table>
	<p>
	<table>
	<tr>
	<b>C. PENILAIAN (ASSESMENT)</b>
	<td>Penilaian sikap (jurnal perkembangan sikap), penilaian pengetahuan (tes tulis, lisan, penugasan) dan penilaian keterampilan (penilaian unjuk kerja, penilaian proyek, dan penilaian portopolio).</td>
	 </tr>
	<tr>
	<td>Pembelajaran remedial dan pengayaan.</td>
	 </tr>
	</table>
	</div>
	<p>
   <table border='0' style="margin-left: 30px;width:700">
					<tr>
						<td>
							Mengetahui, <br/>
							Kepala Sekolah <br/>
							<br/>
							<br/>
							
							<u><?= $setting['kepsek'] ?></u><br/>
							NIP. <?= $setting['nip'] ?>
						</td>
						<td width='300px'></td>
						<td>
							<?= $setting['kecamatan'] ?>, <?= $tanggal ?> <?= $bulane['ket'] ?> <?= $th ?><br/>
							Guru Mata Pelajaran<br/>
							<br/>
							<br/>
							
							<u><?= $user['nama'] ?></u><br/>
							NIP. <?= $user['nip'] ?>
						</td>
					</tr>
				</table>
    
	
</body>

</html>
