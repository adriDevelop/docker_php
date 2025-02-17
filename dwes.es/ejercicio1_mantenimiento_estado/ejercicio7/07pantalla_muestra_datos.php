<?php

    // Iniciamos la sesion.
    session_start();

    // Iniciamos ob para las cabeceras.
    ob_start();

    // Importamos fichero includes.
    require_once($_SERVER['DOCUMENT_ROOT'] . "/ejercicio1_mantenimiento_estado/includes/functions.php");

    inicio_html("Pantalla datos", ['../styles/styles.css']);

    // Iniciamos html.
    if ($_SERVER['REQUEST_METHOD'] == 'GET' && $_SESSION['dni'] && $_SESSION['nombre'] && $_SESSION['registro'] && $_SESSION['curriculum']){
        echo "<h1>Todos los datos están recogidos</h1>";
        var_dump($_SESSION['curriculum']);
        $curriculum = str_replace("'", "", $_SESSION['curriculum']['name']);
        echo "$curriculum<br>";
        // Validamos si el archivo subido es un pdf.
        $mime_type = $_SESSION['curriculum']['type'];

    
         echo "<a href='{$_SERVER['PHP_SELF']}?curriculum=$curriculum'>Descargar documento</a>";
         echo "<a href='/ejercicio1_mantenimiento_estado/ejercicio7/07pantalla_principal.php'>Volver al inicio</a>";
        
        }else if ($_SERVER['REQUEST_METHOD'] == 'GET'){
        $curriculum = $_GET['curriculum'];
        readfile("$curriculum");
    }

    // Finalizamos nuestro ob.
    $ob_datos = ob_get_contents();
    ob_flush();

    // Finalizamos html.
    fin_html();

?>