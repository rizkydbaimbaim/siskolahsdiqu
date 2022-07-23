  <div class='row'>
                        <div class='col-md-12'>
                            <div class='alert alert-danger alert-dismissible'>
                                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
                                <i class='icon fa fa-danger'></i>
                               Hasil Vote Pilihan Ketua OSIS
                                </div>
                        </div>
                        <div id="boxtampil" class='col-md-12'>
                            <div id='formjadwalujian' class='box box-solid'>
                                <div class='box-header with-border'>
                                    <h3 class='box-title'><i class="fas fa-calendar-alt    "></i> Hasil Vote</h3>
                                  
                                </div>
                                <div class='box-body'>
                                 
  <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
	  <?php 

$sql="SELECT * FROM kandidat ORDER BY nomor";
$query=mysqli_query($koneksi,$sql);

$sqljs="SELECT sum(suara) as jsuara FROM kandidat";
$queryjs=mysqli_query($koneksi,$sqljs);
$rjs=mysqli_fetch_array($queryjs);


?>
<?php

while($r=mysqli_fetch_array($query)){		  
echo '        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">';
echo "<h3>".$r['nomor']."</h3>";
echo "<h2>".($r['suara']/$rjs['jsuara']*100)."%</h2>";
echo "<h2>" .$r['suara']." suara</h2><br><b>";
echo $r['nama']."</b>";
echo '            </div>
            <div>
             <center> <img src="../berkas/'.$r['gambar'].'" height="100px"/></center>
            </div>';
       
			echo '<a href="#" class="small-box-footer">Hasil Vote <i class="fa fa-check"></i></a>';
		
        echo '  </div>
        </div>';
}
?>        
      </div>
                                </div>
                            </div>
                        </div>
                    </div>