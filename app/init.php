<?php

require_once('core/App.php');
require_once('core/Controller.php');
require_once('core/Constans.php');
require_once('core/Flash.php');
require_once('core/phpqrcode/qrlib.php');
require_once('core/vendor/autoload.php');
require_once('core/pdf/autoload.php');

spl_autoload_register(function ($class) {
    require_once 'controllers/' . $class . '.php';
});
