<?php
//if(isset($_POST['simpan'])){
require("../../config/config.default.php");
require("../../config/config.function.php");
require("../../config/functions.crud.php");
	$tipe	="Guru";
	$pemilih=$_SESSION['id_pengawas'];
	$kandidat=$_GET['id'];
	$sql="INSERT INTO datapemilihan SET tipe='$tipe', idpemilih='$pemilih', idkandidat='$kandidat'";
	$simpan=mysqli_query($koneksi,$sql);
	if($simpan){
		
		$edit="UPDATE kandidat SET suara=suara+1 WHERE id='$kandidat'";
		$update=mysqli_query($koneksi,$edit);
		//echo "berhasil";
	}else{
		
		echo '<script language="JavaScript">';
			echo 'alert("Data Gagal Ditambahkan.")';
		echo '</script>';
	}
/*}else{
	echo '<script>window.history.back()</script>';
}*/
?>
