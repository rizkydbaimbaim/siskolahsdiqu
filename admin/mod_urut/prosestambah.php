<?php
include "../../koneksi.php";

if (isset($_POST['submit'])) {
    $idgroup = $_POST['idgroup'];
    $soal = $_POST['soal'];
    $a = $_POST['urutana'];
    $b = $_POST['urutanb'];
    $c = $_POST['urutanc'];
    $d = $_POST['urutand'];
    $e = $_POST['urutane'];
    $array = array($a,$b,$c,$d,$e);
    $pilihanbenar = implode($array,',');
    $pilihana = $_POST['pilihana'];
    $pilihanb = $_POST['pilihanb'];
    $pilihanc = $_POST['pilihanc'];
    $pilihand = $_POST['pilihand'];
    $pilihane = $_POST['pilihane'];
    $pembahasan = $_POST['pembahasan'];

    $insert = mysqli_query($mysqli, "insert into soal set 
    idgroup='$idgroup',
    soal = '$soal',
    pilihana = '$pilihana',
    pilihanb = '$pilihanb',
    pilihanc = '$pilihanc',
    pilihand = '$pilihand',
    pilihane = '$pilihane',
    jenissoal = 'sorting',
    pilihanbenar='$pilihanbenar',
    pembahasan = '$pembahasan'");

    if ($insert) {
        echo "<script>alert('proses tambah berhasil');'</script>";
        header('location:http://localhost/pkl/index.php?detailsoal&f=5&idgroup='.$idgroup);
    } else {
        echo "<script>alert('proses tambah stock gagal');window.history.go(-1);</script>";
    }
}else {
    header('location:http://localhost/pkl/index.php?detailsoal&idgroup='.$idgroup);
}

?>