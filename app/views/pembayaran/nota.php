<?php
header('Content-Type: application/pdf');
$mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => [58, 85], 'margin_left' => '5', 'margin_right' => '5', 'margin_top' => '3', 'margin_bottom' => '3']);
ob_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-size: 8pt;
            font-family: 'Courier New', monospace;
        }

        table,
        tr,
        th,
        td {
            width: 100%;
            font-size: 20pt;
            margin: 0;
            padding: 0;
            border-collapse: collapse;
        }
    </style>
    <title>Cetak Nota</title>
</head>

<body>
    <table>
        <tr>
            <th colspan="3">Usaha Air Bersih</th>
        </tr>
        <tr>
            <th colspan="3"><?= $data['profile']['nama_pam']; ?></th>
        </tr>
        <!-- AWAL ALAMAT. ALAMAT DIBAGI MENJADI TIGA -->
        <tr>
            <th colspan="3"><?= $data['alamat'][0]; ?></th>
        </tr>
        <tr>
            <th colspan="3"><?= $data['alamat'][1]; ?></th>
        </tr>
        <tr>
            <th colspan="3" style="border-bottom: 2px solid #000000;"><?= $data['alamat'][2]; ?></th>
        </tr>
        <!-- BATAS ALAMAT -->
        <tr>
            <th style="padding-top: 15px;" colspan="3">Nota Pembayaran</th>
        </tr>
        <tr>
            <td style="padding-top: 25px;">Tanggal</td>
            <td>:</td>
            <td style="text-align: right;padding-top: 25px;"><?= $data['bayar']['tgl_bayar']; ?></td>
        </tr>
        <tr>
            <td style="border-bottom: 3px dotted #000000;">Operator</td>
            <td style="border-bottom: 3px dotted #000000;">:</td>
            <td style="text-align: right; border-bottom: 3px dotted #000000;"><?= $_SESSION['nama']; ?></td>
        </tr>
        <tr>
            <td style="padding-top:25px;text-align:justifiy;">Pelanggan</td>
            <td colspan="2" style="text-align: left;padding-top:25px; width:100px!important;"><?= ': ' . $data['bayar']['nama']; ?></td>
        </tr>
        <tr>
            <td style="padding-top:25px;text-align:justifiy;">Alamat</td>
            <td colspan="2" style="text-align: left;padding-top:25px; width:100px!important;"><?= ': ' . $data['bayar']['alamat']; ?></td>
        </tr>
        <tr>
            <td style="text-align:justifiy;">Periode</td>
            <td colspan="2" style="text-align: left;"><?= ': ' . $data['bayar']['nama_bulan'] . '-' . $data['bayar']['tahun']; ?></td>
        </tr>
        <tr>
            <td style="text-align:justifiy;">Mtr Lalu</td>
            <td colspan="2" style="text-align: left;"><?= ': ' . $data['bayar']['awal'] . ' m'; ?><sup>3</sup></td>
        </tr>
        <tr>
            <td style="text-align:justifiy;">Mtr Skrng</td>
            <td colspan="2" style="text-align: left;"><?= ': ' . $data['bayar']['akhir'] . ' m'; ?><sup>3</sup></td>
        </tr>
        <tr>
            <td style="text-align:justifiy;">Pemakaian</td>
            <td colspan="2" style="text-align: left;"><?= ': ' . $data['bayar']['tagihan'] . ' m'; ?><sup>3</sup></td>
        </tr>
        <tr>
            <td style="text-align:justifiy;">Hrg per m<sup>3</sup></td>
            <td colspan="2" style="text-align: left;"><?= ': Rp ' . number_format($data['bayar']['tarif'], 0, ',', '.'); ?></td>
        </tr>
        <tr>
            <td style="text-align:justifiy; padding-bottom:20px;">Biaya Beban</td>
            <td colspan="2" style="text-align: left; padding-bottom:20px; border-bottom: 1px dashed #000000;"><?= ': Rp ' . number_format($data['tambah']['tarif_ht'], 0, ',', '.'); ?></td>
        </tr>
        <tr>
            <th style="text-align:justifiy; padding-top: 10px; ">TOTAL</th>
            <th colspan="2" style="text-align: left; padding-top: 10px;"><?= ': Rp ' . number_format($data['bayar']['uang_masuk'], 0, ',', '.'); ?></th>
        </tr>
        <tr>
            <th style="text-align:justifiy;">BAYAR</th>
            <th colspan="2" style="text-align: left;"><?= ': Rp ' . number_format($data['bayar']['uang_bayar'], 0, ',', '.'); ?></th>
        </tr>
        <tr>
            <th style="text-align:justifiy;">KEMBALI</th>
            <th colspan="2" style="text-align: left;"><?= ': Rp ' . number_format($data['bayar']['uang_kembali'], 0, ',', '.'); ?></th>
        </tr>
        <tr>
            <td colspan="3" style="padding-top: 20px; text-align:center;">**TERIMA KASIH**</td>
        </tr>

    </table>
</body>

</html>

<?php
$html = ob_get_contents();
ob_end_clean();
$mpdf->WriteHTML($html);
$mpdf->Output('app/nota.pdf', 'F');
header('Location:' . BASEURL . '/pembayaran/preview');
?>