	<?php 
	session_start();
	include 'koneksi.php';

	//jika blm login
	if (!isset($_SESSION["user"]) OR empty($_SESSION["user"])) 
	{
		echo "<script>alert('SILAHKAN LOGIN!!!');</script>";
		echo "<script>location='login.php';</script>";
		exit();
	}

	//mendapatkan id pembelian dari url
	$idpembelian = $_GET['id'];
	$ambil = $koneksi->query("SELECT * FROM pembelian WHERE id_pembelian='$idpembelian'");
	$detailpembelian = $ambil->fetch_assoc();
	$idu = $detailpembelian['id_user'];

	$queryAkun = $koneksi->query("SELECT * FROM users WHERE id_user=$idu");
	$akun = $queryAkun->fetch_assoc();

	//mendapatkan id pelanggan yg beli
	$id_pelanggan_beli = $detailpembelian['id_user'];
	//mendapatkan id_pelanggan yg login
	$id_pelanggan_login = $_SESSION['user']['id_user'];

	if ($id_pelanggan_login!==$id_pelanggan_beli) 
		{
			echo "<script>alert('Hayoooo Mau Ngapain');</script>";
			echo "<script>location ='transaksi.php'; </script>";
			exit();
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

		<section class="transaksi">
			<div class="container mt-5">
				<div class="row">
					<h2>Konfirmasi Pembayaran</h2><br>
					<hr>
					<strong><p>Kirim Bukti Pembayaran Anda disini,<br>
					Pastikan semua sesuai dengan foto bukti yang di upload</p></strong>

					<div class="detail-pembeli-2">Total Tagihan 
						<strong>
							<?= $akun['name'] ?>
						</strong>
						sebesar
						<strong>
							Rp. <?= number_format($detailpembelian['total_pembelian']) ?> 
						</strong>
					</div>

			<form method="post" enctype="multipart/form-data">
				<div class="form-group mt-2 ">
					<input type="text" class="form-control" name="nama" placeholder="Nama Pembayar..." required>
				</div>

				<div class="form-group mt-2">
					<input type="text" class="form-control" name="bank" placeholder="Bank..." required>
				</div>

				<div class="form-group mt-2">
					<input type="number" class="form-control" name="jumlah" min="1" 
					placeholder="Jumlah Transaksi *masukan nominal angka saja...*" required>
				</div>

				<div class="form-group mt-2">
					<label>Foto Bukti Pembayaran</label>
					<input type="file" class="form-control" name="bukti">
					
				</div>

				<button class="btn btn-primary mt-2 mb-2" name="kirim">Kirim</button>
			</form>

			<?php 
			

			//jika ada tombol kirim
			if (isset($_POST['kirim'])) 
			{
				$nama = $_POST['nama'];
				$bank = $_POST['bank'];
				$jumlah = $_POST['jumlah'];
				$tanggal = date("y-m-d");
				

				//upload struk pembayaran

				$size = $_FILES['bukti']['size'];
				$namabukti = $_FILES['bukti']['name'];
				$lokasibukti = $_FILES['bukti']['tmp_name'];
				$error = $_FILES['bukti']['error'];

				//cek udah up gambar apa blm
				if ($error ===4) {
					echo "
					<script>alert('pilih gambar dulu');
					</script>";
					return false;
				}

				//cek yg di up gambar apa bukan
				$extensifotovalid = ['jpg','png','jpeg','bmp'];
				$extensifoto = explode(".", $namabukti);
				$extensifoto = strtolower(end($extensifoto));
				if (!in_array($extensifoto, $extensifotovalid)) {
					echo "
					<script>alert('Bukan Gambar');
					</script>";
					return false;
				}

				//cek ukuran
				if ($size > 1000000) {
					echo "
					<script>alert('UKURAN KEGEDEAN');
					</script>";
					return false;
				}

				//generate nama abru
				$namafotobaru = uniqid();
				$namafotobaru .= '.';
				$namafotobaru .= $extensifoto; 

				move_uploaded_file($lokasibukti, "assets/img/bukti-pembayaran/$namafotobaru");

				//simpan pembayaran
				$koneksi->query("INSERT INTO pembayaran
					(id_pembelian,nama,bank,jumlah,tanggal,bukti)
					VALUES
					('$idpembelian','$nama','$bank','$jumlah','$tanggal','$namafotobaru')");

				//update dari pending -> sudah kirim bukti pembayaran
				$koneksi->query("UPDATE pembelian SET status_pembelian='Sudah Kirim Bukti Pembayaran' WHERE id_pembelian='$idpembelian'");

				echo "<script>alert('Terima Kasih Sudah Mengirimkan Bukti Pembayaran');</script>";
				echo "<script>location ='transaksi.php'; </script>";


			} 
			?>
			</div>
		</div>
	</section>

	</body>
	</html>