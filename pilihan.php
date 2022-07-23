<?php
//if(isset($_POST['simpan'])){
require("config/config.default.php");
require("config/config.function.php");
require("config/functions.crud.php");
	$tipe	="Siswa";
	$pemilih=$_SESSION['id_siswa'];
	$kandidat=$_GET['id'];
	$sql="INSERT INTO datapemilihan SET tipe='$tipe', idpemilih='$pemilih', idkandidat='$kandidat'";
	$simpan=mysqli_query($koneksi,$sql);
	if($simpan){
		
		$edit="UPDATE kandidat SET suara=suara+1 WHERE id='$kandidat'";
		$update=mysqli_query($koneksi,$edit);
	echo "
	  <script type='text/javascript'>
		setTimeout(function () { 	
			swal({
				title: 'Sukses',
				text:  'Voting berhasil disimpan',
				type: 'success',
				timer: 100,
				showConfirmButton: true
			});		
		},10);	
		window.setTimeout(function(){ 
			window.location.replace('$homeurl/voting');
		} ,100);	
	  </script>";
	
	
	}
?>
