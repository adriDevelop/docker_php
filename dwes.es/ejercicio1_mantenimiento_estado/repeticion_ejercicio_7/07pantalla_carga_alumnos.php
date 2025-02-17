<?php

session_start();

ob_start();

require_once($_SERVER['DOCUMENT_ROOT'] . "/ejercicio1_mantenimiento_estado/includes/functions.php");
require_once("03jwt_include.php");

inicio_html("Pantalla carga usuarios", ['../styles/styles.css', '../styles/tablas.css']);

$jwt = $_COOKIE['jwt'];

$payload = verificar_token($jwt);

if ($_SERVER['REQUEST_METHOD'] == 'GET' && $payload){

    echo "<h1>Bienvenido {$payload['nombre']}</h1>";

    echo "<p>Bienvenido a la pantalla de carga de usuarios</p>";

    $valores_csv = fgetcsv(fopen("./alumnos.csv", 'r'), 10000, ',');

    if (($gestor = fopen("./alumnos.csv", 'r')) !== FALSE) {
        while (($datos = fgetcsv($gestor, 1000, ",")) !== FALSE) {
            $numero = count($datos);
            echo "<table><tbody>";
            echo "<tr>";
            for ($c=0; $c < $numero; $c++) {
                echo "<td>$datos[$c]</td>";
            }
            if ($datos !== $valores_csv) {
                echo "<td><input type='checkbox' value='{$datos[0]}'></td>";
            }
        }
        fclose($gestor);
    }

    echo "</tbody></table>";

}



$contenido_ob = ob_get_contents();
ob_flush();

fin_html();

?>