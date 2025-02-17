<?php

// Espacio de nombres
namespace mvc\Vista;

// Instanciamos la clase Abstracta Vista
abstract class Vista{

    // Función que genera la salida
    public function genera_salida(mixed $datos): void{}

    // Función que pone nuestro principio del html incluyendo el titulo y los estilos
    public static function inicio_html($titulo, $estilos) { ?>
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
    
    // Función que cierra nuestro html
    public static function fin_html() { ?>
        </body>
        </html>
        <?php
      }


}

?>