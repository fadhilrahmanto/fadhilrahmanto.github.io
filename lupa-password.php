<?php

require_once "koneksi.php";



// echo"<pre>";
// print_r($pecah['id_user']);
// "</pre>";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UMKM Ciledug Prima</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@200;400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <!-- start header & navigation -->
    <?php require_once 'tamplates/header.php';?>
    <?php require_once 'tamplates/navigation.php'; ?>
    <!-- finish header & navigation -->
    
    <!-- start sub-navigation -->
    <nav class="sub-nav ">
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
            <h1>Lupa Password</h1>

            <div class="masuk">
                <form method="post">
                    <div>
                        <label for="email">Email</label><br>
                        <input type="input" name="email" id="email" placeholder="contoh123@gmail.com"><br>
                    </div>

                    <button name="reset">Reset Password</button>
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
        use PHPMailer\PHPMailer\PHPMailer;
        use PHPMailer\PHPMailer\SMTP;
        
        // include library phpmailer
        require 'assets/PHPMailer/src/Exception.php';
        require 'assets/PHPMailer/src/OAuth.php';
        require 'assets/PHPMailer/src/PHPMailer.php';
        require 'assets/PHPMailer/src/POP3.php';
        require 'assets/PHPMailer/src/SMTP.php';

        //jika ada tombol daftar
        if (isset($_POST["reset"])) 
        {
            //mengambil isian (email)
            $email = mysqli_real_escape_string($koneksi,$_POST['email']);
            $code = md5($email.date('Y-m-d'));


            // ambil id user
            $ambil = $koneksi->query("SELECT * FROM users WHERE email='$email'");
            $pecah = $ambil->fetch_assoc();
            $id = $pecah['id_user'];
            // selesai ambil id
            


            $sql = "SELECT * FROM users where email = '$email'";
            $query = mysqli_query($koneksi,$sql);
            if(mysqli_num_rows($query) == 0 ){
                
                echo "<script>alert('EMAIL TIDAK DITEMUKAN');</script>";
                echo "<script>location='lupa-password.php';</script>";
            } else {
                //Create a new PHPMailer instance
                $mail = new PHPMailer;

                //Tell PHPMailer to use SMTP
                $mail->isSMTP();

                //Enable SMTP debugging
                // SMTP::DEBUG_OFF = off (for production use)
                // SMTP::DEBUG_CLIENT = client messages
                // SMTP::DEBUG_SERVER = client and server messages
                $mail->SMTPDebug = SMTP::DEBUG_SERVER;

                //Set the hostname of the mail server
                $mail->Host = 'ssl://smtp.gmail.com';
                // use
                // $mail->Host = gethostbyname('smtp.gmail.com');
                // if your network does not support SMTP over IPv6

                //Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
                $mail->Port = 465;

                //Set the encryption mechanism to use - STARTTLS or SMTPS
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;

                //Whether to use SMTP authentication
                $mail->SMTPAuth = true;

                //Username to use for SMTP authentication - use full email address for gmail
                $mail->Username = 'umkmciledugprima13@gmail.com';

                //Password to use for SMTP authentication
                $mail->Password = 'Umkmciledug13';

                //Set who the message is to be sent from
                $mail->setFrom('no-reply@umkmciledugprima.com', 'Customer Service');

                //Set an alternative reply-to address
                //$mail->addReplyTo('replyto@example.com', 'First Last');

                //Set who the message is to be sent to
                $mail->addAddress($email);

                //Set the subject line
                $mail->Subject = 'Reset Password - umkmciledugprima.com';

                //Read an HTML message body from an external file, convert referenced images to embedded,
                //convert HTML into a basic plain-text alternative body
                $body = "Klik link dibawah ini untuk ganti password :
                            <br> http://localhost/umkm-ciledug-prima/ganti-password.php?email=".$email."&id=".$id."&code=".$code;
                $mail->Body = $body;
                //Replace the plain text body with one created manually
                $mail->AltBody = 'Reset Password';

                //send the message, check for errors
                if (!$mail->send()) {
                    echo 'Mailer Error: '. $mail->ErrorInfo;
                } else {
                    echo "<script>alert('Silahkan Cek Email anda !');</script>";
                    echo "<script>location='lupa-password.php';</script>";
                    // echo 'Silahkan Cek Email anda !';
                    
                    // echo "<script>location='login.php';</script>";
                    //Section 2: IMAP
                    //Uncomment these to save your message in the 'Sent Mail' folder.
                    #if (save_mail($mail)) {
                    #    echo "Message saved!";
                    #}
                }
            }
        }



    ?>









    
    <!-- finish content -->
    
    <!-- footer -->
    <?php
    require_once'tamplates/footer.php';
    ?>
    <!-- footer end -->


