  <div class='row'>
                        <div class='col-md-12'>
                            
                        </div>
                        <div id="boxtampil" class='col-md-12'>
                            <div id='formjadwalujian' class='box box-solid'>
                                <div class='box-header with-border'>
                                    <h3 class='box-title'><i class="fas fa-calendar-alt    "></i> Data Kandidat</h3>
                                  
                                </div>
								
                                <div class='box-body'>
                                 
  <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
	  <?php 
error_reporting(0);
$sql="SELECT * FROM kandidat ORDER BY nomor";
$query=mysqli_query($koneksi,$sql);

$sqljs="SELECT sum(suara) as jsuara FROM kandidat";
$queryjs=mysqli_query($koneksi,$sqljs);
$rjs=mysqli_fetch_array($queryjs);
if($rjs['jsuara']==0){
{$grade=1;}
}elseif($rjs['jsuara'] >=1){
{$grade=$rjs['jsuara'];}
}


$idpemilih=$_SESSION['id_pengawas'];
$sqlpilih="SELECT * FROM datapemilihan WHERE idpemilih='$idpemilih'";
$querypilih=mysqli_query($koneksi,$sqlpilih);
$ada=mysqli_num_rows($querypilih);


?>
<?php

while($r=mysqli_fetch_array($query)){	
$siswa=fetch($koneksi,'siswa',['id_siswa'=>$r['idsiswa']]);	  
echo '        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">';
echo "<h3>".$r['nomor']."</h3>";

echo "<h2>".round($r['suara']/$grade*100)."%</h2>";
echo $r['suara']." suara<br><b>";
echo $siswa['nama']."</b>";
echo '            </div>
            <div>
             <center> <img src="../berkas/'.$r['gambar'].'" height="100px"/></center>
            </div>';
        if($ada==0){
            echo'<a href="?pg=voters&id='.$r['id'].'" class="small-box-footer"><h5>Klik disini untuk memilih</h5> <i class="fa fa-arrow-circle-up"></i></a>';
		}else{
			echo '<a href="#" class="small-box-footer">Anda sudah memilih <i class="fa fa-check"></i></a>';
		}
        echo '  </div>
        </div>';
}
?>        
      </div>
                                </div>
                            </div>
                        </div>
                    </div>