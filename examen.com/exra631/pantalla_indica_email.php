<?php
use util\Html;

// Iniciamos sesion
session_start();

ob_start();

// Importo funciones necesarios de Html.php
require_once($_SERVER['DOCUMENT_ROOT'] . "/exra631/util/Html.php");

// Inicio HTML
Html::inicio('Pantalla incio email', ['./estilos/general.css', './estilos/formulario.css']);

if ($_SERVER['REQUEST_METHOD'] == 'GET'){

    // Comprobamos si recibimos una petición para cerrar la sesión
    $operacion = filter_input(INPUT_GET, 'operacion', FILTER_SANITIZE_SPECIAL_CHARS);

    if ($operacion == 'cerrar_sesion'){
        session_unset();
        session_destroy();
    }

    echo "<h1>Bienvenido a indica email</h1>";
    ?>
    <form action="<?=$_SERVER['PHP_SELF']?>" method="POST">
        <fieldset>
            <legend>Introduce el email:</legend>
            <label for="email">Email</label>
            <input type="email" name="email" id="email" required>
        </fieldset>
        <input type="submit" name="operacion" id="operacion">
    </form>
    <?php
} else if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    // Saneamos el dato introducido
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);

    // Validamos el dato introducido
    $email = filter_var($email, FILTER_VALIDATE_EMAIL);

    // Almacenamos el mail en la sesion
    $_SESSION['email'] = $email;

    // Navegamos a la siguiente página una vez obtenido el email
    header("Location: anadir_registros_asitentes.php");
}
ob_flush();
Html::fin();
?>