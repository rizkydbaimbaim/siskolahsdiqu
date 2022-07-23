<?php
require("../config/config.default.php");
require("../config/config.function.php");
require("../config/config.candy.php");

$namaaplikasi = $setting['aplikasi'];
$namasekolah = $setting['sekolah'];

if (isset($_POST['submit'])) {
	$username = mysqli_escape_string($koneksi, $_POST['username']);
	$password = mysqli_escape_string($koneksi, $_POST['password']);
	$query = mysqli_query($koneksi, "SELECT * FROM pengawas WHERE username='$username'");
	$cek = mysqli_num_rows($query);
	$user = mysqli_fetch_array($query);
	if ($cek <> 0) {

		if ($user['level'] == 'admin') {

			if (!password_verify($password, $user['password'])) {
				$info = info("Password salah!", "NO");
			} else {
				$_SESSION['id_pengawas'] = $user['id_pengawas'];
				$_SESSION['level'] = 'admin';
				echo "<script>location.href = '.';</script>";
			}
		} elseif ($user['level'] == 'guru') {

			if ($password == $user['password']) {
				$_SESSION['id_pengawas'] = $user['id_pengawas'];
				$_SESSION['level'] = 'guru';
				echo "<script>location.href = '.';</script>";
			} else {
				$info = info("Password salah!", "NO");
			}
			} elseif ($user['level'] == 'kepala') {

			if ($password == $user['password']) {
				$_SESSION['id_pengawas'] = $user['id_pengawas'];
				$_SESSION['level'] = 'kepala';
				echo "<script>location.href = '.';</script>";
			} else {
				$info = info("Password salah!", "NO");
			}
		} elseif ($user['level'] == 'pengawas') {
			if (!password_verify($password, $user['password'])) {
				$info = info("Password salah!", "NO");
			} else {
				$_SESSION['id_pengawas'] = $user['id_pengawas'];
				$_SESSION['level'] = 'pengawas';
				echo "<script>location.href = '.';</script>";
			}
		}
	} elseif ($cek == 0) {
		echo "<script>alert('Pengguna tidak terdaftar');</script>";
	}
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<title>Login Admin </title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" type="image/png" href="../logo19.png" />
	<link rel="stylesheet" type="text/css" href="../dist/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../plugins/font-awesome/css/font-awesome.css">
	<link rel="stylesheet" type="text/css" href="../plugins/animate/animate.min.css">
	<link rel="stylesheet" type="text/css" href="../dist/bootstrap/css/util.css">
	<link rel="stylesheet" type="text/css" href="../dist/bootstrap/css/main.css">
	<link rel='stylesheet' href='<?= $homeurl ?>/plugins/izitoast/css/iziToast.min.css'>
	<style>
		.judul {
			position: absolute;
			right: 20px;
			top: 20px;
			z-index: 2;
			color: #000;
		}

		.logo {
			position: absolute;
			left: 20px;
			top: 20px;
			z-index: 2;
			color: #000;
			-webkit-filter: drop-shadow(5px 5px 5px #222);
			filter: drop-shadow(5px 5px 5px #222);
		}

		.candy {
			position: absolute;
			left: 10px;
			top: 90%;
			z-index: 3;
			color: #000;
			-webkit-filter: drop-shadow(5px 5px 5px #222);
			filter: drop-shadow(5px 5px 5px #222);
			opacity: 0.4;
			filter: alpha(opacity=40);
		}

		.candy:hover {
			opacity: 1.0;
			filter: alpha(opacity=100);
		}

		.wrap-login100-form-btn {
			display: block;
			position: relative;
			z-index: 1;
			border-radius: 0px;
			overflow: hidden;
		}
	</style>
</head>

<body style="background: url('../<?= $setting['bc'] ?>');background-size:cover;background-position: center;background-repeat: no-repeat;">

	<div class="limiter">
		<div class="container-login100">
			<div class='judul'>&copy; <a href="#" class="txt2 hov1">
					<b><?php echo $setting['aplikasi'] ?></b>
				</a>
			</div>
			<div class='logo hidden-xs'><img class='img img-responsive' style='max-width:200px;' src="<?php echo "$homeurl/$setting[logo]"; ?>" width='150'></div>
			<div class='candy hidden-xs'>
				<svg x="0px" y="0px" viewBox="0 0 256 256" width="50px">
					
				</svg>
			</div>
			<div class="login100-more" style="background-image: url('');"></div>

			<div class="wrap-login100 p-l-50 p-r-50 p-t-72 p-b-50" style="background-image: url('../dist/img/logo19.png');">
				<form id="form-login" class="validate-form">
					<span class="animated flipInX login100-form-title">
						<?php echo	$namaaplikasi; ?>
					</span>
					<small class="animated flipInX p-b-50">
						<?php echo	"$setting[kecamatan] - $setting[kota] - $setting[web]"; ?>
					</small>

					<div class="wrap-input100 validate-input p-t-50" data-validate="Username is required">
						<span class="label-input100">Username</span>
						<input class="input100" type="text" name="username" placeholder="Username...">
						<span class="focus-input100"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate="Password is required">
						<span class="label-input100">Password</span>
						<input class="input100" type="password" name="password" placeholder="*************">
						<span class="focus-input100"></span>
					</div>

					<div class="container-login100-form-btn">
						<div class="wrap-login100-form-btn">
							<div class="login100-form-bgbtn"></div>
							<button name='submit' type="submit" class="login100-form-btn">
								Login Masuk
							</button>
						</div>


					</div>
				</form>

			</div>

		</div>
	</div>

	<script src='../plugins/jQuery/jquery-3.2.1.min.js'></script>
	<script src='../dist/bootstrap/js/bootstrap.min.js'></script>

	<script src="../plugins/jQuery/main.js"></script>
	<script src='<?= $homeurl ?>/plugins/izitoast/js/iziToast.min.js'></script>
	<script>
		$(document).ready(function() {
			$('#form-login').submit(function(e) {
				var homeurl;
				homeurl = '<?php echo $homeurl; ?>';
				e.preventDefault();
				$.ajax({
					type: 'POST',
					url: 'ceklogin.php',
					data: $(this).serialize(),
					success: function(data) {
						console.log(data);
						if (data == "ok") {
							iziToast.success({
								title: 'Login Berhasil!',
								message: "Anda akan dialihkan",
								position: 'topRight'
							});
							setTimeout(function() {
								location.href = '.';
							}, 2000);
						}
						if (data == "nopass") {
							iziToast.error({
								title: 'Maaf!',
								message: 'password salah',
								position: 'topRight'
							});

						}
						if (data == "td") {
							iziToast.error({
								title: 'Maaf!',
								message: 'akun tidak ada',
								position: 'topRight'
							});
						}

					}
				})
				return false;
			});

		});

		function showpass() {
			var x = document.getElementById("pass");
			if (x.type === "password") {
				x.type = "text";
			} else {
				x.type = "password";
			}
		}
	</script>

</body>

</html>