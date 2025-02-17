<?php

// Espacio de nombres
namespace mvc\Modelo\Mvc_Orm_modelo;

use orm\modelo\ORMCliente;

// Creación de la clase
class MvcOrmAutenticar extends ORMCliente{
    
    public function obtenClienteEmail($email){
        // Generamos la sentencia SQL
        $sql = "SELECT nif, nombre, apellidos, clave, telefono, email ";
        $sql .= "FROM cliente ";
        $sql .= "WHERE email = :email";
        $stmt = $this->pdo->prepare($sql);

        $stmt->bindValue(":email", $email);

        if ($stmt->execute()){
            $cliente = $stmt->fetch();
            return $cliente;
        }else {
            return "No existe ningún cliente con ese email";
        }
    }
}

?>