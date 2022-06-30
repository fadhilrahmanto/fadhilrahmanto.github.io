

    <?php
        session_start();

        


        //koneksi database
        require_once 'koneksi.php';

        $idp = $_GET['id'];

        $fotoproduk=array();
        $foto=$koneksi->query("SELECT * FROM foto_produk WHERE idp=$idp");
        while($fp=$foto->fetch_assoc()){
            $fotoproduk[] = $fp;
        }

        $videoproduk=array();
        $video=$koneksi->query("SELECT * FROM video_produk WHERE idp=$idp LIMIT 1");
        while($vp=$video->fetch_assoc()){
            $videoproduk[] = $vp;
        }

        // echo "<pre>";
        // print_r($videoproduk);
        // "</pre>";
        
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
            <style>
                .small-img-group{
                    display: flex;
                    justify-content: space-between;
                }

                .small-img-col{
                    flex-basis: 24%;
                    cursor: pointer;
                    gap: 10px;
                }
                .sproduct select{
                    display: block;
                    padding: 5px 10px;
                }

                .sproduct input{
                    width: 50px;
                    height: 40px;
                    padding-left: 10px;
                    font-size: 16px;
                    margin-right: 10px;
                }

                .sproduct input:focus{
                    outline: none;
                }

                .buy-btn{
                    background: #fba;
                    opacity: 1;
                    transform: 0.5s all;
                }

                .btn-video video{
                    width: 110px;
                }

            </style>

            <title>UMKM CILEDUG PRIMA || DETAIL PRODUK</title>
        </head>
    <body>
        <?php require_once "tamplates/navigation.php" ;?>

            <section class="container sproduct my-5 pt-5">
                <div class="row">
                    <?php $ambil = $koneksi->query("SELECT * FROM tb_produk WHERE idp =$idp"); ?>
                    <?php while ( $dp = $ambil->fetch_assoc()){ ?>
                    <div class="col-lg-5 col-md-12 col-12">
                        <img class="img-fluid mb-3 p-1" width="100%" src="assets/img/produk/<?= $dp['gambar_produk'] ?>" id="MainImg" alt="">

                        <div class="small-img-group mt-2 my-2">
                            <?php foreach ($fotoproduk as $key => $f) : ?>
                            <div class="small-img-col">
                                <img width="100%" class="small-img" src="assets/img/produk/<?= $f['foto_produk'] ?>" alt="">
                            </div>
                            <?php endforeach; ?>
                            
                            <div class="small-img-col">
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-video" data-toggle="modal" data-target="#exampleModal">
                                    <?php foreach ($videoproduk as $key => $v) : ?>
                                        <video width="100%" src="assets/video/produk/<?= $v['nama_video'] ?>"></video>
                                    <?php endforeach; ?>
                                </button>
                            </div>
                        </div>
                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel"></h5>
                                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">X</button>
                            </div>
                            <div class="modal-body">
                                    <?php foreach ($videoproduk as $key => $v) : ?>
                                        <video width="100%" src="assets/video/produk/<?= $v['nama_video'] ?>" controls></video>
                                    <?php endforeach; ?>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                
                            </div>
                            </div>
                        </div>
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-12 col-12">
                        <?php $idk = $dp['idk']; ?>
                        <?php $ambil = $koneksi->query("SELECT * FROM tb_kategori WHERE idk = $idk"); ?>
                        <?php while ( $kat = $ambil->fetch_assoc()){ ?>
                        <h6><a href="index.php">Home</a>/<?= $kat['nama_kategori'] ?></h6>
                        <?php } ?>
                        <h2 class="py-2"><?= $dp['nama_produk'] ?></h2>
                        <h3>Rp <?= number_format($dp['harga_produk']) ?></h3>
                        <!-- form kalau ada yang mau beli -->
                        <form method="post">
                        <h4>catatan</h4>
                        <textarea name="catatan" id=""  rows="3" class="form-control mb-2"></textarea><br>
                        <p>stok Produk : <?= $dp['stok_produk'] ?></p>
                        <input type="number" value="1"  min="1" max="<?= $dp['stok_produk'] ?>" name="jumlah">

                        <button name="beli" class="btn buy-btn">Add To Chart</button>
                        </form>
                        <!-- selesai form -->
                        <hr class="mx-auto">
                        <h4 class="mt-2 mb-1">Product Description</h4>
                        <span>
                            <?= $dp['deskripsi_produk'] ?>
                        </span>
                        <hr class="mx-auto">
                        <!-- <h4 class="mt-2">Rating Product</h4>
                        <span>
                            Lorem ipsum dolor sit amet consectetur, adipisicing elit.
                            In excepturi nisi corrupti esse ipsum deserunt velit,
                            optio neque? Ex illum labore sint eius molestias maiores necessitatibus officia ducimus expedita in?
                        </span> -->
                    </div>
                    <?php } ?>
                </div>
            </section>

            
        <?php 
            //jika da tombol beli
            if (isset($_POST['beli'])) {
                //mendapatkan jumlah produk yg di beli
                $jumlah = $_POST['jumlah'];
                // mendapatkan catatan pesanan pembeli
                $catatan = $_POST['catatan'];
                //masukan ke keranjang
                $_SESSION['keranjang'][$idp] += $jumlah;
                $_SESSION['catatan'][$idp] = $catatan;

                echo"<script>alert('Produk sudah dimasukan ke keranjang');</script>";
                echo"<script>location='keranjang.php';</script>";
            }
        ?>
        

            <script>
                
                var ProductImg = document.getElementById("MainImg");
                var SmallImg = document.getElementsByClassName("small-img");


                SmallImg[0].onclick = function() {
                    MainImg.src = SmallImg[0].src;
                }
                SmallImg[1].onclick = function() {
                    MainImg.src = SmallImg[1].src;
                }
                SmallImg[2].onclick = function() {
                    MainImg.src = SmallImg[2].src;
                }
                SmallImg[3].onclick = function() {
                    MainImg.src = SmallImg[3].src;
                }
                SmallImg[4].onclick = function() {
                    MainImg.src = SmallImg[4].src;
                }
                SmallImg[5].onclick = function() {
                    MainImg.src = SmallImg[5].src;
                }
                SmallImg[6].onclick = function() {
                    MainImg.src = SmallImg[2].src;
                }
            </script>

