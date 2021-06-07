<?php
if (!isset($_SESSION['login'])) {
    header('Location:' . BASEURL . '/login');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">


<meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Air Bersih">
    <meta name="author" content="Bootlab">

    <title>PAM</title>

    <!-- PICK ONE OF THE STYLES BELOW -->
    <link href="<?= BASEURL; ?>/public/css/modern.css" rel="stylesheet">
    <!-- <link href="css/classic.css" rel="stylesheet"> -->
    <!-- <link href="css/dark.css" rel="stylesheet"> -->
    <!-- <link href="css/light.css" rel="stylesheet"> -->


    <!-- BEGIN SETTINGS -->
    <!-- You can remove this after picking a style -->
    <style>
        body {
            opacity: 0;
        }
    </style>
    <script src="<?= BASEURL; ?>/public/js/settings.js"></script>
    <script src="<?= BASEURL; ?>/public/js/instascannew.min.js"></script>
    <!-- END SETTINGS -->
</head>