<?php

require("../../../config/config.default.php");
require("../../../config/config.function.php");
$kode = $_POST['id'];


$exec = mysqli_query($koneksi, "DELETE FROM komentar WHERE id='$kode'");

