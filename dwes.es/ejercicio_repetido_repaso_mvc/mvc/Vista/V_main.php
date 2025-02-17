<?php

// Espacio de nombres
namespace mvc\vista;

use mvc\Vista\Vista;

class V_main extends Vista{

    public function genera_salida($datos): void
    {
        $this->inicio_html("Bienvenido al login de la aplicación", ['./styles/general.css', './styles/formulario.css']);
        echo "<h1>Bienvenido al inicio de sesión de la aplicación</h1>";
        ?>
        <form action="<?=$_SERVER['PHP_SELF']?>" method="POST">
            <fieldset>
                <legend>Bienvenido, inicia sesión</legend>
                <label for="email">Email</label>
                <input type="email" name="email" id="email" required>
                <label for="clave">Clave</label>
                <input type="password" name="clave" id="clave" required>
            </fieldset>
            <button type="submit" id="idp" name="idp" value="autenticar">Autenticarse</button>
        </form>
        <?php
        $this->fin_html();
    }
}

?>