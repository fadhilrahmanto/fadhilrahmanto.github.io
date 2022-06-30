
<?php
$id_pembelian = $_GET['id'];

$ambil = $koneksi->query("SELECT * FROM pembelian JOIN users 
				ON pembelian.`id_user`=users.`id_user`
				WHERE pembelian.`id_pembelian`=$id_pembelian ");
$detail = $ambil->fetch_assoc();

?>

		<div class="row">
			<div class="col-md-4">
				<h4>Pembelian</h4>
				<p>
					<strong>Tanggal	: </strong> <?= $detail['tgl_pembelian'] ?><br>
					<strong>Total	:</strong> Rp <?= number_format($detail['total_pembelian']) ?> <br>
					<strong>Status	:</strong> <?= $detail['status_pembelian'] ?>
				</p>
			</div>

			<div class="col-md-4">
				<h4>Pelanggan</h4>
				<strong><?= $detail['name']; ?></strong>
				<p>
					<?= $detail['telp']; ?><br>
					<?= $detail['alamat']; ?>
				</p>
			</div>
		</div>
			

	
	<table class="table table-bordered">
		<thead>
			<tr>
				<th>no</th>
				<th>nama produk</th>
				<th>harga</th>
				<th>jumlah</th>
				<th>subtotal</th>
			</tr>
		</thead>
		<tbody>
			<?php $nomor=1; ?>
			<?php $ambil = $koneksi->query("SELECT * FROM pembelian_produk JOIN tb_produk 
											ON pembelian_produk.`idp`=tb_produk.`idp` 
											WHERE pembelian_produk.id_pembelian=$id_pembelian"); ?>
			<?php while ($pecah = $ambil->fetch_assoc()) { ?>
			<tr>
				<td><?= $nomor; ?></td>
				<td><?= $pecah['nama_produk']; ?></td>
				<td>Rp. <?= number_format($pecah['harga_produk']); ?></td>
				<td><?= $pecah['jumlah']; ?></td>
				<td>
					Rp. <?= number_format( $pecah['harga_produk']*$pecah['jumlah']); ?>
				</td>
			</tr>
			<?php $nomor++; ?>
			<?php } ?>
		</tbody>
	</table>
