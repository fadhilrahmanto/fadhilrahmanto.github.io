<nav class="navbar navbar-expand-lg navbar-light bg-white py-3">
        <div class=" container">
            <a class="navbar-brand col-3" href="index.php">UMKM CILEDUG PRIMA</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span><i id="bar" class="fas fa-bars"></i></span>
        </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav col-auto">

                    <li class="nav-item ">
                        <a class="nav-link" href="index.php">Home</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="product.php">Shop</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="kategori.php">Kategori</a>
                    </li>
                    
                    
                        <?php
                            if(!isset($_SESSION['user'])){

                                echo'
                                    <li class="nav-item">
                                        <a class="nav-link" href="login.php">Masuk</a>
                                    </li>

                                    <li class="nav-item">
                                        <a class="nav-link" href="buat-akun.php">Buat Akun</a>
                                    </li>
                                ';
                            } else{
                                if($_SESSION['user']['role_id']=='2'){
                                    echo'
                                    <li class="nav-item">
                                        <a class="nav-link" href="profile.php">Profile</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="logout.php">Keluar</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="transaksi.php">transaksi</a>
                                    </li>
                                    ';
                                } else{
                                    echo'
                                        <li class="nav-item">
                                            <a class="nav-link" href="profile.php">Profile</a>
                                        </li>
                                        
                                        <li class="nav-item">
                                            <a class="nav-link" href="admin">admin panel</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="logout.php">Keluar</a>
                                        </li>
                                    ';
                                };
                            }
                        ?>

                    <li>
                        <a href="keranjang.php"><i class="fas fa-shopping-cart"></i></a>
                    </li>
            </div>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <form class="d-flex" action="cari.php" method="post">
                        <input class="form-control me-2" name="search" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-success" type="submit">Search</button>
                    </form>
                </div>
        </div>
    </nav>