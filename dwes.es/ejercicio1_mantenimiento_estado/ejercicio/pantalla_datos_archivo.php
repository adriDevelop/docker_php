<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['seleccion_archivo'])){
    $archivo = $_POST['seleccion_archivo'];
    $tipo_mime = mime_content_type($_SESSION['route'] . "/$archivo");
    $tamaño = filesize($_SESSION['route'] . "/$archivo");
    echo "<p>Tipo mime del archivo: $tipo_mime</p>";
    echo "<p>Tamaño del archivo: $tamaño</p>";
    echo "<p>Nombre del archivo: $archivo</p>";
    echo "<a href='/ejercicio1_mantenimiento_estado/ejercicio/pantalla_inicial.php'>Volver al inicio</a> <a href='{$_SERVER['PHP_SELF']}?seleccion_archivo=$archivo'>Descargar documento</a>";
} elseif($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['seleccion_archivo'])){
    $archivo = $_GET['seleccion_archivo'];
    $tipo_mime = mime_content_type($_SESSION['route'] . "/$archivo");
    $tamaño = filesize($_SESSION['route'] . "/$archivo");
    header("Content-type: $tipo_mime");
    header("Content-disposition: attachment;filename=$archivo");
    header("Content-length: $tamaño");
    readfile($_SESSION['route'] . "/$archivo");
}



?>