<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/vendor/autoload.php';

//inicializa o slim
$app = new \Slim\Slim();

include("libs/database.php");
include("./routes/EventoService.php");
include("./routes/TipoService.php");
include("./routes/ClienteEventoService.php");

$app->run();