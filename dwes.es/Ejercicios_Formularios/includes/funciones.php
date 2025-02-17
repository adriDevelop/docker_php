<?php
  function inicio_html($titulo, $estilos) { ?>
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

  function fin_html() { ?>
    </body>
    </html>
    <?php
  }

  function mostrar_error(Exception $e){?>

    <h3>Error de la aplicacion</h3>
    <p>Codigo de error <?=$e->getCode()?></p>
    <p>Mensaje de error <?=$e->getMessage()?></p>
    <p>Archivo del error <?=$e->getFile()?></p>
    <p>Línea: <?=$e->getLine()?></p>
    <?php

    if (property_exists($e, "punto_recuperacion")){?>
        <p>Puede ir a <a href="<?=$e->punto_recuperacion['url']?>"><?=$e->punto_recuperacion['enlace']?></a></p>
    <?php
    }
  }
?>

