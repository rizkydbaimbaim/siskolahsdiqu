<?php

require("../../../config/config.default.php");
require("../../../config/config.function.php");
$kode = $_POST['id'];
$query = "SELECT * FROM tugas WHERE id_tugas='".$kode."'";
		$sql = mysqli_query($koneksi, $query); 
		$data = mysqli_fetch_array($sql);

		if(is_file("../../../berkas/".$data['file'])) 
			unlink("../../../berkas/".$data['file']); 
$exec = mysqli_query($koneksi, "DELETE FROM tugas WHERE id_tugas='$kode'");
$exec = mysqli_query($koneksi, "DELETE FROM jawaban_tugas WHERE id_tugas='$kode'");
