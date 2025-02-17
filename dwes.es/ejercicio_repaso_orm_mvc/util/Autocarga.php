<?php

// Espacio de nombres
namespace util;

use Exception;

// Instanciación de la clase Autocarga
class Autocarga{

    // Función que se encarga de registrar la autocarga
    public static function registra_autocarga(){
        try{
            spl_autoload_register(self::class . "::autocarga");
        }catch(Exception $e){
            echo "El error es: {$e->getMessage()}";
        }
        
    }

    // Función que se encarga de hacer el require_once
    public static function autocarga($clase){
        // Lo primero que debemos hacer es corregir las direcciones que recibimos del espacio de nombres de la clase
        $clase = str_replace("\\", "/", $clase);

        // Una vez tengamos la clase, tenemos que comprobar que exista esa clase
        if (file_exists($_SERVER['DOCUMENT_ROOT'] . "/ejercicio_repaso_orm_mvc/" . $clase . ".php")){
            require_once($_SERVER['DOCUMENT_ROOT'] . "/ejercicio_repaso_orm_mvc/" . $clase . ".php");
        }else {
            throw new Exception("No existe el directorio");
        }
    }
}

?>