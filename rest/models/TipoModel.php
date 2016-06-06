<?php

namespace Models;

use Libs\Database\Db;

class Tipo {

    public static function getAll(){
        $sql = "SELECT * FROM tipos";
        return Db::select($sql);
    }    

}