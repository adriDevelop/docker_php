<?php

// Pantalla inicial donde mostraremos el formulario de inicio de sesión.

// Comenzamos como en todos los ejercicios, iniciando la sesión del usuario.
session_start();

// Hacemos uso de ob_start para el problema con las cabeceras, ya que colisionan con los echo.
ob_start();

// Ahora, importamos los archivos que nos harán falta para incluir funciones.
require_once($_SERVER['DOCUMENT_ROOT'] . "/ejercicio1_mantenimiento_estado/includes/functions.php");
// Requerimos del archivo que nos dará Rafa para validar el jwt. Vamos a importarlo.
require_once("03jwt_include.php");

// Creamos array de usuarios que tenemos registrados en nuestra web.
$usuarios = [
    // Os explico lo que hacemos aqui.

    /*
        1.- Creamos a un usuario con id usuario@usuario.com.
        2.- Generamos una clave para ese usuario.
        3.- Cuando creamos una clave, hay que hashearla, es decir, "cifrarla" para que en caso de que haya 
            alguna vulnerabilidad en nuestro sistema, no se filtre la password. Usamos el método password_hash para ello.
        4.- A este método se le pasa la clave que vamos a "cifrar" y el modo en que queremos cifrarla. 
        
                                SIEMPRE VAMOS A USAR PASSWORD_DEFAULT.
    */
    'usuario@usuario.com' => ['clave' => password_hash('usuario', PASSWORD_DEFAULT)
                             ]
    ];

// Y ya podemos continuar con nuestra comprobación de GET en la página.
inicio_html("Pantalla inicial", ['../styles/styles.css']);

// Perdonadme pero es que voy en el tren XDD.

// Bueno, aquí ya podemos generar nuestro formulario. Vamos a ello.

if ($_SERVER['REQUEST_METHOD'] == 'GET'){
    // En nuestro get, tenemos que hacer una comprobación para saber si el usuario ha cerrado sesión.
    // Esta comprobación es la siguiente.
    $operacion = filter_input(INPUT_GET, 'operacion', FILTER_SANITIZE_SPECIAL_CHARS);
    if ($operacion == 'cerrar'){
        // Y aqui, eliminaremos TODO el contenido de la cookie del usuario y todos los datos almacenados.
        // Y ahora viene, cuando veo la práctica.

        // Lo primero que hacemos el coger el nombre del usuario.
        $usuario = session_name();

        // Bueno, antes tenemos que coger los parametros que tiene nuestra cookie.
        $parametros_cookie = session_get_cookie_params();

        // Tras esto, debemos de hacer un expires para que se borre, como en JavaScripts pasandole los datos en el setcookie.
        setcookie($usuario, '', time() - 10000, $parametros_cookie['path'], $parametros_cookie['domain'], $parametros_cookie['secure'], $parametros_cookie['httponly']);

        // Y ahora, borramos los datos de la sesion.
        session_unset();

        // Y borramos los datos de la cookie almacenados.
        session_destroy();

        // Vamos a probarlo, no???
    }
    // Vamos a generar nuestro formulario. Para ello debemos de cerrar y abrir un nuevo bloque php.
    ?>
        <!-- Para que no nos de problemas con nuestro html inyectado directamente.
            
            Como el formulario lo vamos a validar en esta página, debemos de enviarlo a él mismo
            para posteriormente, validarlo en el POST. -->
        <form action="<?=$_SERVER['PHP_SELF']?>" method="POST">
            <legend>Introduzca los datos para el inicio de sesión.</legend>
            <fieldset>
                <label for="usuario">Email:</label>
                <input type="email" name="email" id="email" required>
                <label for="clave">Clave</label>
                <input type="password" name="clave" id="clave" required>
            </fieldset>
            <input type="submit" name="operacion" id="operacion" value="Iniciar sesión">
        </form>
    <?php
}
// Con esto, tenemos ya generado nuestro formulario de inicio de sesión. Ahora, debemos de comprobar los datos, sanearlos y 
// comprobar que el usuario se ha logueado correctamente. Vamos a hacerlo.

// Para empezar a validar al usuario, antes tenemos que tener un usuario creado. Vamos a crearlo primero dentro de un array
// de usuarios al principio de nuestro script.

// Ya podemos seguir.

// Ahora toca hacer la opción POST.
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    // Validamos los datos.
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $email = filter_var($email, FILTER_VALIDATE_EMAIL);

    // La clave NO SE TOCA. Se almacena directamente para comprobaciones.
    $clave = $_POST['clave'];

    // Ahora, debemos comprobar que el usuario se ha logueado correctamente.
    // Primero comprobamos que el email existe.
    if (array_key_exists($email, $usuarios)){
        // Si existe el email dentro del array como clave, seguimos con la validación comprobando que ha introducido correctamente
        // la clave.
        if (password_verify($clave, $usuarios[$email]['clave'])){
            // Se ha logueado con éxito.

            // Ahora, tenemos que hacer uso de generación de jwt para crear la cookie y almacenar la cookie del usuario.
            // Vamos a ello.
            
            // Para ello lo primero que debemos de hacer es iniciar nuestro payload.
            $usuario = [
                'id' => $email
            ];

            // Tan solo le añado el id con el email del usuario para que hasolo almacene ese dato.
            // A parte, porque no he introducido otro dato del usuario.

            // Ahora, deberemos de seguir generando el token.
            // Para ello, tenemos la función generar token a la que hay que pasarle nada más que el array que nos hemos
            // generado.
            $jwt = generar_token($usuario);

            // Cuando lo hayamos generado, tenemos que generar la cookie. Para ello, vamos a coger anter y ponerle una fecha de 
            // expiración de 2 horas. ¿Porqué uso + 120 * 60? Porque son 120 minutos de dos horas por los segundos que dura un minuto.
            $expire = time() + 120 * 60;

            // Y generamos la cookie.
            // Cuando vayáis a generar la cookie y no equivocaros en el dato que pasáis, mirar como se construye como acabo de hacer.
            setcookie('jwt', $jwt, $expire, '/', 'dwes.es');

            // Con esto, YA LO TENEMOS HECHO. LO MAS COMPLICADO YA ESTÁ.
            // Ahora, redirijimos al usuario.
            header("Location: /ejercicio1_mantenimiento_estado/repeticion_ejercicio_08/08introduce_comentario.php");

            // Vamos a probarlo.
            // Perfecto, vamos a equivocarnos a ver que sale.

        } else {
             // Se ha equivocado con la clave.
    echo "<p>Te has equivocado con algún dato.</p>";
    // Y le pondremos un href para que vuelva a la misma ventana para que vuelva a intentarlo.
    echo "<a href='/ejercicio1_mantenimiento_estado/repeticion_ejercicio_08/08pantalla_inicial.php'>Vuelve a intentarlo...</a>";
    }   
}else {// Al igual que si se equivoca con el mail del usuario.
    echo "<a href='/ejercicio1_mantenimiento_estado/repeticion_ejercicio_08/08pantalla_inicial.php'>Vuelve a intentarlo...</a>";
    }

}






// Pero antes, debemos cerrar todo lo que tenemos abierto para que no nos casque un error más adelante.

// Lo primero es almacenar todas las "cabeceras" que tenemos almacenadas en ob, en una variable.
$ob_cabeceras = ob_get_contents();
// Y eliminamos todo lo que tenemos en ob.
ob_flush();

// Y terminamos cerranto el html, que por cierto, aún no lo hemos abierto. Vamos a cerrarlo y lo abrimos también.
fin_html();
?>