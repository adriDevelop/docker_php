<?php

// Espacios de nombres
namespace mvc\Controlador;

use Exception;

// Creamos la clase Controlador
class Controlador{

    // La clase controlador tiene las siguientes propiedades
    // Petición recibida
    protected $peticion;

    // Vista de error para que, en caso de que la petición no sea válida, se mande a la vista de error
    protected $vista_error = 'mvc\\Vista\\V_error';

    // Array de peticiones válidas que rellenaremos en el constructor
    protected $peticiones;

    // Generamos el constructor de la clase e inicializaremos el array de peticiones
    public function __construct()
    {
        $this->peticiones = [
            'Main' => [
                'modelo' => 'mvc\\Modelo\\M_main',
                'vista' => 'mvc\\Vista\\V_main'
            ],
            'autenticar' => [
                'modelo' => 'mvc\\Modelo\\M_autenticar',
                'vista' => 'mvc\\Vista\\V_autenticar'
            ],
            'reseña' => [
                'modelo' => 'mvc\\Modelo\\M_reseña',
                'vista' => 'mvc\\Vista\\V_reseña'
            ],
            'Insertar_reseña' => [
                'modelo' => 'mvc\\Modelo\\M_insertar_reseña',
                'vista' => 'mvc\\Vista\\V_insertar_reseña'
            ]
        ];
    }

    // Ahora, debemos de crear el método gestiona_peticion() que, como su nombre indica, gestionará la petición del cliente y comprobará que la petición sea válida
    public function gestiona_peticion(){
        // Todo debe de ir en un bloque try catch para que se gestione el error correctamente
        try{
            // Recogemos el valor de las distintas peticiones que se pueden hacer (GET, POST) y si ninguna tiene valor, por defecto se hará, la petición a Main
            $peticion = $_GET['idp'] ?? $_POST['idp'] ?? 'Main';

            // Una vez tengamos la petición, debemos de validar si existe la petición en el array de peticiones
            if (array_key_exists($peticion, $this->peticiones)){
                $clase_modelo = $this->peticiones[$peticion]['modelo'];
                $clase_vista = $this->peticiones[$peticion]['vista'];
            }

            // Comprobamos si "$clase_modelo" existe
            if (!class_exists($clase_modelo)){
                throw new Exception("La clase modelo $clase_modelo no existe");
            }

            // Comprobamos si "$clase_vista" existe
            if (!class_exists($clase_vista)){
                throw new Exception("La clase vista $clase_vista no existe");
            }

            $modelo = new $clase_modelo();
            $datos_modelo = $modelo->despacha();

            $vista = new $clase_vista();
            $vista->genera_salida($datos_modelo);

        }catch(Exception $e){
            $vista = new $this->vista_error();
            $vista->genera_salida($e->getMessage());
        }
    }
}

?>