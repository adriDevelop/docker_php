<?php

require_once($_SERVER['DOCUMENT_ROOT'] . "/ejercicio_repetido_repaso_mvc/util/Autocarga.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/ejercicio_repetido_repaso_mvc/mvc/Controlador/Controlador.php");

use mvc\Controlador\Controlador;
use utils\Autocarga;

$autocarga = new Autocarga();
$autocarga->registra_autocarga();

$controlador = new Controlador();
$controlador->gestiona_peticion();
?>