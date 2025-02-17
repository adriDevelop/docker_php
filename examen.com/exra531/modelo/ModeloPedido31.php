<?php

// Espacio de nombres
namespace exra531\modelo;

use DateTime;
use exra531\entidad\Pedido31;
use PDO;
use PDOException;

// Creaciñon de la clase ModeloPedido
class ModeloPedido31{

    // Constantes de la clase
    protected const TABLA = 'pedido';
    protected const PK = 'npedido';
    protected PDO $pdo;

    // Constructor de la clase donde asignaremos la instancia de la clase PDO
    public function __construct(){
        try{
            $dsn = "mysql:host=192.168.12.71;dbname=tiendaol;charset=utf8mb4";
            $usuario = "usuario";
            $clave = "usuario";
            $opciones = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => FALSE
            ];

            $this->pdo = new PDO($dsn, $usuario, $clave, $opciones);

        }catch(PDOException $pdoe){
            return $pdoe->getMessage();
        }
    }

    // Método gestionaPeticion()
    public function procesaPeticion():?Pedido31{
        // Recogemos los valores del formulario
        $numPedido = filter_input(INPUT_POST, 'npedido', FILTER_SANITIZE_NUMBER_INT);

        // Preparamos la consulta sql
        $sql = "SELECT npedido, nif, fecha, observaciones, total_pedido";
        $sql.= " FROM " . self::TABLA;
        $sql.= " WHERE " .self::PK . " = :npedido";
        $stmt = $this->pdo->prepare($sql);

        // BindValue
        $stmt->bindValue(":npedido", $numPedido);

        // Ejecutamos la consulta y devolvemos el valor
        if ($stmt->execute()){
            $pedido = $stmt->fetch();
            $fecha = new DateTime($pedido['fecha']);
            return new Pedido31($pedido['npedido'], $pedido['nif'], $fecha, $pedido['observaciones'], $pedido['total_pedido']);
        }else{
            return null;
        }
    }
}

?>