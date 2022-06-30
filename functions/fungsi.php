<?php 

    $koneksi = mysqli_connect("localhost","root","","umkm_ciledug");
    if (mysqli_connect_errno()) {
        echo "Gagal Koneksi".mysqli_connect_error();
    }

        
    function query($query){
        global $koneksi;

        $result = mysqli_query($koneksi, $query);
        $rows = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $rows[] = $row;
        }
        return $rows;
    }

    function upload(){
        $size = $_FILES['foto']['size'];
		$namaft = $_FILES['foto']['name'];
		$lokasi = $_FILES['foto']['tmp_name'];
		$error = $_FILES['foto']['error'];

		//cek udah up gambar apa blm
		if ($error ===4) {
			echo "
			<script>alert('pilih gambar dulu');
			</script>";
			return false;
		}

		//cek yg di up gambar apa bukan
		$extensifotovalid = ['jpg','png','jpeg','bmp'];
		$extensifoto = explode(".", $namaft);
		$extensifoto = strtolower(end($extensifoto));
		if (!in_array($extensifoto, $extensifotovalid)) {
			echo "
			<script>alert('Bukan Gambar');
			</script>";
			return false;
		}

		
			//cek ukuran
			if ($size > 1000000) {
				echo "
				<script>alert('UKURAN KEGEDEAN');
				</script>";
				return false;
			}

		
		//generate nama abru
		$namafotobaru = uniqid();
		$namafotobaru .= '.';
		$namafotobaru .= $extensifoto; 

		move_uploaded_file($lokasi, "../assets/img/produk/".$namafotobaru);

        }