<?php

// Iniciamos la sesión.
session_start();

// Recogemos cabeceras.
ob_start();

// Importamos archivo includes.
require_once($_SERVER['DOCUMENT_ROOT'] . "/ejercicio1_mantenimiento_estado/includes/functions.php");

// Iniciamos html.
inicio_html("Pantalla ingredientes", ['../styles/styles.css']);

// Inicializamos el array con los ingredientes que hay disponibles en la pizzeria.
$ingredientes_vegetarianos = [
    'aceitunas negras' => ['precio' => 2],
    'pimiento verde' => ['precio' => 3],
    'pimiento rojo' => ['precio' => 3],
    'maiz' => ['precio' => 4.5]
];
$ingredientes_no_vegetarianos = [
    'atún' => ['precio' => 2],
    'carne picada' => ['precio' => 3],
    'peperoni' => ['precio' => 2.5],
    'morcilla' => ['precio' => 4.5]
];

// Trabajamos con nuestro php_sessions.
if ($_SERVER['REQUEST_METHOD'] == 'GET' && $_SESSION['nombre'] && $_SESSION['direccion'] && $_SESSION['telefono']) {

    echo "<h3>Datos recogidos</h3>";
    $esVegetariana = $_SESSION['vegetariana'];
    if ($esVegetariana == ''){
        $array_a_utilizar = $ingredientes_no_vegetarianos;
        $vegetariano = 'no_vegetarianos';
        $metodo = 'POST';
    } else {
        $array_a_utilizar = $ingredientes_vegetarianos;
        $vegetariano = 'vegetarianos';
        $metodo = 'POST';
    }
?>
    <form action="<?=$_SERVER['PHP_SELF']?>" method="<?=$metodo?>">
        <legend>Ingredientes <?=$vegetariano?></legend>
        <fieldset>
            <?php
            foreach ($array_a_utilizar as $clave => $valor) {
                echo "<label for='ingrediente'>$clave</label>";
                echo "<input type='checkbox' name='ingrediente[]' value='$clave'>";
            }
            ?>
        </fieldset>
        <input type="submit" name="<?=$vegetariano?>" id="<?=$vegetariano?>" value="Mandar ingredientes">
    </form>
<?php

} else if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['ingrediente'])) {

    // Almacenamos ingredientes seleccionados.
    $ingredientes = $_POST['ingrediente'];

    $esVegetariana = $_SESSION['vegetariana'];
    if ($esVegetariana == ''){
        $array_a_utilizar = $ingredientes_no_vegetarianos;
    } else {
        $array_a_utilizar = $ingredientes_vegetarianos;
    }
    
    $_SESSION['array_a_usar'] = $array_a_utilizar;
    $_SESSION['array_ingredientes'] = $ingredientes;

    header("Location: /ejercicio1_mantenimiento_estado/ejercicio3/03pantalla_seleccionados.php");

} else {
    echo "No existe la variable check";
}

// Recogemos valores cabeceras y eliminamos los datos.
$ob_datos = ob_get_contents();
ob_flush();


// Finalizamos html.
fin_html();

?>