<?php

// Espacio de nombres
namespace exra531\vista;

// Creación de la clase VistaError31
class VistaError31{
    
    // Método muestraError($excepcion)
    public function muestraError($excepcion){
        echo "<h2>El mensaje de error es: $excepcion</h2>";
        ?>
        <form action="exra531/pagina_principal.php" method="POST">
            <input type="submit" id="idp" name="idp" value="Volver atrás">
        </form>
        <?php
    }
}

?>