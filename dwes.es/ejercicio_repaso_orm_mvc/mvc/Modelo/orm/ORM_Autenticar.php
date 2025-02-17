<?php

// Espacio de nombres
namespace mvc\Modelo\orm;

use orm\Modelo\ORMProveedor;

// Instanciación de la clase ORM_Autenticar
class ORM_Autenticar extends ORMProveedor{

    // Función que devuelve los datos de un cliente
    public function getClienteByNif(string $email){
        // Preparamos consulta SQL
        $sql = "SELECT nif, nombre, apellidos, clave, iban, telefono, email, ventas";
        $sql .= " FROM cliente";
        $sql .= " WHERE email = :email";
        $stmt = $this->pdo->prepare($sql);

        // Vinculamos los valores
        $stmt->bindValue(":email", $email);

        // Ejecutamos la consulta
        if ($stmt->execute()){
            $cliente = $stmt->fetch();
            return $cliente;
        }else{
            return "No existe ningún cliente";
        }
    }
}

?>