<?php

// Espacio de nombres
namespace mvc\Vista;

use mvc\Vista\Vista;

// Instanciamos la clase V_Error que extiende de Vista
class V_Error extends Vista{

    public function genera_salida(mixed $datos): void
    {
        Vista::inicio_html("Error", ['./styles/general.css']);

        echo "<h2>{$datos->getMessage()}</h2>";

        Vista::fin_html();
    }
}

?>