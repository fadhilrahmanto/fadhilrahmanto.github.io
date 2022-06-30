<?php

    $curl = curl_init();

    

    curl_setopt_array($curl, array(
    CURLOPT_URL => "https://api.rajaongkir.com/starter/province",
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
    $array_provinsi = json_decode($response, true);
    $provinsi = $array_provinsi['rajaongkir']['results'];
	

    echo"<option value=''>--Pilih Provinsi--</option>";
    foreach ($provinsi as $key => $p) {
        echo"<option value='".$p["province_id"]."' id_provinsi='".$p["province_id"]."'>";
        echo $p['province'];
        echo"</option>";
        }
    }