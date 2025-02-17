<?php
//      AUTOCARGA
//    -------------

/* 
    LA AUTOCARGA ES UNA CLASE QUE NOS PERMITE GENERAR LOS REQUIRE_ONCE
    DE MANERA AUTOMATICA SI EXISTE EL DIRECTORIO QUE INTENTAMOS BUSCAR

    VAMOS A ENTENDERLO REALIZANDO UN EJERCICIO
*/

// GENERAMOS EL ESPACIO DE NOMBRES DONDE SE ENCONTRARÁ LA AUTOCARGA
namespace util;

use Exception;
// CREAMOS LA CLASE AUTOCARGA
class Autocarga{
    // CREAMOS UN MÉTODO registra_autocarga() QUE LLAMARÁ AL MÉTODO 
    // spl_autoload_register() Y LE PASARÁ LA MISMA CLASE
    public static function registra_autocarga(){
        try{
            spl_autoload_register(self::class . "::autocarga");
        }catch(Exception $e){
            echo "La definición de la clase no se ha encontrado";
            exit(1);
        }
    }

    // CREO UN MÉTODO QUE REALIZARÁ LA AUTOCARGA PASANDOLE LA CLASE POR
    // PARÁMETRO
    public static function autocarga($clase):void{
        // Directorio donde se hará la búsqueda de las clases
        $directorio = '/ejercicios_RA5_MVC';

        // Bandera que muestra si ha sido o no encontrada la clase en el
        // directorio
        $encontrado = False;

        // Editar como nos han mandado la clase
        $clase = str_replace("\\", "/", $clase);

        // Comprobamos que el fichero exista en el directorio en el que tiene que
        // hacer la búsqueda
        if (file_exists($_SERVER['DOCUMENT_ROOT'] . $directorio . "/" .$clase . ".php")){
            // Si existe hacemos un require_once de ese directorio y la bandera la 
            // ponemos a True
            require_once($_SERVER['DOCUMENT_ROOT'] . $directorio . "/" .$clase . ".php");
            $encontrado = True;
        } else if (!$encontrado){
            // Si no se encuentra, lanzamos una excepción diciendo que esa clase 
            // no existe
            throw new Exception ("La clase $clase no existe");
        }
    }
}

?>