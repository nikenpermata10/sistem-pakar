<?php
include 'functions.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<link rel="icon" href="favicon.ico" />

	<title>SP</title>
	<link href="assets/css/bootstrap.min.css" rel="stylesheet" />
	<link href="assets/css/style.css" rel="stylesheet" />
	<link href="assets/css/general.css" rel="stylesheet" />
	<script src="assets/js/jquery.min.js"></script>
	<!-- <script src="assets/js/jquery-3.7.1.min.js"></script> -->
	<script src="assets/js/bootstrap.min.js"></script>
	<script src="assets/js/bootstrap.min.js"></script>
	<script src="assets/js/dist/sweetalert2.all.min.js"></script>

	<style>
		body {
			background-image: url('Assets/img/bg.jfif');
			background-size: cover;
			background-repeat: no-repeat;
			background-position: center;
			margin: 0;
			padding: 0;
		}
	</style>
</head>

<body class="">
	<nav class="navbar navbar-default">
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
					<span class="sr-only">Toggle navigation</span>
				</button>
				<strong><a class="navbar-brand" href="?">SISTEM PAKAR</a></strong>
			</div>
			<div id="navbar" class="navbar-collapse collapse">
				<ul class="nav navbar-nav">
					<li><a href="?m=informasi">Informasi</a></li>
					<li><a href="?m=konsultasi">Diagnosa</a></li>
					<li><a href="?m=login"></span> Login</a></li>
				</ul>
			</div>
		</div>
	</nav>
	<blockquote class="blockquote-reverse">

	</blockquote>
	<div class="container">
		<?php
		if (file_exists($mod . '.php')) {
			if (_session('login') || $mod == 'login' || $mod == 'informasi' || $mod == 'konsultasi') {
				include $mod . '.php';
			} else {
				redirect_js('index.php?m=login');
			}
		} else {
			include 'home.php';
		}
		?>
	</div>

	<script type="text/javascript">
		$('.form-control').attr('autocomplete', 'off');
	</script>
	<script>
		$('.dele').on('click', function(e) {
			e.preventDefault();
			const href = $(this).attr('href')

			Swal.fire({
					title: 'Apakah Kamu Yakin?',
					text: 'Data dihapus',
					type: 'warning',
					showCancelButton: true,
					confirmButtonColor: '#3085d6',
					cancelButtonColor: '#d33',
					confirmButtonText: 'Hapus Data',
				})
				.then((result) => {
					if (result.value) {
						document.location.href = href;
					}
				})
		})
		const flashData = $('.flash-data').data('flashdata');
		// jquery carikan elemen yang namanya flash-data dan ambil datanya yg namanya flashdata
		// console.log(flashData);

		if (flashData) {
			Swal.fire({
				title: 'flashData',
				icon: 'success'
			})
		}

		const ganti = document.getElementById('warna');
		ganti.onclick = function(e) {
			e.preventDefault();
			const r = Math.round(Math.random() * 255 + 1);
			const g = Math.round(Math.random() * 255 + 1);
			const b = Math.round(Math.random() * 255 + 1);
			document.body.style.backgroundColor = 'rgb(' + r + ',' + g + ',' + b + ')';
		}
	</script>
</body>
<!-- <style>
	body {
		background-color: #bf00ff;
	} -->
</style>

</html>