<?php

// Generamos el espacio de nombres
namespace mvc\modelo;

use mvc\modelo\Modelo;

// Generamos la clase
class M_Main implements Modelo{
    // Generamos el metodo implementado en la interfaz
    public function despacha(): mixed
    {
        // Se debe iniciar sesión y si ya estaba iniciada se 
        // cierra sesión
        if (isset($_COOKIE['jwt'])){
            $this->sin_usuario_autenticado();
        } else {
            $this->con_usuario_autenticado();
        }
        return True;
    }

    public function sin_usuario_autenticado(){
        session_start();
    }

    public function con_usuario_autenticado(){
        $_COOKIE['jwt'] = '';
        session_unset();
        session_destroy();
    }
}
?>