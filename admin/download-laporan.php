
    <?php
    require_once "../koneksi.php";
    // Require composer autoload
    require_once '../assets/vendor/autoload.php';
    // Create an instance of the class:
    $mpdf = new \Mpdf\Mpdf();

    

    // echo "<pre>";
    // print_r($_GET);
    // "</pre>";

    $tglm = $_GET['tglm'];
    $tgls  = $_GET['tgls'];
    $status = $_GET['status'];
    $ambil = $koneksi->query("SELECT pembelian.`id_pembelian`,pembelian.`id_user`,pembelian.`tgl_pembelian`,pembelian.`alamat_pengiriman`,pembelian.`total_pembelian`,pembelian.`status_pembelian`,
								pembelian_produk.`id_pembelian`,pembelian_produk.`nama`,pembelian_produk.`jumlah`,pembelian_produk.`idp`,pembelian_produk.`nm_pedagang`,pembelian_produk.`harga`,pembelian_produk.`sub_harga`,
								users.`name`
								FROM pembelian
								JOIN users ON pembelian.`id_user`=users.`id_user` 
								JOIN pembelian_produk ON pembelian.`id_pembelian`=pembelian_produk.`id_pembelian` 
								WHERE status_pembelian='$status' AND tgl_pembelian 
								BETWEEN '$tglm' AND '$tgls'");
	while ($pecah = $ambil->fetch_assoc()) 
	{
		$semua_data[] = $pecah;
	}
    

    $isi = " <h3 align='center'>Laporan Penjualan <u>".date("d F Y", strtotime($tglm)) ."</u> Hingga  <u>".date("d F Y", strtotime($tgls))."</u></h3>";
        $isi.="<table border=1 class='table table-bordered mt-3'>";
                    $isi.= '
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
                    ';

                    
                        $isi.= "<tbody align='center'>";
                            $total=0; 
                            $totalqty=0; 
                            foreach($semua_data as $key => $value) :
                                $total+=$value['sub_harga'];
                                $totalqty+=$value['jumlah'];
                                $nomor = $key+1;
                            $isi.= "<tr>";
                                $isi.= "<td>" .$nomor. "</td>";
                                $isi.= "<td>" .$value['id_pembelian']. "</td>";
                                $isi.= "<td>" .$value['name']. "</td>";
                                $isi.= "<td>" .$value['nama']. "</td>";
                                $isi.= "<td>" .$value['nm_pedagang']. "</td>";
                                $isi.= "<td> Rp".number_format($value['harga']).",00</td>";
                                $isi.= "<td>" .$value['jumlah']. "</td>";
                                $isi.= "<td> Rp".number_format($value['sub_harga']).",00</td>";
                                $isi.= "<td>" .date("d F Y", strtotime($value['tgl_pembelian'])). "</td>";
                                $isi.= "<td>" .$value['status_pembelian']. "</td>";
                            $isi.="</tr>";
                            endforeach;
                        $isi.= "</tbody>";
                    

                    $isi.= "<tfoot>";
                        $isi.= "<tr>";
                            $isi.= "<th colspan='6'>TOTAL</th>";
                            $isi.= "<th>".$totalqty. "</th>";
                            $isi.= "<th>Rp".  number_format($total). "</th>";
                            $isi.= "<th colspan='2'></th>";
                        $isi.= "</tr>";
                    $isi.= "</tfoot>";
                $isi.= "</table>";


    // Write some HTML code:
    $mpdf->WriteHTML($isi);

    // Output a PDF file directly to the browser
    $mpdf->Output("Laporan Penjualan ".date("d F Y", strtotime($tglm))." ".date("d F Y", strtotime($tgls)).".pdf", "i" );
            
    