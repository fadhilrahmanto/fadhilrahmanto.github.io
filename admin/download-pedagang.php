
    <?php
    require_once "../koneksi.php";
    // Require composer autoload
    require_once '../assets/vendor/autoload.php';
    // Create an instance of the class:
    $mpdf = new \Mpdf\Mpdf();

    

    // echo "<pre>";
    // print_r($_GET);
    // "</pre>";

    $ambil = $koneksi->query("SELECT * FROM tb_produk");

   $isi = " <h3>Data Pedagang</h3>";
        $isi.="<table border=1 class='table table-bordered mt-3'>";
                    $isi.= '
                        <thead align="center">
                            <tr>
                                <th> pedagang </th>
                                <th> produk </th>
                                <th>Handphone </th>
                                <th> alamat </th>
                                <th> stok produk</th>
                            </tr>
                        </thead>
                    ';

                    
                        $isi.= "<tbody align='center'>";
                            while ($pecah = $ambil->fetch_Assoc()) {
                            $isi.= "<tr>";
                                $isi.= "<td>" .$pecah['nama_pedagang']. "</td>";
                                $isi.= "<td>" .$pecah['nama_produk']. "</td>";
                                $isi.= "<td>" .$pecah['telp_pedagang']. "</td>";
                                $isi.= "<td>" .$pecah['alamat_pedagang']. "</td>";
                                $isi.= "<td>" .$pecah['stok_produk']. "</td>";
                            $isi.="</tr>";
                            }
                        $isi.= "</tbody>";
                        $isi.= "</table>";
                    


    // Write some HTML code:
    $mpdf->WriteHTML($isi);

    // Output a PDF file directly to the browser
    $mpdf->Output("Laporan Data Pedagang.pdf", "i" );
            
    