<?php

// Espacio de nombres
namespace examenRa731\enrutador;

use Exception;
use examenRa731\modelo\RESTAlumno;

// Creación de la clase Enrutador
class Enrutador{

    // Propiedad de la clase Enrutador rutas
    protected array $rutas;

    // Constructor de la clase
    public function __construct(){
        
        // Llamada a la funcion que inicializa nuestro array de rutas
        $this->inicializaRutas();
    }

    // Creamos la clase que inicializa a las rutas
    public function inicializaRutas(){
        $this->rutas[] = new Ruta("GET", "#^/alumnos$#", RESTAlumno::class, "getAlumnos");
    }

    // Funcion que obtiene el verbo
    public function obtenerVerbo(){

        // Obtengo el verbo de la peticion
        $verbo = filter_input(INPUT_SERVER, 'REQUEST_METHOD', FILTER_SANITIZE_SPECIAL_CHARS);

        // Compruebo el verbo
        if ($verbo == 'POST'){
            $verbo = strtoupper(filter_input(INPUT_POST, '_method', FILTER_SANITIZE_SPECIAL_CHARS));
            if (!in_array($verbo, ['PUT', 'DELETE', 'PATCH'])){
                throw new Exception("Bad Request", 400);
            }
        }

        // Devuelvo el verbo
        return $verbo;
    }

    // Funcion que obtiene la peticion
    public function obtenerPeticion(){
        $path = filter_input(INPUT_SERVER, 'REQUEST_URI', FILTER_SANITIZE_SPECIAL_CHARS);
        $path_peticion = parse_url($path, PHP_URL_PATH);
        return $path_peticion;
    }

    // Funcion que obtiene la ruta
    public function obtenRuta(string $verbo, string $path_peticion){

        foreach($this->rutas as $ruta){
            if ($ruta->compruebaRuta($verbo, $path_peticion)){
                return $ruta;
            }
        }

        throw new Exception("Bad Request", 400);
    }

    // Funcion que ejecuta la ruta
    public function ejecutaRuta(Ruta $ruta, string $path_peticion){

        // Obtengo la clase de la ruta
        $clase = $ruta->getModelo();

        // Obtengo el metodo
        $metodo = $ruta->getMetodo();

        // Obtengo los parametros
        $parametros = $this->getParametros($ruta->getPath(), $path_peticion);

        $objeto = new $clase();

        // Ejecuto la consulta mediante una llamada al callback
        $datos = call_user_func([$objeto, $metodo], $parametros);

        return $datos;
        
    }

    // Funcion que obtiene los parametros
    public function getParametros(string $path_regex, string $path_peticion){

        if (preg_match($path_regex, $path_peticion, $parametros)){

            array_shift($parametros);

            return $parametros;
        }

        return [];
    }

    // Funcion que maneja el error
    public function manejaError(mixed $error){

        if ($error instanceof Exception){
            header($_SERVER['SERVER_PROTOCOL'] . " " . $error->getCode() . " " . $error->getMessage());
            header("Content-Application: application/json");
            echo json_encode($error);
        }else {
            header($_SERVER['SERVER_PROTOCOL'] . " " . $error['codigo']);
            header("Content-Application: application/json");
            echo json_encode($error);
        }
    }

    // Funcion que despacha y devuelve los datos
    public function despacha(){

        try{
            // Lo primero es obtener el verbo
            $verbo = $this->obtenerVerbo();

            // Obtener la ruta a la que hace 
            $path_peticion = $this->obtenerPeticion();

            // Obtener la ruta del array de rutas
            $ruta = $this->obtenRuta($verbo, $path_peticion);

            // Instanciacion del objeto y ejecucion
            $datos = $this->ejecutaRuta($ruta, $path_peticion);


            if ($datos['exito']){
                header($_SERVER['SERVER_PROTOCOL'] . " " . $datos['codigo']);
                header("Content-Application: application/json");
                echo json_encode($datos, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
            }else {
                $this->manejaError($datos);
            }

        }catch(Exception $e){
            $this->manejaError($e);
        }
        
    }
}

?>