<?php

namespace Models;

use Libs\Database\Db;

class ClienteEvento {

    public static function getAll(){
        $sql = " SELECT ";
        $sql .= " eventos.id, eventos.nome, eventos.organizador, eventos.data_realizacao, " ;
        $sql .= " eventos.descricao, eventos.publicado, eventos.lotacao_maxima, tipos.nome as tipo ";
        $sql .= " FROM eventos ";
        $sql .= " LEFT JOIN tipos ON eventos.id_tipo = tipos.id ";
        $sql .= " WHERE eventos.publicado = 1 AND eventos.data_realizacao >= CURDATE() ";
        $sql .= " AND eventos.lotacao_maxima > (select count(*) from consumidores where consumidores.id_evento = eventos.id )";

        $lista = Db::select($sql);

        $eventos = array();

        foreach($lista as $e){

            $evento = array();
            $evento['id'] = $e->id;
            $evento['nome'] = $e->nome;
            $evento['organizador'] = $e->organizador;
            $evento['data_realizacao'] = $e->data_realizacao;
            $evento['descricao'] = $e->descricao;
            $evento['tipo'] = $e->tipo;

            $eventos[$e->data_realizacao]['data'] = $e->data_realizacao;
            $eventos[$e->data_realizacao]['eventos'][] = $evento;

        }

        return $eventos;
    }

    public static function getById($id){
        $sql = "SELECT * FROM eventos WHERE id = " . $id;
        return Db::selectOne($sql);
    }

    public static function insert($evento){

        $evento['codigo'] = md5(uniqid(""));

        print_r($evento['codigo']);

        $sql = "INSERT INTO consumidores (cpf, id_evento, codigo) VALUES ('" .
        $evento['cpf'] . "', '" .
        $evento['id_evento'] . "', '" .
        $evento['codigo'] . "')";

        Db::execute($sql);
    }

}