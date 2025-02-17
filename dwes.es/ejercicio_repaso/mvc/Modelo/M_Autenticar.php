<?php

// Espacio de nombres
namespace mvc\Modelo;

use mvc\Modelo\Modelo;
use mvc\Modelo\Mvc_Orm_Autenticar\Mvc_Orm_Autenticar;
use util\seguridad\Jwt;

// Instanciamos la clase M_Autenticar que implementa de Modelo
class M_Autenticar implements Modelo{
    public function despacha():mixed{

        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $email = filter_var($email, FILTER_VALIDATE_EMAIL);

        $mvc_orm_autenticar = new Mvc_Orm_Autenticar();
        $datos = $mvc_orm_autenticar->clientePorEmail($email);

        if (password_verify($_POST['clave'], $datos['clave'])){
            $payload = [
                'nombre' => $datos['nombre'],
                'email' => $datos['email'],
                'nif' => $datos['nif']
            ];

            $jwt = JWT::generar_token($payload);
            setcookie('jwt', $jwt, time() + 1024 * 60, "/");

            $_SESSION['email'] = $datos['email'];
            return $datos;
        }
    }
}

?>