<?php

$data_kategori = array();

	$ambil = $koneksi->query("SELECT * FROM tb_kategori");
	while($kat = $ambil->fetch_assoc()){
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

    <h1 class="mt-4">Tambah Produk</h1>
	<hr>
	<!-- <?php
	echo"<pre>";
	print_r($data_status);
	echo"</pre>";
	?> -->
		<form	form method="post" enctype="multipart/form-data">

			<div class="form-group">
				<select name="id_kategori" id="" class="form-control">
					<option value="">Pilih Kategori</option>
					<?php foreach ($data_kategori as $key => $k) : ?>

					<option value="<?= $k['idk'] ?>"><?= $k['nama_kategori'] ?></option>

					<?php endforeach; ?>
					
				</select>
			</div>

			<div class="form-group">
				<label> </label>
				<input type="text" class="form-control" name="namap" placeholder=" Nama Pedagang/UKM....">
			</div>

			<div class="form-group">
				<label></label>
				<input type="text" class="form-control" name="nama" placeholder="Nama Produk...">
			</div>

			<div class="form-group">
				<label ></label>
				<input type="number" class="form-control" name="harga" placeholder="Harga Produk. ex: 500000...">
			</div>

			<div class="form-group">
				<label></label>
				<input type="number" class="form-control" name="berat" placeholder="Berat(Gr)...." >
			</div>

			<div class="form-group">
				<label></label>
				<textarea class="form-control" name="desc" rows="10" placeholder="Deskripsi Produk..."></textarea>
			</div>

			<div class="form-group">
				<label></label>
				<input type="number" class="form-control" name="telp" placeholder="No. Handphone pedagang...." >
			</div>
			
			<div class="form-group">
				<label></label>
				<textarea class="form-control" name="alamat" rows="10" placeholder="Alamat Pedagang..."></textarea>
			</div>

			<div class="form-group">
				<label>Foto Produk</label>
				<div class="letak-input ">
					<input type="file" class="form-control" name="foto[]">
				</div>
				<span class="btn btn-primary btn-tambah mt-3 ">
					<i class="fa fa-plus"></i>
				</span>
			</div>

			<div class="form-group">
				<label>Video Produk</label>
				<input type="file" class="form-control" name="video">
			</div>

			<div class="form-group">
				<label></label>
				<input type="number" class="form-control" name="stok" placeholder="Stok Produk" >
			</div>

			<div class="form-group mt-3">
				<select name="status" id="" class="form-control">
					<option value="">Pilih Status</option>
					<?php foreach ($data_status as $key => $s) : ?>

					<option value="<?= $s['id_status'] ?>"><?= $s['nama_status'] ?></option>

					<?php endforeach; ?>
					
				</select>
			</div>

			<div class="mt-3">
				<button class="btn btn-primary" name="save">Simpan</button>
			</div>
		</form>

		<script>
			$(document).ready(function(){
				$(".btn-tambah").on("click",function(){
					$(".letak-input").append("<input type='file' class='form-control' name='foto[]'>");
				})
			})
		</script>




<?php 
if (isset($_POST['save']))
	{
		// echo"<pre>";
		// print_r($_FILES['foto']);
		// echo"</pre>";
		$kat = htmlspecialchars($_POST['id_kategori']) ;
		$namap = htmlspecialchars($_POST['namap']) ;
		$nmp = htmlspecialchars($_POST['nama']) ;
		$harga = htmlspecialchars($_POST['harga']) ;
		$berat = htmlspecialchars($_POST['berat']) ;
		$desc = htmlspecialchars($_POST['desc']) ;
		$stok = htmlspecialchars($_POST['stok']) ;
		$status = htmlspecialchars($_POST['status']);
		$alamat = htmlspecialchars($_POST['alamat']);
		$telp = htmlspecialchars($_POST['telp']);


		// FOTO
		$namanamaft = $_FILES['foto']['name'];
		$lokasilokasift = $_FILES['foto']['tmp_name'];
		$error = $_FILES['foto']['error'];
		$size = $_FILES['foto']['size'];
		//cek udah up gambar apa blm
		if ($error[0] ===4) {
			echo "
			<script>alert('pilih gambar dulu');
			</script>";
			return false;
		}
		//cek yg di up gambar apa bukan
		$extensifotovalid = ['jpg','png','jpeg','bmp'];
		$extensifoto = explode(".", $namanamaft[0]);
		$extensifoto = strtolower(end($extensifoto));
		if (!in_array($extensifoto, $extensifotovalid)) {
			echo "
			<script>alert('Bukan Gambar');
			</script>";
			return false;
		}
			//cek ukuran
			if ($size[0] > 1000000) {
				echo "
				<script>alert('UKURAN KEGEDEAN');
				</script>";
				return false;
			}
		//generate nama abru
		$namafotobaru = uniqid();
		$namafotobaru .= '.';
		$namafotobaru .= $extensifoto; 

		move_uploaded_file($lokasilokasift[0], "../assets/img/produk/".$namafotobaru);
		
		$koneksi->query("INSERT INTO tb_produk
			(idk,nama_pedagang,nama_produk,harga_produk,berat_produk,gambar_produk,deskripsi_produk,stok_produk,telp_pedagang,alamat_pedagang,id_status) 
			VALUES
			('$kat','$namap','$nmp','$harga','$berat','$namafotobaru','$desc','$stok','$telp','$alamat','$status') ");

			// mendapatkan idp saat ini
			$idp_terkini = $koneksi->insert_id;

		// memasukan foto yang lain ke database table foto produk
		foreach ($namanamaft as $key => $single_nama) {
			$single_lokasi = $lokasilokasift[$key];

			move_uploaded_file($single_lokasi, "../assets/img/produk/".$single_nama);
			$koneksi->query("INSERT INTO foto_produk
								(idp, foto_produk) 
								VALUES
								('$idp_terkini','$single_nama')");
		}
		// memasukan video ke database table video produk
		// VIDEO
		$namev=$_FILES['video']['name'];
		$typev=$_FILES['video']['type'];
		$sizev=$_FILES['video']['size'];
		$lokasi=$_FILES['video']['tmp_name'];

		$extensivideovalid = ['mp4','3gp','avi','mpeg'];
		$extensivideo = explode(".", $namev);
		$extensivideo = strtolower(end($extensivideo));

		if (!in_array($extensivideo, $extensivideovalid)) {
			echo "
			<script>alert('Bukan video');
			</script>";
			return false;
		}

		//cek ukuran
		if ($size[0] > 100000) {
			echo "
				<script>alert('UKURAN KEGEDEAN');
				</script>";
			return false;
		}

		//generate nama abru
		$namavideobaru = uniqid();
		$namavideobaru .= '.';
		$namavideobaru .= $extensivideo; 

		move_uploaded_file($lokasi, "../assets/video/produk/".$namavideobaru);
			
		$koneksi->query("INSERT INTO video_produk
						(idp_video,idp, nama_video) 
							VALUES
						('','$idp_terkini','$namavideobaru')");
		

		echo "<script>alert('Data Telah Disimpan')</script>";
		echo "<meta http-equiv='refresh' content='1;url=index.php?halaman=produk'>";
	}
?>