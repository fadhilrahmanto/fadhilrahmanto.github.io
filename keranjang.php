<?php 
	session_start();
	//koneksi database
	require_once 'koneksi.php';

	if (empty($_SESSION['keranjang']) OR !isset($_SESSION['keranjang']))
	{
		echo "<script> alert('KERANJANG KOSONG, SILAHKAN BELANJA DULU!'); </script>";
		echo "<script> location='index.php'; </script>";
	}
	
	
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

    <title>UMKM CILEDUG PRIMA</title>
</head>

<body>
    <?php require_once "tamplates/navigation.php" ;?>

    <!-- start content -->
    
	<section class="konten">

	<?php
	// echo"<pre>";
	// print_r($_SESSION['keranjang']);
	// print_r($_SESSION['catatan']);
	// "</pre>"; 
	?>
		<div class="container mt-5 mb-5">
			<h3>Keranjang Belanja Anda</h3>
			<hr>
			<table border="1px" class="table table-bordered text-center table-responsive-sm table-responsive-lg table-responsive-md">
				<thead>
					<tr>
						<th>No</th>
						<th>Produk</th>
						<th>foto produk</th>
						<th>Harga</th>
						<th>Jumlah</th>
						<th>Subharga</th>
						<th>Aksi</th>
					</tr>
				</thead>

				<tbody> 

					<?php $nomor=1; ?>
					<?php foreach ($_SESSION["keranjang"] as $id_produk => $jumlah):  ?>
						

						<!-- menampilkan produk yg sedang di perulangkan berdasarkan id produk -->

						<?php 
						$ambil = $koneksi->query ("SELECT * FROM tb_produk WHERE idp='$id_produk'");
						$pecah = $ambil->fetch_assoc();
						$subharga = $pecah['harga_produk']*$jumlah;

						//echo "<pre>";
						//print_r($pecah);
						//echo "</pre>";
						?>

					<tr>
						<td><?= $nomor; ?></td>
						<td><?= $pecah['nama_produk']; ?></td>
						<td><img class="img-fluid" width="50%" src="assets/img/produk/<?= $pecah['gambar_produk'] ?>"></td>
						<td>Rp. <?= number_format($pecah['harga_produk']); ?></td>
						<td><?= $jumlah; ?></td>
						<td>Rp. <?= number_format($subharga); ?></td>
						<td>
					<a href="hapuskeranjang.php?id=<?=$id_produk; ?>" class="btn-danger btn">hapus</a>
					
				</td>

					</tr>
					<?php $nomor++; ?>
					<?php endforeach ?>
				</tbody>

				<tfoot>
					<tr>
					<?php foreach ($_SESSION['catatan'] as $id_produk => $catatan) : ?>
						
					<?PHP endforeach; ?>
					<td colspan="7"> <strong> Catatan Pesanan : </strong> <?= $catatan ?> </td>
					</tr>
				</tfoot>


			</table>
			
			

			<a href="index.php" class="btn btn-primary">Lanjutkan Belanja</a>
			<a href="checkout.php" class="btn btn-primary ">Checkout</a>

		</div>
	</section>
    <!-- finish content -->

    <!-- footer -->
    <?php
    require_once'tamplates/footer.php';
    ?>
    <!-- footer end -->