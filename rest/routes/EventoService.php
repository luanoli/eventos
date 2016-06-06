<?php

include("./models/EventoModel.php");

use \Models\Evento;

$app->get('/eventos', function() use ($app) {
    $eventos = Evento::getAll();
    $app->response()->header("Content-Type", "application/json");
    echo json_encode($eventos);
});

//get by id
$app->get('/eventos/:id', function($id) use ($app) {
    try{
        $evento = Evento::getById($id);
        $app->response()->header("Content-Type", "application/json");
        echo json_encode($evento);
    }catch (PDOException $e){
        $app->response->setStatus(404);
    }
});

//update
$app->put('/eventos/:id', function($id) use ($app) {	

    $evento = json_decode($app->request()->getBody());
    
    $status = Evento::update($evento);
    if($status){
        $app->response->setStatus(200);
    }else{
        $app->response->setStatus(304);
    }
});

//delete
$app->delete('/eventos/:id', function($id) use ($app) {
    try{
        Evento::delete($id);
        $app->response->setStatus(200);
    }  catch (PDOException $e){
        $app->response->setStatus(304);   
    }                
});

//insert
$app->post('/eventos', function() use ($app) {

    $evento = json_decode(file_get_contents('php://input'), true);
    Evento::insert($evento);
  
});
