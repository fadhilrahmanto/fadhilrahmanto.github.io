
    <?php
    require_once "koneksi.php";
    $id_pembelian = $_GET['id'];
    $status = "Pesanan Selesai";

    $koneksi->query("UPDATE pembelian SET status_pembelian='$status' 
							WHERE id_pembelian='$id_pembelian'");
    
    echo "<script> alert('Pesanan Sudah Selesai'); </script>";
    echo "<script>location='transaksi.php';</script>";

