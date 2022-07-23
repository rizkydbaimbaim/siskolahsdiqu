<?php
require("../config/config.default.php");
require("../config/config.candy.php");
require("../config/config.function.php");
require("../config/functions.crud.php");
require("../config/excel_reader2.php");
(isset($_SESSION['id_pengawas'])) ? $id_pengawas = $_SESSION['id_pengawas'] : $id_pengawas = 0;
($id_pengawas == 0) ? header('location:login.php') : null;
$pengawas = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM pengawas  WHERE id_pengawas='$id_pengawas'"));
(isset($_GET['pg'])) ? $pg = $_GET['pg'] : $pg = '';
(isset($_GET['ac'])) ? $ac = $_GET['ac'] : $ac = '';

if ($pg == 'banksoal' && $ac == 'input') :
	$sidebar = 'sidebar-collapse';
elseif ($pg == 'nilai' && $ac == 'lihat') :
	$sidebar = 'sidebar-collapse';
elseif ($pg == 'semuanilai' && $ac == 'lihat') :
	$sidebar = 'sidebar-collapse';
elseif ($pg == 'jadwal') :
	$sidebar = 'sidebar-collapse';
else :
	$sidebar = '';
endif;


?>
<!DOCTYPE html>
<html>

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta http-equiv='X-UA-Compatible' content='IE=edge'>
	<title>Admin | <?= $setting['aplikasi'] ?></title>
	<meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
	<link rel='shortcut icon' href='<?= $homeurl ?>/logo19.png' />
	<link rel='stylesheet' href='<?= $homeurl ?>/dist/bootstrap/css/bootstrap.min.css' />
	<link rel='stylesheet' href='<?= $homeurl ?>/plugins/fontawesome/css/all.css' />
	<link rel='stylesheet' href='<?= $homeurl ?>/plugins/select2/select2.min.css' />
	<link rel='stylesheet' href='<?= $homeurl ?>/dist/css/AdminLTE.css' />
	<link rel='stylesheet' href='<?= $homeurl ?>/dist/css/skins/skin-green.min.css' />
	<link rel='stylesheet' href='<?= $homeurl ?>/plugins/jQueryUI/jquery-ui.css'>
	<link rel='stylesheet' href='<?= $homeurl ?>/plugins/iCheck/square/green.css' />
	<link rel='stylesheet' href='<?= $homeurl ?>/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css'>
	<link rel='stylesheet' href='<?= $homeurl ?>/plugins/datatables/dataTables.bootstrap.css' />
	<link rel='stylesheet' href='<?= $homeurl ?>/plugins/datatables/extensions/Responsive/css/dataTables.responsive.css' />
	<link rel='stylesheet' href='<?= $homeurl ?>/plugins/datatables/extensions/Select/css/select.bootstrap.css' />
	<link rel='stylesheet' href='<?= $homeurl ?>/plugins/animate/animate.min.css'>
	<link rel='stylesheet' href='<?= $homeurl ?>/plugins/datetimepicker/jquery.datetimepicker.css' />
	<link rel='stylesheet' href='<?= $homeurl ?>/plugins/notify/css/notify-flat.css' />
	<link rel='stylesheet' href='<?= $homeurl ?>/plugins/sweetalert2/dist/sweetalert2.min.css'>
	<link rel='stylesheet' href='<?= $homeurl ?>/plugins/toastr/toastr.min.css'>
	<link rel='stylesheet' href='<?= $homeurl ?>/plugins/izitoast/css/iziToast.min.css'>
	<link rel='stylesheet' href='<?= $homeurl ?>/dist/css/costum.css' />
	<script src='<?= $homeurl ?>/plugins/tinymce/tinymce.min.js'></script>
	<script src='<?= $homeurl ?>/plugins/jQuery/jquery-3.1.1.min.js'></script>
	<script src='<?= $homeurl ?>/plugins/datatables/jquery.dataTables.min.js'></script>
	<script src='<?= $homeurl ?>/plugins/datatables/dataTables.bootstrap.min.js'></script>
	<script src='<?= $homeurl ?>/plugins/datatables/extensions/Select/js/dataTables.select.min.js'></script>
	<script src='<?= $homeurl ?>/plugins/datatables/extensions/Select/js/select.bootstrap.min.js'></script>
	<script type="text/javascript" src='<?= $homeurl ?>/chartjs/Chart.js'></script>

</head>

