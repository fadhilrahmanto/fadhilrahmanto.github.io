
            <h1 class="mt-4">Kategori Produk</h1>
            <hr>
            <a href="index.php?halaman=tambahproduk"class="btn btn-primary mb-2">Tambah Kategori</a>
                <div class="data-tables datatable-dark">
                    <table class="display table table-bordered" style="width:100%">
                        <thead class="thead-dark">
                            <tr>
                                <th>No.</th>
                                <th>Nama Kategori</th>
                                <th>Jumlah Produk</th>
                                <th>Tanggal Dibuat</th>
                            </tr>
                        </thead>

                    <tbody>
                        <?php 
                        $brgs=mysqli_query($koneksi,"SELECT * from tb_kategori order by idk ASC");
                        $no=1;
                        while($p=mysqli_fetch_array($brgs)){
                            $id = $p['idk'];
                            ?>

                        <tr>
                            <td><?php echo $no++ ?></td>
                            <td><?php echo $p['nama_kategori'] ?></td>
                            <td>
                                <?php 
                                $result1 = mysqli_query($koneksi,"SELECT Count(idp) AS count 
                                            FROM tb_produk p, tb_kategori k 
                                            WHERE p.idk=k.idk AND k.idk='$id' 
                                            ORDER BY idp ASC");
                                $cekrow = mysqli_num_rows($result1);
                                $row1 = mysqli_fetch_assoc($result1);
                                $count = $row1['count'];
                                    if($cekrow > 0){
                                    echo number_format($count);
                                    } else {
                                        echo 'No data';
                                    }
                                ?>
                            </td>
                            <td>
                                <?php echo $p['date_created'] ?>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
