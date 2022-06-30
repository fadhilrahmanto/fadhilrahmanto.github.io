
			<h1 class="mt-4">Data Pesanan</h1>
			<hr>
			
			<table class="table table-bordered">
				<thead>
					<tr>
						<th>No</th>
						<th>Nama Pelanggan</th>
						<th>Tanggal pembelian</th>
						<th>Status Pembelian</th>
						<th>total pembelian</th>
						<th>aksi</th>
					</tr>
				</thead>

				<tbody>
					<?php $ambil = $koneksi->query("SELECT * FROM pembelian JOIN users 
													ON pembelian.`id_user`=users.`id_user`"); ?>
					<?php $nomor= 1; ?>
					<?php while ($pembelian = $ambil->fetch_assoc()) { ?>
					
					<tr>
						<td><?= $nomor; ?></td>
						<td><?= $pembelian['name'] ?></td>
						<td><?= $pembelian['tgl_pembelian'] ?></td>
						<td><?= $pembelian['status_pembelian'] ?></td>
						<td>Rp<?= number_format($pembelian['total_pembelian']) ?></td>



						<td>
							<!-- status masih menunggu pembayaran-->
						<?php if ($pembelian['status_pembelian']== "menunggu pembayaran"): ?>
							<a href="index.php?halaman=detail&id=<?= $pembelian['id_pembelian']?>" class="btn btn-warning">Detail</a>
                        <?php elseif ($pembelian['status_pembelian']== "Pesanan Selesai") : ?>
							<a href="index.php?halaman=detail&id=<?= $pembelian['id_pembelian']?>" class="btn btn-warning">Detail</a>
							
                        <?php else : ?>
							<a href="index.php?halaman=detail&id=<?= $pembelian['id_pembelian']?>" class="btn btn-warning">Detail</a>
							<a href="index.php?halaman=pembayaran&id=<?php echo $pembelian['id_pembelian'] ?>" class="btn btn-success">Lihat Pembayaran</a>
							<?php endif ?>


						

						
						
						
						</td>
					</tr>
					
					<?php $nomor++; ?>
					<?php } ?>
				</tbody>
			</table>

