<?php
require("../../config/config.default.php");
require("../../config/config.function.php");
require("../../config/functions.crud.php");
cek_session_guru();
(isset($_GET['pg'])) ? $pg = $_GET['pg'] : $pg = '';
$pengawas = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM pengawas  WHERE id_pengawas='$_SESSION[id_pengawas]'"));
$id_pengawas = $pengawas['id_pengawas'];
if ($pg == 'ubah') {
    $id = $_POST['idm'];
   $kode = str_replace(' ', '', $_POST['kode']);
   
    $nama = $_POST['nama'];
    $nama = str_replace("'", "&#39;", $nama);
    if ($setting['jenjang'] == "SMK") {
        $id_pk = $_POST['id_pk'];
    } else {
        $id_pk = ["semua"];
    }
    $level = $_POST['level'];
    $status = $_POST['status'];
    $groupsoal = $_POST['groupsoal'];
    $guru = $_POST['guru'];
    $kelas = serialize($_POST['kelas']);
    $idpk = serialize($id_pk);
    if ($pengawas['level'] == 'admin') {
        $exec = mysqli_query($koneksi, "UPDATE mapel SET kode='$kode', idpk='$idpk',nama='$nama',level='$level',groupsoal='$groupsoal',status='$status',kelas='$kelas',idguru='$guru' WHERE id_mapel='$id'");
        if ($exec) {
            echo "OK";
        }
    } elseif ($pengawas['level'] == 'guru') {
        $exec = mysqli_query($koneksi, "UPDATE mapel SET kode='$kode', idpk='$idpk',nama='$nama',level='$level',groupsoal='$groupsoal',status='$status',kelas='$kelas' WHERE id_mapel='$id'");
        if ($exec) {
            echo "OK";
        }
    }
}
if ($pg == 'tambahpg') {
	$id_mapel= $_POST['id_mapel'];
    $pg = $_POST['bobot_pg'];
	$multi = $_POST['bobot_multi'];
	$esai = $_POST['bobot_esai'];
	$bs = $_POST['bobot_bs'];
	$urut = $_POST['bobot_urut'];
        $exec = mysqli_query($koneksi, "UPDATE mapel SET bobot_pg='$pg', bobot_esai='$esai', bobot_multi='$multi', bobot_bs='$bs', bobot_urut='$urut' WHERE id_mapel='$id_mapel'");
        if ($exec) {
            echo "OK";
        }
}
if ($pg == 'tambah') {
   $kode = str_replace(' ', '', $_POST['kode']);
   
    $nama = $_POST['nama'];
    $nama = str_replace("'", "&#39;", $nama);
    if ($setting['jenjang'] == "SMK") {
        $id_pk = $_POST['id_pk'];
    } else {
        $id_pk = ["semua"];
    }
    $level = $_POST['level'];
    $status = $_POST['status'];
    $groupsoal = $_POST['groupsoal'];
   
    $kelas = serialize($_POST['kelas']);
    $id_pk = serialize($id_pk);
    $cek = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM mapel WHERE  kode='$kode' AND groupsoal='$groupsoal'"));

    if ($pengawas['level'] == 'admin' OR $pengawas['level'] == 'guru') {
        $guru = $_POST['guru'];
        if ($cek > 0) :
            echo "Maaf kode Soal Sudah ada !";
        else :
		if($setting['jenjang']==SMK){
            $exec = mysqli_query($koneksi, "INSERT INTO mapel (kode, idpk, nama,level,status,idguru,kelas,groupsoal,opsi) VALUES ('$kode','$id_pk','$nama','$level','$status','$guru','$kelas','$groupsoal','5')");
		}else{
		 $exec = mysqli_query($koneksi, "INSERT INTO mapel (kode, idpk, nama,level,status,idguru,kelas,groupsoal,opsi) VALUES ('$kode','$id_pk','$nama','$level','$status','$guru','$kelas','$groupsoal','4')");
		}
			if ($exec) {
                echo "OK";
            } else {
                echo mysqli_error($koneksi);
            }
        endif;
    } elseif ($pengawas['level'] == 'guru') {
		$guru = $_POST['guru'];
        if ($cek > 0) :
            echo "Maaf kode Sudah ada !";
        else :
           $exec = mysqli_query($koneksi, "INSERT INTO mapel (kode, idpk, nama,level,status,idguru,kelas,groupsoal,opsi) VALUES ('$kode','$id_pk','$nama','$level','$status','$guru','$kelas','$groupsoal')");

            if ($exec) {
                echo "OK";
            }
        endif;
    }
}
if ($pg == 'copy_bank') {
    $id = $_POST['idm'];
    $mapel = mysqli_fetch_array(mysqli_query($koneksi, "select * from mapel where id_mapel='$id'"));
    $kode = str_replace(' ', '_', $_POST['kodebank']);
    $nama = $mapel['nama'];
    $jml_esai = $mapel['jml_esai'];
    $jml_soal = $mapel['jml_soal'];
    $bobot_pg = $mapel['bobot_pg'];
    $bobot_esai = $mapel['bobot_esai'];
    $tampil_pg = $mapel['tampil_pg'];
    $tampil_esai = $mapel['tampil_esai'];
    $level = $mapel['level'];
    $status = $mapel['status'];
    $opsi = $mapel['opsi'];
    $kkm = $mapel['kkm'];
    $agama = $mapel['agama'];
    $kelas = $mapel['kelas'];
    $id_pk = $mapel['idpk'];
    $guru = $mapel['idguru'];
    $cek = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM mapel WHERE  kode='$kode'"));

    if ($cek > 0) :
        echo "Maaf Kode Bank Soal Sudah ada !";
    else :
        $exec = mysqli_query($koneksi, "INSERT INTO mapel (kode, idpk, nama, jml_soal,jml_esai,level,status,idguru,bobot_pg,bobot_esai,tampil_pg,tampil_esai,kelas,opsi,kkm,soal_agama) VALUES ('$kode','$id_pk','$nama','$jml_soal','$jml_esai','$level','$status','$guru','$bobot_pg','$bobot_esai','$tampil_pg','$tampil_esai','$kelas','$opsi','$kkm','$agama')");
        if ($exec) {
            echo "OK";
        }
    endif;
}
if ($pg == 'hapus') {
    $kode = $_POST['kode'];
    $exec = mysqli_query($koneksi, "DELETE a.*, b.* FROM mapel a JOIN soal b ON a.id_mapel = b.id_mapel WHERE a.id_mapel in (" . $kode . "')");
    $exec = mysqli_query($koneksi, "DELETE FROM soal WHERE id_mapel in (" . $kode . ")");
    $exec = mysqli_query($koneksi, "DELETE FROM mapel  WHERE id_mapel in (" . $kode . ")");
    if ($exec) {
        echo 1;
    } else {
        echo 0;
    }
}
if ($pg == 'simpan_soal') {
      $opsi = $_POST['opsi'];
    $nomor = $_POST['nomor'];
    $jenis = $_POST['jenis'];
    $id_mapel = $_POST['mapel'];
    $mapel = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM mapel WHERE id_mapel='$id_mapel'"));
    $jumsoal = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM soal WHERE id_mapel='$id_mapel' AND  nomor='$nomor' AND jenis='$jenis'"));
    $soalQ = mysqli_query($koneksi, "SELECT * FROM soal WHERE id_mapel='$id_mapel' AND  nomor='$nomor' AND jenis='$jenis'");
    $soal = mysqli_fetch_array($soalQ);
    $isi_soal = addslashes($_POST['isi_soal']);
    $ektensi = ['jpg', 'png', 'mp3', 'jpeg'];
    if ($jenis == '1') {
        $pilA = addslashes($_POST['pilA']);
        $pilB = addslashes($_POST['pilB']);
        $pilC = addslashes($_POST['pilC']);
        $pilD = addslashes($_POST['pilD']);

        $pilE = addslashes($_POST['pilE']);

        if (isset($_FILES['file']['name']) && $_FILES['file']['name'] <> '') {
            $file = $_FILES['file']['name'];
            $temp = $_FILES['file']['tmp_name'];
            $size = $_FILES['file']['size'];
            $ext = explode('.', $file);
            $ext = end($ext);
            if (in_array($ext, $ektensi)) {
                $url = 'files/' . $id_mapel . '_' . $nomor . '_1.' . $ext;
                $urlx = $id_mapel . '_' . $nomor . '_1.' . $ext;
                $upload = move_uploaded_file($temp, '../../' . $url);
                $que = mysqli_query($koneksi, "insert into file_pendukung (nama_file,id_mapel)values('$urlx','$id_mapel')");
                (!$upload) ? $url = $soal['file'] : null;
            }
        } else {
            $urlx = $soal['file'];
        }
        if (isset($_FILES['file1']['name']) && $_FILES['file1']['name'] <> '') {
            $file1 = $_FILES['file1']['name'];
            $temp = $_FILES['file1']['tmp_name'];
            $size = $_FILES['file1']['size'];
            $ext = explode('.', $file1);
            $ext = end($ext);
            if (in_array($ext, $ektensi)) {
                $file1 = 'files/' . $id_mapel . '_' . $nomor . '_2.' . $ext;
                $filex1 = $id_mapel . '_' . $nomor . '_2.' . $ext;
                $upload = move_uploaded_file($temp, '../../' . $file1);
                $que = mysqli_query($koneksi, "insert into file_pendukung (nama_file,id_mapel)values('$filex1','$id_mapel')");
                (!$upload) ? $file1 = $soal['file1'] : null;
            }
        } else {
            $filex1 = $soal['file1'];
        }
        if (isset($_FILES['fileA']['name']) && $_FILES['fileA']['name'] <> '') {
            $fileA = $_FILES['fileA']['name'];
            $temp = $_FILES['fileA']['tmp_name'];
            $size = $_FILES['fileA']['size'];
            $ext = explode('.', $fileA);
            $ext = end($ext);
            if (in_array($ext, $ektensi)) {
                $fileA = 'files/' . $id_mapel . '_' . $nomor . '_A.' . $ext;
                $filexA = $id_mapel . '_' . $nomor . '_A.' . $ext;
                $upload = move_uploaded_file($temp, '../../' . $fileA);
                $que = mysqli_query($koneksi, "insert into file_pendukung (nama_file,id_mapel)values('$filexA','$id_mapel')");
                (!$upload) ? $fileA = $soal['fileA'] : null;
            }
        } else {
            $filexA = $soal['fileA'];
        }
        if (isset($_FILES['fileB']['name']) && $_FILES['fileB']['name'] <> '') {
            $fileB = $_FILES['fileB']['name'];
            $temp = $_FILES['fileB']['tmp_name'];
            $size = $_FILES['fileB']['size'];
            $ext = explode('.', $fileB);
            $ext = end($ext);
            if (in_array($ext, $ektensi)) {
                $fileB = 'files/' . $id_mapel . '_' . $nomor . '_B.' . $ext;
                $filexB = $id_mapel . '_' . $nomor . '_B.' . $ext;
                $upload = move_uploaded_file($temp, '../../' . $fileB);
                $que = mysqli_query($koneksi, "insert into file_pendukung (nama_file,id_mapel)values('$filexB','$id_mapel')");
                (!$upload) ? $fileB = $soal['fileB'] : null;
            }
        } else {
            $filexB = $soal['fileB'];
        }
        if (isset($_FILES['fileC']['name']) && $_FILES['fileC']['name'] <> '') {
            $fileC = $_FILES['fileC']['name'];
            $temp = $_FILES['fileC']['tmp_name'];
            $size = $_FILES['fileC']['size'];
            $ext = explode('.', $fileC);
            $ext = end($ext);
            if (in_array($ext, $ektensi)) {
                $fileC = 'files/' . $id_mapel . '_' . $nomor . '_C.' . $ext;
                $filexC = $id_mapel . '_' . $nomor . '_C.' . $ext;
                $upload = move_uploaded_file($temp, '../../' . $fileC);
                $que = mysqli_query($koneksi, "insert into file_pendukung (nama_file,id_mapel)values('$filexC','$id_mapel')");
                (!$upload) ? $fileC = $soal['fileC'] : null;
            }
        } else {
            $filexC = $soal['fileC'];
        }
        if (isset($_FILES['fileD']['name']) && $_FILES['fileD']['name'] <> '') {
            $fileD = $_FILES['fileD']['name'];
            $temp = $_FILES['fileD']['tmp_name'];
            $size = $_FILES['fileD']['size'];
            $ext = explode('.', $fileD);
            $ext = end($ext);
            if (in_array($ext, $ektensi)) {
                $fileD = 'files/' . $id_mapel . '_' . $nomor . '_D.' . $ext;
                $filexD = $id_mapel . '_' . $nomor . '_D.' . $ext;
                $upload = move_uploaded_file($temp, '../../' . $fileD);
                $que = mysqli_query($koneksi, "insert into file_pendukung (nama_file,id_mapel)values('$filexD','$id_mapel')");
                (!$upload) ? $fileD = $soal['fileD'] : null;
            }
        } else {
            $filexD = $soal['fileD'];
        }

        if (isset($_FILES['fileE']['name']) && $_FILES['fileE']['name'] <> '') {
            $fileE = $_FILES['fileE']['name'];
            $temp = $_FILES['fileE']['tmp_name'];
            $size = $_FILES['fileE']['size'];
            $ext = explode('.', $fileE);
            $ext = end($ext);
            if (in_array($ext, $ektensi)) {
                $fileE = 'files/' . $id_mapel . '_' . $nomor . '_E.' . $ext;
                $filexE = $id_mapel . '_' . $nomor . '_E.' . $ext;
                $upload = move_uploaded_file($temp, '../../' . $fileE);
                $que = mysqli_query($koneksi, "insert into file_pendukung (nama_file,id_mapel)values('$filexE','$id_mapel')");
                (!$upload) ? $fileE = $soal['fileE'] : null;
            }
        } else {
            $filexE = $soal['fileE'];
        }

        $jawaban = $_POST['jawaban'];
        if ($jumsoal == 0) {
            $exec = mysqli_query($koneksi, "INSERT INTO soal (id_mapel,nomor,soal,jenis,pilA,pilB,pilC,pilD,pilE,jawaban,file,file1,fileA,fileB,fileC,fileD,fileE,ket) VALUES ('$id_mapel','$nomor','$isi_soal','1','$pilA','$pilB','$pilC','$pilD','$pilE','$jawaban','$urlx','$filex1','$filexA','$filexB','$filexC','$filexD','$filexE','Pilih Salah Satu Jawaban Yang Benar')");
        } else {
            $exec = mysqli_query($koneksi, "UPDATE soal SET soal='$isi_soal',pilA='$pilA',pilB='$pilB',pilC='$pilC',pilD='$pilD',pilE='$pilE',jawaban='$jawaban',file='$urlx',file1='$filex1',fileA='$filexA',fileB='$filexB',fileC='$filexC',fileD='$filexD',fileE='$filexE' WHERE id_mapel='$id_mapel' AND nomor='$nomor' AND jenis='1'");
        
	   }
    }
    if ($jenis == '2') {
		 $pilA = addslashes($_POST['pilA']);
        if (isset($_FILES['file']['name']) && $_FILES['file']['name'] <> '') {
            $file = $_FILES['file']['name'];
            $temp = $_FILES['file']['tmp_name'];
            $size = $_FILES['file']['size'];
            $ext = explode('.', $file);
            $ext = end($ext);
            $url = 'files/' . $id_mapel . '_' . $nomor . '_E1.' . $ext;
            $urlx = $id_mapel . '_' . $nomor . '_E1.' . $ext;
            $upload = move_uploaded_file($temp, '../../' . $url);
            $que = mysqli_query($koneksi, "insert into file_pendukung (nama_file,id_mapel)values('$urlx','$id_mapel')");
            (!$upload) ? $url = $soal['file'] : null;
        } else {
            $urlx = $soal['file'];
        }
        if (isset($_FILES['file1']['name']) && $_FILES['file1']['name'] <> '') {
            $file1 = $_FILES['file1']['name'];
            $temp = $_FILES['file1']['tmp_name'];
            $size = $_FILES['file1']['size'];
            $ext = explode('.', $file1);
            $ext = end($ext);
            $file1 = 'files/' . $id_mapel . '_' . $nomor . '_E2.' . $ext;
            $filex1 = $id_mapel . '_' . $nomor . '_E2.' . $ext;
            $upload = move_uploaded_file($temp, '../../' . $file1);
            $que = mysqli_query($koneksi, "insert into file_pendukung (nama_file,id_mapel)values('$filex1','$id_mapel')");
            (!$upload) ? $file1 = $soal['file1'] : null;
        } else {
            $filex1 = $soal['file1'];
        }
        if ($jumsoal == 0) {
            $exec = mysqli_query($koneksi, "INSERT INTO soal (id_mapel,nomor,soal,jawaban,jenis,file,file1,ket) VALUES ('$id_mapel','$nomor','$isi_soal','$pilA','2','$urlx','$filex1','Isi Uraian Singkat')");
        } else {
            $exec = mysqli_query($koneksi, "UPDATE soal SET soal='$isi_soal',file='$urlx',file1='$filex1',jawaban='$pilA' WHERE id_mapel='$id_mapel' AND nomor='$nomor' AND jenis='2'");
        
		}
    }
    (!$exec) ? $info = info('Gagal menyimpan soal!', 'NO') : $info = info('Berhasil menyimpan soal!', 'OK');
}

  if ($jenis == '3') {
	
	  $pilA = addslashes($_POST['pilA']);
     $pilB = addslashes($_POST['pilB']);
     $pilC = addslashes($_POST['pilC']);
      $pilD = addslashes($_POST['pilD']);

        $pilE = addslashes($_POST['pilE']);

        if (isset($_FILES['file']['name']) && $_FILES['file']['name'] <> '') {
            $file = $_FILES['file']['name'];
            $temp = $_FILES['file']['tmp_name'];
            $size = $_FILES['file']['size'];
            $ext = explode('.', $file);
            $ext = end($ext);
            if (in_array($ext, $ektensi)) {
                $url = 'files/' . $id_mapel . '_' . $nomor . '_1.' . $ext;
                $urlx = $id_mapel . '_' . $nomor . '_1.' . $ext;
                $upload = move_uploaded_file($temp, '../../' . $url);
                $que = mysqli_query($koneksi, "insert into file_pendukung (nama_file,id_mapel)values('$urlx','$id_mapel')");
                (!$upload) ? $url = $soal['file'] : null;
            }
        } else {
            $urlx = $soal['file'];
        }
        if (isset($_FILES['file1']['name']) && $_FILES['file1']['name'] <> '') {
            $file1 = $_FILES['file1']['name'];
            $temp = $_FILES['file1']['tmp_name'];
            $size = $_FILES['file1']['size'];
            $ext = explode('.', $file1);
            $ext = end($ext);
            if (in_array($ext, $ektensi)) {
                $file1 = 'files/' . $id_mapel . '_' . $nomor . '_2.' . $ext;
                $filex1 = $id_mapel . '_' . $nomor . '_2.' . $ext;
                $upload = move_uploaded_file($temp, '../../' . $file1);
                $que = mysqli_query($koneksi, "insert into file_pendukung (nama_file,id_mapel)values('$filex1','$id_mapel')");
                (!$upload) ? $file1 = $soal['file1'] : null;
            }
        } else {
            $filex1 = $soal['file1'];
        }
        if (isset($_FILES['fileA']['name']) && $_FILES['fileA']['name'] <> '') {
            $fileA = $_FILES['fileA']['name'];
            $temp = $_FILES['fileA']['tmp_name'];
            $size = $_FILES['fileA']['size'];
            $ext = explode('.', $fileA);
            $ext = end($ext);
            if (in_array($ext, $ektensi)) {
                $fileA = 'files/' . $id_mapel . '_' . $nomor . '_A.' . $ext;
                $filexA = $id_mapel . '_' . $nomor . '_A.' . $ext;
                $upload = move_uploaded_file($temp, '../../' . $fileA);
                $que = mysqli_query($koneksi, "insert into file_pendukung (nama_file,id_mapel)values('$filexA','$id_mapel')");
                (!$upload) ? $fileA = $soal['fileA'] : null;
            }
        } else {
            $filexA = $soal['fileA'];
        }
        if (isset($_FILES['fileB']['name']) && $_FILES['fileB']['name'] <> '') {
            $fileB = $_FILES['fileB']['name'];
            $temp = $_FILES['fileB']['tmp_name'];
            $size = $_FILES['fileB']['size'];
            $ext = explode('.', $fileB);
            $ext = end($ext);
            if (in_array($ext, $ektensi)) {
                $fileB = 'files/' . $id_mapel . '_' . $nomor . '_B.' . $ext;
                $filexB = $id_mapel . '_' . $nomor . '_B.' . $ext;
                $upload = move_uploaded_file($temp, '../../' . $fileB);
                $que = mysqli_query($koneksi, "insert into file_pendukung (nama_file,id_mapel)values('$filexB','$id_mapel')");
                (!$upload) ? $fileB = $soal['fileB'] : null;
            }
        } else {
            $filexB = $soal['fileB'];
        }
        if (isset($_FILES['fileC']['name']) && $_FILES['fileC']['name'] <> '') {
            $fileC = $_FILES['fileC']['name'];
            $temp = $_FILES['fileC']['tmp_name'];
            $size = $_FILES['fileC']['size'];
            $ext = explode('.', $fileC);
            $ext = end($ext);
            if (in_array($ext, $ektensi)) {
                $fileC = 'files/' . $id_mapel . '_' . $nomor . '_C.' . $ext;
                $filexC = $id_mapel . '_' . $nomor . '_C.' . $ext;
                $upload = move_uploaded_file($temp, '../../' . $fileC);
                $que = mysqli_query($koneksi, "insert into file_pendukung (nama_file,id_mapel)values('$filexC','$id_mapel')");
                (!$upload) ? $fileC = $soal['fileC'] : null;
            }
        } else {
            $filexC = $soal['fileC'];
        }
        if (isset($_FILES['fileD']['name']) && $_FILES['fileD']['name'] <> '') {
            $fileD = $_FILES['fileD']['name'];
            $temp = $_FILES['fileD']['tmp_name'];
            $size = $_FILES['fileD']['size'];
            $ext = explode('.', $fileD);
            $ext = end($ext);
            if (in_array($ext, $ektensi)) {
                $fileD = 'files/' . $id_mapel . '_' . $nomor . '_D.' . $ext;
                $filexD = $id_mapel . '_' . $nomor . '_D.' . $ext;
                $upload = move_uploaded_file($temp, '../../' . $fileD);
                $que = mysqli_query($koneksi, "insert into file_pendukung (nama_file,id_mapel)values('$filexD','$id_mapel')");
                (!$upload) ? $fileD = $soal['fileD'] : null;
            }
        } else {
            $filexD = $soal['fileD'];
        }

        if (isset($_FILES['fileE']['name']) && $_FILES['fileE']['name'] <> '') {
            $fileE = $_FILES['fileE']['name'];
            $temp = $_FILES['fileE']['tmp_name'];
            $size = $_FILES['fileE']['size'];
            $ext = explode('.', $fileE);
            $ext = end($ext);
            if (in_array($ext, $ektensi)) {
                $fileE = 'files/' . $id_mapel . '_' . $nomor . '_E.' . $ext;
                $filexE = $id_mapel . '_' . $nomor . '_E.' . $ext;
                $upload = move_uploaded_file($temp, '../../' . $fileE);
                $que = mysqli_query($koneksi, "insert into file_pendukung (nama_file,id_mapel)values('$filexE','$id_mapel')");
                (!$upload) ? $fileE = $soal['fileE'] : null;
            }
        } else {
            $filexE = $soal['fileE'];
        }
        
       $jawabane = implode($_POST['jawaban'], ', ');
	   
        if ($jumsoal == 0) {
            $exec = mysqli_query($koneksi, "INSERT INTO soal (id_mapel,nomor,soal,jenis,pilA,pilB,pilC,pilD,pilE,jawaban,file,file1,fileA,fileB,fileC,fileD,fileE,ket) VALUES ('$id_mapel','$nomor','$isi_soal','3','$pilA','$pilB','$pilC','$pilD','$pilE','$jawabane','$urlx','$filex1','$filexA','$filexB','$filexC','$filexD','$filexE','Pilih Jawaban Yang Semua dianggap Benar')");
        } else {
            $exec = mysqli_query($koneksi, "UPDATE soal SET soal='$isi_soal',pilA='$pilA',pilB='$pilB',pilC='$pilC',pilD='$pilD',pilE='$pilE',jawaban='$jawabane',file='$urlx',file1='$filex1',fileA='$filexA',fileB='$filexB',fileC='$filexC',fileD='$filexD',fileE='$filexE' WHERE id_mapel='$id_mapel' AND nomor='$nomor' AND jenis='3'");
       
	   }
    }

  if ($jenis == '4') {
	
	    $pilA = addslashes($_POST['pilA']);
        $pilB = addslashes($_POST['pilB']);
        $pilC = addslashes($_POST['pilC']);
        $pilD = addslashes($_POST['pilD']);

        $pilE = addslashes($_POST['pilE']);

        if (isset($_FILES['file']['name']) && $_FILES['file']['name'] <> '') {
            $file = $_FILES['file']['name'];
            $temp = $_FILES['file']['tmp_name'];
            $size = $_FILES['file']['size'];
            $ext = explode('.', $file);
            $ext = end($ext);
            if (in_array($ext, $ektensi)) {
                $url = 'files/' . $id_mapel . '_' . $nomor . '_1.' . $ext;
                $urlx = $id_mapel . '_' . $nomor . '_1.' . $ext;
                $upload = move_uploaded_file($temp, '../../' . $url);
                $que = mysqli_query($koneksi, "insert into file_pendukung (nama_file,id_mapel)values('$urlx','$id_mapel')");
                (!$upload) ? $url = $soal['file'] : null;
            }
        } else {
            $urlx = $soal['file'];
        }
        if (isset($_FILES['file1']['name']) && $_FILES['file1']['name'] <> '') {
            $file1 = $_FILES['file1']['name'];
            $temp = $_FILES['file1']['tmp_name'];
            $size = $_FILES['file1']['size'];
            $ext = explode('.', $file1);
            $ext = end($ext);
            if (in_array($ext, $ektensi)) {
                $file1 = 'files/' . $id_mapel . '_' . $nomor . '_2.' . $ext;
                $filex1 = $id_mapel . '_' . $nomor . '_2.' . $ext;
                $upload = move_uploaded_file($temp, '../../' . $file1);
                $que = mysqli_query($koneksi, "insert into file_pendukung (nama_file,id_mapel)values('$filex1','$id_mapel')");
                (!$upload) ? $file1 = $soal['file1'] : null;
            }
        } else {
            $filex1 = $soal['file1'];
        }
        if (isset($_FILES['fileA']['name']) && $_FILES['fileA']['name'] <> '') {
            $fileA = $_FILES['fileA']['name'];
            $temp = $_FILES['fileA']['tmp_name'];
            $size = $_FILES['fileA']['size'];
            $ext = explode('.', $fileA);
            $ext = end($ext);
            if (in_array($ext, $ektensi)) {
                $fileA = 'files/' . $id_mapel . '_' . $nomor . '_A.' . $ext;
                $filexA = $id_mapel . '_' . $nomor . '_A.' . $ext;
                $upload = move_uploaded_file($temp, '../../' . $fileA);
                $que = mysqli_query($koneksi, "insert into file_pendukung (nama_file,id_mapel)values('$filexA','$id_mapel')");
                (!$upload) ? $fileA = $soal['fileA'] : null;
            }
        } else {
            $filexA = $soal['fileA'];
        }
        if (isset($_FILES['fileB']['name']) && $_FILES['fileB']['name'] <> '') {
            $fileB = $_FILES['fileB']['name'];
            $temp = $_FILES['fileB']['tmp_name'];
            $size = $_FILES['fileB']['size'];
            $ext = explode('.', $fileB);
            $ext = end($ext);
            if (in_array($ext, $ektensi)) {
                $fileB = 'files/' . $id_mapel . '_' . $nomor . '_B.' . $ext;
                $filexB = $id_mapel . '_' . $nomor . '_B.' . $ext;
                $upload = move_uploaded_file($temp, '../../' . $fileB);
                $que = mysqli_query($koneksi, "insert into file_pendukung (nama_file,id_mapel)values('$filexB','$id_mapel')");
                (!$upload) ? $fileB = $soal['fileB'] : null;
            }
        } else {
            $filexB = $soal['fileB'];
        }
        if (isset($_FILES['fileC']['name']) && $_FILES['fileC']['name'] <> '') {
            $fileC = $_FILES['fileC']['name'];
            $temp = $_FILES['fileC']['tmp_name'];
            $size = $_FILES['fileC']['size'];
            $ext = explode('.', $fileC);
            $ext = end($ext);
            if (in_array($ext, $ektensi)) {
                $fileC = 'files/' . $id_mapel . '_' . $nomor . '_C.' . $ext;
                $filexC = $id_mapel . '_' . $nomor . '_C.' . $ext;
                $upload = move_uploaded_file($temp, '../../' . $fileC);
                $que = mysqli_query($koneksi, "insert into file_pendukung (nama_file,id_mapel)values('$filexC','$id_mapel')");
                (!$upload) ? $fileC = $soal['fileC'] : null;
            }
        } else {
            $filexC = $soal['fileC'];
        }
        if (isset($_FILES['fileD']['name']) && $_FILES['fileD']['name'] <> '') {
            $fileD = $_FILES['fileD']['name'];
            $temp = $_FILES['fileD']['tmp_name'];
            $size = $_FILES['fileD']['size'];
            $ext = explode('.', $fileD);
            $ext = end($ext);
            if (in_array($ext, $ektensi)) {
                $fileD = 'files/' . $id_mapel . '_' . $nomor . '_D.' . $ext;
                $filexD = $id_mapel . '_' . $nomor . '_D.' . $ext;
                $upload = move_uploaded_file($temp, '../../' . $fileD);
                $que = mysqli_query($koneksi, "insert into file_pendukung (nama_file,id_mapel)values('$filexD','$id_mapel')");
                (!$upload) ? $fileD = $soal['fileD'] : null;
            }
        } else {
            $filexD = $soal['fileD'];
        }

        if (isset($_FILES['fileE']['name']) && $_FILES['fileE']['name'] <> '') {
            $fileE = $_FILES['fileE']['name'];
            $temp = $_FILES['fileE']['tmp_name'];
            $size = $_FILES['fileE']['size'];
            $ext = explode('.', $fileE);
            $ext = end($ext);
            if (in_array($ext, $ektensi)) {
                $fileE = 'files/' . $id_mapel . '_' . $nomor . '_E.' . $ext;
                $filexE = $id_mapel . '_' . $nomor . '_E.' . $ext;
                $upload = move_uploaded_file($temp, '../../' . $fileE);
                $que = mysqli_query($koneksi, "insert into file_pendukung (nama_file,id_mapel)values('$filexE','$id_mapel')");
                (!$upload) ? $fileE = $soal['fileE'] : null;
            }
        } else {
            $filexE = $soal['fileE'];
        }
        if($setting['jenjang']==SMA OR $setting['jenjang']==SMK){
        $jawabanb = $_POST['jawabana'].', '.$_POST['jawabanb'].', '.$_POST['jawabanc'].', '.$_POST['jawaband'].', '.$_POST['jawabane'];
		}else{
			   $jawabanb = $_POST['jawabana'].', '.$_POST['jawabanb'].', '.$_POST['jawabanc'].', '.$_POST['jawaband'];
		}
        if ($jumsoal == 0) {
            $exec = mysqli_query($koneksi, "INSERT INTO soal (id_mapel,nomor,soal,jenis,pilA,pilB,pilC,pilD,pilE,jawaban,file,file1,fileA,fileB,fileC,fileD,fileE,ket) VALUES ('$id_mapel','$nomor','$isi_soal','4','$pilA','$pilB','$pilC','$pilD','$pilE','$jawabanb','$urlx','$filex1','$filexA','$filexB','$filexC','$filexD','$filexE','Pilih Jawaban Benar Salah')");
        } else {
            $exec = mysqli_query($koneksi, "UPDATE soal SET soal='$isi_soal',pilA='$pilA',pilB='$pilB',pilC='$pilC',pilD='$pilD',pilE='$pilE',jawaban='$jawabanb',file='$urlx',file1='$filex1',fileA='$filexA',fileB='$filexB',fileC='$filexC',fileD='$filexD',fileE='$filexE' WHERE id_mapel='$id_mapel' AND nomor='$nomor' AND jenis='4'");
        
	   }
    }

 if ($jenis == '5') {
	
	  $pilA = addslashes($_POST['pilA']);
     $pilB = addslashes($_POST['pilB']);
     $pilC = addslashes($_POST['pilC']);
      $pilD = addslashes($_POST['pilD']);

        $pilE = addslashes($_POST['pilE']);

        if (isset($_FILES['file']['name']) && $_FILES['file']['name'] <> '') {
            $file = $_FILES['file']['name'];
            $temp = $_FILES['file']['tmp_name'];
            $size = $_FILES['file']['size'];
            $ext = explode('.', $file);
            $ext = end($ext);
            if (in_array($ext, $ektensi)) {
                $url = 'files/' . $id_mapel . '_' . $nomor . '_1.' . $ext;
                $urlx = $id_mapel . '_' . $nomor . '_1.' . $ext;
                $upload = move_uploaded_file($temp, '../../' . $url);
                $que = mysqli_query($koneksi, "insert into file_pendukung (nama_file,id_mapel)values('$urlx','$id_mapel')");
                (!$upload) ? $url = $soal['file'] : null;
            }
        } else {
            $urlx = $soal['file'];
        }
        if (isset($_FILES['file1']['name']) && $_FILES['file1']['name'] <> '') {
            $file1 = $_FILES['file1']['name'];
            $temp = $_FILES['file1']['tmp_name'];
            $size = $_FILES['file1']['size'];
            $ext = explode('.', $file1);
            $ext = end($ext);
            if (in_array($ext, $ektensi)) {
                $file1 = 'files/' . $id_mapel . '_' . $nomor . '_2.' . $ext;
                $filex1 = $id_mapel . '_' . $nomor . '_2.' . $ext;
                $upload = move_uploaded_file($temp, '../../' . $file1);
                $que = mysqli_query($koneksi, "insert into file_pendukung (nama_file,id_mapel)values('$filex1','$id_mapel')");
                (!$upload) ? $file1 = $soal['file1'] : null;
            }
        } else {
            $filex1 = $soal['file1'];
        }
        if (isset($_FILES['fileA']['name']) && $_FILES['fileA']['name'] <> '') {
            $fileA = $_FILES['fileA']['name'];
            $temp = $_FILES['fileA']['tmp_name'];
            $size = $_FILES['fileA']['size'];
            $ext = explode('.', $fileA);
            $ext = end($ext);
            if (in_array($ext, $ektensi)) {
                $fileA = 'files/' . $id_mapel . '_' . $nomor . '_A.' . $ext;
                $filexA = $id_mapel . '_' . $nomor . '_A.' . $ext;
                $upload = move_uploaded_file($temp, '../../' . $fileA);
                $que = mysqli_query($koneksi, "insert into file_pendukung (nama_file,id_mapel)values('$filexA','$id_mapel')");
                (!$upload) ? $fileA = $soal['fileA'] : null;
            }
        } else {
            $filexA = $soal['fileA'];
        }
        if (isset($_FILES['fileB']['name']) && $_FILES['fileB']['name'] <> '') {
            $fileB = $_FILES['fileB']['name'];
            $temp = $_FILES['fileB']['tmp_name'];
            $size = $_FILES['fileB']['size'];
            $ext = explode('.', $fileB);
            $ext = end($ext);
            if (in_array($ext, $ektensi)) {
                $fileB = 'files/' . $id_mapel . '_' . $nomor . '_B.' . $ext;
                $filexB = $id_mapel . '_' . $nomor . '_B.' . $ext;
                $upload = move_uploaded_file($temp, '../../' . $fileB);
                $que = mysqli_query($koneksi, "insert into file_pendukung (nama_file,id_mapel)values('$filexB','$id_mapel')");
                (!$upload) ? $fileB = $soal['fileB'] : null;
            }
        } else {
            $filexB = $soal['fileB'];
        }
        if (isset($_FILES['fileC']['name']) && $_FILES['fileC']['name'] <> '') {
            $fileC = $_FILES['fileC']['name'];
            $temp = $_FILES['fileC']['tmp_name'];
            $size = $_FILES['fileC']['size'];
            $ext = explode('.', $fileC);
            $ext = end($ext);
            if (in_array($ext, $ektensi)) {
                $fileC = 'files/' . $id_mapel . '_' . $nomor . '_C.' . $ext;
                $filexC = $id_mapel . '_' . $nomor . '_C.' . $ext;
                $upload = move_uploaded_file($temp, '../../' . $fileC);
                $que = mysqli_query($koneksi, "insert into file_pendukung (nama_file,id_mapel)values('$filexC','$id_mapel')");
                (!$upload) ? $fileC = $soal['fileC'] : null;
            }
        } else {
            $filexC = $soal['fileC'];
        }
        if (isset($_FILES['fileD']['name']) && $_FILES['fileD']['name'] <> '') {
            $fileD = $_FILES['fileD']['name'];
            $temp = $_FILES['fileD']['tmp_name'];
            $size = $_FILES['fileD']['size'];
            $ext = explode('.', $fileD);
            $ext = end($ext);
            if (in_array($ext, $ektensi)) {
                $fileD = 'files/' . $id_mapel . '_' . $nomor . '_D.' . $ext;
                $filexD = $id_mapel . '_' . $nomor . '_D.' . $ext;
                $upload = move_uploaded_file($temp, '../../' . $fileD);
                $que = mysqli_query($koneksi, "insert into file_pendukung (nama_file,id_mapel)values('$filexD','$id_mapel')");
                (!$upload) ? $fileD = $soal['fileD'] : null;
            }
        } else {
            $filexD = $soal['fileD'];
        }

        if (isset($_FILES['fileE']['name']) && $_FILES['fileE']['name'] <> '') {
            $fileE = $_FILES['fileE']['name'];
            $temp = $_FILES['fileE']['tmp_name'];
            $size = $_FILES['fileE']['size'];
            $ext = explode('.', $fileE);
            $ext = end($ext);
            if (in_array($ext, $ektensi)) {
                $fileE = 'files/' . $id_mapel . '_' . $nomor . '_E.' . $ext;
                $filexE = $id_mapel . '_' . $nomor . '_E.' . $ext;
                $upload = move_uploaded_file($temp, '../../' . $fileE);
                $que = mysqli_query($koneksi, "insert into file_pendukung (nama_file,id_mapel)values('$filexE','$id_mapel')");
                (!$upload) ? $fileE = $soal['fileE'] : null;
            }
        } else {
            $filexE = $soal['fileE'];
        }

       $jawabani = implode($_POST['jwb'], ', ');
        if ($jumsoal == 0) {
            $exec = mysqli_query($koneksi, "INSERT INTO soal (id_mapel,nomor,soal,jenis,pilA,pilB,pilC,pilD,pilE,jawaban,file,file1,fileA,fileB,fileC,fileD,fileE,ket) VALUES ('$id_mapel','$nomor','$isi_soal','5','$pilA','$pilB','$pilC','$pilD','$pilE','$jawabani','$urlx','$filex1','$filexA','$filexB','$filexC','$filexD','$filexE','Urutkan Jawaban Dengan Benar')");
        } else {
            $exec = mysqli_query($koneksi, "UPDATE soal SET soal='$isi_soal',pilA='$pilA',pilB='$pilB',pilC='$pilC',pilD='$pilD',pilE='$pilE',jawaban='$jawabani',file='$urlx',file1='$filex1',fileA='$filexA',fileB='$filexB',fileC='$filexC',fileD='$filexD',fileE='$filexE' WHERE id_mapel='$id_mapel' AND nomor='$nomor' AND jenis='5'");
       
	   }
    }
if ($pg == 'ambil_kelas') {
    $id_level = $_POST['level'];
    $sql = mysqli_query($koneksi, "SELECT * FROM kelas WHERE level='" . $id_level . "'");
    echo "<option value='semua'>Semua Kelas</option>";
    while ($data = mysqli_fetch_array($sql)) {
        echo "<option value='$data[id_kelas]'>$data[id_kelas]</option>";
    }
}
if ($pg == 'kosongsoal') {
    $id = $_POST['id'];
    $exec = delete($koneksi, 'soal', ['id_mapel' => $id]);
    echo $exec;
}
