<?php

require_once($_SERVER['DOCUMENT_ROOT'] . "/ejercicio_repaso/util/Autocarga.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/ejercicio_repaso/mvc/Controlador/Controlador.php");
// Instanciaremos la autocarga, que generará una autocarga mediante el metodo genera_autocarga();
use util\seguridad\Autocarga;
use mvc\Controlador\Controlador;

Autocarga::registra_autocarga();

// Instanciaremos el controlador, que se encargará de controlar las distintas peticiones
$controlador = new Controlador();
$controlador->gestiona_peticion();
?>