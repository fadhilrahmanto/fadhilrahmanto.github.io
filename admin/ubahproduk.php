<?php

	$idproduk = $_GET['id'];
	$produk = $koneksi->query("SELECT * FROM tb_produk WHERE idp=$idproduk");
	$ubahprdk = $produk->fetch_assoc();

?>

<?php
	$data_kategori = array();

	$kategori = $koneksi->query("SELECT * FROM tb_kategori");
	while($kat = $kategori->fetch_assoc()){
		$data_kategori[] = $kat;
	}

	
?>

<?php

$data_status = array();

	$ambil = $koneksi->query("SELECT * FROM status");
	while($stat = $ambil->fetch_assoc()){
		$data_status[] = $stat;
	}

?>

        <h1 class="mt-4">Ubah Produk</h1>
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

			<div class="form-group">
				<label>Kategori</label>
				<select name="id_kategori" id="" class="form-control">
					<option value="">Pilih Kategori</option>

					<?php foreach ($data_kategori as $key => $k) : ?>

					<option value="<?= $k['idk'] ?>" <?php if($ubahprdk['idk']==$k['idk']){ echo" selected "; } ?>>
						<?= $k['nama_kategori'] ?>
					</option>

					<?php endforeach; ?>
					
				</select>
			</div>

			<div class="form-group mt-3">
				<label>nama</label>
				<input type="text" class="form-control" name="nama" value="<?= $ubahprdk['nama_produk'] ?>">
			</div>

			<div class="form-group mt-3">
				<label>Harga (Rp)</label>
				<input type="number" class="form-control" name="harga" value="<?= $ubahprdk['harga_produk'] ?>">
			</div>

			<div class="form-group mt-3">
				<label>Berat(Gr)</label>
				<input type="number" class="form-control" name="berat" value="<?= $ubahprdk['berat_produk'] ?>">
			</div>

			<div class="form-group mt-3">
				<label>Deskripsi</label>
				<textarea class="form-control" name="desc" rows="10" value="<?= $ubahprdk['deskripsi_produk'] ?>"></textarea>
			</div>

			<div class="form-group mt-3">
				<img src="../assets/img/produk/<?= $ubahprdk['gambar_produk']; ?>" width="200" > 
			</div>
			<div class="form-group mt-3">
				<label>Ganti Foto Baru</label>
				<input type="file" name="foto" class="form-control">
			</div>

			<div class="form-group mt-3">
				<label>Stok Produk</label>
				<input type="number" class="form-control" name="stok" value="<?= $ubahprdk['stok_produk'] ?>" >
			</div>

			<div class="form-group mt-3">
				<label>Status Produk</label>
				<select name="status" id="" class="form-control">
					<option value="">Pilih Status</option>
					<?php foreach ($data_status as $key => $s) : ?>

					<option value="<?= $s['id_status'] ?>" <?php if($ubahprdk['id_status']==$s['id_status']){ echo" selected "; } ?>>
						<?= $s['nama_status'] ?>
					</option>

					<?php endforeach; ?>
					
				</select>
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