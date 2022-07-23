<?php

require("../../config/config.default.php");
require("../../config/config.function.php");
$kode = $_POST['id'];
cek_session_guru();
$query = "SELECT * FROM surat_masuk WHERE id_surat='".$kode."'";
		$sql = mysqli_query($koneksi, $query); 
		$data = mysqli_fetch_array($sql);

		if(is_file("../../arsip/surat_masuk/".$data['file'])) 
			unlink("../../arsip/surat_masuk/".$data['file']); 
$exec = mysqli_query($koneksi, "DELETE FROM surat_masuk WHERE id_surat='$kode'");
?>