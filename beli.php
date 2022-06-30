<?php

    session_start();

    //ambil id produk beli
    $id_beli = $_GET['id'];


    //jika produk yang dipilih sudah ada dikeranjang, maka jumlahnya di+1
    if (isset($_SESSION['keranjang'][$id_beli])) {
        $_SESSION['keranjang'][$id_beli]+=1;
    }
    //kalau blm ada dikeranjang, maka produk dianggap dibeli 1
    else
    {
        $_SESSION ['keranjang'] [$id_beli] = 1;
    }

    if(isset($_SESSION['catatan'][$id_beli])){
        $_SESSION['catatan'][$id_beli] += $_SESSION['catatan'][$id_beli];
    }else{
        $_SESSION['catatan'][$id_beli] = " ";
    }

        
    //lempar ke halaman keranjang
    echo "<script> alert ('produk telah masuk ke keranjang belanja'); </script>";
    echo "<script> location='keranjang.php'; </script>";

?>