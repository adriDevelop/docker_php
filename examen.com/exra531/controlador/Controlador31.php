<?php

// Espacio de nombres
namespace exra531\controlador;

use Exception;

// Clase Controlador31
class Controlador31{

    // Propiedades
    protected string $peticion_recibida;
    protected string $vista_error = "exra531\\vista\\VistaError31";
    protected array $peticiones_validas;

    // Constructor del Controlador31
    public function __construct(){
        $this->peticiones_validas = [
            'buscarPedido' => [
                                'modelo' => "exra531\\modelo\\ModeloPedido31",
                                'vista' => "exra531\\vista\\VistaPedido31"
            ]
        ];
    }

    // Método gestionarPeticion()
    public function gestionarPeticion(){

        // Gestionamos los errores desde el Controlador
        try{
            // Identificamos la petición mediante el parámetro POST
            $this->peticion_recibida = $_POST['idp'];

            // Comprobamos que se encuentre en el array de peticiones válidas
            if (array_key_exists($this->peticion_recibida, $this->peticiones_validas)){
                $clase_modelo = $this->peticiones_validas[$this->peticion_recibida]['modelo'];
                $clase_vista = $this->peticiones_validas[$this->peticion_recibida]['vista'];
            }else{
                throw new Exception("La petición recibida no es válida");
            }

            // Compruebo que las clases existan
            if (!class_exists($clase_modelo)){
                throw new Exception("La clase modelo $clase_modelo no existe");
            }

            if (!class_exists($clase_vista)){
                throw new Exception("La clase vista $clase_vista no existe");
            }

            // Creo las clases
            $modelo = new $clase_modelo();
            $datos = $modelo->procesaPeticion();

            $vista = new $clase_vista();
            $vista->enviarSalida($datos);

        }catch(Exception $e){
            $vista = new $this->vista_error();
            $vista->muestraError($e->getMessage());
        }
    }      
}

?>