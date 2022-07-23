<?php
require("config/config.default.php");
require("config/config.function.php");
//cek_session_admin();
$token = isset($_GET['token']) ? $_GET['token'] : 'false';
$querys = mysqli_query($koneksi, "select token_api from setting where token_api='$token'");
$cektoken = mysqli_num_rows($querys);
if ($cektoken <> 0) {
  $querybank = mysqli_query($koneksi, "select * from mapel ");
  $array_bank = array();
  while ($bank = mysqli_fetch_assoc($querybank)) {
    $array_bank[] = $bank;
  }
  $querysoal = mysqli_query($koneksi, "select * from soal ");
  $array_soal = array();
  while ($soalx = mysqli_fetch_assoc($querysoal)) {
    $array_soal[] = $soalx;
  }
  $queryjadwal = mysqli_query($koneksi, "select * from ujian");
  $array_jadwal = array();
  while ($jadwal = mysqli_fetch_assoc($queryjadwal)) {
    $array_jadwal[] = $jadwal;
  }
   $querymateri = mysqli_query($koneksi, "select * from materi");
  $array_materi = array();
  while ($materi = mysqli_fetch_assoc($querymateri)) {
    $array_materi[] = $materi;
  }
  $queryquiz = mysqli_query($koneksi, "select * from soal_quiz");
  $array_quiz = array();
  while ($quiz = mysqli_fetch_assoc($queryquiz)) {
    $array_quiz[] = $quiz;
  }
  $querypengumuman = mysqli_query($koneksi, "select * from pengumuman");
  $array_pengumuman = array();
  while ($pengumuman = mysqli_fetch_assoc($querypengumuman)) {
    $array_pengumuman[] = $pengumuman;
  }
  $querytugas = mysqli_query($koneksi, "select * from tugas");
  $array_tugas = array();
  while ($tugas = mysqli_fetch_assoc($querytugas)) {
    $array_tugas[] = $tugas;
  }
  $querysetting = mysqli_query($koneksi, "select * from setting");
  $array_setting = array();
  while ($setting = mysqli_fetch_assoc($querysetting)) {
    $array_setting[] = $setting;
  }
  $queryfile = mysqli_query($koneksi, "select * from file_pendukung");
  $array_file = array();
  while ($file = mysqli_fetch_assoc($queryfile)) {
    $array_file[] = $file;
  }

  echo json_encode(
    [
      "bank" => $array_bank,
      "soal" => $array_soal,
      "jadwal" => $array_jadwal,
	   "materi" => $array_materi,
	   "quiz" => $array_quiz,
	   "pengumuman" => $array_pengumuman,
	  "tugas" => $array_tugas,
	   "setting" => $array_setting,
      "file" => $array_file
    ]
  );
} else {
  echo "<script>location.href='.'</script>";
}
