<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/recuperar31/recuperacion/includes/funciones.php');


inicio_html('REPETICIO RA 2-3', ['/recuperar31/recuperacion/estilos/general.css', '/recuperar31/recuperacion/estilos/formulario.css', '/recuperar31/recuperacion/estilos/tablas.css']);





if ($_SERVER['REQUEST_METHOD'] == 'GET') {
?>
    <h1>formulario de coches</h1>
    <form action="<?= $_SERVER['PHP_SELF'] ?>" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="MAX_FILE_SIZE" value="<?= 200 * 1024 ?>" />

        <fieldset>
            <legend>formulario</legend>

            <label for="email">Email</label>
            <input type="email" name="email" id="email" required>

            <label for="tipo">tipo</label>
            <div>
                <input type="radio" name="tipo" id="tipo" value="Turismo" required> Turismo
                <input type="radio" name="tipo" id="tipo" value="Furgoneta" required> Furgoneta

            </div>

            <label for="marca">marca</label>
            <select name="marca" id="marca" required>
                <option value="Fiat">Fiat</option>
                <option value="Opel">Opel</option>
                <option value="Mercedes">Mercedes</option>
            </select>

            <label for="antiguedad">antiguedad</label>
            <input type="number" name="antiguedad" id="antiguedad" required>

            <label for="itv">itv</label>
            <input type="checkbox" name="itv" id="itv">

            <label for="fichero">fichero</label>
            <input type="file" name="fichero" id="fichero" required>

        </fieldset>
        <input type="submit" name="enviar" id="enviar">

    </form>

    <?php


}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $mime_permitido = 'text/csv';
    $fichero = $_FILES['fichero'];


    //solo hago la ejecucion si el fichero proporcionado es valido
    if ($fichero['size'] < 200 * 1024) {

        if (mime_content_type($fichero['tmp_name']) == $mime_permitido) {

            // muevo el fichero subido a la carpeta de archivos temporales, si se puede entonces empiezo el saneamiento y validacion
            if (move_uploaded_file($fichero['tmp_name'], sys_get_temp_dir() . "/" . $fichero['name'])) {
            
                
                //leo el archivo y lo paso a stringcsv
                // $coches_disponibles_csv  = file_get_contents(sys_get_temp_dir() . "/" . $fichero['name'], FILE_USE_INCLUDE_PATH );
                $coches_disponibles = file(sys_get_temp_dir() . "/" . $fichero['name']);

                echo $coches_disponibles_csv . "<br>";

                // paso el stringcsv a array
                // $coches_disponibles = str_getcsv($coches_disponibles_csv, ",", "\"", "\\");


                

                // una vez se abierto el archivo ya puedo sanear los datos
                $valores_saneamiento = [
                    'email' => FILTER_SANITIZE_EMAIL,
                    'tipo' => FILTER_SANITIZE_SPECIAL_CHARS,
                    'marca' => FILTER_SANITIZE_SPECIAL_CHARS,
                    'antiguedad' => FILTER_SANITIZE_SPECIAL_CHARS,
                    'itv' => FILTER_VALIDATE_BOOLEAN

                ];
                
                $datos_saneados = filter_input_array(INPUT_POST, $valores_saneamiento);
                


                $datos_saneados['email'] = filter_var($datos_saneados['email'], FILTER_VALIDATE_EMAIL);

                echo $datos_saneados['email'] . '<br>';

                array_key_exists($datos_saneados['tipo'], $coches_disponibles) ? $datos_saneados['tipo'] : false;
                echo $datos_saneados['tipo'] . '<br>';

                array_key_exists($datos_saneados['marca'], $coches_disponibles) ? $datos_saneados['marca'] : false;
                echo $datos_saneados['marca'] . '<br>';

                
                if ($datos_saneados['antiguedad'] < 1 || $datos_saneados['antiguedad'] > 5) {
                    $datos_saneados['antiguedad'] = false;
                }
                echo $datos_saneados['antiguedad'] . '<br>';


                foreach ($coches_disponibles as $coche ) {
                    echo $coche ."<br>";
                }
                

                // compruebo que todos los datos estan validados antes de continuar
                if ($datos_saneados['email'] && $datos_saneados['tipo'] && $datos_saneados['tipo'] && $datos_saneados['marca'] && $datos_saneados['antiguedad']) { ?>
                    <table>
                        <thead>
                            <tr>
                                <th>Email</th>
                                <th>Tipo</th>
                                <th>Marca</th>
                                <th>Antigüedad</th>
                                <th>ITV</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><?= $datos_saneados['email'] ?></td>

                                <?php
                                foreach ($coches_disponibles as $coche):               
                                    echo "<td>".$coche."</td>";       
                                    if ($coche[$datos_saneados['tipo']][$datos_saneados['Marca']][$datos_saneados['Antigüedad']][$datos_saneados['ITV']]) {
                                        echo "<td>" . $coches_disponibles['tipo'] . "</td>";
                                        echo "<td>" . $coches_disponibles['Marca'] . "</td>";
                                        echo "<td>" . $coche[$datos_saneados['Antigüedad']] . "</td>";
                                        echo "<td>" . $coche[$datos_saneados['ITV']] . "</td>";
                                    } else {
                                        echo "<td> No hay coches disponibles</td>";
                                    }

                                endforeach;
                                ?>

                            </tr>
                        </tbody>
                    </table>
                    ?>


<?php


                } else {
                    echo "hay algun dato no valido";
                }
            }
        } else {
            echo "tipo de fichero no valido";
        }
    } else {
        echo "fichero demasiado pesado";
    }
}




?>