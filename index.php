<?php
session_start();
require_once "koneksi.php";


$ambil = $koneksi->query("SELECT * FROM tb_produk LIMIT 8");
// $produk = $ambil->fetch_assoc();
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


    <section id="featured" class="my-1 pb-1">
        <div class="container text-center mt-1 py-5">
            <!-- <h3>Our Featured</h3>
            <hr> -->

        <div class="row">
        <?php while($p = $ambil->fetch_assoc()) { ?>
            <div class=" col-md-3">
                <div class="thumbnail">
                    <img class="img-fluid" width="50%" src="assets/img/produk/<?= $p['gambar_produk'] ?>" alt="">
                </div>
                <div class="caption">
                    <h5 class="p-name"> 
                        <?php
                            $num_char = 20;
                            $text =  $p['nama_produk'];
                            echo substr($text, 0, $num_char) . '...';
                        ?> 
                    </h5>
                    <h4 class="p-price"> Rp. <?= number_format($p['harga_produk']) ?> </h4>
                        <?php
                            $stok = $p['stok_produk'];
                            $idp = $p['idp'];
                                if($stok > 0){
                                    echo "
                                        <a class='btn btn-success' href='beli.php?id=$idp'>Beli</a>
                                    ";
                                } else{
                                    echo"
                                        <a class='btn btn-danger'>Stok Habis</a>
                                    ";
                                }
                            ?>
                    <a class="btn btn-info" href="detail.php?id=<?= $p['idp']; ?> ">Detail</a>
                </div>
            </div>
            <?php } ?>
        </div>

        <div class="lainnya mt-5">
            <div class="container">
                <a class="btn btn-primary" href="product.php">Tampilkan Lainnya</a>
            </div>
        </div>
    </section>

    <?php require_once "tamplates/footer.php";  ?>
</body>

</html>
