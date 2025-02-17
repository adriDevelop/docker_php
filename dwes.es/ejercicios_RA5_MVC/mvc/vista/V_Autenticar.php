<?php

namespace mvc\vista;

use mvc\vista\Vista;

class V_Autenticar extends Vista{
    public function genera_salida(mixed $datos): void
    {
        $this->inicio_html("Pagina autenticar", ['./styles/general.css', './styles/tablas.css', './styles/formulario.css']);
        echo "<h1>Bienvenido {$_SESSION['cliente']}</h1>";
        echo "<hr>";
        echo "<table>";
            echo "<thead>";
                echo "<tr>";
                    echo "<th>Referencia</th>";
                    echo "<th>Descripcion</th>";
                    echo "<th>pvp</th>";
                    echo "<th>dto_venTa</th>";
                    echo "<th>und_disponibles</th>";
                    echo "<th>categoria</th>";
                    echo "<th>Añadir reseña</th>";
                echo "</tr>";
            echo "</thead><tbody>";
            foreach($datos as $producto){
                echo "<tr>";
                    echo "<td>{$producto['referencia']}</td>";
                    echo "<td>{$producto['descripcion']}</td>";
                    echo "<td>{$producto['pvp']}</td>";
                    echo "<td>{$producto['dto_venta']}</td>";
                    echo "<td>{$producto['und_disponibles']}</td>";
                    echo "<td>{$producto['categoria']}</td>";
                    echo "<td>
                    <form action='{$_SERVER['PHP_SELF']}' method='POST'>
                        <input type='hidden' name='referencia' id='referencia' value='{$producto['referencia']}'>
                        <button id='idp' name='idp' value='reseña'>Añadir reseña</button>
                    </form>
                    </td>";
                echo "</tr>";
            }
        echo "</tbody></table>";
        $this->fin_html();
    }
}

?>