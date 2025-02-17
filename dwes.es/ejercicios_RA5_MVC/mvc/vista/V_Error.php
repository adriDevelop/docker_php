<?php

namespace mvc\vista;
require_once($_SERVER['DOCUMENT_ROOT'] . '/ejercicios_RA5_MVC/mvc/vista/Vista.php');

use mvc\vista\Vista;

class V_Error extends Vista{
    public function genera_salida(mixed $datos): void
    {
        echo "El error es el siguiente: " . $datos->getMessage();
    }
}
?>