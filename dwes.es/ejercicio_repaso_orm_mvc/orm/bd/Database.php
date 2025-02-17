<?php

// Espacio de nombres
namespace orm\bd;

use PDO;
use PDOException;

// Creación de la clase
class Database{

    // Propiedades de Database
    protected static $instance = null;
    protected PDO $pdo;

    public function __construct(){
        // Ahora, en el constructor, añadimos la conexión a la base de datos con un trycatch
        try{
            $dsn = "mysql:host=mysql;dbname=tiendaol;charset=utf8mb4";
            $user = "usuario";
            $pass = "usuario";
            $options =  [   
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => FALSE
            ];

            // Instanciamos nuestro PDO
            $this->pdo = new PDO($dsn, $user, $pass, $options);
        }catch(PDOException $e){
            echo "Ha ocurrido un error con código: " . $e->getCode();
            echo "El mensaje del error es: " . $e->getMessage();
        }
    }

    public static function getInstance(): Database{
        if (self::$instance === null){
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getPDO(){
        return $this->pdo;
    }

}

?>