<?php

// Espacio de nombres
namespace mvc\Vista;

// Instanciación de la clase Vista V_Autenticar que extiende de Vista
class V_Autenticar extends Vista{

    public function gestiona_vista(mixed $datos): void
    {
        echo "<h2>Bienvenido {$datos['nombre']}</h2>";
    }
}


?>