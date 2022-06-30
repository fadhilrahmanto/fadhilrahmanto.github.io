
<?php



?>
        <h1 class="mt-4">Pengaturan Toko</h1>
	<hr>
	
	<!-- <?php
	echo"<pre>";
	print_r($ubahprdk);
	echo"</pre>";
	?>

	<?php
	echo"<pre>";
	print_r($data_status);
	echo"</pre>";
	?>

	<?php
	echo"<pre>";
	print_r($data_kategori);
	echo"</pre>";
	?>  -->

		<form	form method="post" enctype="multipart/form-data">

			<div class="form-group mt-3">
				<label>Nama Toko</label>
				<input type="text" class="form-control" name="nama" >
			</div>

            <div class="form-group mt-3">
				<label>email Toko</label>
				<input type="enail" class="form-control" name="email">
			</div>

			<div class="form-group mt-1">
                    <label for="alamat">alamat Toko </label>
                    <textarea name="alamat" id="alamat" class="form-control" cols="30" rows="10"></textarea>
            </div>

			<div class="form-group">
                    <label for="telp">Phone</label>
                    <input type="number" name="telp" class="form-control" value="<?= $profile['telp'] ?>">
                </div>

            <div class="form-group mt-1">
                    <label for="desc">Deskripsi/Sejarah Toko </label>
                    <textarea name="desc" id="desc" class="form-control" cols="30" rows="10"></textarea>
            </div>

            <div class="mt-3">
				<button class="btn btn-primary" name="ubah">Simpan</button>
			</div>
		</form>



	<?php 
	

	if (isset($_POST['ubah']))
	{

		$kat = $_POST['id_kategori'];
		$nmp = $_POST['nama'];
		$harga = $_POST['harga'];
		$berat = $_POST['berat'];
		$stok = $_POST['stok'];
		$desc = $_POST['desc'];
		$status = $_POST['status'];

		$namafoto = $_FILES['foto']['name'];
		$lokasifoto = $_FILES['foto']['tmp_name'];
		$size = $_FILES['foto']['size'];
		$error = $_FILES['foto']['error'];

		//jika foto diubah

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

		if (!empty($lokasifoto)) 
		{
		move_uploaded_file($lokasifoto, "../assets/img/produk/$namafotobaru");

		$koneksi->query("UPDATE tb_produk SET 
							idk='$kat',
							nama_produk='$nmp', 
							harga_produk='$harga',
							deskripsi_produk='$desc',
							gambar_produk='$namafotobaru',
							berat_produk='$berat',
							stok_produk='$stok', 
							id_status='$status'
							WHERE idp=$idproduk");
		}
		else
		{
			$koneksi->query("UPDATE tb_produk SET 
							idk='$kat',
							nama_produk='$nmp', 
							harga_produk='$harga',
							deskripsi_produk='$desc', 
							berat_produk='$berat',
							stok_produk='$stok', 
							id_status='$status'
							WHERE idp=$idproduk");
		}
		echo "<script>alert('data produk telah diubah');</script>";
		echo "<script>location='index.php?halaman=produk';</script>";
	} 
		
	
?>