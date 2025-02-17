<?php

// Espacio de nombres
namespace mvc\Modelo;

// Creación de la clase
interface Modelo{
    // Función que tendrán todas las clases que hereden de este modelo
    public function despacha():mixed;
}

?>