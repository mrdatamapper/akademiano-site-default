<?php

use Carbon\CarbonInterval;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$app = include '../vendor/akademiano/core/src/bootstrap.php';

/** @var $app Akademiano\Core\Application */
//$app->getDiContainer()["environment"]->setServerName("Bermap");
$app->run();
