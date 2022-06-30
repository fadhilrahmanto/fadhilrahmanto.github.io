<?php 
session_start();
//koneksi database
require_once 'koneksi.php';

require_once "functions/class_paging.php";
// memanggil class paging
$pg = new PagingGoogle;
// batasi tampilan
$limit = 8;
$position = $pg->searchPosition($limit);

$kunci = $_POST['search'];
$semua_data=array();
$ambil = $koneksi->query("SELECT * FROM tb_produk WHERE nama_produk LIKE '%$kunci%' OR deskripsi_produk LIKE '%$kunci%' LIMIT $position,$limit ");
while ($pecah = $ambil->fetch_assoc()) 
{
	$semua_data[]=$pecah;
}


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
    <!-- <link rel="stylesheet" href="style.css"> -->

    <title>UMKM CILEDUG PRIMA || HASIL PENCARIAN</title>
</head>

<body>
    <?php require_once "tamplates/navigation.php" ;?>

    <!-- start content -->

    <section id="featured" class="my-1 pb-1">
        <div class="container text-center mt-1 py-5">

        <h3>Hasil Pencarian : <?= $kunci; ?></h3>
        <?php if (empty($semua_data)) : ?>
            <div class="alert alert-danger"> Produk <strong><?php echo $kunci; ?></strong> Tidak Ditemukan</div>
        <?php endif ?>
        <hr>

        
            <!-- <h3>Our Featured</h3> -->
            

        <div class="row">
        <?php foreach ($semua_data as $p): ?>
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
            <?php endforeach; ?>
        </div>

        <div class="lainnya mt-5">
            <div class="container">
                <?php
                    $queryJmlData = "SELECT * FROM tb_produk WHERE nama_produk LIKE '%$kunci%' OR deskripsi_produk LIKE '%$kunci%'";
                    $sqlJmlData = mysqli_query($koneksi, $queryJmlData);
                    $numsJmlData = mysqli_num_rows($sqlJmlData);
                        
                    $jmlhalaman = $pg->totalPage($numsJmlData, $limit);
                    $pageLink = $pg->navPage($_GET['page'], $jmlhalaman);
                    
                    echo "$pageLink";
                ?>
            </div>
        </div>
    </section>

    <!-- finish content -->


    <!-- footer -->
    <?php
    require_once'tamplates/footer.php';
    ?>
    <!-- footer end -->