<?php 
session_start();
//koneksi database
require_once 'koneksi.php';

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

    <!-- start content -->

    <!-- <section class="konten">

        <div class="wrapper-kategori">
            <div class="judul">
                Kategori Produk
            </div>

            
            <div class="col">
            <?php $ambil = $koneksi->query("SELECT * FROM tb_kategori"); ?>
                <?php while ( $k = $ambil->fetch_assoc()){ ?>
                
                    <a href="hasil_kategori.php?id=<?= $k['idk']; ?>"><?= $k['nama_kategori'] ?></a>
            
                <?php } ?>
            </div>
        </div>
    </section> -->

    <section id="kategori" class="my-1 pb-1 ktg">
        <div class="container mt-5 mb-5">
            <table border="1px" class="table table-bordered">
                <tr><?php $ambil = $koneksi->query("SELECT * FROM tb_kategori"); ?>
                    <?php while ( $k = $ambil->fetch_assoc()){ ?>
                        <th class="text-center text-capitalize">
                            <a href="hasil_kategori.php?id=<?= $k['idk']; ?>"><?= $k['nama_kategori'] ?></a>
                        </th>
                    <?php } ?>
                </tr>
            </table>
        </div>
    </section>
    
    <!-- finish content -->

    <!-- footer -->
    <?php
    require_once'tamplates/footer.php';
    ?>
    <!-- footer end -->
</body>
</html>