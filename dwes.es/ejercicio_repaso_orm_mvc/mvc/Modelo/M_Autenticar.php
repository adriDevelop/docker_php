<?php

// Espacio de nombres
namespace mvc\Modelo;

use mvc\Modelo\Modelo;
use mvc\Modelo\orm\ORM_Autenticar;
use util\seguridad\Jwt;

// Instanciación de la clase
class M_Autenticar implements Modelo{
    // Función que es implementada de Modelo
    public function despacha(): mixed
    {
        // Saneación y validación de datos
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $email = filter_var($email, FILTER_VALIDATE_EMAIL);

        // Compruebo obtengo el cliente que obtenga
        $orm_autenticar = new ORM_Autenticar();
        $cliente = $orm_autenticar->getClienteByNif($email);
    
        // Verifico su contraseña introducida con la de la Base de datos
        if (password_verify($_POST['clave'], $cliente['clave'])){
            // Genero el payload
            $payload = [
                'nif' => $cliente['nif'],
                'nombre' => $cliente['nombre'],
                'apellidos' => $cliente['apellidos'],
                'email' => $cliente['email']
            ];
            // Genero el JWT
            $jwt = JWT::generar_token($payload);
            // Genero la cookie
            setcookie('jwt', $jwt, time() + 1024*60, "/");

            return $cliente;
        }
    }
}

?>