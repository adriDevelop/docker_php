<?php

// Espacio de nombres
namespace utils;

use Exception;

// Creamos la clase Autocarga
class Autocarga{

    // La clase autocarga tiene que llamar a la clase genera_autocarga usando spl_autoload
    public function registra_autocarga(){
        // El registro de la autocarga puede dar fallos, así que hay que controlarlos mediante un try catch
        try{
            spl_autoload_register(self::class."::autocarga");
        }catch(Exception $e){
            echo "El mensaje de error es: " . $e->getMessage();
        }
    }

    // Método que crea la autocarga
    public function autocarga($clase){

        // Definimos los directorios donde se va a realizar las búsquedas para generar la autocarga
        $directorios = ['/ejercicio_repetido_repaso_mvc'];

        // Debemos de coger los datos que recibimos de la clase y quitarle los valores \\ por /
        $clase = str_replace("\\", "/", $clase);

        // Generamos una bandera para que ejecute el encuentro del fichero, si lo encuentra, devuelve verdadero
        $fichero_encontrado = false;

        // Y ahora, devolvemos si encuentra el directorio en "directorios" un require_once() para ejecutar la autocarga
        foreach($directorios as $directorio){
            if (file_exists($_SERVER['DOCUMENT_ROOT'] . $directorio . "/" . $clase . ".php")){
                require_once($_SERVER['DOCUMENT_ROOT'] . $directorio . "/" . $clase . ".php");
                $fichero_encontrado = true;
            }
        }

        // Si no se ha encontrado, devolvemos un error
        if (!$fichero_encontrado){
            throw new Exception("En el fichero " .$_SERVER['DOCUMENT_ROOT'] . $directorio . "/" . $clase . ".php" .  " no se encuentra en el documento");
        }
    }
}


?>