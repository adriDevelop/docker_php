<?php

// Espacio de nombres
namespace mvc\Vista;

abstract class Vista{

    // La clase Vista tiene otro metodo que es genera_salida() que recibe los datos del modelo y que no devuelve nada
    public function genera_salida($datos): void{
        
    }

    // voy a copiar la funcion inicio_html y fin_html un seg
    protected function inicio_html(string $titulo, array $estilos){
        ?>
            <!DOCTYPE html>
            <html lang="es">
            <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <?php
        
                foreach( $estilos as $estilo ){
                echo "\t\t<link rel='stylesheet' type='text/css' href='$estilo'>";
                }
        
            ?>
            <title><?=$titulo?></title>
            </head>
            <body>
        <?php
    }

    protected function fin_html(){
        echo "</body>";
        echo "</html>";
    }
}

?>