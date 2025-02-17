<?php

namespace mvc\modelo\orm_mvc;

use Exception;
use orm\Entidad\Entidad;
use orm\modelo\ORMCliente;

class ORM_Mvc_Autenticar extends ORMCliente{

    // Función que devuelve al usuario encontrado
    public function getUsuario(string $email): array{

        // Preparamos la consulta SQL
        $sql = "SELECT nif, nombre, apellidos, clave, iban, telefono, email, ventas";
        $sql.= " FROM cliente";
        $sql.= " WHERE email = :email";
        $stmt = $this->pdo->prepare($sql);

        // Vinculamos los valores
        $stmt->bindValue(":email", $email);

        // Ejecutamos la consulta
        if ($stmt->execute()){
            $cliente = $stmt->fetch();
            if ($cliente){
                return $cliente;
            } else {
                return null;
            }
        }
    }

    // Función para obtener los artículos
    public function getProductos(): array{

        // Preparamos la consulta SQL
        $sql = "SELECT referencia, descripcion, pvp, dto_venta, und_disponibles, categoria";
        $sql.= " FROM articulo";
        $stmt = $this->pdo->prepare($sql);

        // Ejecutamos la consulta
        if ($stmt->execute()){
            $elementos = $stmt->fetchAll();
            return $elementos;
        }else{
            throw new Exception("La consulta está mal gestionada", 4003);
        }
    }

}

?>