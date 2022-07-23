<?php
$idss=$_GET['ids'];
$idm=$_GET['idmap'];
$kls=$_GET['kelas'];
$koneksi->query("DELETE FROM nilai2 WHERE ids='$_GET[ids]' AND idmapel='$_GET[idmap]'");
if($koneksi){
$idmap = $_POST['idmap']; 
$ids = $_POST['ids']; 
$nomer = $_POST['nomer']; 
$jwb = $_POST['jwb']; 
$kelas=$_POST['kelas']; 
$query = "INSERT INTO nilai2 VALUES";

$index = 0; 
foreach($ids as $datanis){ 
	$query .= "('','".$datanis."','".$kelas[$index]."','".$idmap[$index]."','".$nomer[$index]."','".$jwb[$index]."'),";
	$index++;
}


$query = substr($query, 0, strlen($query) - 1).";";

mysqli_query($koneksi, $query);
echo "
	  <script type='text/javascript'>
		setTimeout(function () { 	
			swal({
				title: 'Berhasil di Simpan !!!',
				text:  'Analisis Siswa ini Sudah Tercatat',
				type: 'success',
				timer: 2000,
				showConfirmButton: true
			});		
		},10);	
		window.setTimeout(function(){ 
			window.location.replace('?pg=nilaiujian&kelas=$kls&id=$idm');
		} ,2000);	
	  </script>";
}
?>

