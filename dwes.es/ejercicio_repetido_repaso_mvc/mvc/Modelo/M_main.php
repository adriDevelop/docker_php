<?php

// Espacio de nombres
namespace mvc\Modelo;

use mvc\modelo\Modelo;

// Creación de la clase
class M_main implements Modelo{

    public function despacha(): mixed
    {
        if (isset($_COOKIE['jwt'])){
            $this->cerrar_sesion();
            session_start();
        }else {
            session_start();
        }

        return true;
    }

    private function cerrar_sesion(){
        setcookie('jwt', '', time() - 60, '/');
        session_unset();
        session_destroy();
    }
}

?>