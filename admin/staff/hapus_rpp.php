<?php

require("../../config/config.default.php");
require("../../config/config.function.php");
$kode = $_POST['id'];
cek_session_guru();

$exec = mysqli_query($koneksi, "DELETE FROM rpp WHERE id_rpp='$kode'");
