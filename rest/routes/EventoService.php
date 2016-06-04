<?php

include("./models/EventoModel.php");

use \Models\Evento;

$app->get('/eventos', function() use ($app) {
    $eventos = Evento::getAll();
    $app->response()->header("Content-Type", "application/json");
    echo json_encode($eventos);
});
