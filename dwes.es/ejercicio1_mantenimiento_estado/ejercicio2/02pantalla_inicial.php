<?php

    // Lo primero es iniciar la session.
    session_start();
    ob_start();
    require_once($_SERVER['DOCUMENT_ROOT'] . "/ejercicio1_mantenimiento_estado/includes/functions.php");

    inicio_html("Pagina 01", ["../styles/styles.css"]);
    // Mostramos al usuario un formulario html con un cuadro de texto al 
    // que el usuario le podrá mandar una ruta como acceso al directorio.

    // Comprobamos que primero, se accede a la página con un get.
    if ($_SERVER['REQUEST_METHOD'] == 'GET'){
        ?>
        <!-- Mostramos el formulario html para que rellene el dato el cliente con la ruta -->

        <!-- Se manda a él mismo para que, cuando hagamos una petición post, haga la comprobación
            del post que realiza desde la misma página -->
        <form action="<?=$_SERVER['PHP_SELF']?>" method="POST">
            <fieldset>
                <legend>Introduce la ruta de los archivos</legend>
                <label for="ruta">Ruta del archivo</label>
                <input type="text" name="ruta" id="ruta">
            </fieldset>
            <input type="submit" name="operacion" id="operacion">
        </form>
        <?php
    }
    // Ahora, comprobamos que se ha hecho un post a la misma página, para que realice lo que queramos
    // en este apartado.
    else if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['ruta']){
        // Declaro la ruta de los directorios recibida en el post.
        $ruta = filter_input(INPUT_POST, 'ruta', FILTER_SANITIZE_SPECIAL_CHARS);
        define("RUTA_IMAGENES", $ruta);

        
        // Si es un directorio, almaceno en sesiones el contenido y la ruta mandada.
        if (!is_readable($ruta)){
            echo "<h3>No se tienen permisos para leer el archivo</h3>";
        }
        $_SESSION['archivos_directorio'] = scandir($ruta);
        $_SESSION['ruta_mandada'] = RUTA_IMAGENES;
        header("Location: /ejercicio1_mantenimiento_estado/ejercicio2/02pantalla_imagenes.php");
    } else {
        echo "<h3>Algo no ha ido bien</h3>";
    }

    $datos_ob = ob_get_contents();
    ob_flush();

    fin_html()
    



    


?>