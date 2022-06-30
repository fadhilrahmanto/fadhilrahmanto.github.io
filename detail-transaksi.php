<?php 
    session_start();
    include 'koneksi.php';


    

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

    <Style>
        
    </Style>

    <title>UMKM CILEDUG PRIMA || DETAIL TRANSAKSI</title>
</head>

<body>
    <?php require_once "tamplates/navigation.php" ;?>

    <section class="transaksi">

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
            <div class="row">
                <div class="detail-pembeli-1">
                    <p>
                        No Transaksi : <?= $detail['id_pembelian']; ?><br>
                        Tanggal pembelian: <?= $detail['tgl_pembelian']; ?><br>
                        Total  Pembelian :  Rp. <?= number_format($detail['total_pembelian']); ?>
                        </p>
                </div>

                <div class="detail-pembeli-2">
                    <hr>
                    info Pengiriman
                    
                </div>

                <div class="detail-pembeli-3">
                    <?= $detail['name']; ?><br>
                    <?= $detail['telp']; ?><br>
                        
                    <p>
						Kota Tujuan : <?= $detail['kota']; ?><br>
						Tarif : Rp. <?= number_format($detail['ongkir']); ?><br>
						Alamat Lengkap :
						<?= $detail['alamat_pengiriman']; ?>
                    </p>
				</div>
            </div>
        </div>

        <div class="container mt-5">
            <table border="1px" class="table table-bordered">
				<thead>
					<tr>
						<th colspan="7">Belanja</th>
					</tr>
				</thead>
				<thead class="text-center">
					<tr>
						<th>no</th>
						<th>nama produk</th>
						<th>harga</th>
						<th>berat</th>
						<th>jumlah barang</th>
						<th>Berat Total</th>
						<th>Harga Total</th>
					</tr>
				</thead>

				<tbody align="center">
                    <?php $total_brg=0; ?>
                    <?php $total_berat=0 ?>
                    <?php $total_harga=0 ?>
					<?php $nomor=1; ?>
					<?php $ambil = $koneksi->query("SELECT * FROM pembelian_produk 
                                                    WHERE id_pembelian=$id_transaksi"); ?>
					<?php while ($pecah = $ambil->fetch_assoc()) { ?>
					<tr>
						<td><?= $nomor; ?></td>
						<td><?= $pecah['nama']; ?></td>
						<td>Rp. <?= number_format($pecah['harga']) ; ?></td>
						<td><?= $pecah['berat']; ?> Gr</td>
						<td><?= $pecah['jumlah']; ?></td>
						<td><?= $pecah['sub_berat'];?> Gr</td>
						<td>Rp. <?= number_format($pecah['sub_harga']) ;?></td>
					</tr>
						<?php $nomor++; ?>
                        <?php $total_brg+=$pecah['jumlah']; ?>
                        <?php $total_berat+=$pecah['sub_berat']; ?>
                        <?php $total_harga+=$pecah['sub_harga']; ?>
						<?php } ?>
				</tbody>
			</table>
        </div>

        <div class="container mt-5 mb-5">
            
				<table border="1px" class="table table-bordered">
					<thead>
						<tr>
							<th colspan="3"> <h4>Rincian Pembayaran</h4> </th>
						</tr>
					</thead>

					<thead  class="text-center">
						<tr>
							<th>Metode Pembayaran</th>
							<th>Total Harga (<?= $total_brg; ?> Barang)</th>
							<th>Total ongkos kirim ( <?= $total_berat; ?> Gr)</th>
						</tr>
					</thead>

					<tbody align="center">
						<tr>
							<td><?= $detail['metode'] ?></td>
							<td>Rp<?= number_format($total_harga); ?></td>
							<td>Rp<?= number_format($detail['ongkir']); ?></td>
						</tr>
					</tbody>
				</table>
			</p>
        </div>

        
    </section>

    
    <!-- finish content -->

    <!-- footer -->
    <?php require_once'tamplates/footer.php'; ?>
    <!-- footer end -->


    

    