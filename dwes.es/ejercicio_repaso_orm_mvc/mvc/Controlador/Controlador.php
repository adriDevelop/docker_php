<?php

// Espacio de nombres
namespace mvc\Controlador;

use Exception;

// Clase Controlador
class Controlador{

    // El controlador cuenta con 3 propiedades
    protected string $peticion;
    protected string $vista_error = "mvc\\Vista\\V_error";
    protected array $peticiones;

    // En el constructor, inicializaremos las peticiones que puede tener nuestra aplicación
    public function __construct(){
        $this->peticiones = [
            'main' => [
                'modelo' => 'mvc\\Modelo\\M_Main',
                'vista' => 'mvc\\Vista\\V_Main'
            ],
            'autenticar' => [
                'modelo' => 'mvc\\Modelo\\M_Autenticar',
                'vista' => 'mvc\\Vista\\V_Autenticar'
            ],
            'muestra_proveedor' => [
                'modelo' => 'mvc\\Modelo\\M_Muestra_Proveedor',
                'vista' => 'mvc\\Vista\\V_Muestra_Proveedor'
            ]
        ];
    }

    
    public function gestiona_peticion(){
        try{
            // Cuando lo tengamos, debemos de validar la peticion que recibimos desde el cliente
        $this->peticion = $_GET['idp'] ?? $_POST['idp'] ?? 'main';

        // Comprobar que esa petición se encuentre dentro de las que se pueden realizar en nuestra aplicación
        if (array_key_exists($this->peticion, $this->peticiones)){
            // E instanciaremos nuestras clases en dos variables
            $clase_modelo = $this->peticiones[$this->peticion]['modelo'];
            $clase_vista = $this->peticiones[$this->peticion]['vista'];
        }

        // Comprobameros que las clases existan
        if (!class_exists($clase_modelo)){
            throw new Exception("La clase modelo $clase_modelo no existe");
        }

        if (!class_exists($clase_vista)){
            throw new Exception("La clase vista $clase_vista no existe");
        }

        $modelo = new $clase_modelo();
        $datos = $modelo->despacha();

        $vista = new $clase_vista();
        $vista->gestiona_vista($datos);

        }catch(Exception $e){
            $vista = new $this->vista_error();
            $vista->gestiona_vista($e->getMessage());
        }
        


    }
    
}

?>