

        <h1 class="mt-4">Data Pedagang</h1>
	<hr>
		
		<table class="table table-bordered">
			
			<thead>
				<tr align="center">
					<th>No</th>
					<th> pedagang </th>
					<th> produk </th>
                    <th> Gambar Produk </th>
					<th>Handphone </th>
					<th> alamat </th>
                    <th> stok produk</th>
				</tr>
			</thead>
			

			<tbody>
				<?php $nomor=1; ?>
				<?php $ambil=$koneksi->query("SELECT * FROM tb_produk"); ?>
				<?php while ($pecah = $ambil->fetch_Assoc()) {?>
					<tr align="center">
						<td><?= $nomor; ?></td>
						<td> <?= $pecah['nama_pedagang']; ?> </td>
                        <td> <?= $pecah['nama_produk']; ?> </td>
						<td>
							<img src="../assets/img/produk/<?= $pecah['gambar_produk'] ?>" width="100">
						</td>
						<td><?= $pecah['telp_pedagang']; ?></td>
						<td><?= $pecah['alamat_pedagang']; ?></td>
                        <td><?= $pecah['stok_produk']; ?></td>
						
					</tr>
				<?php $nomor++; ?>
				<?php } ?>

			
			</tbody>
		</table>
		<a href="download-pedagang.php">Download Data Pedagang (PDF)</a>
		
