<?php

// Espacio de nombres
namespace examenRa731\modelo;

use examenRa731\entidad\Alumno31;
use Exception;
use PDO;

// Creo la clase RESTAlumno
class RESTAlumno{

    // Propiedades de la clase
    protected string $tabla = "alumno";
    protected string $pk;

    protected PDO $pdo;

    // Constructor de la clase
    public function __construct(){
        
        $dsn = "mysql:host=cpd.iesgrancapitan.org;dbname=examen;port=9992;charset=utf8mb4";
        $usuario = "examen";
        $clave = "usuario";
        $opciones = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => FALSE
        ];
        $this->pdo = new PDO($dsn, $usuario, $clave, $opciones);
    }

    // public function obtenerFiltro():array{
        
    //     $datos = filter_input(INPUT_SERVER, 'REQUEST_URI', FILTER_SANITIZE_SPECIAL_CHARS);

    //     if ($datos) {
    //         return $datos;
    //     };
    // }

    // Funcion que obtiene los alumnos
    public function getAlumnos(){

        try{
            $datos_filtro = []; //$this->obtenerFiltro();
            $clausula_where = '';

            if ($datos_filtro){
                
                foreach($datos_filtro as $propiedad => $valor){
                    $clausula_where .= "{$propiedad} LIKE :{$valor} AND ";
                }

                $clausula_where = "WHERE " . rtrim($clausula_where, "AND ");
            }

            $sql = "SELECT * FROM {$this->tabla} ";
            $sql .= $clausula_where;

            $stmt = $this->pdo->prepare($sql);

            if ($datos_filtro){
                foreach ($datos_filtro as $propiedad => $valor){
                    $stmt->bindValue(":{$propiedad}", $valor);
                }
            }

            $datos = [];

            if ($stmt->execute()){

                while($fila = $stmt->fetch()){
                    $datos[] = $fila; //new Alumno31($fila);
                }

                $resultado['exito'] = "200 Ok";
                $resultado['error'] = null;
                $resultado['datos'] = $datos;
                $resultado['codigo'] = "200";
            }
        }catch(Exception $e){
            $resultado['exito'] = false;
            $resultado['error'] = $e->getMessage();
            $resultado['datos'] = null;
            $resultado['codigo'] = $e->getCode();
        }

        return $resultado;
    }
}

?>