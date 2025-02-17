<?php

// Creamos la sesión.
session_start();

// Abrimo sun bloque ob.
ob_start();

// Importamos nuestro archivo de funciones.
require_once($_SERVER['DOCUMENT_ROOT'] . "/ejercicio1_mantenimiento_estado/includes/functions.php");
require_once("03jwt_include.php");

// Inicializamos nuestro html.
inicio_html("Bienvenida", ['/styles/styles.css']);

// Validamos payload.
$jwt = $_COOKIE['jwt'];

$payload = verificar_token($jwt);

if ($_SERVER['REQUEST_METHOD'] == 'GET' && $payload){

    echo "<h1>Bienvenido {$payload['id']}</h1>";
    echo "<a href='/ejercicio1_mantenimiento_estado/ejercicio8/08introduccion_comentarios.php'>Siguiente pantalla</a>";
    
}

// Almacenamos y borramos el valor de ob.
$ob_datos = ob_get_contents();
ob_flush();

fin_html();

?>