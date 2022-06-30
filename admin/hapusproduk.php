<?php  

$ambil = $koneksi->query("SELECT*FROM tb_produk WHERE idp='$_GET[id]'");
$pecah = $ambil->fetch_assoc();
$fotoproduk = $pecah['gambar_produk'];
if (file_exists("../assets/img/produk/$fotoproduk"))
 {
 	unlink("../assets/img/produk/$fotoproduk");
}

$koneksi->query("DELETE FROM tb_produk WHERE idp='$_GET[id]'");

echo "<script>alert('produk terhapus');</script>";
echo "<script>location='index.php?halaman=produk';</script>";

?>