<?php

// Primero inciamos nuestra sesión.
session_start();

// Controlamos los errores que nos pueden dar las cabeceras.
ob_start();

// Importamos los ficheros necesarios.
require_once($_SERVER['DOCUMENT_ROOT'] . "/ejercicio1_mantenimiento_estado/includes/functions.php");
require_once("03jwt_include.php");

// Tenemos que hacer la comprobación del payload como anteriormente.

// Obtenemos el 'jwt' de la cookie.
$jwt = $_COOKIE['jwt'];

// Y verificamos correctamente para obtener el payload.
$payload = verificar_token($jwt);

// Iniciamos nuestro html
inicio_html("Pantalla muestra comentarios", ['../styles/styles.css', '../styles/tablas.css']);

// Y ya comenzamos a trabajar.
if ($_SERVER['REQUEST_METHOD'] == 'GET' && $payload){

    // Mostramos un mensaje de bienvenida al usuario en el que le decimos que vea sus comentarios.
    echo "<h1>Hola {$payload['id']}, estos son tus comentarios.</h1>";

    // Y mostramos los comentarios con un foreach. Vamos a crear una tabla para que se vean mejor.
    echo "<table><thead><tr><th>Asignatura</th><th>Comentario</th></tr></thead>";
    echo "<tbody>";

    foreach($_SESSION['seleccion'] as $comentario){
        echo "<tr><td>{$comentario[0]}</td><td>{$comentario[1]}</td></tr>";
    }

    echo "</tbody></table>";

    // Y vamos a mostrar unos botones para que vuelva y para que vaya a la siguiente.
    echo "<a href='/ejercicio1_mantenimiento_estado/repeticion_ejercicio_08/08introduce_comentario.php'>Introduce otro comentario</a>";
    echo "<p>Ó bien</p>";
    // Ahora veremos que hacemos con este último echo para poder cerrar la sesión, pero, vamos a comprobar que funciona.
    // Ahora, es cuando vamos a trabajar con el cerrado de sesión. Para ello, como hoy ha sido la primera vez que lo he visto,
    // puede ser que vea mucho la práctica que hice antes. Jeje.
    echo "<a href='/ejercicio1_mantenimiento_estado/repeticion_ejercicio_08/08pantalla_inicial.php?operacion=cerrar'>Cierra sesión</a>";

    // Eso está bien. Pero ¿y si accedemos a nuestro usuario?
    // SOLO HAY UN SOLO COMENTARIO.
    // Eso es porque ha funcionado correctamente.

    // Espero que sirva de ayuda el video chicxs. Muy buena suerte y despues hacemos otro ejercicio si quereís. Me voy que ya llego a Córdoba.
    // Chaitooo.
}

// Y cerramos todo.
// Comenzamos almacenando los valores de nuestro ob.
$ob_cabeceras = ob_get_contents();
// Cerramos ob.
ob_flush();

// Cerramos nuestro html.
fin_html();

?>