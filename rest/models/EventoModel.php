<?php

namespace Models;

use Libs\Database\Db;

class Evento {

    public static function getAll(){
        $sql = " SELECT "; 
        $sql .= " eventos.id, eventos.nome, eventos.organizador, eventos.data_realizacao, " ;
        $sql .= " eventos.descricao, eventos.publicado, eventos.lotacao_maxima, tipos.nome as tipo ";
        $sql .= " FROM eventos "; 
        $sql .= " LEFT JOIN tipos ON eventos.id_tipo = tipos.id ";
        
        return Db::select($sql);
    }

    public static function getById($id){
        $sql = "SELECT * FROM eventos WHERE id = " . $id;
        return Db::selectOne($sql);
    }

    public static function insert($evento){

        print_r($evento);

        $sql = "INSERT INTO eventos (nome, data_realizacao, organizador, descricao, lotacao_maxima, id_tipo, publicado) VALUES ('" .
        $evento['nome'] . "', '" .
        $evento['data_realizacao'] . "', '" .
        $evento['organizador'] . "', '" .
        $evento['descricao'] . "', '" .
        $evento['lotacao_maxima'] . "', " .
        $evento['id_tipo'] . ", " .
        $evento['publicado'] . ")";

        Db::execute($sql);
    }

    public static function update($evento){

        $sql = "UPDATE eventos SET " .
                "nome = '" . $evento->nome . "', " .
                "data_realizacao = '" . $evento->data_realizacao . "', " .
                "organizador = '" . $evento->organizador . "', " .
                "descricao = '" . $evento->descricao . "', " .
                "lotacao_maxima = '" . $evento->lotacao_maxima . "', " .
                "id_tipo = " . $evento->id_tipo . ", " .
                "publicado = " . $evento->publicado .
                " WHERE id = " . $evento->id;

        if(Db::execute($sql)){
            return true;
        }else{
            return false;
        }
    }

    public static function delete($id){
        $sql = "DELETE FROM eventos WHERE id = " . $id;

        if(Db::execute($sql)){
            return true;
        }else{
            return false;
        }
    }

}