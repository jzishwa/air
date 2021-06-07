<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link href="<?= BASEURL; ?>/public/css/modern.css" rel="stylesheet">
</head>

<body>


    <?php
    $tanda = 0;
    for ($j = 0; $j <= $data['bagi']; $j++) {
        $ulang = false; ?>
        <div class="row" <?php if ($j > 0) echo "style='page-break-before:always;'"; ?>>
            <?php
            $pelanggan = $data['pelanggan'];
            for ($i = $tanda; $i < sizeof($data['pelanggan']); $i++) {
                if ($i % 9 == 0 && $i != 0) {
                    if ($ulang) {
                        $tanda = $i;
                        break;
                    }
                }

            ?>
                <div class="p-2 m-2 text-center" style="width:30%; height:400px; border: 5px solid black;">
                    <h3><?= 'P' . substr(str_repeat(0, 3) . $pelanggan[$i]['id_pelanggan'], -3) . ' - ' . $pelanggan[$i]['nama']; ?></h3>
                    <?php QRcode::png($pelanggan[$i]['id_pelanggan'], $data['tempdir'] . 'qr' . $pelanggan[$i]['id_pelanggan'] . '.png', QR_ECLEVEL_H, 10, 0); ?>
                    <img src="<?= BASEURL; ?>/public/img/qr/qr<?= $pelanggan[$i]['id_pelanggan']; ?>.png" class="img-fluid" style="width: 100%;">
                </div>
            <?php
                $ulang = true;
            } ?>
        </div>
    <?php } ?>



</body>

<script>
    window.print();
    setTimeout(function() {
        window.close();
    }, 2000);
</script>

</html>