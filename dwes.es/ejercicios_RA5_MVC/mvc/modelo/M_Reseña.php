<?php

namespace mvc\modelo;

use mvc\modelo\Modelo;
use util\seguridad\Jwt;

class M_Reseña implements Modelo{
    public function despacha(): mixed
    {
        // Autenticar al usuario
        if ($_COOKIE['jwt']){
            $payload = JWT::verificar_token($_COOKIE['jwt']);
            if ($payload){
                
            }
        }

        // Accedemos a la base de datos y 
        // se leen las reseñas que se han hecho 
        // de ese producto seleccionado


    }
}

?>