<?php

require_once($_SERVER['DOCUMENT_ROOT'] . "/Ejercicios_Repaso_RA2_RA3/includes/functions.php");

inicio_html("Página pide tu pizza", ['../styles/general.css', '../styles/formulario.css']);

if ($_SERVER['REQUEST_METHOD'] == 'GET'){
    echo "<h1>Bienvenido. Inicia tu pedido</h1>"
    ?>
    <form action="<?=$_SERVER['PHP_SELF']?>" method="POST">
        <fieldset>
            <legend>¿Nos dices los datos necesarios para el pedido?</legend>
            <label for="nombre">Nombre</label>
            <input type="text" name="nombre" id="nombre" required>
            <label for="direccion">Dirección de envío</label>
            <input type="text" name="direccion" id="direccion" required>
            <label for="telefono">Teléfono</label>
            <input type="tel" name="telefono" id="telefono" required>
            <label for="tipo">Tipo de pizza</label>
            <select name="tipo" id="tipo">
                <option value="veg">Vegetariana</option>
                <option value="no_veg">No vegetariana</option>
            </select>
        </fieldset>
        <input type="submit" name="option" id="option" value="Crear pedido">
    </form>
    <?php
}
?>