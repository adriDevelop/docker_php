<?php

// Espacio de nombres
namespace mvc\Modelo;

use Exception;
use mvc\Modelo\Modelo;
use mvc\Modelo\Mvc_Orm_modelo\MvcOrmAutenticar;
use util\seguridad\Jwt;

// Generación de la clase
class M_autenticar implements Modelo{
    public function despacha(): mixed
    {
        // Recogemos los datos del formulario y los validamos
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $email = filter_var($email, FILTER_VALIDATE_EMAIL);
        $clave = $_POST['clave'];

        // Debemos de realizar una conexión a la base de datos para poder validar que el mail exista
        $mvc_orm_autenticar = new MvcOrmAutenticar();
        $cliente = $mvc_orm_autenticar->obtenClienteEmail($email);

        // Ahora, debemos validar que el cliente devuelto tenga la clave correcta y valide al cliente de forma correcta
        if (password_verify($clave, $cliente['clave'])){
            $payload = [
                'nif' => $cliente['nif'],
                'nombre' => $cliente['nombre'],
                'apellidos' => $cliente['apellidos'],
                'email' => $cliente['email']
            ];

            $jwt = Jwt::generar_token($payload);

            setcookie('jwt', $jwt, time() + 1024 * 60, '/');

            return $cliente;
        }
    }
}

?>