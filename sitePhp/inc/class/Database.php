<?php
class Database{



    public static $host="localhost";
    public static $dbName="site";
    public static $username="root";
    public static $password="";



    public static function connect(){
      $pdo = new PDO("mysql:host=".self::$host.";dbname=".self::$dbName.";charset=utf8", self::$username, self::$password);
      $pdo-> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      return $pdo;
    }


    public static function query($query, $params = array()){
      $statement = self::connect()->prepare($query);
      $statement->execute($params);
      if(explode(' ',$query)[0]=='SELECT'){
        $data= $statement->fetchALL();
        return $data;
      }
    }

    public static function queryp($query, $params = array()){
      $statement = self::connect()->prepare($query);
      $statement->execute($params);
      if(explode(' ',$query)[0]=='SELECT'){
        $data= $statement->fetch(PDO::FETCH_ASSOC);
        return $data;
      }

    }

    public static function queryq($query, $params = array()){
      $statement = self::connect()->prepare($query);
      $statement->execute($params);
      if(explode(' ',$query)[0]=='SELECT'){
        $data= $statement->fetchALL(PDO::FETCH_ASSOC);
        return $data;
      }
    }
}
 ?>
