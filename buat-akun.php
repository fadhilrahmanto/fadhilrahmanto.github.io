    <?php

        require_once "koneksi.php";
    

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

    <title>UMKM CILEDUG PRIMA || BUAT AKUN</title>
</head>

<body>
    <?php require_once "tamplates/navigation.php" ;?>
        
        
        <!-- start sub-navigation -->
        <nav class="sub-nav mt-5">
            <div class="wrapper-sub-nav ">
                <a href="index.html ">home</a> / 
                <a href="buat-akun.php">Buat Akun</a> / 
                <a href=" "></a>
            </div>
        </nav>
        <!-- finish sub-navigation -->
        <!-- start content -->
        <section class="login ">
            <div class="container-login ">
                <h1>buat akun</h1>

                <div class="masuk ">
                    <form method="post">
                        <div>
                            <label>Nama</label><br>
                            <input type="text" name="nama" 
                            id="nama" placeholder="nama lengkap " required><br>
                        </div>

                        <div>
                            <label>Email</label><br>
                            <input type="text" name="email" id="email" placeholder="contoh123@gmail.com" required><br>
                        </div>
                        <div>
                            <label>No. Handphone</label><br>
                            <input type="text" name="telp" 
                            id="telp" placeholder="0851000000 " required><br>
                        </div>

                        <div>
                            <label>alamat</label><br>
                            <textarea name="alamat" id="alamat" class="form-control" cols="30" rows="10" required></textarea>
                        </div>

                        <div>
                            <label>Password</label><br>
                            <input type="password" name="password1" 
                            id="password" placeholder="Masukan Password... "><br>
                        </div>

                        <div>
                            <label>Pencocokan Password</label><br>
                            <input type="password" name="password2" 
                            id="password" placeholder="Masukan Password... "><br>
                        </div>
                        <button name="daftar">Daftar</button>
                    </form>
                </div>
                <div class="daftar">
                    <p> sudah memiliki akun?<i><a href="login.php ">Masuk sekarang</a></i> </p>
                </div>
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
            if (isset($_POST["daftar"])) 
            {
                //mengambil isian (nama,email,no hp,alamat)
                $nama = $_POST['nama'];
                $email = $_POST['email'];
                $telp = $_POST['telp'];
                $alamat = $_POST['alamat'];
                $pass1 = $_POST['password1'];
                $pass2 = $_POST['password2'];
                
                $code = md5($email.date('Y-m-d'));

                //CEK KETERSEDIAAN EMAIL
                $ambil = $koneksi->query("SELECT * FROM users WHERE email='$email'");
                $ygcocok = $ambil->num_rows;
                if ($ygcocok==1)
                {
                    echo"<script>alert('Pendaftaran Gagal! Email Sudah Digunakan!');</script>";
                    return false;
                }

                //cek pass sama apa kaga
                if ($pass1!==$pass2) {
                    echo "
                        <script>
                            alert('password tidak sama');
                        </script>";
                    return false;
                }

                //enkripsi pass
                $pass = password_hash($pass1, PASSWORD_DEFAULT);


                $koneksi->query("INSERT INTO users
                                (id_user,NAME,email,PASSWORD,telp,alamat,verif_code)
                                VALUES
                                ('','$nama','$email','$pass','$telp','$alamat','$code')");
                
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
                $mail->setFrom('no-reply@umkmciledugprima.com', 'UMKM CILEDUG PRIMA');

                //Set an alternative reply-to address
                //$mail->addReplyTo('replyto@example.com', 'First Last');

                //Set who the message is to be sent to
                $mail->addAddress($email, $nama);

                //Set the subject line
                $mail->Subject = 'Verification Account - umkmciledugprima.com';

                //Read an HTML message body from an external file, convert referenced images to embedded,
                //convert HTML into a basic plain-text alternative body
                $body = "Hi, ".$nama."<br>You received this message because you have just signed up for a CILEDUG PRIMA MSME account.<br>
                                Confirm your email address with the Code below. This step adds extra security to your business by verifying
                                You are the owner of this email. :
                            <br> http://localhost/umkm-ciledug-prima/confirmEmail.php?code=".$code;
                $mail->Body = $body;
                //Replace the plain text body with one created manually
                $mail->AltBody = 'Verification Account';

                //send the message, check for errors
                if (!$mail->send()) {
                    echo 'Mailer Error: '. $mail->ErrorInfo;
                } else {
                    echo "<script>alert('Register sukses silahkan login !');</script>";
                    echo "<script>location='login.php';</script>";
                    // echo 'Register sukses silahkan login !';
                    //Section 2: IMAP
                    //Uncomment these to save your message in the 'Sent Mail' folder.
                    #if (save_mail($mail)) {
                    #    echo "Message saved!";
                    #}
                }
        }
            
        ?>

        <!-- footer -->
        <?php
        require_once'tamplates/footer.php';
        ?>
        <!-- footer end -->