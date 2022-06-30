

<?php 

	



$semua_data=array();
$tgl_mul="-";
$tgl_sel='-';

if (isset($_POST['kirim'])) 
{
	$tgl_mul = $_POST['tglm'];
	$tgl_sel = $_POST['tgls'];
	$status = $_POST['status'];
	$ambil = $koneksi->query("SELECT pembelian.`id_pembelian`,pembelian.`id_user`,pembelian.`tgl_pembelian`,pembelian.`alamat_pengiriman`,pembelian.`total_pembelian`,pembelian.`status_pembelian`,
								pembelian_produk.`id_pembelian`,pembelian_produk.`nama`,pembelian_produk.`jumlah`,pembelian_produk.`idp`,pembelian_produk.`nm_pedagang`,pembelian_produk.`harga`,pembelian_produk.`sub_harga`,
								users.`name`
								FROM pembelian
								JOIN users ON pembelian.`id_user`=users.`id_user` 
								JOIN pembelian_produk ON pembelian.`id_pembelian`=pembelian_produk.`id_pembelian` 
								WHERE status_pembelian='$status' AND tgl_pembelian 
								BETWEEN '$tgl_mul' AND '$tgl_sel'");
	while ($pecah = $ambil->fetch_assoc()) 
	{
		$semua_data[] = $pecah;
	}
	

	// echo"<pre>";
	// print_r($semua_data);
	// echo "</pre>";
}

?>
			<h3>Laporan Penjualan Dari <?= $tgl_mul; ?> Hingga <?= $tgl_sel; ?></h3>
			<hr>
			<form method="post">
				<div class="row">
					<div class="col-md-3">
						<div class="form-group">
							<label>Tanggal Mulai</label>
							<input type="date" name="tglm" class="form-control" value="<?= $tgl_mul ?>">
						</div>
					</div>

					<div class="col-md-3">
						<div class="form-group">
							<label>Tanggal Selesai</label>
							<input type="date" name="tgls" class="form-control" value="<?= $tgl_sel ?>">
						</div>
					</div>

					<div class="col-md-3">
						<div class="form-group">
							<label>Status</label>
							<select name="status" class="form-control" id="">
								<option value="">--Pilih Status--</option>
								<option value="menunggu pembayaran"  >menunggu pembayaran</option>
								<option value="Pesanan Diproses"  >Pesanan Diproses</option>
								<option value="Pesanan Dikirim"  >Pesanan Dikirim</option>
								<option value="Pesanan Selesai" >Pesanan Selesai</option>
								<option value="Pesanan Ditolak"  >Pesanan Ditolak</option>
							</select>
						</div>
					</div>

					<div class="col-md-3">
						<label>&nbsp;</label><br>
						<button class="btn btn-primary" name="kirim">Lihat</button>
					</div>
				</div>
			</form>

			<table class="table table-bordered mt-3">
				<thead align="center">
					<tr>
						<th>No</th>
						<th>Id. Inv</th>
						<th>Pelanggan</th>
						<th>Produk</th>
						<th>Pedagang/UKM</th>
						<th>Harga</th>
						<th>Qty</th>
						<th>Sub. Total</th>
						<th>Tanggal</th>
						<th>Status</th>
					</tr>
				</thead>

				<tbody align="center">
					<?php $total=0; ?>
					<?php $totalqty=0; ?>
					<?php foreach ($semua_data as $key => $value):?>
						<?php $total+=$value['sub_harga']; ?>
						<?php $totalqty+=$value['jumlah']; ?>
					<tr>
						
						<td><?= $key+1; ?></td>
						<td><?= $value['id_pembelian']; ?></td>
						<td><?= $value['name']; ?></td>
						<td><?= $value['nama'] ?></td>
						<td><?= $value['nm_pedagang'] ?></td>
						<td>Rp. <?= number_format($value['harga']); ?></td>
						<td><?= $value['jumlah'] ?></td>
						<td>Rp. <?= number_format($value['sub_harga']); ?></td>
						<td><?= date("d F Y", strtotime($value['tgl_pembelian'])) ; ?></td>
						<td><?= $value['status_pembelian']; ?></td>
					</tr>
					<?php endforeach ?>
				</tbody>
				<tfoot align="center">
					<tr>
						<th colspan="6">TOTAL</th>
						<th><?= $totalqty; ?></th>
						<th>Rp. <?= number_format($total); ?></th>
						<th></th>
					</tr>
				</tfoot>
			</table>
			<a href="download-laporan.php?tglm=<?= $tgl_mul ?>&tgls=<?= $tgl_sel ?>&status=<?= $status ?>">Download Laporan (PDF)</a>