<?php

    // require_once "../koneksi.php";

     $ambil = $koneksi->query("SELECT * FROM tb_kategori LIMIT 5"); 

    
     $queryAkun = $koneksi->query("SELECT * FROM users WHERE id_user=235");
    $akun = $queryAkun->fetch_assoc();

?>

<footer class="my-3 py-3">
        <div class="row container mx-auto pt-5 ">

            <div class="footer-one col-lg-3 col-md-6 col-12 mb-4">
                <img width="50%" class="rounded" src="assets/img/profile/<?= $akun['image'] ?>" alt="">
                <!-- <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Velit, deserunt?</p> -->
            </div>

            <div class="footer-one col-lg-3 col-md-6 col-12 mb-2">
                <h5 class="pb-2">Kategori</h5>
                <ul class="text-uppercase list-unstyled">
                <?php while ( $k = $ambil->fetch_assoc()){ ?>
                    <li><a href="hasil_kategori.php?id=<?= $k['idk']; ?>"><?= $k['nama_kategori'] ?></a></li>
                <?php } ?>
                    
                </ul>
            </div>

            <div class="footer-one col-lg-3 col-md-6 col-12">
                <h5 class="pb-2">Contact Us</h5>
                <div>
                    <h6 class="text-uppercase" >Alamat</h6>
                    <p><?= $akun['alamat'] ?></p>
                </div>
                <div>
                    <h6 class="text-uppercase" >Email</h6>
                    <p><?= $akun['email'] ?></p>
                </div>
                <div>
                    <h6 class="text-uppercase" >Telp</h6>
                    <p><?= $akun['telp'] ?></p>
                </div>
            </div>
        </div>

        <div class="copyright mt-5">
            <div class="container">
                <p class="text-center"><?= $akun['name'] ?> © <?= date('Y') ?> All Rights Reserved</p>
            </div>
        </div>
    </footer>

            <!-- Optional JavaScript; choose one of the two! -->

            <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
            <script src="bootstrap/js/jquery-1.10.2.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>

            <!-- Option 2: Separate Popper and Bootstrap JS -->
            <!--
            <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
            <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js" integrity="sha384-VHvPCCyXqtD5DqJeNxl2dtTyhF78xXNXdkwX1CZeRusQfRKp+tA7hAShOK/B/fQ2" crossorigin="anonymous"></script>
            -->
        </body>
        </html>
