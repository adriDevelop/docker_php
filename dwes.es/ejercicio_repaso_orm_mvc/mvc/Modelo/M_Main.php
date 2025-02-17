<?php

// Espacio de nombres
namespace mvc\Modelo;
use mvc\Modelo\Modelo;
// Instanciación de la clase que implementa de Modelo
class M_Main implements Modelo{

    // Método implementado de Modelo
    public function despacha():mixed
    {
        if (isset($_COOKIE['jwt'])){
            $this->con_usuario_autenticado();
            session_start();
        }else {
            session_start();
        }
        return true;
    }

    public function con_usuario_autenticado(){
        setcookie('jwt', '', time()-60, "/");
        session_unset();
        session_destroy();
    }
}
?>