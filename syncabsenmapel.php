<?php
require("config/config.default.php");
require("config/config.function.php");
//cek_session_admin();
//Make sure that it is a POST request.
$token = isset($_GET['token']) ? $_GET['token'] : 'false';
$querys = mysqli_query($koneksi, "select token_api from setting where token_api='$token'");
$cektoken = mysqli_num_rows($querys);

if ($cektoken <> 0) {
    if (strcasecmp($_SERVER['REQUEST_METHOD'], 'POST') != 0) {
        throw new Exception('Request method must be POST!');
    }

    //Make sure that the content type of the POST request has been set to application/json
    $contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';
    if (strcasecmp($contentType, 'application/json') != 0) {
        throw new Exception('Content type must be: application/json');
    }

    //Receive the RAW post data.
    $content = trim(file_get_contents("php://input"));

    //Attempt to decode the incoming RAW post data from JSON.
    $decoded = json_decode($content, true);

    //If json_decode failed, the JSON is invalid.
    if (!is_array($decoded)) {
        throw new Exception('Received content contained invalid JSON!');
    }

    foreach ($decoded as $nilai) {
		$date=date('Y-m-d');
        $cek = mysqli_num_rows(mysqli_query($koneksi, "select * from absen_daringmapel where idsiswa='$nilai[idsiswa]' and idmateri='$nilai[idmateri]' and tanggal='$date' "));
        if ($cek == 0) {
            mysqli_query($koneksi, "insert into absen_daringmapel (idmateri,mapel,idsiswa,tanggal,jam,ket,guru)
        values ('$nilai[idmateri]','$nilai[mapel]','$nilai[idsiswa]','$nilai[tanggal]','$nilai[jam]','$nilai[ket]','$nilai[guru]')");
        }
    }

    echo "berhasil";
} else {
    echo "<script>location.href='.'</script>";
}
