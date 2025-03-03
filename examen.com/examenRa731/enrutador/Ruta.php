<?php

// Espacio de nombres
namespace examenra731\enrutador;

// Creación de la clase Ruta
class Ruta{

    // Propiedades de la clase ruta
    protected string $verbo;
    protected string $path;
    protected string $modelo;
    protected string $metodo;

    // Constructor de la ruta
    public function __construct(string $verbo, string $path, string $modelo, string $metodo){
        $this->verbo = $verbo;
        $this->path = $path;
        $this->modelo = $modelo;
        $this->metodo = $metodo;
    }

    // Funcion que me devuelve el path de la ruta
    public function getPath(){
        return $this->path;
    }

    // Funcion que me devuelve el modelo de la ruta
    public function getModelo(){
        return $this->modelo;
    }

    // Funcion que me devuelve el metodo de la ruta
    public function getMetodo(){
        return $this->metodo;
    }

    // Funcion que comprueba si el verbo y el path pasados son iguales
    public function compruebaRuta(string $verbo, string $path){
        return $this->verbo == $verbo && preg_match($this->path, $path);
    }

}

?>