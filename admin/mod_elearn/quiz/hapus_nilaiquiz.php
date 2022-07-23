<?php

require("../../../config/config.default.php");
require("../../../config/config.function.php");
$kode = $_POST['id'];
cek_session_guru();
$exec = mysqli_query($koneksi, "DELETE FROM jawaban_quiz WHERE materi='$kode'");
$exec = mysqli_query($koneksi, "DELETE FROM nilaiquiz WHERE idmateri='$kode'");
