<?php

// Espacio de nombres
namespace mvc\Vista;

// Instanciación de la clase abstracta Vista
abstract class Vista{

    // Método gestiona_vista($datos):void que muestra al usuario la vista y que lo heredaran todos los que extiendan de esta clase
    public function gestiona_vista(mixed $datos):void{

    }

    // Método inicio_html()
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

    // Método fin_html()
    protected function fin_html(){
        echo "</body>";
        echo "</html>";
    }
}

?>