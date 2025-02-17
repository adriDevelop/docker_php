<?php

// Requerimos/Importamos los datos que nos hagan falta
require_once($_SERVER['DOCUMENT_ROOT'] . "/Ejercicios_Repaso_RA2_RA3/includes/functions.php");

    // Creamos el array de cursos
    $cursos = [
        "ofi" => ['descripcion' => 'Ofimática', 'precio' => 100],
        'pro' => ['descripcion' => 'Programación', 'precio' => 200],
        'rep' => ['descripcion' => 'Reparación ordenadores', 'precio' => 150]
    ];

    // Creamos un array de consultas
    $precios_consultas = [
        "ofi" => ['precio' => 20],
        "pro" => ['precio' => 30],
        "rep" => ['precio' => 50],
    ];

    inicio_html("Formulario registro", ['../styles/general.css', '../styles/formulario.css', '../styles/tablas.css']);
// Controlamos peticiones
if ($_SERVER['REQUEST_METHOD'] == 'GET'){
    echo "<h1>Bienvenido al formulario inicial</h1>";
    
    ?>
        <form action="<?=$_SERVER['PHP_SELF']?>" method="POST" enctype="multipart/form-data">
            <fieldset>
                <legend>Rellena los datos correspondientes</legend>
                <label for="email">Email</label>
                <input type="email" name="email" id="email" required>
                <label for="cursos">Cursos</label>
                <select name="cursos[]" id="cursos" multiple required>
                <?php
                foreach($cursos as $curso => $valor){
                    echo "<option value='$curso'>{$valor['descripcion']}</option>";
                }
                ?>
                </select>
                <label for='valor_consulta'>$precio</label>
                <?php
                foreach($precios_consultas as $precio => $valor){
                    echo "$precio";
                    echo "<input type='radio' name='valor_consulta' value=''></input>";
                }
                ?>
                <label for="clases_presenciales">Clases presenciales</label>
                <input type="number" name="clases_presenciales" id="clases_presenciales">
                <label for="en_paro">En paro</label>
                <input type="checkbox" name="en_paro" id="en_paro">
                <label for="archivo">Archivo</label>
                <input type="file" name="archivo" id="archivo" required>
            </fieldset>
            <input type="submit" name="operacion" id="operacion" value="Enviar">
        </form>
    <?php
    
}else if ($_SERVER['REQUEST_METHOD'] == 'POST'){

    // Validamos los datos del formulario
    $array_saneamiento = [
        'email' => FILTER_SANITIZE_EMAIL,
        'cursos' => ['filter' => FILTER_SANITIZE_SPECIAL_CHARS,
                    'flags' => FILTER_REQUIRE_ARRAY],
        'clases_presenciales' => FILTER_SANITIZE_NUMBER_INT,
        'en_paro' => FILTER_DEFAULT
    ];

    $datos_saneados = filter_input_array(INPUT_POST, $array_saneamiento);

    // Validamos los datos del email
    $datos_saneados['email'] = filter_var($datos_saneados['email'], FILTER_VALIDATE_EMAIL);

    $fichero = $_FILES['archivo'];
    $directorio_guardado = $_SERVER['DOCUMENT_ROOT'] . "/Ejercicios_Formularios/repeticion_examen/tarjetas";
    echo "<h1>Tabla con los datos del cliente</h1>";
    echo "<hr>";
    ?>

    <table>
        <thead>
            <tr>
                <th>Email</th>
                <th>Cursos</th>
                <th>clases Presenciales</th>
                <th>Desempleo</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><?=$datos_saneados['email']?></td>
        <?php
                $datos = '';
                $precios = 0;
                foreach($datos_saneados['cursos'] as $key){
                        $datos .= $cursos[$key]['descripcion'].",\n" ;
                        $precios += $cursos[$key]['precio'];
                }
                if($datos_saneados['en_paro'] == 'on'){
                     $desempleado = 'No desempleado';
                } else { 
                        $desempleado = 'Desempleado';
                }
        ?>
                <td><?=$datos?></td>
                <th><?=$datos_saneados['clases_presenciales']?></th>
                <th><?= $desempleado?></th>
            </tr>
        </tbody>
    </table>

    <?php
    echo "<h1>Presupuesto</h1>";
    echo "<hr>";
    echo "El precio total de los cursos es: $precios $ <br>";
    $precios = $precios + 10*$datos_saneados['clases_presenciales'];
    echo "El precio total de los cursos sumando las clases presenciales es: " . $precios ."$<br>";
    if ($desempleado == 'Desempleado'){
        echo "No te corresponde descuento porque estás trabajando<br>";
        echo "El total del presupuesto es: <h1>" . $precios . "$</h1>";
        if (mime_content_type($fichero['tmp_name']) == "application/pdf"){
            if (!file_exists($directorio_guardado) || !is_dir($directorio_guardado)){
                if (!mkdir($directorio_guardado, 0755, true)){
                    echo "No se ha podido guardar el fichero en la carpeta";
                }
            }
            if (move_uploaded_file($fichero['tmp_name'], $directorio_guardado . "/{$datos_saneados['email']}.pdf")){
                echo "Nombre anterior del fichero: {$fichero['name']}<br>";
                echo "Nombre actual del fichero: {$datos_saneados['email']}.pdf<br>";
                echo "Eres desempleado<br>";
            }
        }
    }else {
        echo "El descuento que tienes es de un 10% por lo que le restamos: " . $precios*0.1 . '$<br>';
        echo "El total del presupuesto es: <h1>" . $precios - $precios*0.1. "$</h1>";
        echo "No necesitas insertar la tarjeta ya que no estás desempleado";
    }
    
    fin_html();
}

?>