
            <h1 class="mt-4">Metode Pembayaran</h1>
            <hr>
            <a href="index.php?halaman=tambahproduk"class="btn btn-primary mb-2">Tambah Metode</a>
                <div class="data-tables datatable-dark">
                    <table class="display table table-bordered" style="width:100%">
                        <thead class="thead-dark">
                            <tr>
                                <th>No.</th>
                                <th>Nama Metode</th>
                                <th>No. Rek</th>
                                <th>Atas Nama</th>
                                <th>URL Logo</th>
                            </tr>
                        </thead>

                    <tbody>
                    <?php 
						$brgs=mysqli_query($koneksi,"SELECT * FROM bank ORDER BY id_payment ASC");
						$no=1;
						while($p=mysqli_fetch_array($brgs)){
							$id = $p['id_payment'];
							?>
							
							<tr>
								<td><?php echo $no++ ?></td>
								<td><?php echo $p['metode'] ?></td>
								<td><?php echo $p['norek'] ?></td>
								<td><?php echo $p['atas_nama'] ?></td>
								<td><?php echo $p['url_logo'] ?></td>
							</tr>		
							
							<?php } ?>
                    </tbody>
                </table>
            </div>
