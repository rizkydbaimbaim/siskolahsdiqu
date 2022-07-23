<?php

require("../../config/config.default.php");
require("../../config/config.function.php");
$kode = $_POST['id'];
cek_session_guru();
$query = "SELECT * FROM arsipguru WHERE id='".$kode."'";
		$sql = mysqli_query($koneksi, $query); 
		$data = mysqli_fetch_array($sql);

		if(is_file("../../arsip/arsipguru/".$data['dok'])) 
			unlink("../../arsip/arsipguru/".$data['dok']); 
$exec = mysqli_query($koneksi, "DELETE FROM arsipguru WHERE id='$kode'");
?>