<?php

include("./models/ClienteEventoModel.php");

use \Models\ClienteEvento;

$app->get('/eventosclientes', function() use ($app) {
    $eventos = ClienteEvento::getAll();
    $app->response()->header("Content-Type", "application/json");
    echo json_encode($eventos);
});

$app->get('/eventosclientes/:id', function($id) use ($app) {
    try{
        $evento = ClienteEvento::getById($id);
        $app->response()->header("Content-Type", "application/json");
        echo json_encode($evento);
    }catch (PDOException $e){
        $app->response->setStatus(404);
    }
});

$app->post('/eventosclientes', function() use ($app) {

    $inscricao = json_decode($app->request()->getBody());
    $codigo = ClienteEvento::insert($inscricao);

    echo $codigo;

});
