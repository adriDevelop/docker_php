<?php

// Require_once tanto de la Autocarga como del Controlador
require_once($_SERVER['DOCUMENT_ROOT'] . "/exra531/util/Autocarga.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/exra531/controlador/Controlador31.php");

use exra531\controlador\Controlador31;
use exra531\util\Autocarga;

Autocarga::registraAutocarga();

$controlador = new Controlador31();
$controlador->gestionarPeticion();

?>