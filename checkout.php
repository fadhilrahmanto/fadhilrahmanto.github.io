	<?php 
	session_start();
	include 'koneksi.php';


	//jika belum login maka dilempar ke index.php
	if (!isset($_SESSION['user'])) 
	{
		echo "<script> alert('SILAHKAN LOGIN!'); </script>";
			echo "<script> location='login.php'; </script>";
	}

	$iduser = $_SESSION['user']['id_user'];
	$ambil = $koneksi->query("SELECT * FROM users WHERE id_user=$iduser");
	$user = $ambil->fetch_assoc();

	
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

    <title>UMKM CILEDUG PRIMA || CHECKOUT</title>
</head>

<body>
    <?php require_once "tamplates/navigation.php" ;?>

		<!-- start content -->
		
<section class="transaksi">

<div class="container">
	Produk
	<!-- <?php
	echo"<pre>";
	print_r($_SESSION['keranjang']);
	print_r($_SESSION['catatan']);
	"</pre>"; 
	?> -->
	<hr>
	<table border="1px"  class="table table-bordered">
		<thead>
			<tr>
				<th>No</th>
				<th>Produk</th>
				<th>Harga</th>
				<th>Jumlah</th>
				<th>berat</th>
				<th>Subharga</th>
			</tr>
		</thead>

		<tbody align="center">
			<?php $nomor=1; ?>
			<?php $totalbelanja=0; ?>
			<?php $totalberat=0 ?>
			<?php foreach ($_SESSION['keranjang'] as $idp => $jumlah):  ?>

				<!-- menampilkan produk yg sedang di perulangkan berdasarkan id produk -->

				<?php 
				$ambil = $koneksi->query ("SELECT * FROM tb_produk WHERE idp='$idp'");
				$pecah = $ambil->fetch_assoc();
				$subharga = $pecah['harga_produk']*$jumlah;
				$subberat = $pecah['berat_produk']*$jumlah;

				// echo "<pre>";
				// print_r($pecah);
				// echo "</pre>";
				// ?>

			<tr>
				<td><?= $nomor; ?></td>
				<td><?= $pecah['nama_produk']; ?></td>
				<td>Rp. <?= number_format($pecah['harga_produk']); ?></td>
				<td><?= $jumlah; ?></td>
				<td><?= $subberat; ?>Gr</td>
				<td>Rp. <?= number_format($subharga); ?></td>
				

			</tr>
			<?php $nomor++; ?>
			<?php $totalbelanja += $subharga; ?>
			<?php $totalberat += $subberat; ?>
			<?php endforeach ?>
		</tbody>
		<tfoot>
			
			<tr>
				<?php foreach ($_SESSION['catatan'] as $id_produk => $catatan) : ?>
					
				<?PHP endforeach; ?>
				<th colspan="2" align="center"> Catatan Pesanan : </th>
					<th colspan="4" align="justify"> <?= $catatan ?></th>
			</tr>

			<tr>
				<th colspan="5">Total Belanja</th>
				<th>Rp. <?= number_format($totalbelanja) ; ?> </th>
			</tr>
		</tfoot>
	</table>
</div>

<div class="container">
	<table class="table table-bordered">
		<thead>
			<tr></tr>
		</thead>
			<tbody align="center">
				<tr></tr>
			</tbody>

		<tfoot>
			<tr></tr>
		</tfoot>
	</table>
</div>

