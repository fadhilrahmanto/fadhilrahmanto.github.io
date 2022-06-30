    <?php 
    session_start();
    include 'koneksi.php';

    //jika blm login
    if (!isset($_SESSION["user"]) OR empty($_SESSION["user"])) 
    {
        echo "<script>alert('SILAHKAN LOGIN TERLEBIH DAHULU!!!');</script>";
        echo "<script>location='login.php';</script>";
        exit();
    }
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

    <title>UMKM CILEDUG PRIMA</title>
</head>

<body>
    <?php require_once "tamplates/navigation.php" ;?>

    <section class="ttransaksi">

    <div class="container mt-5 mb-5">
            <h4>Riwayat Belanja <strong class="text-uppercase"><?php echo $_SESSION['user']['name'] ?></strong></h4>

            <table border="1px" class="table table-bordered text-center">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Status</th>
                        <th>Total</th>
                        <th>Opsi</th>
                    </tr>
                </thead>

                <tbody align="center">
                    <?php $nomor=1; ?>

                    <?php 
                    //mendapatkan id pelanggan yg login dari session

                    $id_pelanggan = $_SESSION['user']['id_user'];	 
                    $ambil = $koneksi->query("SELECT * FROM pembelian WHERE id_user='$id_pelanggan'");
                    while ($pecah = $ambil->fetch_assoc()) 
                    {
                    ?>
                    
                    <tr>
                        <td><?php echo $nomor; ?></td>
                        <td><?php echo $pecah['tgl_pembelian']; ?></td>



                        <!-- status -->
                        <td>
                            <?php echo $pecah['status_pembelian']; ?><br>
                            
                            <!-- Jika resi sudah di update oleh penjual atau resi tidak kosong  maka tampilkan resi -->
                            <?php if($pecah['status_pembelian']=="Pesanan Dikirim") : ?>
                            resi : <?php echo $pecah['resi_pengiriman']; ?>

                            <?php elseif($pecah['status_pembelian']=="Pesanan Selesai") : ?>

                            <?php endif ?>
                            
                        </td>


                        <td>Rp. <?php echo number_format($pecah['total_pembelian']); ?></td>

                        <!-- opsi -->
                        <td>
                            <!-- jika status masih menunggu pembayaran -->
                            <?php if ($pecah['status_pembelian']== "menunggu pembayaran"): ?>
                                <a href="bayar.php?id=<?php echo $pecah['id_pembelian'] ?>" class="btn btn-danger">bayar sekarang</a>

                            <?php elseif ($pecah['status_pembelian']== "Pesanan Dikirim"): ?>
                                <a href="detail-pengiriman.php?id=<?php echo $pecah['id_pembelian']; ?>" class="btn btn-primary">
                                Lihat detail pengiriman
                            </a>

                            <a href="detail-transaksi.php?id=<?php echo $pecah['id_pembelian']; ?>" class="btn btn-info">
                                Lihat Pesanan
                            </a>

                            <a href="selesai.php?id=<?php echo $pecah['id_pembelian']; ?>" class="btn btn-danger">
                                Selesaikan Pesanan
                            </a>

                            <?php else : ?>
                            <a href="detail-transaksi.php?id=<?php echo $pecah['id_pembelian']; ?>" class="btn btn-info">
                                Lihat Pesanan
                            </a>
                            <?php endif ?>

                        </td>
                    </tr>
                    <?php $nomor++; ?>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </section>


    <?php require_once "tamplates/footer.php";  ?>
</body>

</html>
