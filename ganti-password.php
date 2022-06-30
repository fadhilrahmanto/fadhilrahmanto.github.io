<?php

require_once "koneksi.php";

$email = $_GET['email'];

// $ambil = $koneksi->query("SELECT * FROM users WHERE id_user=$id_user");
// $pecah = $ambil->fetch_assoc();

// echo"<pre>";
// print_r($email);
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
    <link rel="stylesheet" href="style.css">

    <Style>
        
    </Style>

    <title>UMKM CILEDUG PRIMA || GANTI PASSWORD</title>
</head>

<body>
    <?php require_once "tamplates/navigation.php" ;?>

    <!-- start content -->
    <section class="konten">
        <div class="container-login ">
            <h1>Ganti Password</h1>

            <div class="masuk">
                <form method="post">
                    <div>
                        <label for="email">Email</label><br>
                        <input type="input" name="email" id="email" readonly value="<?= $email; ?>"><br>
                    </div>
                    <div>
                        <label for="password1">Password Baru</label><br>
                        <input type="password" name="password1" id="password1"><br>
                    </div>
                    <div>
                        <label for="password2">Pencocokan Password Baru</label><br>
                        <input type="password" name="password2" id="password2"><br>
                    </div>

                    <button name="change">Ganti Password</button>
                </form>
            </div>
            <!-- <div class="daftar">
                <p> 
                    Anda Lupa Password?<i><a href="lupa-password.php ">Lupa Password </a></i> &nbsp;&nbsp; 
                    Belum memiliki akun?<i><a href="buat-akun.php ">Daftar Sekarang </a></i>
                </p>
                
            </div> -->
            </div>
        </div>
    </section>

    <?php

        if(isset($_POST['change'])){
            $emails = $_POST['email'];
            $pass1 = $_POST['password1'];
            $pass2 = $_POST['password2'];
            $code = $_GET['code'];
            $id_user = $_GET['id'];

            //cek pass sama apa kaga
            if ($pass1!==$pass2) {
                echo "
                    <script>
                        alert('password tidak sama');
                    </script>";
                
            }  else {

            //enkripsi pass
            $pass = password_hash($pass1, PASSWORD_DEFAULT);

            $koneksi->query("UPDATE users SET PASSWORD='$pass', verif_code='$code' WHERE id_user='$id_user' ");

            echo "<script>alert('Selamat, anda berhasil mengganti password. silahkan login !');</script>";
                    echo "<script>location='login.php';</script>";
        }
    }

    ?>



</body>
</html>
