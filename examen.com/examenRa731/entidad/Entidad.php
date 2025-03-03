<?php

// Espacio de nombres
namespace examenRa731\entidad;

use JsonSerializable;
use DateTime;
use ReflectionProperty;

// Creacion de la clase Entidad
abstract class Entidad implements JsonSerializable{

    // Constructor de la clase Entidad
    public function __construct(array $datos){
        foreach($datos as $propiedad => $valor){
            $this->__set($propiedad, $valor);
        }
    }

    // Funcion que me devuelve el tipo de una propiedad
    public function getTipo(mixed $valor){
        $reflection = new ReflectionProperty($this, $valor);
        return $reflection->getType()->getName();
    }

    // Funcion que setea los valores teniendo en cuenta las fechas
    public function __set(string $propiedad, mixed $valor){
        if (property_exists($this, $propiedad)){
            if ($this->getTipo($propiedad) == DateTime::class){
                if ($valor instanceof DateTime){
                    $this->$propiedad = $valor;
                }else if ($valor instanceof string){
                    $this->$propiedad = new DateTime($valor);
                }
            }
        }else {
            $this->$propiedad = $valor;
        }
    }

    // Funcion que nos permite realizar un objeto JSON
    public function jsonSerialize(): mixed {
        
        // Creo un array donde almacenare todos las propiedades y valores que vaya recogiendo
        $objeto_json = [];

        // Recojo las propiedades y sus valores que hay en el objeto
        $propiedades = get_object_vars($this);

        foreach($propiedades as $propiedad => $value){
            if ($this->getTipo($value) == DateTime::class){
                $objeto_json[$propiedad] = $value->format('Y-m-d H:i:s');
            }else{
                $objeto_json[$propiedad] = $value;
            }
        }

        return $objeto_json;
    }
}

?>