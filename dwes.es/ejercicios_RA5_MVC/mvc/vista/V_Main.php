<?php

namespace mvc\vista;

use mvc\vista\Vista;

class V_Main extends Vista
{
    public function genera_salida(mixed $datos):void{
        $this->inicio_html("Bienvenida e Inicio de Sesión", ['../styles/general.css', '../styles/formulario.css']);
        ?>
        <form method="POST" action="<?=$_SERVER['PHP_SELF']?>">
            <fieldset>
                <legend>Introduce los datos para iniciar sesión</legend>
                <label for="email">Email</label>
                <input type="email" name="email" id="email" placeholder="Dirección email">
                <label for="clave">Clave</label>
                <input type="password" name="clave" id="clave">
            </fieldset>
            <button type="submit" id="idp" name="idp" value="autenticar">Enviar</button>
        </form>
        <?php
        $this->fin_html();
    }
}
?>