<div class="modal fade" id="modalversidb" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Kesalahan Versi Database</h5>
			</div>
			<div class="modal-body">
				Mohon maaf versi database anda tidak sesuai dengan database versi ini
				mohon gunakan versi terbaru !!
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary" data-dismiss="modal">Oke Mengerti</button>

			</div>
		</div>
	</div>
</div>

<body class='hold-transition skin-green-light fixed<?= $sidebar ?>'>
	<div id='pesan'></div>
	<div class='loader'></div>
	<div class='wrapper'>
		<header class='main-header'>
			<a href='?' class='logo' style='background-color:#000'>
				<span class='animated bounce logo-mini'>
					<img src="<?= $homeurl . '/' . $setting['logo'] ?>" height="30px">
				</span>
				<span class='animated bounce logo-lg' style="color: white;">
					<img src="<?= $homeurl . '/' . $setting['logo'] ?>" height="40px"> <?= $setting['sekolah'] ?>
				</span>
			</a>
			<nav class='navbar navbar-static-top' style='background-color:#000;box-shadow: 0px 10px 10px 0px rgba(0,0,0,0.1)' role='navigation'>
				<a style="color:#fff" href='#' class='sidebar-baru' data-toggle='offcanvas' role='button'>
					<i class="fa fa-bars fa-lg fa-fw"></i>
				</a>
				<div class='navbar-custom-menu'>
					<ul class='nav navbar-nav'>
						<?php if ($pengawas['level'] == 'admin') : ?>
							<li class='dropdown notifications-menu'>
								
								<ul class="dropdown-menu" style="height:80px">
									<li class="header">Ganti Status Server</li>
									<li>
										<!-- inner menu: contains the actual data -->
										<ul class="menu">
											<?php if ($setting['server'] == 'lokal') { ?>
												<li>
													<a id="btnserver" href="#">
														<i class="fa fa-users text-aqua"></i> Server Pusat
													</a>
												</li>
											<?php } else { ?>
												<li>
													<a id="btnserver" href="#">
														<i class="fa fa-users text-aqua"></i> Server Lokal
													</a>
												</li>
											<?php } ?>
										</ul>
									</li>

								</ul>
							</li>
						<?php endif; ?>
					
						<li class='dropdown user user-menu'>
							<a href='#' class='dropdown-toggle' data-toggle='dropdown'>
							
									<?php if ($pengawas['foto'] <> '') {
											echo "<img src='$homeurl/berkas/$pengawas[foto]' class='user-image' alt='+'>";
										} else {
											echo "<img src='$homeurl/dist/img/avatar-6.png' class='user-image' alt='+'>";
										}
										?>
								<span style="color:#fff" class='hidden-xs'><?= $pengawas['nama'] ?> &nbsp; <i class='fa fa-caret-down'></i></span>
							</a>
							<ul class='dropdown-menu'>
								<li class='user-header' style="background-color: black;">
									<?php
									if ($pengawas['level'] == 'admin') :
										if ($pengawas['foto'] <> '') {
											echo "<img src='$homeurl/berkas/$pengawas[foto]' class='img-circle' alt='User Image'>";
										} else {
											echo "<img src='$homeurl/dist/img/avatar-6.png' class='img-circle' alt='User Image'>";
										}
									elseif ($pengawas['level'] == 'guru') :
										if ($pengawas['foto'] <> '') {
											echo "<img src='$homeurl/berkas/$pengawas[foto]' class='img-circle' alt='User Image'>";
										} else {
											echo "<img src='$homeurl/dist/img/avatar-6.png' class='img-circle' alt='User Image'>";
										}
									endif
									?>
									<p>
										<?= $pengawas['nama'] ?>
										<small>NIP. <?= $pengawas['nip'] ?></small>
									</p>
								</li>
								<li class='user-footer'>
									<div class='pull-left'>
										<?php
										if ($pengawas['level'] == 'admin') :
											echo "<a href='?pg=pengaturan' class='btn btn-sm btn-default btn-flat'><i class='fa fa-gear'></i> Pengaturan</a>";
										elseif ($pengawas['level'] == 'guru') :
											echo "<a href='?pg=editguru' class='btn btn-sm btn-default btn-flat'><i class='fa fa-gear'></i> Edit Profil</a>";
										endif
										?>
									</div>
									<div class='pull-right'>
									        <a href="?pg=gantiphoto&id=<?= $_SESSION['id_pengawas'] ?>" class='btn btn-sm btn-info btn-flat'><i class='fa fa-camera'></i> Ubah Photo</a>
										<a href='logout.php' class='btn btn-sm btn-default btn-flat'><i class='fa fa-sign-out'></i> Keluar</a>
									</div>
								</li>
							</ul>
						</li>

					</ul>
				</div>
			</nav>
		</header>

		<aside class='main-sidebar' style="background-color: #000000">
			<!-- <div class="user-panel" style="text-align:center">
				<span>APLIKASI UJIAN</span><br>
				<span>BERBASIS KOMPUTER</span>
			</div> -->
			<div class="menu-header">
				<ul>
					<li>
						<a style="color:#fff" href="." class="btn-logout">
							<span class="fa fa-home fa-2x"></span><br>Dashboard
						</a>
					</li>
					<li>
						<a style="color:#fff" class="btn-logout" href="?pg=pengaturan">
							<span class="fa fa-user-cog fa-2x"></span><br>Pengaturan
						</a>
					</li>
					<li>
						<a style="color:#fff" href="logout.php" class="btn-logout"> <span class="fa fa-sign-out-alt fa-2x"></span><br>Keluar</a>
					</li>
				</ul>
			</div>
			<section class='sidebar'>
				<hr style="margin:0px">
				<hr style="margin:0px">
				<ul class=' sidebar-menu tree data-widget=' tree>
					<li style="color:#fff" class="header">MENU E - RAPOR</li>
					<?php if ($pengawas['level'] == 'admin') : ?>
						 <li class='treeview'><a style="color:#fff" href='index.php'><i style="color:#fff" class="fas fa-home side-menu-icon fa-fw"></i> <span> Home</span></a></li>
							  <li class='treeview'><a style="color:#fff" href='?pg=setting_semester'><i style="color:#fff" class="fas fa-tools side-menu-icon fa-fw"></i><span> Pengaturan Rapor</span></a></li>
					
						<?php if($setting['menu_rapor']==1){ ?>
						
						<li class=' treeview'>
								<a style="color:#ffff" href='#'>
									<i style="color:#ffff" class="fas  fa-fw fa-toolbox side-menu-icon   "></i>
									<span>Master Rapor</span>
									<span class='pull-right-container'>
										<i class='fa fa-angle-down pull-right'></i>
									</span>
								</a>
								<ul class='treeview-menu'>
									<li><a style="color:#fff" href='?pg=mapelr'><i class='fas fa-angle-double-right fa-fw'></i> <span> Mata Pelajaran</span></a></li>
							         <li><a style="color:#fff" href='?pg=eskul'><i class='fas fa-angle-double-right fa-fw'></i> <span> Ekstrakurikuler</span></a></li>
							        
							</ul>
						</li>
						<li class='treeview'><a style="color:#fff" href='?pg=raporadmin'><i style="color:#fff" class="fas fa-print side-menu-icon fa-fw"></i><span> Cetak Rapor</span></a></li>
					
						<?php } ?>
											<?php endif ?>
					
					
					<?php
					if ($setting['jenjang'] == 'SMK') {
						$jenjang = 'SMK/SMA';
					} elseif ($setting['jenjang'] == 'SMP') {
						$jenjang = 'SMP';
					} else {
						$jenjang = 'SD';
					}
					?>
				</ul>
			</section>
		</aside>

		<div class='content-wrapper' style="background: #ecf0f5;">
			<section class='content-header' style="color: black;">
				<h1>
					&nbsp;<span class='hidden-xs'><?= $setting['aplikasi']  ?></span>
				</h1>
				<div style='float:right; margin-top:-37px'>
					<button class='btn  btn-flat  bg-purple'><i class='fa fa-calendar'></i> <?= buat_tanggal('D, d M Y') ?></button>
					<button class='btn  btn-flat  bg-maroon'><span id='waktu'><?= $waktu ?></span></button>
				</div>
				<div class='breadcrumb'></div>
			</section>
			<section class='content'>
				<?php include "content.php"; ?>
			</section><!-- /.content -->
		</div><!-- /.content-wrapper -->
		<footer class='main-footer hidden-xs'>
			<div class='container'>
				<div class='pull-left hidden-xs'>
					<strong>
						<span id='end-sidebar'>
							
						</span>
					</strong>
				</div>
             <a href="#" ><?= $setting['sekolah'] ?></a>
		</footer>
	</div><!-- ./wrapper -->

	<!-- REQUIRED JS SCRIPTS -->
	<script src='<?= $homeurl ?>/dist/bootstrap/js/bootstrap.min.js'></script>
	<script src='<?= $homeurl ?>/plugins/fastclick/fastclick.js'></script>
	<script src='<?= $homeurl ?>/dist/js/adminlte.min.js'></script>
	<script src='<?= $homeurl ?>/dist/js/app.min.js'></script>
	<script src='<?= $homeurl ?>/plugins/datetimepicker/build/jquery.datetimepicker.full.min.js'></script>
	<script src='<?= $homeurl ?>/plugins/slimScroll/jquery.slimscroll.min.js'></script>
	<script src='<?= $homeurl ?>/plugins/iCheck/icheck.min.js'></script>
	<script src='<?= $homeurl ?>/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js'></script>
	<script src='<?= $homeurl ?>/plugins/select2/select2.min.js'></script>
	<script src='<?= $homeurl ?>/plugins/tableedit/jquery.tabledit.js'></script>
	<script src='<?= $homeurl ?>/plugins/toastr/toastr.min.js'></script>
	<script src='<?= $homeurl ?>/plugins/izitoast/js/iziToast.min.js'></script>
	<script src='<?= $homeurl ?>/plugins/notify/js/notify.js'></script>
	<script src='<?= $homeurl ?>/plugins/chartjs/dist/Chart.js'></script>
	<script src='<?= $homeurl ?>/plugins/sweetalert2/dist/sweetalert2.min.js'></script>
	<script src='<?= $homeurl ?>/plugins/MathJax-2.7.3/MathJax.js?config=TeX-AMS_HTML-full'></script>
	<?php if ($setting['db_versi'] <> VERSI_DB) { ?>
		<script>
			$('#modalversidb').modal('show');
		</script>
	<?php } ?>
	<script>
		$('.loader').fadeOut('slow');
		$(function() {
			$('#textarea').wysihtml5()
		});
		var autoRefresh = setInterval(
			function() {
				$('#waktu').load('_load.php?pg=waktu');
				$('#log-list').load('_load.php?pg=log');
				$('#pengumuman').load('_load.php?pg=pengumuman');
			}, 1000
		);

		<?php if ($pg == 'statussiswa') { ?>
			var autoRefresh = setInterval(
				function() {
					$('#divstatussiswa').load("mod_status/statussiswa.php?id=76310EEFF2B5D3C887F238976A421B638CFEB0942AB8249CD0A29B125C91B3E5");
				}, 5000
			);
		<?php } ?>
		var autoRefresh = setInterval(
			function() {
				$('#isi_token').load('_load.php?pg=token');
			}, 900000
		);
		$('.datepicker').datetimepicker({
			timepicker: false,
			format: 'Y-m-d'
		});
		$('.tgl').datetimepicker();
		$('.timer').datetimepicker({
			datepicker: false,
			format: 'H:i'
		});
		$(function() {
			$('#jenis').change(function() {
				if ($('#jenis').val() == '2') {
					$('#jawabanpg').hide();
					$('input:radio[name=jawaban]').attr('disabled', true);
				} else {
					$('#jawabanpg').show();
					$('input:radio[name=jawaban]').attr('disabled', false);
				}
			});
		});

		function printkartu(idkelas, judul) {
			$('#loadframe').attr('src', 'mod_kartu/print_kartu.php?id_kelas=' + idkelas);
		}

		function iCheckform() {
			$('input[type=checkbox].flat-check, input[type=radio].flat-check').iCheck({
				checkboxClass: 'icheckbox_square-green',
				radioClass: 'iradio_square-green',
				increaseArea: '20%' // optional
			});
		}

		$(document).ready(function() {
			$("#btnserver").click(function() {

				swal({
					title: 'Ganti Status Server ',
					text: 'Apakah kamu yakin akan mengganti status server ini ??',
					type: 'warning',
					showCancelButton: true,
					confirmButtonColor: '#3085d6',
					cancelButtonColor: '#d33',
					confirmButtonText: 'Ya, Ganti'
				}).then((result) => {
					if (result.value) {
						$.ajax({
							url: 'gantiserver.php',
							type: "POST",
							success: function(respon) {
								location.reload();
							}
						})
					}
				});
				return false;
			})
			$('#example1').DataTable({
				select: true
			});
			$('#soalpg').keyup(function() {
				$('#tampilpg').val(this.value);
			});
			$('#soalesai').keyup(function() {
				$('#tampilesai').val(this.value);
			});

			$('#ceksemua').change(function() {
				$(this).parents('#tablereset:eq(0)').
				find(':checkbox').attr('checked', this.checked);
			});

			$('.idkel').change(function() {
				var thisval = $(this).val();
				var txt_id = $(this).attr('id').replace('me', 'txt');
				var idm = $('#' + txt_id).val();
				var idu = $('#iduj').val();
				console.log(thisval + idm);
				$('.linknilai').attr('href', '?pg=nilai&ac=lihat&idu=' + idu + '&idm=' + idm + '&idk=' + thisval);
			});
			$('.alert-dismissible').fadeTo(2000, 500).slideUp(500, function() {
				$('.alert-dismissible').alert('close');
			});
			$('.select2').select2();

			$('input:checkbox[name=masuksemua]').click(function() {
				if ($(this).is(':checked'))
					$('input:radio.absensi').attr('checked', 'checked');
				else
					$('input:radio.absensi').removeAttr('checked');
			});
			iCheckform()


		});
	</script>
	<script>
		function kirim_form() {
			var homeurl;
			homeurl = '<?= $homeurl ?>';
			var jawab = $('#headerkartu').val();
			$.ajax({
				type: 'POST',
				url: 'simpanheader.php',
				data: 'jawab=' + jawab,
				success: function(response) {
					location.reload();
				}
			});
		}
	</script>

	<script type="text/javascript">
		var url = window.location;
		// for sidebar menu entirely but not cover treeview
		$('ul.sidebar-menu a').filter(function() {
			return this.href == url;
		}).parent().addClass('active');

		// for treeview
		$('ul.treeview-menu a').filter(function() {
			return this.href == url;
		}).closest('.treeview').addClass('active');
	</script>

	<script>
		$(function() {
			$("#btnresetlogin").click(function() {
				id_array = new Array();
				i = 0;
				$("input.cekpilih:checked").each(function() {
					id_array[i] = $(this).val();
					i++;
				});
				$.ajax({
					url: "resetlogin.php",
					data: "kode=" + id_array,
					type: "POST",
					success: function(respon) {
						if (respon == 1) {
							$("input.cekpilih:checked").each(function() {
								$(this).parent().parent().remove('.cekpilih').animate({
									opacity: "hide"
								}, "slow");
							})
						}
					}
				});
				return false;
			})
		});
	</script>

	<script>
		//Hapus data jawaban
		$(function() {
			$("#btnhapusjawaban").click(function() {
				swal({
					title: 'Hapus Jawaban',
					text: 'Pastikan tidak ada yang sedang ujian yak ??',
					type: 'warning',
					showCancelButton: true,
					confirmButtonColor: '#3085d6',
					cancelButtonColor: '#d33',
					confirmButtonText: 'Ya, Hapus!'
				}).then((result) => {
					if (result.value) {
						$.ajax({
							url: 'hapusjawaban.php',
							type: "POST",
							beforeSend: function() {
								$('.loader').css('display', 'block');
							},
							success: function(respon) {
								iziToast.success({
									title: 'Mantap!',
									message: respon,
									position: 'topRight'
								});
								setTimeout(function() {
									window.location.reload();
								}, 2000);
							}
						})
					}
				});
				return false;
			})
		});
		$(function() {
			$("#buatberita").click(function() {
				swal({
					title: 'Generate Berita Acara',
					text: 'Pastikan pembuatan jadwal sudah fix ??',
					type: 'warning',
					showCancelButton: true,
					confirmButtonColor: '#3085d6',
					cancelButtonColor: '#d33',
					confirmButtonText: 'Ya, Buat!'
				}).then((result) => {
					if (result.value) {
						$.ajax({
							url: 'buatberita.php',
							type: "POST",
							beforeSend: function() {
								$('.loader').css('display', 'block');
							},
							success: function(respon) {
								$('.loader').css('display', 'none');
								location.reload();
							}
						})
					}
				});
				return false;
			})
		});

		$(document).ready(function() {
			var messages = $('#pesan').notify({
				type: 'messages',
				removeIcon: '<i class="icon icon-remove"></i>'
			});
			$('#formreset').submit(function(e) {
				e.preventDefault();
				$.ajax({
					type: 'POST',
					url: $(this).attr('action'),
					data: $(this).serialize(),
					success: function(data) {
						if (data == "ok") {
							messages.show("Reset Login Peserta Berhasil", {
								type: 'success',
								title: 'Berhasil',
								icon: '<i class="icon icon-check-sign"></i>'
							});
						}
						if (data == "pilihdulu") {
							swal({
								position: 'top-end',
								type: 'success',
								title: 'Data Berhasil disimpan',
								showConfirmButton: true
							});
						}
					}
				});
				return false;
			});

		});
	</script>


	<script>
		<?php if ($pg == 'jenisujian') : ?>
			$(document).ready(function() {
				$('#tablejenis').Tabledit({
					url: 'mod_master/ajax_master.php?pg=jenisujian',
					restoreButton: false,
					columns: {
						identifier: [1, 'id'],
						editable: [
							[2, 'namajenis'],
							[3, 'status', '{"aktif": "aktif", "tidak": "tidak"}']
						]
					}
				});
			});
		<?php endif; ?>
		<?php if ($pg == 'pk') : ?>
			$(document).ready(function() {
				$('#tablejurusan').Tabledit({
					url: 'mod_master/ajax_master.php?pg=jurusan',
					restoreButton: false,
					columns: {
						identifier: [1, 'id'],
						editable: [
							[2, 'namajurusan']
						]
					}
				});
			});
		<?php endif; ?>
		<?php if ($pg == 'level') : ?>
			$(document).ready(function() {
				$('#tablelevel').Tabledit({
					url: 'mod_master/ajax_master.php?pg=level',
					restoreButton: false,
					columns: {
						identifier: [1, 'id'],
						editable: [
							[2, 'namalevel']
						]
					}
				});
			});
		<?php endif; ?>
		<?php if ($pg == 'kelas') : ?>
			$(document).ready(function() {
				$('#tablekelas').Tabledit({
					url: 'mod_master/ajax_master.php?pg=kelas',
					restoreButton: false,
					columns: {
						identifier: [1, 'id'],
						editable: [
							[2, 'level'],
							[3, 'namakelas']
						]
					}
				});
			});
		<?php endif; ?>
		<?php if ($pg == 'matapelajaran') : ?>
			$(document).ready(function() {
				$('#tablemapel').Tabledit({
					url: 'mod_master/ajax_master.php?pg=mapel',
					restoreButton: false,
					columns: {
						identifier: [1, 'id'],
						editable: [
							[2, 'namamapel']
						]
					}
				});
			});
		<?php endif; ?>
		<?php if ($pg == 'ruang') : ?>
			$(document).ready(function() {
				$('#tableruang').Tabledit({
					url: 'mod_master/ajax_master.php?pg=ruang',
					restoreButton: false,
					columns: {
						identifier: [1, 'id'],
						editable: [
							[2, 'namaruang']
						]
					}
				});
			});
		<?php endif; ?>
		<?php if ($pg == 'sesi') : ?>
			$(document).ready(function() {
				$('#tablesesi').Tabledit({
					url: 'mod_master/ajax_master.php?pg=sesi',
					restoreButton: false,
					columns: {
						identifier: [1, 'id'],
						editable: [
							[2, 'namasesi']
						]
					}
				});
			});
		<?php endif; ?>
	</script>

	<!-- <script>
		$(function() {
			var ctx = $("#chart-sek2");
			var ctx2 = $("#chart-sek");
			var myDoughnutChart = new Chart(ctx, {
				type: 'doughnut',
				data: {
					datasets: [{
						data: [<?= $online ?>],
						backgroundColor: [
							'#0abb87'

						],
					}],

					// These labels appear in the legend and in the tooltips when hovering different arcs
					labels: [
						'Data Jawaban',

					]
				},

			});

			var myBarChart = new Chart(ctx2, {
				type: 'bar',
				data: {
					labels: ['Siswa', 'Kelas', 'Soal', 'Nilai'],
					datasets: [{
						label: '',
						barPercentage: 0.5,
						minBarLength: 2,
						data: [<?= $siswa ?>, <?= $kelas ?>, <?= $soal ?>, <?= $nilai ?>],
						backgroundColor: [
							'#f33d3d', '#f145ac', '#6c6afb', '#575f96'

						],

					}],


				},
				options: {
					scales: {
						yAxes: [{
							ticks: {
								beginAtZero: true
							}
						}]
					}
				}
			});


		})
	</script> -->
</body>

</html>