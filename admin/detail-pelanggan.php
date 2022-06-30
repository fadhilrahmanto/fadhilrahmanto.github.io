 <?php 

    $idpelanggan = $_GET['id'];

    $ambil = $koneksi->query("SELECT * FROM users WHERE id_user=$idpelanggan");
    $profile = $ambil->fetch_assoc();

    ?>

 <!-- start content -->
 <section id="profile" class="my-1 pb-1">
        <div class="container mt-5">
            <div class="card mb-3">
                <div class="row g-0">
                    
                    <div class="col-md-3">
                        <img src="../assets/img/profile/<?= $profile['image'] ?>" class="img-fluid rounded-start" alt="...">
                    </div>

                    <div class="col-md-3">
                        <div class="card-body">
                            <h3 class="card-title">Biodata Diri</h3>
                            <p class="card-text"><?= $profile['name'] ?></p>
                            <!-- <p class="card-text">
                                Tanggal Lahir <br>
                                <?= $profile['tgl_lahir']; ?>
                            </p> -->
                            <p class="card-text">
                                Jenis Kelamin <br>
                                <?= $profile['jns_kelamin']; ?>
                        </p>
                            <!-- <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p> -->
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="card-body">
                            <h3 class="card-title">Kontak</h3>
                            <p class="card-text"><?= $profile['email'] ?></p>
                            <p class="card-text"><?= $profile['telp'] ?></p>
                            <!-- <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p> -->
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="card-body">
                            <h3 class="card-title">Alamat</h3>
                            <p class="card-text"><?= $profile['alamat'] ?></p>
                            <!-- <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>

            </div>
        </div>
    </section>