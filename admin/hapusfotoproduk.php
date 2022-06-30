<?php
    
    $id_foto = $_GET["idf"];
    $id_produk = $_GET["idp"];

    $foto = $koneksi->query("SELECT*FROM foto_produk WHERE idp_foto=$id_foto");
    $datafoto = $foto->fetch_assoc();

    $namaft = $datafoto['foto_produk'];

    // hapus data di folder foto produk
    unlink("../assets/img/produk/".$namaft);

    // hapus data di database
    $koneksi->query("DELETE FROM foto_produk WHERE idp_foto=$id_foto");

        
    echo "<script>alert('Foto Produk terhapus');</script>";
    echo "<script>location='index.php?halaman=detailproduk&id=$id_produk';</script>";

?>