<?php

/* Bueno, pues ya lo tenemos todo.
    - Token generado.
    - Hemos validado a nuestro usuario con password_verify.
    - Hemos generado la cookie.
    - Y ya tenemos todos los datos almacenados.
*/

// Ahora, debemos de generar otro formulario que nos permita seleccionar una "opción" en nuestro
// formulario y que le permita almacenar un comentario. 

// Vamos.

// Lo primero como siempre, inciar la session.
session_start();

// Despues, hacemos uso e ob para evitar colisiones con "las cabeceras".
ob_start();

// Cuando lo tengamos definido, hacemos los import de los archivos que contendrán las funciones que nos hacen falta.
require_once($_SERVER['DOCUMENT_ROOT'] . "/ejercicio1_mantenimiento_estado/includes/functions.php");

// De este vuelvo a hacer el import porque tenemos funciones que nos hacen falta.
require_once("03jwt_include.php");

// Y ahora, incializamos nuestro html.
inicio_html("Pantalla inserta datos", ['../styles/styles.css', '../styles/tablas.css']);


// ¿Porqué he puesto && payload?
// ¿Os acordais del array de usuario id? Pues eso lo tenemos almacenado en nuestra cookie. Ese es nuestro payload.
// Y se trata de una forma de asegurarse de que es este usuario el que está usando la aplicación y el que está logueado.
// De ahí que haga esta validación.

// Vamos a hacerlo. ¿Cómo? Pues lo primero es recoger el jwt.
$jwt = $_COOKIE['jwt'];

// Aqui, recogemos de la cookie que hemos generado, la que tiene el nombre 'jwt'. Y ya tenemos todos los valores.

// ¿Y cómo recuperamos los datos del usuario con el jwt? Haciendo uso de una de las funciones que nos facilitará Rafa.
$payload = verificar_token($jwt);
// Esa función recoge el jwt y devuelve el payload generado anteriormente.
// Vamos a comprobar que se ha recogido SIEMPRE que pida que haya comprobación de payload.

// Empezamos con nuestro formulario.
if($_SERVER['REQUEST_METHOD'] == 'GET' && $payload){

    // ¿Como puedo saber si tenemos el payload? 
    /* Bueno, a parte de que ya lo estamos comprobado en el if, podemos devolver el 
       valor de alguno de los datos que tiene almacenado este payload de la siguiente manera.
    */
    echo "<h1>Bienvenido {$payload['id']}</h1>";

    // ¿Lo probamos?
    // Funciona chachi pistachi. Vamos a continuar con el ejercicio.

    // Ahora, cerramos nuestro bloque php y devolvemos nuestro formulario.
    ?>
    <form action="<?=$_SERVER['PHP_SELF']?>" method="POST">
        <legend>Introduce el comentario que quieras almacenar sobre la asignatura:</legend>
        <fieldset>
            <label for="seleccion">Elige la asignatura:</label>
            <select name="seleccion" id="seleccion">
                <option value = "Despliegue de aplicaciones Web">DAW</option>
                <option value = "Desarrollo de aplicaciones Entorno Servidor">DWES</option>
                <option value = "Desarrollo de aplicaciones Entorno Cliente">DWEC</option>
                <option value = "Diseño de interfaces WEB">DIW</option>
                <option value = "Horas de Libre configuracion">HLC</option>
            </select>
            <label for="comentario">Comentario sobre la clase</label>
            <textarea name="comentario" id="comentario"></textarea>
        </fieldset>
        <input type="submit" name="operacion" id="operacion" value="Enviar comentario">
    </form>
    <?php
}
// Vamos a comprobar los datos y almacenarlo en la sesión del usuario.
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $seleccion = filter_input(INPUT_POST, 'seleccion', FILTER_SANITIZE_SPECIAL_CHARS);
    $comentario = filter_input(INPUT_POST, 'comentario', FILTER_SANITIZE_SPECIAL_CHARS);

    // Por aquí me he equivocado en algo. Voy a mirarlo en el ejercicio un momentin. Eran dos corchetes. Os he dicho que aun me lia esto
    // y es normal, no os agobiéis con eso.

    // Bueno, vamos con la siguiente página ya.

    // Ahora, lo que debemos de hacer no es almacenarlo en un array para cada uno, sino, en un array de sesión.
    if (!$_SESSION['seleccion']){
        $_SESSION['seleccion'] = [];
    }

    // Si ya está creado, almacenamos los datos directamente.
    $_SESSION['seleccion'][] = Array($seleccion, $comentario);

    // Y con esto, ya podemos navegar a la sigueinte ventana, si no me he equivocado en nada porque esto me confunde de vez en cuando jeje.
    header("Location: /ejercicio1_mantenimiento_estado/repeticion_ejercicio_08/08mostrar_comentarios.php");
}


// Y también, cerramos todo antes de seguir.

// Almacenamos los datos de ob, para no eliminar del todo todos los datos de nuestras cabeceras.
$ob_cabeceras = ob_get_contents();
// Borramos los datos de ob ya que, una vez los tengamos almacenados, tenemos que cerrar el bloque.
ob_flush();

// Cerramos nuestro html.
fin_html();


?>