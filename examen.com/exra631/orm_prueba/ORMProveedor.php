<?php

// Espacio de nombres
namespace orm_prueba;

use PDO;
use PDOException;

// Creación de la clase
class ORMProveedor {

    // Tiene tres propiedades
        // La tabla a la que hace referencia el ORM
        protected string $tabla = "proveedores";
        // La clave primaria de la tabla
        protected string $clave_primaria = "nif";
        // Y la instanciación de un objeto PDO
        protected PDO $pdo;

    // Inicializamos en el constructor la conexión a la base de datos mediante la propiedad $pdo
    public function __construct(){
        try{
            // Lo primero que debemos de hacer es definir lo que compone a nuestro pdo
            $dsn = "mysql:host=mysql;dbname=tiendaol;charset=utf8mb4";
            $user = "mysql";
            $pass = "usuario";
            $opciones = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => FALSE,
            ];

            $this->pdo = new PDO($dsn, $user, $pass, $opciones);

        }catch(PDOException $pdoe){
            return $pdoe->getMessage();
        }
    }

    
    
}

?>