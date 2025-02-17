<?php

namespace mvc\vista;

abstract class Vista{
    abstract public function genera_salida(mixed $datos): void;

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