<?php

    $ekspedisi = $_POST['ekspedisi'];
    $kota = $_POST['kota'];
    $berat = $_POST['berat'];
    $curl = curl_init();
    

    curl_setopt_array($curl, array(
    CURLOPT_URL => "https://api.rajaongkir.com/starter/cost",
    CURLOPT_SSL_VERIFYHOST => false,
    CURLOPT_SSL_VERIFYPEER => false,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_POSTFIELDS => "origin=457&destination=".$kota."&weight=".$berat."&courier=".$ekspedisi."",
    CURLOPT_HTTPHEADER => array(
        "content-type: application/x-www-form-urlencoded",
        "key: 2303a8b7ffe44a0e107e317d80d5ec59"
    ),
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
    echo "cURL Error #:" . $err;
    } else {
        $array_harga = json_decode($response, true);
        $harga = $array_harga['rajaongkir']['results']['0']['costs'];

        // echo"<pre>";
        // print_r($harga);
        // "</pre>";
        // ." "."(".$h['description'].")"

        echo"<option value=''>--Pilih Service Pengiriman--</option>";
        foreach ($harga as $key => $h) {
            echo"<option value=''
                    service='".$h["service"]."'
                    harga='".$h['cost']['0']['value']."'
                    estimasi_sampai='".$h['cost']['0']['etd']."'
                    >";

            echo $h['service']." ";
            echo "Rp".number_format($h['cost']['0']['value'])." ";
            echo$h['cost']['0']['etd']."Hari";
            
            echo"</option>";
        }
    }