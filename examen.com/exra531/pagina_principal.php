<?php

// Creación del formulario
require_once($_SERVER['DOCUMENT_ROOT'] . "/exra531/util/Html.php");
use exra531\util\Html;

if ($_SERVER['REQUEST_METHOD'] == 'GET'){
    Html::inicio("Busqueda de producto", ['./estilos/general.css', './estilos/formulario.css']);
    echo "<h1>Bienvenido a la pantalla de inicio</h1>";
    ?>
        <form action="index.php" method="POST">
            <fieldset>
                <legend>Introduzca el número de pedido a encontrar</legend>
                <label for="npedido">Número de pedido</label>
                <input type="number" id="npedido" name="npedido" required>
            </fieldset>
            <button type="submit" id="idp" name="idp" value="buscarPedido">Buscar pedido</button>
        </form>
    <?php
    Html::fin();
}

?>