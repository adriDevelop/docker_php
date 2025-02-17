<?php

// Espacio de nombres
namespace mvc\Vista;
use mvc\Vista\Vista;

// Creación de la vista clase V_Main que extiende de la clase Vista
class V_Main extends Vista{
    public function gestiona_vista(mixed $datos): void
    {
        $this->inicio_html("Inicio sesión", ['./styles/general.css', './styles/formulario.css']);
        echo "<h1>Bienvenido al inicio de sesión</h1>";
        ?>
        <form action="<?=$_SERVER['PHP_SELF']?>" method="POST">
            <fieldset>
                <legend>Inicia sesión con tus datos de cliente</legend>
                <label for="email">Email</label>
                <input type="email" name="email" id="email" required>
                <label for="clave">Clave</label>
                <input type="password" name="clave" id="clave" required>
            </fieldset>
            <button type="submit" id="idp" name="idp" value="autenticar">Inicia sesión</button>
        </form>
        <?php
    }
}


?>