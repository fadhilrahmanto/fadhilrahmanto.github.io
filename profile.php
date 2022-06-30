<?php 
session_start();
//koneksi database
require_once 'koneksi.php';

$idu = $_SESSION['user']['id_user'];
// echo "<pre>";
// print_r($_SESSION['user']);
// print_r($_SESSION['user']['id_user']);
// "</pre>";

$ambil = $koneksi->query("SELECT * FROM users  WHERE id_user=$idu");
$profile = $ambil->fetch_assoc();

// echo "<pre>";
// print_r($profile);
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

    <Style>
        
    </Style>

    <title>UMKM CILEDUG PRIMA</title>
</head>

<body>
    <?php require_once "tamplates/navigation.php" ;?>

    <!-- start content -->
    <section id="profile" class="my-1 pb-1">
        <div class="container mt-5">
            <div class="card mb-3">
                <div class="row g-0">
                    
                    <div class="col-md-3">
                        <img src="assets/img/profile/<?= $profile['image'] ?>" class="img-fluid rounded-start" alt="...">
                        <a class="btn btn-primary mt-3" href="ubah_Foto_profile.php?id=<?= $idu ?>">Ubah Foto Profile</a>
                    </div>

                    <div class="col-md-3">
                        <div class="card-body">
                            <h3 class="card-title">Biodata Diri</h3>
                            <p class="card-text"><?= $profile['name'] ?></p>
                            <!-- <p class="card-text">
                                Tanggal Lahir <br>
                                <?= $profile['tgl_lahir']; ?>
                            </p> -->
                            <p class="card-text">
                                Jenis Kelamin <br>
                                <?= $profile['jns_kelamin']; ?>
                        </p>
                            <!-- <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p> -->
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="card-body">
                            <h3 class="card-title">Kontak</h3>
                            <p class="card-text"><?= $profile['email'] ?></p>
                            <p class="card-text"><?= $profile['telp'] ?></p>
                            <!-- <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p> -->
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="card-body">
                            <h3 class="card-title">Alamat</h3>
                            <p class="card-text"><?= $profile['alamat'] ?></p>
                            <!-- <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="lainnya mb-5">
            <div class="container">
                <a class="btn btn-primary" href="ubah_profile.php?id=<?= $idu ?>">Ubah Profile</a>
            </div>
        </div>
    </section>
    <!-- finish content -->



    <!-- footer -->
    <?php
    require_once'tamplates/footer.php';
    ?>
    <!-- footer end -->