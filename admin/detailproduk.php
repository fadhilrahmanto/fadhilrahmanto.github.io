
<?php
    $idp = $_GET['id'];

    $produk = $koneksi->query("SELECT * FROM tb_produk LEFT JOIN tb_kategori 
                                ON tb_produk.idk=tb_kategori.idk
                                WHERE idp=$idp");
    $dp = $produk->fetch_assoc();
    
    

    $fotoproduk=array();
    $foto=$koneksi->query("SELECT * FROM foto_produk WHERE idp=$idp ");
    while($fp=$foto->fetch_assoc()){
        $fotoproduk[] = $fp;
    }

    echo"<pre>";
        // print_r($dp);
        // print_r($fotoproduk);
    echo"</pre>";
?>



    <table class="table">

        <tr>
        <th>Kategori</th>
        <td><?= $dp['nama_kategori'] ?></td>
        </tr>

        <tr>
        <th>Nama</th>
        <td><?= $dp['nama_produk'] ?></td>
        </tr>

        <tr>
        <th>harga</th>
        <td>Rp<?= number_format($dp['harga_produk']); ?></td>
        </tr>

        <tr>
        <th>deskripsi</th>
        <td><?= $dp['deskripsi_produk'] ?></td>
        </tr>

        <tr>
        <th>berat</th>
        <td><?= $dp['berat_produk'] ?>Gr</td>
        </tr>
    </table>

    <div class="row">
        <?php foreach ($fotoproduk as $key => $value) : ?>
        <div class="col-md-3 text-center">
            <img src="../assets/img/produk/<?= $value['foto_produk']; ?>" alt="" width="100%" class="img-responsive">
            <a href="index.php?halaman=hapusfotoproduk&idf=<?= $value['idp_foto'] ?>&idp=<?=$idp?>" class="btn btn-danger mt-2"> Hapus </a>
        </div>
        <?php endforeach; ?>
    </div>
    
    <br>
    <hr>
    
    <form action="" method="POST" enctype="multipart/form-data">

        <div class="form-group">
            <label for="">Tambah Foto Baru</label>
            <input type="file" name="foto">
        </div>
        <button type="submit" class="btn btn-primary" name="simpan" value="simpan" >SIMPAN</button>

    </form>

    <?php
        if (isset($_POST['simpan'])) {
            $lokasi = $_FILES ['foto']['tmp_name'];
            $nmfoto = $_FILES['foto']['name'];

            //generate nama abru
            $namafotobaru = uniqid();
            $namafotobaru .= '.';
            $namafotobaru .= $nmfoto; 

            move_uploaded_file($lokasi, "../assets/img/produk/".$namafotobaru);

            $koneksi->query("INSERT INTO foto_produk 
                            (idp, foto_produk)
                            VALUES
                            ('$idp','$namafotobaru')");

            echo "<script>alert('Foto Produk Berhasil Ditambahkan')</script>";
            echo "<script>location='index.php?halaman=detailproduk&id=$idp';</script>";
        }
    ?>
		

