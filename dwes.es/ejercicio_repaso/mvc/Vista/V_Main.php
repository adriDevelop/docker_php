<?php

// Espacio de nombres
namespace mvc\Vista;

use mvc\Vista\Vista;

// Instanciamos la clase V_Main que extiende de Vista
class V_Main extends Vista{

    public function genera_salida(mixed $datos): void
    {
        Vista::inicio_html("Inicia sesión", ['./styles/general.css', './styles/formulario.css']);
        echo "<h1>Bienvenido inicia sesión</h1>"
        ?>
        <form action='<?=$_SERVER['PHP_SELF']?>' method="POST">
            <fieldset>
                <legend>Introduce los datos</legend>
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
                <label for="clase">Clave</label>
                <input type="password" id="clave" name="clave" required>
            </fieldset>
            <button type="submit" id="idp" name="idp" value="autenticar">Login</button>
        </form>
        <?php
        Vista::fin_html();
    }
}

?>