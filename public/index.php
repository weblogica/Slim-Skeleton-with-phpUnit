<?php

//$tiempo_inicio = microtime(true);

if (PHP_SAPI == 'cli-server') {
    // To help the built-in PHP dev server, check if the request was actually for
    // something which should probably be served as a static file
    $url  = parse_url($_SERVER['REQUEST_URI']);
    $file = __DIR__ . $url['path'];
    if (is_file($file)) {
        return false;
    }
}

require __DIR__ . '/../vendor/autoload.php';

session_start();

/** @var \AeroTransfersApp $aeroTransfersApp */
$aeroTransfersApp = new \AeroTransfersApp();
$app = $aeroTransfersApp->getApp()->run();

//$tiempo_fin = microtime(true);

//echo nl2br("\n\nTiempo empleado: " . ($tiempo_fin - $tiempo_inicio));
