<?php
require("config/config.default.php");
require("config/config.function.php");
require("config/functions.crud.php");
cek_session_siswa();
function compressImage($source, $destination, $quality) { 
   
    $imgInfo = getimagesize($source); 
    $mime = $imgInfo['mime']; 
  
    switch($mime){ 
        case 'image/jpeg': 
            $image = imagecreatefromjpeg($source); 
            break; 
        case 'image/png': 
            $image = imagecreatefrompng($source); 
            break; 
        case 'image/gif': 
            $image = imagecreatefromgif($source); 
            break; 
        default: 
            $image = imagecreatefromjpeg($source); 
    } 
	 imagejpeg($image, $destination, $quality); 
     
   
    return $destination; 
} 
$foto = $_FILES['file']['name'];
$tmp = $_FILES['file']['tmp_name'];
$fotobaru = date('dmYHis').$foto;
$path = "tugas/".$fotobaru;

$id_siswa = $_SESSION['id_siswa'];
$tanggale=date('dmYHis');
$tanggal = date('Y-m-d');
$jam= date('H:i:s');
  $cekdata = "SELECT * FROM absen_daring WHERE idsiswa='$id_siswa'  AND tanggal='$tanggal'";
$jikaada = mysqli_query($koneksi,$cekdata);
if(mysqli_num_rows($jikaada)==0){
  

		 $compressedImage = compressImage($tmp, $path, 32);
      
        if ($compressedImage) {
            $data = array(
               
                'idsiswa' => $id_siswa,
                'tanggal' => $tanggal,
				 'jam' => $jam,
				  'ket' => 'H',
                'gambar' => $fotobaru
            );
            $where = array(
                'idsiswa' => $id_siswa,
               'tanggal' => $tanggal
            );
            $cek = rowcount($koneksi, 'absen_daring', $where);
            if ($cek == 0) {
                insert($koneksi, 'absen_daring', $data);
				
            } else {
               
            }
            echo "ok";
        } else {
            echo "gagal";
        

}
}else{
}
