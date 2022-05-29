<?php

$mpdf = new \Mpdf\Mpdf(
                        [
                            'format' => [105, 148] ,
                            'setAutoTopMargin' => 'pad'
                        ]
                    ); //215, 330

$mpdf->SetHTMLHeader('
    <div id="header-logo">
        <img src="'.base_url().'assets/img/logo-toko/mylogo.png" height=50px>
    </div>
    <div id="header-text">
        '. $this->session->userdata('nama_toko') .' <br>
        alamat ........ <br>
        notelp 081......
    </div>
    <br>
    <br>
    <br>
    <hr>
');


$html = '
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kuitansi Barang Masuk</title>
    <link rel="stylesheet" href="'.base_url().'assets/css/cetak.css">
</head>
<body>
    
    <div id="header">
        <h3>Nota Penjualan</h3>
        <table cellpadding=1>
        
            <tr>
                <td>Kode Transaksi</td>
                <td>:</td>
                <td>'.$kode.'</td>
            </tr>
            <tr>
                <td>Tanggal</td>
                <td>:</td>
                <td>'.$tgl.'</td>
            </tr>

        </table>
    </div>

    <div id="penjualan">
        <table colspan=1>
            <tr>
                <th>No</th>
                <th>Nama Barang</th>
                <th colspan=2>QTY</th>
                <th>Satuan</th>
                <th>Sub Total</th>
            </tr>';
    $no = 1 ;
    foreach($keluar as $row){
    $html .='
                <tr>
                    <td>'.$no++.'</td>
                    <td>'.$row['nama_barang'].'</td>
                    <td>'.$row['qty'].'</td>
                    <td>'.$row['satuan'].'</td>
                    <td>'.$row['harga_jual'].'</td>
                    <td>'.$row['total_jual'].'</td>
                </tr>';
    }
$html .='
        </table>
    </div>

    <div id="tanda-tangan">
        Hormat Kami
    </div>

    
        

    
</body>
</html>
' ;
$mpdf->SetHTMLFooter('{PAGENO}') ;
$mpdf->WriteHTML($html);
$mpdf->Output("$kode.pdf","I");

// echo($html) ;
?>