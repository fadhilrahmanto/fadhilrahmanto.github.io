


<?php
    require_once("koneksi.php");

    $data_bank = array();

    $ambil = $koneksi->query("SELECT * FROM bank");
    while($bank = $ambil->fetch_assoc()){
        $data_bank[] = $bank;
    }


    // $provinsi = $data_bank['']['results'];

    echo"<pre>";
        print_r($data_bank);
        echo"</pre>";
	

    



?>
        
            <option value="">--Pilih Metode Pembayaran--</option>
			<?php foreach ($data_bank as $key => $b) : ?>

			<option value=""
                    id_payment="<?= $b['id_payment']; ?>"
                    metode="<?= $b['metode']; ?>"
                    norek="<?= $b['norek']; ?>"
                    atas_nama="<?= $b['atas_nama']; ?>"
                >
            <?= $b['metode'] ?>
            </option>

			<?php endforeach; ?>
	
            