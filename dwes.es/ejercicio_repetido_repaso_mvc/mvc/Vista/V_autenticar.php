<?php

// Espacio de nombres
namespace mvc\Vista;

// Generación de la clase
class V_autenticar extends Vista{
    public function genera_salida($datos): void
    {
        $this->inicio_html("Bienvenido {$datos['nombre']}", ['./styles/general.css']);

        echo "<h2>Bienvenido {$datos['nombre']}</h2>";

        $this->fin_html();
    }
}

?>