<?php

// Espacio de nombres
namespace exra531\util;

use Exception;

// Creación de la clase Autocarga
class Autocarga{

    // Método que registra la autocarga
    public static function registraAutocarga(){
        try{
            spl_autoload_register(self::class . "::autocarga");
        }catch(Exception $e){
            echo "{$e->getMessage()}";
        }
    }

    public static function autocarga($clase){

        // Sustituimos los valores "\\" de la clase obtenida por "/"
        $clase = str_replace("\\", "/", $clase);

        // Directorio donde tiene que hacer la búsqueda
        $directorio_busqueda = "/exra531";

        // Ahora, comprobamos que exista
        if (file_exists($_SERVER['DOCUMENT_ROOT'] . "/" . $clase . ".php")){
            return require_once($_SERVER['DOCUMENT_ROOT'] . "/" . $clase . ".php");
        }else{
            echo "La clase" . $_SERVER['DOCUMENT_ROOT'] . "/" . $clase  . ".php" . " no existe";
        }
    }
}

?>