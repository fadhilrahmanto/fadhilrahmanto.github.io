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

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="assets/bootstrap/js/jquery-1.10.2.js"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->