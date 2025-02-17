<?php

// Iniciamos la sesion.
session_start();

// Trabajamos con el control de cabeceras.
ob_start();

// Requerimos del archivo de carritos y de las funciones, así que, las importamos.
require_once($_SERVER['DOCUMENT_ROOT'] . "/ejercicio1_mantenimiento_estado/includes/functions.php");
require_once("articulos_carrito.php");

// Inicializamos html.
inicio_html("Pantalla principal", ['../styles/styles.css', '../styles/tablas.css']);

// Comenzamos a trabajar en nuestra aplicación.
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    global $articulos;
?>
    <form action="<?= $_SERVER['PHP_SELF'] ?>" method="POST">
        <table>
            <thead>
                <tr>
                    <th>Seleccion</th>
                    <th>Artículo</th>
                    <th>Precio</th>
                    <th>Cantidad</th>
            </thead>
            <?php
            foreach ($articulos as $clave) {
            ?>
                <tbody>
                    <tr>
                        <td><input type='checkbox' name='valores[]' value='<?= key($articulos) ?>'></td>
                        <td><?= $clave['descripcion'] ?></td>
                        <td><?= $clave['precio'] ?></td>
                        <td><input type='number' name="cantidad" id="cantidad"></td>
                    </tr>
                <?php
            }
            echo "</table>";
                ?>
                <input type='submit' name='operacion' id='operacion' value='Enviar'>
    </form>
<?php
} else if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $valores = $_POST['valores'];


    foreach ($valores as $valor) {
        if (array_key_exists($valor, $articulos)){
            echo "$valor: {$articulos[$valor]['precio']}<br>";
        }
        
    }
}


// Cerramos el control de cabeceras.
$ob_contenido = ob_get_contents();
ob_flush();

// Finalizamos html.
fin_html();


?>