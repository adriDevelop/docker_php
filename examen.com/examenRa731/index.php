<?php

use examenRa731\enrutador\Enrutador;
use examenRa731\util\Autocarga;

require_once($_SERVER['DOCUMENT_ROOT'] . "/examenRa731/util/Autocarga.php");

Autocarga::gestionaAutocarga();

$enrutador = new Enrutador();

$enrutador->despacha();

?>