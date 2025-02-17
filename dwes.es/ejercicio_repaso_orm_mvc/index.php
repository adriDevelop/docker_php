<?php

// Require_once tanto de la Autocarga y del Controlador

require_once($_SERVER['DOCUMENT_ROOT'] . "/ejercicio_repaso_orm_mvc/util/Autocarga.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/ejercicio_repaso_orm_mvc/mvc/Controlador/Controlador.php");

use mvc\Controlador\Controlador;
use util\Autocarga;

// Instanciaciones de ambos llamando a sus respectivas funciones
Autocarga::registra_autocarga();

$controlador = new Controlador();
$controlador->gestiona_peticion();

?>