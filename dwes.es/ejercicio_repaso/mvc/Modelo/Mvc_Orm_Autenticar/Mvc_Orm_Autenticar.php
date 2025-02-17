<?php

// Espacio de nombres
namespace mvc\Modelo\Mvc_Orm_Autenticar;

use Exception;
use orm\modelo\ORMCliente;

// Instanciamos la clase Mvc_Orm_Autenticar
class Mvc_Orm_Autenticar extends ORMCliente{

    // Función que devuelva al cliente
    public function clientePorEmail(string $email):array{
        // Preparamos la consulta sql
        $sql = "SELECT nombre, apellidos, nif, email, clave";
        $sql.= " FROM cliente";
        $sql.= " WHERE email = :email";
        $stmt=$this->pdo->prepare($sql);

        // BindValue
        $stmt->bindValue(":email", $email);

        // Ejecutamos la consulta
        if ($stmt->execute()){
            $datos = $stmt->fetch();
            return $datos;
        } else {
            throw new Exception("No se ha encontrado un usuario");
        }
    }

}

?>