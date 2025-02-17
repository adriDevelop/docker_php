<?php

// Require once
require_once($_SERVER['DOCUMENT_ROOT'] . "/recuperar31/recuperacion/includes/funciones.php");

// Array con los valores de las marcas
$vehiculos = [
    'fi' => ['marca' => 'Fiat'],
    'op' => ['marca' => 'Opel'],
    'me' => ['marca' => 'Mercedes']
];

inicio_html("Inicio de la aplicación", ['./recuperacion/estilos/general.css', './recuperacion/estilos/formulario.css', './recuperacion/estilos/tablas.css']);
// Comprobación de petición
if ($_SERVER['REQUEST_METHOD'] == 'GET'){
    echo "<h1>Bienvenido a la búsqueda de vehiculos</h1>";
    // Generación del formulario
    ?>  
    <form action="<?=$_SERVER['PHP_SELF']?>" method="POST" enctype="multipart/form-data">
        <fieldset>
            <legend>Introduzca los datos requeridos:</legend>
            <label for="email">Email</label>
            <input type="email" name="email" id="email" required>
            <label for="tipo">Tipo</label>
            <div>
                Turismo<input type="radio" name="tipo" id="tipo" value="Turismo">
                Furgoneta<input type="radio" name="tipo" id="tipo" value="Furgoneta">
            </div>
            <label for="marca">Marca</label>
            <select name="marca" id="marca">
                <?php
                foreach($vehiculos as $marca){
                    echo "<option name=marca value={$marca['marca']}>{$marca['marca']}</option>";
                };
                ?>
            </select>
           <label for="antiguedad">Antiguedad</label>
           <input type="number" name="antiguedad" id="antiguedad" max=5 min=1>
           <label for="con_itv">Con ITV</label>
           <input type="checkbox" name="con_itv" id="con_itv">
           <label for="archivo">Archivo de búsqueda</label>
           <input type="file" name="archivo" id="archivo" required> 
        </fieldset>
        <input type="submit" name="operacion" id="operacion" value="Consultar datos">
    </form>
    <?php
    
}else if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    // Validamos los datos
    $arr_valida_datos = [
        'email' => FILTER_SANITIZE_EMAIL,
        'tipo' => FILTER_SANITIZE_SPECIAL_CHARS,
        'marca' => FILTER_SANITIZE_SPECIAL_CHARS,
        'antiguedad' => FILTER_SANITIZE_NUMBER_INT,
        'con_itv' => FILTER_DEFAULT
    ];

    // Saneamos los datos
    $datos_saneados = filter_input_array(INPUT_POST, $arr_valida_datos);

    // Validamos los datos que necesitemos que estén validados
    $datos_saneados['email'] = filter_var($datos_saneados['email'], FILTER_VALIDATE_EMAIL);
    $datos_saneados['antiguedad'] = filter_var($datos_saneados['antiguedad'], FILTER_VALIDATE_INT,['min_range' => 1, 'max_range' => 5, 'default' => 1]);

    // Compruebo si está pulsado o no el checkbox de con_itv y le asigno el valor para la búsqueda
    if ($datos_saneados['con_itv'] == "on"){
        $datos_saneados['con_itv'] = 'Si';
    }else {
        $datos_saneados['con_itv'] = 'No';
    }

    // Una vez tengamos los datos validados, comprobamos que el archivo subido es el correcto
    $fichero = $_FILES['archivo'];
    echo "<h1>Apartado de la búsqueda de datos</h1>";
    echo "<h3>Usuario: {$datos_saneados['email']}</h3>";
    echo "<hr>";
    ?>
    <form action="<?=$_SERVER['PHP_SELF']?>" method="POST" enctype="multipart/form-data">
        <fieldset>
            <legend>Introduzca los datos requeridos:</legend>
            <label for="email">Email</label>
            <input type="email" name="email" id="email" required>
            <label for="tipo">Tipo</label>
            <div>
                Turismo<input type="radio" name="tipo" id="tipo" value="Turismo">
                Furgoneta<input type="radio" name="tipo" id="tipo" value="Furgoneta">
            </div>
            <label for="marca">Marca</label>
            <select name="marca" id="marca">
                <?php
                foreach($vehiculos as $marca){
                    echo "<option name=marca value={$marca['marca']}>{$marca['marca']}</option>";
                };
                ?>
            </select>
           <label for="antiguedad">Antiguedad</label>
           <input type="number" name="antiguedad" id="antiguedad">
           <label for="con_itv">Con ITV</label>
           <input type="checkbox" name="con_itv" id="con_itv">
           <label for="archivo">Archivo de búsqueda</label>
           <input type="file" name="archivo" id="archivo"  required> 
        </fieldset>
        <input type="submit" name="operacion" id="operacion" value="Consultar datos">
        <hr>
    </form>

    <?php
    
    // Comprobación subida de fichero
    if ($fichero['error'] == UPLOAD_ERR_OK){
        // Comprobación tamaño de fichero (aproximada a 200KB);
        if ($fichero['size'] < 200000){
            if (mime_content_type($fichero['tmp_name']) == 'text/csv'){
                // Leemos el fichero y comparamos el string de la búsqueda que vamos a realizar con el que nos devuelve la lectura del fichero
                $contador = 0;
                $vehiculos_coincidentes = [];
                $fichero = file($fichero['tmp_name']);
                $string_busqueda = "\"{$datos_saneados['tipo']}\"". "," . "\"{$datos_saneados['marca']}\"" . ',' . "{$datos_saneados['antiguedad']}" . "," . "{$datos_saneados['con_itv']}";
    
                // Recorremos el array de datos que nos devuelve 'file' y comparamos con la búsqueda
                foreach($fichero as $linea){
                    if (str_contains($linea, $string_busqueda)){
                        $vehiculos_coincidentes[] = explode(",", $string_busqueda);
                        $contador++;
                    }
                }
    
                // Cabecera de la tabla
                $cabecera = explode(",", $fichero[0]);
    
                // Devuelvo los datos en forma de tabla
                ?>
                <h2>Vehiculos coincidentes</h2>
                <table>
                    <thead>
                    <tr>
                        <?php
                            foreach($cabecera as $dato){
                                echo "<th>$dato</th>";
                            }
                        ?>
                    </tr>
                    </thead>
                    <tbody>
                            <?php
                                foreach($vehiculos_coincidentes as $vehiculo){
                                    echo "<tr>";
                                    foreach($vehiculo as $datos){
                                    echo "<td>$datos</td>";
                                    }
                                    echo "</tr>";
                                }
                            ?>
                        </tr>
                    </tbody>
                </table>
                <?php
                echo "<br>Número de vehículos coincidentes: " . $contador;
            } else {
                echo "El fichero que se ha subido no contiene el formato correcto";
            }
        }else {
            echo "<h3>El fichero supera el límite establecido de tamaño</h3>";
        }
    }
}
fin_html();
?>