<div class="container">
	<form action="" method="post">

		<div class="form-group">
			<label for="">nama</label>
			<input type="text" name="nama_user" id="" value="<?= $_SESSION['user']['name'] ?>" readonly>
		</div>
		<div class="form-group">
			<label for="">No. Handphone</label>
			<input type="text" name="telp" id="" value="<?= $_SESSION['user']['telp'] ?>" readonly>
		</div>
		<div class="form-group">
			<label for="catatan"></label>
		</div>

		<div class="form-group">
			<label for="alamat">alamat</label>
			<textarea class="form-control" name="alamat" id="alamat" cols="30" rows="10" value="<?= $user['alamat'] ?>"><?= $user['alamat'] ?></textarea>
		</div>

		
		<div class="form-group">
			<label for="provinsi">provinsi</label><br>
			<select class="form-control" name="provinsi" id="provinsi">
			</select>
		</div>
			
		<div class="form-group">
			<label for="kota">kota</label>
				<select class="form-control" name="kota" id="kota">
				</select>
		</div>
			
		<div class="form-group">
			<label for="ekspedisi">ekspedisi</label>
				<select class="form-control" name="ekspedisi" id="ekspedisi">
				</select>
		</div>

		<div class="form-group">
			<label for="ongkir">ongkir</label>
				<select class="form-control" name="ongkir" id="ongkir">
				</select>
		</div>

		<div class="form-group">
			<label for="pembayaran">metode pembayaran</label>
				<select class="form-control" name="pembayaran" id="pembayaran">
				</select>
		</div>

		<!-- dimasukan ke database tabel pembelian -->
		<input type="text" name="total_berat" value="<?= $totalberat; ?>"  readonly hidden >
		<input type="text" name="nm_provinsi" readonly hidden >
		<input type="text" name="nm_kota" hidden  >
		<input type="text" name="tipe" readonly hidden >
		<input type="text" name="kd_pos" readonly  hidden >
		<input type="text" name="nm_ekspedisi" readonly hidden  >
		<input type="text" name="nm_ongkir" readonly hidden  >
		<input type="text" name="harga_ongkir" readonly hidden  >
		<input type="text" name="estimasi" readonly  hidden >
		<input type="text" name="id_metode" readonly hidden  >
		<input type="text" name="metode" readonly hidden  >
		<input type="text" name="norek" readonly  hidden >
		<input type="text" name="atas_nama" readonly hidden >
		

		<?php foreach ($_SESSION['catatan'] as $id_produk => $catatan) {
			echo "
			<input type='text' name='catatan' value='$catatan' readonly hidden >
			";

			// echo "<pre>";
			// 	print_r($catatan);
			// 	echo "</pre>";
		}?>

		<button class="btn btn-primary mt-2" name="checkout">Checkout</button>

	</form>
