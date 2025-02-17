<?php

// Autocarga
require_once($_SERVER['DOCUMENT_ROOT'] . '/ejercicios_RA5_MVC/util/Autocarga.php');
use util\Autocarga;

// Controlador
require_once($_SERVER['DOCUMENT_ROOT'] . '/ejercicios_RA5_MVC/mvc/controlador/Controlador.php');
use mvc\controlador\Controlador;

Autocarga::registra_autocarga();

$controlador = new Controlador();
$controlador->gestiona_peticion();

?>