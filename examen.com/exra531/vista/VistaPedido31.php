<?php

// Espacio de nombres
namespace exra531\vista;

use exra531\util\Html;

// Creación de la clase VistaPedido31
class VistaPedido31 extends Html {

    // Método enviarSalida($pedido);
    public function enviarSalida(mixed $pedido): void{
        if ($pedido != null){
            $this->inicio("Resultados de la búsqueda", ['./estilos/general.css', './estilos/tablas.css']);
            echo "<h1>Resultados de la búsqueda</h1>";
            ?>
                <table>
                    <thead>
                    <tr>
                        <th>npedido</th>
                        <th>nif</th>
                        <th>fecha</th>
                        <th>observaciones</th>
                        <th>total_pedido</th>
                    </tr>
                    </thead>
                    <tbody>
            <?php
                        echo "<tr>";
                        echo "<td>{$pedido->npedido}</td>";
                        echo "<td>{$pedido->nif}</td>";
                        echo "<td>{$pedido->fecha->format('d/m/y')}</td>";
                        echo "<td>{$pedido->observaciones}</td>";
                        echo "<td>{$pedido->total_pedido} €</td>";
                        echo "</tr>";
            ?>
                    </tbody>
                </table>

            <?php
            $this->fin();
        } else {
            $this->inicio("Resultados de la búsqueda", ['./estilos/general.css', './estilos/tablas.css']);
                echo "<h1>No se ha encontrado ningun artículo con ese número de pedido</h1>";
            $this->fin();
        }
        
    }
}

?>