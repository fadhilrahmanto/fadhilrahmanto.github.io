<?php
    require_once "koneksi.php";

    $code = $_GET['code'];
    // echo"<pre>";
    // print_r($code);
    // "</pre>";
    

    if(isset($_GET['code'])){
        $sql = "SELECT * FROM users WHERE verif_code='$code'";
        $query = mysqli_query($koneksi,$sql);

        if(mysqli_num_rows($query) > 0){

            $user = mysqli_fetch_assoc($query);

            // echo"<pre>";
            // print_r($user);
            // "</pre>";

            $id = $user['id_user'];
            $sql =  "UPDATE users SET is_verifed=1 WHERE id_user='$id'";
            $query = mysqli_query($koneksi,$sql);
            if($query){
                echo "<script>alert('VERIFIKASI BERHASIL');</script>";
                echo "<script>location='login.php';</script>";
            }else{
                echo "VERIFIKASI GAGAL ERROR : ".$query;
            }
        }else {
            echo "CODE TIDAK DITEMUKAN ATAU TIDAK VALID";
        }
    }else {
        echo "code ga nih";
    }

        

?>