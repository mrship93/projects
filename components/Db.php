<?php



class Db
{
    
    public static function getConnection()
    {
        

        

        $dsn = "mysql:host=localhost;dbname=phpshop";
        $db = new PDO($dsn, 'root', '');
        $db->exec("set names utf8");
        
        return $db;
    }

}
