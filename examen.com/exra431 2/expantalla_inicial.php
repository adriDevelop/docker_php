<?php

    session_start();

    ob_start();

    require_once($_SERVER['DOCUMENT_ROOT'] . "/exra431/examenRA4/includes/funciones.php");
    require_once($_SERVER['DOCUMENT_ROOT'] . "/exra431/examenRA4/includes/jwt_include.php");

    inicio_html("Pantalla inicial", ['/exra431/examenRA4/estilos/general.css','/exra431/examenRA4/estilos/formulario.css']);

    // Usuarios generados.
    $usuarios = [
        '123456' => ['clave' => password_hash('Abc123', PASSWORD_DEFAULT), 
                     'nombre' => 'Fernando Muñoz'],
        '654321' => ['clave' => password_hash('321cba', PASSWORD_DEFAULT),
                     'nombre' => 'Fernanda González']
    ];

    if ($_SERVER['REQUEST_METHOD'] == 'GET'){
        $opcion = filter_input(INPUT_GET, 'operacion', FILTER_SANITIZE_SPECIAL_CHARS);
        if ($opcion === 'cerrar'){

            $nombre = session_id();

            $parametros = session_get_cookie_params();

            setcookie($nombre,'', time() - 10000, $parametros['path'], $parametros['domain'], $parametros['secure'], $parametros['httponly']);

            session_unset();

            session_destroy();
        }
        ?>
        <form action="<?=$_SERVER['PHP_SELF']?>" method="POST">
            <legend>Introduce tus datos:</legend>
            <fieldset>
                <label for="identificador">Identificador</label>
                <input type="number" name="identificador" id="identificador" max=999999 required>
                <label for="clave">Contraseña</label>
                <input type="password" name="clave" id="clave" required>
                <label for="nombre">Nombre</label>
                <input type="text" name="nombre" id="nombre" required>
            </fieldset>
            <input type="submit" name="operacion" id="operacion">
        </form>
        <?php
    } else if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        $identificador = filter_input(INPUT_POST, 'identificador', FILTER_SANITIZE_NUMBER_INT);
        $clave = $_POST['clave'];
        $nombre = filter_input(INPUT_POST, 'nombre', FILTER_SANITIZE_SPECIAL_CHARS);

        if (array_key_exists($identificador, $usuarios)){
            if (password_verify($clave, $usuarios[$identificador]['clave'])){

                $usuario = [
                    'id' => $identificador,
                    'nombre' => $usuarios[$identificador]['nombre']
                ];

                $jwt = generar_token($usuario);

                $expires = time() + 60 * 60;

                setcookie('jwt', $jwt, $expires, '/', 'examen.com');

                $_SESSION['hora_adquisicion'] = time() * 60 * 365;

                header('Location: /exra431/expantalla_reserva_entradas.php');

            } else {
                echo "<p>Se ha equivocado en el inicio de sesión.</p>";
                echo "<a href='/exra431/expantalla_inicial.php'>Volver a intentarlo.</a>";
            }
        } else {
            echo "<p>Se ha equivocado en el inicio de sesión.</p>";
            echo "<a href='/exra431/expantalla_inicial.php'>Volver a intentarlo.</a>";
        }
    }

    $ob_contenido = ob_get_contents();
    ob_flush();

    fin_html();
?>