<?php

// Importo las funciones necesarias
require_once($_SERVER['DOCUMENT_ROOT'] . "/Ejercicios_Formularios/includes/funciones.php");

// Controlamos las peticiones
if ($_SERVER['REQUEST_METHOD'] == 'GET'){
    inicio_html("Logueo del usuario", ['../styles/general.css', '../styles/formulario.css']);
    echo "<h1>Bienvenido. Logueate y pasa tu imagen (archivos válidos JPG, PNG y WEBP)</h1>";

    // Formulario para acceder con los datos
    ?>
        <form action="<?=$_SERVER['PHP_SELF']?>" method="POST" enctype="multipart/form-data">
            <fieldset>
                <legend>Introduce los datos de sesión</legend>
                <label for="nombre_de_usuario">Nombre_de_usuario</label>
                <input type="text" name="nombre_de_usuario" id="nombre_de_usuario" required>
                <label for="imagen">Imagen de perfil</label>
                <input type="file" name="imagen" id="imagen">
                <label for="titulo">Titulo</label>
                <input type="text" name="titulo" id="titulo" required>
            </fieldset>
            <input type="submit" name="operacion" id="operacion">
        </form>
    <?php
    fin_html();

} else if ($_SERVER['REQUEST_METHOD'] == 'POST'){

    inicio_html("Logueo del usuario", ['../styles/general.css', '../styles/formulario.css']);
    echo "<h1>Bienvenido. Logueate y pasa tu imagen (archivos válidos JPG, PNG y WEBP)</h1>";

    // Formulario para acceder con los datos
    ?>
        <form action="<?=$_SERVER['PHP_SELF']?>" method="POST" enctype="multipart/form-data">
            <fieldset>
                <legend>Introduce los datos de sesión</legend>
                <label for="nombre_de_usuario">Nombre_de_usuario</label>
                <input type="text" name="nombre_de_usuario" id="nombre_de_usuario" required>
                <label for="imagen">Imagen de perfil</label>
                <input type="file" name="imagen" id="imagen">
                <label for="titulo">Titulo</label>
                <input type="text" name="titulo" id="titulo" required>
            </fieldset>
            <input type="submit" name="operacion" id="operacion">
        </form>
    <?php
    fin_html();
    

    // Array para la validación
    $datos_validos = [
        'image/jpg' => 250,
        'image/png' => 225,
        'image/webp' => 200
    ];

    // Validación de datos
    $nombre_de_usuario = filter_input(INPUT_POST, 'nombre_de_usuario', FILTER_SANITIZE_SPECIAL_CHARS);
    $imagen = $_FILES['imagen'];
    $titulo = filter_input(INPUT_POST, 'titulo', FILTER_SANITIZE_SPECIAL_CHARS);

    // Fichero de subida de archivos
    $subida = $_SERVER['DOCUMENT_ROOT'] . "/Ejercicios_Formularios/ejercicio8/fotos/$nombre_de_usuario";

    echo "<hr>";

    if($imagen['error'] == UPLOAD_ERR_OK){
        if (array_key_exists(mime_content_type($imagen['tmp_name']), $datos_validos)){
            echo "<h2>Archivo subido</h2>";
            // Comprobación de que el archivo que se ha subido es un archivo válido
            echo "<h3>Titulo introducido$titulo</h3>";
            echo "<h3>Nombre introducido $nombre_de_usuario</h3>";
            echo "Nombre del archivo: " . $imagen['name'] ."<br>";
            echo "Tipo de archivo: " . mime_content_type($imagen['tmp_name']);
            
            if (!file_exists($subida) || !is_dir($subida)){
                if (!mkdir($subida, 0755, true)){
                    echo "La subida no puede efectuarse porque no existe la carpeta";
                }
            }
            if (move_uploaded_file($imagen['tmp_name'], $subida . "/{$imagen['name']}")){
                echo "Subida de archivo: Ha sido correcta";
            }
            $archivos = scandir("fotos/$nombre_de_usuario");
            foreach($archivos as $archivo){
                echo "<a href='fotos/$nombre_de_usuario/$archivo'>{$archivo}</a><br>";
            }
            
        }   
    }
}
    



?>