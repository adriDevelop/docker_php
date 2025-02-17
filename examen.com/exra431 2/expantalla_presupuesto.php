<?php

    session_start();

    ob_start();

    require_once($_SERVER['DOCUMENT_ROOT'] . "/exra431/examenRA4/includes/funciones.php");
    require_once($_SERVER['DOCUMENT_ROOT'] . "/exra431/examenRA4/includes/jwt_include.php");

    $jwt = $_COOKIE['jwt'];

    $payload = verificar_token($jwt);

    inicio_html("Pantalla presupuesto", ['/exra431/examenRA4/estilos/general.css', '/exra431/examenRA4/estilos/tablas.css']);

    if ($_SERVER['REQUEST_METHOD'] == 'GET' && $payload){
        $fecha = gmdate(DATE_RSS, $_SESSION['hora_adquisicion']);
        echo "<h1>Bienvenido: Id: {$payload['id']}, nombre:{$payload['nombre']}";
        echo "<h2>Fecha de comienzo de compra de entradas: {$fecha}</h2>";
        echo "<table><thead><tr><th>Espectaculo</th><th>Número de entradas</th><th>Precio</th></tr></thead>";
        echo "<tbody>";
        foreach($_SESSION['entradas'] as $entradas){
            echo "<tr><td>$entradas[0]</td><td>$entradas[1]</td><td>$entradas[2]</td></tr>";
        }
        echo "</tbody></table>";
        echo "<a href='/exra431/expantalla_reserva_entradas.php'>Añadir otra reserva</a><br>";
        echo "<a href='/exra431/expantalla_presupuesto_final.php'>Finalizar reservas</a>";
    } else if ($_SERVER['REQUEST_METHOD'] == 'GET' && !$payload){
        echo "<p>El payload no se ha validado correctamente.</p>";
        echo "<a href='/exra431/expantalla_inicial.php'>Vuelve a intentar iniciar sesión</a>";
    }
    


    $ob_content = ob_get_contents();
    ob_flush();

    fin_html();
?>