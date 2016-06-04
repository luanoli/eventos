<?php

namespace Libs\Database;

use \PDO;

class Db {

    protected static $db = null;

    public static function connect(){

        try {    
            
            $dbuser = "root";
            $dbpass = "root";
            
            self::$db = new PDO("mysql:host=localhost;dbname=eventos_ingressos;", $dbuser, $dbpass);
            self::$db->exec("set names utf8");
            self::$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);              

            return self::$db;

        } catch(PDOException $e) {

            echo '{"error":{"text":'. $e->getMessage() .'}}'; 

        }
    }

    public static function execute($sql){

        if(self::$db == null){
            self::connect();
        }

        return self::$db->query($sql);
    }

    public static function select($sql, $seletor = null){
        
        if(self::$db == null){
           self::connect();
        }

        if(!empty($seletor)){
            if(isset($seletor['pagina']) && isset($seletor['limite'])){
                $sql = $sql . " LIMIT " . (($seletor['pagina'] - 1) * $seletor['limite']) . ", " . $seletor['limite'];
            }
        }

        $stmt = self::$db->query($sql);
        
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
    
    public static function selectOne($sql){
        
        if(self::$db == null){
           self::connect();
        }
        $stmt = self::$db->query($sql);
        
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public static function selectOneParameters($sql, $args){
        
        if(self::$db == null){
           self::connect();
        }
        $stmt = self::$db->prepare($sql);
        $stmt->execute( $args );
        
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public static function insert($table, $params){

        if(self::$db == null){
            self::connect();
        }

        $columns = self::getColumnsType($table);        
        $insert = "INSERT INTO " . $table;
        $fields = "(";
        $values = " VALUES(";

        $i = 0;    

        foreach($params as $field => $value){ 
            $isStr = false;           

            if($i>0){
                $fields .= ", ";
                $values .= ", ";
            }

            foreach($columns as $col){                
                if($col->DATA_TYPE == "varchar" && $col->COLUMN_NAME == $field && $value != 'null'){
                    $isStr = true;
                }
            }
            
            if($isStr){
                $values .= "'".$value."'";
            }else{
                $values .= $value;
            }

            $fields .= $field;            

            $i++;
        }

        $fields .= ")";
        $values .= ")";
        
        self::$db->query($insert . $fields . $values);
    }

    public static function getColumnsType($table){
        return self::$db->query("SELECT DATA_TYPE, COLUMN_NAME 
                                FROM INFORMATION_SCHEMA.COLUMNS
                                WHERE TABLE_NAME = '$table'")->fetchAll(PDO::FETCH_OBJ);        
    }    
} 

