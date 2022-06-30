<?php 
session_start();
$id_keranjang = $_GET["id"];
unset($_SESSION['keranjang'][$id_keranjang]);
unset($_SESSION['catatan'][$id_keranjang]);

echo "<script> alert('Produk Dihapus Dari Keranjang'); </script>";
		echo "<script> location='keranjang.php'; </script>";
?>