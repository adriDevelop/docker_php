<?php

// Iniciamos sesión.
session_start();

// Iniciamos ob para el control de las cabeceras.
ob_start();

// Inicamos la importación de nuestras funciones.
require_once($_SERVER['DOCUMENT_ROOT'] . "/ejercicio1_mantenimiento_estado/includes/functions.php");

// Iniciamos el html.
inicio_html("Pantalla modelo, motor", ['../styles/style.css']);

if($_SERVER['REQUEST_METHOD'] == 'GET' && $_SESSION['nombre'] && $_SESSION['telefono'] && $_SESSION['email'] && $_SESSION['motor'] && $_SESSION['modelo_vehiculo']){
    echo "Tipo de motor: {$_SESSION['motor']}<br>";
    echo "Modelo de vehículo: {$_SESSION['modelo_vehiculo']}<br>";
}

// Recogemos nuestros datos de ob.
$ob_datos = ob_get_contents();
// Eliminamos todos los datos de nuestro ob.
ob_flush();


// Finalizamos nuestro html.
fin_html();

?>