<?php

    // Iniciamos sesión
    session_start();

    // ob_start para que no colisionen las cabeceras.
    ob_start();

    // require_once para importar el archivo.
    require_once($_SERVER['DOCUMENT_ROOT'] . "/ejercicio1_mantenimiento_estado/includes/functions.php");

    // Iniciamos nuestro html incorporandole el titulo y el css.
    inicio_html("Pantalla principal", ['../styles/styles.css']);

    // Creamos nuestro formulario.
    if ($_SERVER['REQUEST_METHOD'] == 'GET'){
        ?>
            <form action="<?=$_SERVER['PHP_SELF']?>" method="POST">
                <legend>Introduce los datos</legend>
                <fieldset>
                    <label for="nombre">Nombre</label>
                    <input type="text" name="nombre" id="nombre">
                    <label for="telefono">Teléfono</label>
                    <input type="text" name="telefono" id="telefono">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email">
                </fieldset>
                <input type="submit" name="operacion" id="operacion" value="Enviar datos">
            </form>
        <?php
    } if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        // Aqui, validamos nuestros datos una vez hagamos post y mandemos el formulario.
        $nombre = filter_input(INPUT_POST, 'nombre', FILTER_SANITIZE_SPECIAL_CHARS);
        $telefono = filter_input(INPUT_POST, 'telefono', FILTER_SANITIZE_SPECIAL_CHARS);
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $email = filter_var($email, FILTER_VALIDATE_EMAIL);

        // Almacenamos los valores recogidos en el array de la sesión.
        $_SESSION['nombre'] = $nombre;
        $_SESSION['telefono'] = $telefono;
        $_SESSION['email'] = $email;

        // No marchamos a la siguiente página, con los datos validados y dentro del array de sesión.
        header("Location: /ejercicio1_mantenimiento_estado/ejercicio4/04pantalla_modelo_motor.php");
    }


    // Almacenamos valor de ob en una variable.
    $ob_datos = ob_get_contents();
    // Eliminamos los datos almacenados en ob.
    ob_flush();

    // Finalizamos nuestro html.
    fin_html();
?>