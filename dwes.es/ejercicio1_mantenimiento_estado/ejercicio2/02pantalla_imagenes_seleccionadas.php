<?php
    session_start();
    ob_start();
    require_once($_SERVER['DOCUMENT_ROOT'] . "/ejercicio1_mantenimiento_estado/includes/functions.php");
    inicio_html("Imagenes seleccionadas", ['../styles/styles.css']);

    echo "<h3>Imagenes seleccionadas</h3>";
    if ($_SERVER['REQUEST_METHOD'] == 'GET' && $_SESSION['imagenes_seleccionadas']){
        foreach($_SESSION['imagenes_seleccionadas'] as $value){
            $ruta = $_SESSION['ruta_mandada'] . "/$value";
            echo "<img src='$ruta'><br>";
        }
    echo "<a href=/ejercicio1_mantenimiento_estado/ejercicio2/02pantalla_inicial.php>Volver al inicio</a>";
    }

    $header_ob = ob_get_contents();
    ob_flush();
    fin_html();

?>