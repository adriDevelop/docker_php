<?php

// Funcion que inicializa el html.
function inicio_html($titulo, $array){
  ?>
  <!DOCTYPE html>
  <html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
    foreach($array as $valor){
        ?>
        <link rel="stylesheet" href="<?=$valor?>">
        <?php
    }
    ?>
    <title><?=$titulo?></title>
  </head>
  <body>
    
  <?php
}

// Funcion que finaliza el html.
function fin_html(){
  ?>
  </body>
  </html>
  <?php
}


?>