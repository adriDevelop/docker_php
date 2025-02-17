<?php
// Inicio sesion
session_start();
// Creamos un buffer el cual nos almacenara todos los echo para que no haya interferencias con los header que mandemos.
ob_start();
// Recuperamos el documento para poder tener las funciones creadas en el.
require_once($_SERVER['DOCUMENT_ROOT'] . "/ejercicio1_mantenimiento_estado/includes/functions.php");

// Inicializamos el html.
inicio_html("Bienvenido a ejercicio1", [""]);

// Mostramos por pantalla el formulario donde el cliente introducira los datos.
if ($_SERVER['REQUEST_METHOD'] == 'GET'){
  ?>

  <!-- Creamos un formulario, que se enviará a si mismo con los datos. -->
  <form action="<?=$_SERVER['PHP_SELF']?>" method="POST">
    <fieldset>
      <legend>Selecciona el directorio del que quieres mostrar los datos:</legend>

      <label for="directorio">Directorio</label>
      <input type="text" id="directorio" name="directorio">

    </fieldset>
    <input type="submit" name="operacion" id="mandaDatos" value="Enviar datos">
  </form>

  <?php
}
// Si se trata de un post de archivos.
elseif($_SERVER['REQUEST_METHOD'] == 'POST'){
  // Deberemos de validar los archivos que nos envia el cliente.
  if (isset($_POST['directorio'])){
    $directorio = filter_input(INPUT_POST, 'directorio', FILTER_SANITIZE_SPECIAL_CHARS);
    // Crearemos el directorio de archivos que nos ha mandado el cliente.
    define("DIRECTORIO_ARCHIVOS", $_SERVER['DOCUMENT_ROOT'] . "/ejercicio1_mantenimiento_estado/$directorio");
    $_SESSION['lista_archivos'] = scandir(DIRECTORIO_ARCHIVOS);
    $_SESSION['route'] = DIRECTORIO_ARCHIVOS;
    // Y redirigir a la pagina de los archivos.
    header("Location: /ejercicio1_mantenimiento_estado/ejercicio/pantalla_archivos.php");
  }
}

// Recogeremos nuestro buffer de echos realizados durante toda la ejecucion del script.
$output = ob_get_contents();
// Limpiamos el buffer.
ob_end_clean();
// Mostramos el almacenamiento anterior de los datos del buffer.
echo $output;

// Finalizamos el html.
fin_html();

?>