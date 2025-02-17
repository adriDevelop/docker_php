<?php


// Iniciamos la sesion.
session_start();

// Iniciamos ob para evitar problemas con las cabeceras.
ob_start();

// Requieres_onces para importar los archivo que nos hagan falta.
require_once($_SERVER['DOCUMENT_ROOT'] . "/ejercicio1_mantenimiento_estado/includes/functions.php");
require_once("03jwt_include.php");

// Iniciar nuestro html.
inicio_html("Formulario comentario", ['../styles/styles.css']);

// Validar jwt.

// Almacenar el jwt en una variable para posteriores validaciones.
$jwt = $_COOKIE['jwt'];

// Validar jwt y obtenemos el payload del usuario.
$payload = verificar_token($jwt);


if ($_SERVER['REQUEST_METHOD'] == 'GET' && $payload){
?>
    <form action="<?=$_SERVER['PHP_SELF']?>" method="POST">
        <legend>Introduce los datos para el comentario a enviar.</legend>
        <fieldset>
            <label for="tema">Elige un tema</label>
            <select name="tema" id="tema">
                <option value="clase_cliente">DWEC</option>
                <option value="clase_configuracion">HLC</option>
                <option value="clase_servidor">DWES</option>
                <option value="clase_web">DAW</option>
                <option value="clase_interfaces">DIW</option>
            </select>
            <label for="comentario">Inserta tu comentario sobre la asignatura:</label>
            <textarea name="comentario" id="comentario" required></textarea><br><br>
        </fieldset>
        <input type="submit" name="operacion2" id="operacion2">
    </form>
<?php
}
else if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $tema = filter_input(INPUT_POST, 'tema', FILTER_SANITIZE_SPECIAL_CHARS);
    $comentario = filter_input(INPUT_POST, 'comentario', FILTER_SANITIZE_SPECIAL_CHARS);

    if( !isset($_SESSION['comentario'])) {
        $_SESSION['comentario'] = [];
    }
    
    $_SESSION['comentario'][] = Array($tema, $comentario);

    header('Location: /ejercicio1_mantenimiento_estado/ejercicio8/08lista_comentarios.php');
}

// Finalizar las cabeceras almacenando los valores de estas antes de borrarlas.
$ob_contenido = ob_get_contents();
ob_flush();

fin_html();
?>