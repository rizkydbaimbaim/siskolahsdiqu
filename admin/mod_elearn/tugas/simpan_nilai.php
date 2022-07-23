
<?php

require("../../../config/config.default.php");
require("../../../config/config.function.php");
require("../../../config/functions.crud.php");
cek_session_guru();
$kode = $_POST['id'];
$jawab = fetch($koneksi,'jawaban_tugas',['id_jawaban' => $kode]);
$tugas = fetch($koneksi,'tugas',['id_tugas' => $jawab['id_tugas']]);
$nilai = $_POST['nilai' . $kode];

$query = mysqli_query($koneksi, "UPDATE jawaban_tugas set nilai='$nilai' where id_jawaban = '$kode'");
mysqli_query($koneksi,"INSERT INTO nilai_harian VALUES('','$jawab[id_siswa]','$tugas[mapel]','$tugas[ki]','$tugas[kd]','$nilai','Penugasan')");
echo mysqli_error($koneksi);
echo "nilai berhasil disimpan";

?>