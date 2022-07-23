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

    foreach ($decoded as $mapel) {
        $cek = mysqli_num_rows(mysqli_query($koneksi, "select * from mapel where id_mapel='$mapel[id_mapel]'"));
        if ($cek == 0) {
             mysqli_query($koneksi, "insert into mapel (id_mapel,kode,idpk,idguru,nama,level,groupsoal,bobot_pg,bobot_esai,bobot_multi,bobot_bs,bobot_urut,kelas,date,status) 
			values ('$mapel[id_mapel]','$mapel[kode]','$mapel[idpk]','$mapel[idguru]','$mapel[nama]','$mapel[level]','$mapel[groupsoal]','$mapel[bobot_pg]','$mapel[bobot_esai]','$mapel[bobot_multi]','$mapel[bobot_bs]','$mapel[bobot_urut]'
			,'$mapel[kelas]','$mapel[date]','$mapel[status]')");
        
        }
    }

    echo "berhasil";
} else {
    echo "<script>location.href='.'</script>";
}
