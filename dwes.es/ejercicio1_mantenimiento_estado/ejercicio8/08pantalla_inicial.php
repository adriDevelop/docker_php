<?php

    // Creamos la sesión.
    session_start();

    // Abrimo sun bloque ob.
    ob_start();

    // Importamos nuestro archivo de funciones.
    require_once($_SERVER['DOCUMENT_ROOT'] . "/ejercicio1_mantenimiento_estado/includes/functions.php");
    require_once("03jwt_include.php");

    // Inicializamos el html.
    inicio_html("Pagina inicial", ['../styles/styles.css']);

    // Creamos un array con los valores de inicio de sesión del usaurio.
    $usuarios = [
        'usuario@usuario.com' => ['clave' => password_hash("usuario", PASSWORD_DEFAULT)],
    ];

    // Primera petición de la página.
    if ($_SERVER['REQUEST_METHOD'] == 'GET'){
        $operacion = filter_input(INPUT_GET, 'operacion', FILTER_SANITIZE_SPECIAL_CHARS);
        if ($operacion == 'cerrar'){
            // Para borrar el inicio de sesión es como en JavaScript. Debemos de eliminar la cookie.

            // Para ello debemos de recoger los datos necesarios para eliminar la cookie.
            // Cogemos el id de inicio de sesion.
            $usuario_id = session_name();
            // Y los valores de la session.
            $parametros_cookie = session_get_cookie_params();

            // Ahora, deberemos de establecer los valores de la cookie como en js para que se elimine la cookie.
            setcookie($usuario_id, '', time()- 10000, $parametros_cookie['path'], $parametros_cookie['domain'], 
                      $parametros_cookie['secure'], $parametros_cookie['httponly']);

            // Tras esto, deberemos de destruir las variables de sesión.
            session_unset();

            // Y después destruiremos los datos de la sesión.
            session_destroy();
        }
        ?>
            <form action="<?=$_SERVER['PHP_SELF']?>" method="POST">
                <legend>Introduce los valores para iniciar sesión.</legend>
                <fieldset>
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" required>
                    <label for="clave">Clave</label>
                    <input type="password" name="clave" id="clave" required>
                </fieldset>
                <input type="submit" name="operacion" id="operacion" value="Iniciar Sesión">
            </form>
        <?php
    }
    else if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        // Validamos y saneamos los valores introducidos.
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $email = filter_var($email, FILTER_VALIDATE_EMAIL);
        $clave = $_POST['clave'];

        // Validamos al usuario que ha introducido el cliente.
        if (array_key_exists($email, $usuarios)){
            if (password_verify($clave, $usuarios[$email]['clave'])){
            // Se ha logueado correctamente.
            // Pasamos a crear la cookie con el jwt y que dure 2 horas.
                $usuario = [
                    'id' => $email
                ];

                // Generar el jwt.
                $jwt = generar_token($usuario);

                // Primero almacenamos el tiempo de expiración de la cookie.
                $expire = time() + 120 * 60;

                // Generamos la cookie.
                setcookie("jwt", $jwt, $expire, "/", "dwes.es");
                
                // Mandamos a la otra página.
                header("Location: /ejercicio1_mantenimiento_estado/ejercicio8/08bienvenida.php");
            }
        } else {
            echo "<p>Te has equivocado!</p>";
        }

    }

    // Almacenamos y borramos el valor de ob.
    $ob_datos = ob_get_contents();
    ob_flush();

    // Finalizamos html.
    fin_html();

?>