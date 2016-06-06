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
        //$sql .= " AND eventos.lotacao_maxima > (select count(*) from consumidores where consumidores.id_evento = eventos.id ) ";
        $sql .= " ORDER BY eventos.data_realizacao ";

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

        $sql = " SELECT ";
        $sql .= " eventos.id, eventos.nome, eventos.organizador, eventos.data_realizacao, " ;
        $sql .= " eventos.descricao, eventos.lotacao_maxima, tipos.nome as tipo, ";
        $sql .= " IF(eventos.lotacao_maxima > (select count(*) from consumidores where consumidores.id_evento = eventos.id), true, false) as disponivel ";
        $sql .= " FROM eventos ";
        $sql .= " LEFT JOIN tipos ON eventos.id_tipo = tipos.id ";
        $sql .= " WHERE eventos.id = " . $id . " AND eventos.publicado = 1 AND eventos.data_realizacao >= CURDATE() ";

        return Db::selectOne($sql);
    }

    public static function insert($inscricao){

        $sql = " SELECT * FROM consumidores WHERE cpf = '" . $inscricao->cpf . "' AND id_evento = " . $inscricao->id_evento;

        $insc = Db::selectOne($sql);

        if($insc == null){
            $inscricao->codigo = md5(uniqid(""));

            $sql = "INSERT INTO consumidores (cpf, id_evento, codigo) VALUES ('" .
            $inscricao->cpf . "', '" .
            $inscricao->id_evento . "', '" .
            $inscricao->codigo . "')";

            $idInscricao = Db::execute($sql);

            $sql2 = " SELECT * FROM consumidores WHERE id = " . $idInscricao;
            $novaInsc = Db::selectOne($sql2);

            return $novaInsc->codigo;

        }else{
            return $insc->codigo;
        }
    }

}