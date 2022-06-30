
			<h1 class="mt-4">Data Produk</h1>
			<hr>
			<a href="index.php?halaman=tambahproduk"class="btn btn-primary mb-2">Tambah Produk</a>

			<table class="table table-bordered">
				<thead>
					<tr align="center">
						<th>No</th>
						<th>Foto</th>
						<th>Nama</th>
						<th>Kategori</th>
						<th>Harga</th>
						<th>Berat</th>
						<th>Stok</th>
						<th>Tanggal</th>
						<th>Aksi</th>
					</tr>
				</thead>
				
				<tbody align="center" >
					<?php $ambil = $koneksi->query("SELECT * FROM tb_produk LEFT JOIN tb_kategori 
													ON tb_produk.`idk`=tb_kategori.`idk`"); ?>
					<?php $nomor= 1; ?>
					<?php while ($p = $ambil->fetch_assoc()) { ?>

					<tr>
						<td><?=$nomor; ?></td>
						<td>
							<img src="../assets/img/produk/<?= $p['gambar_produk']; ?>" width="100px">
						</td>
						<td><?=$p['nama_produk']; ?></td>
						<td><?= $p['nama_kategori'] ?></td>
						<td>Rp<?= number_format($p['harga_produk']) ; ?></td>
						<td><?=$p['berat_produk']; ?></td>
						
						<td><?=$p['stok_produk']; ?></td>
						<td><?= $p['data_created']; ?></td>
						<td align="center">
							<a href="index.php?halaman=hapusproduk&id=<?=$p['idp']; ?>" 
							class="btn-danger btn">hapus</a><br>
							<a href="index.php?halaman=ubahproduk&id=<?=$p['idp']; ?>" 
							class="btn btn-warning">ubah</a><br>
							<a href="index.php?halaman=detailproduk&id=<?=$p['idp']; ?>" 
							class="btn btn-primary">detail</a>
						</td>
					</tr>
					<?php $nomor++; ?>
					<?php } ?>

				</tbody>
			</table>
