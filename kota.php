<?php

    $curl = curl_init();
    $idprov = $_POST['id_provinsi'];
    curl_setopt_array($curl, array(
    CURLOPT_URL => "https://api.rajaongkir.com/starter/city?province=$idprov",
    CURLOPT_SSL_VERIFYHOST => false,
    CURLOPT_SSL_VERIFYPEER => false,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_HTTPHEADER => array(
        "key: 2303a8b7ffe44a0e107e317d80d5ec59"
    ),
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
    echo "cURL Error #:" . $err;
    } else {
        $array_kota = json_decode($response, true);
        $kota = $array_kota['rajaongkir']['results'];
        
        echo"<option value=''>--Pilih Kota/Kabupaten--</option>";
        foreach ($kota as $key => $k) {
            echo"<option value=''
                    id_kota='".$k["city_id"]."'
                    id_provinsi='".$k["province_id"]."'
                    nm_provinsi='".$k["province"]."'
                    nm_kota='".$k["city_name"]."'
                    tipe='".$k["type"]."'
                    kd_pos='".$k["postal_code"]."'
                    >";
            echo $k["type"]." ";
            echo $k["city_name"];
            echo"</option>";
        }

        // echo"<pre>";
        // print_r($kota);
        // "</pre>";
    }