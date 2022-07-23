<?php
include "../../koneksi.php";

echo $idsoal = $_GET['idsoal'];
echo $idgroup = $_GET['idgroup'];

$delete = mysqli_query($mysqli, "delete from soal where idsoal='$idsoal' ");
if($delete){
    echo "<script>alert('proses delete berhasil')</script>";
    header('location:http://localhost/pkl/index.php?detailsoal&idgroup='.$idgroup);
}else{
    echo "<script>alert('proses delete gagal');window.history.go(-1);</script>";
}

?>
