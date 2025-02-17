<?php
    // Iniciamos nuestra sesión.
    session_start();

    // Abrimos nuestro ob_start() para evitar problemas con los headers.
    ob_start();

    // E importamos el fichero includes.
    require_once($_SERVER['DOCUMENT_ROOT'] . "/ejercicio1_mantenimiento_estado/includes/functions.php");

    // Inciamos el html.
    inicio_html("Pantalla principal", ['../styles/styles.css']);

    // Comenzamos desarrollo de aplicación.
    if ($_SERVER['REQUEST_METHOD'] == 'GET'){
        echo "<h1>Pide tu pizza hoy.</h1>";
        ?>
            <!-- Generamos el formulario para el usuario -->
            <form action="<?=$_SERVER['PHP_SELF']?>" method="POST">
                <!-- Informamos al usuario del precio de las pizzas -->
                <legend>Te informamos que nuestras pizzas tienen tomate frito y queso como 
                ingredientes básicos, con un precio inicial de 5€</legend>
                <fieldset>
                    <label for="nombre">Nombre</label>
                    <input type="text" name="nombre" id="nombre">

                    <label for="direccion">Direccion</label>
                    <input type="text" name="direccion" id="direccion">

                    <label for="telefono">Telefono</label>
                    <input type="text" name="telefono" id="telefono">

                    <label for="vegetariana">¿Quiere que la pizza sea vegetariana?</label>
                    <input type="checkbox" name="vegetariana" id="vegetariana">
                </fieldset>
                <input type="submit" name="operacion" id="operacion" value="Enviar">
            </form>
        <?php
    } else if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        // Recogemos todos los datos mandados en el formulario y los validamos.
        $nombre = filter_input(INPUT_POST, 'nombre', FILTER_SANITIZE_SPECIAL_CHARS);
        $direccion = filter_input(INPUT_POST, 'direccion', FILTER_SANITIZE_SPECIAL_CHARS);
        $telefono = filter_input(INPUT_POST, 'telefono', FILTER_SANITIZE_SPECIAL_CHARS);
        $vegetariana = $_POST['vegetariana'] ? true : false;

        // Pasamos los valores a la sesión.
        $_SESSION['nombre'] = $nombre;
        $_SESSION['direccion'] = $direccion;
        $_SESSION['telefono'] = $telefono;
        $_SESSION['vegetariana'] = $vegetariana;

        // Redireccionamos a la siguiente pantalla.
        header("Location: /ejercicio1_mantenimiento_estado/ejercicio3/03pantalla_ingredientes.php");
    }


    // Almacenamos los valores de las cabeceras en una variable y posteriormente los borramos.
    $ob_datos = ob_get_contents();
    ob_flush();

    // Finalizamos el html.
    fin_html();
?>