<?php
    // Iniciamos sesión.
    session_start();

    // Iniciamos ob para que no nos de problemas en las cabeceras.
    ob_start();

    // Importamos el archivo includes.
    require_once($_SERVER['DOCUMENT_ROOT'] . "/ejercicio1_mantenimiento_estado/includes/functions.php");

    // Iniciamos nuestro html.
    inicio_html("Pagina principal", ['../styles/styles.css']);

    // Pedir un formulario que pida DNI, Curriculum, Nombre, Checkbox.
    if ($_SERVER['REQUEST_METHOD'] == 'GET'){
        ?>
            <form action="<?=$_SERVER['PHP_SELF']?>" method="POST" enctype="multipart/form-data">
            <legend>Datos del formulario</legend>
                <fieldset>
                    <label for="dni">DNI</label>
                    <input type="text" name="dni" id="dni">
                    <label for="nombre">Nombre</label>
                    <input type="text" name="nombre" id="nombre">
                    <label for="registro">Acepta registro pesonal</label>
                    <input type="checkbox" name="registro">
                    <label for="curriculum">Añade tu curriculum</label>
                    <input type="file" name="curriculum" >
                </fieldset>
                <input type="submit" name="operacion" id="operacion" value="Enviar datos">
            </form>
        <?php
    } 
    // Recogemos los datos que mandamos en el formulario, los validamos y los almacenamos en el array de session correspondiente.
    else if($_SERVER['REQUEST_METHOD'] == 'POST'){

        // Datos almacenados en variables y sanetizados.
        $dni = filter_input(INPUT_POST, 'dni', FILTER_SANITIZE_SPECIAL_CHARS);
        $nombre = filter_input(INPUT_POST, 'nombre', FILTER_SANITIZE_SPECIAL_CHARS);
        $registro = $_POST['registro'];
        $curriculum = $_FILES['curriculum'];

        // Almacenarlos en el array de sesiones correspondiente.
        $_SESSION['dni'] = $dni;
        $_SESSION['nombre'] = $nombre;
        $_SESSION['registro'] = $registro;
        $_SESSION['curriculum'] = $curriculum;

        // Redirijo a la siguiente pagina.
        header("Location: /ejercicio1_mantenimiento_estado/ejercicio7/07pantalla_muestra_datos.php");
    }

    // Cerrar el ob_start.
    $ob_datos = ob_get_contents();
    ob_flush();

    // Finalizamos html
    fin_html();

?>