<?php

// Espacio de nombres
namespace util\seguridad;

use Exception;

// Instanciamos la clase Autocarga
class Autocarga{

    // Método autocarga
    public static function registra_autocarga(){
        try{
        // spl_autoload_register()
        spl_autoload_register(self::class . '::autocarga');
        }catch(Exception $e){
            echo "El error es: {$e->getMessage()}";
        }
        
    }

    // Método genera_autocarga()
    public static function autocarga($clase){
            // Invertimos los datos del string
            $clase_invertida = str_replace("\\", "/", $clase);

            // Comprobamos que existe el fichero
            if (file_exists($_SERVER['DOCUMENT_ROOT'] . "/ejercicio_repaso/" . $clase_invertida . '.php')){
                require_once($_SERVER['DOCUMENT_ROOT'] . "/ejercicio_repaso/" . $clase_invertida . '.php');
            } else {
                throw new Exception("No se ha encontrado el documento" . $_SERVER['DOCUMENT_ROOT'] . "/ejercicio_repaso/" . $clase_invertida . '.php' ."");
            }
    }
}


?>