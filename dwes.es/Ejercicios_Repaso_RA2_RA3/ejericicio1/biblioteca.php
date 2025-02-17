<!-- BIBLIOTECA -->

<?php
    // Importamos los archivos que nos van a hacer falta
    require_once($_SERVER['DOCUMENT_ROOT'] . '/Ejercicios_Repaso_RA2_RA3/includes/functions.php');

    // Creamos el array donde vamos a almacenar toda la informacion de los libros de nuestra BIBLIOTECA
    $libros = [
        "123-4-56789-012-3" => ["autor" => "Ken Follet", "titulo" => "Los pilares de la tierra", "genero" => "Novela histórica"],
        "987-6-54321-098-7" => ["autor" => "Ken Follet", "titulo" => "La caída de los gigante", "genero" => "Historia"],
        "345-1-91827-019-4" => ["autor" => "Max Hastings", "titulo" => "La guerra de Churchill", "genero" => "Biografía"],
        "908-2-10928-374-5" => ["autor" => "Isaac Asimov", "titulo" => "Fundación", "genero" => "Fantasía"],
        "657-4-39856-543-3" => ["autor" => "Isaac Asimov", "titulo" => "Yo, robot", "genero" => "Fantasía"],
        "576-4-23442-998-5" => ["autor" => "Carl Sagan", "titulo" => "Cosmos", "genero" => "Divulgación científica"],
        "398-4-92438-323-2" => ["autor" => "Carl Sagan", "titulo" => "La diversidad de la ciencia", "genero" => "Divulgación científica"],
        "984-5-39874-209-4" => ["autor" => "Steve Jacobson", "titulo" => "Jobs", "genero" => "Biografía"],
        "564-7-54937-300-6" => ["autor" => "George R.R. Martin", "titulo" => "Juego de tronos", "genero" => "Fantasía"],
        "677-2-10293-833-8" => ["autor" => "George R.R. Martin", "titulo" => "Sueño de primavera", "genero" => "Fantasía"]
    ];

    inicio_html("Tu libreria de Confianza", ['../styles/general.css', '../styles/formulario.css', '../styles/tabla.css']);

    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        echo "<h1>Bienvenido al formulario</h1>"
        ?>
            <form action="<?=$_SERVER['PHP_SELF']?>" method="post">
                <fieldset>
                <!-- CAMPO PARA EL ISBN -->
                <label for="isbn">ISBN</label>
                <input type="text" name="isbn" id="isbn" size="20">

                <!-- CAMPO PARA EL TÍTULO -->
                <label for="titulo">Título</label>
                <input type="text" name="titulo" id="titulo">

                <!-- CAMPO PARA EL AUTOR -->
                <label for="autor">Autor</label>
                <select name="autor[]" id="autor" multiple>
                    <?php
                    $array_autores = [];
                        foreach ($libros as $isbn => $libro) {
                            if (!in_array($libro['autor'], $array_autores)){
                                $array_autores[] = $libro['autor'];
                                echo "<option value='{$libro['autor']}'>{$libro['autor']}</option>";
                            }
                        }
                    ?>
                </select>

                <label for="genero">Genero</label>
                <select name="genero[]" id="genero" multiple>
                <?php
                    $array_generos = [];
                        foreach ($libros as $isbn => $libro) {
                            if (!in_array($libro['genero'], $array_generos)){
                                $array_generos[] = $libro['genero'];
                                echo "<option value='{$libro['genero']}'>{$libro['genero']}</option>";
                            }
                        }
                    ?>
                </select>
                </fieldset>
                <input type="submit" name="buscar" id="buscar" value="Buscar">
            </form>
        <?php
        
    }else if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        
        function valida_datos(){
            global $libros;

            $array_validar = [
                "isbn" => FILTER_SANITIZE_SPECIAL_CHARS,
                "titulo" => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
                "autor" =>FILTER_SANITIZE_SPECIAL_CHARS,
                "genero" => FILTER_SANITIZE_SPECIAL_CHARS
            ];

            $array_validado = filter_input_array(INPUT_POST, $array_validar);


        }
    }
?>