	<?php 
	session_start();
	include 'koneksi.php';
	?>
	<!DOCTYPE html>
	<html lang="en">

	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>UMKM Ciledug Prima || Transaksi</title>
		<link rel="preconnect" href="https://fonts.googleapis.com">
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
		<link href="https://fonts.googleapis.com/css2?family=Oswald:wght@200;400&display=swap" rel="stylesheet">
		<link rel="stylesheet" href="style.css">
	</head>

	<body>

		<!-- start header & navigation-->
		<?php require_once 'tamplates/header.php'; ?>
		<?php require_once 'tamplates/navigation.php'; ?>
		<!-- finish header & navigation -->

		
	<?php 
	$id_pembelian =  $_GET['id'];

	$ambil = $koneksi->query(
		"SELECT * FROM pembayaran 
		LEFT JOIN pembelian ON pembayaran.id_pembelian = pembelian.id_pembelian 
		WHERE pembelian.id_pembelian='$id_pembelian' ");
	$detbay = $ambil->fetch_assoc();

	// echo "<pre>";
	// print_r($detbay);
	// echo "</pre>";

	//jika blm ada data pembayaran
	if (empty($detbay)) 
	{
		echo "<script>alert('Belum Ada Data Pembayaran')</script>";
		echo "<script>location = 'transaksi.php';</script>";
	}

	//jika data pembayaran tidak sesuai dengan yang login
	/*echo "<pre>";
	print_r($_SESSION);
	echo "</pre>"; */
	if ($_SESSION['user']['id_user']!==$detbay['id_user']) 
	{
		echo "<script>alert('MAU NGAPAIN LU')</script>";
		echo "<script>location = 'transaksi.php';</script>";
	}
	?>
	<div class="container">
		<h3>Lihat Pembayaran</h3>
		<div class="row">
			<div class="col-md-6">
				<table border="1px" class="">
					<tr>
						<th>Nama</th>
						<td><?php echo $detbay['nama']; ?></td>
					</tr>

					<tr>
						<th>Bank</th>
						<td><?php echo $detbay['bank']; ?></td>
					</tr>

					<tr>
						<th>Tanggal</th>
						<td><?php echo $detbay['tanggal']; ?></td>
					</tr>

					<tr>
						<th>jumlah</th>
						<td>Rp. <?php echo number_format($detbay['jumlah']); ?></td>
					</tr> 				
				</table>
			</div>
			<div class="">
				<img width="50px" src="assets/img/bukti-pembayaran/<?= $detbay["bukti"] ?>" alt="" class="img-responsive">
			</div>
		</div>
	</div>
	</body>
	</html>