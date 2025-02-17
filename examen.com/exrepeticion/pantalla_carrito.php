<?php

    session_start();

    ob_start();

    require_once($_SERVER['DOCUMENT_ROOT'] . "/exrepeticion/examenRA4/includes/funciones.php");
    require_once($_SERVER['DOCUMENT_ROOT'] . "/exrepeticion/examenRA4/includes/jwt_include.php");


    inicio_html("Pantalla principal", ['/exrepeticion/examenRA4/estilos/general.css', '/exrepeticion/examenRA4/estilos/formulario.css']);


    $usuarios = ['pepe@gmail.com' => ['nombre' => 'Jose Garcia',
    'clave' => password_hash('pepe123', PASSWORD_DEFAULT)],
    'pepa@gmail.com'=> ['nombre' => 'Josefa Marquez',
    'clave' => password_hash('pepe123', PASSWORD_DEFAULT)]];

    if ($_SERVER['REQUEST_METHOD'] == 'POST'){

        // Validamos y saneamos datos.
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $email = filter_var($email, FILTER_VALIDATE_EMAIL);
        
        $nombre = filter_input(INPUT_POST, 'nombre', FILTER_SANITIZE_SPECIAL_CHARS);

        $clave = $_POST['clave'];

        // Validar los datos que nos ha mandado el usuario en el formulario de inicio de sesión.
        if (array_key_exists($email, $usuarios)){

            // Si existe el email en el array:
            if (password_verify($clave, $usuarios[$email]['clave'])){

                // Si la contraseña coincide con la del email en el array:

                // Generar payload del usuario.
                $usuario = [
                    'id' => $email,
                    'nombre' => $nombre,
                ];

                // Generamos el jwt.
                $jwt = generar_token($usuario);

                // Fecha de expiracion en 2 horas.
                $expires = time() + 120 * 60;

                // Generar la cookie de sesion con el jwt.
                setcookie('jwt', $jwt, $expires, "/", "examen.com");

                // Genero, dentro del array de sesiones en fecha, la fecha en la que se empieza a trabajar
                // con el formulario.
                $_SESSION['fecha'] = gmdate(DATE_RSS, time());

                // Redirijimos a la pantalla siguiente.
                header("Location: /exrepeticion/pantalla_final.php");

            }
        }
    }

    
    $ob_content = ob_get_contents();
    ob_flush();

    fin_html();

?>