</div>



	<?php 
	if (isset($_POST["checkout"])) 
	{
		

		$id_user = $_SESSION['user']["id_user"];
		$catatan = $_POST['catatan'];
		$tanggal_pembelian = date("y-m-d") ;
		$alamat = $_POST['alamat'];
		$tberat = $_POST['total_berat'];
		$provinsi = $_POST['nm_provinsi'];
		$kota = $_POST['nm_kota'];
		$tipe = $_POST['tipe'];
		$kdpos = $_POST['kd_pos'];
		$ekspedisi = $_POST['nm_ekspedisi'];
		$servis = $_POST['nm_ongkir'];
		$ongkir = $_POST['harga_ongkir'];
		$estimasi = $_POST['estimasi'];
		$idmetode = $_POST['id_metode'];
		$metode = $_POST['metode'];
		$norek = $_POST['norek'];
		$atas_nama = $_POST['atas_nama'];
		

		$total_pembelian = $totalbelanja + $ongkir;

		// 1. menyimpan data ke tabel pembelian
		$koneksi->query("INSERT INTO pembelian
		(id_pembelian,id_user,tgl_pembelian,alamat_pengiriman,total_pembelian,catatan_pembelian,total_berat,provinsi,kota,tipe,kd_pos,ekspedisi,servis,ongkir,estimasi,id_metode,metode,norek,atas_nama)
		VALUES
		('','$id_user','$tanggal_pembelian','$alamat','$total_pembelian','$catatan','$tberat','$provinsi','$kota','$tipe','$kdpos','$ekspedisi','$servis','$ongkir','$estimasi','$idmetode','$metode','$norek','$atas_nama')
			");

		//2. mendapatkan id pembelian yg baru terjadi
		
		$id_pembelian_terbaru = $koneksi->insert_id;
		
		


		foreach ($_SESSION['keranjang'] as $id_produk => $jumlah) 
		{

			//mendapatkan produk berdasarkan id produk
			$ambil = $koneksi->query("SELECT * FROM tb_produk WHERE idp='$id_produk'");
			$perproduk = $ambil->fetch_assoc();
			$nama = $perproduk['nama_produk'];
			$harga = $perproduk['harga_produk'];
			$nmukm = $perproduk['nama_pedagang'];
			$berat = $perproduk['berat_produk'];
			$foto = $perproduk['gambar_produk'];

			$subberat = $perproduk['berat_produk']*$jumlah;
			$subharga = $perproduk['harga_produk']*$jumlah;

			$koneksi->query("INSERT INTO pembelian_produk
			(id_pembelian, idp,nama,nm_pedagang,harga,berat,sub_berat,sub_harga,foto, jumlah)
			VALUES
			('$id_pembelian_terbaru','$id_produk','$nama','$nmukm','$harga','$berat','$subberat','$subharga','$foto','$jumlah')");

			//script update stok
			$koneksi->query("UPDATE tb_produk SET stok_produk=stok_produk-$jumlah 
								WHERE idp='$id_produk'");

			
		}
			//mengkosongkan keranjang
			unset($_SESSION['keranjang']);
			unset($_SESSION['catatan']);

			// tampilan dilempar ke halaman nota
			echo"<script>alert('pembelian sukses');</script>";
			echo"<script>location='bayar.php?id=$id_pembelian_terbaru';</script>";
	}

	?>


	</section>
	<!-- finish content -->

		<!-- pre>
		<?php echo print_r($_SESSION['pelanggan']); ?>
		<?php echo print_r($_SESSION['keranjang']); ?>
		</pre-->

	<!-- footer -->
	<?php
	require_once'tamplates/footer.php';
	?>
	<!-- footer end -->

	<script>
	$(document).ready(function(){
		$.ajax({
			type:"post",
			url:"provinsi.php",
			success:function(hasil_provinsi){

				$("select[name=provinsi]").html(hasil_provinsi);
				
			}
		});

		// jika  sudah pilih provinsi , maka muncul pilih kota tujuan
		$("select[name=provinsi]").on("change", function(){

			// id prpvinsi yang dipilih
			var id_prov = $("option:selected",this).attr("id_provinsi");
			$.ajax({
				type:"post",
				url:"kota.php",
				data:"id_provinsi="+id_prov,
				success:function(hasil_kota){

					$("select[name=kota]").html(hasil_kota);
				}
			});
		});

		// jika  sudah pilih kota , maka muncul pilih ekspedisi
		$("select[name=kota]").on("change", function(){
			$.ajax({
				type:'post',
				url:'ekspedisi.php',
				success:function(hasil_ekspedisi){
					$("select[name=ekspedisi]").html(hasil_ekspedisi);
				}
			});
		});
		
		// jika  sudah pilih ekspedisi , maka muncul pilih service ongkir
		$("select[name=ekspedisi]").on("change", function(){
			// data ongkir

			// ngambil id ekspedisi yang dipilih
			var ekspedisi = $("select[name=ekspedisi]").val();

			$("input[name=nm_ekspedisi]").val(ekspedisi);
			// alert(ekspedisi);
			// ngambil id kota/kabupaten yang dipilih
			var kota = $("option:selected", "select[name=kota]").attr("id_kota");
			// alert(kota);
			// ngambil total berat dari form input
			var berat = $("input[name=total_berat]").val();
			// alert(berat);

			

			$.ajax({
				type:'post',
				url:'harga.php',
				data:'ekspedisi='+ekspedisi+'&kota='+kota+'&berat='+berat,
				success:function(hasil_kurir){
					// console.log(hasil_kurir);
					$("select[name=ongkir]").html(hasil_kurir);
				}
			});
		});

		// jika sudah pilih  ongkir , maka muncul metode pembayaran
		$("select[name=ongkir]").on("change", function(){
			$.ajax({
				type:'post',
				url:'bank.php',
				success:function(hasil_pembayaran){
					$("select[name=pembayaran]").html(hasil_pembayaran);
				}
			});
		});

		
		// memasukan pilihan2 diatas ke dalam input, untuk selanjutnya dimasukan ke database
		$("select[name=kota]").on("change", function(){
			var prvnc = $("option:selected", this).attr("nm_provinsi");
			var ktkab = $("option:selected", this).attr("nm_kota");
			var tipe = $("option:selected", this).attr("tipe");
			var kdpos = $("option:selected", this).attr("kd_pos");

			$("input[name=nm_provinsi]").val(prvnc);
			$("input[name=nm_kota]").val(ktkab);
			$("input[name=tipe]").val(tipe);
			$("input[name=kd_pos]").val(kdpos);
		});

		$("select[name=ongkir]").on("change", function(){
			var servis = $("option:selected", this).attr("service");
			var tarif = $("option:selected", this).attr("harga");
			var lama_tiba = $("option:selected", this).attr("estimasi_sampai");
			
			$("input[name=nm_ongkir]").val(servis);
			$("input[name=harga_ongkir]").val(tarif);
			$("input[name=estimasi]").val(lama_tiba);
			
		});

		$("select[name=pembayaran]").on("change", function(){
			var id_metode = $("option:selected", this).attr("id_payment");
			var metode = $("option:selected", this).attr("metode");
			var norek = $("option:selected", this).attr("norek");
			var atas_nama = $("option:selected", this).attr("atas_nama");
			
			$("input[name=id_metode]").val(id_metode);
			$("input[name=metode]").val(metode);
			$("input[name=norek]").val(norek);
			$("input[name=atas_nama]").val(atas_nama);
			
		});


		


	});
	</script>

