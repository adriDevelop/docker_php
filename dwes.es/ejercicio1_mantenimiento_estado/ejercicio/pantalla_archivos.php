<?php

session_start();

if ($_SERVER['REQUEST_METHOD'] == 'GET' && $_SESSION['lista_archivos']){
  echo "Hola, bienvenido con tus archivos";
  ?>
    <form action="/ejercicio1_mantenimiento_estado/ejercicio/pantalla_datos_archivo.php" method='POST'">
        <select name="seleccion_archivo">
            <?php
            foreach($_SESSION['lista_archivos'] as $archivo){
                echo "<option>{$archivo}</option>";
            }
            ?>
        </select>
        <input type="submit" name="mandar_archivo" value="Mandar archivo">
    </form>
    <?php
} else {
  echo "No existe ningun archivo declarado en el array del servidor de archivos.";
}

?>