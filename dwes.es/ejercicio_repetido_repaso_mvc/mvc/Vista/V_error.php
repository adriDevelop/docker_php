<?php

// Espacio de nombres
namespace mvc\vista;

// Creación de la clase
class V_error extends Vista{
    // Función que genera la salida
    public function genera_salida($datos): void
    {
        $this->inicio_html("Error", ['./styles/general.css', './styles/formularios.css', './styles/tabla.css']);

        echo "<h2>$datos</h2>";

        $this->fin_html();
    }
}
?>