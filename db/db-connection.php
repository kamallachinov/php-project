<?php

class DatabaseConnection {
    private static $connection;

    public static function getConnection(): mysqli
    {
        if (self::$connection === null) {
            self::$connection = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME, DB_PORT);

            if (self::$connection->connect_error) {
                die("Connection failed: " . self::$connection->connect_error);
            }
        }

        return self::$connection;
    }
}

//class Human {

//    private $name;
//    public static $alias = "";
//
//    public function __construct(string $name) {
//        $this->name = $name;
//        self::$alias = $name;
//    }
//
//    public function getName() {
//        return $this->name;
//    }
//}
//
//$shahin = new Human("Shahin");
//$kamal = new Human("Kamal");
//
//
//var_dump($shahin->getName());
//var_dump($kamal->getName());
//var_dump(Human::$alias);
