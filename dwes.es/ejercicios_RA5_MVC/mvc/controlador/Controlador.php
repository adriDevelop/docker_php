<?php
// A continuación, creamos el controlador.

// El controlador se va a encargar de realizar las peticiones al modelo y 
// a la vista

// Vamos a empezar creando su espacio de nombres
namespace mvc\controlador;

use Exception;

// Ahora, crearemos la clase Controlador
class Controlador {
    // Debemos de crear las siguientes caracteristicas que identifican a 
    // una clase controlador:

    // Petición que manda el cliente
    protected string $peticion;

    // La vista de error que siempre va a ser la misma
    protected string $vista_error = "mvc\\vista\\V_error";

    // Peticiones que pueden ser válidas
    protected array $peticiones;

    // Generamos un constructor para darle valor a las peticiones
    public function __construct(){

        $this->peticiones = [
                            'main' => [
                                'modelo' => 'mvc\\modelo\\M_Main',
                                'vista' => 'mvc\\vista\\V_Main'
                            ],
                            'autenticar' => [
                                'modelo' => 'mvc\\modelo\\M_Autenticar',
                                'vista' => 'mvc\\vista\\V_Autenticar'
                            ],
                            'reseña' => [
                                'modelo' => 'mvc\\modelo\\M_Reseña',
                                'vista' => 'mvc\\vista\\V_Reseña'
                            ],
                            'insertar_reseña' => [
                                'modelo' => 'mvc\\modelo\\M_Insertar_Reseña',
                                'vista' => 'mvc\\modelo\\V_Insertar_Reseña'
                            ]
                            
        ];
    }

    // Una vez generado el constructor, debemos de gestionar las peticiones
    // Así que generaremos una función gestiona_peticion()
    public function gestiona_peticion(){
        try{
            // Obtendremos la peticion del POST, GET y controlaremos si no hay
            // le insertamos el main
            $peticion = $_GET['idp'] ?? $_POST['idp'] ?? 'main';
            $this->peticion = filter_var($peticion, FILTER_SANITIZE_SPECIAL_CHARS);

            // Comprobamos que exista la petición y asignamos la clase modelo y la
            // clase vista
            if (array_key_exists($peticion, $this->peticiones)){
                $clase_modelo = $this->peticiones[$peticion]['modelo'];
                $clase_vista = $this->peticiones[$peticion]['vista'];
            }

            // Controlamos que existan
            if (!class_exists($clase_modelo)){
                throw new Exception("La clase modelo $clase_modelo no existe");
            }

            if (!class_exists($clase_vista)){
                throw new Exception("La clase vista $clase_vista no existe");
            }

            // En el caso de que existan, instanciaremos el modelo y la vista
            $modelo = new $clase_modelo();
            $datos = $modelo->despacha();

            $vista = new $clase_vista();
            $vista->genera_salida($datos);

        }catch(Exception $e){
            // En caso de que no existan, todos los errores los va a controlar el 
            // controlador
            // Este, los devolverá a la vista_error;
            $vista_error = new $this->vista_error();
            $vista_error->genera_salida($e);
        }
    }
}

?>