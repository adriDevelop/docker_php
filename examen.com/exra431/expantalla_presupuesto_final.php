<?php

    session_start();

    ob_start();

    require_once($_SERVER['DOCUMENT_ROOT'] . "/exra431/examenRA4/includes/funciones.php");
    require_once($_SERVER['DOCUMENT_ROOT'] . "/exra431/examenRA4/includes/jwt_include.php");

    $jwt = $_COOKIE['jwt'];

    $payload = verificar_token($jwt);

    inicio_html("Pantalla presupuesto final", ['/exra431/examenRA4/estilos/general.css', '/exra431/examenRA4/estilos/tablas.css']);

    if ($_SERVER['REQUEST_METHOD'] == 'GET' && $payload){
        $fecha = gmdate(DATE_RSS, $_SESSION['hora_adquisicion']);
        echo "<h1>Bienvenido: Id: {$payload['id']}, nombre:{$payload['nombre']}";
        echo "<h2>Fecha de comienzo de compra de entradas: {$fecha}</h2>";
        echo "<table><thead><tr><th>Espectaculo</th><th>Número de entradas</th><th>Precio</th><th>Precio Total</th></tr></thead>";
        echo "<tbody>";
        $total = 0;
        foreach($_SESSION['entradas'] as $entradas){
            $precio = $entradas[1] * $entradas[2];
            $total += $precio;
            echo "<tr><td>$entradas[0]</td><td>$entradas[1]</td><td>$entradas[2]</td><td>$precio</td></tr>";
        }
        echo "</tbody></table>";
        echo "<br><table><tr><td>Precio total</td><td>$total</td></tr></table><br>";
        echo "<a href='/exra431/expantalla_inicial.php?operacion=cerrar'>Finalizar reservas</a>";
    } else if ($_SERVER['REQUEST_METHOD'] == 'GET' && !$payload){
        echo "<p>El payload no se ha validado correctamente.</p>";
        echo "<a href='/exra431/expantalla_inicial.php'>Vuelve a intentar iniciar sesión</a>";
    }
    

    $ob_content = ob_get_contents();
    ob_flush();

    fin_html();
?>