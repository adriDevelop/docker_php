<?php

    session_start();

    ob_start();

    require_once($_SERVER['DOCUMENT_ROOT'] . "/exrepeticion/examenRA4/includes/funciones.php");
    require_once($_SERVER['DOCUMENT_ROOT'] . "/exrepeticion/examenRA4/includes/jwt_include.php");


    inicio_html("Pantalla principal", ['/exrepeticion/examenRA4/estilos/general.css', '/exrepeticion/examenRA4/estilos/formulario.css']);
    
    if ($_SERVER['REQUEST_METHOD'] == 'GET'){
        ?>
            <form action="/exrepeticion/pantalla_carrito.php" method="POST">
                <legend>Introduce los datos para iniciar la sesión</legend>
                <fieldset>
                    <label for="nombre">Nombre</label>
                    <input type="text" name="nombre" id="nombre">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email">
                    <label for="clave">Contraseña</label>
                    <input type="password" name="clave" id="clave">
                </fieldset>
                <input type="submit" name="operacion" id="operacion" value="Inviar sesión">
            </form>
        <?php
    }

    $ob_content = ob_get_contents();
    ob_flush();

    fin_html();
?>