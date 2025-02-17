<?php

session_start();

ob_start();

require_once($_SERVER['DOCUMENT_ROOT'] . "/ejercicio1_mantenimiento_estado/includes/functions.php");
require_once("03jwt_include.php");

inicio_html("Pantalla principal", ['../styles/styles.css']);

$usuarios = [
    "usuario@usuario.com" => [
        'nombre' => 'usuario',
        'clave' => password_hash('usuario', PASSWORD_DEFAULT)],
];

if ($_SERVER['REQUEST_METHOD'] == 'GET'){
?>
    <form action="<?=$_SERVER['PHP_SELF']?>" method="POST">
        <legend>Introduce datos para inicio de sesión.</legend>
        <fieldset>
            <label for="email">Email</label>
            <input type="email" name="email" id="email" required>
            <label for="clave">Clave</label>
            <input type="password" name="clave" id="clave" required>
        </fieldset>
        <input type="submit" name="operacion" id="operacion" value="Loguear">
    </form>
<?php
} else if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $email = filter_var($email, FILTER_VALIDATE_EMAIL);

    $clave = $_POST['clave'];

    if (array_key_exists($email, $usuarios)){
        if (password_verify($clave, $usuarios[$email]['clave'])){

            $usuario = [
                'id' => $email,
                'nombre' => $usuarios[$email]['nombre']
            ];

            $jwt = generar_token($usuario);
            $expires = time() + 120 * 60;

            setcookie('jwt', $jwt, $expires, '/', 'dwes.es');

            header('Location: /ejercicio1_mantenimiento_estado/repeticion_ejercicio_7/07pantalla_carga_alumnos.php');
        } else {
            echo "<p>Te has equivocado!</p>";
        }
    } else {
        echo "<p>Te has equivocado!</p>";
    }
}

$ob_datos = ob_get_contents();
ob_flush();

fin_html();
?>