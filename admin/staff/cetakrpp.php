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
	<b>1. TUJUAN PEMBELAJARAN</b>
    <td style="text-align: justify;">Setelah mengikuti proses pembelajaran, peserta didik diharapkan memahami konsep / menganalisa / menyelesaikan masalah kontekstual yang berkaitan dengan <?= $rpp['sisipan'] ?></td>
	</tr>
	</table>
	<p>
	<table>
	<tr>
	<b>2. MEDIA/ALAT, BAHAN DAN SUMBER BELAJAR</b>
	<td width="130px"><li> Media</td>
	<td>:</td>
	<td>Worksheet atau lembar kerja (peserta didik), Lembar penilaian</td>
	</tr>
	<tr>
	<td><li> Alat/Bahan</td>
	<td>:</td>
	<td>Spidol, papan tulis, laptop dan infocus</td>
	</tr>
	<tr>
	<td><li> Sumber belajar</td>
	<td>:</td>
	<td>Buku mapel <?= $mapel['mapel'] ?> Kelas <?= $mapel['kelas'] ?> / <?= $rapor['semester'] ?> Kemdikbud</td>
	</tr>
	</table>
	<p>
	<table>
	<tr>
	<b>3. KEGIATAN PEMBELAJARAN</b>
	<td><b>a. Kegiatan Pendahuluan</b></td>
	 </tr>
	 <tr>
	<td style="text-align: justify;"><li> Guru mengucapkan salam, memimpin doa, absensi, mengisi jurnal dan mengecek kesiapan peserta didik dilanjutkan Apersepsi dengan
	bercerita / menampilkan gambar / memutar video, menyampaikan tujuan dan manfaat materi <?= $rpp['sisipan'] ?>, cakupan materi,
	langkah pembelajaran dan tekhnik penilaian.</td>
	</tr>
	<tr>
	<td><b>b. Kegiatan Inti</b></td>
	 </tr>
	 <tr>
	<td style="text-align: justify;"><li> Peserta didik mengetahui tujuan pembelajaran dan manfaat apa yang dipelajari.</td>
	</tr>
	<tr>
	<td style="text-align: justify;"><li> Peserta didik diminta menghubungkan pelajaran sebelumnya dengan pembelajaran yang akan dipelajari yaitu tentang <?= $rpp['sisipan'] ?>.</td>
	</tr>
	<tr>
	<td style="text-align: justify;"><li> Peserta didik diminta mengamati gambar atau video maupun membaca materi tentang <?= $rpp['sisipan'] ?>.</td>
	</tr>
	<tr>
	<td style="text-align: justify;"><li> Guru memberikan keseempatan untuk mengidentifikasi sebanyak mungkin hal yang belum dipahami, dimulai dari
	pertanyaan faktual sampai ke pertanyaan yang bersifat hipotetik berkaitan dengan materi <?= $rpp['sisipan'] ?>.</td>
	</tr>
	<tr>
	<td style="text-align: justify;"><li> Peserta didik dibimbing membentuk kelompok.</td>
	</tr>
	<tr>
	<td style="text-align: justify;"><li> Peserta didik secara berkelompok berdiskusi dan mengerjakan Lembar Kerja Peserta Didik (LKPD) yang berisi tentang <?= $rpp['sisipan'] ?>.</td>
	</tr>
	<tr>
	<td style="text-align: justify;"><li> Peserta didik mempresentasikan hasil kerja kelompoknya di depan kelas terkait materi <?= $rpp['sisipan'] ?>. Kelompok yang lain menanggapi.</td>
	</tr>
	<tr>
	<td><b>c. Kegiatan Penutup</b></td>
	</tr>
	<tr>
	<td style="text-align: justify;"><li> Guru bersama peserta didik membuat rangkuman/kesimpulan pelajaran tentang point-point penting yang muncul dalam kegiatan pembelajaran
    yang baru dilakukan terkait <?= $rpp['sisipan'] ?>.</td>
	</tr>
	<tr>
	<td style="text-align: justify;"><li> Guru memberikan penguatan terhadap materi yang sudah dipelajari dengan memberikan penugasan dan menyampaikan rencana pembelajaran selanjutnya, serta di akhiri salam penutup.</td>
	</tr>
	</table>
	<p>
	<table>
	<tr>
	<b>4. PENILAIAN (ASSESMENT)</b>
	<td style="text-align: justify;"><b>Penilaian Pengetahuan :</b> berupa tes tertulis pilihan ganda & tertulis uraian, tes lisan / observasi terhadap diskusi tanya jawab dan percakapan serta penugasan.</td>
	 </tr>
	<tr>
	<td style="text-align: justify;"><b>Penilaian Keterampilan :</b> berupa penilaian unjuk kerja, penilaian proyek, penilaian produk dan penilaian portopolio.</td>
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
