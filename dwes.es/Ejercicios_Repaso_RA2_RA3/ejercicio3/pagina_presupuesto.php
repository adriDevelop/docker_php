<?php

require_once($_SERVER['DOCUMENT_ROOT'] . "/Ejercicios_Repaso_RA2_RA3/includes/functions.php");

inicio_html("Página pide tu pizza", ['../styles/general.css', '../styles/formulario.css']);

if ($_SERVER['REQUEST_METHOD'] == 'GET'){
    echo "<h1>Bienvenido. Inicia tu pedido</h1>";
    ?>

    <?php
}
?>