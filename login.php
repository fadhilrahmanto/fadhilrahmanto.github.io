<?php 
session_start();
//koneksi database
require_once 'koneksi.php';



	
	date_default_timezone_set("Asia/Bangkok");
	$timenow = date("j-F-Y-h:i:s A");

		if(isset($_POST['login']))
		{
            $email = mysqli_real_escape_string($koneksi,$_POST['email']);
            $pass = mysqli_real_escape_string($koneksi,$_POST['password']);

            $sql = "SELECT * FROM users where email = '$email'";
            $query = mysqli_query($koneksi,$sql);

            if(mysqli_num_rows($query) == 0 ){
                echo "<script>alert('EMAIL TIDAK DITEMUKAN');</script>";
                echo "<script>location='login.php';</script>";
            }else {
                $user = mysqli_fetch_assoc($query);
                if(password_verify($pass,$user['password'])){
                    if($user['is_verifed']==1){
                        $_SESSION['isLogin'] = true;
                        $_SESSION['user'] = $user;
                        echo "<script>alert('ANDA BERHASIL LOGIN');</script>";
            
                        if (isset($_SESSION['keranjang']) OR !empty($_SESSION['keranjang'])) 
                        {
                            echo "<script> location='checkout.php'; </script>";
                        }
                        else
                        {
                            echo "<script> location='index.php'; </script>";
                        }
                    }else {
                        echo "<script>alert('Silahkan Verifikasi Email Terlebih Dahulu');</script>";
                        echo "<script>location='login.php';</script>";
                    }
                }else {
                    echo "<script>alert('Email/Password salah');</script>";
                    echo "<script>location='login.php';</script>";
                }
            }
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
    <link rel="stylesheet" href="style.css">

    <Style>
        
    </Style>

    <title>UMKM CILEDUG PRIMA</title>
</head>

<body>
    <?php require_once "tamplates/navigation.php" ;?>
    
    <!-- start sub-navigation -->
    <nav class="sub-nav mt-5 ">
        <div class="wrapper-sub-nav ">
            <a href=" ">home</a> / 
            <a href=" ">login</a> / 
            <a href=" "></a>
        </div>
    </nav>
    <!-- finish sub-navigation -->

    <!-- start content -->
    <section class="konten">
        <div class="container-login ">
            <h1>Login</h1>

            <div class="masuk">
                <form method="post">
                    <div>
                        <label for="email">Email</label><br>
                        <input type="input" name="email" id="email" placeholder="contoh123@gmail.com"><br>
                    </div>

                    <div>
                        <label for="password">Password</label><br>
                        <input type="password" name="password" id="password"><br>
                    </div>
                    <button name="login">Masuk</button>
                </form>
            </div>
            <div class="daftar">
                <p> 
                    Anda Lupa Password?<i><a href="lupa-password.php ">Lupa Password </a></i> &nbsp;&nbsp; 
                    Belum memiliki akun?<i><a href="buat-akun.php ">Daftar Sekarang </a></i>
                </p>
                
            </div>
            </div>
        </div>
    </section>
    
    <!-- finish content -->
    
    <!-- footer -->
    <?php
    require_once'tamplates/footer.php';
    ?>
    <!-- footer end -->
<!-- 
    <script type = "text/javascript " >
        const password = document.getElementById('password');
        const toggle = document.getElementById('toggle');

    function showHide() {
        if (password.type === 'password') {
            password.setAttribute('type', 'text');
            toggle.classList.add('hide')
        } else {
            password.setAttribute('type', 'password');
            toggle.classList.remove('hide')
        }
    } 
    </script> -->