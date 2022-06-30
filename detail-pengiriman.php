<?php 
    session_start();
    include 'koneksi.php';


    

    $id_user = $_SESSION['user']['id_user'];
    $id_transaksi = $_GET['id'];
    
		$ambil = $koneksi->query("SELECT * FROM pembelian JOIN users 
                                    ON pembelian.id_user=users.id_user 
                                    WHERE pembelian.id_pembelian=$id_transaksi");
		$detail = $ambil->fetch_assoc();
		?>
		<!-- DATA ORANG YG LOGIN  -->
		<!-- <pre><?php print_r($detail); ?></pre> -->

		<!-- data orang yg beli  -->
		<!-- <pre><?php print_r($_SESSION) ?></pre  -->

		<!-- jika pelanggan yg beli, tidak sama dengan pelanggan yg login
        maka dilempar ke index.php krena dia tidak berhak melihat transaksi org lain -->
		<!-- pelanggan yg beli harus pelanggan yg login -->
		<?php 
		    //mendapatkan id pelanggan
		    $pelangganygbeli = $detail['id_user'];

			//mendapatkan id pelanggan yg login
			$pelangganyglogin = $_SESSION["user"]['id_user'];
			if ($pelangganygbeli!==$pelangganyglogin) 
			{
				echo "<script>alert('Mau Ngapain Lu?!');</script>";
				echo "<script>location ='index.php'; </script>";
				exit();
			}

            echo"<pre>";
                        // print_r($arrayTrack);
                        // print_r($detail['ekspedisi']);
                        // print_r($detail['resi_pengiriman']);
                        // print_r($history);
            echo"</pre>";
		


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

    <title>UMKM CILEDUG PRIMA || DETAIL PENGIRIMAN </title>
</head>

<body>
    <?php require_once "tamplates/navigation.php" ;?>


    

            <?php
                $resi = $detail['resi_pengiriman'];
                $kurir = $detail['ekspedisi'];

                $curl = curl_init();
                curl_setopt_array($curl, array(
                    CURLOPT_URL => "https://api.binderbyte.com/v1/track?api_key=a41d0daa885554afa669e6cc211c975996d781e03431caa458d2981deb799080&courier=$kurir&awb=$resi",
                    CURLOPT_SSL_VERIFYHOST => false,
                    CURLOPT_SSL_VERIFYPEER => false,
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => '',
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => 'GET',
                ));
                $response = curl_exec($curl);
                $err = curl_error($curl);
                curl_close($curl);
                

                if ($err) {
                echo "cURL Error #:" . $err;
                } else {

                    $arrayTrack = json_decode($response, true);
                    $tracking = $arrayTrack['data']['summary'];
                    $detail = $arrayTrack['data']['detail'];
                    $history = $arrayTrack['data']['history'];

                    $kurir = $tracking['courier'];
                    $resi = $tracking['awb'];
                    $servis = $tracking['service'];

                    echo "
                        <section class='transaksi mt-5'>
                            <div class='container'>
                                <h4>Detail Pengiriman</h4>
                                <h5>Kurir : $kurir<br>No Resi : $resi <br> Service : $servis</h5>
                                <table class='table table-bordered' border='1' cellpadding='5' cellspacing='0'>
                                    <tr>
                                        <th>Manifest Date</th>
                                        <th>Description</th>
                                    </tr>
                            </div>
                        </section>
                    ";

                    foreach($history as $val)
                    {
                        echo "	
                            <tr>
                                <td>$val[date]</td>
                                <td>$val[desc]</td>
                            </tr>
                        ";
                    }
                }
            ?>



    

    