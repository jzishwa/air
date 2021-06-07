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
    <div class="row">
        <div class="p-2 mx-2 text-center w-25" style="border: 5px solid black;">
            <h3><?= 'P' . substr(str_repeat(0, 3) . $data['id_pelanggan'], -3) . ' - ' . $data['nama'] ?></h3>
            <img src="<?= BASEURL; ?>/public/img/qr/one.png" class="img-fluid" style="width: 100%;">
        </div>
    </div>



</body>

<script>
    window.print();
    //window.focus();
    setTimeout(function() {
        window.close();
    }, 2000);
</script>

</html>