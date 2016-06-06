<?php

include("./models/TipoModel.php");

use \Models\Tipo;

$app->get('/tipos', function() use ($app) {
    $tipos = Tipo::getAll();
    $app->response()->header("Content-Type", "application/json");
    echo json_encode($tipos);
});