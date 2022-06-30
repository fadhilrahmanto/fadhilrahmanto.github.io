

        <h1 class="mt-4">Data Member</h1>
	<hr>
		
		<table class="table table-bordered">
			
			<thead>
				<tr align="center">
					<th>No</th>
					<th>nama lengkap</th>
					<th>image</th>
					<th>Handphone</th>
					<th>alamat</th>
					<th>aksi</th>
				</tr>
			</thead>
			

			<tbody>
				<?php $nomor=1; ?>
				<?php $ambil=$koneksi->query("SELECT * FROM users WHERE role_id = 2"); ?>
				<?php while ($pecah = $ambil->fetch_Assoc()) {?>
					<tr align="center">
						<td><?= $nomor; ?></td>
						<td> <?= $pecah['name']; ?> </td>
						<td>
							<img src="../assets/img/profile/<?= $pecah['image'] ?>" width="100">
						</td>
						<td><?= $pecah['telp']; ?></td>
						<td><?= $pecah['alamat']; ?></td>
						<td>
							<a href="index.php?halaman=detailpelanggan&id=<?=$pecah['id_user']; ?>" 
							class="btn-danger btn">Detail</a>
						</td>
					</tr>
				<?php $nomor++; ?>
				<?php } ?>

			
			</tbody>
		</table>
		
		
