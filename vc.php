
                    <?php

                        $action = dekripsi($ac);

                        if ($action) {

                            $exce = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM meet WHERE room = '". $action ."'"));
                        
                            if ($exce > 0) {
                                    
                                echo '<div id="meeting" style="background-color: #757575; border: none; position: absolute; z-index: 2000; top: 0; width: 100%; left: 0; right: 0; bottom: 0; height: 100%;"></div>';
                                echo '<a href="meeting" style="background: white; position: absolute; z-index: 2001; left: 0; top: 0; color:#757575; padding: 10px 13px; border-radius: 0 0 50% 0;"><i class="fas fa-times"></i></a>';
                                echo '<script src="https://meet.jit.si/external_api.js"></script>';
                                echo '<script>
                                    const options = {
                                        roomName: \''. $action .'\',
                                        parentNode: document.querySelector(\'#meeting\')
                                    };
                                    const api = new JitsiMeetExternalAPI(\'meet.jit.si\', options);
                                </script>';
                        
                            } else {
                        
                                echo "<script>window.location = 'meeting'</script>";
                                exit();
                            
                            }
                        
                        }

                        $rooms = mysqli_fetch_all(mysqli_query($koneksi, "SELECT * FROM meet LEFT JOIN pengawas ON meet.id_guru = pengawas.id_pengawas WHERE meet.id_kelas='". $_SESSION['id_kelas'] ."' AND meet.status=true"), MYSQLI_ASSOC);
                    ?>
                    <div class='row'>
                        <div class='col-md-12'>
                            <div class='box box-solid'>
                                <div class='box-header with-border'>
                                    <h3 class='box-title'><i class="fas fa-video"></i> Tatap Muka</h3>
                                </div><!-- /.box-header -->
                                <div class='box-body'>
                                    <div class="alert alert-warning" role="alert">Pastikan anda memiliki koneksi yang memadai atau stabil.</div>
                                    <div class="row">
                                        <?php foreach ($rooms as $key => $value) { ?>
                                        <div class="col-sm-6 col-md-4">
                                            <div class="thumbnail">
                                                <div class="caption bg-info">
                                                    <h3><?= substr($value['judul'], 0, 18) ?></h3>
                                                    <p>
                                                        <span class="badge bg-red"><?= strtoupper($value['nama']) ?></span>
                                                        <span class="badge bg-yellow"><?= strtoupper($value['id_kelas']) ?></span>
                                                        <span class="badge bg-green"><?= strtoupper($value['id_mapel']) ?></span>
                                                    </p>
                                                    <p>
                                                        <?= $value['deskripsi'] ?>
                                                    </p>
                                                    <div class="btn-group btn-group-lg btn-group-justified" role="group" aria-label="Justified button group">
                                                        <a href="meeting/<?= enkripsi($value['room']) ?>" class="btn btn-block btn-lg btn-info" role="button"><i class="fas fa-video" ></i> &nbsp;Masuk sekarang</a> 
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>