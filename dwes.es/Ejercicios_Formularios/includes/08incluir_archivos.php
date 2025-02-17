<?php
/*
  Para incluir archivos hay 4 funciones que funcionan casi igual:
  - include() -> Incluye el contenido del argumento en el lugar donde se invoque. Si el archivo no existe,
    se emite un WARNING y el script continúa.
  
  - require() -> Incluye el contenido del argumento en lugar donde se invoca. Si el archivo no existe, se genera
    un error fatal y termina la ejecución del script.

  - 

  ¿Qué ocurre si incluye el mismo archivo más de una vez?
  Error por duplicidad de definición de funciones. Para evitarlo:

  - include_once() -> Igual que include() pero si el archivo ya había sido previamente incluido, no lo incluye.
  - require_once() -> Igual que require() pero si el archivo ya había sido previamtene incluido, no lo incluye.

  
*/
  
  $include_path_actual = ini_get("include_path");
  $include_path_actual .= (":" . $_SERVER['DOCUMENT_ROOT'] . "/includes");
  ini_set("include_path", $include_path_actual);

  include("funciones.php");

  inicio_html("Inclusion de archivos", ['/styles/general.css']);

  echo "<h1> Inclusión de ficheros en HTML </h1>";

  fin_html();

?>