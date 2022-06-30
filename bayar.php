

    <?php 
	session_start();
	include 'koneksi.php';


	//jika belum login maka dilempar ke index.php
	if (!isset($_SESSION['user'])) 
	{
		echo "<script> alert('SILAHKAN LOGIN!'); </script>";
			echo "<script> location='login.php'; </script>";
	}

    $id_user = $_SESSION['user']['id_user'];
    $id_transaksi = $_GET['id'];

	
	?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <link rel="stylesheet" href="assets/bootstrap/css/style.css">


    <title>UMKM CILEDUG PRIMA || PEMBAYARAN</title>
</head>

<body>
    <?php require_once "tamplates/navigation.php" ;?>

		<!-- start content -->
        <section id="transaksi">

        <?php
		$ambil = $koneksi->query("SELECT * FROM pembelian JOIN users 
                                    ON pembelian.id_user=users.id_user 
                                    WHERE pembelian.id_pembelian=$id_transaksi");
		$detail = $ambil->fetch_assoc();
		?>
		<!-- DATA ORANG YG LOGIN  -->
		<!-- <pre><?php print_r($detail); ?></pre> -->

		<!-- data orang yg beli  -->
		<!-- <pre><?php print_r($_SESSION) ?></pre  -->

		<!-- jika pelanggan yg beli, tidak sama dengan pelanggan yg login
        maka dilempar ke index.php krena dia tidak berhak melihat transaksi org lain -->
		<!-- pelanggan yg beli harus pelanggan yg login -->
		<?php 
		    //mendapatkan id pelanggan
		    $pelangganygbeli = $detail['id_user'];

			//mendapatkan id pelanggan yg login
			$pelangganyglogin = $_SESSION["user"]['id_user'];
			if ($pelangganygbeli!==$pelangganyglogin) 
			{
				echo "<script>alert('Mau Ngapain Lu?!');</script>";
				echo "<script>location ='index.php'; </script>";
				exit();
			}
		?>


		<div class="container mt-5">
            <p>Silahkan Melakukan Pembayaran <strong> Rp. <?= number_format($detail['total_pembelian']) ?> </strong> Ke : <br>
				<table border="1px" class="table table-bordered ">
					<thead>
						<tr>
							<th colspan="3">Metode Pembayaran Yang Dipilih :</th>
						</tr>
					</thead>
					<thead class="text-center">
						<tr>
							<th>Metode</th>
							<th>Nomor Rekening</th>
							<th>Atas Nama</th>
						</tr>
					</thead>

					<tbody class="text-center">
						<tr>
							<td><?= $detail['metode'] ?></td>
							<td><?= $detail['norek'] ?></td>
							<td><?= $detail['atas_nama'] ?></td>
						</tr>
					</tbody>
				</table>
			</p>
        </div>
    
        <div class="container">
            <strong> CATATAN </strong><br>
            <strong>Jika sudah melakukan transfer pembayaran, jangan lupa untuk upload bukti pembayaran. <br> 
            Pesanan akan di konfirmasi maksimal 1x24jam
            </strong>
        </div>

        <div class="container">
            <a href="up-bukti-pembayaran.php?id=<?php echo $detail['id_pembelian'] ?>" class="btn btn-primary">
                Input Bukti Pembayaran
            </a>
        </div>

        </section>

	<!-- finish content -->

	<!-- footer -->
	<?php
	require_once'tamplates/footer.php';
	?>
	<!-- footer end -->
</body>
</html>
