<?php

// Espacio de nombres
namespace orm\Modelo;

use PDO;
use PDOException;

// Instanciación de la clase ORMProveedor
class ORMProveedor {
    // Propiedades que tiene la clase ORMProveedor
    protected string $tabla = "proveedor";
    protected string $clave_primaria = "nif";

    protected PDO $pdo;

    // Ahora, en el constructor, añadimos la conexión a la base de datos con un trycatch
    public function __construct(){
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
}

?>