<?php

include("./models/ClienteEventoModel.php");

use \Models\ClienteEvento;

$app->get('/eventoscliente', function() use ($app) {
    $eventos = ClienteEvento::getAll();
    $app->response()->header("Content-Type", "application/json");
    echo json_encode($eventos);
});

//get by id
$app->get('/eventoscliente/:id', function($id) use ($app) {
    try{
        $evento = ClienteEvento::getById($id);
        $app->response()->header("Content-Type", "application/json");
        echo json_encode($evento);
    }catch (PDOException $e){
        $app->response->setStatus(404);
    }
});

//insert
$app->post('/eventoscliente', function() use ($app) {

    $evento = json_decode(file_get_contents('php://input'), true);
    ClienteEvento::insert($evento);

});
