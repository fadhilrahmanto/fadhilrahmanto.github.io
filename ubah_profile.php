<?php
session_start();
require_once "koneksi.php";

$idu = $_GET['id'];

$ambil = $koneksi->query("SELECT * FROM users WHERE id_user=$idu");
$profile = $ambil->fetch_assoc();

// echo "<pre>";
// print_r($_SESSION['user']['image']);
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


    <section id="u-profile" class=""my-1 pb-1">
        <div class="container text-capitalize mt-5 mb-5">
            <form  action="" method="post" enctype="multipart/form-data">
                <div class="form-group ">
                    <label for="nama">Nama</label>
                    <input type="text" name="nama" class="form-control" value="<?= $profile['name'] ?>">
                </div>

                <div class="form-group">
                    <label for="telp">No. Handphone</label>
                    <input type="number" name="telp" class="form-control" value="<?= $profile['telp'] ?>">
                </div>

                <div class="form-group mt-3 ">
                    <select class="form-control" name="jns_kelamin" id="">
                        <option value="">--Pilih Jenis Kelamin--</option>
                        <option value="Laki-Laki" <?= $profile['jns_kelamin']=="Laki-Laki"?"selected":"" ?>>Laki-Laki</option>
                        <option value="Perempuan" <?= $profile['jns_kelamin']=="Perempuan"?"selected":"" ?>>Perempuan</option>
                    </select>
                </div>

                <div class="form-group mt-1">
                    <label for="alamat">alamat lengkap (kode pos)</label>
                    <textarea name="alamat" id="alamat" class="form-control" cols="30" rows="10"><?= $profile['alamat'] ?></textarea>
                </div>

                <div class="form-group mt-3">
                    <button type="submit" class="btn btn-primary" name="ubah">UBAH</button>
                </div>
            </form>
        </div>



        <?php

        if(isset($_POST['ubah'])){
            $nama = $_POST['nama'];
            $telp = $_POST['telp'];
            $tgl_lahir = date($_POST['thl_lahir']);
            $jens_kelamin = $_POST['jns_kelamin'];
            $alamat = $_POST['alamat'];

            $koneksi->query("UPDATE users SET 
							name='$nama',
							telp='$telp', 
							tgl_lahir='$tgl_lahir',
							jns_kelamin='$jens_kelamin',
							alamat='$alamat'
							WHERE id_user=$idu");
                
                echo "<script>alert('data profile telah berhasil diubah');</script>";
                echo "<script>location='profile.php';</script>";
        }
        
        ?>






    </section>
    <?php require_once "tamplates/footer.php";  ?>
</body>
</html>
