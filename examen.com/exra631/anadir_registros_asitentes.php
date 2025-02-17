<?php
// Iniciamos la sesión
session_start();

// Hacemos uso de HTML

use exra631\entidad\RegistroAsistente;
use exra631\orm\ORMRegistro;
use util\Html;

ob_start();

// Importo funciones necesarias de Html.php
require_once($_SERVER['DOCUMENT_ROOT'] . "/exra631/util/Html.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/exra631/orm/ORMRegistro.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/exra631/entidad/RegistroAistente.php");

// Inicio HTML
HTML::inicio("Anadir registro asistentes", ['./estilos/general.css', './estilos/formulario.css', './estilos/tablas.css']);

// Comprobamos la petición por parte del cliente
if ($_SERVER['REQUEST_METHOD'] == 'GET' && $_SESSION['email']){
echo "<h1>Bienvenido al registro de nuevos asistentes</h1>";
?>
    <form action="<?=$_SERVER['PHP_SELF']?>" method="POST">
        <fieldset>
            <legend>Introduce en que actividad te quieres registrar y que dia:</legend>
            <label for="date">Fecha de la actividad</label>
            <input type="date" name="date" id="date" required>
            <label for="Actividad">Selecciona la actividad que quieres hacer</label>
            <select name="actividad" id="actividad" required>
                <option value="gns3">El simulador de red GNS3</option>
                <option value="ftp">Configuraciñon de cortafuegos para FTP</option>
                <option value="dock">Despliegue rápido con Docker</option>
            </select>
        </fieldset>
        <input type="submit" name="operacion" id="operacion">
    </form>
<?php
    // Instanciamos un objeto de la clase ORMRegistro
    $orm = new ORMRegistro();
    $array_datos_orm = $orm->listar($_SESSION['email']);

    echo "<br>";
    echo "<h2>Actividades registradas</h2>";
    echo "<table><thead><tr><th>Id</th><th>Fecha_Actividad</th><th>Actividad</th></tr></thead><tbody>";

    foreach($array_datos_orm as $elemento){
        echo "<tr>";
            echo "<td>{$elemento->getId()}</td>";
            echo "<td>{$elemento->getFechaInscripcion()}</td>";
            echo "<td>{$elemento->getActividad()}</td>";
        echo "</tr>";
    }

    echo "</tbody></table>";

    echo "<br>";
    echo "<form action='pantalla_indica_email.php' method='GET'><button type='submit' name='operacion' id='operacion' value='cerrar_sesion'>Cerrar sesión</button></form>";
} else if ($_SERVER['REQUEST_METHOD'] = 'POST'){
    // Saneamos los datos introducidos en el formulario
    $date = filter_input(INPUT_POST, 'date', FILTER_SANITIZE_SPECIAL_CHARS);
    $actividad = filter_input(INPUT_POST, 'actividad', FILTER_SANITIZE_SPECIAL_CHARS);

    $fecha = new DateTime($date);
    $fecha->format('d-m-Y');

    $asistente = new RegistroAsistente(1, $_SESSION['email'], $date, $actividad);
    $orm = new ORMRegistro();
    if ($orm->insertar($asistente)){
        echo "<h2>Sa ha insertado la asistencia a la actividad</h2>";
        echo "<a href='anadir_registros_asitentes.php'>Volver a agregar nueva asistencia</a>";
    }
}
ob_flush();
HTML::fin();
?>