<?php

    session_start();

    ob_start();

    require_once($_SERVER['DOCUMENT_ROOT'] . "/exra431/examenRA4/includes/funciones.php");
    require_once($_SERVER['DOCUMENT_ROOT'] . "/exra431/examenRA4/includes/jwt_include.php");

    inicio_html("Pantalla reserva entradas", ['/exra431/examenRA4/estilos/general.css', '/exra431/examenRA4/estilos/formulario.css']);

    // Recuperamos el payload.
    $jwt = $_COOKIE['jwt'];

    $payload = verificar_token($jwt);

    // Genero los productos.
    $productos = [
        'chi01' => ['espectaculo' => 'Chicago, el musical',
                    'precio_1_10' => 25,
                    'precio_11_20' => 20],
        'can02' => ['espectaculo' => 'Concierto año nuevo',
                    'precio_1_10' => 25,
                    'precio_11_20' => 15],
        'ope03' => ['espectaculo' => 'Opera Don Giovanni',
                    'precio_1_10' => 30,
                    'precio_11_20' => 25],
        'ama04' => ['espectaculo' => 'Amadeus',
                    'precio_1_10' => 40,
                    'precio_11_20' => 35]
    ];

    if ($_SERVER['REQUEST_METHOD'] == 'GET' && $payload){
        $fecha = gmdate(DATE_RSS, $_SESSION['hora_adquisicion']);
        echo "<h1>Bienvenido: Id: {$payload['id']}, nombre:{$payload['nombre']}";
        echo "<h2>Fecha de comienzo de compra de entradas: {$fecha}</h2>";
        ?>
        <form action="<?=$_SERVER['PHP_SELF']?>" method="POST">
            <legend>¿Qué entrada quiere reservar?</legend>
            <fieldset>
                <label for="espectaculo">Espectaulo</label>
                <select name="espectaculo" id="espectaculo">
                <?php
                foreach($productos as $producto => $valor){
                    ?>
                    <option name='espectaculo' id='espectaculo' value="<?=$producto?>"><?=$productos[$producto]['espectaculo']?></option>
                    <?php
                }
                ?>
                </select>
                <label for="fila">Fila</label>
                <input type="number" name="fila" id="fila" required min=1 max=20>
            </fieldset>
            <input type="submit" name="operacion" id="operacion">
        </form>
        <?php
    } else if ($_SERVER['REQUEST_METHOD'] == 'POST'){

        if (!$_SESSION['entradas']){
            $_SESSION['entradas'] = [];
        }

        $espectaculo = filter_input(INPUT_POST, 'espectaculo', FILTER_SANITIZE_SPECIAL_CHARS);
        $num_fila = filter_input(INPUT_POST, 'fila', FILTER_SANITIZE_NUMBER_INT);

        if (array_key_exists($espectaculo, $productos)){
            if ($num_fila < 10){
                $precio = $productos[$espectaculo]['precio_1_10'];
            } else if ($num_fila > 10){
                $precio = $productos[$espectaculo]['precio_11_20'];
            }
        } else {
            echo "<p>Este espectaculo no existe</p>";
        }

        $_SESSION['entradas'][] = Array($productos[$espectaculo]['espectaculo'], $num_fila, $precio);
        header("Location: /exra431/expantalla_presupuesto.php");


    } else if ($_SERVER['REQUEST_METHOD'] == 'GET' && !$payload){
        echo "<p>El payload no se ha validado correctamente.</p>";
        echo "<a href='/exra431/expantalla_inicial.php'>Vuelve a intentar iniciar sesión</a>";
    }

    $ob_content = ob_get_contents();
    ob_flush();

    fin_html();
?>