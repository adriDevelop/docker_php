<?php

// Iniciamos sesion.
session_start();

// Controlamos las cabeceras.
ob_start();

// Importamos los archivos necesarios.
require_once($_SERVER['DOCUMENT_ROOT'] . "/ejercicio1_mantenimiento_estado/includes/functions.php");
require_once("03jwt_include.php");

// Controlamos jwt y validarlo.

// Lo almacenamos en una variable trayendo los datos del array de la cookie.
$jwt = $_COOKIE['jwt'];

// Validamos el jwt y obtenemos el payload.
$payload = verificar_token($jwt);

// Iniciamos html.
inicio_html("Pantalla lista comentarios", ['../styles/styles.css', '../styles/tablas.css']);

// Comenzamos con la aplicación.
if ($_SERVER['REQUEST_METHOD'] == 'GET' && $payload && $_SESSION['comentario']){

    echo "<h1>Listado de los comentarios del ususario {$payload['id']}</h1>";

    // Listamos los comentarios que tenemos almacenados en Session.
    echo "<table><thead><tr><th>Asignatura<th>Comentario</th></tr></thead>";
    echo "<tbody>";
        foreach($_SESSION['comentario'] as $comentario){
             echo  "<tr><td>{$comentario[0]}</td><td>{$comentario[1]}</td></tr>";
    }
    echo "</tbody></table>";
?>

    <p>
        <a href="/ejercicio1_mantenimiento_estado/ejercicio8/08introduccion_comentarios.php">Vuelve a la pantalla anterior</a>
        Ó bien, navega a la siguiente:
        <a href="/ejercicio1_mantenimiento_estado/ejercicio8/08pantalla_inicial.php?operacion=cerrar">Cierra sesión</a>
    </p>

<?php

}






// Almacenamos valores de las cabeceras borramos las cabeceras.
$cabeceras = ob_get_contents();
ob_flush();

// Finalizamos nuestro html.
fin_html();
?>