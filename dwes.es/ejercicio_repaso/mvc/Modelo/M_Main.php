<?php

// Espacio de nombres
namespace mvc\Modelo;

use mvc\Modelo\Modelo;

// Instanciamos la clase M_Main que implementa de Modelo
class M_Main implements Modelo{

    public function despacha(): mixed
    {
        if (isset($_COOKIE['jwt'])){
            $this->usuario_logueado();
            session_start();
        }else {
            session_start();
        }

        return true;
    }

    public function usuario_logueado(){
        setcookie('jwt', '', time()-60, "/");
        session_unset();
        session_destroy();
    }
}

?>