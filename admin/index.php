    

    <?php
    session_start();
    include '../koneksi.php';

    
    if (!isset($_SESSION['user'])) 
    {
        echo "<script>alert('anda harus login');</script>";
        echo "<script>location='error.php';</script>";
        header('location:error.php');
        
    }else {
					
        if($_SESSION['user']['role_id']=='2'){
            echo "<script>alert('anda harus login');</script>";
            echo "<script>location='error.php';</script>";
            header('location:error.php');
            exit;
        } 
        
    }
        
    $itungcust = mysqli_query($koneksi,"SELECT count(id_user) as jumlahcust FROM users WHERE role_id='2' ");
    $itungcust2 = mysqli_fetch_assoc($itungcust);
    $itungcust3 = $itungcust2['jumlahcust'];
    
    ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Dashboard - UMKM CLDPrima</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
    <script src="../assets/js/jquery-1.10.2.js"></script>
</head>

<body class="sb-nav-fixed">

    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" href="index.html">UMKM CLDPrima</a>
        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
    
        <!-- Navbar-->
        <ul class="navbar-nav  ms-auto me-0 me-md-3 my-2 my-md-0">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="index.php?halaman=logout">Logout</a></li>
                </ul>
            </li>
        </ul>
    </nav>


    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">

                        <!--USER-->
                        <div class="sb-sidenav-menu-heading">User</div>
                            <a class="nav-link" href="../">
                                <div class="sb-nav-link-icon"><i class="fas fa-store"></i></div>
                                Kembali ke Toko
                            </a>
                        <!--//USER-->

                        <!-- DASHBOARD -->
                        <div class="sb-sidenav-menu-heading">Admin</div>
                            <a class="nav-link" href="index.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard
                            </a>

                            <a class="nav-link" href="index.php?halaman=settoko">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Atur Toko
                            </a>
                        <!--//DASHBOARD -->

                        <!-- DATA MEMBER -->
                        <a class="nav-link" href="index.php?halaman=member">
                            <div class="sb-nav-link-icon"><i class="fas fa-user-alt"></i></div>
                            Data Pelanggan
                        </a>

                        <a class="nav-link" href="index.php?halaman=datapedagang">
                            <div class="sb-nav-link-icon"><i class="fas fa-user-alt"></i></div>
                            Data Pedagang
                        </a>

                        <!-- DATA STAFF -->
                        <a class="nav-link" href="index.php?halaman=staff">
                            <div class="sb-nav-link-icon"><i class="fas fa-user-tie"></i></div>
                            Kelola Staff
                        </a>

                        <!--KELOLA TOKO-->
                        <a class="nav-link collapsed" href="#collapseLayouts" data-bs-toggle="collapse" 
                        data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                            <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                            Kelola Toko
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" 
                            data-bs-parent="#sidenavAccordion">
                            
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="index.php?halaman=produk">
                                    Produk
                                </a>

                                <a class="nav-link" href="index.php?halaman=kategori">
                                    Kategori
                                </a>

                                <a class="nav-link" href="index.php?halaman=pembelian">
                                    Pesanan
                                </a>

                                <a class="nav-link" href="index.php?halaman=metodePembayaran">
                                    Metode Pembayaran
                                </a>
                            </nav>
                        </div>
                        <!--//KELOLA TOKO -->

                        <!--KELOLA PENJUALAN-->
                        <a class="nav-link collapsed" href="#collapseLayouts2" data-bs-toggle="collapse" 
                        data-bs-target="#collapseLayouts2" aria-expanded="false" aria-controls="collapseLayouts2">
                            <div class="sb-nav-link-icon"><i class="fas fa-cash-register"></i></div>
                            Kelola Penjualan
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapseLayouts2" aria-labelledby="headingOne" 
                            data-bs-parent="#sidenavAccordion">
                            
                            <nav class="sb-sidenav-menu-nested nav">
                                <!-- <a class="nav-link" href="index.php?halaman=penjualan">
                                    Penjualan
                                </a> -->

                                <a class="nav-link" href="index.php?halaman=laporan_pembelian" >
                                    Laporan
                                </a>
                            </nav>
                        </div>
                        <!--//KELOLA PENJUALAN -->

                    
                        

                        

                        <!-- LOGOUT -->
                        <a class="nav-link" href="index.php?halaman=logout">
                            <div class="sb-nav-link-icon"><i class="fas fa-sign-out-alt"></i></div>
                            Logout
                        </a>
                        <!--//LOGOUT -->
                    </div>
                </div>

                <div class="sb-sidenav-footer">
                    <div class="small">Logged in as:</div>
                    <strong><?= $_SESSION['user']['name']; ?></strong>
                </div>

            </nav>
        </div>
        <div id="layoutSidenav_content">
	    <main>
            <div class="container-fluid px-4 mt-3  mb-5">
        <?php
                    if (isset($_GET['halaman']))
                    {
                        if ($_GET['halaman']=='produk')
                        {
                        include 'produk.php';
                        }
                        elseif ($_GET['halaman']=='detailproduk') {
                            include 'detailproduk.php';
                        }
                        elseif ($_GET['halaman']=='settoko') {
                            include 'settoko.php';
                        }
                        elseif ($_GET['halaman']=='hapusfotoproduk') {
                            include 'hapusfotoproduk.php';
                        }
                        elseif ($_GET['halaman']=='kategori') {
                            include 'kategori.php';
                        }
                        elseif ($_GET['halaman']=='metodePembayaran') {
                            include 'metodePembayaran.php';
                        }
                        elseif ($_GET['halaman']=='pembelian') {
                        include 'pembelian.php';
                        }
                        elseif ($_GET['halaman']=='member') {
                            include 'pelanggan.php';
                        }elseif ($_GET['halaman']=='detailpelanggan') {
                            include 'detail-pelanggan.php';
                        }
                        elseif ($_GET['halaman']=='staff') {
                            include 'staff.php';
                        }
                        elseif ($_GET['halaman']=='detail') {
                            include 'detail.php';
                        }
                        elseif ($_GET['halaman']=='tambahproduk') {
                            include 'tambahproduk.php';
                        }
                        elseif ($_GET['halaman']=='hapusproduk') {
                            include 'hapusproduk.php';
                        }
                        elseif ($_GET['halaman']=='ubahproduk') 
                        {
                            include 'ubahproduk.php';
                        }
                        elseif ($_GET['halaman']=='hapuspelanggan') {
                            include 'hapuspelanggan.php';
                        }
                        elseif ($_GET['halaman']=='logout') {
                            include 'logout.php';
                        }
                        elseif ($_GET['halaman']=='pembayaran') {
                            include 'pembayaran.php';
                        }
                        elseif ($_GET['halaman']=='laporan_pembelian') {
                            include 'laporan.php';
                        }
                        elseif ($_GET['halaman']=='ubahpassword') {
                            include 'ubah_password.php';
                        }
                        elseif ($_GET['halaman']=='datapedagang') {
                            include 'pedagang.php';
                        }
                        
                        
                    }
                    else
                    {
                    include 'home.php';
                    }
                    ?>
                </div>
            </main>

                        
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted"><i>Copyright &copy;umkm ciledug prima <?= date('Y') ?></i></div>
                        <div>
                            <a href="#">Privacy Policy</a> &middot;
                            <a href="#">Terms &amp; Conditions</a>
                        </div>
                    </div>
                </div>
            </footer>

        </div>

    </div>


    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="assets/demo/chart-area-demo.js"></script>
    <script src="assets/demo/chart-bar-demo.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
    <script src="js/datatables-simple-demo.js"></script>
</body>

</html>



