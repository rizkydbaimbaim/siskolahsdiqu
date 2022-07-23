<?php

require("../../../config/config.default.php");
require("../../../config/config.function.php");
$kode = $_POST['id'];
cek_session_guru();
$query = "SELECT * FROM materi WHERE id_materi='".$kode."'";
		$sql = mysqli_query($koneksi, $query); 
		$data = mysqli_fetch_array($sql);

		if(is_file("../../../berkas/".$data['file'])) 
			unlink("../../../berkas/".$data['file']); 
$exec = mysqli_query($koneksi, "DELETE FROM materi WHERE id_materi='$kode'");
$exec = mysqli_query($koneksi, "DELETE FROM jawaban_materi WHERE id_materi='$kode'");
$exec = mysqli_query($koneksi, "DELETE FROM soal_quiz WHERE idmateri='$kode'");
