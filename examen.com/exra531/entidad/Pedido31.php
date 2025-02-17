<?php

// Espacio de nombres
namespace exra531\entidad;

use DateTime;

// Creaciñon de la clase Pedido31
class Pedido31{

    // Propiedades privadas de Pedido31
    private int $npedido;
    private string $nif;
    private DateTime $fecha;
    private ?string $observaciones;
    private ?float $total_pedido;

    // Constructor de la clase Pedido31
    public function __construct(int $npedido, string $nif, DateTime $fecha, ?string $observaciones, ?float $total_pedido){
        $this->npedido = $npedido;
        $this->nif = $nif;
        $this->fecha = $fecha;
        $this->observaciones = $observaciones;
        $this->total_pedido = $total_pedido;
    }

    // Getters && Setters
    public function __set($nombre_propiedad, $valor){
        $this->$nombre_propiedad = $valor;
    }
    
    public function __get($nombre_propiedad){
        return $this->$nombre_propiedad ?? "No tiene";
    }
}


?>