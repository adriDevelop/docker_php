<?php

namespace mvc\modelo;

use Exception;
use mvc\modelo\orm_mvc\ORM_Mvc_Autenticar;
use mvc\modelo\Modelo;
use util\seguridad\Jwt;

class M_Autenticar implements Modelo{
    public function despacha(): mixed
    {
        // Validamos los valores del formulario
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $email = filter_var($email, FILTER_VALIDATE_EMAIL);

        $clave = $_POST['clave'];

        // Debemos de autenticar al usuario y si el usuario no existe debemos de mandar una excepcion
        $orm_mvc_autenticar = new ORM_Mvc_Autenticar();
        $cliente = $orm_mvc_autenticar->getUsuario($email);

        // Si existe devolvemos al usuario autenticado
        if ($cliente){
            if (password_verify($clave, $cliente['clave'])){

                // Genero un payload
                $payload = [
                    'nombre' => $cliente['nombre'],
                    'apellidos' => $cliente['apellidos'],
                    'email' => $cliente['email'],
                    'nif' => $cliente['nif']
                ];

                // Genero un token para el usuario autenticado
                $jwt = JWT::generar_token($payload);

                // Y creo la cookie
                setcookie('jwt', $jwt, time() + 1024 * 60, "/");

                // Almaceno en la sesión el valor de lo que nos sea 
                // necesario
                $_SESSION['cliente'] = $cliente['nombre'] . " " . $cliente['apellidos'];

                // Devuelvo el usuario autenticado
                $productos = $orm_mvc_autenticar->getProductos();
                return $productos;
            } else {
                throw new Exception("El usuario no se ha autenticado correctamente", 4002);
            }
        }else {
            throw new Exception("No existe el usuario indicado", 4001);
        }
    }
}
?>