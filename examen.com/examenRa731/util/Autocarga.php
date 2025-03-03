<?php

// Espacio de nombres
namespace examenRa731\util;

use Exception;

// Creacion de la clase Autocarga
class Autocarga{

    // Método gestionaAutocarga()
    public static function gestionaAutocarga(){
        try{
            spl_autoload_register(self::class . "::autocarga");
        }catch(Exception $e){
            return $e->getMessage();
        }
    }

    // Método autocarga
    public static function autocarga($clase){

        // Gestiono la clase recibida
        $clase = str_replace("\\", "/", $clase);

        if ($_SERVER['DOCUMENT_ROOT'] . "/" . "{$clase}.php"){
            require_once($_SERVER['DOCUMENT_ROOT'] . "/" . "{$clase}.php");
        }else {
            throw new Exception("No se ha localizado el directorio " . $_SERVER['DOCUMENT_ROOT'] . "/" . "{$clase}.php");
        }
    }
}

?>