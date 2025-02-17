<?php

    // Iniciamos sesión.
    session_start();

    // Iniciamos ob para el control de las cabeceras.
    ob_start();

    // Inicamos la importación de nuestras funciones.
    require_once($_SERVER['DOCUMENT_ROOT'] . "/ejercicio1_mantenimiento_estado/includes/functions.php");

    // Iniciamos el html.
    inicio_html("Pantalla modelo, motor", ['../styles/style.css']);

    // Crearnos el array de modelos de vehiculo y de tipos de motores.
    // Array de modelo de vehiculo.
    $arr_modelo_vehiculos = ['Monroy' => ['precio' => 20000],
                             'Muchopami' => ['precio' => 21000],
                             'Zapatoveloz' => ['precio' => 22000],
                             'Guperino' => ['precio' => 25500],
                             'Alomejor' => ['precio' => 29750],
                             'Telapegas' => ['precio' => 32550]
    ];

    // Array de tipo de motor.
    $arr_tipo_motores = ['Gasolina' => ['precio' => 0],
                         'Diesel' => ['precio' => 2000],
                         'Híbrido' => ['precio' => 5000],
                         'Electrico' => ['precio' => 10000]
    ];

    // Comenzamos con nuestra página modelo, motor.
    if ($_SERVER['REQUEST_METHOD'] == 'GET' && $_SESSION['nombre'] && $_SESSION['telefono'] && $_SESSION['email']){
        ?>
            <form action="<?$_SERVER['PHP_SELF']?>" method="POST">
                <legend>Indica modelo y motor del vehículo</legend>
                <fieldset>
                    <label for="modelo">Modelo</label>
                    <select name="modelo_vehiculo" id="modelo_vehiculo">
                        <?php
                            foreach($arr_modelo_vehiculos as $modelo => $precio){
                                echo "<option value='{$modelo}'>$modelo</option>";
                            }
                        ?>
                    </select>
                    <br>
                    <?php
                        foreach($arr_tipo_motores as $motores => $precio){
                            echo "<label for='tipo_motor'>$motores</label><br>";
                            echo "<input type='radio' name='motor' id='$motores' value='$motores'><br>";
                        }
                    ?>
                </fieldset>
                <input type="submit" name="operacion2" id="operacion2" value="Enviar consulta">
            </form>
        <?php
    } if($_SERVER['REQUEST_METHOD'] == 'POST' && $_SESSION['nombre'] && $_SESSION['telefono'] && $_SESSION['email']){
        // Validamos los datos recibidos del formulario.
        $modelo = filter_input(INPUT_POST, 'modelo_vehiculo', FILTER_SANITIZE_SPECIAL_CHARS);
        $motor = filter_input(INPUT_POST, 'motor', FILTER_SANITIZE_SPECIAL_CHARS);

        // Los agregamos a nuestra sesión.
        $_SESSION['modelo_vehiculo'] = $modelo;
        $_SESSION['motor'] = $motor;

        // Añadimos la navegación hacia la siguiente ventana.
        header("Location: /ejercicio1_mantenimiento_estado/ejercicio4/04pantalla_pintura.php");
    }


    // Recogemos nuestros datos de ob.
    $ob_datos = ob_get_contents();
    // Eliminamos todos los datos de nuestro ob.
    ob_flush();


    // Finalizamos nuestro html.
    fin_html();
?>